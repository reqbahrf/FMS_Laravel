import { showToastFeedback } from './feedback-toast';
import { FloatingWindowElements } from './floating-window.d';

export class FloatingWindow {
    private window: JQuery<HTMLElement>;
    private header: JQuery<HTMLElement>;
    private closeButton: JQuery<HTMLElement>;
    private content: JQuery<HTMLElement>;
    private input: JQuery<HTMLInputElement>;

    private isDragging: boolean = false;
    private isResizing: boolean = false;
    private startX: number = 0;
    private startY: number = 0;
    private startWidth: number = 0;
    private startHeight: number = 0;
    private resizeType: string = '';

    private static isInitialized: boolean = false;

    constructor(elements: FloatingWindowElements) {
        const { window, header, closeButton, content, input } = elements;

        if (!window || !header || !closeButton || !content || !input) {
            console.error('Required elements for floating window are missing.');
            throw new Error('Missing required elements for floating window');
        }

        this.window = window;
        this.header = header;
        this.closeButton = closeButton;
        this.content = content;
        this.input = input;

        this.initializeEventHandlers();
    }

    private initializeEventHandlers(): void {
        // Close window
        this.closeButton.on('click', () => {
            this.hide();
        });

        // Dragging
        this.header.on('mousedown', (e) => {
            this.isDragging = true;
            if (this.window && this.window.length > 0) {
                this.startX = e.clientX - (this.window.offset()?.left || 0);
                this.startY = e.clientY - (this.window.offset()?.top || 0);
            }
        });

        // Resizing
        $('.resizer').on('mousedown', (e) => {
            this.isResizing = true;
            this.startX = e.clientX;
            this.startY = e.clientY;
            if (this.window && this.window.length > 0) {
                this.startWidth = this.window.width() || 0;
                this.startHeight = this.window.height() || 0;
            }
            this.resizeType = $(e.currentTarget).attr('class')?.split(' ')[1] || '';
            e.preventDefault();
        });

        // Mouse movement for dragging and resizing
        $(document).on('mousemove', (e) => {
            if (this.isDragging) {
                this.handleDragging(e);
            }
            if (this.isResizing) {
                this.handleResizing(e);
            }
        });

        // Stop dragging and resizing
        $(document).on('mouseup', () => {
            this.isDragging = false;
            this.isResizing = false;
        });
    }

    private handleDragging(e: JQuery.MouseMoveEvent): void {
        const viewportWidth: number = $(window).width() || 0;
        const viewportHeight: number = $(window).height() || 0;
        const windowWidth: number = this.window.outerWidth() || 0;
        const windowHeight: number = this.window.outerHeight() || 0;

        // Calculate new position
        let newLeft: number = e.clientX - this.startX;
        let newTop: number = e.clientY - this.startY;

        // Constrain to viewport boundaries
        newLeft = Math.max(0, Math.min(newLeft, viewportWidth - windowWidth));
        newTop = Math.max(0, Math.min(newTop, viewportHeight - windowHeight));

        this.window.css({
            left: newLeft,
            top: newTop,
        });
    }

    private handleResizing(e: JQuery.MouseMoveEvent): void {
        const viewportWidth: number = this.window.width() || 0;
        const viewportHeight: number = this.window.height() || 0;
        const windowPosition = this.window.offset() || { left: 0, top: 0 };

        let newWidth: number = this.startWidth;
        let newHeight: number = this.startHeight;
        let newX: number = windowPosition.left;
        let newY: number = windowPosition.top;

        switch (this.resizeType) {
            case 'resizer-r':
                newWidth = this.startWidth + (e.clientX - this.startX);
                break;
            case 'resizer-l':
                newWidth = this.startWidth - (e.clientX - this.startX);
                newX = e.clientX;
                break;
            case 'resizer-t':
                newHeight = this.startHeight - (e.clientY - this.startY);
                newY = e.clientY;
                break;
            case 'resizer-b':
                newHeight = this.startHeight + (e.clientY - this.startY);
                break;
            case 'resizer-tr':
                newWidth = this.startWidth + (e.clientX - this.startX);
                newHeight = this.startHeight - (e.clientY - this.startY);
                newY = e.clientY;
                break;
            case 'resizer-tl':
                newWidth = this.startWidth - (e.clientX - this.startX);
                newHeight = this.startHeight - (e.clientY - this.startY);
                newX = e.clientX;
                newY = e.clientY;
                break;
            case 'resizer-br':
                newWidth = this.startWidth + (e.clientX - this.startX);
                newHeight = this.startHeight + (e.clientY - this.startY);
                break;
            case 'resizer-bl':
                newWidth = this.startWidth - (e.clientX - this.startX);
                newHeight = this.startHeight + (e.clientY - this.startY);
                newX = e.clientX;
                break;
        }

        if (newX < 0) {
            newX = 0;
            newWidth = windowPosition.left + (this.window.outerWidth() || 0) - newX;
        }
        if (newY < 0) {
            newY = 0;
            newHeight = windowPosition.top + (this.window.outerHeight() || 0) - newY;
        }
        if (newX + newWidth > viewportWidth) {
            newWidth = viewportWidth - newX;
        }
        if (newY + newHeight > viewportHeight) {
            newHeight = viewportHeight - newY;
        }

        // Ensure minimum size and update position only when necessary
        if (newWidth > 100 && newHeight > 100) {
            this.window.css({
                width: newWidth,
                height: newHeight,
            });

            // Only update position for left and top resizing
            if (['resizer-l', 'resizer-tl', 'resizer-bl'].includes(this.resizeType)) {
                this.window.css('left', newX);
            }
            if (['resizer-t', 'resizer-tl', 'resizer-tr'].includes(this.resizeType)) {
                this.window.css('top', newY);
            }
        }
    }

    /**
     * Open the floating window and load the URL from the input field
     */
    public open(): void {
        const url = this.input?.val()?.trim();
        if (!url) {
            showToastFeedback('text-bg-danger', 'Please enter a valid URL.');
            return;
        }

        this.content.html(`<p>Loading...</p>`);
        this.content.html(`<iframe src="${url}"></iframe>`);
        this.window.show();
    }

    /**
     * Open the floating window with a specific URL
     * @param url The URL to load in the floating window
     */
    public openWithUrl(url: string): void {
        if (!url) {
            showToastFeedback('text-bg-danger', 'Please enter a valid URL.');
            return;
        }

        this.input.val(url);
        this.content.html(`<p>Loading...</p>`);
        this.content.html(`<iframe src="${url}"></iframe>`);
        this.window.show();
    }

    /**
     * Hide the floating window
     */
    public hide(): void {
        this.window.hide();
    }
}

// Export a factory function for backward compatibility
export function InitializeFloatingWindow(elements: FloatingWindowElements): FloatingWindow {
    return new FloatingWindow(elements);
}
