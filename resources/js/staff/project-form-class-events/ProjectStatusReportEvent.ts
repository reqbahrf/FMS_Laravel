import { InitializeFloatingWindow } from '../../Utilities/floating-window';
import {
    addNewRowHandler,
    removeRowHandler,
} from '../../Utilities/add-and-remove-table-row-handler';
import { customFormatNumericInput } from '../../Utilities/input-utils';
export default class ProjectStatusReportEvent {
    private form: JQuery<HTMLFormElement>;
    private parentFormWrapper: JQuery<HTMLElement>;
    private floatingWindowContainer: JQuery<HTMLElement>;
    constructor(form: JQuery<HTMLFormElement>) {
        this.form = form;
        this.parentFormWrapper = this.form.closest('#formWrapper');
        this.floatingWindowContainer =
            this.parentFormWrapper.find('#floating-window');
        this._initializeInputFormatters();
        this._initializeFloatingWindow();
        this._initializeAddAndRemoveTableRow();
    }

    private _initializeInputFormatters() {
        customFormatNumericInput(
            this.form.find('div#projectInfo table tbody td'),
            'input.amount_of_setup_assistance'
        );
        customFormatNumericInput(
            this.form.find('table#equipmentAndFacilitiesTable tbody'),
            [
                'td input.approved_qty',
                'td input.approved_cost',
                'td input.actual_qty',
                'td input.actual_cost',
            ]
        );
        customFormatNumericInput(
            this.form.find('table#nonEquipmentItemsTable tbody'),
            [
                'td input.approved_qty',
                'td input.approved_cost',
                'td input.actual_qty',
                'td input.actual_cost',
            ]
        );

        customFormatNumericInput(
            this.form.find('div#statusFundUtilization table'),
            [
                'td input[name="total_approved_project_cost"]',
                'td input[name="amount_utilized_per_financial_report"]',
            ]
        );

        customFormatNumericInput(this.form.find('div#statusOfRefund table'), [
            'td input[name="total_amount_to_be_refunded"]',
            'td input[name="total_amount_already_due"]',
            'td input[name="total_amount_refunded"]',
        ]);

        customFormatNumericInput(
            this.form.find('table#volumeAndValueProductionTable tbody'),
            'td input.sales_gross_sales'
        );

        customFormatNumericInput(
            this.form.find('table#indirectEmploymentTable tbody'),
            [
                'td input.forward_male',
                'td input.forward_female',
                'td input.backward_male',
                'td input.backward_female',
            ]
        );
    }

    private _initializeAddAndRemoveTableRow() {
        try {
            addNewRowHandler(
                '#addEquipmentAndFacilitiesRow',
                '#equipmentAndFacilitiesPurchased'
            );
            removeRowHandler(
                '#removeEquipmentAndFacilitiesRow',
                '#equipmentAndFacilitiesPurchased'
            );

            addNewRowHandler('#addNonEquipmentRow', '#nonEquipmentItems');
            removeRowHandler('#removeNonEquipmentRow', '#nonEquipmentItems');

            addNewRowHandler(
                '#addVolumeAndValueProductionRow',
                '#volumeAndValueProduction'
            );
            removeRowHandler(
                '#removeVolumeAndValueProductionRow',
                '#volumeAndValueProduction'
            );

            addNewRowHandler(
                '#addNewIndirectEmploymentRow',
                '#newIndirectEmploymentFromTheProject'
            );
            removeRowHandler(
                '#removeNewIndirectEmploymentRow',
                '#newIndirectEmploymentFromTheProject'
            );
        } catch (error) {
            console.error(
                'Error initializing add and remove table row:',
                error
            );
        }
    }

    private _initializeFloatingWindow() {
        console.log('this Floating Window is initialize');
        const openButton = this.parentFormWrapper.find(
            'button#open-floating-window'
        );

        const f_content =
            this.floatingWindowContainer.find('#floating-content');
        const f_input = $('#projectLedgerLink') as JQuery<HTMLInputElement>;
        const f_window = this.floatingWindowContainer;
        const f_header = this.floatingWindowContainer.find('#floating-header');
        const f_closeButton =
            this.floatingWindowContainer.find('#close-button');

        openButton.on('click', async function () {
            try {
                console.log('Floating Window is opened');
                const module = InitializeFloatingWindow({
                    f_content,
                    f_input,
                    f_window,
                    f_header,
                    f_closeButton,
                });
                module.open();
            } catch (error) {
                console.error('Error initializing floating window:', error);
            }
        });
    }
}
