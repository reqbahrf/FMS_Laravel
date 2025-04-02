import * as DataTables from 'datatables.net';
import { customDateFormatter, formatNumber } from './utilFunctions';

interface ProjectPayment {
    reference_number: string;
    amount: string;
    payment_method: string;
    payment_status:
        | 'Paid'
        | 'Pending'
        | 'Due'
        | 'Overdue'
        | 'Failed'
        | 'Completed';
    quarter: string;
    due_date: string;
    date_completed: string | null;
    note: string | null;
    updated_at: string;
}

const getProjectPaymentHistory = async (
    project_id: string,
    paymentDataTableInstance: DataTables.Api,
    isUpdatable = false
): Promise<number> => {
    try {
        const response = await fetch(
            `${PROJECTS_PAYMENT_RECORDS_ROUTE}?project_id=${project_id}`
        );
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }

        const payments = await response.json();

        // Process payments data
        const processedPayments = payments.map((payment: ProjectPayment) => {
            const dateUpdated = customDateFormatter(payment.updated_at);
            const dueDate = customDateFormatter(payment.due_date);
            const dateCompleted = payment.date_completed
                ? customDateFormatter(payment.date_completed)
                : 'N/A';
            const actionButtons = isUpdatable
                ? /*html*/ `<button class="btn btn-primary btn-sm" data-bs-toggle="modal"
                    data-bs-target="#paymentModal"
                    data-action="Update"><i class="ri-file-edit-fill"></i></button>
                <button class="btn btn-danger btn-sm delete--payment--Btn"
                    data-delete-record-type="projectPayment">
                    <i class="ri-delete-bin-2-fill"></i></button>`
                : '';

            return [
                payment.reference_number,
                formatNumber(parseFloat(payment.amount)),
                payment.payment_method,
                `<span class="badge bg-${(() => {
                    switch (payment.payment_status) {
                        case 'Completed':
                        case 'Paid':
                            return 'success';
                        case 'Pending':
                            return 'secondary';
                        case 'Due':
                        case 'Overdue':
                        case 'Failed':
                            return 'danger';
                        default:
                            return 'primary';
                    }
                })()}">${payment.payment_status}</span>`,
                payment.quarter,
                dueDate,
                /*html*/ `${dateCompleted}
                <input type="hidden" class="hidden-payment-note" value="${payment.note}">`,
                dateUpdated,
                actionButtons,
            ];
        });

        // Update DataTable
        paymentDataTableInstance.clear();
        paymentDataTableInstance.rows.add(processedPayments);
        paymentDataTableInstance.draw();

        // Calculate total amount
        const totalAmount = payments.reduce(
            (sum: number, payment: ProjectPayment) => {
                return payment.payment_status === 'Paid'
                    ? sum + (parseFloat(payment.amount) || 0)
                    : sum;
            },
            0
        );

        return totalAmount;
    } catch (error) {
        throw new Error('Error fetching project payment history: ' + error);
    }
};

export default getProjectPaymentHistory;
