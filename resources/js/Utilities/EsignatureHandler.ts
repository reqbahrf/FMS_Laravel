import SignaturePad from 'signature_pad';

type Layout = 'default' | 'formal';

class EsignatureHandler {
    private container: JQuery;
    private signaturePads: SignaturePad[];
    private esignatures: {
        layout: Layout;
        name: string;
        topText?: string;
        bottomText?: string;
        position?: string;
        date?: string;
        signatureData: string;
    }[];
    private layout: Layout;
    private hasDate: boolean;
    constructor(
        containerSelector: string,
        layout: Layout = 'default',
        hasDate: boolean = false
    ) {
        this.container = $(containerSelector);
        this.signaturePads = [];
        this.esignatures = [];
        this.layout = layout;
        this.hasDate = hasDate;
        this.initialize();
    }

    initialize() {
        this.initializeBtns();
        this.initializeFirstSignaturePad();
        this.toggleDeleteButton();
        this.attachEventListeners();
    }

    initializeBtns() {
        const addRowBtn = /*html*/ `<button type="button" class="btn btn-success btn-sm me-2 add-row-btn">
            <i class="ri-add-fill"></i>
            </button>`;
        const deleteRowBtn = /*html*/ `<button type="button" class="btn btn-danger btn-sm me-2 delete-row-btn">
            <i class="ri-subtract-fill"></i>
            </button>`;
        const btnContainer = document.createElement('div');
        btnContainer.classList.add(
            'd-flex',
            'justify-content-end',
            'mb-2',
            'addAndRemoveButton_Container'
        );
        btnContainer.innerHTML = addRowBtn + deleteRowBtn;
        this.container.find('.card-body').prepend(btnContainer);
    }

    initializeSignaturePad(canvas: HTMLCanvasElement): SignaturePad {
        const ratio = Math.max(window.devicePixelRatio || 1, 1);
        canvas.width = canvas.offsetWidth * ratio;
        canvas.height = canvas.offsetHeight * ratio;
        const ctx = canvas.getContext('2d');
        ctx?.scale(ratio, ratio);

        return new SignaturePad(canvas, {
            minWidth: 2,
            maxWidth: 5,
        });
    }

    initializeFirstSignaturePad() {
        const firstCanvas = this.container.find(
            '.esignature-canvas'
        )[0] as HTMLCanvasElement;
        if (firstCanvas) {
            const firstPad = this.initializeSignaturePad(firstCanvas);
            if (firstPad) {
                this.signaturePads.push(firstPad);
            }
        }
    }

    toggleDeleteButton() {
        const rows = this.container.find('.esignature-row');
        const deleteBtn = this.container.find('.delete-row-btn');
        deleteBtn.prop('disabled', rows.length <= 1);
    }

    addRow() {
        const container = this.container.find('.card-body');
        const originalRow = container.find('.esignature-row').first();
        const newRow = originalRow.clone();

        // Clear input values and reset the signature canvas in the new row
        newRow.find('input').val('');
        const oldCanvas = newRow.find('.esignature-canvas');
        const newCanvas = $('<canvas>')
            .addClass('border rounded w-100 esignature-canvas')
            .attr('width', '300')
            .attr('height', '180');
        oldCanvas.replaceWith(newCanvas);

        container.find('.esignature-row:last').after(newRow);

        const newPad = this.initializeSignaturePad(
            newCanvas[0] as HTMLCanvasElement
        );
        if (newPad) {
            this.signaturePads.push(newPad);
        }

        this.toggleDeleteButton();
    }

    deleteRow(clickedButton: string) {
        const container = $(clickedButton).closest('.card-body');
        const rows = container.find('.esignature-row');

        if (rows.length > 1) {
            this.signaturePads.pop();
            rows.last().remove();
            this.toggleDeleteButton();
        }
    }

