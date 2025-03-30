import { formatNumber } from './utilFunctions';

/**
 * Updates the enterprise level based on total assets calculation.
 * Calculates the sum of buildings, equipment, and working capital values,
 * then determines the enterprise level category based on predefined thresholds.
 * Updates the UI elements with the formatted total and enterprise level.
 */
function calculateEnterpriseLevel(container: JQuery<HTMLElement>): void {
    // Cache DOM selections
    const enterpriseLevelElement = container.find('span#Enterprise_Level');
    const totalAssetsElement = container.find('span#to_Assets');
    const enterpriseLevelInput = container.find('input#EnterpriseLevelInput');

    // Helper function to parse comma-separated numbers
    const parseNumericInput = (selector: string) => {
        if (!selector) return 0;
        const inputElement = container.find(
            selector
        ) as JQuery<HTMLInputElement>;
        const value = inputElement.val()?.replace(/,/g, '') || '0';
        return parseFloat(value) || 0;
    };

    // Parse values, removing commas before parsing
    const buildingsValue = parseNumericInput('#buildings');
    const equipmentsValue = parseNumericInput('#equipments');
    const workingCapitalValue = parseNumericInput('#working_capital');

    // Calculate total
    const total = buildingsValue + equipmentsValue + workingCapitalValue;

    // Format total with comma separators
    totalAssetsElement.text(formatNumber(total));

    let enterpriseLevel: string;

    if (total < 3e6) {
        enterpriseLevel = 'Micro Enterprise';
    } else if (total >= 3e6 && total < 15e6) {
        enterpriseLevel = 'Small Enterprise';
    } else {
        enterpriseLevel = 'Medium Enterprise';
    }

    enterpriseLevelElement.text(enterpriseLevel);
    enterpriseLevelInput.val(enterpriseLevel);
}

export default calculateEnterpriseLevel;
