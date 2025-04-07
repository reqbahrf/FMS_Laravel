<?php

namespace App\Services;

use Exception;
use App\Models\User;
use App\Models\Assets;
use App\Models\FormDraft;
use App\Models\Personnel;
use App\Models\AddressInfo;
use App\Models\ProjectInfo;
use App\Events\ProjectEvent;
use App\Jobs\ProcessPayment;
use App\Models\BusinessInfo;
use App\Models\CoopUserInfo;
use App\Models\ApplicationForm;
use App\Models\ApplicationInfo;
use App\Models\NotificationLog;
use App\Mail\ProjectRegistration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendApplicationFormLink;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Collection;
use App\Actions\GenerateUniqueUsernameAction;

class RegistrationService
{
    private const DRAFT_PREFIX = 'ASSIST_REGISTRATION_';
    public function __construct(
        private TNAdataHandlerService $TNAdataHandlerService,
        private ApplicantFileHandlerService $fileHandler,
        private ApplicationForm $applicationForm,
        private GenerateUniqueUsernameAction $generateUniqueUsernameAction
    ) {}

    /**
     * Register a new application with all related data
     *
     * @param array $validatedInputs The validated request inputs
     * @return array The result array with status and data
     */
    public function registerApplication(array $validatedInputs): array
    {
        $applicant = Auth::user();
        $user_name = $applicant->user_name;
        $successful_inserts = 0;

        Log::info('Starting application registration process', [$validatedInputs]);
        DB::beginTransaction();

        try {
            // Store user address
            $this->storeUserAddress($validatedInputs, $applicant->id);
            $successful_inserts++;
            // Process and store personal info
            $personalInfo = $this->storePersonalInfo($validatedInputs, $user_name);
            $successful_inserts++;

            // Process and store business info
            $businessInfo = $this->storeBusinessInfo($validatedInputs, $personalInfo->id);
            $businessId = $businessInfo['businessId'];
            $successful_inserts++;

            // Process and store assets
            $this->storeAssets($validatedInputs, $businessId);
            $successful_inserts++;

            // Process and store personnel
            $this->storePersonnel($validatedInputs, $businessId);
            $successful_inserts++;

            // Create application record
            $applicationId = $this->createApplicationRecord(
                $businessId,
                false,
                null,
                'new',
                null,
                $validatedInputs['requested_fund_amount']
            );
            $successful_inserts++;
            if ($successful_inserts == 6) {
                $firm_name = $validatedInputs['firm_name'];
                $this->fileHandler->storeFile($validatedInputs, $businessId, $firm_name);
                $this->initializeApplicationProcessFormContainer($businessId, $applicationId);
                $this->TNAdataHandlerService->setTNAData(
                    $validatedInputs,
                    $businessId,
                    $applicationId
                );
                $this->updateDraftToSubmitted($applicant);
                DB::commit();
                $location = [
                    'applicant_region' => $validatedInputs['home_region'],
                    'applicant_province' => $validatedInputs['home_province'],
                    'applicant_city' => $validatedInputs['home_city'],
                    'applicant_barangay' => $validatedInputs['home_barangay'],
                ];

                // Trigger event
                event(new ProjectEvent(
                    $businessId,
                    $businessInfo['enterprise_type'],
                    $businessInfo['enterprise_level'],
                    $location,
                    'NEW_APPLICANT'
                ));

                Cache::forget('applicants');

                return [
                    'status' => 'success',
                    'message' => 'All data successfully saved.',
                    'redirect' => route('Cooperator.index')
                ];
            } else {
                DB::rollBack();
                $insertionSteps = [
                    1 => 'User Address',
                    2 => 'Personal Information',
                    3 => 'Business Information',
                    4 => 'Assets',
                    5 => 'Personnel',
                    6 => 'Application Record'
                ];

                $failedSteps = array_filter($insertionSteps, function ($key) use ($successful_inserts) {
                    return $key > $successful_inserts;
                }, ARRAY_FILTER_USE_KEY);

                $errorMessage = sprintf(
                    "Data insertion incomplete. Only %d of 6 required insertions completed successfully. " .
                        "Failed to complete the following steps: %s",
                    $successful_inserts,
                    implode(', ', $failedSteps)
                );

                Log::error($errorMessage, [
                    'successful_inserts' => $successful_inserts,
                    'failed_steps' => $failedSteps
                ]);

                return [
                    'status' => 'error',
                    'message' => $errorMessage
                ];
            }
        } catch (Exception $e) {
            DB::rollBack();
            Log::error("Error inserting data:", ['error' => $e->getMessage()]);

            return [
                'status' => 'error',
                'message' => $e->getMessage()
            ];
        }
    }

