<?php

namespace App\Services;

use App\Models\Requirement;
use Exception;
use App\Models\TemporaryFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ApplicantFileHandlerService
{
    public function __construct(
        private PathGenerationService $pathGenerationService
    ) {}

    public function storeFile(array $validatedInputs, int $businessId, string $firm_name): void
    {
        $file_to_insert = [
            'OrganizationalStructurePath' => $validatedInputs['OrganizationalStructureFileID_Data_Handler'] ?? '',
            'PlanLayoutPath' => $validatedInputs['PlanLayoutFileID_Data_Handler'] ?? '',
            'ProcessFlowPath' => $validatedInputs['ProcessFlowFileID_Data_Handler'] ?? '',
            'IntentFilePath' => $validatedInputs['IntentFileID_Data_Handler'],
            'DSCFilePath' => $validatedInputs['DtiSecCdaFileID_Data_Handler'],
            'businessPermitFilePath' => $validatedInputs['BusinessPermitFileID_Data_Handler'],
            'FDA_LTOFilePath' => $validatedInputs['FdaLtoFileID_Data_Handler'] ?? '',
            'receiptFilePath' => $validatedInputs['ReceiptFileID_Data_Handler'],
            'govFilePath' => $validatedInputs['GovIdFileID_Data_Handler'],
            'BIRFilePath' => $validatedInputs['BIRFileID_Data_Handler']
        ];

        $fileNames = [
            'OrganizationalStructurePath' => 'Organizational Structure',
            'PlanLayoutPath' => 'Plan Layout',
            'ProcessFlowPath' => 'Process Flow',
            'IntentFilePath' => 'Intent File',
            'businessPermitFilePath' => 'Business Permit',
            'receiptFilePath' => 'Receipt',
            'BIRFilePath' => 'BIR'
        ];

        $DSC_file_Name_Selector = $validatedInputs['DSC_file_Selector'];
        $fda_lto_Name_Selector = $validatedInputs['Fda_Lto_Selector'];
        $govId_Selector = $validatedInputs['GovIdSelector'];

        $fileNames['DSCFilePath'] = $DSC_file_Name_Selector;
        $fileNames['FDA_LTOFilePath'] = $fda_lto_Name_Selector;
        $fileNames['govFilePath'] = $govId_Selector;

        $file_to_insert = array_filter($file_to_insert);

        if (empty($file_to_insert)) {
            Log::warning('No files provided for storage', [
                'business_id' => $businessId,
                'firm_name' => $firm_name
            ]);
            return;
        }

        foreach ($file_to_insert as $filekey => $fileIdentifier) {
            $this->processAndStoreFile($filekey, $fileIdentifier, $fileNames, $businessId);
        }
    }

    /**
     * Process and store a single file
     *
     * @param string $filekey
     * @param string $fileIdentifier
     * @param array $fileNames
     * @param int $businessId
     * @throws Exception
     */
    private function processAndStoreFile(string $filekey, string $fileIdentifier, array $fileNames, int $businessId): void
    {
        try {
            // Extract the unique_id from the path (assuming format like "tmp/_67ecd4f446dbc/filename.ext")
            $uniqueId = null;
            if (preg_match('/tmp\/(_[a-z0-9]+)\//', $fileIdentifier, $matches)) {
                $uniqueId = $matches[1];
            } else {
                $uniqueId = $fileIdentifier;
            }

            $tempFile = TemporaryFile::where('unique_id', $uniqueId)->first();

            if (!$tempFile) {
                throw new Exception("This file {$fileNames[$filekey]} does not exist in the database");
            }

            $filePath = $tempFile->file_path;


            if (!Storage::disk('public')->exists($filePath)) {

                throw new Exception("This file {$fileNames[$filekey]} exists in database but not in storage");
            }

            $fileName = $fileNames[$filekey];
            $fileExtension = pathinfo($tempFile->original_file_name, PATHINFO_EXTENSION);

            $requirementsPath = $this->pathGenerationService->generateRequirementsPath($businessId);

            if (!Storage::disk('private')->exists($requirementsPath)) {
                Storage::disk('private')->makeDirectory($requirementsPath, 0755, true);
            }

            $finalPath = $this->pathGenerationService->generateFinalPath($requirementsPath, $fileName, $fileExtension);

            $sourceStream = Storage::disk('public')->readStream($filePath);

            if (!is_resource($sourceStream)) {
                throw new Exception("Failed to open stream for file: {$filePath}");
            }

            $result = Storage::disk('private')->writeStream($finalPath, $sourceStream);

            if (!$result) {
                throw new Exception("Failed to write file to private storage: {$fileName}");
            }

            // Close the stream after checking the result
            if (is_resource($sourceStream)) {
                fclose($sourceStream);
            }

            Storage::disk('public')->delete($filePath);
            $tempFile->delete();

            Requirement::insert([
                'business_id' => $businessId,
                'file_name' => $fileName,
                'file_link' => $finalPath,
                'file_type' => $fileExtension,
                'can_edit' => false,
                'remarks' => 'Pending',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Replace an existing requirement file with a new file from temporary storage
     *
     * @param int $businessId
     * @param string $fileKey
     * @param string $fileIdentifier
     * @param array $fileNames
     * @throws Exception
     */
    public function replaceOrCreateRequirementFile(
        int $businessId,
        string $fileKey,
        string $fileIdentifier,
        array $fileNames
    ): void {
        try {
            $existingRequirement = DB::table('requirements')
                ->where('business_id', $businessId)
                ->where('file_name', $fileNames[$fileKey])
                ->first();

            $uniqueId = null;
            if (preg_match('/tmp\/(_[a-z0-9]+)\//', $fileIdentifier, $matches)) {
                $uniqueId = $matches[1];
            } else {
                $uniqueId = $fileIdentifier;
            }

            // Look up the temporary file
            $tempFile = TemporaryFile::where('unique_id', $uniqueId)->first();

            if (!$tempFile) {
                throw new Exception("Temporary file record not found in database for unique ID: {$uniqueId}");
            }

            $filePath = $tempFile->file_path;

            // Verify the file exists in public storage
            if (!Storage::disk('public')->exists($filePath)) {
                throw new Exception("Temporary file does not exist in public storage");
            }

            // Generate paths for the new file
            $requirementsPath = $this->pathGenerationService->generateRequirementsPath($businessId);

            if (!Storage::disk('private')->exists($requirementsPath)) {
                Storage::disk('private')->makeDirectory($requirementsPath, 0755, true);
            }

            $fileExtension = pathinfo($tempFile->original_file_name, PATHINFO_EXTENSION);
            $fileName = $fileNames[$fileKey];
            $finalPath = $this->pathGenerationService->generateFinalPath($requirementsPath, $fileName, $fileExtension);

            // Open source stream
            $sourceStream = Storage::disk('public')->readStream($filePath);

            if (!is_resource($sourceStream)) {
                throw new Exception("Failed to open stream for file: {$filePath}");
            }

            // Write to private storage
            $result = Storage::disk('private')->writeStream($finalPath, $sourceStream);

            if (!$result) {
                throw new Exception("Failed to write file to private storage: {$fileName}");
            }

            if (is_resource($sourceStream)) {
                fclose($sourceStream);
            }

            if ($existingRequirement && Storage::disk('private')->exists($existingRequirement->file_link)) {
                Storage::disk('private')->delete($existingRequirement->file_link);
            }

            if ($existingRequirement) {
                Requirement::where('business_id', $businessId)
                    ->where('file_name', $fileName)
                    ->where('id', $existingRequirement->id)
                    ->update([
                        'file_link' => $finalPath,
                        'file_type' => $fileExtension,
                        'remarks' => 'Pending',
                        'updated_at' => now(),
                    ]);
            } else {
                Requirement::insert([
                    'business_id' => $businessId,
                    'file_name' => $fileName,
                    'file_link' => $finalPath,
                    'file_type' => $fileExtension,
                    'remarks' => 'Pending',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            // Clean up temporary file
            Storage::disk('public')->delete($filePath);
            $tempFile->delete();
        } catch (Exception $e) {
            throw $e;
        }
    }

    public static function getRequirementImageAsBase64(string $fileName, int $businessId): array
    {
        try {
            $filePath = Requirement::where('business_id', $businessId)
                ->where('file_name', $fileName)
                ->value('file_link');

            if (!$filePath) {
                return ['base64' => '', 'mimeType' => ''];
            }

            $fullPath = Storage::disk('private')->path($filePath);

            $mimeType = mime_content_type($fullPath);

            $allowedImageTypes = [
                'image/jpeg',
                'image/png',
                'image/gif',
                'image/webp',
                'image/bmp',
                'image/svg+xml'
            ];

            if (!in_array($mimeType, $allowedImageTypes)) {
                return ['base64' => '', 'mimeType' => ''];
            }

            return [
                'base64' => base64_encode(Storage::disk('private')->get($filePath)),
                'mimeType' => $mimeType
            ];
        } catch (Exception $e) {
            throw new Exception('Error retrieving file as base64: ' . $e->getMessage());
        }
    }
}
