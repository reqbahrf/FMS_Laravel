<style>
    div .cards {
        max-width: 24rem;
        min-width: 20rem;
        height: 15rem
    }

    .cards {
        transition: transform 0.3s ease-in-out;
    }

    .cards:hover {
        transform: scale(1.05);
        font-weight: bolder;
    }
</style>

<!-- HTML -->
<div>
    <h4 class="p-3">Dashboard</h4>
</div>

<div class=" bg-white rounded-5">


    <div class="container-flex m-3 py-4">
        <fieldset>
            <legend class="w-auto">
                <h5>Projects:</h5>
            </legend>
            <div class="row sparkboxes m-4">
                <div class="col-md-4 z-3" id="applicantChart" data-bs-toggle="modal" data-bs-target="#applicantModal">
                    <div class="box box1 pt-2 bg-white shadow rounded-4 ">
                        <div id="Applicant"></div>
                    </div>
                </div>
                <div class="col-md-4 z-3" id="ongoingChart" data-bs-toggle="modal" data-bs-target="#ongoingModal">
                    <div class="box box2 pt-2  bg-white shadow rounded-4">
                        <div id="Ongoing"></div>
                    </div>
                </div>
                <div class="col-md-4 z-3" id="completedChart" data-bs-toggle="modal" data-bs-target="#completedModal">
                    <div class="box box3 pt-2 bg-white shadow rounded-4">
                        <div id="Completed"></div>
                    </div>
                </div>
            </div>
            <div class="py-5">
                <fieldset>
                    <legend class="text-center">
                        <h6>Staff handled Projects:</h6>
                    </legend>
                    <div id="staffHandledB"></div>
                </fieldset>
            </div>
        </fieldset>
        <!-- Modal -->
        <div class="modal fade" id="applicantModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-bs-backdrop="static">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header d-flex justify-content-between bg-primary">
                        <h5 class="modal-title text-white" id="myModalLabel">Applicant</h5>
                        <button id="closeApplicant" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <div class="modal-body">
                        <div>
                            <div id="pieChartApp">
                            </div>
                            <div id="barChartApp">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Ongoing Modal -->
        <div class="modal fade" id="ongoingModal" tabindex="-1" role="dialog" aria-labelledby="ongoingModalLabel" aria-hidden="true" data-bs-backdrop="static">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header d-flex justify-content-between bg-primary">
                        <h5 class="modal-title text-white" id="ongoingModalLabel">Ongoing</h5>
                        <button id="closeOngoing" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Your content here -->
                        <div id="pieChartOngo">
                        </div>
                        <div id="barChartOngo">
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <!-- Completed Modal -->
        <div class="modal fade" id="completedModal" tabindex="-1" role="dialog" aria-labelledby="completedModalLabel" aria-hidden="true" data-bs-backdrop="static">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header d-flex justify-content-between bg-primary">
                        <h5 class="modal-title text-white" id="completedModalLabel">Completed</h5>
                        <button id="closeComple" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Your content here -->
                        <div id="pieChartComp">
                        </div>
                        <div id="barChartComp">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>