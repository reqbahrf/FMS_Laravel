import {
    showProcessToast,
    hideProcessToast,
    showToastFeedback,
} from '../Utilities/utilFunctions';
import createConfirmationModal from '../Utilities/confirmation-modal';

interface LocalDataStructure {
    [region: string]: {
        byProvince: {
            [province: string]: {
                byCity: {
                    [city: string]: {
                        byBarangay: {
                            [barangay: string]: {
                                [enterpriseLevel: string]: number;
                            };
                        };
                    };
                };
            };
        };
    };
}

interface EnterpriseData {
    [key: string]: number;
    'Micro Enterprise': number;
    'Small Enterprise': number;
    'Medium Enterprise': number;
}

export default class AdminDashboard {
    private yearSelector: JQuery<HTMLSelectElement>;
    private generateReportBtn: JQuery<HTMLButtonElement>;
    private localData: LocalDataStructure | null;
    private monthlyDataChart: ApexCharts | null;
    private localDataChart: ApexCharts | null;
    private enterpriseLevelsDataChart: ApexCharts | null;
    private staffhandlerProjectChart: ApexCharts | null;
    private filterBySelector: JQuery<HTMLSelectElement>;
    private specificLocationSelector: JQuery<HTMLSelectElement>;

    constructor() {
        this.yearSelector = $('#yearSelector');
        this.generateReportBtn = $('#generateDashboardReport');
        this.localData = null;
        this.monthlyDataChart = null;
        this.localDataChart = null;
        this.enterpriseLevelsDataChart = null;
        this.staffhandlerProjectChart = null;
        this.filterBySelector = $('#filterBy');
        this.specificLocationSelector = $('#specificLocation');
        this.setupLocationFilterListeners();
    }

    processYearListSelector(
        yearsArray: string[],
        currentSelectedYear: string
    ): Promise<void> {
        return new Promise((resolve, reject) => {
            try {
                if (!Array.isArray(yearsArray)) {
                    throw new Error('Years must be provided as an array');
                }

                if (!this.yearSelector || !this.yearSelector.length) {
                    throw new Error('Year selector not found');
                }
                const currentYear = new Date().getFullYear();
                this.yearSelector.empty();
                const option = yearsArray.map((year) => {
                    const selected =
                        year == (currentSelectedYear ?? currentYear);
                    return $('<option>', {
                        value: year,
                        text: year,
                        selected: selected,
                    });
                });
                this.yearSelector.append(option);
                resolve();
            } catch (e) {
                console.error('Error in processYearListSelector:', e);
                reject(e);
            }
        });
    }

    async processMouthlyDataChart(monthlyData: {
        [key: string]: {
            Applicants: number;
            Ongoing: number;
            Completed: number;
        };
    }) {
        try {
            let applicants = Array(12).fill(0);
            let ongoing = Array(12).fill(0);
            let completed = Array(12).fill(0);

            const months = [
                'Jan',
                'Feb',
                'Mar',
                'Apr',
                'May',
                'Jun',
                'Jul',
                'Aug',
                'Sep',
                'Oct',
                'Nov',
                'Dec',
            ];

            Object.keys(monthlyData).forEach((month) => {
                const data = monthlyData[month];

                // Assuming 'month' matches 'Sep', 'Oct' etc.
                const monthIndex = months.indexOf(month.slice(0, 3));

                // For each series, push the respective data

                if (monthIndex !== -1) {
                    // Update the arrays for the respective data
                    applicants[monthIndex] = data.Applicants || 0;
                    ongoing[monthIndex] = data.Ongoing || 0;
                    completed[monthIndex] = data.Completed || 0;
                }
            });
            await this.createMonthlyDataChart(applicants, ongoing, completed);
        } catch (error) {
            throw new Error('Error in processMonthlyDataChart:' + error);
        }
    }

