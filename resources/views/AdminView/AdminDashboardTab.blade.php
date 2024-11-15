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
<div class="container-fluid">
    <div class="row gy-3 gx-2">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <p class="fw-bold fs-5 m-0">Projects</p>
                    <div id="overallProjectGraph">

                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5>Locale and Enterprise Level Percentage</h5>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-9">
            <div class="card">
                <div class="card-body">
                    <div id="localeChart">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-3">
            <div class="card h-100">
                <div class="card-body h-100 d-flex justify-content-center align-items-center">
                    <div id="enterpriseLevelChart">

                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 py-2 py-sm-0">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Staff Handle Projects</h5>
                    <div id="staffHandledB"></div>
                </div>
            </div>
        </div>
    </div>
</div>
