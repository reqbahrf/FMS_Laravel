<?php

namespace App\Http\Controllers;

use App\Actions\GeneratePDFAction;
use App\Services\AdminDashboardService;
use Exception;
use Mpdf\Mpdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AdminReportController extends Controller
{
    public function __construct(
        private AdminViewController $adminViewController,
        private GeneratePDFAction $generatePDFAction
    ) {}

    public function generatePDFReport(AdminDashboardService $adminDashboard, $yearToLoad)
    {
        try {
            // Get chart data from AdminViewController
            $chartData = $this->adminViewController->getDashboardChartData($adminDashboard, $yearToLoad)->getData(true);

            // Process the data
            $report = $this->processReportData($chartData);

            // Generate PDF
            return $this->generatePDFAction->execute(
                'Dashboard Report ' . date('Y-m-d'),
                $this->generateReportHTML($report, $yearToLoad),
                true,
                '',
                ['margin_left' => 10, 'margin_right' => 10, 'margin_top' => 40, 'margin_bottom' => 10]
            );
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

            $report['location_statistics'] = [
                'by_barangay' => [],
                'by_city' => [],
                'by_province' => [],
                'by_region' => []
            ];

            foreach ($localData as $region => $regionData) {
                foreach ($regionData['byProvince'] as $province => $provinceData) {
                    foreach ($provinceData['byCity'] as $city => $cityData) {
                        foreach ($cityData['byBarangay'] as $barangay => $barangayData) {
                            $enterpriseTypes = ['Micro Enterprise', 'Small Enterprise', 'Medium Enterprise'];
                            $enterprises = array_map(fn($type) => $barangayData[$type] ?? 0, $enterpriseTypes);
                            $totalEnterprises = array_sum($enterprises);

                            if ($totalEnterprises > 0) {
                                // Full location string
                                $fullLocation = implode(', ', array_filter([$barangay, $city, $province, $region]));

                                // Barangay-level
                                $report['location_statistics']['by_barangay'][] = [
                                    'location' => $fullLocation,
                                    'micro_enterprises' => $enterprises[0],
                                    'small_enterprises' => $enterprises[1],
                                    'medium_enterprises' => $enterprises[2],
                                    'total_enterprises' => $totalEnterprises
                                ];

                                // Group by City
                                $report['location_statistics']['by_city'][$city]['micro'] = ($report['location_statistics']['by_city'][$city]['micro'] ?? 0) + $enterprises[0];
                                $report['location_statistics']['by_city'][$city]['small'] = ($report['location_statistics']['by_city'][$city]['small'] ?? 0) + $enterprises[1];
                                $report['location_statistics']['by_city'][$city]['medium'] = ($report['location_statistics']['by_city'][$city]['medium'] ?? 0) + $enterprises[2];

                                // Group by Province
                                $report['location_statistics']['by_province'][$province]['micro'] = ($report['location_statistics']['by_province'][$province]['micro'] ?? 0) + $enterprises[0];
                                $report['location_statistics']['by_province'][$province]['small'] = ($report['location_statistics']['by_province'][$province]['small'] ?? 0) + $enterprises[1];
                                $report['location_statistics']['by_province'][$province]['medium'] = ($report['location_statistics']['by_province'][$province]['medium'] ?? 0) + $enterprises[2];

                                // Group by Region
                                $report['location_statistics']['by_region'][$region]['micro'] = ($report['location_statistics']['by_region'][$region]['micro'] ?? 0) + $enterprises[0];
                                $report['location_statistics']['by_region'][$region]['small'] = ($report['location_statistics']['by_region'][$region]['small'] ?? 0) + $enterprises[1];
                                $report['location_statistics']['by_region'][$region]['medium'] = ($report['location_statistics']['by_region'][$region]['medium'] ?? 0) + $enterprises[2];
                            }
                        }
                    }
                }
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
            .section { margin-bottom: 22.5pt; page-break-inside: avoid; }
            .section-title { font-size: 13.5pt; font-weight: bold; margin-bottom: 7.5pt; }
            .section table { width: 100%; border-collapse: collapse; margin-bottom: 15pt; }
            .section table th,
            .section table td { border: 0.75pt solid #ddd; padding: 6pt; text-align: left; }
            .section table th { background-color: #f2f2f2; }
        </style>

        <div class="header">
            <h1>Dashboard Report</h1>
            <p>For the Year: ' . htmlspecialchars($yearToLoad) . '</p>
            <p>Generated on: ' . date('F j, Y g:i:s A') . '</p>
        </div>';

        // Summary Section
        $html .= '
        <div class="section" style="page-break-inside: avoid;">
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
        // City Table
        $html .= '
<div class="section">
    <div class="section-title">Location Statistics by City</div>
    <table>
        <tr>
            <th>City</th><th>Micro</th><th>Small</th><th>Medium</th><th>Total</th>
        </tr>';
        foreach ($report['location_statistics']['by_city'] as $city => $data) {
            $total = $data['micro'] + $data['small'] + $data['medium'];
            $html .= "<tr><td>{$city}</td><td>{$data['micro']}</td><td>{$data['small']}</td><td>{$data['medium']}</td><td>{$total}</td></tr>";
        }
        $html .= '</table></div>';

        // Province Table
        $html .= '
<div class="section" >
    <div class="section-title">Location Statistics by Province</div>
    <table>
        <tr>
            <th>Province</th><th>Micro</th><th>Small</th><th>Medium</th><th>Total</th>
        </tr>';
        foreach ($report['location_statistics']['by_province'] as $province => $data) {
            $total = $data['micro'] + $data['small'] + $data['medium'];
            $html .= "<tr><td>{$province}</td><td>{$data['micro']}</td><td>{$data['small']}</td><td>{$data['medium']}</td><td>{$total}</td></tr>";
        }
        $html .= '</table></div>';

        // Region Table
        $html .= '
<div class="section" >
    <div class="section-title">Location Statistics by Region</div>
    <table>
        <tr>
            <th>Region</th><th>Micro</th><th>Small</th><th>Medium</th><th>Total</th>
        </tr>';
        foreach ($report['location_statistics']['by_region'] as $region => $data) {
            $total = $data['micro'] + $data['small'] + $data['medium'];
            $html .= "<tr><td>{$region}</td><td>{$data['micro']}</td><td>{$data['small']}</td><td>{$data['medium']}</td><td>{$total}</td></tr>";
        }
        $html .= '</table>
    </div>';

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
