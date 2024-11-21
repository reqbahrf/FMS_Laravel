<?php

namespace App\Http\Controllers;

use App\Events\NewApplicant;
use App\Events\ProjectEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreApplicationRequest;



class ApplicationController extends Controller
{


    public function store(StoreApplicationRequest $request)
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
            $gender = $validatedInputs['gender'];
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
                'gender' => $gender,
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

            // $IntentFileID = $validatedInputs['IntentFile'];
            // $DTI_SEC_CDA_FileID = $validatedInputs['DTI_SEC_CDA_File'];
            // $businessPermitFileID = $validatedInputs['businessPermitFile'];
            // $FDA_LTO_FileID = $validatedInputs['fdaLtoFile'];
            // $receiptFileID = $validatedInputs['receiptFile'];
            // $govFileID = $validatedInputs['govIdFile'];



            $file_to_insert = [

                'IntentFilePath' => $validatedInputs['Intent_unique_id_path'],
                'DSCFilePath' => $validatedInputs['DTI_SEC_CDA_unique_id_path'],
                'businessPermitFilePath' => $validatedInputs['BusinessPermit_unique_id_path'],
                'FDA_LTOFilePath' => $validatedInputs['FDA_LTO_unique_id_path'],
                'receiptFilePath' => $validatedInputs['receipt_unique_id_path'],
                'govFilePath' => $validatedInputs['govId_unique_id_path'],
                'BIRFilePath' => $validatedInputs['BIR_unique_id_path']
            ];

            Log::info($file_to_insert);

            $fileNames = [
                'IntentFilePath' => 'Intent File',
                'businessPermitFilePath' => 'Business Permit',
                'receiptFilePath' => 'Receipt',
                'BIRFilePath' => 'BIR'
            ];

            $DSC_file_Name_Selector = $validatedInputs['DSC_file_Selector'];
            $fda_lto_Name_Selector = $validatedInputs['Fda_Lto_Selector'];
            $govId_Selector = $validatedInputs['GovIdSelector'];

            $fileNames['DSCFilePath'] = $DSC_file_Name_Selector;
            $fileNames['FDA_LTOFilePath'] = $fda_lto_Name_Selector;
            $fileNames['govFilePath'] = $govId_Selector;

            foreach($file_to_insert as $filekey => $filePath){
                if(Storage::disk('public')->exists($filePath))
                {
                    // $directoryUniquePath = $firm_name . '-' . now()->format('Y-m-d');
                    $fileName = $fileNames[$filekey];
                    $fileExtension = pathinfo($filePath, PATHINFO_EXTENSION);

                    // $final_Directory = 'File_Requirements' . '/'. $directoryUniquePath .'/' . $fileName . '.' . $fileExtension;
                    // Storage::disk('public')->move($filePath, Storage::disk('private')->path($final_Directory));

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
                    return response()->json(['error' => "This file $fileNames[$filekey] does not exist"], 404);
                };

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
                event(new ProjectEvent($businessId, $enterprise_type, $enterprise_level, $city, 'NEW_APPLICANT'));
                return response()->json(['success' => 'All data successfully saved.', 'redirect' => route('Cooperator.index')], 200);
            } else {
                DB::rollBack();
                return response()->json(['error' => 'Data insertion failed.'], 500);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return response()->json(['error' => 'An error occurred']);
        }
    }

    public function upload_requirments(Request $request)
    {
        $uniqueId = '_' . uniqid();

        $filePaths = [];

       foreach ($request->file() as $fieldName => $file) {

           $fileName = $file->hashName();
           $filePaths[$fieldName] = $file->storeAs("temp/$uniqueId", $fileName, 'public');
       }

        return response()->json([
            'unique_id' => $uniqueId,
            'file_paths' => $filePaths,
        ]);
    }

    public function revertFile($uniqueId, Request $request)
    {
        Log::info('revertFile called with uniqueId: ' . $uniqueId);

        // Retrieve the file path from the request
        $filePath = $request->input('file_path');
        Log::info('File path: ' . $filePath);


        if (Storage::disk('public')->exists($filePath)) {
            Storage::disk('public')->delete($filePath);
            Log::info('File deleted: ' . $filePath);

            return response()->json(['status' => 'success', 'ok' => 'true'], 200);
        }

        Log::error('File not found: ' . $filePath);
        return response()->json(['status' => 'error', 'message' => 'File not found'], 404);
    }
}