    clearSignature(clickedButton: string) {
        const row = $(clickedButton).closest('.esignature-row');
        const padIndex = this.container.find('.esignature-row').index(row);
        if (this.signaturePads[padIndex]) {
            this.signaturePads[padIndex].clear();
        }
    }

    handleImageUpload(input: HTMLInputElement) {
        const file = input?.files?.[0];
        const row = $(input).closest('.esignature-row');
        const padIndex = this.container.find('.esignature-row').index(row);

        if (file && this.signaturePads[padIndex]) {
            const reader = new FileReader();
            reader.onload = (e) => {
                const img = new Image();
                img.onload = () => {
                    const canvas = row.find(
                        '.esignature-canvas'
                    )[0] as HTMLCanvasElement;
                    const ctx = canvas.getContext('2d');
                    if (!ctx) return;
                    ctx.clearRect(0, 0, canvas.width, canvas.height);
                    ctx.drawImage(img, 0, 0, canvas.width, canvas.height);
                };
                img.src = e?.target?.result as string;
            };
            reader.readAsDataURL(file);
        }
    }

    handleResize() {
        this.container
            .find('.esignature-canvas')
            .each((index, canvasElement) => {
                const canvas = canvasElement as HTMLCanvasElement;
                const ratio = Math.max(window.devicePixelRatio || 1, 1);
                canvas.width = canvas.offsetWidth * ratio;
                canvas.height = canvas.offsetHeight * ratio;
                const ctx = canvas.getContext('2d');
                ctx?.scale(ratio, ratio);

                // Reinitialize signature pad and redraw from data URL if available
                if (this.signaturePads[index]) {
                    const oldDataUrl = this.signaturePads[index].toDataURL(); // Get the old signature
                    this.signaturePads[index] = this.initializeSignaturePad(
                        canvas as HTMLCanvasElement
                    );
                    if (oldDataUrl !== 'data:,') {
                        // Check if the old signature was not empty
                        const img = new Image();
                        img.onload = () => {
                            ctx?.drawImage(
                                img,
                                0,
                                0,
                                canvas.width / ratio,
                                canvas.height / ratio
                            );
                        };
                        img.src = oldDataUrl;
                    }
                }
            });
    }

    attachEventListeners() {
        // Use "this" to refer to the instance within the event handlers
        this.container.on('click', '.add-row-btn', () => this.addRow());
        this.container.on('click', '.delete-row-btn', (event) =>
            this.deleteRow(event.currentTarget)
        );
        this.container.on('click', '.clear-signature', (event) =>
            this.clearSignature(event.currentTarget)
        );
        this.container.on('change', '.esignature-image', (event) =>
            this.handleImageUpload(event.target)
        );
        $(window).on('resize', () => this.handleResize());
    }

    // Call this method to get the signatures when saving the form
    collectSignatures() {
        this.esignatures = []; // Clear previous signatures
        this.container.find('.esignature-row').each((index, rowData) => {
            const row = $(rowData);
            const canvas = row.find(
                '.esignature-canvas'
            )[0] as HTMLCanvasElement;
            const signaturePad = this.signaturePads[index];
            let signatureData;
            // Check if the signature is drawn or an image is uploaded
            if (signaturePad && !signaturePad.isEmpty()) {
                signatureData = canvas.toDataURL();
            } else {
                signatureData = canvas.toDataURL(); // This will capture uploaded images
            }

            const name = row.find('.esignature-name').val() as string;
            const topText = row.find('.esignature-top-text').val() as string;
            const bottomText = row
                .find('.esignature-bottom-text')
                .val() as string;
            const position = row.find('.esignature-position').val() as string;
            const date = row.find('.esignature-date').val() as string;

            if (name || signatureData) {
                this.esignatures.push({
                    layout: this.layout,
                    name,
                    topText,
                    bottomText,
                    position,
                    date,
                    signatureData,
                });
            }
        });
        return this.esignatures;
    }
}

export default EsignatureHandler;
