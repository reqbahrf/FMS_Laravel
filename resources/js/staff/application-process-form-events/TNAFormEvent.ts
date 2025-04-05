import {
    addNewRowHandler,
    removeRowHandler,
} from '../../Utilities/add-and-remove-table-row-handler';
import {
    customFormatNumericInput,
    yearInputs,
} from '../../Utilities/input-utils';

export default class TNAFormEvent {
    private form: JQuery<HTMLFormElement> | null;
    private yearInputSelectors: string[] | null;
    private numberInputSelectors: string[] | null;

    constructor(form: JQuery<HTMLFormElement>) {
        this.form = form;
        this.yearInputSelectors = [
            'input[name="yearEnterpriseRegistered"]',
            'input[name="yearEstablished"]',
            'input[name="permit_year_registered"]',
        ];

        this.numberInputSelectors = [
            '.VolumeProduction',
            '.UnitCost',
            '.AnnualCost',
            '.VolumeUsed',
            'input[name="initial_capitalization"]',
            'input[name="present_capitalization"]',
            'input[name="DirectWorkers"]',
            'input[name="production"]',
            'input[name="non_production"]',
            'input[name="indirect_workers"]',
            'input[name="total"]',
        ];

        customFormatNumericInput(this.form, this.numberInputSelectors);
        yearInputs(this.form, this.yearInputSelectors);
        this._initAddTableRowEvent();
    }

    private _initAddTableRowEvent() {
        if (!this.form) return;

        addNewRowHandler(
            '#addProductAndSupplyRow',
            this.form.find('#productAndSupplyChainContainer')
        );
        removeRowHandler(
            '#removeProductAndSupplyRow',
            this.form.find('#productAndSupplyChainContainer')
        );
        addNewRowHandler(
            '#addProductionRow',
            this.form.find('#productionContainer')
        );
        removeRowHandler(
            '#removeProductionRow',
            this.form.find('#productionContainer')
        );

        addNewRowHandler(
            '#addProductionEquipmentRow',
            this.form.find('#productionEquipmentContainer')
        );
        removeRowHandler(
            '#removeProductionEquipmentRow',
            this.form.find('#productionEquipmentContainer')
        );
    }

    destroy(): void {
        // Remove specific input event listeners
        if (!this.form || !this.yearInputSelectors) return;
        const yearInputSelectors = this.yearInputSelectors.join(',');
        this.form?.off('input', yearInputSelectors);

        // Optional: Clear any references to prevent memory leaks
        this.form = null;
        this.yearInputSelectors = null;
        this.numberInputSelectors = null;
    }
}
