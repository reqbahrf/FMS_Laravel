<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreApplicationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;



class ApplicationController extends Controller
{


    public function store(StoreApplicationRequest $request)
    {
         $user_name = Session::get('user_name');

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
            $date = \DateTime::createFromFormat('Y/m/d', $b_date);
            $formatted_date = $date->format('Y-m-d');
            $designation = $validatedInputs['designation'];
            $mobile_number = $validatedInputs['Mobile_no'];
            $landline = $validatedInputs['landline'];
            $personalInfoId = DB::table('coop_users_info')->insertGetId([
                'user_name' => $user_name,
                'prefix' => $name_prefix,
                'f_name' => $f_name,
                'mid_name' => $mid_name,
                'l_name' => $l_name,
                'suffix' => $name_suffix,
                'gender' => $gender,
                'birth_date' => $formatted_date,
                'designation' => $designation,
                'mobile_number' => $mobile_number,
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

            foreach ($request->file() as $file) {
                $filePaths[$file->getClientOriginalName()] = $file->store("temp/$businessId", ['disk' => 'public']);
            }

            // Requirements table
            DB::table('application_info')->insert([
                'business_id' => $businessId,
            ]);
            $successful_inserts++;

            if ($successful_inserts == 5) {
                DB::commit();
                return response()->json(['success' => 'All data successfully inserted.']);
            } else {
                DB::rollBack();
                return response()->json(['error' => 'Data insertion failed.']);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }

    public function upload_requirments(Request $request)
    {
        $businessId = session('business_id');

        $filePaths = [];

       foreach ($request->file() as $fieldName => $file) {
           $uniqueId = $businessId . '_' . uniqid();
           $fileName = $file->getClientOriginalName();
           $filePaths[$fieldName] = $file->store("temp/$uniqueId/$fileName", ['disk' => 'public']);
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

        // Resolve the full file path
        $fullPath = storage_path('app/public/' . $filePath);
        Log::info('Full file path: ' . $fullPath);

        if (file_exists($fullPath)) {
            unlink($fullPath);
            Log::info('File deleted: ' . $fullPath);

            return response()->json(['status' => 'success'], 200);
        }

        Log::error('File not found: ' . $fullPath);
        return response()->json(['status' => 'error', 'message' => 'File not found'], 404);
    }
}
