<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Services\FormDraftService;

class FormDraftController extends Controller
{
    /**
     * @var FormDraftService
     */
    protected $formDraftService;

    /**
     * FormDraftController constructor.
     *
     * @param FormDraftService $formDraftService
     */
    public function __construct(FormDraftService $formDraftService)
    {
        $this->formDraftService = $formDraftService;
    }

    /**
     * Store a form draft
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        try {
            $owner_id = $request->ownerId;
            $draftType = $request->draft_type;

            $data = $request->except('draft_type', 'ownerId');

            $result = $this->formDraftService->storeDraft(
                $owner_id,
                $draftType,
                $data
            );

            return response()->json($result, 200);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Get a form draft
     *
     * @param Request $request
     * @param string $draft_type
     * @return \Illuminate\Http\JsonResponse
     */
    public function get(Request $request)
    {
        try {
            $ownerId = $request->ownerId;
            $draft_type = $request->draft_type;
            $result = $this->formDraftService->getDraft($ownerId, $draft_type);

            return response()->json($result);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error retrieving draft',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get files by unique ID
     *
     * @param string $uniqueId
     * @return \Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     */
    public function getFiles($uniqueId)
    {
        try {
            return $this->formDraftService->getFile($uniqueId);
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
