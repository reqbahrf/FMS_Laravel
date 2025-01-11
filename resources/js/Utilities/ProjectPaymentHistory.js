import { customDateFormatter, formatNumberToCurrency } from './utilFunctions';
/**
 * Fetches and displays payment history for a specific project in a DataTable.
 * **NOTE:  the PROJECTS_PAYMENT_RECORDS_ROUTE constant is defined in the (Staff | Admin)_Index.blade.php.**
 * @async
 * @function getProjectPaymentHistory
 * @param {number|string} project_id - The ID of the project to fetch payment history for
 * @param {DataTables.Api} paymentDataTableInstance - The DataTable instance to populate with payment data
 * @param {boolean} [isUpdatable=false] - Whether to show update and delete buttons
 * @returns {Promise<number>} The total amount of all payments for the project
 * @throws {Error} If there's an error fetching the payment history
 *
 * @description
 * This function performs the following:
 * 1. Fetches payment records from the server using AJAX
 * 2. Clears and populates the DataTable with formatted payment data
 * 3. Calculates and returns the total amount of all payments
 *
 * Each payment record is displayed with:
 * - Transaction ID
 * - Formatted amount (currency)
 * - Payment method
 * - Payment status (with color-coded badge)
 * - Formatted date
 * - Action buttons (if isUpdatable is true)
 */

const getProjectPaymentHistory = async (
    project_id,
    paymentDataTableInstance,
    isUpdatable = false
) => {
    try {
        let totalAmount = 0;
        const response = await $.ajax({
            type: 'GET',
            url: PROJECTS_PAYMENT_RECORDS_ROUTE + '?project_id=' + project_id,
        });
        paymentDataTableInstance.clear();
        paymentDataTableInstance.rows.add(
            response.map((payment) => {
                const formattedDate = customDateFormatter(payment.created_at);
                const actionButtons = isUpdatable
                    ? `<button class="btn btn-primary btn-sm" data-bs-toggle="modal"
                        data-bs-target="#paymentModal"
                        data-action="Update"><i class="ri-file-edit-fill"></i></button>
                    <button class="btn btn-danger btn-sm deleteRecord" data-bs-toggle="modal" 
                        data-bs-target="#deleteRecordModal" 
                        data-delete-record-type="projectPayment">
                        <i class="ri-delete-bin-2-fill"></i></button>`
                    : '';

                return [
                    payment.transaction_id,
                    formatNumberToCurrency(parseFloat(payment.amount)),
                    payment.payment_method,
                    `<span class="badge bg-${
                        payment.payment_status === 'Paid'
                            ? 'success'
                            : payment.payment_status === 'Pending'
                              ? 'warning'
                              : 'danger'
                    } ">${payment.payment_status}</span>`,
                    formattedDate,
                    actionButtons,
                ];
            })
        );
        paymentDataTableInstance.draw();

        response.forEach((payment) => {
            totalAmount += parseFloat(payment.amount) || 0;
        });
        return totalAmount;
    } catch (error) {
        throw new Error(
            'Error fetching project payment history: ' + error.message
        );
    }
};

export default getProjectPaymentHistory;
