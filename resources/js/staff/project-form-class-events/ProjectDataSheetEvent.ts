import {
    formatNumber,
    parseFormattedNumberToFloat,
} from '../../Utilities/utilFunctions';
import {
    addNewRowHandler,
    removeRowHandler,
} from '../../Utilities/add-and-remove-table-row-handler';
import { customFormatNumericInput } from '../../Utilities/input-utils';

export default class ProjectDataSheetEvent {
    private form: JQuery<HTMLFormElement>;
    private employmentInputs: JQuery<HTMLInputElement>;
    private localAndExportProductInputs: JQuery<HTMLInputElement>;
    private toBeAccomplishedProductivityInputs: JQuery<HTMLInputElement>;
    constructor(form: JQuery<HTMLFormElement>) {
        this.form = form;
        this.employmentInputs = this.form.find('#totalEmployment');
        this.localAndExportProductInputs = this.form.find(
            '#localProducts, #exportProducts'
        );
        this.toBeAccomplishedProductivityInputs =
            this.form.find('#ToBeAccomplished');
        this._attachEventListeners();

        this._calculateTotalEmployment();
        this._calculateLocalAndExportProductsTotals();
        this._calculateToBeAccomplishedProductivity();
    }

    private _calculateTotalEmployment() {
        let totalNumPersonel = 0;
        let totalManMonth = 0;
        this.form.find('#totalEmployment tr').each(function () {
            const tableRow = $(this);
            const totalMalePersonel = parseFormattedNumberToFloat(
                tableRow.find('.maleInput').val() as string
            );
            const totalFemalePersonel = parseFormattedNumberToFloat(
                tableRow.find('.femaleInput').val() as string
            );
            const workDays = parseFormattedNumberToFloat(
                tableRow.find('.workdayInput').val() as string
            );
            const thisRowManMonth =
                (totalMalePersonel + totalFemalePersonel) * (workDays / 20);
            tableRow.find('.totalManMonth').val(formatNumber(thisRowManMonth));

            totalNumPersonel += totalMalePersonel + totalFemalePersonel;

            totalManMonth += parseFormattedNumberToFloat(
                tableRow.find('.totalManMonth').val() as string
            );
        });
        this.form.find('#TotalManMonth').val(formatNumber(totalManMonth));
        this.form.find('#TotalEmployment').val(formatNumber(totalNumPersonel));
    }

    private _calculateLocalAndExportProductsTotals() {
        let totalGrossSales = 0;
        let totalProductionCost = 0;
        let totalNetSales = 0;

        this.form
            .find('#localProducts tr, #exportProducts tr')
            .each(function () {
                const tableRow = $(this);
                let grossSales = parseFormattedNumberToFloat(
                    tableRow.find('.grossSales_val').val() as string
                );
                let productionCost = parseFormattedNumberToFloat(
                    tableRow.find('.productionCost_val').val() as string
                );

                let netSales = grossSales - productionCost;

                let FormattedNetSales = formatNumber(netSales);

                tableRow.find('.netSales_val').val(FormattedNetSales);

                totalGrossSales += grossSales;
                totalProductionCost += productionCost;
                totalNetSales += netSales;
            });

        this.form
            .find('#totalGrossSales')
            .val(`₱ ${formatNumber(totalGrossSales)}`);
        this.form
            .find('#totalProductionCost')
            .val(`₱ ${formatNumber(totalProductionCost)}`);
        this.form
            .find('#totalNetSales')
            .val(`₱ ${formatNumber(totalNetSales)}`);

        this.form
            .find('.CurrentgrossSales_val')
            .val(formatNumber(totalGrossSales));
    }

    private _calculateToBeAccomplishedProductivity() {
        const increaseInProductivityRow = this.form.find(
            '#ToBeAccomplished .increaseInProductivity'
        );

        const CurrentAndPreviousgrossSales = this.form
            .find(
                '#ToBeAccomplished td .CurrentgrossSales_val, td .PreviousgrossSales_val, td .TotalgrossSales_val'
            )
            .closest('tr');

        const CurrentgrossSales = parseFormattedNumberToFloat(
            CurrentAndPreviousgrossSales.find(
                '.CurrentgrossSales_val'
            ).val() as string
        );
        const PreviousgrossSales = parseFormattedNumberToFloat(
            CurrentAndPreviousgrossSales.find(
                '.PreviousgrossSales_val'
            ).val() as string
        );

        increaseInProductivityRow
            .find('.CurrentgrossSales_val_cal')
            .text(formatNumber(CurrentgrossSales));

        increaseInProductivityRow
            .find('.PreviousgrossSales_val_cal')
            .text(formatNumber(PreviousgrossSales));

        increaseInProductivityRow
            .find('.TotalgrossSales_val_cal')
            .text(formatNumber(CurrentgrossSales + PreviousgrossSales));

        const TotalgrossSales = CurrentgrossSales - PreviousgrossSales;
        CurrentAndPreviousgrossSales.find('.TotalgrossSales_val').val(
            formatNumber(TotalgrossSales)
        );

        const increaseInProductivityByPercent =
            ((CurrentgrossSales - PreviousgrossSales) / PreviousgrossSales) *
            100;
        increaseInProductivityRow
            .find('.totalgrossSales_percent')
            .val(`${increaseInProductivityByPercent.toFixed(2)}%`);
    }

    private _attachEventListeners() {
        const self = this;
        this.employmentInputs.on(
            'input',
            'td input.maleInput, td input.femaleInput, td input.workdayInput',
            function () {
                const thisEmployeeRow = $(this);
                customFormatNumericInput(`#${thisEmployeeRow.attr('id')}`);

                const employeeRow = thisEmployeeRow.closest('tr');
                const maleVal = parseFormattedNumberToFloat(
                    employeeRow.find('.maleInput').val() as string
                );
                const femaleVal = parseFormattedNumberToFloat(
                    employeeRow.find('.femaleInput').val() as string
                );
                const workDays = parseFormattedNumberToFloat(
                    employeeRow.find('.workdayInput').val() as string
                );

                const totalManMonth = (workDays / 20) * (maleVal + femaleVal);
                employeeRow.find('.totalManMonth').val(totalManMonth);

                self._calculateTotalEmployment();
            }
        );

        this.localAndExportProductInputs.on(
            'input',
            'td input.grossSales_val, td input.productionCost_val',
            function () {
                const thisProductRow = $(this);
                customFormatNumericInput(`#${thisProductRow.attr('id')}`);

                const productRow = thisProductRow.closest('tr');
                const grossSales = parseFormattedNumberToFloat(
                    productRow.find('.grossSales_val').val() as string
                );
                const productionCost = parseFormattedNumberToFloat(
                    productRow.find('.productionCost_val').val() as string
                );

                const netSales = grossSales - productionCost;
                productRow.find('.netSales_val').val(formatNumber(netSales));

                self._calculateLocalAndExportProductsTotals();
            }
        );

        this.toBeAccomplishedProductivityInputs.on(
            'input',
            'td .CurrentgrossSales_val, td .PreviousgrossSales_val',
            function () {
                const thisInputClass = $(this).attr('class');
                customFormatNumericInput(`.${thisInputClass}`);
                self._calculateToBeAccomplishedProductivity();
            }
        );
    }
}