    /**
     * Register a new applicant in the system.
     *
     * This method handles the complete process of creating a new user account for an applicant,
     * including user creation, address storage, and cooperative user information.
     *
     * @param array $validatedInputs Validated input data for the applicant registration
     *
     * @throws Exception If there is an error during the registration process
     *
     * @return array An associative array containing:
     *               - 'status': 'success' if registration is completed
     *               - 'application_form': Signed URL for the application form
     *               - 'message': Success message
     *
     * @uses \App\Actions\GenerateUniqueUsernameAction to generate a unique username
     * @uses \Illuminate\Support\Facades\DB for transaction management
     * @uses \Illuminate\Support\Facades\Hash for password hashing
     * @uses \Illuminate\Support\Facades\URL for generating signed routes
     */
    public function staffRegisterApplicant(array $validatedInputs): array
    {
        try {
            $username = $this->generateUniqueUsernameAction->execute($validatedInputs['f_name']);
            $initial_password = $validatedInputs['l_name'] . str_replace('-', '', $validatedInputs['b_date']);

            DB::beginTransaction();
            $user = User::create([
                'user_name' => $username,
                'email' => $validatedInputs['email'],
                'password' => Hash::make($initial_password),
                'role' => 'Cooperator',
                'created_at' => now(),
                'updated_at' => now(),
                'must_change_password' => true,
            ]);
            $this->storeUserAddress($validatedInputs, $user->id);

            $user->coopUserInfo()->create([
                'prefix' => $validatedInputs['prefix'],
                'f_name' => $validatedInputs['f_name'],
                'mid_name' => $validatedInputs['mid_name'],
                'l_name' => $validatedInputs['l_name'],
                'suffix' => $validatedInputs['suffix'],
                'sex' => $validatedInputs['sex'],
                'birth_date' => $validatedInputs['b_date'],
                'designation' => $validatedInputs['designation'],
                'mobile_number' => $validatedInputs['mobile_no'],
                'landline' => $validatedInputs['landline'],
            ]);

            $this->draftApplicantPersonalInfo($user, $validatedInputs);
            DB::commit();

            return [
                'status' => 'success',
                'application_form' => URL::signedRoute('application.form', $user->id),
                'message' => 'Applicant registered successfully'
            ];
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception('Error in Registering Applicant: ' . $e->getMessage());
        }
    }

