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
    }

    destroy(): void {
        // Remove specific input event listeners
        if(!this.form || !this.yearInputSelectors) return;
        const yearInputSelectors = this.yearInputSelectors.join(',');
        this.form?.off('input', yearInputSelectors);

        // Optional: Clear any references to prevent memory leaks
        this.form = null;
        this.yearInputSelectors = null;
        this.numberInputSelectors = null;
    }
}
