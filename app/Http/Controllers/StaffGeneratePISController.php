<?php

namespace App\Http\Controllers;

use App\Models\projectInfo;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Mpdf\Mpdf;

class StaffGeneratePISController extends Controller
{
    //TODO: Improve this query to be more efficient
    public function index(Request $request)
    {
        $validated = $request->validate([
            'project_id' => 'required|string|max:15',
            'business_id' => 'required|integer',
        ]);

        $project = projectInfo::join('business_info', 'project_info.business_id', '=', 'business_info.id')
            ->join('coop_users_info', 'coop_users_info.id', '=', 'business_info.user_info_id')
            ->join('users' , 'users.user_name' , '=' , 'coop_users_info.user_name')
            ->select('Project_id', 'project_title', 'business_id', 'firm_name', 'enterprise_type' ,'zip_code', 'landMark', 'barangay', 'city', 'province', 'region', 'f_name', 'mid_name', 'l_name', 'suffix', 'gender', 'birth_date', 'mobile_number', 'landline', 'email')
            ->where('project_info.Project_id', $validated['project_id'])
            ->where('business_info.id', $validated['business_id'])
            ->firstOrFail();




        // TODO: change some of the content text alignment on this view InformationSheet
        $html = view('staffView.outputs.InformationSheetTable', ['projectData' => $project])->render();
        $mpdf = new Mpdf([
            'mode' => 'utf-8',
            'format' => 'A4',
            'orientation' => 'P',
            'margin_top' => 5,
            'margin_bottom' => 5,
            'margin_left' => 5,
            'margin_right' => 5
        ]);
        $mpdf->WriteHTML($html);
        $mpdf->Output('hello.pdf', 'D'); // Download the PDF with the filename hello.pdf

    }

}
