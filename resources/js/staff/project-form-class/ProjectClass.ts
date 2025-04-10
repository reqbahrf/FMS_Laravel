import { showToastFeedback } from '../../Utilities/feedback-toast';

export default class ProjectClass {
    protected documentBtnSelectors: JQuery<HTMLElement>;
    constructor(protected formContainer: JQuery<HTMLElement>) {
        this.formContainer = formContainer;
        this.documentBtnSelectors = this.formContainer.find(
            '#selectDOC_toGenerate'
        );
        this._init();
    }
    protected _toggleDocumentBtnVisibility(): void {
        this.documentBtnSelectors.toggleClass('d-none');
    }

    protected _removeForm(): void {
        this.formContainer.find('#formWrapper').remove();
    }
    protected _handleError(
        prefix: string,
        error: any,
        withToast: boolean = false
    ): void {
        console.error(prefix + this._processMessage(error));
        if (withToast)
            showToastFeedback(
                'text-bg-danger',
                prefix + this._processMessage(error)
            );
    }
    private _processMessage(error: any): string {
        return (
            error?.responseJSON?.message ||
            error?.message ||
            'An unexpected error occurred.'
        );
    }

    protected _init(): void {
        this.formContainer
            .off('click', '.breadcrumb-item:not(.active) a')
            .on('click', '.breadcrumb-item:not(.active) a', () => {
                this._removeForm();
                this._toggleDocumentBtnVisibility();
            });
    }
}
