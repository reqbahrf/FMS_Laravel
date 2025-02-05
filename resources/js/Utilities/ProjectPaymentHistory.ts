import * as DataTables from 'datatables.net';
import { customDateFormatter, formatNumberToCurrency } from './utilFunctions';


interface ProjectPayment {
    reference_number: string;
    amount: string;
    payment_method: string;
    payment_status: 'Paid' | 'Pending' | 'Due' | 'Overdue';
    quarter: string;
    due_date: string;
    created_at: string;
}

const getProjectPaymentHistory = async (
    project_id: string,
    paymentDataTableInstance: DataTables.Api,
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
            response.map((payment: ProjectPayment) => {
                const dateCreated = customDateFormatter(payment.created_at);
                const dueDate = customDateFormatter(payment.due_date);
                const actionButtons = isUpdatable
                    ? /*html*/ `<button class="btn btn-primary btn-sm" data-bs-toggle="modal"
                        data-bs-target="#paymentModal"
                        data-action="Update"><i class="ri-file-edit-fill"></i></button>
                    <button class="btn btn-danger btn-sm deleteRecord" data-bs-toggle="modal" 
                        data-bs-target="#deleteRecordModal" 
                        data-delete-record-type="projectPayment">
                        <i class="ri-delete-bin-2-fill"></i></button>`
                    : '';

                return [
                    payment.reference_number,
                    formatNumberToCurrency(parseFloat(payment.amount)),
                    payment.payment_method,
                    /*html*/ `<span class="badge bg-${
                        payment.payment_status === 'Paid'
                            ? 'success'
                            : payment.payment_status === 'Pending'
                            ? 'warning'
                            : 'danger'
                    } ">${payment.payment_status}</span>`,
                    payment.quarter,
                    dueDate,
                    dateCreated,
                    actionButtons,
                ];
            })
        );
        paymentDataTableInstance.draw();

        response.forEach((payment: ProjectPayment) => {
            if (payment.payment_status === 'Paid') {
                totalAmount += parseFloat(payment.amount) || 0;
            }
        });
        return totalAmount;
    } catch (error) {
        throw new Error('Error fetching project payment history: ' + error);
    }
};

export default getProjectPaymentHistory;
