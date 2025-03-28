import { showToastFeedback } from './feedback-toast';
import { FloatingWindowElements } from '../@types/floating-window';

export class FloatingWindow {
    private f_window: JQuery<HTMLElement>;
    private f_header: JQuery<HTMLElement>;
    private f_closeButton: JQuery<HTMLElement>;
    private f_content: JQuery<HTMLElement>;
    private f_input: JQuery<HTMLInputElement>;

    private isDragging: boolean = false;
    private isResizing: boolean = false;
    private startX: number = 0;
    private startY: number = 0;
    private startWidth: number = 0;
    private startHeight: number = 0;
    private resizeType: string = '';

    private static isInitialized: boolean = false;

    constructor(elements: FloatingWindowElements) {
        const { f_window, f_header, f_closeButton, f_content, f_input } =
            elements;

        if (
            !f_window ||
            !f_header ||
            !f_closeButton ||
            !f_content ||
            !f_input
        ) {
            console.error('Required elements for floating window are missing.');
            throw new Error('Missing required elements for floating window');
        }

        this.f_window = f_window;
        this.f_header = f_header;
        this.f_closeButton = f_closeButton;
        this.f_content = f_content;
        this.f_input = f_input;

        // Apply CSS to prevent text selection during dragging
        this.applyNoSelectStyles();
        this.initializeEventHandlers();
    }

    /**
     * Apply CSS to prevent text selection during dragging
     */
    private applyNoSelectStyles(): void {
        // Apply to the header (draggable area)
        this.f_header.css({
            'user-select': 'none',
            '-webkit-user-select': 'none',
            '-moz-user-select': 'none',
            '-ms-user-select': 'none',
        });

        // Apply to resizers
        this.f_window.find('.resizer').css({
            'user-select': 'none',
            '-webkit-user-select': 'none',
            '-moz-user-select': 'none',
            '-ms-user-select': 'none',
        });
    }

    private initializeEventHandlers(): void {
        // Close window
        this.f_closeButton.on('click', () => {
            this.hide();
        });

        // Dragging
        this.f_header.on('mousedown', (e) => {
            // Prevent default browser behavior (text selection)
            e.preventDefault();

            this.isDragging = true;
            if (this.f_window && this.f_window.length > 0) {
                const offset = this.f_window.offset() || { left: 0, top: 0 };
                this.startX = e.clientX - offset.left;
                this.startY = e.clientY - offset.top;
            }

            // Add a temporary class to the body to prevent text selection during dragging
            $('body').addClass('no-select');
        });

        // Resizing
        this.f_window.find('.resizer').on('mousedown', (e) => {
            // Prevent default browser behavior
            e.preventDefault();

            this.isResizing = true;
            this.startX = e.clientX;
            this.startY = e.clientY;
            if (this.f_window && this.f_window.length > 0) {
                this.startWidth = this.f_window.width() || 0;
                this.startHeight = this.f_window.height() || 0;
            }
            this.resizeType =
                $(e.currentTarget).attr('class')?.split(' ')[1] || '';

            // Add a temporary class to the body to prevent text selection during resizing
            $('body').addClass('no-select');
        });

        // Mouse movement for dragging and resizing
        $(document).on('mousemove', (e) => {
            if (this.isDragging) {
                // Prevent default browser behavior during dragging
                e.preventDefault();
                this.handleDragging(e);
            }
            if (this.isResizing) {
                // Prevent default browser behavior during resizing
                e.preventDefault();
                this.handleResizing(e);
            }
        });

        // Stop dragging and resizing
        $(document).on('mouseup', () => {
            this.isDragging = false;
            this.isResizing = false;

            // Remove the temporary class from the body
            $('body').removeClass('no-select');
        });
    }

