/**
 * Formats numeric input fields to display thousand separators and limit decimal places to 2 digits.
 * Automatically formats the input value as the user types.
 *
 * @param {string} selectorOrParent - jQuery selector or parent element to attach the event handler.
 *                                           If only one argument is provided, this becomes the input selector.
 * @param {string|string[]|null} inputSelectors - jQuery selector(s) for the input field(s) to format.
 *                                               Can be a single selector string or array of selectors.
 *                                               Can be use for event delegation, if the parent element is provided.
 *                                               If null, the first parameter is used as the input selector.
 *
 *
 * @example
 * // Format a single input
 * customFormatNumericInput('#priceInput');
 *
 * // Format multiple inputs within a form
 * customFormatNumericInput('#myForm', ['.price-input', '.amount-input']);
 *
 * // Format inputs within a specific parent
 * customFormatNumericInput('#parentDiv', '.numeric-input');
 */
function customFormatNumericInput(
    selectorOrParent: string | Element | JQuery<Element>,
    inputSelectors: string | string[] | null = null
) {
    let inputSelector: string | string[] | null = inputSelectors;
    let parentContainer: JQuery<Element>;

    // Determine parent container
    if (inputSelectors === null && typeof selectorOrParent === 'string') {
        inputSelector = selectorOrParent;
        parentContainer = $('body');
    } else if (
        inputSelectors !== null &&
        (selectorOrParent instanceof Element || selectorOrParent instanceof $)
    ) {
        inputSelector = inputSelectors;
        parentContainer =
            selectorOrParent instanceof Element
                ? $(selectorOrParent)
                : selectorOrParent;
    } else {
        parentContainer = $('body');
        inputSelector = inputSelectors;
    }

    // Convert single string selector to array if needed
    const selectors = Array.isArray(inputSelector)
        ? inputSelector
        : [inputSelector];

    // Join all selectors with comma for jQuery multiple selector
    const combinedSelector = selectors.join(', ');

    // Use event delegation instead of direct binding
    parentContainer.on('input', combinedSelector, function() {
        const thisInput = $(this);

        // More strict regex: only allow digits and one decimal point
        let value = thisInput
            .val()
            ?.toString()
            .replace(/[^0-9.]/g, '');

        // Ensure only one decimal point
        const parts = value?.split('.');
        if (parts && parts.length > 2) {
            value = `${parts[0]}.${parts[1]}`;
        }

        // Limit decimal places to 2
        if (value?.includes('.')) {
            const [integerPart, decimalPart] = value.split('.');
            value = `${integerPart}.${decimalPart.substring(0, 2)}`;
        }

        const formattedValue = value?.replace(/\B(?=(\d{3})+(?!\d))/g, ',');
        if (!formattedValue) return thisInput.val('');
        thisInput.val(formattedValue);
    });
}

function yearInputs(parent: string | Element | JQuery, Selector: string | string[]): void {
    let parentElement: JQuery | null = null;
    let inputSelector: string | string[] | null = null;

    if (parent instanceof $) {
        parentElement = parent as JQuery;
    } else if (typeof parent === 'string') {
        parentElement = $(parent);
    }

    if(typeof Selector === 'string') {
        inputSelector = Selector;
    } else if(Array.isArray(Selector)) {
        inputSelector = Selector.join(',');
    }

    if (!parentElement || !inputSelector) {
        throw new Error('Parent element not found or input selector not found');
    }

    parentElement.on('input', inputSelector as string, function () {
        const thisInput = $(this);
        // Remove non-numeric characters and limit to 4 digits
        let value = thisInput.val()?.toString().replace(/[^0-9]/g, '') as string;

        // Limit to 4 digits by taking only the first 4 characters
        if (value.length > 4) {
            value = value.slice(0, 4);
        }
        thisInput.val(value);
    });

}

export { customFormatNumericInput, yearInputs };
