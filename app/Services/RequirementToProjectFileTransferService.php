<?php

namespace App\Services;

use Exception;
use App\Models\ProjectInfo;
use App\Models\Requirement;
use Illuminate\Support\Str;
use App\Models\BusinessInfo;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Repositories\ProjectFileLinkRepository;
use Symfony\Component\HttpFoundation\File\Exception\FileNotFoundException;

class RequirementToProjectFileTransferService
{
    protected $projectFileLinkRepository;
    protected $pathGenerationService;

    /**
     * Create a new service instance.
     *
     * @param ProjectFileLinkRepository $projectFileLinkRepository
     * @param PathGenerationService $pathGenerationService
     */
    public function __construct(
        ProjectFileLinkRepository $projectFileLinkRepository,
        PathGenerationService $pathGenerationService
    ) {
        $this->projectFileLinkRepository = $projectFileLinkRepository;
        $this->pathGenerationService = $pathGenerationService;
    }

    /**
     * Transfer a file from Requirement to ProjectFileLink.
     *
     * @param Requirement $requirement The source requirement
     * @param string $projectId The destination project ID
     * @param string|null $newFileName Optional new file name (if not provided, original name is used)
     * @return bool Success status
     */
    public function transferFile(Requirement $requirement, string $projectId, ?string $newFileName = null): bool
    {
        try {
            $sourceFilePath = storage_path("app/private/{$requirement->file_link}");
            if (!file_exists($sourceFilePath)) {
                throw new FileNotFoundException("Source file not found: {$sourceFilePath}");
            }

            $fileName = $newFileName ?: $requirement->file_name;

            $requirementsPath = $this->pathGenerationService->generateRequirementsPath(
                $this->pathGenerationService->getBusinessIdFromProject($projectId)
            );

            if (!Storage::disk('private')->exists($requirementsPath)) {
                Storage::disk('private')->makeDirectory($requirementsPath, 0755, true);
            }

            $destinationFileName = Str::slug($fileName, '_') . '_' . time();
            $destinationPath = "{$requirementsPath}/{$destinationFileName}";

            $success = $this->copyFileWithinPrivateStorage($requirement->file_link, $destinationPath);

            if (!$success) {
                return false;
            }

            return $this->projectFileLinkRepository->create([
                'Project_id' => $projectId,
                'file_name' => $fileName,
                'file_link' => $destinationPath,
                'is_external' => false
            ]);
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Transfer multiple files from Requirements to ProjectFileLinks.
     *
     * @param array $requirementIds Array of requirement IDs to transfer
     * @param string $projectId The destination project ID
     * @return array Results with success/failure information for each requirement
     */
    public function transferMultipleFiles(array $requirementIds, string $projectId): array
    {
        $results = [];

        foreach ($requirementIds as $requirementId) {
            try {
                $requirement = Requirement::findOrFail($requirementId);
                $success = $this->transferFile($requirement, $projectId);

                $results[$requirementId] = [
                    'success' => $success,
                    'file_name' => $requirement->file_name,
                    'message' => $success ? 'File transferred successfully' : 'Failed to transfer file'
                ];
            } catch (Exception $e) {
                $results[$requirementId] = [
                    'success' => false,
                    'message' => $e->getMessage()
                ];
            }
        }

        return $results;
    }

    /**
     * Copy a file within the private storage.
     *
     * @param string $sourcePath Source path relative to private storage
     * @param string $destinationPath Destination path relative to private storage
     * @return bool Success status
     */
    private function copyFileWithinPrivateStorage(string $sourcePath, string $destinationPath): bool
    {
        try {
            $sourceStream = Storage::disk('private')->readStream($sourcePath);
            $result = Storage::disk('private')->writeStream($destinationPath, $sourceStream);

            if (is_resource($sourceStream)) {
                fclose($sourceStream);
            }

            return $result;
        } catch (Exception $e) {
            Log::error("File copy failed: {$e->getMessage()}");
            return false;
        }
    }

    /**
     * Optional: Delete the source file after successful transfer.
     *
     * @param Requirement $requirement The requirement to delete file from
     * @return bool Success status
     */
    public function deleteSourceFile(Requirement $requirement): bool
    {
        try {
            $success = Storage::disk('private')->delete($requirement->file_link);

            if ($success) {
                // Optionally update the requirement record to mark the file as moved
                // This depends on your application's requirements
                // You might want to set file_link to null, or add a 'moved' flag
                // $requirement->update(['file_link' => null]);
            }

            return $success;
        } catch (Exception $e) {
            Log::error("Failed to delete source file: {$e->getMessage()}");
            return false;
        }
    }
}