    private handleDragging(e: JQuery.MouseMoveEvent): void {
        const viewportWidth: number = $(window).width() || 0;
        const viewportHeight: number = $(window).height() || 0;
        const windowWidth: number = this.f_window.outerWidth() || 0;
        const windowHeight: number = this.f_window.outerHeight() || 0;

        // Calculate new position
        let newLeft: number = e.clientX - this.startX;
        let newTop: number = e.clientY - this.startY;

        // Constrain to viewport boundaries
        newLeft = Math.max(0, Math.min(newLeft, viewportWidth - windowWidth));
        newTop = Math.max(0, Math.min(newTop, viewportHeight - windowHeight));

        this.f_window.css({
            left: newLeft,
            top: newTop,
        });
    }

    private handleResizing(e: JQuery.MouseMoveEvent): void {
        const viewportWidth: number = $(window).width() || 0;
        const viewportHeight: number = $(window).height() || 0;
        const windowPosition = this.f_window.offset() || { left: 0, top: 0 };

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
                newX = windowPosition.left + (e.clientX - this.startX);
                break;
            case 'resizer-t':
                newHeight = this.startHeight - (e.clientY - this.startY);
                newY = windowPosition.top + (e.clientY - this.startY);
                break;
            case 'resizer-b':
                newHeight = this.startHeight + (e.clientY - this.startY);
                break;
            case 'resizer-tr':
                newWidth = this.startWidth + (e.clientX - this.startX);
                newHeight = this.startHeight - (e.clientY - this.startY);
                newY = windowPosition.top + (e.clientY - this.startY);
                break;
            case 'resizer-tl':
                newWidth = this.startWidth - (e.clientX - this.startX);
                newHeight = this.startHeight - (e.clientY - this.startY);
                newX = windowPosition.left + (e.clientX - this.startX);
                newY = windowPosition.top + (e.clientY - this.startY);
                break;
            case 'resizer-br':
                newWidth = this.startWidth + (e.clientX - this.startX);
                newHeight = this.startHeight + (e.clientY - this.startY);
                break;
            case 'resizer-bl':
                newWidth = this.startWidth - (e.clientX - this.startX);
                newHeight = this.startHeight + (e.clientY - this.startY);
                newX = windowPosition.left + (e.clientX - this.startX);
                break;
        }

        // Constrain to viewport boundaries
        if (newX < 0) {
            newX = 0;
            newWidth =
                windowPosition.left + (this.f_window.outerWidth() || 0) - newX;
        }
        if (newY < 0) {
            newY = 0;
            newHeight =
                windowPosition.top + (this.f_window.outerHeight() || 0) - newY;
        }
        if (newX + newWidth > viewportWidth) {
            newWidth = viewportWidth - newX;
        }
        if (newY + newHeight > viewportHeight) {
            newHeight = viewportHeight - newY;
        }

        // Ensure minimum size and update position only when necessary
        if (newWidth > 100 && newHeight > 100) {
            this.f_window.css({
                width: newWidth,
                height: newHeight,
            });

            // Only update position for left and top resizing
            if (
                ['resizer-l', 'resizer-tl', 'resizer-bl'].includes(
                    this.resizeType
                )
            ) {
                this.f_window.css('left', newX);
            }
            if (
                ['resizer-t', 'resizer-tl', 'resizer-tr'].includes(
                    this.resizeType
                )
            ) {
                this.f_window.css('top', newY);
            }
        }
    }

    /**
     * Open the floating window and load the URL from the input field
     */
    public open(): void {
        const url = this.f_input?.val()?.trim();
        if (!url) {
            showToastFeedback('text-bg-danger', 'Please enter a valid URL.');
            return;
        }

        this.f_content.html(`<p>Loading...</p>`);
        this.f_content.html(`<iframe src="${url}"></iframe>`);
        this.f_window.show();
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

        this.f_input.val(url);
        this.f_content.html(`<p>Loading...</p>`);
        this.f_content.html(`<iframe src="${url}"></iframe>`);
        this.f_window.show();
    }

    /**
     * Hide the floating window
     */
    public hide(): void {
        this.f_window.hide();
    }
}

// Export a factory function for backward compatibility
export function InitializeFloatingWindow(
    elements: FloatingWindowElements
): FloatingWindow {
    return new FloatingWindow(elements);
}
