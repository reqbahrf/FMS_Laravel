<?php

namespace App\Services;

use Exception;
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
            'OrganizationalStructurePath' => $validatedInputs['OrganizationalStructureFileID_Data_Handler'],
            'PlanLayoutPath' => $validatedInputs['PlanLayoutFileID_Data_Handler'],
            'ProcessFlowPath' => $validatedInputs['ProcessFlowFileID_Data_Handler'],
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

        foreach ($file_to_insert as $filekey => $filePath) {
            if (Storage::disk('public')->exists($filePath)) {
                $fileName = $fileNames[$filekey];
                $fileExtension = pathinfo($filePath, PATHINFO_EXTENSION);

                $requirementsPath = $this->pathGenerationService->generateRequirementsPath($businessId);

                if (!Storage::disk('private')->exists($requirementsPath)) {
                    Storage::disk('private')->makeDirectory($requirementsPath, 0755, true);
                }

                $finalPath = $this->pathGenerationService->generateFinalPath($requirementsPath, $fileName, $fileExtension);

                $sourceStream = Storage::disk('public')->readStream($filePath);
                $result = Storage::disk('private')->writeStream($finalPath, $sourceStream);

                if (is_resource($sourceStream)) {
                    fclose($sourceStream);
                }

                if ($result) {
                    Storage::disk('public')->delete($filePath);

                    DB::table('requirements')->insert([
                        'business_id' => $businessId,
                        'file_name' => $fileName,
                        'file_link' => $finalPath,
                        'file_type' => $fileExtension,
                        'can_edit' => false,
                        'remarks' => 'Pending',
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            } else {
                throw new Exception("This file {$fileNames[$filekey]} does not exist");
            }
        }
    }

    public static function getFileAsBase64(string $fileName, int $businessId): string
    {
        try {
            $filePath = DB::table('requirements')
                ->where('business_id', $businessId)
                ->where('file_name', $fileName)
                ->value('file_link');

            if (!$filePath) {
                throw new Exception("File {$fileName} not found for business ID {$businessId}");
            }

            return base64_encode(Storage::disk('private')->get($filePath));
        } catch (Exception $e) {
            throw new Exception('Error retrieving file as base64: ' . $e->getMessage());
        }
    }
}
