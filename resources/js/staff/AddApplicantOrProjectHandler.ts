import * as bootstrap from 'bootstrap';
export default class AddApplicantOrProjectHandler {
    private modal: JQuery<HTMLElement> | null = null;
    private resolveChoice: ((action: string) => void) | null = null;
    private rejectChoice: ((reason: any) => void) | null = null;
    private bootstrapModal: bootstrap.Modal | null = null;

    /**
     * Static factory method to create and initialize the handler
     * @returns Promise<string> Resolves with either 'applicant', 'project', or rejects if modal is dismissed
     */
    public static create(): Promise<string> {
        const handler = new AddApplicantOrProjectHandler();
        return handler.showChoiceModal();
    }
    /**
     * Shows the choice modal and returns a promise that resolves with the user's choice
     * @returns Promise<string> Resolves with either 'applicant', 'project', or rejects if modal is dismissed
     */
    private showChoiceModal(): Promise<string> {
        return new Promise<string>((resolve, reject) => {
            this.resolveChoice = (action: string) => resolve(action);
            this.rejectChoice = (reason: any) => {
                reject(reason);
            };
            this.initialize();
        });
    }

    /**
     * Initialize the handler and create the modal
     */
    private initialize(): void {
        if ($('#actionChoiceModal').length === 0) {
            this.createModal();
        }

        this.modal = $('#actionChoiceModal');
        if (typeof bootstrap !== 'undefined') {
            this.bootstrapModal = new bootstrap.Modal(
                $('#actionChoiceModal')[0]
            );
        }

        this.showModal();
        this.setupEventListeners();
    }

    /**
     * Creates the Bootstrap modal in the DOM using jQuery
     */
    private createModal(): void {
        const modalHTML = /*html*/ `
            <div class="modal fade" id="actionChoiceModal" tabindex="-1" aria-labelledby="actionChoiceModalLabel"
                aria-hidden="true" data-bs-backdrop="static">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header bg-primary text-white">
                            <h5 class="modal-title" id="actionChoiceModalLabel">Choose an Action</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Please select an action to continue:</p>
                            <div class="d-grid gap-2">
                                <button id="addNewApplicantBtn" class="btn btn-outline-success btn-lg">
                                    <i class="ri-user-add-line"></i> Add New Applicant
                                </button>
                                <button id="addExistingProjectBtn" class="btn btn-outline-success btn-lg">
                                    <i class="ri-folder-add-line"></i> Add Existing Project
                                </button>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
        `;

        // Append modal to body using jQuery
        $('body').append(modalHTML);
    }

    /**
     * Shows the Bootstrap modal using proper Bootstrap methods
     */
    private showModal(): void {
        if (this.bootstrapModal) {
            this.bootstrapModal.show();
        }
    }

    /**
     * Sets up event listeners for the modal buttons using jQuery
     */
    private setupEventListeners(): void {
        this.modal?.find('#addNewApplicantBtn').on('click', () => {
            this.hideModal();
            this.AddNewApplicant();
        });

        this.modal?.find('#addExistingProjectBtn').on('click', () => {
            this.hideModal();
            this.AddExistingProject();
        });

        // Handle modal dismissal (Cancel button or clicking outside)
        this.modal?.on('hidden.bs.modal', () => {
            if (this.rejectChoice) {
                this.rejectChoice('Modal dismissed without making a choice');
            }
        });
    }

    /**
     * Hides the modal using proper Bootstrap methods
     */
    private hideModal(): void {
        if (this.bootstrapModal) {
            this.bootstrapModal.hide();
        }
    }

    /**
     * Handles adding a new applicant
     */
    public AddNewApplicant(): void {
        if (this.resolveChoice) {
            this.resolveChoice('applicant');
        }
    }

    /**
     * Handles adding an existing project
     */
    public AddExistingProject(): void {
        if (this.resolveChoice) {
            this.resolveChoice('project');
        }
    }
}
