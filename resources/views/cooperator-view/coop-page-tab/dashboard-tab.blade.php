<div class="m-3">
    <h1>Dashboard</h1>
</div>
<div class="row gy-3 m-0 m-md-2">
    <div class="col-12 col-md-12">
        <div class="card shadow-sm rounded-sm ">
            <div class="card-header bg-primary">
                <h2 class="text-white mb-0">Project Information</h2>
            </div>
            <div class="card-body">
                <div class="row gy-4">
                    <div class="col-md-8">
                        <label for="project_title"><strong>Project Title:</strong></label>
                        <input
                            class="form-control"
                            id="project_title"
                            type="text"
                            value="{{ $row->project_title ?? '' }}"
                            readonly
                        >
                    </div>
                    <div class="col-md-4">
                        <label for="firm_name"><strong>Name of Firm:</strong></label>
                        <input
                            class="form-control"
                            id="firm_name"
                            type="text"
                            value="{{ $row->firm_name ?? '' }}"
                            readonly
                        >
                    </div>
                    <div class="col-md-12">
                        <label for="address"><strong>Office Address:</strong></label>
                        <input
                            class="form-control"
                            id="address"
                            type="text"
                            value="{{ $row->office_landmark ?? '' }}, {{ $row->office_barangay ?? '' }} , {{ $row->office_city ?? '' }}, {{ $row->office_province ?? '' }}, {{ $row->office_region ?? '' }}"
                            readonly
                        >
                    </div>
                    <div class="col-md-12">
                        <label for="address"><strong>Factory Address:</strong></label>
                        <input
                            class="form-control"
                            id="address"
                            type="text"
                            value="{{ $row->factory_landmark ?? '' }}, {{ $row->factory_barangay ?? '' }} , {{ $row->factory_city ?? '' }}, {{ $row->factory_province ?? '' }}, {{ $row->factory_region ?? '' }}"
                            readonly
                        >
                    </div>
                    <div class="col-md-8">
                        <label for="contact_person"><strong>Contact Person:</strong></label>
                        <input
                            class="form-control"
                            id="contact_person"
                            type="text"
                            value="{{ $row->f_name ?? '' }} {{ $row->l_name ?? '' }}"
                            readonly
                        >
                    </div>
                    <div class="col-md-4">
                        <label for="designation"><strong>Designation:</strong></label>
                        <input
                            class="form-control"
                            id="designation"
                            type="text"
                            value="{{ $row->designation ?? '' }}"
                            readonly
                        >
                    </div>
                    <div class="col-md-4">
                        <label for="landline"><strong>Landline:</strong></label>
                        <input
                            class="form-control"
                            id="landline"
                            type="text"
                            value="{{ $row->landline ?? '' }}"
                            readonly
                        >
                    </div>
                    <div class="col-md-4">
                        <label for="mobile_phone"><strong>Mobile Phone:</strong></label>
                        <input
                            class="form-control"
                            id="mobile_phone"
                            type="text"
                            value="{{ $row->mobile_number ?? '' }}"
                            readonly
                        >
                    </div>
                    <div class="col-md-4">
                        <label for="email"><strong>Email Address:</strong></label>
                        <input
                            class="form-control"
                            id="email"
                            type="text"
                            value="{{ $row->email ?? '' }}"
                            readonly
                        >
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Add more content as needed -->
    <div class="col-12 col-md-4">
        <div class="card shadow-sm rounded-sm">
            <div class=" card-header bg-primary">
                <h2 class="text-white mb-0">
                    Refund Progress
                </h2>
            </div>
            <div class="card-body">
                <div class="container">
                    <div class="row">
                        <div class="col d-flex flex-column align-items-center">
                            <div
                                class="mx-auto"
                                id="ProgressPer"
                                style="order: 1;"
                            ></div>
                            <div
                                class="text-center"
                                id="ProgressPerText"
                                style="order: 2;"
                            >
                                <h5>0/0</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-8">
        <div
            class="card shadow-sm rounded-sm"
            id="upcomingPaymentContainer"
        >
            <div class="card-header bg-primary">
                <h2 class="text-white mb-0">Payment</h2>
            </div>
            <div class="card-body">

            </div>
        </div>
    </div>
</div>
