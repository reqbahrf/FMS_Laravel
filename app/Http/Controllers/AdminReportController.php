<?php

namespace App\Http\Controllers;

use App\Services\AdminDashboardService;
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

    public function generatePDFReport(AdminDashboardService $adminDashboard, $yearToLoad)
    {
        try {
            // Get chart data from AdminViewController
            $chartData = $this->adminViewController->getDashboardChartData($adminDashboard, $yearToLoad)->getData(true);

            // Process the data
            $report = $this->processReportData($chartData);
            $docHeader = view('StaffView.outputs.DocHeader')->render();

            // Generate PDF with output to browser
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
            $html = $this->generateReportHTML($report, $yearToLoad);

            // Write HTML to PDF
            $mpdf->WriteHTML($html);

            // Stream PDF directly to output
            $mpdf->Output('dashboard-report-' . date('Y-m-d') . '.pdf', 'I');
            return; // Prevent any further output
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

        try {
            if (!isset($chartData['monthlyData'])) {
                Log::error('Monthly data is not set');
                throw new Exception('Monthly data is not set');
            }
            if (!is_string($chartData['monthlyData'])) {
                Log::error('Monthly data is not a string');
                throw new Exception('Monthly data is not a string');
            }
            $monthlyData = json_decode($chartData['monthlyData'], true);
            if (json_last_error() !== JSON_ERROR_NONE || !is_array($monthlyData)) {
                Log::error('Failed to decode monthly data', ['error' => json_last_error_msg()]);
                throw new Exception('Failed to decode monthly data');
            }

            foreach ($monthlyData as $month => $data) {
                $report['monthly_statistics'][] = [
                    'month' => $month,
                    'total_applicants' => $data['Applicants'] ?? 0,
                    'ongoing_projects' => $data['Ongoing'] ?? 0,
                    'completed_projects' => $data['Completed'] ?? 0,
                    'total_projects' => ($data['Ongoing'] ?? 0) + ($data['Completed'] ?? 0)
                ];
            }

            if (!isset($chartData['localData'])) {
                Log::error('Local data is not set');
                throw new Exception('Local data is not set');
            }
            if (!is_string($chartData['localData'])) {
                Log::error('Local data is not a string');
                throw new Exception('Local data is not a string');
            }
            $localData = json_decode($chartData['localData'], true);
            if (json_last_error() !== JSON_ERROR_NONE || !is_array($localData)) {
                Log::error('Failed to decode location data', ['error' => json_last_error_msg()]);
                throw new Exception('Failed to decode location data');
            }
            foreach ($localData as $location => $data) {
                $report['location_statistics'][] = [
                    'location' => $location,
                    'micro_enterprises' => $data['Micro Enterprise'] ?? 0,
                    'small_enterprises' => $data['Small Enterprise'] ?? 0,
                    'medium_enterprises' => $data['Medium Enterprise'] ?? 0,
                    'total_enterprises' => ($data['Micro Enterprise'] ?? 0) + ($data['Small Enterprise'] ?? 0) + ($data['Medium Enterprise'] ?? 0)
                ];
            }

            // Process Staff Data
            foreach ($chartData['staffhandledProjects'] as $staff) {
                $totalProjects = ($staff['Micro Enterprise'] ?? 0) + ($staff['Small Enterprise'] ?? 0) + ($staff['Medium Enterprise'] ?? 0);
                $report['staff_performance'][] = [
                    'staff_name' => trim($staff['Staff_Name']),
                    'micro_enterprises' => $staff['Micro Enterprise'] ?? 0,
                    'small_enterprises' => $staff['Small Enterprise'] ?? 0,
                    'medium_enterprises' => $staff['Medium Enterprise'] ?? 0,
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
       } catch (Exception $e) {
    Log::error('Error in processReportData: ' . $e->getMessage());
    throw new Exception('Error in processReportData', $e->getCode(), $e);
}
    }

    private function generateReportHTML($report, $yearToLoad)
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
            <p>For the Year: ' . htmlspecialchars($yearToLoad) . '</p>
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
