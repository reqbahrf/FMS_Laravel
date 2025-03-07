import { showToastFeedback } from '../../Utilities/utilFunctions';

export default class ProjectClass {
    protected documentBtnSelectors: JQuery<HTMLElement>;
    private static breadcrumbEventAttached: boolean = false;
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
    protected _handleError(error: any, withToast: boolean = false): void {
        console.error('An error occurred:', error);
        if (withToast)
            showToastFeedback(
                'text-bg-danger',
                error?.responseJSON?.message ||
                    error?.message ||
                    'An unexpected error occurred.'
            );
    }

    protected _init(): void {
        if (!ProjectClass.breadcrumbEventAttached) {
            this.formContainer
                .off('click', '.breadcrumb-item:not(.active) a')
                .on('click', '.breadcrumb-item:not(.active) a', () => {
                    this._removeForm();
                    this._toggleDocumentBtnVisibility();
                });
            ProjectClass.breadcrumbEventAttached = true;
        }
    }
}
