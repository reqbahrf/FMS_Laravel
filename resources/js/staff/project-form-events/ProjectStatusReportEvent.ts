import FloatingWindow, {
    InitializeFloatingWindow,
} from '../../Utilities/floating-window';
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
        console.log(openButton);
        const content = this.floatingWindowContainer.find('#floating-content');
        const input = $('#projectLedgerLink') as JQuery<HTMLInputElement>;
        const window = this.floatingWindowContainer;
        const header = this.floatingWindowContainer.find('#floating-header');
        const closeButton = this.floatingWindowContainer.find('#close-button');

        openButton.on('click', async function () {
            try {
                console.table({ content, input, window, header, closeButton });
                console.log('Floating Window is opened');
                const module = InitializeFloatingWindow({
                    content,
                    input,
                    window,
                    header,
                    closeButton,
                });
                module.open();
            } catch (error) {
                console.error('Error initializing floating window:', error);
            }
        });
    }
}