    public function staffRegisterExistingProject(array $validatedInputs, int $staffId): array
    {
        try {
            $username = $this->generateUniqueUsernameAction->execute($validatedInputs['f_name']);
            $initial_password = $validatedInputs['l_name'] . str_replace('-', '', $validatedInputs['b_date']);

            DB::beginTransaction();
            $user = User::create([
                'user_name' => $username,
                'email' => $validatedInputs['email'],
                'password' => Hash::make($initial_password),
                'role' => 'Cooperator',
                'created_at' => now(),
                'updated_at' => now(),
                'must_change_password' => true,
            ]);
            $this->storeUserAddress($validatedInputs, $user->id);
            $personalInfo = $this->storePersonalInfo($validatedInputs, $user->user_name);
            $businessInfo = $this->storeBusinessInfo($validatedInputs, $personalInfo->id);

            $this->storeAssets($validatedInputs, $businessInfo['businessId']);
            $this->storePersonnel($validatedInputs, $businessInfo['businessId']);

            $projectInfo = $this->storeProjectInfo($validatedInputs, $businessInfo['businessId'], $staffId);

            $this->createApplicationRecord(
                $businessInfo['businessId'],
                true,
                $staffId,
                'ongoing',
                $projectInfo->Project_id,
            );
            DB::commit();
            $paymentStructure = PaymentProcessingService::extractPaymentStructure($validatedInputs);
            $refundedPayments = PaymentProcessingService::extractRefundedPayments($validatedInputs);
            ProcessPayment::dispatchAfterResponse(
                $validatedInputs['fund_released_date'],
                $paymentStructure,
                $projectInfo->Project_id,
                $refundedPayments
            );

            // Send project registration email
            Mail::to($user->email)->queue(new ProjectRegistration($user, $projectInfo, $initial_password));

            return [
                'status' => 'success',
                'message' => 'Project registered successfully. A notification has been sent to the Cooperator.'
            ];
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception('Error in Registering Existing Project: ' . $e->getMessage());
        }
    }

    /**
     * Send application form link to the user via email
     *
     * @param User $user The user to send the email to
     * @return void
     */
    public function sendApplicationFormThroughEmail(User $user): void
    {
        try {
            $applicationFormUrl = URL::signedRoute('application.form', $user->id);

            $mail = new SendApplicationFormLink(
                $user,
                $applicationFormUrl,
                $user->coopUserInfo
            );

            dispatch(function () use ($user, $mail) {
                Mail::to($user->email)->queue($mail);
            })->afterResponse();

            NotificationLog::create([
                'user_id' => $user->id,
                'reference_id' => $user->id,
                'reference_type' => 'User',
                'notification_type' => self::DRAFT_PREFIX . 'NOTIFIED',
                'sent_at' => now(),
            ]);

            Log::info("Application form link sent to user: {$user->email}");
        } catch (Exception $e) {
            Log::error("Failed to send application form link: {$e->getMessage()}", [
                'user_id' => $user->id,
                'email' => $user->email
            ]);

            throw new Exception("Failed to send application form link: {$e->getMessage()}");
        }
    }

    public function isApplicantNotified(int $user_id, string $type): bool
    {
        return NotificationLog::where('user_id', $user_id)
            ->where('notification_type', $type)
            ->exists();
    }

    public function getAddedApplicants(): Collection
    {
        return FormDraft::where('form_type', 'LIKE', self::DRAFT_PREFIX . '%')
            ->get()
            ->each(function ($draft) {
                $draft->is_notified = $this->isApplicantNotified($draft->owner_id, self::DRAFT_PREFIX . 'NOTIFIED');
                $draft->secure_form_link = URL::signedRoute('staff.Project.get.add.applicant-detailed-info-form', $draft->owner_id);
                $draft->secure_notify_link = URL::signedRoute('staff.Project.applicant-notify', $draft->owner_id);
                $draft->secure_delete_link = URL::signedRoute('staff.Project.delete-applicant', $draft->owner_id);
            });
    }

    public function deleteApplicantDraft(User $user): void
    {
        FormDraft::where('form_type', self::DRAFT_PREFIX . $user->id)
            ->where('owner_id', $user->id)
            ->delete();
    }

    private function updateDraftToSubmitted(User $user): void
    {
        FormDraft::where('form_type', self::DRAFT_PREFIX . $user->id)
            ->where('owner_id', $user->id)
            ->update(['is_submitted' => true]);
    }

    public function isAddedApplicantExist(): bool
    {
        return FormDraft::where('form_type', 'LIKE', self::DRAFT_PREFIX . '%')
            ->exists();
    }

    public function isApplicantHasAssistDraft(int $user_id): bool
    {
        return FormDraft::where('form_type', self::DRAFT_PREFIX . $user_id)
            ->where('owner_id', $user_id)
            ->exists();
    }

