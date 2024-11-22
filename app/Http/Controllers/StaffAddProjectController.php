<?php

namespace App\Http\Controllers;

use App\Events\NewApplicant;
use App\Events\ProjectEvent;
use App\Mail\NewProjectRegistered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\NewRegistrationRequest;

class StaffAddProjectController extends Controller
{
  /**
   * Generate a unique and memorable username based on the first name
   * 
   * @param string $firstName
   * @return string
   */
  private function generateUniqueUsername(string $firstName): string
  {
      // Sanitize the first name (remove special characters, convert to lowercase)
      $cleanFirstName = strtolower(preg_replace('/[^a-zA-Z]/', '', $firstName));
      
      // Get current year
      $currentYear = date('Y');
      
      // Generate a random 4-digit number
      $randomSuffix = str_pad(mt_rand(1, 9999), 4, '0', STR_PAD_LEFT);
      
      // Combine first name, year, and random number
      $baseUsername = "{$cleanFirstName}{$currentYear}-{$randomSuffix}";
      
      // Check if username already exists
      $existingUser = DB::table('coop_users_info')
          ->where('user_name', $baseUsername)
          ->first();
      
      // If username exists, regenerate
      if ($existingUser) {
          return $this->generateUniqueUsername($firstName);
      }
      
      return $baseUsername;
  }
    public function store(NewRegistrationRequest $request)
    {
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

            $user_name = $this->generateUniqueUsername($f_name);

            // Use birthdate as initial password
            $initial_password = str_replace('-', '', $b_date);

            DB::table('users')->insert([
                'user_name' => $user_name,
                'email' => $validatedInputs['email'],
                'password' => Hash::make($initial_password),
                'role' => 'Cooperator',
                'must_change_password' => true, // New flag to force password change
            ]);

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
            $region = $validatedInputs['region'];
            $province = $validatedInputs['province'];
            $city = $validatedInputs['city'];
            $barangay = $validatedInputs['barangay'];
            $landmark = $validatedInputs['Landmark'];
            $zip_code = $validatedInputs['zipcode'];
            $export_market = $validatedInputs['Export'];
            $local_market = $validatedInputs['Local'];

            $businessId = DB::table('business_info')->insertGetId([
                'user_info_id' => $personalInfoId,
                'firm_name' => $firm_name,
                'enterprise_type' => $enterprise_type,
                'enterprise_level' => $enterprise_level,
                'zip_code' => $zip_code,
                'landmark' => $landmark,
                'barangay' => $barangay,
                'city' => $city,
                'province' => $province,
                'region' => $region,
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

            $file_to_insert = [
                'IntentFilePath' => $validatedInputs['Intent_unique_id_path'] ?? null,
                'DSCFilePath' => $validatedInputs['DTI_SEC_CDA_unique_id_path'] ?? null,
                'businessPermitFilePath' => $validatedInputs['BusinessPermit_unique_id_path'] ?? null,
                'FDA_LTOFilePath' => $validatedInputs['FDA_LTO_unique_id_path'] ?? null,
                'receiptFilePath' => $validatedInputs['receipt_unique_id_path'] ?? null,
                'govFilePath' => $validatedInputs['govId_unique_id_path'] ?? null,
                'BIRFilePath' => $validatedInputs['BIR_unique_id_path'] ?? null
            ];

            Log::info($file_to_insert);

            $fileNames = [
                'IntentFilePath' => 'Intent File',
                'businessPermitFilePath' => 'Business Permit',
                'receiptFilePath' => 'Receipt',
                'BIRFilePath' => 'BIR'
            ];

            $DSC_file_Name_Selector = $validatedInputs['DSC_file_Selector'] ?? null;
            $fda_lto_Name_Selector = $validatedInputs['Fda_Lto_Selector'] ?? null;
            $govId_Selector = $validatedInputs['GovIdSelector'] ?? null;

            $fileNames['DSCFilePath'] = $DSC_file_Name_Selector;
            $fileNames['FDA_LTOFilePath'] = $fda_lto_Name_Selector;
            $fileNames['govFilePath'] = $govId_Selector;

            foreach($file_to_insert as $filekey => $filePath){
                // Skip if filePath is null
                if ($filePath === null) continue;

                if(Storage::disk('public')->exists($filePath))
                {
                    $fileName = $fileNames[$filekey];
                    $fileExtension = pathinfo($filePath, PATHINFO_EXTENSION);

                    DB::table('requirements')->insert([
                        'business_id' => $businessId,
                        'file_name' => $fileName,
                        'file_link' => $filePath,
                        'file_type' => $fileExtension,
                        'can_edit' => false,
                        'remarks' => 'Pending',
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }else{
                    Log::warning("File $fileNames[$filekey] does not exist at path: $filePath");
                }
            }

            $successful_inserts++;


            // Requirements table
            DB::table('application_info')->insert([
                'business_id' => $businessId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            $successful_inserts++;

            if ($successful_inserts == 6) {
                DB::commit();
                
                // Send welcome email to the new user
                $user = DB::table('users')->where('user_name', $user_name)->first();
                Mail::to($validatedInputs['email'])->send(new NewProjectRegistered($user, $initial_password));
                
                event(new ProjectEvent($businessId, $enterprise_type, $enterprise_level, $city, 'NEW_APPLICANT'));
                return response()->json(['success' => 'All data successfully saved.'], 200);
            } else {
                DB::rollBack();
                return response()->json(['error' => 'Data insertion failed.'], 500);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Application Submission Error: ' . $e->getMessage());
            return response()->json(['error' => 'An unexpected error occurred.', 'details' => $e->getMessage()], 500);
        }
    }
}
