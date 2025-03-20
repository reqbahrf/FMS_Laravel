@props(['quarter', 'isEditable' => false])
<style>
    #newEmploymentGenerated th,
    #newEmploymentGenerated td {
        border: 1px solid black;
        padding: 8px;
        text-align: center;
    }

    #newEmploymentGenerated th {
        background-color: #f2f2f2;
    }
</style>
<div
    class=""
    id="newEmploymentGenerated"
>
    <p>No. of new employment generated from the project:</p>
    <!-- Add/Remove Quarter Buttons -->
    <div class="text-end">
        <button
            class="btn btn-primary btn-sm"
            id="addQuarterTableButton"
            type="button"
        >
            <i class="ri-add-line"></i>
        </button>
        <button
            class="btn btn-danger btn-sm removeQuarterButton"
            id="removeQuarterTableButton"
            type="button"
            disabled
        >
            <i class="ri-subtract-line"></i>
        </button>
    </div>

    <div id="quarterTablesContainer">
        <!-- Initial Quarter Table -->
        <div
            class="quarter-table"
            data-quarter="1"
        >
            <p>1ˢᵗ Quarter</p>
            <table
                class=""
                id="newEmploymentGeneratedForQuarter1"
            >
                <thead>
                    <tr>
                        <th>No. of Employees</th>
                        <th>No. of Male</th>
                        <th>No. of Female</th>
                        <th>No. of Person with Disability</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <x-custom-input.input
                                class="noOfEmployees"
                                type="text"
                                value=""
                                :isEditable="$isEditable"
                            />
                        </td>
                        <td>
                            <x-custom-input.input
                                class="noOfMale"
                                type="text"
                                value=""
                                :isEditable="$isEditable"
                            />
                        </td>
                        <td>
                            <x-custom-input.input
                                class="noOfFemale"
                                type="text"
                                value=""
                                :isEditable="$isEditable"
                            />
                        </td>
                        <td>
                            <x-custom-input.input
                                class="noOfPersonWithDisability"
                                type="text"
                                value=""
                                :isEditable="$isEditable"
                            />
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
