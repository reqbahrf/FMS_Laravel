import {
    addNewRowHandler,
    removeRowHandler,
} from '../../Utilities/add-and-remove-table-row-handler';
import { customFormatNumericInput } from '../../Utilities/input-utils';
import { parseFormattedNumberToFloat } from '../../Utilities/utilFunctions';

export default class RTECFormEvent {
    private form: JQuery<HTMLFormElement> | null;
    private numberInputSelectors: string[] | null;

    constructor(form: JQuery<HTMLFormElement>) {
        this.form = form;
        this.numberInputSelectors = this._getNumericInputs();
        customFormatNumericInput(this.form, this.numberInputSelectors);
        this._initAddTableRowEvents();
        this._initEquipmentTableCalculator();
    }

    private _getNumericInputs(): string[] {
        if (!this.form) return [];
        return this.form
            .find('[data-custom-numeric-input]')
            .map((idx, el) =>
                el.getAttribute('name')
                    ? `input[name="${el.getAttribute('name')}"]`
                    : `input.${el.getAttribute('class')}`
            )
            .toArray()
            .filter(Boolean);
    }
    private _initAddTableRowEvents(): void {
        if (!this.form) return;
        addNewRowHandler(
            '#addProcessExistingPractiveProblemTableRow',
            this.form.find('#processExistingPractiveProblemTableContainer')
        );

        removeRowHandler(
            '#removeProcessExistingPractiveProblemTableRow',
            this.form.find('#processExistingPractiveProblemTableContainer')
        );

        addNewRowHandler(
            '#addEquipmentTableRow',
            this.form.find('#equipmentTableContainer')
        );
        removeRowHandler(
            '#removeEquipmentTableRow',
            this.form.find('#equipmentTableContainer')
        );
    }

    /**
     * Initialize the equipment table total cost calculator
     */
    private _initEquipmentTableCalculator(): void {
        const equipmentTable = this.form?.find(
            '#equipmentTable'
        ) as JQuery<HTMLTableElement>;
        if (!equipmentTable) return;

        const calculateEquipmentTable =
            this._calculateEquipmentTableFooterTotal;
        calculateEquipmentTable(equipmentTable);

        equipmentTable.on('input', '.Qty, .UnitCost', function () {
            const row = $(this).closest('tr');
            const qty =
                parseFormattedNumberToFloat(row.find('.Qty').val() as string) ||
                0;
            const unitCost =
                parseFormattedNumberToFloat(
                    row.find('.UnitCost').val() as string
                ) || 0;

            // Calculate total cost for the row
            const totalCost = qty * unitCost;
            row.find('.TotalCost').val(totalCost.toLocaleString());

            // Recalculate the table footer total
            calculateEquipmentTable(equipmentTable);
        });
    }

    /**
     * Calculate the total cost for the equipment table footer
     * @param $table jQuery object of the equipment table
     */
    private _calculateEquipmentTableFooterTotal(
        $table: JQuery<HTMLTableElement>
    ): void {
        let grandTotalCost = 0;

        $table.find('tbody tr').each(function () {
            const rowTotalCost =
                parseFormattedNumberToFloat(
                    $(this).find('.TotalCost').val() as string
                ) || 0;
            grandTotalCost += rowTotalCost;
        });

        $table
            .find('tfoot td:last-child')
            .text(grandTotalCost.toLocaleString());
    }

    destroy(): void {
        // Remove specific input event listeners
        if (!this.form || !this.numberInputSelectors) return;
        this.form.off('input', this.numberInputSelectors.join(','));
        // Optional: Clear any references to prevent memory leaks
        this.form = null;
        this.numberInputSelectors = null;
    }
}
