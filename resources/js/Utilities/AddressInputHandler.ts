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
            region: `#${this.prefix}_region`,
            province: `#${this.prefix}_province`,
            city: `#${this.prefix}_city`,
            barangay: `#${this.prefix}_barangay`,
        };
        this.initializeAddressSelection();
    }

    static populateSelect(
        selectElement: string,
        data: LocationItem[] | string,
        placeholder: string
    ): void {
        try {
            const parsedData: LocationItem[] =
                typeof data === 'string' ? JSON.parse(data) : data;

            $(selectElement).html(`<option value="">${placeholder}</option>`);

            $.each(parsedData, (_: number, item: LocationItem) => {
                $(selectElement).append(
                    `<option value="${item.name}" data-code="${item.code}">${item.name}</option>`
                );
            });
        } catch (error) {
            console.error(`Error populating select ${selectElement}:`, error);
            $(selectElement).html(`<option value="">${placeholder}</option>`);
        }
    }

    /**
     * Load a location dropdown and return the code of the selected item
     * @param selector The selector for the dropdown element
     * @param fetchFn The function to fetch the data
     * @param data The value to select
     * @param placeholder The placeholder text
     * @returns Promise that resolves with the code of the selected item or null
     */
    static async loadLocationDropdown(
        selector: string,
        fetchFn: JQuery.jqXHR<LocationItem[]>,
        data: string,
        placeholder: string
    ): Promise<string | null> {
        return new Promise((resolve) => {
            fetchFn
                .done((items) => {
                    AddressFormInput.populateSelect(
                        selector,
                        items,
                        placeholder
                    );

                    if (data) {
                        $(selector).val(data);

                        if ($(selector).val() !== data) {
                            const options = $(selector).find('option');
                            for (let i = 0; i < options.length; i++) {
                                if (
                                    $(options[i]).text().toLowerCase() ===
                                    data.toLowerCase()
                                ) {
                                    $(selector).val(
                                        $(options[i]).val() as string
                                    );
                                    break;
                                }
                            }
                        }
                    }

                    $(selector).prop('disabled', false);

                    // Get the code of the selected option
                    const code = $(selector).find(':selected').data('code');
                    resolve(code || null);
                })
                .fail((error) => {
                    console.error(
                        `Failed to load data for ${selector}:`,
                        error
                    );
                    $(selector).prop('disabled', true);
                    resolve(null);
                });
        });
    }

    /**
     * Load address dropdowns for a specific address type (office or factory)
     * @param prefix The address type prefix (e.g., 'office', 'factory')
     * @param draftData The location data containing all address fields
     */
    static loadAddressDropdowns = async (
        prefix: string,
        draftData: LocationDraftData
    ): Promise<void> => {
        try {
            const regionKey = `${prefix}Region` as keyof LocationDraftData;
            const regionValue = draftData[regionKey];

            if (!regionValue) {
                return;
            }

            const regionSelector = `#${prefix}Region`;
            const regionCode = await AddressFormInput.loadLocationDropdown(
                regionSelector,
                API.fetchRegions(),
                regionValue,
                `Select ${prefix.charAt(0).toUpperCase() + prefix.slice(1)} Region`
            );

            if (!regionCode) {
                console.warn(
                    `Region code not found for "${regionValue}", cannot load provinces`
                );
                return;
            }

            const provinceKey = `${prefix}Province` as keyof LocationDraftData;
            const provinceValue = draftData[provinceKey];

            if (!provinceValue) {
                return;
            }

            const provinceSelector = `#${prefix}Province`;
            const provinceCode = await AddressFormInput.loadLocationDropdown(
                provinceSelector,
                API.fetchProvinces(regionCode),
                provinceValue,
                `Select ${prefix.charAt(0).toUpperCase() + prefix.slice(1)} Province`
            );

            if (!provinceCode) {
                console.warn(
                    `Province code not found for "${provinceValue}", cannot load cities`
                );
                return;
            }

            const cityKey = `${prefix}City` as keyof LocationDraftData;
            const cityValue = draftData[cityKey];

            if (!cityValue) {
                return;
            }

            const citySelector = `#${prefix}City`;
            const cityCode = await AddressFormInput.loadLocationDropdown(
                citySelector,
                API.fetchCities(provinceCode),
                cityValue,
                `Select ${prefix.charAt(0).toUpperCase() + prefix.slice(1)} City`
            );

            if (!cityCode) {
                console.warn(
                    `City code not found for "${cityValue}", cannot load barangays`
                );
                return;
            }

            // Get the barangay value
            const barangayKey = `${prefix}Barangay` as keyof LocationDraftData;
            const barangayValue = draftData[barangayKey];

            if (!barangayValue) {
                return;
            }

            const barangaySelector = `#${prefix}Barangay`;
            await AddressFormInput.loadLocationDropdown(
                barangaySelector,
                API.fetchBarangay(cityCode),
                barangayValue,
                `Select ${prefix.charAt(0).toUpperCase() + prefix.slice(1)} Barangay`
            );
        } catch (error) {
            console.error(`Error loading ${prefix} address dropdowns:`, error);
            // Reset dropdowns to a usable state
            $(`#${prefix}Province, #${prefix}City, #${prefix}Barangay`).prop(
                'disabled',
                true
            );
        }
    };

    static loadOfficeAddressDropdowns = async (
        draftData: LocationDraftData
    ): Promise<void> => {
        return AddressFormInput.loadAddressDropdowns('office', draftData);
    };

    static loadFactoryAddressDropdowns = async (
        draftData: LocationDraftData
    ): Promise<void> => {
        return AddressFormInput.loadAddressDropdowns('factory', draftData);
    };

    private initializeAddressSelection(): void {
        this.initializeRegions();
        $(this.selectors.region).on('change', () => this.updateProvinces());
        $(this.selectors.province).on('change', () => this.updateCities());
        $(this.selectors.city).on('change', () => this.updateBarangays());
    }

    private initializeRegions(): void {
        $(this.selectors.region).prop('disabled', true);
        $(this.selectors.province).prop('disabled', true);
        $(this.selectors.city).prop('disabled', true);
        $(this.selectors.barangay).prop('disabled', true);

        API.fetchRegions()
            .done((regions: LocationItem[]) => {
                AddressFormInput.populateSelect(
                    this.selectors.region,
                    regions,
                    'Select Region'
                );
                $(this.selectors.region).prop('disabled', false);
            })
            .fail((error) => {
                console.error('Failed to load regions:', error);
                $(this.selectors.region).html(
                    '<option value="">Error loading regions</option>'
                );
            });
    }

    private updateProvinces(): void {
        const regionCode: string = $(this.selectors.region)
            .find(':selected')
            .data('code');

        $(this.selectors.province).prop('disabled', true);
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
            API.fetchProvinces(regionCode)
                .done((provinces: LocationItem[]) => {
                    AddressFormInput.populateSelect(
                        this.selectors.province,
                        provinces,
                        'Select Province'
                    );
                    $(this.selectors.province).prop('disabled', false);
                })
                .fail((error) => {
                    console.error(
                        `Failed to load provinces for region ${regionCode}:`,
                        error
                    );
                    $(this.selectors.province).html(
                        '<option value="">Error loading provinces</option>'
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
