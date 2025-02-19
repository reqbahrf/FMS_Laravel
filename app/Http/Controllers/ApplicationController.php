<?php

namespace App\Http\Controllers;

use App\Events\ProjectEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\NewRegistrationRequest;
use App\Models\ApplicationForm;
use App\Services\TNAdataHandlerService;
use App\Services\ApplicantFileHandlerService;
use Exception;

class ApplicationController extends Controller
{
    public function __construct(
        private ApplicationForm $applicationForm,
        private TNAdataHandlerService $TNAdataHandlerService,
        private ApplicantFileHandlerService $FileHandler
    ) {}

    //Remove The NewRegistrationRequest Do do some testing
    public function store(NewRegistrationRequest $request)
    {

        $user_name = Auth::user()->user_name;

        $successful_inserts = 0;

        $validatedInputs = $request->validated();

        DB::beginTransaction();

        try {
            // Personal Info table
            $name_prefix = $validatedInputs['prefix'];
            $f_name = $validatedInputs['f_name'];
            $mid_name = $validatedInputs['middle_name'];
            $l_name = $validatedInputs['l_name'];
            $name_suffix = $validatedInputs['suffix'];
            $sex = $validatedInputs['sex'];
            $b_date = $validatedInputs['b_date'];
            $designation = $validatedInputs['designation'];
            $country_mobile_code = $validatedInputs['country_code'];
            $mobile_number = $validatedInputs['Mobile_no'];
            $full_mobile_number = $country_mobile_code . $mobile_number;
            $landline = $validatedInputs['landline'];
            $personalInfoId = DB::table('coop_users_info')->insertGetId([
                'user_name' => $user_name,
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
            $successful_inserts++;
            // Business Info table
            $firm_name = $validatedInputs['firm_name'];
            $enterprise_type = $validatedInputs['enterpriseType'];
            $enterprise_level = ($request->input('enterprise_level'));
            $office_region = $validatedInputs['officeRegion'];
            $office_province = $validatedInputs['officeProvince'];
            $office_city = $validatedInputs['officeCity'];
            $office_barangay = $validatedInputs['officeBarangay'];
            $office_landmark = $validatedInputs['officeLandmark'];
            $office_zipcode = $validatedInputs['officeZipcode'];
            $export_market = json_encode($validatedInputs['exportMarket']);
            $local_market = json_encode($validatedInputs['localMarket']);

            $businessId = DB::table('business_info')->insertGetId([
                'user_info_id' => $personalInfoId,
                'firm_name' => $firm_name,
                'enterprise_type' => $enterprise_type,
                'enterprise_level' => $enterprise_level,
                'zip_code' => $office_zipcode,
                'landmark' => $office_landmark,
                'barangay' => $office_barangay,
                'city' => $office_city,
                'province' => $office_province,
                'region' => $office_region,
                'Export_Mkt_Outlet' => $export_market,
                'Local_Mkt_Outlet' => $local_market,
            ]);

            $successful_inserts++;

            // Assets table
            $building_value = str_replace(',', '', ($validatedInputs['buildings']));
            $equipment_value = str_replace(',', '', ($validatedInputs['equipments']));
            $working_capital = str_replace(',', '', ($validatedInputs['working_capital']));

            DB::table('assets')->insert([
                'id' => $businessId,
                'building_value' => $building_value,
                'equipment_value' => $equipment_value,
                'working_capital' => $working_capital,
            ]);
            $successful_inserts++;

            // Personnel table
            $m_personnelDiRe = $validatedInputs['m_personnelDiRe'];
            $f_personnelDiRe = $validatedInputs['f_personnelDiRe'];
            $m_personnelDiPart = $validatedInputs['m_personnelDiPart'];
            $f_personnelDiPart = $validatedInputs['f_personnelDiPart'];
            $m_personnelIndRe = $validatedInputs['m_personnelIndRe'];
            $f_personnelIndRe = $validatedInputs['f_personnelIndRe'];
            $m_personnelIndPart = $validatedInputs['m_personnelIndPart'];
            $f_personnelIndPart = $validatedInputs['f_personnelIndPart'];

            DB::table('personnel')->insert([
                'id' => $businessId,
                'male_direct_re' => $m_personnelDiRe,
                'female_direct_re' => $f_personnelDiRe,
                'male_direct_part' => $m_personnelDiPart,
                'female_direct_part' => $f_personnelDiPart,
                'male_indirect_re' => $m_personnelIndRe,
                'female_indirect_re' => $f_personnelIndRe,
                'male_indirect_part' => $m_personnelIndPart,
                'female_indirect_part' => $f_personnelIndPart,
            ]);
            $successful_inserts++;

            // $IntentFileID = $validatedInputs['IntentFile'];
            // $DTI_SEC_CDA_FileID = $validatedInputs['DTI_SEC_CDA_File'];
            // $businessPermitFileID = $validatedInputs['businessPermitFile'];
            // $FDA_LTO_FileID = $validatedInputs['fdaLtoFile'];
            // $receiptFileID = $validatedInputs['receiptFile'];
            // $govFileID = $validatedInputs['govIdFile'];

            $this->FileHandler->storeFile($validatedInputs, $businessId, $firm_name);

            $successful_inserts++;


            // Requirements table
            $applicationId = DB::table('application_info')->insertGetId([
                'business_id' => $businessId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            $successful_inserts++;

            if ($successful_inserts == 6) {
                $this->initializeApplicationProcessFormContainer($businessId, $applicationId);
                $this->TNAdataHandlerService->setTNAData($validatedInputs, $businessId, $applicationId);
                DB::commit();

                $location = [
                    'region' => $office_region,
                    'province' => $office_province,
                    'city' => $office_city,
                    'barangay' => $office_barangay,
                ];
                //Testing this defer Method
                event(new ProjectEvent(
                    $businessId,
                    $enterprise_type,
                    $enterprise_level,
                    $location,
                    'NEW_APPLICANT'
                ));
                Cache::forget('applicants');
                return response()->json(['success' => 'All data successfully saved.', 'redirect' => route('Cooperator.index')], 200);
            } else {
                DB::rollBack();
                throw new Exception("Data insertion failed: Only {$successful_inserts} of 6 required insertions completed successfully.");
            }
        } catch (Exception $e) {
            DB::rollBack();
            Log::error("Error inserting data:", ['error' => $e->getMessage()]);
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    private function initializeApplicationProcessFormContainer(int $business_id, int $application_id)
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
