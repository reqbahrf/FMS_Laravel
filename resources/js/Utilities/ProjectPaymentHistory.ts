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
): Promise<number> => {
    try {
        const response = await fetch(`${PROJECTS_PAYMENT_RECORDS_ROUTE}?project_id=${project_id}`);
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }

        const payments = await response.json();
        
        // Process payments data
        const processedPayments = payments.map((payment: ProjectPayment) => {
            const dateCreated = customDateFormatter(payment.created_at);
            const dueDate = customDateFormatter(payment.due_date);
            const actionButtons = isUpdatable
                ? /*html*/`<button class="btn btn-primary btn-sm" data-bs-toggle="modal"
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
                `<span class="badge bg-${
                    payment.payment_status === 'Paid'
                        ? 'success'
                        : payment.payment_status === 'Pending'
                        ? 'warning'
                        : 'danger'
                }">${payment.payment_status}</span>`,
                payment.quarter,
                dueDate,
                dateCreated,
                actionButtons,
            ];
        });

        // Update DataTable
        paymentDataTableInstance.clear();
        paymentDataTableInstance.rows.add(processedPayments);
        paymentDataTableInstance.draw();

        // Calculate total amount
        const totalAmount = payments.reduce((sum: number, payment: ProjectPayment) => {
            return payment.payment_status === 'Paid' 
                ? sum + (parseFloat(payment.amount) || 0)
                : sum;
        }, 0);

        return totalAmount;
    } catch (error) {
        throw new Error('Error fetching project payment history: ' + error);
    }
};

export default getProjectPaymentHistory;
