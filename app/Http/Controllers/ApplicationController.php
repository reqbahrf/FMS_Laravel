<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;



class ApplicationController extends Controller
{


    public function store(Request $request)
    {
         $user_name = Session::get('user_name');

        $successful_inserts = 0;

        DB::beginTransaction();

        try {
            // Personal Info table
            $name_prefix = ($request->input('prefix'));
            $f_name = ($request->input('f_name'));
            $mid_name = ($request->input('middle_name'));
            $l_name = ($request->input('l_name'));
            $name_suffix = ($request->input('suffix'));
            $gender = ($request->input('gender'));
            $b_date = ($request->input('b_date'));
            $date = \DateTime::createFromFormat('m/d/Y', $b_date);
            $formatted_date = $date->format('Y-m-d');
            $designation = ($request->input('designation'));
            $mobile_number = ($request->input('Mobile_no'));
            $landline = ($request->input('landline'));
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
            $firm_name = ($request->input('firm_name'));
            $enterprise_type = ($request->input('enterpriseType'));
            $enterprise_level = ($request->input('enterprise_level'));
            $region = ($request->input('region'));
            $province = ($request->input('province'));
            $city = ($request->input('city'));
            $barangay = ($request->input('barangay'));
            $landmark = ($request->input('Landmark'));
            $export_market = ($request->input('Export'));
            $local_market = ($request->input('Local'));

            $businessId = DB::table('business_info')->insertGetId([
                'user_info_id' => $personalInfoId,
                'firm_name' => $firm_name,
                'enterprise_type' => $enterprise_type,
                'enterprise_level' => $enterprise_level,
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
            $building_value = str_replace(',', '', ($request->input('buildings')));
            $equipment_value = str_replace(',', '', ($request->input('equipments')));
            $working_capital = str_replace(',', '', ($request->input('working_capital')));

            DB::table('assets')->insert([
                'id' => $businessId,
                'building_value' => $building_value,
                'equipment_value' => $equipment_value,
                'working_capital' => $working_capital,
            ]);
            $successful_inserts++;

            // Personnel table
            $m_personnelDiRe = $request->input('m_personnelDiRe');
            $f_personnelDiRe = $request->input('f_personnelDiRe');
            $m_personnelDiPart = $request->input('m_personnelDiPart');
            $f_personnelDiPart = $request->input('f_personnelDiPart');
            $m_personnelIndRe = $request->input('m_personnelIndRe');
            $f_personnelIndRe = $request->input('f_personnelIndRe');
            $m_personnelIndPart = $request->input('m_personnelIndPart');
            $f_personnelIndPart = $request->input('f_personnelIndPart');

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
                return redirect()->back()->with('success', 'All data successfully inserted.');
            } else {
                DB::rollBack();
                return redirect()->back()->withInput()->with('error', 'Data insertion failed.');
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function upload_requirments(Request $request)
    {
        // $businessId = session('business_id');
        $businessId = 27;

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
