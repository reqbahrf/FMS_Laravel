/**
 * Utility functions for phone number formatting and validation
 */

/**
 * Formats a phone number with flexible formatting based on length
 * @param value - The input value to format
 * @returns The formatted phone number
 */
function formatPhoneNumber(value: string): string {
    // Remove non-numeric characters
    const number = value.replace(/\D/g, '');

    if (number.length === 0) return '';

    // US/North American format (10 digits)
    if (number.length === 10) {
        const formattedNumber = number.match(/(\d{3})(\d{3})(\d{4})/);
        if (formattedNumber) {
            return `${formattedNumber[1]}-${formattedNumber[2]}-${formattedNumber[3]}`;
        }
    }
    
    // Handle shorter numbers (less than 10 digits)
    if (number.length < 10) {
        const formattedNumber = number.match(/(\d{0,3})(\d{0,3})(\d{0,4})/);
        if (!formattedNumber) return number;
        
        let formatted = '';
        if (formattedNumber[1]) formatted += formattedNumber[1];
        if (formattedNumber[2]) formatted += '-' + formattedNumber[2];
        if (formattedNumber[3]) formatted += '-' + formattedNumber[3];
        
        return formatted;
    }
    
    // Handle longer international numbers with flexible grouping
    if (number.length <= 12) {
        // For 11-12 digit numbers (common in many countries)
        const pattern = number.length === 11 
            ? /(\d{2})(\d{3})(\d{3})(\d{3})/ 
            : /(\d{3})(\d{3})(\d{3})(\d{3})/;
            
        const matches = number.match(pattern);
        if (matches) {
            return matches.slice(1).filter(Boolean).join('-');
        }
    }
    
    // For other lengths, use a more generic approach with 3-digit groups
    let formatted = '';
    let remaining = number;
    
    while (remaining.length > 0) {
        // Take chunks of 3 digits (or whatever remains for the last group)
        const chunkSize = remaining.length > 4 ? 3 : remaining.length;
        const chunk = remaining.substring(0, chunkSize);
        formatted += chunk;
        remaining = remaining.substring(chunkSize);
        
        if (remaining.length > 0) {
            formatted += '-';
        }
    }
    
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
