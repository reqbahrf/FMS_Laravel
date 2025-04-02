<div class="p-3">
    <h4>Project Settings</h4>
</div>
<div class="card shadow-sm">
    <div class="card-body">
        <form id="projectSettingsForm">
            @csrf
            <div class="row g-4">
                <!-- Project Fee Section -->
                <div class="col-12 col-md-6">
                    <div class="p-3 h-100 border-end border-md-end">
                        <h6 class="mb-3 text-primary">
                            <i class="ri-percent-fill me-2"></i>Project Fee
                        </h6>
                        <div class="mb-3">
                            <label
                                class="form-label fw-semibold"
                                for="fee_percentage"
                            >
                                Fee Percentage (%)
                            </label>
                            <div
                                class="input-group"
                                style="max-width: 150px;"
                            >
                                <input
                                    class="form-control"
                                    id="fee_percentage"
                                    name="fee_percentage"
                                    data-initial-value="{{ $fee_percentage ?? 0 }}"
                                    type="number"
                                    value="{{ $fee_percentage ?? 0 }}"
                                    min="0"
                                    max="100"
                                    step="1"
                                    required
                                >
                                <span class="input-group-text bg-light">
                                    <i class="ri-percent-fill"></i>
                                </span>
                            </div>
                            <div class="form-text">
                                <small>
                                    <i class="ri-information-line me-1"></i>
                                    Fee percentage for the project
                                </small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Notification Settings Section -->
                <div class="col-12 col-md-6">
                    <div class="p-3 h-100">
                        <h6 class="mb-3 text-primary">
                            <i class="ri-notification-3-line me-2"></i>Notification Settings
                        </h6>
                        <div class="mb-3">
                            <label
                                class="form-label fw-semibold"
                                for="notify_duration"
                            >
                                Notify Duration (Days)
                            </label>
                            <div
                                class="input-group"
                                style="max-width: 150px;"
                            >
                                <input
                                    class="form-control"
                                    id="notify_duration"
                                    name="notify_duration"
                                    data-initial-value="{{ $notify_duration ?? 0 }}"
                                    type="number"
                                    value="{{ $notify_duration ?? 0 }}"
                                    min="0"
                                    step="1"
                                >
                                <span class="input-group-text bg-light">
                                    <i class="ri-calendar-event-line"></i>
                                </span>
                            </div>
                            <div class="form-text">
                                <small>
                                    <i class="ri-information-line me-1"></i>
                                    Number of days before due to send notifications
                                </small>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label
                                class="form-label fw-semibold"
                                for="notify_interval"
                            >
                                Notify Interval (Days)
                            </label>
                            <div
                                class="input-group"
                                style="max-width: 150px;"
                            >
                                <input
                                    class="form-control"
                                    id="notify_interval"
                                    name="notify_interval"
                                    data-initial-value="{{ $notify_interval ?? 0 }}"
                                    type="number"
                                    value="{{ $notify_interval ?? 0 }}"
                                    min="0"
                                    step="1"
                                >
                                <span class="input-group-text bg-light">
                                    <i class="ri-timer-line"></i>
                                </span>
                            </div>
                            <div class="form-text">
                                <small>
                                    <i class="ri-information-line me-1"></i>
                                    Days interval for the next notification
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer with Update Button -->
            <div class="pt-4 mt-3 border-top d-flex justify-content-end">
                <button
                    class="btn btn-primary px-4"
                    type="submit"
                >
                    <i class="ri-save-fill me-2"></i> Update Settings
                </button>
            </div>
        </form>
    </div>
</div>
