class ProjectStatusReportEvent {
    private form: JQuery<HTMLFormElement>;
    private floatingWindowContainer: JQuery<HTMLElement>;
    constructor(form: JQuery<HTMLFormElement>) {
        this.form = form;
        this.floatingWindowContainer = this.form.closest('.floating-window');
        this._initializeFloatingWindow();
    }

    private _initializeFloatingWindow() {
        const openButton = this.floatingWindowContainer.find(
            '#open-floating-window'
        );
        const content = this.floatingWindowContainer.find('#floating-content');
        const input = this.floatingWindowContainer.find(
            '#projectLedgerLink'
        ) as JQuery<HTMLInputElement>;
        const window = this.floatingWindowContainer.find('#floating-window');
        const header = this.floatingWindowContainer.find('#floating-header');
        const closeButton = this.floatingWindowContainer.find('#close-button');

        openButton.on('click', async function () {
            const module = await import('../../Utilities/floating-window');
            if (module.InitializeFloatingWindow) {
                module.InitializeFloatingWindow({
                    content,
                    input,
                    window,
                    header,
                    closeButton,
                });
            }
        });
    }
}
