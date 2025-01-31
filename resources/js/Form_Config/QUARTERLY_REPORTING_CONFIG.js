const QUARTERLY_REPORTING_FORM_CONFIG = {
    formSelector: '#quarterlyForm',
    tableSelectors: {
        ExportProduct: '#ExportOutletTable',
        LocalProduct: '#LocalOutletTable',
    },
    tableRowConfigs: {
        ExportProduct: {
            createRow: (rowData) => {
                return createMarketTableRow(rowData);
            },
        },
        LocalProduct: {
            createRow: (rowData) => {
                return createMarketTableRow(rowData);
            },
        },
    },
};

const createMarketTableRow = (rowData) => {
    return html`<tr class="table_row">
        <td>
            <input
                class="form-control productName"
                type="text"
                value="${rowData.ProductName || ''}"
            />
        </td>
        <td>
            <textarea class="form-control w-100 packingDetails">
${rowData.PackingDetails || ''}</textarea
            >
        </td>
        <td>
            <div class="input-group">
                <input
                    class="form-control productionVolume_val"
                    type="text"
                    value="${rowData.volumeOfProduction.value || ''}"
                />
                <select class="form-select volumeUnit">
                    <!-- Volume Units -->
                    <optgroup label="Volume">
                        <option
                            value="mL"
                            ${rowData.volumeOfProduction.unit === 'mL'
                                ? 'selected'
                                : ''}
                        >
                            Milliliters (mL)
                        </option>
                        <option
                            value="cm³"
                            ${rowData.volumeOfProduction.unit === 'cm³'
                                ? 'selected'
                                : ''}
                        >
                            Cubic Centimeters (cm³)
                        </option>
                        <option
                            value="fl oz"
                            ${rowData.volumeOfProduction.unit === 'fl oz'
                                ? 'selected'
                                : ''}
                        >
                            Fluid Ounces (fl oz)
                        </option>
                        <option
                            value="cup"
                            ${rowData.volumeOfProduction.unit === 'cup'
                                ? 'selected'
                                : ''}
                        >
                            Cups (cup)
                        </option>
                        <option
                            value="pt"
                            ${rowData.volumeOfProduction.unit === 'pt'
                                ? 'selected'
                                : ''}
                        >
                            Pints (pt)
                        </option>
                        <option
                            value="qt"
                            ${rowData.volumeOfProduction.unit === 'qt'
                                ? 'selected'
                                : ''}
                        >
                            Quarts (qt)
                        </option>
                        <option
                            value="L"
                            ${rowData.volumeOfProduction.unit === 'L'
                                ? 'selected'
                                : ''}
                        >
                            Liters (L)
                        </option>
                        <option
                            value="gal"
                            ${rowData.volumeOfProduction.unit === 'gal'
                                ? 'selected'
                                : ''}
                        >
                            Gallons (gal)
                        </option>
                        <option
                            value="in³"
                            ${rowData.volumeOfProduction.unit === 'in³'
                                ? 'selected'
                                : ''}
                        >
                            Cubic Inches (in³)
                        </option>
                        <option
                            value="ft³"
                            ${rowData.volumeOfProduction.unit === 'ft³'
                                ? 'selected'
                                : ''}
                        >
                            Cubic Feet (ft³)
                        </option>
                        <option
                            value="m³"
                            ${rowData.volumeOfProduction.unit === 'm³'
                                ? 'selected'
                                : ''}
                        >
                            Cubic Meters (m³)
                        </option>
                    </optgroup>
                    <!-- Weight Units -->
                    <optgroup label="Weight">
                        <option
                            value="g"
                            ${rowData.volumeOfProduction.unit === 'g'
                                ? 'selected'
                                : ''}
                        >
                            Grams (g)
                        </option>
                        <option
                            value="oz"
                            ${rowData.volumeOfProduction.unit === 'oz'
                                ? 'selected'
                                : ''}
                        >
                            Ounces (oz)
                        </option>
                        <option
                            value="lb"
                            ${rowData.volumeOfProduction.unit === 'lb'
                                ? 'selected'
                                : ''}
                        >
                            Pounds (lb)
                        </option>
                        <option
                            value="kg"
                            ${rowData.volumeOfProduction.unit === 'kg'
                                ? 'selected'
                                : ''}
                        >
                            Kilograms (kg)
                        </option>
                    </optgroup>
                </select>
            </div>
        </td>
        <td>
            <div class="input-group">
                <span class="input-group-text"> ₱ </span>
                <input
                    class="form-control grossSales_val"
                    type="text"
                    value="${rowData.grossSales || ''}"
                />
            </div>
        </td>
        <td>
            <div class="input-group">
                <span class="input-group-text"> ₱ </span>
                <input
                    class="form-control estimatedCostOfProduction_val"
                    type="text"
                    value="${rowData.estimatedCostOfProduction || ''}"
                />
            </div>
        </td>
        <td>
            <div class="input-group">
                <span class="input-group-text"> ₱ </span>
                <input
                    class="form-control netSales_val"
                    type="text"
                    value="${rowData.netSales || ''}"
                />
            </div>
        </td>
    </tr>`;
};

export default QUARTERLY_REPORTING_FORM_CONFIG;
