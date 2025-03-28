import { API } from '../Utilities/AddressAPI';
interface LocationItem {
    name: string;
    code: string;
    [key: string]: any;
}

class AddressDataCache {
    private static readonly CACHE_PREFIX = 'address_data_';
    private static readonly CACHE_EXPIRY = 7 * 24 * 60 * 60 * 1000; // 7 days in milliseconds

    static async getRegions(): Promise<LocationItem[]> {
        return this.getCachedData('regions', () => API.fetchRegions());
    }

    static async getProvinces(regionCode: string): Promise<LocationItem[]> {
        return this.getCachedData(`provinces_${regionCode}`, () =>
            API.fetchProvinces(regionCode)
        );
    }

    static async getCities(provinceCode: string): Promise<LocationItem[]> {
        return this.getCachedData(`cities_${provinceCode}`, () =>
            API.fetchCities(provinceCode)
        );
    }

    static async getBarangays(cityCode: string): Promise<LocationItem[]> {
        return this.getCachedData(`barangays_${cityCode}`, () =>
            API.fetchBarangay(cityCode)
        );
    }

    private static async getCachedData(
        key: string,
        fetchFn: () => JQuery.jqXHR<LocationItem[]>
    ): Promise<LocationItem[]> {
        const cacheKey = this.CACHE_PREFIX + key;
        const cachedData = localStorage.getItem(cacheKey);

        if (cachedData) {
            const { data, timestamp } = JSON.parse(cachedData);
            const now = new Date().getTime();

            // Check if cache is still valid
            if (now - timestamp < this.CACHE_EXPIRY) {
                return data;
            }
        }

        // Cache miss or expired, fetch fresh data
        return new Promise((resolve, reject) => {
            fetchFn()
                .done((data) => {
                    // Store in cache
                    const cacheEntry = {
                        data,
                        timestamp: new Date().getTime(),
                    };
                    localStorage.setItem(cacheKey, JSON.stringify(cacheEntry));
                    resolve(data);
                })
                .fail((error) => {
                    reject(error);
                });
        });
    }
}

export { AddressDataCache };
