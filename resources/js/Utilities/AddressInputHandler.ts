const API_BASE_URL: string = 'https://psgc.gitlab.io/api';

// Define interfaces for the data structures
interface LocationItem {
    name: string;
    code: string;
    [key: string]: any; // For any additional properties
}

interface AddressFormConfig {
    prefix: string;
}

interface Selectors {
    region: string;
    province: string;
    city: string;
    barangay: string;
}

// Define the API object with proper return types
const API = {
    fetchRegions: (): JQuery.jqXHR<LocationItem[]> => {
        return $.ajax({
            type: 'GET',
            url: `${API_BASE_URL}/regions/`,
        }).fail((error: JQuery.jqXHR) => {
            console.error('Error fetching regions:', error);
        });
    },

    fetchProvinces: (regionCode: string): JQuery.jqXHR<LocationItem[]> => {
        return $.ajax({
            type: 'GET',
            url: `${API_BASE_URL}/regions/${regionCode}/provinces/`,
        }).fail((error: JQuery.jqXHR) => {
            console.error('Error fetching provinces:', error);
        });
    },

    fetchCities: (provinceCode: string): JQuery.jqXHR<LocationItem[]> => {
        return $.ajax({
            type: 'GET',
            url: `${API_BASE_URL}/provinces/${provinceCode}/cities-municipalities/`,
        }).fail((error: JQuery.jqXHR) => {
            console.error('Error fetching cities:', error);
        });
    },

    fetchBarangay: (cityCode: string): JQuery.jqXHR<LocationItem[]> => {
        return $.ajax({
            type: 'GET',
            url: `${API_BASE_URL}/cities-municipalities/${cityCode}/barangays/`,
        });
    },
};

class AddressFormInput {
    private prefix: string;
    private selectors: Selectors;

    constructor(config: AddressFormConfig) {
        this.prefix = config.prefix;
        this.selectors = {
            region: `#${this.prefix}Region`,
            province: `#${this.prefix}Province`,
            city: `#${this.prefix}City`,
            barangay: `#${this.prefix}Barangay`,
        };
        this.initializeAddressSelection();
    }

    static populateSelect(
        selectElement: string,
        data: LocationItem[] | string,
        placeholder: string
    ): void {
        const parsedData: LocationItem[] =
            typeof data === 'string' ? JSON.parse(data) : data;

        $(selectElement).html(`<option value="">${placeholder}</option>`);

        $.each(parsedData, (_: number, item: LocationItem) => {
            $(selectElement).append(
                `<option value="${item.name}" data-code="${item.code}">${item.name}</option>`
            );
        });
    }

    private initializeAddressSelection(): void {
        this.initializeRegions();
        $(this.selectors.region).on('change', () => this.updateProvinces());
        $(this.selectors.province).on('change', () => this.updateCities());
        $(this.selectors.city).on('change', () => this.updateBarangays());
    }

    private initializeRegions(): void {
        API.fetchRegions().done((regions: LocationItem[]) => {
            AddressFormInput.populateSelect(
                this.selectors.region,
                regions,
                'Select Region'
            );
        });
    }

    private updateProvinces(): void {
        const regionCode: string = $(this.selectors.region)
            .find(':selected')
            .data('code');

        $(this.selectors.province).prop('disabled', !regionCode);
        $(this.selectors.city).prop('disabled', true);
        $(this.selectors.barangay).prop('disabled', true);

        AddressFormInput.populateSelect(
            this.selectors.province,
            [],
            'Select Province'
        );
        AddressFormInput.populateSelect(this.selectors.city, [], 'Select City');
        AddressFormInput.populateSelect(
            this.selectors.barangay,
            [],
            'Select Barangay'
        );

        if (regionCode) {
            API.fetchProvinces(regionCode).done((provinces: LocationItem[]) => {
                AddressFormInput.populateSelect(
                    this.selectors.province,
                    provinces,
                    'Select Province'
                );
            });
        }
    }

    private updateCities(): void {
        const provinceCode: string = $(this.selectors.province)
            .find(':selected')
            .data('code');

        $(this.selectors.city).prop('disabled', !provinceCode);
        $(this.selectors.barangay).prop('disabled', true);

        AddressFormInput.populateSelect(this.selectors.city, [], 'Select City');
        AddressFormInput.populateSelect(
            this.selectors.barangay,
            [],
            'Select Barangay'
        );

        if (provinceCode) {
            API.fetchCities(provinceCode).done((cities: LocationItem[]) => {
                AddressFormInput.populateSelect(
                    this.selectors.city,
                    cities,
                    'Select City'
                );
            });
        }
    }

    private updateBarangays(): void {
        const cityCode: string = $(this.selectors.city)
            .find(':selected')
            .data('code');

        $(this.selectors.barangay).prop('disabled', !cityCode);

        if (cityCode) {
            API.fetchBarangay(cityCode).done((barangays: LocationItem[]) => {
                AddressFormInput.populateSelect(
                    this.selectors.barangay,
                    barangays,
                    'Select Barangay'
                );
            });
        }
    }
}

export { AddressFormInput, API };
