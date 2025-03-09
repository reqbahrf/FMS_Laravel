import { customFormatNumericInput } from '../../Utilities/input-utils';
import {
    formatNumber,
    parseFormattedNumberToFloat,
} from '../../Utilities/utilFunctions';

export default class ProjectInfoSheetEvent {
    private form: JQuery<HTMLFormElement>;
    private assetsInput: JQuery<HTMLInputElement>;
    private employmentInput: JQuery<HTMLInputElement>;
    private localAndExportProductInput: JQuery<HTMLInputElement>;
    constructor(form: JQuery<HTMLFormElement>) {
        this.form = form;
        this.assetsInput = this.form.find(
            '#land_val, #building_val, #equipment_val, #workingCapital_val'
        );
        this.employmentInput = this.form.find('#totalEmploymentContainer');
        this.localAndExportProductInput = this.form.find(
            '#localProduct_Val, #exportProduct_Val'
        );
        this.attachListeners();
    }

    private _calculateTotalAssets() {
        const landVal = this.form.find('#land_val').val() as string;
        const buildingVal = this.form.find('#building_val').val() as string;
        const equipmentVal = this.form.find('#equipment_val').val() as string;
        const workingCapitalVal = this.form
            .find('#workingCapital_val')
            .val() as string;
        const landAssets = parseFormattedNumberToFloat(landVal);
        const buildingAssets = parseFormattedNumberToFloat(buildingVal);
        const equipmentAssets = parseFormattedNumberToFloat(equipmentVal);
        const workingCapital = parseFormattedNumberToFloat(workingCapitalVal);
        const totalAssets =
            landAssets + buildingAssets + equipmentAssets + workingCapital;
        this.form.find('#totalAssests').val(formatNumber(totalAssets));
    }

    private calculateTotalEmploymentGenerated() {
        let manMonthTotal = 0;
        this.form.find('#totalEmploymentContainer tr').each(function () {
            const thisTableRow = $(this);
            const male = parseFormattedNumberToFloat(
                thisTableRow.find('.maleInput').val() as string
            );
            const female = parseFormattedNumberToFloat(
                thisTableRow.find('.femaleInput').val() as string
            );
            const subtotal = male + female;
            thisTableRow.find('.thisRowSubtotal').val(formatNumber(subtotal));
            manMonthTotal += subtotal;
        });
        this.form
            .find('#totalEmploymentGenerated')
            .val(formatNumber(manMonthTotal));
    }

    private calculateTotalGrossSales() {
        const localProductVal = this.form
            .find('#localProduct_Val')
            .val() as string;
        const exportProductVal = this.form
            .find('#exportProduct_Val')
            .val() as string;
        const localProduct = parseFormattedNumberToFloat(localProductVal);
        const exportProduct = parseFormattedNumberToFloat(exportProductVal);
        const totalGrossSales = localProduct + exportProduct;
        this.form.find('#totalGrossSales').val(formatNumber(totalGrossSales));
    }

    private attachListeners() {
        const self = this;
        this.assetsInput.on('input', function () {
            const thisInputId = $(this).attr('id');
            customFormatNumericInput(`#${thisInputId}`);
            self._calculateTotalAssets();
        });

        this.employmentInput.on(
            'input',
            'td input.maleInput, td input.femaleInput',
            function () {
                const thisInputId = $(this).attr('id');
                customFormatNumericInput(`#${thisInputId}`);
                self.calculateTotalEmploymentGenerated();
            }
        );

        this.localAndExportProductInput.on('input', function () {
            const thisInputId = $(this).attr('id');
            customFormatNumericInput(`#${thisInputId}`);
            self.calculateTotalGrossSales();
        });
    }
}
