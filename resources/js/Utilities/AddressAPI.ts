const API_BASE_URL: string = 'https://psgc.gitlab.io/api';

interface LocationItem {
    name: string;
    code: string;
    [key: string]: any;
}

const API = {
    fetchRegions: (): JQuery.jqXHR<LocationItem[]> => {
        return $.ajax({
            type: 'GET',
            url: `${API_BASE_URL}/regions`,
        }).fail((error: JQuery.jqXHR) => {
            console.error('Error fetching regions:', error);
        });
    },

    fetchProvinces: (regionCode: string): JQuery.jqXHR<LocationItem[]> => {
        return $.ajax({
            type: 'GET',
            url: `${API_BASE_URL}/regions/${regionCode}/provinces`,
        }).fail((error: JQuery.jqXHR) => {
            console.error('Error fetching provinces:', error);
        });
    },

    fetchCities: (provinceCode: string): JQuery.jqXHR<LocationItem[]> => {
        return $.ajax({
            type: 'GET',
            url: `${API_BASE_URL}/provinces/${provinceCode}/cities-municipalities`,
        }).fail((error: JQuery.jqXHR) => {
            console.error('Error fetching cities:', error);
        });
    },

    fetchBarangay: (cityCode: string): JQuery.jqXHR<LocationItem[]> => {
        return $.ajax({
            type: 'GET',
            url: `${API_BASE_URL}/cities-municipalities/${cityCode}/barangays`,
        });
    },
};

export { API };