    async processLocalDataChart(localData: {
        [keys: string]: EnterpriseData;
    }): Promise<void> {
        try {
            let cities = [];
            let microCounts = [];
            let smallCounts = [];
            let mediumCounts = [];

            for (const city in localData) {
                if (localData.hasOwnProperty(city)) {
                    cities.push(city);
                    microCounts.push(localData[city]['Micro Enterprise'] ?? 0);
                    smallCounts.push(localData[city]['Small Enterprise'] ?? 0);
                    mediumCounts.push(
                        localData[city]['Medium Enterprise'] ?? 0
                    );
                }
            }

            let totalMicro = microCounts.reduce((a, b) => a + b, 0);
            let totalSmall = smallCounts.reduce((a, b) => a + b, 0);
            let totalMedium = mediumCounts.reduce((a, b) => a + b, 0);

            await this.createLocalDataChart(
                cities,
                microCounts,
                smallCounts,
                mediumCounts
            );
            await this.createEnterpriseLevels(
                totalMicro,
                totalSmall,
                totalMedium
            );
        } catch (error) {
            throw new Error('Error in processLocalDataChart:' + error);
        }
    }

    async processHandleStaffProjectChart(
        handleProject: Array<{
            Staff_Name: string;
            'Micro Enterprise': number;
            'Small Enterprise': number;
            'Medium Enterprise': number;
        }>
    ): Promise<void> {
        try {
            const staffNames = handleProject.map((item) => item.Staff_Name);
            const microEnterpriseData = handleProject.map(
                (item) => item['Micro Enterprise']
            );
            const smallEnterpriseData = handleProject.map(
                (item) => item['Small Enterprise']
            );
            const mediumEnterpriseData = handleProject.map(
                (item) => item['Medium Enterprise']
            );

            await this.createhandledProjectsChart(
                staffNames,
                microEnterpriseData,
                smallEnterpriseData,
                mediumEnterpriseData
            );
        } catch (error) {
            throw new Error('Error in processHandleStaffProjectChart:' + error);
        }
    }

    createMonthlyDataChart(
        applicants: number[],
        ongoing: number[],
        completed: number[]
    ): Promise<void> {
        const overallProject = {
            series: [
                {
                    name: 'Applicants',
                    data: applicants,
                },
                {
                    name: 'Ongoing',
                    data: ongoing,
                },
                {
                    name: 'Completed',
                    data: completed,
                },
            ],
            chart: {
                height: 350,
                type: 'bar',
            },
            stroke: {
                width: [6, 6, 6],
                curve: 'smooth',
                dashArray: [0, 0, 0],
            },
            markers: {
                size: 0,
            },
            xaxis: {
                categories: [
                    'Jan',
                    'Feb',
                    'Mar',
                    'Apr',
                    'May',
                    'Jun',
                    'Jul',
                    'Aug',
                    'Sep',
                    'Oct',
                    'Nov',
                    'Dec',
                ],
            },
            yaxis: {
                title: {
                    text: 'Count',
                },
            },
            legend: {
                tooltipHoverFormatter: function (val: string, opts: any) {
                    return (
                        val +
                        ' - ' +
                        opts.w.globals.series[opts.seriesIndex][
                            opts.dataPointIndex
                        ] +
                        ''
                    );
                },
            },
        };
        return new Promise<void>((resolve) => {
            if (this.monthlyDataChart) {
                this.monthlyDataChart.destroy();
            }
            this.monthlyDataChart = new ApexCharts(
                document.querySelector('#overallProjectGraph'),
                overallProject
            );
            this.monthlyDataChart.render();
            resolve(void 0);
        }).catch((error) => {
            throw new Error('Error in createMonthlyDataChart:' + error);
        });
    }