    public function getDraftType(int $user_id): string
    {
        return self::DRAFT_PREFIX . $user_id;
    }

    /**
     * Create a draft for applicant personal information
     *
     * @param User $user The user to create a draft for
     * @param array $validatedInputs The validated inputs
     * @return Void
     * @throws Exception If draft already exists
     */
    private function draftApplicantPersonalInfo(User $user, array $validatedInputs)
    {
        try {
            $draftType = self::DRAFT_PREFIX . $user->id;

            if (FormDraft::where('form_type', $draftType)
                ->where('owner_id', $user->id)
                ->exists()
            ) {
                throw new Exception('This draft already exists');
            }

            $draft = new FormDraft();
            $draft->form_type = $draftType;
            $draft->owner_id = $user->id;
            $draft->form_data = $validatedInputs;
            $draft->save();
        } catch (Exception $e) {
            throw $e;
        }
    }

    private function storeUserAddress(array $validatedInputs, int $userId): void
    {
        $region = $validatedInputs['home_region'];
        $province = $validatedInputs['home_province'];
        $city = $validatedInputs['home_city'];
        $barangay = $validatedInputs['home_barangay'];
        $landmark = $validatedInputs['home_landmark'];
        $zipcode = $validatedInputs['home_zipcode'];

        AddressInfo::updateOrCreate([
            'user_info_id' => $userId,
        ], [
            'region' => $region,
            'province' => $province,
            'city' => $city,
            'barangay' => $barangay,
            'landmark' => $landmark,
            'zip_code' => $zipcode
        ]);
    }



    /**
     * Store personal information in the database
     *
     * @param array $validatedInputs
     * @param string $user_name
     * @return CoopUserInfo
     */
    private function storePersonalInfo(array $validatedInputs, string $user_name): CoopUserInfo
    {
        $name_prefix = $validatedInputs['prefix'];
        $f_name = $validatedInputs['f_name'];
        $mid_name = $validatedInputs['mid_name'];
        $l_name = $validatedInputs['l_name'];
        $name_suffix = $validatedInputs['suffix'];
        $sex = $validatedInputs['sex'];
        $b_date = $validatedInputs['b_date'];
        $designation = $validatedInputs['designation'];
        $country_mobile_code = $validatedInputs['country_code'];
        $mobile_number = $validatedInputs['mobile_no'];
        $full_mobile_number = $country_mobile_code . $mobile_number;
        $landline = $validatedInputs['landline'];

        return CoopUserInfo::updateOrCreate([
            'user_name' => $user_name,
        ], [
            'prefix' => $name_prefix,
            'f_name' => $f_name,
            'mid_name' => $mid_name,
            'l_name' => $l_name,
            'suffix' => $name_suffix,
            'sex' => $sex,
            'birth_date' => $b_date,
            'designation' => $designation,
            'mobile_number' => $full_mobile_number,
            'landline' => $landline,
        ]);
    }

