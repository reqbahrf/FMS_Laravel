import { customFormatNumericInput } from '../../Utilities/input-utils';
import { yearInputs } from '../../Utilities/input-utils';
export default class ProposalFormEvent {
    private form: JQuery<HTMLFormElement> | null
    private numberInputSelectors: string[] | null
    private yearInputSelectors: string[] | null

    constructor(form: JQuery<HTMLFormElement>) {
        this.form = form;
        this.numberInputSelectors = this._getNumericInputs();
        this.yearInputSelectors = this._getYearInputs();
        console.table(this.numberInputSelectors)

        customFormatNumericInput(this.form, this.numberInputSelectors);
        yearInputs(this.form, this.yearInputSelectors);
    }

    private _getNumericInputs(): string[] {
        if(!this.form) return [];
        return this.form.find('[data-custom-numeric-input]').map((idx, el) => (el.getAttribute('name') ? `input[name="${el.getAttribute('name')}"]` : `input.${el.getAttribute('class')}`)).toArray().filter(Boolean);
    }

    private _getYearInputs(): string[] {
        if(!this.form) return [];
        return this.form.find('[data-year-input]').map((idx, el) => (el.getAttribute('name') ? `input[name="${el.getAttribute('name')}"]` : `input.${el.getAttribute('class')}`)).toArray().filter(Boolean);
    }

    destroy(): void {
        // Remove specific input event listeners
        if(!this.form || !this.numberInputSelectors || !this.yearInputSelectors) return;
        this.form.off('input', this.numberInputSelectors.join(','));
        this.form.off('input', this.yearInputSelectors.join(','));
        // Optional: Clear any references to prevent memory leaks
        this.form = null;
        this.numberInputSelectors = null;
        this.yearInputSelectors = null;
    }
}