    createLocalDataChart(
        cities: string[],
        microCounts: number[],
        smallCounts: number[],
        mediumCounts: number[]
    ): Promise<void> {
        const options = {
            chart: {
                type: 'bar',
                height: 350,
                stacked: true,
                toolbar: {
                    show: true,
                    offsetX: 0,
                    offsetY: 0,
                    tools: {
                        download: false,
                        selection: true,
                        zoom: true,
                        zoomin: true,
                        zoomout: true,
                        pan: true,
                        reset: false,
                    },
                },
            },
            series: [
                {
                    name: 'Micro Enterprises',
                    data: microCounts,
                },
                {
                    name: 'Small Enterprises',
                    data: smallCounts,
                },
                {
                    name: 'Medium Enterprises',
                    data: mediumCounts,
                },
            ],
            dataLabels: {
                enabled: false,
            },
            yaxis: {
                title: {
                    text: 'Count',
                },
            },
            xaxis: {
                labels: {
                    show: true,
                },
                tickPlacement: 'on',
                type: 'category',
                categories: cities,
                title: {
                    text: 'Cities',
                },
                Tooltip: {
                    enabled: true,
                    formatter: function (val: string, opts: any) {
                        return opts.w.globals.labels[opts.dataPointIndex];
                    },
                },
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    dataLabels: {
                        enabled: false, // Disable data labels
                    },
                },
            },
        };
        return new Promise<void>((resolve) => {
            if (this.localDataChart) {
                this.localDataChart.destroy();
            }
            this.localDataChart = new ApexCharts(
                document.querySelector('#localeChart'),
                options
            );
            this.localDataChart.render();
            resolve();
        }).catch((error) => {
            throw new Error('Error in createLocalDataChart:' + error);
        });
    }

    createEnterpriseLevels(
        totalMicro: number,
        totalSmall: number,
        totalMedium: number
    ): Promise<void> {
        const EnterpriseLevelOptions = {
            series: [totalMicro, totalSmall, totalMedium],
            labels: [
                `Micro Enterprise`,
                `Small Enterprise`,
                `Medium Enterprise`,
            ],
            chart: {
                type: 'pie',
                width: '100%',
                height: 350,
            },
            legend: {
                show: true,
                position: 'bottom',
                fontSize: '10px',
                horizontalAlign: 'center',
                floating: false,
                offsetY: 0,
                itemMargin: {
                    horizontal: 5,
                    vertical: 2,
                },
            },
            dataLabels: {
                enabled: true,
                style: {
                    fontSize: '12px',
                },
            },
            responsive: [
                {
                    breakpoint: 480,
                    options: {
                        chart: {
                            height: 300,
                        },
                        legend: {
                            fontSize: '8px',
                            itemMargin: {
                                horizontal: 2,
                                vertical: 1,
                            },
                        },
                        dataLabels: {
                            style: {
                                fontSize: '10px',
                            },
                        },
                    },
                },
            ],
        };

        return new Promise<void>((resolve) => {
            if (this.enterpriseLevelsDataChart) {
                this.enterpriseLevelsDataChart.destroy();
            }
            this.enterpriseLevelsDataChart = new ApexCharts(
                document.querySelector('#enterpriseLevelChart'),
                EnterpriseLevelOptions
            );
            this.enterpriseLevelsDataChart.render();
            resolve();
        }).catch((error) => {
            throw new Error('Error in createEnterpriseLevels:' + error);
        });
    }
    createhandledProjectsChart(
        staffNames: string[],
        microEnterprisData: number[],
        smallEnterpriseData: number[],
        mediumEnterpriseData: number[]
    ): Promise<void> {
        const handledBusiness = {
            series: [
                {
                    name: 'Micro Enterprise',
                    data: microEnterprisData,
                },
                {
                    name: 'Small Enterprise',
                    data: smallEnterpriseData,
                },
                {
                    name: 'Medium Enterprise',
                    data: mediumEnterpriseData,
                },
            ],
            chart: {
                height: 350,
                type: 'bar',
                stacked: true,
                events: {
                    click: function (chart: any, w: any, e: any) {
                        // console.log(chart, w, e)
                    },
                },
            },
            colors: ['#008ffb', '#00e396', '#feb019'],
            plotOptions: {
                bar: {
                    columnWidth: '45%',
                    distributed: false,
                    borderRadius: 10,
                    borderRadiusApplication: 'end',
                    borderRadiusWhenStacked: 'last',
                },
            },
            dataLabels: {
                enabled: false,
            },
            legend: {
                show: true,
                position: 'bottom',
            },
            xaxis: {
                categories: staffNames,
                labels: {
                    style: {
                        colors: ['#111111'],
                        fontSize: '0.75rem',
                    },
                },
            },
        };
        return new Promise<void>((resolve) => {
            if (this.staffhandlerProjectChart) {
                this.staffhandlerProjectChart.destroy();
            }
            this.staffhandlerProjectChart = new ApexCharts(
                document.querySelector('#staffHandledB'),
                handledBusiness
            );
            this.staffhandlerProjectChart.render();
            resolve();
        }).catch((error) => {
            throw new Error('Error in createhandledProjectsChart:' + error);
        });
    }

    private setupLocationFilterListeners(): void {
        // Wait for local data to be loaded before setting up filters

        this.loadDefaultFilter();


        this.filterBySelector.on('change', () => {
            const selectedFilter = this.filterBySelector.val() as string;
            this.updateSpecificLocationSelector(selectedFilter);
        });

        this.specificLocationSelector.on('change', () => {
            const selectedFilter = this.filterBySelector.val() as string;
            const selectedLocation =
                this.specificLocationSelector.val() as string;
            this.filterAndUpdateCharts(selectedFilter, selectedLocation);
        });

    }
    private loadDefaultFilter(): void {
        if (!this.localData) {
            // If localData is not yet loaded, defer setup
            setTimeout(() => this.setupLocationFilterListeners(), 100);
            return;
        }

        // Set default values
        this.filterBySelector.val('By City');
        this.specificLocationSelector.prop('disabled', false);
        this.specificLocationSelector.empty();

        // Populate specific locations for City filter
        let cityLocations: string[] = [];
        Object.values(this.localData).forEach((regionData) => {
            Object.values(regionData.byProvince).forEach((provinceData) => {
                cityLocations = [
                    ...cityLocations,
                    ...Object.keys(provinceData.byCity),
                ];
            });
        });

        // Remove duplicates and sort
        cityLocations = [...new Set(cityLocations)].sort();

        // Add locations to selector
        this.specificLocationSelector.append($('<option>').text('Select Location'));
        cityLocations.forEach((city) => {
            this.specificLocationSelector.append(
                $('<option>').val(city).text(city)
            );
        });

        // Set default location to Tagum if it exists
        if (cityLocations.includes('Tagum')) {
            this.specificLocationSelector.val('Tagum');
        }

        // Trigger change events to initialize the selectors
        // this.filterBySelector.trigger('change');
        // this.specificLocationSelector.trigger('change');

        const defaultFilter = this.filterBySelector.val() as string;
        const defaultLocation = this.specificLocationSelector.val() as string;

        this.filterAndUpdateCharts(defaultFilter, defaultLocation);
    }

    private updateSpecificLocationSelector(filterType: string): void {
        const specificLocationSelector = this.specificLocationSelector;
        specificLocationSelector.prop('disabled', false);
        specificLocationSelector.empty();
        specificLocationSelector.append($('<option>').text('Select Location'));

        if (!this.localData) return;

        let locations: string[] = [];
        switch (filterType) {
            case 'By Region':
                locations = Object.keys(this.localData);
                break;
            case 'By Province':
                Object.values(this.localData).forEach((regionData) => {
                    locations = [
                        ...locations,
                        ...Object.keys(regionData.byProvince),
                    ];
                });
                break;
            case 'By City':
                Object.values(this.localData).forEach((regionData) => {
                    Object.values(regionData.byProvince).forEach(
                        (provinceData) => {
                            locations = [
                                ...locations,
                                ...Object.keys(provinceData.byCity),
                            ];
                        }
                    );
                });
                break;
            case 'By Barangay':
                Object.values(this.localData).forEach((regionData) => {
                    Object.values(regionData.byProvince).forEach(
                        (provinceData) => {
                            Object.values(provinceData.byCity).forEach(
                                (cityData) => {
                                    locations = [
                                        ...locations,
                                        ...Object.keys(cityData.byBarangay),
                                    ];
                                }
                            );
                        }
                    );
                });
                break;
            default:
                return;
        }

        // Remove duplicates and sort
        locations = [...new Set(locations)].sort();
        locations.forEach((location) => {
            specificLocationSelector.append(
                $('<option>').val(location).text(location)
            );
        });
    }

    private filterAndUpdateCharts(
        filterType: string,
        selectedLocation: string
    ): void {
        // Early return if localData is null or location is not selected
        if (!this.localData || selectedLocation === 'Select Location') {
            console.warn('Local data is not available or no location selected');
            return;
        }

        let filteredLocalData: { [locationKey: string]: EnterpriseData } = {};

        const filterLocations = (
            filterCallback: (
                region: string,
                province: string,
                city: string,
                barangay: string
            ) => boolean,
            locationExtractor: (
                region: string,
                province: string,
                city: string,
                barangay: string
            ) => string
        ) => {
            Object.keys(this.localData || {}).forEach((region) => {
                Object.keys(this.localData![region].byProvince).forEach(
                    (province) => {
                        Object.keys(
                            this.localData![region].byProvince[province].byCity
                        ).forEach((city) => {
                            Object.keys(
                                this.localData![region].byProvince[province]
                                    .byCity[city].byBarangay
                            ).forEach((barangay) => {
                                if (
                                    filterCallback(
                                        region,
                                        province,
                                        city,
                                        barangay
                                    )
                                ) {
                                    const locationKey = locationExtractor(
                                        region,
                                        province,
                                        city,
                                        barangay
                                    );

                                    if (!filteredLocalData[locationKey]) {
                                        filteredLocalData[locationKey] = {
                                            'Micro Enterprise': 0,
                                            'Small Enterprise': 0,
                                            'Medium Enterprise': 0,
                                        };
                                    }

                                    const barangayData =
                                        this.localData![region].byProvince[
                                            province
                                        ].byCity[city].byBarangay[barangay];

                                    const enterpriseLevels = [
                                        'Micro Enterprise',
                                        'Small Enterprise',
                                        'Medium Enterprise',
                                    ];

                                    enterpriseLevels.forEach(
                                        (enterpriseLevel) => {
                                            if (barangayData[enterpriseLevel]) {
                                                filteredLocalData[locationKey][
                                                    enterpriseLevel
                                                ] +=
                                                    barangayData[
                                                        enterpriseLevel
                                                    ];
                                            }
                                        }
                                    );
                                }
                            });
                        });
                    }
                );
            });
        };

        switch (filterType) {
            case 'By Region':
                filterLocations(
                    (region, province, city, barangay) =>
                        region === selectedLocation,
                    (region, province, city, barangay) => province
                );
                break;
            case 'By Province':
                filterLocations(
                    (region, province, city, barangay) =>
                        province === selectedLocation,
                    (region, province, city, barangay) => city
                );
                break;
            case 'By City':
                filterLocations(
                    (region, province, city, barangay) =>
                        city === selectedLocation,
                    (region, province, city, barangay) => barangay
                );
                break;
            case 'By Barangay':
                filterLocations(
                    (region, province, city, barangay) =>
                        barangay === selectedLocation,
                    (region, province, city, barangay) => barangay
                );
                break;
            default:
                console.warn(`Unsupported filter type: ${filterType}`);
                return;
        }

        // Safely call processLocalDataChart with optional chaining
        this.processLocalDataChart?.(filteredLocalData);
    }

    async getDashboardChartData(
        yearToLoad: string | null = null
    ): Promise<void> {
        try {
            const selectedYear = yearToLoad || '';
            const response = await $.ajax({
                type: 'GET',
                url: DASHBOARD_TAB_ROUTE.GET_DASHBOARD_CHARTS_DATA.replace(
                    ':yearToLoad',
                    selectedYear
                ),
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                        'content'
                    ),
                },
            });

            // Safely parse and handle monthlyData
            let monthlyData = [];
            try {
                monthlyData =
                    typeof response.monthlyData === 'string' &&
                    response.monthlyData
                        ? JSON.parse(response.monthlyData)
                        : response.monthlyData || [];
            } catch (e) {
                console.warn('Error parsing monthlyData:', e);
            }

            // Safely parse and handle localData
            this.localData = null;
            try {
                this.localData =
                    typeof response.localData === 'string' && response.localData
                        ? JSON.parse(response.localData)
                        : response.localData || [];
            } catch (e) {
                console.warn('Error parsing localData:', e);
            }

            // Safely handle other data
            const handleProject = response.staffhandledProjects || [];
            const ListChartYear = response.listOfYears || [];
            const currentSelectedYear =
                response.currentSelectedYear || ListChartYear[0];

            await Promise.all([
                this.processMouthlyDataChart(monthlyData),
                this.processHandleStaffProjectChart(handleProject),
                this.processYearListSelector(
                    ListChartYear,
                    currentSelectedYear
                ),
            ]);
        } catch (error) {
            console.error('Error in getDashboardChartData:', error);
            throw new Error('Error in getDashboardChartData: ' + error);
        }
    }

    async init(): Promise<void> {
        await this.getDashboardChartData();

        this.yearSelector.on('change', async (e) => {
            const selectedYear = $(e.target).val() as string;
            await this.getDashboardChartData(selectedYear);
        });
        this.generateReportBtn.on('click', async () => {
            const selectedYear = (this.yearSelector.val() as string) || '';
            const isConfirmed = await createConfirmationModal({
                title: 'Generate Report',
                titleBg: 'bg-primary',
                message: 'Are you sure you want to generate the report?',
                confirmText: 'Yes',
                confirmButtonClass: 'btn-primary',
                cancelText: 'No',
            });
            if (!isConfirmed) return;
            showProcessToast('Generating Report...');
            try {
                const response = await $.ajax({
                    type: 'GET',
                    url: DASHBOARD_TAB_ROUTE.GENERATE_DASHBOARD_REPORT.replace(
                        ':yearToLoad',
                        selectedYear
                    ),
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                            'content'
                        ),
                    },
                    xhrFields: {
                        responseType: 'blob',
                    },
                });

                // Check if response is JSON (error message)
                const contentType = response.type;
                if (contentType === 'application/json') {
                    // Read the blob as text to get error message
                    const reader = new FileReader();
                    reader.onload = function () {
                        const errorData = JSON.parse(this.result as string);
                        hideProcessToast();
                        showToastFeedback(
                            'text-bg-danger',
                            errorData.message || 'Failed to generate PDF'
                        );
                    };
                    reader.readAsText(response);
                    return;
                }

                // If we get here, it's a PDF response
                const blob = new Blob([response], {
                    type: 'application/pdf',
                });
                const url = window.URL.createObjectURL(blob);

                // Open PDF in new window
                window.open(url, '_blank');

                // Show success message
                hideProcessToast();
                showToastFeedback(
                    'text-bg-success',
                    'PDF generated successfully'
                );

                // Clean up the blob URL after a delay to ensure the PDF loads
                setTimeout(() => {
                    window.URL.revokeObjectURL(url);
                }, 1000);
            } catch (e) {}
        });
    }
}
