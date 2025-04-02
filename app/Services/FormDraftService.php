<?php

namespace App\Services;

use Exception;
use App\Models\FormDraft;
use App\Models\TemporaryFile;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

class FormDraftService
{
    /**
     * Store or update a form draft
     *
     * @param string $ownerId
     * @param string $draftType
     * @param array $data
     * @return array
     * @throws Exception
     */
    public function storeDraft(string $ownerId, string $draftType, array $data): array
    {
        $draft = FormDraft::firstOrNew([
            'owner_id' => $ownerId,
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
     * @param string $ownerId
     * @param string $draftType
     * @return array
     * @throws Exception
     */
    public function getDraft(string $ownerId, string $draftType): array
    {
        $draft = FormDraft::where('owner_id', $ownerId)
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
     * Delete a form draft by user ID and draft type
     *
     * @param string $ownerId
     * @param string $draftType
     * @return array
     * @throws Exception
     */
    public function deleteDraft(string $ownerId, string $draftType): array
    {
        $draft = FormDraft::where('owner_id', $ownerId)
            ->where('form_type', $draftType)
            ->first();

        if (!$draft) {
            return [
                'success' => true,
                'message' => 'No draft found'
            ];
        }

        $draft->delete();

        return [
            'success' => true,
            'message' => 'Draft deleted successfully'
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
            ->header('X-File-Name', $tempFile->original_file_name)
            ->header('X-File-Size', $tempFile->file_size)
            ->header('X-Mime-Type', $tempFile->mime_type)
            ->header('X-File-path', $tempFile->owner_id)
            ->header('X-Unique-Id', $tempFile->unique_id);
    }


    /**
     * Generate a secure signed URL for retrieving a draft
     *
     * This method creates a signed URL that allows secure access to retrieve a draft
     * based on the draft type and owner ID. The signed URL can be used to fetch a draft
     *
     * @param string $draftType The type of draft to retrieve
     * @param string $ownerId The ID of the draft owner
     * @return string A signed URL for retrieving the draft
     */
    public static function generateSecureGetDraft(string $draftType, string $ownerId): string
    {
        $sanitizedDraftType = preg_replace('/\s+/', '', $draftType);
        return URL::signedRoute('form.getDraft', [$sanitizedDraftType, $ownerId]);
    }


    /**
     * Generate a secure signed URL for storing a draft
     *
     * This method creates a signed URL that allows secure access to store a draft
     * based on the draft type and owner ID. The signed URL can be used to save a draft
     *
     * @param string $draftType The type of draft to store
     * @param string $ownerId The ID of the draft owner
     * @return string A signed URL for storing the draft
     */
    public static function generateSecureStoreDraft(string $draftType, string $ownerId): string
    {
        $sanitizedDraftType = preg_replace('/\s+/', '', $draftType);
        return URL::signedRoute('form.setDraft', [$sanitizedDraftType, $ownerId]);
    }

    /**
     * Generate a secure signed URL for deleting a draft
     *
     * This method creates a signed URL that allows secure access to delete a draft
     * based on the draft type and owner ID. The signed URL can be used to delete a draft
     *
     * @param string $draftType The type of draft to delete
     * @param string $ownerId The ID of the draft owner
     * @return string A signed URL for deleting the draft
     */
    public static function generateSecureDeleteDraft(string $draftType, string $ownerId): string
    {
        $sanitizedDraftType = preg_replace('/\s+/', '', $draftType);
        return URL::signedRoute('form.deleteDraft', [$sanitizedDraftType, $ownerId]);
    }
}
