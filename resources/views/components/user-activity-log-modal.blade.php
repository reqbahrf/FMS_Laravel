<!-- User Activity Log Modal -->
<div
    class="modal fade"
    id="userActivityLogModal"
    aria-labelledby="userActivityLogModalLabel"
    aria-hidden="true"
    tabindex="-1"
>
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5
                    class="modal-title"
                    id="userActivityLogModalLabel"
                >User Activity Log</h5>
                <button
                    class="btn-close"
                    data-bs-dismiss="modal"
                    type="button"
                    aria-label="Close"
                ></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table
                        class="table table-hover"
                        id="userActivityLogTable"
                    >
                        <thead>
                            <tr>
                                <th>User Type</th>
                                <th>Activity</th>
                                <th>IP Address</th>
                                <th>User Agent</th>
                                <th>Created At</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>

                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button
                    class="btn btn-secondary"
                    data-bs-dismiss="modal"
                    type="button"
                >Close</button>
            </div>
        </div>
    </div>
</div>