    /**
     * Store business information in the database
     *
     * @param array $validatedInputs
     * @param int $personalInfoId
     * @return array The business info including ID and location details
     */
    private function storeBusinessInfo(array $validatedInputs, int $personalInfoId): array
    {
        $firm_name = $validatedInputs['firm_name'];
        $enterprise_type = $validatedInputs['enterpriseType'];
        $enterprise_level = $validatedInputs['enterprise_level'];
        $year_established = $validatedInputs['year_established'];
        $permit_type = $validatedInputs['permit_type'];
        $business_permit_no = $validatedInputs['business_permit_no'];
        $permit_year_registered = $validatedInputs['permit_year_registered'];
        $registration_type = $validatedInputs['enterprise_registration_type'];
        $enterprise_registration_no = $validatedInputs['enterprise_registration_no'];
        $enterprise_year_registered = $validatedInputs['year_enterprise_registered'];
        $office_region = $validatedInputs['office_region'];
        $office_province = $validatedInputs['office_province'];
        $office_city = $validatedInputs['office_city'];
        $office_barangay = $validatedInputs['office_barangay'];
        $office_landmark = $validatedInputs['office_landmark'];
        $office_zipcode = $validatedInputs['office_zipcode'];
        $factory_region = $validatedInputs['factory_region'];
        $factory_province = $validatedInputs['factory_province'];
        $factory_city = $validatedInputs['factory_city'];
        $factory_barangay = $validatedInputs['factory_barangay'];
        $factory_landmark = $validatedInputs['factory_landmark'];
        $factory_zipcode = $validatedInputs['factory_zipcode'];
        $office_telNo = $validatedInputs['office_telNo'];
        $office_faxNo = $validatedInputs['office_faxNo'];
        $office_emailAddress = $validatedInputs['office_emailAddress'];
        $factory_telNo = $validatedInputs['factory_telNo'];
        $factory_faxNo = $validatedInputs['factory_faxNo'];
        $factory_emailAddress = $validatedInputs['factory_emailAddress'];
        $sectors = $validatedInputs['sectors'];
        $export_market = json_encode($validatedInputs['exportMarket'] ?? []);
        $local_market = json_encode($validatedInputs['localMarket'] ?? []);

        $businessInfo = BusinessInfo::updateOrCreate([
            'user_info_id' => $personalInfoId,
            'firm_name' => $firm_name,
        ], [
            'enterprise_type' => $enterprise_type,
            'enterprise_level' => $enterprise_level,
            'year_established' => $year_established,
            'permit_type' => $permit_type,
            'business_permit_no' => $business_permit_no,
            'permit_year_registered' => $permit_year_registered,
            'registration_type' => $registration_type,
            'enterprise_registration_no' => $enterprise_registration_no,
            'enterprise_year_registered' => $enterprise_year_registered,
            'office_telephone' => $office_telNo,
            'office_fax_no' => $office_faxNo,
            'office_email' => $office_emailAddress,
            'factory_telephone' => $factory_telNo,
            'factory_fax_no' => $factory_faxNo,
            'factory_email' => $factory_emailAddress,
            'sectors' => $sectors,
            'Export_Mkt_Outlet' => $export_market,
            'Local_Mkt_Outlet' => $local_market,
        ]);

        $businessInfo->addressInfo()->create([
            'business_info_id' => $businessInfo->id,
            'office_landmark' => $office_landmark,
            'office_barangay' => $office_barangay,
            'office_city' => $office_city,
            'office_province' => $office_province,
            'office_region' => $office_region,
            'office_zip_code' => $office_zipcode,
            'factory_landmark' => $factory_landmark,
            'factory_barangay' => $factory_barangay,
            'factory_city' => $factory_city,
            'factory_province' => $factory_province,
            'factory_region' => $factory_region,
            'factory_zip_code' => $factory_zipcode,
        ]);

        return [
            'businessId' => $businessInfo->id,
            'enterprise_type' => $enterprise_type,
            'enterprise_level' => $enterprise_level,
        ];
    }

    /**
     * Store assets information in the database
     *
     * @param array $validatedInputs
     * @param int $businessId
     * @return bool
     */
    private function storeAssets(array $validatedInputs, int $businessId): bool
    {
        $building_value = str_replace(',', '', ($validatedInputs['buildings']));
        $equipment_value = str_replace(',', '', ($validatedInputs['equipments']));
        $working_capital = str_replace(',', '', ($validatedInputs['working_capital']));

        return Assets::insert([
            'id' => $businessId,
            'building_value' => $building_value,
            'equipment_value' => $equipment_value,
            'working_capital' => $working_capital,
        ]);
    }

