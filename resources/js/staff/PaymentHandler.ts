import * as DataTables from 'datatables.net';
import getProjectPaymentHistory from '../Utilities/project-payment-history';
import createConfirmationModal from '../Utilities/confirmation-modal';
import { formatNumber } from '../Utilities/utilFunctions';
import {
    showProcessToast,
    hideProcessToast,
    showToastFeedback,
} from '../Utilities/feedback-toast';

export default class PaymentHandler {
    private paymentHistoryDataTableInstance: DataTables.Api;
    private project_id: string;
    private completeMarkBtn: JQuery<HTMLButtonElement>;
    private paymentForm: JQuery<HTMLFormElement>;
    private totalPaid: JQuery<HTMLElement>;
    private remainingBalance: JQuery<HTMLElement>;
    private ActualAmount: string;
    private paymentProgress: ApexCharts | null;

    constructor(
        DataTableInstance: DataTables.Api,
        project_id: string,
        ActualAmount: string
    ) {
        this.paymentHistoryDataTableInstance = DataTableInstance;
        this.project_id = project_id;
        this.paymentForm = $('#paymentForm');
        this.totalPaid = $('#totalPaid');
        this.remainingBalance = $('#remainingBalance');
        this.completeMarkBtn = $('#MarkCompletedProjectBtn');
        this.ActualAmount = ActualAmount;
        this.paymentProgress = null;
    }

