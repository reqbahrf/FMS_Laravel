<?php

namespace App\Services;

use App\Models\BusinessInfo;
use App\Models\ProjectInfo;

class PathGenerationService
{
    /**
     * Generate the business path.
     *
     * @param int|string $businessId The business ID
     * @return string The formatted business path
     */
    public function generateBusinessPath($businessId): string
    {
        $business = BusinessInfo::where('id', $businessId)->firstOrFail();
        return "Businesses/{$business->firm_name}-{$businessId}";
    }

    /**
     * Generate the requirements path within a Business path.
     *
     * @param int|string $businessId The business ID
     * @return string The formatted requirements path
     */
    public function generateRequirementsPath($businessId, $applicationId): string
    {
        $businessPath = $this->generateBusinessPath($businessId);
        return "{$businessPath}/requirements{$applicationId}";
    }

    /**
     * Generate the project file path.
     *
     * @param int|string $businessId The business ID
     * @param string $projectId The project ID
     * @return string The formatted project file path
     */
    public function generateProjectFilePath($businessId, string $projectId): string
    {
        $businessPath = $this->generateBusinessPath($businessId);
        return "{$businessPath}/project_files{$projectId}";
    }

    /**
     * Get business ID from project ID.
     *
     * @param string $projectId The project ID
     * @return int The business ID
     */
    public function getBusinessIdFromProject(string $projectId): int
    {
        $project = ProjectInfo::where('Project_id', $projectId)->firstOrFail();
        return $project->business_id;
    }

    /**
     * Generate the final path for a file.
     *
     * @param string $basePath The base path
     * @param string $fileName The file name
     * @param string $filePath The file path
     * @return string The formatted final path
     */
    public function generateFinalPath(string $basePath, string $fileName, string $filePath): string
    {
        $newFileName = $fileName . '-' . uniqid(time()) . '.' . pathinfo($filePath, PATHINFO_EXTENSION);
        return str_replace(' ', '-', $basePath . '/' . $newFileName);
    }

    /**
     * Generate all relevant paths for a project in one go.
     *
     * @param string $projectId The project ID
     * @return array Associative array with all paths
     */
    public function getAllProjectPaths(string $projectId): array
    {
        $businessId = $this->getBusinessIdFromProject($projectId);

        return [
            'business_path' => $this->generateBusinessPath($businessId),
            'project_file_path' => $this->generateProjectFilePath($businessId, $projectId),
            'requirements_path' => $this->generateRequirementsPath($businessId, $projectId)
        ];
    }
}
