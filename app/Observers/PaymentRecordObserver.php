<?php

namespace App\Observers;

use App\Models\PaymentRecord;
use App\Models\ProjectInfo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class PaymentRecordObserver
{
    /**
     * Handle the PaymentRecord "created" event.
     */
    public function created(PaymentRecord $paymentRecord): void
    {
        $this->forgetCache($paymentRecord);
        $this->updateRefundedAmount($paymentRecord);
    }

    /**
     * Handle the PaymentRecord "updated" event.
     */
    public function updated(PaymentRecord $paymentRecord): void
    {
        $this->forgetCache($paymentRecord);
        $this->updateRefundedAmount($paymentRecord);
    }

    /**
     * Handle the PaymentRecord "deleted" event.
     */
    public function deleted(PaymentRecord $paymentRecord): void
    {
        $this->forgetCache($paymentRecord);
        $this->updateRefundedAmount($paymentRecord);
    }

    /**
     * Handle the PaymentRecord "restored" event.
     */
    public function restored(PaymentRecord $paymentRecord): void
    {
        $this->forgetCache($paymentRecord);
        $this->updateRefundedAmount($paymentRecord);
    }

    /**
     * Handle the PaymentRecord "force deleted" event.
     */
    public function forceDeleted(PaymentRecord $paymentRecord): void
    {
        $this->forgetCache($paymentRecord);
        $this->updateRefundedAmount($paymentRecord);
    }

    protected function updateRefundedAmount(PaymentRecord $paymentRecord)
    {
        $totalAmount = PaymentRecord::where('Project_id', $paymentRecord->Project_id)
            ->where('payment_status', 'Paid')
            ->sum('amount');


        ProjectInfo::where('Project_id', $paymentRecord->Project_id)
             ->update([
            'refunded_amount' => $totalAmount
        ]);
    }

    protected function forgetCache(PaymentRecord $paymentRecord)
    {
        $org_userId = Auth::user()->orgUserInfo->id;
        Cache::forget('handled_projects' . $org_userId);
    }
}
