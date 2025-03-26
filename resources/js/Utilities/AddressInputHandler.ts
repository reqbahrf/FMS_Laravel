import { API } from './AddressAPI';

interface LocationItem {
    name: string;
    code: string;
    [key: string]: any;
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

interface LocationDraftData {
    officeRegion: string;
    officeProvince: string;
    officeCity: string;
    officeBarangay: string;
    factoryRegion: string;
    factoryProvince: string;
    factoryCity: string;
    factoryBarangay: string;
}

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

    static async loadLocationDropdown(
        selector: string,
        fetchFn: JQuery.jqXHR<LocationItem[]>,
        data: string,
        placeholder: string
    ): Promise<void> {
        return new Promise((resolve) => {
            fetchFn.done((items) => {
                AddressFormInput.populateSelect(selector, items, placeholder);
                $(selector).val(data);
                $(selector).prop('disabled', false);
                resolve();
            });
        });
    }

    static loadOfficeAddressDropdowns = async (
        draftData: LocationDraftData
    ) => {
        if (!draftData.officeRegion) return;

        // Load regions
        await AddressFormInput.loadLocationDropdown(
            '#officeRegion',
            API.fetchRegions(),
            draftData.officeRegion,
            'Select Office Region'
        );

        if (!draftData.officeProvince) return;

        // Load provinces
        const regionCode = $('#officeRegion').find(':selected').data('code');
        await AddressFormInput.loadLocationDropdown(
            '#officeProvince',
            API.fetchProvinces(regionCode),
            draftData.officeProvince,
            'Select Office Province'
        );

        if (!draftData.officeCity) return;

        // Load cities
        const provinceCode = $('#officeProvince')
            .find(':selected')
            .data('code');
        await AddressFormInput.loadLocationDropdown(
            '#officeCity',
            API.fetchCities(provinceCode),
            draftData.officeCity,
            'Select Office City'
        );

        if (!draftData.officeBarangay) return;

        // Load barangays
        const cityCode = $('#officeCity').find(':selected').data('code');
        await AddressFormInput.loadLocationDropdown(
            '#officeBarangay',
            API.fetchBarangay(cityCode),
            draftData.officeBarangay,
            'Select Office Barangay'
        );
    };

    static loadFactoryAddressDropdowns = async (
        draftData: LocationDraftData
    ) => {
        if (!draftData.factoryRegion) return;

        // Load regions
        await AddressFormInput.loadLocationDropdown(
            '#factoryRegion',
            API.fetchRegions(),
            draftData.factoryRegion,
            'Select Factory Region'
        );

        if (!draftData.factoryProvince) return;

        // Load provinces
        const regionCode = $('#factoryRegion').find(':selected').data('code');
        await AddressFormInput.loadLocationDropdown(
            '#factoryProvince',
            API.fetchProvinces(regionCode),
            draftData.factoryProvince,
            'Select Factory Province'
        );

        if (!draftData.factoryCity) return;

        // Load cities
        const provinceCode = $('#factoryProvince')
            .find(':selected')
            .data('code');
        await AddressFormInput.loadLocationDropdown(
            '#factoryCity',
            API.fetchCities(provinceCode),
            draftData.factoryCity,
            'Select Factory City'
        );

        if (!draftData.factoryBarangay) return;

        // Load barangays
        const cityCode = $('#factoryCity').find(':selected').data('code');
        await AddressFormInput.loadLocationDropdown(
            '#factoryBarangay',
            API.fetchBarangay(cityCode),
            draftData.factoryBarangay,
            'Select Factory Barangay'
        );
    };

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

export { AddressFormInput };