    static toUpdatePaymentRecord(
        selectedRow: JQuery<HTMLElement>,
        paymentForm: JQuery<HTMLFormElement>
    ) {
        const selected_reference_id = selectedRow
            .find('td:eq(0)')
            .text()
            .trim();
        const selected_amount = selectedRow.find('td:eq(1)').text().trim();
        const selected_payment_method = selectedRow
            .find('td:eq(2)')
            .text()
            .trim();
        const selected_payment_status = selectedRow
            .find('td:eq(3)')
            .text()
            .trim();

        paymentForm.find('#reference_number').val(selected_reference_id);
        paymentForm.find('#paymentAmount').val(selected_amount);
        paymentForm.find('#paymentMethod').val(selected_payment_method);
        paymentForm.find('#paymentStatus').val(selected_payment_status);
    }
    async storePaymentRecords(): Promise<void> {
        try {
            const formData =
                this.paymentForm.serialize() + '&project_id=' + this.project_id;
            showProcessToast('Storing Payment Record...');
            const response = await $.ajax({
                type: 'POST',
                url: DASHBOARD_TAB_ROUTE.STORE_PAYMENT_RECORDS,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                        'content'
                    ),
                },
                data: formData,
            });
            await this.getPaymentAndCalculation();
            hideProcessToast();
            showToastFeedback('text-bg-success', response.message);
        } catch (error: any) {
            throw new Error(
                'Error:' +
                    (error?.responseJSON?.message ||
                        error?.message ||
                        'Failed to store payment records')
            );
        }
    }

    async updatePaymentRecords(): Promise<void> {
        try {
            showProcessToast('Updating Payment Record...');
            const formData = this.paymentForm.serialize();
            const reference_number = this.paymentForm
                .find('#reference_number')
                .val() as string;
            const response = await $.ajax({
                type: 'PUT',
                url: DASHBOARD_TAB_ROUTE.UPDATE_PAYMENT_RECORDS.replace(
                    ':reference_number',
                    reference_number
                ),
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                        'content'
                    ),
                },
                data: formData + '&project_id=' + this.project_id,
            });
            await this.getPaymentAndCalculation();
            hideProcessToast();
            showToastFeedback('text-bg-success', response.message);
        } catch (error: any) {
            throw new Error(
                error?.responseJSON?.message ||
                    error?.message ||
                    'Failed to update payment records'
            );
        }
    }

    async deletePaymentRecord(
        reference_number: string,
        { options }: { options?: any }
    ) {
        try {
            const isConfirmed = await createConfirmationModal({
                titleBg: 'bg-danger',
                title: 'Delete Payment Record',
                message:
                    options?.confirm ??
                    `Are you sure you want to delete this payment record? ${reference_number}`,
                confirmText: 'Yes',
                cancelText: 'Cancel',
                confirmButtonClass: 'btn-danger',
            });
            if (!isConfirmed) {
                return;
            }
            showProcessToast('Deleting Payment Record...');
            const response = await $.ajax({
                type: 'DELETE',
                url: DASHBOARD_TAB_ROUTE.DELETE_PAYMENT_RECORDS.replace(
                    ':reference_number',
                    reference_number
                ),
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                        'content'
                    ),
                },
            });
            await this.getPaymentAndCalculation();
            hideProcessToast();
            showToastFeedback('text-bg-success', response.message);
        } catch (error) {
            throw new Error('Error in deleting payment record: ' + error);
        }
    }

    async getPaymentAndCalculation(): Promise<void> {
        try {
            const totatAmount = await getProjectPaymentHistory(
                this.project_id,
                this.paymentHistoryDataTableInstance,
                true
            );
            const fundedAmount = parseFloat(
                this.ActualAmount.replace(/,/g, '')
            );
            const remainingAmount = fundedAmount - totatAmount;
            const percentage = Math.round((totatAmount / fundedAmount) * 100);

            this.totalPaid.text(formatNumber(totatAmount));
            this.remainingBalance.text(formatNumber(remainingAmount));

            percentage == 100
                ? this._isRefundCompleted(true)
                : this._isRefundCompleted(false);

            this._InitializeviewCooperatorProgress(percentage);
        } catch (error: any) {
            throw new Error('Failed to get payment and calculation: ' + error);
        }
    }

    _isRefundCompleted(boolean: boolean) {
        boolean
            ? this.completeMarkBtn.prop('disabled', false).show()
            : this.completeMarkBtn.prop('disabled', true).hide();
    }

    _InitializeviewCooperatorProgress(percentage: number) {
        const options = {
            series: [percentage],
            chart: {
                type: 'radialBar',
                width: '100%',
                height: '200px',
                sparkline: {
                    enabled: true,
                },
            },
            colors: ['#00D8B6'],
            plotOptions: {
                radialBar: {
                    startAngle: -90,
                    endAngle: 90,
                    track: {
                        background: '#e7e7e7',
                        strokeWidth: '97%',
                        margin: 5, // margin is in pixels
                        dropShadow: {
                            enabled: true,
                            top: 2,
                            left: 0,
                            color: '#999',
                            opacity: 1,
                            blur: 2,
                        },
                    },
                    dataLabels: {
                        name: {
                            show: false,
                        },
                        value: {
                            offsetY: -2,
                            fontSize: '22px',
                        },
                    },
                },
            },
            grid: {
                padding: {
                    top: -10,
                },
            },
            fill: {
                type: 'gradient',
                gradient: {
                    shade: 'light',
                    shadeIntensity: 0.4,
                    inverseColors: false,
                    opacityFrom: 1,
                    opacityTo: 1,
                    stops: [0, 50, 53, 91],
                },
            },
            labels: ['Average Results'],
        };

        if (this.paymentProgress) {
            this.paymentProgress.destroy();
        }

        this.paymentProgress = new ApexCharts(
            document.querySelector('#progressPercentage'),
            options
        );
        this.paymentProgress.render();
    }

    /**
     * Destroys the PaymentHandler instance by cleaning up resources
     * and removing event listeners to prevent memory leaks.
     */
    destroy(): void {
        try {
            // Destroy the ApexCharts instance if it exists
            if (this.paymentProgress) {
                this.paymentProgress.destroy();
                this.paymentProgress = null;
            }

            // Remove any jQuery event listeners that might have been attached
            if (this.paymentForm) {
                this.paymentForm.off();
            }

            if (this.completeMarkBtn) {
                this.completeMarkBtn.off();
            }

            // Clear references to DOM elements
            this.paymentForm = null as unknown as JQuery<HTMLFormElement>;
            this.totalPaid = null as unknown as JQuery<HTMLElement>;
            this.remainingBalance = null as unknown as JQuery<HTMLElement>;
            this.completeMarkBtn = null as unknown as JQuery<HTMLButtonElement>;

            // Clean up any other resources or event handlers

            console.info('PaymentHandler instance destroyed successfully');
        } catch (error: any) {
            console.error('Error destroying PaymentHandler instance:', error);
        }
    }
}
