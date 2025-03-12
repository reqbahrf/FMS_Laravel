<?php

namespace App\Services;

use Illuminate\Support\Str;
use App\Models\BusinessInfo;
use App\Models\ProjectFileLink;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\ProjectFileLinkRepository;
use Illuminate\Auth\Access\AuthorizationException;
use Symfony\Component\HttpFoundation\File\Exception\FileNotFoundException;

class ProjectFileService
{
    protected $projectFileLinkRepository;

    /**
     * Create a new service instance.
     *
     * @param ProjectFileLinkRepository $projectFileLinkRepository
     */
    public function __construct(ProjectFileLinkRepository $projectFileLinkRepository)
    {
        $this->projectFileLinkRepository = $projectFileLinkRepository;
    }

    /**
     * Get project links by project ID.
     *
     * @param string $projectId
     * @return Collection
     */
    public function getProjectLinks(string $projectId): Collection
    {
        return $this->projectFileLinkRepository->getByProjectId($projectId);
    }

    /**
     * Get file details for viewing with authorization check.
     *
     * @param int $id
     * @param \App\Models\User|null $user
     * @return array
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function getFileForViewing(int $id, $user = null): array
    {
        $fileLink = $this->projectFileLinkRepository->findOrFail($id);

        // Check if the user has permission to view this file
        if ($user && !$this->userCanAccessFile($fileLink, $user)) {
            throw new AuthorizationException('You do not have permission to view this file');
        }

        $filePath = storage_path("app/private/{$fileLink->file_link}");

        if (!file_exists($filePath)) {
            throw new FileNotFoundException("File not found: {$filePath}");
        }

        return [
            'path' => $filePath,
            'mime_type' => mime_content_type($filePath),
            'file_name' => $fileLink->file_name
        ];
    }

    /**
     * Check if a user has permission to access a file.
     *
     * @param \App\Models\ProjectFileLink $fileLink
     * @param \App\Models\User $user
     * @return bool
     */
    protected function userCanAccessFile(ProjectFileLink $fileLink, $user): bool
    {
        // Get the project ID associated with this file
        $projectId = $fileLink->Project_id;

        // If no project is associated, deny access
        if (!$projectId) {
            return false;
        }

        // Check if user is a staff member with access to this project
        if ($user->isStaff() && $user->orgUserInfo->handledThisProject($projectId)) {
            return true;
        }

        return false;
    }

    /**
     * Update project link.
     *
     * @param string $linkName
     * @param string $projectId
     * @param string $newName
     * @param string $newLink
     * @return bool
     */
    public function updateProjectLink(string $linkName, string $projectId, string $newName, string $newLink): bool
    {
        $newLink = $this->ensureProtocol($newLink);

        return $this->projectFileLinkRepository->updateLink($linkName, $projectId, $newName, $newLink);
    }

    /**
     * Delete project link.
     *
     * @param string $id
     * @return bool
     */
    public function deleteProjectLink(string $id): bool
    {
        $fileLink = $this->projectFileLinkRepository->findOrFail($id);

        if (!$fileLink->is_external) {
            $this->deletePhysicalFile($fileLink->file_link);
        }

        return $this->projectFileLinkRepository->delete($fileLink->id);
    }

    /**
     * Save project links.
     *
     * @param string $projectId
     * @param array $linkList
     * @return bool
     */
    public function saveProjectLinks(string $projectId, array $linkList): bool
    {
        $links = [];

        foreach ($linkList as $name => $url) {
            $links[] = [
                'Project_id' => $projectId,
                'file_name' => $name,
                'file_link' => $this->ensureProtocol($url),
                'is_external' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        return $this->projectFileLinkRepository->insertMultiple($links);
    }

    /**
     * Save project file.
     *
     * @param int $businessId
     * @param string $projectId
     * @param string $name
     * @param string $filePath
     * @return bool
     */
    public function saveProjectFile(int $businessId, string $projectId, string $name, string $filePath): bool
    {
        if (!Storage::disk('public')->exists($filePath)) {
            throw new FileNotFoundException("File not found: {$filePath}");
        }

        $firmName = BusinessInfo::where('id', $businessId)
            ->select('firm_name')
            ->firstOrFail();

        $business_path = "Businesses/{$firmName->firm_name}_{$businessId}";
        $projectFilePath = $business_path . "/project_files{$projectId}";

        Storage::disk('private')->makeDirectory($projectFilePath . '/requirements', 0755, true);

        $newFileName = time() . '_' . Str::slug($name, '_');

        $finalPath = "{$projectFilePath}/requirements/{$newFileName}";

        $this->moveFileFromPublicToPrivate($filePath, $finalPath);

        return $this->projectFileLinkRepository->create([
            'Project_id' => $projectId,
            'file_name' => $name,
            'file_link' => $finalPath,
            'is_external' => false
        ]);
    }

    /**
     * Ensure URL has a protocol.
     *
     * @param string $url
     * @return string
     */
    private function ensureProtocol(string $url): string
    {
        $url = trim($url);

        if (preg_match('#^https?://#i', $url)) {
            return $url;
        }

        $url = ltrim($url, '/\\');
        return 'https://' . $url;
    }

    /**
     * Delete a physical file from storage.
     *
     * @param string $path
     * @return bool
     */
    private function deletePhysicalFile(string $path): bool
    {
        $filePath = storage_path("app/private/{$path}");

        if (file_exists($filePath)) {
            return unlink($filePath);
        }

        return false;
    }

    /**
     * Move a file from public to private storage.
     *
     * @param string $sourcePath
     * @param string $destinationPath
     * @return bool
     */
    private function moveFileFromPublicToPrivate(string $sourcePath, string $destinationPath): bool
    {
        $sourceStream = Storage::disk('public')->readStream($sourcePath);
        $result = Storage::disk('private')->writeStream($destinationPath, $sourceStream);

        if (is_resource($sourceStream)) {
            fclose($sourceStream);
        }

        // Delete the original file after successful transfer
        if ($result) {
            Storage::disk('public')->delete($sourcePath);
        }

        return $result;
    }
}
