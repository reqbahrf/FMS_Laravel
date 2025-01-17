<div class="modal fade" id="tnaEvaluationResultModal" tabindex="-1" role="dialog"
    aria-labelledby="tnaEvaluationResultModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="tnaEvaluationResultModalLabel">TNA Evaluation Result</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p id="tnaEvaluationResult"></p>
                <form id="TNARejectionForm">
                    @csrf
                    <input type="hidden" name="applicant_id" id="applicant_id">
                    <input type="hidden" name="application_id" id="application_id">

                    <div class="form-group">
                        <label><strong>Eligibility Requirements Not Met:</strong></label>
                        <div class="checkbox-list ms-2">
                            <!-- Enterprise/Association Requirements -->
                            <div class="checkbox">
                                <input type="checkbox" id="not_registered" name="rejection_reasons[]"
                                    value="Not duly registered in the Philippines">
                                <label for="not_registered">Not duly registered in the Philippines</label>
                            </div>
                            <div class="checkbox">
                                <input type="checkbox" id="ownership" name="rejection_reasons[]"
                                    value="Less than 60% Filipino-owned">
                                <label for="ownership">Less than 60% Filipino-owned</label>
                            </div>

                            <!-- Entity Type Requirements -->
                            <div class="checkbox">
                                <input type="checkbox" id="invalid_entity" name="rejection_reasons[]"
                                    value="Not a qualified entity type">
                                <label for="invalid_entity">Not a qualified entity type (Government entity, SUC, LGU,
                                    civil society org, or academic institution)</label>
                            </div>

                            <!-- Previous Accountabilities -->
                            <div class="checkbox">
                                <input type="checkbox" id="unsettled_assistance" name="rejection_reasons[]"
                                    value="Has unsettled previous financial assistance">
                                <label for="unsettled_assistance">Has unsettled previous financial assistance with
                                    DOST-RO</label>
                            </div>

                            <!-- Other Requirements -->
                            <div class="checkbox">
                                <input type="checkbox" id="non_msme" name="rejection_reasons[]"
                                    value="Does not qualify under MSME definition">
                                <label for="non_msme">Does not qualify under MSME definition (RA 6977, as
                                    amended)</label>
                            </div>

                            <div class="checkbox">
                                <input type="checkbox" id="other" name="rejection_reasons[]" value="other">
                                <label for="other">Other (please specify):</label>
                                <textarea class="form-control" id="other_specify" name="other_specify" rows="3"></textarea>
                            </div>
                        </div>

                        <div class="form-group mt-3">
                            <label for="additional_comments"><strong>Additional Comments:</strong></label>
                            <textarea class="form-control" id="additional_comments" name="additional_comments" rows="3"></textarea>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn" data-bs-dismiss="modal">Close</button>
                <button type="submit" form="TNARejectionForm" class="btn btn-primary">Inform Applicant</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="tnaDocumentContainerModal" tabindex="-1" role="dialog"
    aria-labelledby="tnaDocumentContainerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="tnaDocumentContainerModalLabel">TNA Document Container</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="tnaDocumentContainerModalBody">
            </div>
        </div>
    </div>
</div>

