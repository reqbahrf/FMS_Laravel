<?php

namespace App\Services;

use Exception;
use App\Models\FormDraft;
use App\Models\TemporaryFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

class FormDraftService
{
    /**
     * Store or update a form draft
     *
     * @param int $userId
     * @param string $draftType
     * @param array $data
     * @return array
     * @throws Exception
     */
    public function storeDraft(int $userId, string $draftType, array $data): array
    {
        $draft = FormDraft::firstOrNew([
            'owner_id' => $userId,
            'form_type' => $draftType,
        ]);

        $existingData = $draft->form_data ? $draft->form_data : [];
        $mergedData = array_merge($existingData, $data);
        $draft->form_data = $mergedData;
        $draft->save();

        return [
            'success' => true,
            'message' => 'Draft saved successfully'
        ];
    }

    /**
     * Get a form draft by user ID and draft type
     *
     * @param int $userId
     * @param string $draftType
     * @return array
     * @throws Exception
     */
    public function getDraft(int $userId, string $draftType): array
    {
        $draft = FormDraft::where('owner_id', $userId)
            ->where('form_type', $draftType)
            ->where('is_submitted', false)
            ->first();

        if (!$draft) {
            return [
                'success' => true,
                'message' => 'No draft found',
                'draftData' => null
            ];
        }

        $draftData = $draft->form_data ?? [];

        return [
            'success' => true,
            'message' => 'Draft retrieved successfully',
            'draftData' => $draftData
        ];
    }

    /**
     * Get file by unique ID
     *
     * @param string $uniqueId
     * @return \Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     * @throws Exception
     */
    public function getFile(string $uniqueId)
    {
        $tempFile = TemporaryFile::where('unique_id', $uniqueId)
            ->first();

        if (!$tempFile || !Storage::disk('public')->exists($tempFile->file_path)) {
            throw new Exception('File not found on the server or has been expired. Please try again');
        }

        $filePath = $tempFile->file_path;
        $file = Storage::disk('public')->get($filePath);

        return Response::make($file, 200)
            ->header('Content-Type', $tempFile->mime_type)
            ->header('X-File-Name', $tempFile->file_name)
            ->header('X-File-Size', $tempFile->file_size)
            ->header('X-File-Type', $tempFile->type)
            ->header('X-File-path', $tempFile->owner_id)
            ->header('X-Unique-Id', $tempFile->unique_id);
    }
}
