<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class PSGCService
{
    /**
     * Base URL for the PSGC API
     */
    protected $baseUrl = 'https://psgc.gitlab.io/api';

    /**
     * Cache duration in minutes (48 hours = 2880 minutes)
     */
    protected $cacheDuration = 2880;

    /**
     * Whether to use cache tags (requires Redis or Memcached)
     */
    protected $useCacheTags;

    /**
     * Create a new PSGC service instance.
     */
    public function __construct()
    {
        // Determine if we can use cache tags based on the cache driver
        $this->useCacheTags = in_array(config('cache.default'), ['redis', 'memcached']);
    }

    /**
     * Make a proxy request to the PSGC API
     *
     * @param string $path
     * @param array $queryParams
     * @return array
     */
    public function makeProxyRequest(string $path = '', array $queryParams = []): array
    {
        $queryString = !empty($queryParams) ? '?' . http_build_query($queryParams) : '';
        $fullPath = $path . $queryString;
        $cacheKey = "psgc_proxy_{$fullPath}";

        return $this->cacheData($cacheKey, function () use ($path, $queryParams) {
            try {
                // Build the target URL by combining the base URL with the path
                $targetUrl = $this->baseUrl;
                if ($path) {
                    $targetUrl .= '/' . $path;
                }

                // Make the HTTP request to the target API
                $response = Http::get($targetUrl, $queryParams);

                // Check if the request was successful
                if ($response->successful()) {
                    return $response->json();
                }

                // Handle error response
                return [
                    'error' => 'Failed to retrieve data from the PSGC API',
                    'status_code' => $response->status()
                ];
            } catch (\Exception $e) {
                Log::error('PSGC Proxy Error: ' . $e->getMessage());

                return [
                    'error' => 'Error connecting to the PSGC API',
                    'message' => $e->getMessage()
                ];
            }
        });
    }

    /**
     * Get regions data
     *
     * @return array
     */
    public function getRegions(): array
    {
        return $this->cacheData('psgc_regions', function () {
            $response = Http::get("{$this->baseUrl}/regions");
            return $response->json();
        });
    }

    /**
     * Get provinces for a region
     *
     * @param string $regionCode
     * @return array
     */
    public function getProvinces(string $regionCode): array
    {
        return $this->cacheData("psgc_provinces_{$regionCode}", function () use ($regionCode) {
            $response = Http::get("{$this->baseUrl}/regions/{$regionCode}/provinces");
            return $response->json();
        });
    }

    /**
     * Get cities/municipalities for a province
     *
     * @param string $provinceCode
     * @return array
     */
    public function getCities(string $provinceCode): array
    {
        return $this->cacheData("psgc_cities_{$provinceCode}", function () use ($provinceCode) {
            $response = Http::get("{$this->baseUrl}/provinces/{$provinceCode}/cities-municipalities");
            return $response->json();
        });
    }

    /**
     * Get barangays for a city/municipality
     *
     * @param string $cityCode
     * @return array
     */
    public function getBarangays(string $cityCode): array
    {
        return $this->cacheData("psgc_barangays_{$cityCode}", function () use ($cityCode) {
            $response = Http::get("{$this->baseUrl}/cities-municipalities/{$cityCode}/barangays");
            return $response->json();
        });
    }

    /**
     * Helper method to cache data with optional tags
     *
     * @param string $key
     * @param callable $callback
     * @return mixed
     */
    protected function cacheData(string $key, callable $callback)
    {
        try {
            if ($this->useCacheTags) {
                return Cache::tags(['psgc'])->remember($key, $this->cacheDuration, $callback);
            } else {
                return Cache::remember($key, $this->cacheDuration, $callback);
            }
        } catch (\Exception $e) {
            Log::error('PSGC cache error: ' . $e->getMessage());

            return $callback();
        }
    }
}
