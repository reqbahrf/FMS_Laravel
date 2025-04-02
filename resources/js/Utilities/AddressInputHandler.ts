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
    home_region: string;
    home_province: string;
    home_city: string;
    home_barangay: string;
    office_region: string;
    office_province: string;
    office_city: string;
    office_barangay: string;
    factory_region: string;
    factory_province: string;
    factory_city: string;
    factory_barangay: string;
}

class AddressFormInput {
    private prefix: string;
    private selectors: Selectors;
    private instanceId: string;

    constructor(config: AddressFormConfig) {
        this.prefix = config.prefix;
        this.instanceId = `address_form_${Math.random().toString(36).substring(2, 9)}`;
        this.selectors = {
            region: `#${this.prefix}_region`,
            province: `#${this.prefix}_province`,
            city: `#${this.prefix}_city`,
            barangay: `#${this.prefix}_barangay`,
        };
        this.initializeAddressSelection();
        this.initializeSameAddressCheckboxes();
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
            const regionKey = `${prefix}_region` as keyof LocationDraftData;
            const regionValue = draftData[regionKey];

            if (!regionValue) {
                return;
            }

            const regionSelector = `#${prefix}_region`;
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

            const provinceKey = `${prefix}_province` as keyof LocationDraftData;
            const provinceValue = draftData[provinceKey];

            if (!provinceValue) {
                return;
            }

            const provinceSelector = `#${prefix}_province`;
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

            const cityKey = `${prefix}_city` as keyof LocationDraftData;
            const cityValue = draftData[cityKey];

            if (!cityValue) {
                return;
            }

            const citySelector = `#${prefix}_city`;
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
            const barangayKey = `${prefix}_barangay` as keyof LocationDraftData;
            const barangayValue = draftData[barangayKey];

            if (!barangayValue) {
                return;
            }

            const barangaySelector = `#${prefix}_barangay`;
            await AddressFormInput.loadLocationDropdown(
                barangaySelector,
                API.fetchBarangay(cityCode),
                barangayValue,
                `Select ${prefix.charAt(0).toUpperCase() + prefix.slice(1)} Barangay`
            );
        } catch (error) {
            console.error(`Error loading ${prefix} address dropdowns:`, error);
            // Reset dropdowns to a usable state
            $(`#${prefix}_province, #${prefix}_city, #${prefix}_barangay`).prop(
                'disabled',
                true
            );
        }
    };

    static loadHomeAddressDropdowns = async (
        draftData: LocationDraftData
    ): Promise<void> => {
        return AddressFormInput.loadAddressDropdowns('home', draftData);
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

    /**
     * Initialize the "Same Address With" checkboxes with namespaced events
     * to prevent multiple handlers when multiple instances are created
     */
    private initializeSameAddressCheckboxes(): void {
        if (this.prefix === 'office') {
            $('#same_address_with_home').off(`change.${this.instanceId}`);
            $('#same_address_with_home').on(
                `change.${this.instanceId}`,
                function () {
                    const isChecked = $(this).prop('checked');
                    AddressFormInput.handleSameAddressCheckbox(
                        'home',
                        'office',
                        isChecked
                    );
                }
            );
        }

        if (this.prefix === 'factory') {
            $('#same_address_with_office').off(`change.${this.instanceId}`);
            $('#same_address_with_office').on(
                `change.${this.instanceId}`,
                function () {
                    const isChecked = $(this).prop('checked');
                    AddressFormInput.handleSameAddressCheckbox(
                        'office',
                        'factory',
                        isChecked
                    );
                }
            );
        }
    }

    /**
     * Clean up event handlers when the instance is no longer needed
     */
    public destroy(): void {
        $('#same_address_with_home').off(`change.${this.instanceId}`);
        $('#same_address_with_office').off(`change.${this.instanceId}`);
        $('#same_address_with_factory').off(`change.${this.instanceId}`);
    }

    /**
     * Handle the "Same Address With" checkbox functionality
     * @param sourcePrefix The source address prefix (e.g., 'home', 'office')
     * @param targetPrefix The target address prefix (e.g., 'office', 'factory')
     * @param isChecked Whether the checkbox is checked
     */
    static handleSameAddressCheckbox(
        sourcePrefix: string,
        targetPrefix: string,
        isChecked: boolean
    ): void {
        const fields = [
            'region',
            'province',
            'city',
            'barangay',
            'landmark',
            'zipcode',
        ];

        const contactFields = ['telNo', 'faxNo', 'emailAddress'];

        const allFields = fields.concat(
            (sourcePrefix === 'office' || sourcePrefix === 'factory') &&
                (targetPrefix === 'office' || targetPrefix === 'factory')
                ? contactFields
                : []
        );

        if (isChecked) {
            // First handle non-cascading fields
            allFields.forEach((field) => {
                if (
                    !['region', 'province', 'city', 'barangay'].includes(field)
                ) {
                    const sourceValue = $(
                        `#${sourcePrefix}_${field}`
                    ).val() as string;
                    const targetElement = $(`#${targetPrefix}_${field}`);
                    targetElement.val(sourceValue);
                    targetElement.prop('disabled', true);
                }
            });

            // Handle cascading fields with proper event handling
            AddressFormInput.copyAddressHierarchy(sourcePrefix, targetPrefix);
        } else {
            allFields.forEach((field) => {
                const targetElement = $(`#${targetPrefix}_${field}`);

                if (field === 'region') {
                    targetElement.prop('disabled', false);
                } else if (field === 'province') {
                    targetElement.prop(
                        'disabled',
                        !$(`#${targetPrefix}_region`).val()
                    );
                } else if (field === 'city') {
                    targetElement.prop(
                        'disabled',
                        !$(`#${targetPrefix}_province`).val()
                    );
                } else if (field === 'barangay') {
                    targetElement.prop(
                        'disabled',
                        !$(`#${targetPrefix}_city`).val()
                    );
                } else {
                    targetElement.prop('disabled', false);
                }
            });
        }
    }

    /**
     * Copy address hierarchy (region, province, city, barangay) from source to target
     * with proper event handling for cascading dropdowns
     * @param sourcePrefix The source address prefix
     * @param targetPrefix The target address prefix
     */
    private static copyAddressHierarchy(
        sourcePrefix: string,
        targetPrefix: string
    ): void {
        const sourceRegion = $(`#${sourcePrefix}_region`);
        const sourceRegionCode = sourceRegion.find(':selected').data('code');
        const sourceRegionValue = sourceRegion.val() as string;

        const sourceProvince = $(`#${sourcePrefix}_province`);
        const sourceProvinceCode = sourceProvince
            .find(':selected')
            .data('code');
        const sourceProvinceValue = sourceProvince.val() as string;

        const sourceCity = $(`#${sourcePrefix}_city`);
        const sourceCityCode = sourceCity.find(':selected').data('code');
        const sourceCityValue = sourceCity.val() as string;

        const sourceBarangay = $(`#${sourcePrefix}_barangay`);
        const sourceBarangayValue = sourceBarangay.val() as string;

        const targetRegion = $(`#${targetPrefix}_region`);
        const targetProvince = $(`#${targetPrefix}_province`);
        const targetCity = $(`#${targetPrefix}_city`);
        const targetBarangay = $(`#${targetPrefix}_barangay`);

        targetRegion.prop('disabled', true);
        targetProvince.prop('disabled', true);
        targetCity.prop('disabled', true);
        targetBarangay.prop('disabled', true);

        targetRegion.val(sourceRegionValue);

        if (sourceRegionCode) {
            API.fetchProvinces(sourceRegionCode)
                .done((provinces: LocationItem[]) => {
                    AddressFormInput.populateSelect(
                        `#${targetPrefix}_province`,
                        provinces,
                        'Select Province'
                    );

                    targetProvince.val(sourceProvinceValue);

                    if (sourceProvinceCode) {
                        API.fetchCities(sourceProvinceCode)
                            .done((cities: LocationItem[]) => {
                                AddressFormInput.populateSelect(
                                    `#${targetPrefix}_city`,
                                    cities,
                                    'Select City'
                                );

                                targetCity.val(sourceCityValue);

                                if (sourceCityCode) {
                                    API.fetchBarangay(sourceCityCode)
                                        .done((barangays: LocationItem[]) => {
                                            AddressFormInput.populateSelect(
                                                `#${targetPrefix}_barangay`,
                                                barangays,
                                                'Select Barangay'
                                            );

                                            targetBarangay.val(
                                                sourceBarangayValue
                                            );
                                        })
                                        .fail((error) => {
                                            console.error(
                                                `Failed to load barangays for city ${sourceCityCode}:`,
                                                error
                                            );
                                        });
                                }
                            })
                            .fail((error) => {
                                console.error(
                                    `Failed to load cities for province ${sourceProvinceCode}:`,
                                    error
                                );
                            });
                    }
                })
                .fail((error) => {
                    console.error(
                        `Failed to load provinces for region ${sourceRegionCode}:`,
                        error
                    );
                });
        }
    }
}

export { AddressFormInput };
