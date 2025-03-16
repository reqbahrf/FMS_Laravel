import { InitializeFloatingWindow } from '../../Utilities/floating-window';
export default class ProjectStatusReportEvent {
    private form: JQuery<HTMLFormElement>;
    private parentFormWrapper: JQuery<HTMLElement>;
    private floatingWindowContainer: JQuery<HTMLElement>;
    constructor(form: JQuery<HTMLFormElement>) {
        this.form = form;
        this.parentFormWrapper = this.form.closest('#formWrapper');
        this.floatingWindowContainer =
            this.parentFormWrapper.find('#floating-window');
        this._initializeFloatingWindow();
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
