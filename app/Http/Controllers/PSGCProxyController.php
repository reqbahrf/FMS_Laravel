<?php

namespace App\Http\Controllers;

use App\Services\PSGCService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class PSGCProxyController extends Controller
{
    /**
     * The PSGC service instance
     */
    protected $psgcService;

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->psgcService = new PSGCService();
    }

    /**
     * Proxy request to PSGC API
     *
     * @param Request $request
     * @param string $path
     * @return JsonResponse
     */
    public function proxy(Request $request, string $path = ''): JsonResponse
    {
        $result = $this->psgcService->makeProxyRequest($path, $request->query());
        return response()->json($result);
    }

    /**
     * Get regions
     *
     * @return JsonResponse
     */
    public function getRegions(): JsonResponse
    {
        return response()->json($this->psgcService->getRegions());
    }

    /**
     * Get provinces for a region
     *
     * @param string $regionCode
     * @return JsonResponse
     */
    public function getProvinces(string $regionCode): JsonResponse
    {
        return response()->json($this->psgcService->getProvinces($regionCode));
    }

    /**
     * Get cities/municipalities for a province
     *
     * @param string $provinceCode
     * @return JsonResponse
     */
    public function getCities(string $provinceCode): JsonResponse
    {
        return response()->json($this->psgcService->getCities($provinceCode));
    }

    /**
     * Get barangays for a city/municipality
     *
     * @param string $cityCode
     * @return JsonResponse
     */
    public function getBarangays(string $cityCode): JsonResponse
    {
        return response()->json($this->psgcService->getBarangays($cityCode));
    }

}
