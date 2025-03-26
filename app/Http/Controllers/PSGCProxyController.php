<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\JsonResponse;

class PSGCProxyController extends Controller
{
    protected $baseUrl = 'https://psgc.gitlab.io/api';

    /**
     * Proxy request to PSGC API
     *
     * @param Request $request
     * @param string $path
     * @return JsonResponse
     */
    public function proxy(Request $request, string $path = ''): JsonResponse
    {
        try {
            // Build the target URL by combining the base URL with the path
            $targetUrl = $this->baseUrl;
            if ($path) {
                $targetUrl .= '/' . $path;
            }

            // Forward any query parameters from the original request
            $queryParams = $request->query();

            // Make the HTTP request to the target API
            $response = Http::get($targetUrl, $queryParams);

            // Check if the request was successful
            if ($response->successful()) {
                return response()->json($response->json());
            }

            // Handle error response
            return response()->json([
                'error' => 'Failed to retrieve data from the PSGC API',
                'status_code' => $response->status()
            ], $response->status());
        } catch (\Exception $e) {
            Log::error('PSGC Proxy Error: ' . $e->getMessage());

            return response()->json([
                'error' => 'Error connecting to the PSGC API',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get regions
     */
    public function getRegions(): JsonResponse
    {
        return $this->proxy(request(), 'regions');
    }

    /**
     * Get provinces for a region
     */
    public function getProvinces(string $regionCode): JsonResponse
    {
        return $this->proxy(request(), "regions/{$regionCode}/provinces");
    }

    /**
     * Get cities/municipalities for a province
     */
    public function getCities(string $provinceCode): JsonResponse
    {
        return $this->proxy(request(), "provinces/{$provinceCode}/cities-municipalities");
    }

    /**
     * Get barangays for a city/municipality
     */
    public function getBarangays(string $cityCode): JsonResponse
    {
        return $this->proxy(request(), "cities-municipalities/{$cityCode}/barangays");
    }
}
