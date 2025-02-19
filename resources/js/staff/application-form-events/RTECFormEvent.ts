import { customFormatNumericInput } from '../../Utilities/input-utils';

export default class RTECFormEvent {
    private form: JQuery<HTMLFormElement> | null;
    private numberInputSelectors: string[] | null;

    constructor(form: JQuery<HTMLFormElement>) {
        this.form = form;
        this.numberInputSelectors = this._getNumericInputs();
        customFormatNumericInput(this.form, this.numberInputSelectors);
    }

    private _getNumericInputs(): string[] {
        if(!this.form) return [];
        return this.form.find('[data-custom-numeric-input]').map((idx, el) => (el.getAttribute('name') ? `input[name="${el.getAttribute('name')}"]` : `input.${el.getAttribute('class')}`)).toArray().filter(Boolean);
    }

    destroy(): void {
        // Remove specific input event listeners
        if(!this.form || !this.numberInputSelectors) return;
        this.form.off('input', this.numberInputSelectors.join(','));
        // Optional: Clear any references to prevent memory leaks
        this.form = null;
        this.numberInputSelectors = null;
    }
}
