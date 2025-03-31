/**
 * Utility functions for phone number formatting and validation
 */

/**
 * Formats a phone number in the pattern XXX-XXX-XXXX
 * @param value - The input value to format
 * @returns The formatted phone number
 */
function formatPhoneNumber(value: string): string {
    // Remove non-numeric characters
    const number = value.replace(/\D/g, '');

    if (number.length === 0) return '';

    // Match groups for formatting
    const formattedNumber = number.match(/(\d{0,3})(\d{0,3})(\d{0,4})/);

    if (!formattedNumber) return '';

    let formatted = '';
    if (formattedNumber[1]) formatted += formattedNumber[1];
    if (formattedNumber[2]) formatted += '-' + formattedNumber[2];
    if (formattedNumber[3]) formatted += '-' + formattedNumber[3];

    return formatted;
}

/**
 * Validates if a keypress event is a numeric key
 * @param event - The keypress event
 * @returns Boolean indicating if the key is valid
 */
export function isNumericKey(
    event: KeyboardEvent | JQuery.KeyPressEvent
): boolean {
    const charCode = event.which ? event.which : event.keyCode;
    return !(charCode > 31 && (charCode < 48 || charCode > 57));
}

/**
 * Attaches phone number formatting and validation to an input element
 * @param selector - The jQuery selector for the input element
 */
export function setupPhoneNumberInput(selector: string): void {
    $(selector)
        .on('keypress', function (e) {
            return isNumericKey(e);
        })
        .on('input', function () {
            const formatted = formatPhoneNumber($(this).val() as string);
            $(this).val(formatted);
        });
}
