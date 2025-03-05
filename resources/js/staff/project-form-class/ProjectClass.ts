export default class ProjectClass {
    protected documentBtnSelectors: JQuery<HTMLElement>;
    private static breadcrumbEventAttached: boolean = false;
    constructor(protected FormContainer: JQuery<HTMLElement>) {
        this.FormContainer = FormContainer;
        this.documentBtnSelectors = this.FormContainer.find(
            '#selectDOC_toGenerate'
        );
        this._init();
    }
    protected _toggleDocumentBtnVisibility(): void {
        this.documentBtnSelectors.toggleClass('d-none');
    }

    protected _removeForm(): void {
        this.FormContainer.find('#formWrapper').remove();
    }

    protected _init(): void {
        if (!ProjectClass.breadcrumbEventAttached) {
            this.FormContainer.off(
                'click',
                '.breadcrumb-item:not(.active) a'
            ).on('click', '.breadcrumb-item:not(.active) a', () => {
                this._removeForm();
                this._toggleDocumentBtnVisibility();
            });
            ProjectClass.breadcrumbEventAttached = true;
        }
    }
}
