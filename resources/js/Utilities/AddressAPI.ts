/**
 * AddressAPI Utility
 *
 * This module provides a comprehensive interface for handling address-related
 * API interactions, specifically for retrieving and managing Philippine Standard
 * Geographic Code (PSGC) address information.
 *
 * @module AddressAPI
 * @description Handles address-related API calls and data retrieval
 * @requires jquery - Used for making AJAX requests
 *
 * @example
 * // Typical usage for fetching regions
 * const regions = await API.fetchRegions();
 *
 * @example
 * // Fetching provinces for a specific region
 * const provinces = await API.fetchProvinces('region_code');
 */

const API_BASE_URL: string = 'https://psgc.gitlab.io/api';
const PROXY_BASE_URL: string = '/proxy/psgc';

interface LocationItem {
    name: string;
    code: string;
    [key: string]: any;
}

/**
 * Makes an API request with fallback to proxy server if direct call fails
 * @param url Direct API URL
 * @param proxyUrl Proxy server URL
 * @returns Promise with the API response
 */
const makeRequestWithFallback = <T>(
    url: string,
    proxyUrl: string
): JQuery.jqXHR<T> => {
    const deferred = $.Deferred<T>();
    $.ajax({
        type: 'GET',
        url: url,
        dataType: 'json',
    })
        .done((data: T) => {
            deferred.resolve(data);
        })
        .fail((error: JQuery.jqXHR) => {
            console.warn(
                `Direct API call failed for ${url}, trying proxy...`,
                error
            );

            $.ajax({
                type: 'GET',
                url: proxyUrl,
                dataType: 'json',
            })
                .done((data: T) => {
                    deferred.resolve(data);
                })
                .fail((proxyError: JQuery.jqXHR) => {
                    console.error(
                        `Proxy request also failed for ${proxyUrl}`,
                        proxyError
                    );
                    deferred.reject(proxyError);
                });
        });

    return deferred.promise() as unknown as JQuery.jqXHR<T>;
};

/**
 * AddressAPI Utility
 *
 * This module provides a comprehensive interface for handling address-related
 * API interactions, specifically for retrieving and managing Philippine Standard
 * Geographic Code (PSGC) address information.
 *
 * @module AddressAPI
 * @description Handles address-related API calls and data retrieval
 * @requires jquery - Used for making AJAX requests
 *
 * @example
 * // Typical usage for fetching regions
 * const regions = await API.fetchRegions();
 *
 * @example
 * // Fetching provinces for a specific region
 * const provinces = await API.fetchProvinces('region_code');
 */
const API = {
    /**
     * Fetches all regions from the API
     * @returns Promise with the list of regions
     */
    fetchRegions: (): JQuery.jqXHR<LocationItem[]> => {
        return makeRequestWithFallback<LocationItem[]>(
            `${API_BASE_URL}/regions`,
            `${PROXY_BASE_URL}/regions`
        );
    },

    /**
     * Fetches provinces for a specific region
     * @param regionCode - Code of the region
     * @returns Promise with the list of provinces
     */
    fetchProvinces: (regionCode: string): JQuery.jqXHR<LocationItem[]> => {
        return makeRequestWithFallback<LocationItem[]>(
            `${API_BASE_URL}/regions/${regionCode}/provinces`,
            `${PROXY_BASE_URL}/regions/${regionCode}/provinces`
        );
    },

    /**
     * Fetches cities for a specific province
     * @param provinceCode - Code of the province
     * @returns Promise with the list of cities
     */
    fetchCities: (provinceCode: string): JQuery.jqXHR<LocationItem[]> => {
        return makeRequestWithFallback<LocationItem[]>(
            `${API_BASE_URL}/provinces/${provinceCode}/cities-municipalities`,
            `${PROXY_BASE_URL}/provinces/${provinceCode}/cities-municipalities`
        );
    },

    /**
     * Fetches barangays for a specific city
     * @param cityCode - Code of the city
     * @returns Promise with the list of barangays
     */
    fetchBarangay: (cityCode: string): JQuery.jqXHR<LocationItem[]> => {
        return makeRequestWithFallback<LocationItem[]>(
            `${API_BASE_URL}/cities-municipalities/${cityCode}/barangays`,
            `${PROXY_BASE_URL}/cities-municipalities/${cityCode}/barangays`
        );
    },
};

export { API };