    /**
     * Store personnel information in the database
     *
     * @param array $validatedInputs
     * @param int $businessId
     * @return void
     */
    private function storePersonnel(array $validatedInputs, int $businessId): void
    {
        $m_personnelDiRe = $validatedInputs['m_personnelDiRe'];
        $f_personnelDiRe = $validatedInputs['f_personnelDiRe'];
        $m_personnelDiPart = $validatedInputs['m_personnelDiPart'];
        $f_personnelDiPart = $validatedInputs['f_personnelDiPart'];
        $m_personnelIndRe = $validatedInputs['m_personnelIndRe'];
        $f_personnelIndRe = $validatedInputs['f_personnelIndRe'];
        $m_personnelIndPart = $validatedInputs['m_personnelIndPart'];
        $f_personnelIndPart = $validatedInputs['f_personnelIndPart'];

        Personnel::updateOrCreate([
            'id' => $businessId,
        ], [
            'male_direct_re' => $m_personnelDiRe,
            'female_direct_re' => $f_personnelDiRe,
            'male_direct_part' => $m_personnelDiPart,
            'female_direct_part' => $f_personnelDiPart,
            'male_indirect_re' => $m_personnelIndRe,
            'female_indirect_re' => $f_personnelIndRe,
            'male_indirect_part' => $m_personnelIndPart,
            'female_indirect_part' => $f_personnelIndPart,
        ]);
    }

    /**
     * Create a new application record in the database
     *
     * @param int $businessId
     * @param bool $isAssistedBy optional
     * @param int $assistedBy optional
     * @return int The application record
     */
    private function createApplicationRecord(
        int $businessId,
        ?bool $isAssisted = false,
        ?int $assistedBy = null,
        ?string $applicationStatus = 'new',
        ?string $projectId = null,
        ?string $requestedFundAmount = null
    ): int {
        $applicationInfo = ApplicationInfo::create([
            'Project_id' => $projectId,
            'business_id' => $businessId,
            'is_assisted' => $isAssisted,
            'application_status' => $applicationStatus,
            'requested_fund_amount' => $requestedFundAmount,
            'assisted_by' => $assistedBy,
        ]);

        return $applicationInfo->id;
    }

    /**
     * Store project information in the database
     *
     * @param array $validatedInputs
     * @param int $businessId
     * @param int|null $Staff_ID
     * @return ProjectInfo
     */
    private function storeProjectInfo(array $validatedInputs, int $businessId, ?int $Staff_ID = null): ProjectInfo
    {
        $projectId = $validatedInputs['project_id'];
        $project_title = $validatedInputs['project_title'];
        $funded_amount = $validatedInputs['funded_amount'];
        $fee_amount = $validatedInputs['fee_percentage'];
        $project_duration = $validatedInputs['project_duration'];
        $fund_released_date = $validatedInputs['fund_released_date'];

        return ProjectInfo::create([
            'Project_id' => $projectId,
            'business_id' => $businessId,
            'evaluated_by_id' => $Staff_ID,
            'handled_by_id' => $Staff_ID,
            'project_title' => $project_title,
            'project_duration' => $project_duration,
            'fund_released_date' => $fund_released_date,
            'fund_amount' => $funded_amount,
            'actual_amount_to_be_refund' => $funded_amount,
            'fee_applied' => $fee_amount,
        ]);
    }

    /**
     * Initialize the application process form container
     *
     * @param int $business_id
     * @param int $application_id
     * @return void
     * @throws Exception
     */
    public function initializeApplicationProcessFormContainer(int $business_id, int $application_id): void
    {
        try {
            $initialData = json_encode([
                'business_id' => $business_id,
                'application_id' => $application_id
            ]);

            $formsToCreate = [
                [
                    'business_id' => $business_id,
                    'application_id' => $application_id,
                    'key' => 'tna_form',
                    'data' => $initialData
                ],
                [
                    'business_id' => $business_id,
                    'application_id' => $application_id,
                    'key' => 'project_proposal_form',
                    'data' => $initialData
                ],
                [
                    'business_id' => $business_id,
                    'application_id' => $application_id,
                    'key' => 'rtec_report_form',
                    'data' => $initialData
                ]
            ];

            ApplicationForm::insert($formsToCreate);
        } catch (Exception $e) {
            throw new Exception("Failed to initialize application process form container: " . $e->getMessage());
        }
    }
}
