<?php

namespace App\Http\Controllers;

use Exception;
use Mpdf\Mpdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AdminReportController extends Controller
{
    protected $adminViewController;

    public function __construct(AdminViewController $adminViewController)
    {
        $this->adminViewController = $adminViewController;
    }

    public function generatePDFReport(Request $request)
    {
        try {
            // Get chart data from AdminViewController
            $chartData = $this->adminViewController->getDashboardChartData($request)->getData(true);

            // Process the data
            $report = $this->processReportData($chartData);
            $docHeader = view('StaffView.outputs.DocHeader')->render();

            // Generate PDF
            $mpdf = new Mpdf([
                'mode' => 'utf-8',
                'format' => 'A4',
                'orientation' => 'P',
                'margin_left' => 10,
                'margin_right' => 10,
                'margin_top' => 40,
                'margin_bottom' => 10,
                'margin_header' => 10,
                'margin_footer' => 10,
                'default_font_size' => 9,
                'default_font' => 'arial'
            ]);

            // Set document information
            $mpdf->SetHTMLHeader($docHeader);
            $mpdf->SetCreator('FMS System');
            $mpdf->SetAuthor('Admin');
            $mpdf->SetTitle('Dashboard Report ' . date('Y-m-d'));

            // Generate HTML content
            $html = $this->generateReportHTML($report);

            // Write HTML to PDF
            $mpdf->WriteHTML($html);

            // Output PDF
            return response($mpdf->Output('dashboard-report.pdf', 'S'), 200, [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'attachment; filename="dashboard-report' . date("Y") . '.pdf"'          ]);
        } catch (Exception $e) {
            Log::error('Error generating PDF report: ' . $e->getMessage());
            return response()->json([
                'message' => 'Error generating PDF report',
            ], 500);
        }
    }

    private function processReportData($chartData)
    {
        $report = [
            'monthly_statistics' => [],
            'location_statistics' => [],
            'staff_performance' => [],
            'summary' => []
        ];

        // Process Monthly Data
        $monthlyData = json_decode($chartData['monthlyData'][0], true);
        foreach ($monthlyData as $month => $data) {
            $report['monthly_statistics'][] = [
                'month' => $month,
                'total_applicants' => $data['Applicants'],
                'ongoing_projects' => $data['Ongoing'],
                'completed_projects' => $data['Completed'],
                'total_projects' => $data['Ongoing'] + $data['Completed']
            ];
        }

        // Process Location Data
        $localData = json_decode($chartData['localData'][0], true);
        foreach ($localData as $location => $data) {
            $report['location_statistics'][] = [
                'location' => $location,
                'micro_enterprises' => $data['Micro Enterprise'],
                'small_enterprises' => $data['Small Enterprise'],
                'medium_enterprises' => $data['Medium Enterprise'],
                'total_enterprises' => $data['Micro Enterprise'] + $data['Small Enterprise'] + $data['Medium Enterprise']
            ];
        }

        // Process Staff Data
        foreach ($chartData['staffhandledProjects'] as $staff) {
            $totalProjects = $staff['Micro Enterprise'] + $staff['Small Enterprise'] + $staff['Medium Enterprise'];
            $report['staff_performance'][] = [
                'staff_name' => trim($staff['Staff_Name']),
                'micro_enterprises' => $staff['Micro Enterprise'],
                'small_enterprises' => $staff['Small Enterprise'],
                'medium_enterprises' => $staff['Medium Enterprise'],
                'total_handled_projects' => $totalProjects
            ];
        }

        // Calculate Summary Statistics
        $report['summary'] = [
            'total_applicants' => collect($report['monthly_statistics'])->sum('total_applicants'),
            'total_ongoing' => collect($report['monthly_statistics'])->sum('ongoing_projects'),
            'total_completed' => collect($report['monthly_statistics'])->sum('completed_projects'),
            'total_locations' => count($report['location_statistics']),
            'total_active_staff' => count(array_filter($report['staff_performance'], function ($staff) {
                return $staff['total_handled_projects'] > 0;
            }))
        ];

        return $report;
    }

    private function generateReportHTML($report)
    {
        $html = '
        <style>
            body { font-family: arial, sans-serif; }
            .header { text-align: center; margin-bottom: 15pt; }
            .section { margin-bottom: 22.5pt; }
            .section-title { font-size: 13.5pt; font-weight: bold; margin-bottom: 7.5pt; }
            .section table { width: 100%; border-collapse: collapse; margin-bottom: 15pt; }
            .section table th,
            .section table td { border: 0.75pt solid #ddd; padding: 6pt; text-align: left; }
            .section table th { background-color: #f2f2f2; }
        </style>

        <div class="header">
            <h1>Dashboard Report</h1>
            <p>Generated on: ' . date('Y-m-d g:i:s A') . '</p>
        </div>';

        // Summary Section
        $html .= '
        <div class="section">
            <div class="section-title">Summary</div>
            <table>
                <tr>
                    <th>Total Applicants</th>
                    <th>Total Ongoing Projects</th>
                    <th>Total Completed Projects</th>
                    <th>Total Locations</th>
                    <th>Active Staff</th>
                </tr>
                <tr>
                    <td>' . $report['summary']['total_applicants'] . '</td>
                    <td>' . $report['summary']['total_ongoing'] . '</td>
                    <td>' . $report['summary']['total_completed'] . '</td>
                    <td>' . $report['summary']['total_locations'] . '</td>
                    <td>' . $report['summary']['total_active_staff'] . '</td>
                </tr>
            </table>
        </div>';

        // Monthly Statistics
        $html .= '
        <div class="section">
            <div class="section-title">Monthly Statistics</div>
            <table>
                <tr>
                    <th>Month</th>
                    <th>Applicants</th>
                    <th>Ongoing Projects</th>
                    <th>Completed Projects</th>
                    <th>Total Projects</th>
                </tr>';

        foreach ($report['monthly_statistics'] as $monthly) {
            $html .= '
                <tr>
                    <td>' . $monthly['month'] . '</td>
                    <td>' . $monthly['total_applicants'] . '</td>
                    <td>' . $monthly['ongoing_projects'] . '</td>
                    <td>' . $monthly['completed_projects'] . '</td>
                    <td>' . $monthly['total_projects'] . '</td>
                </tr>';
        }
        $html .= '</table></div>';

        // Location Statistics
        $html .= '
        <div class="section">
            <div class="section-title">Location Statistics</div>
            <table>
                <tr>
                    <th>Location</th>
                    <th>Micro Enterprises</th>
                    <th>Small Enterprises</th>
                    <th>Medium Enterprises</th>
                    <th>Total Enterprises</th>
                </tr>';

        foreach ($report['location_statistics'] as $location) {
            $html .= '
                <tr>
                    <td>' . $location['location'] . '</td>
                    <td>' . $location['micro_enterprises'] . '</td>
                    <td>' . $location['small_enterprises'] . '</td>
                    <td>' . $location['medium_enterprises'] . '</td>
                    <td>' . $location['total_enterprises'] . '</td>
                </tr>';
        }
        $html .= '</table></div>';

        // Staff Performance
        $html .= '
        <div class="section">
            <div class="section-title">Staff Performance</div>
            <table>
                <tr>
                    <th>Staff Name</th>
                    <th>Micro Enterprises</th>
                    <th>Small Enterprises</th>
                    <th>Medium Enterprises</th>
                    <th>Total Projects</th>
                </tr>';

        foreach ($report['staff_performance'] as $staff) {
            $html .= '
                <tr>
                    <td>' . $staff['staff_name'] . '</td>
                    <td>' . $staff['micro_enterprises'] . '</td>
                    <td>' . $staff['small_enterprises'] . '</td>
                    <td>' . $staff['medium_enterprises'] . '</td>
                    <td>' . $staff['total_handled_projects'] . '</td>
                </tr>';
        }
        $html .= '</table></div>';

        return $html;
    }
}
