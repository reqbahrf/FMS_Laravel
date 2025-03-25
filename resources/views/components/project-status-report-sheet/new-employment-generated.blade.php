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

    @if ($isEditable)
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
                data-remove-row-btn
                {{ count($quarters) <= 1 ? 'disabled' : '' }}
            >
                <i class="ri-subtract-line"></i>
            </button>
        </div>
    @endif

    <div id="quarterTablesContainer">
        @foreach ($quarters as $quarterNumber => $quarterData)
            <div
                class="quarter-table mb-3"
                data-quarter="{{ $quarterNumber }}"
            >
                <p>{{ $getOrdinalSuffix($quarterNumber) }} Quarter</p>
                <table
                    class="w-100"
                    id="newEmploymentGeneratedForQuarter{{ $quarterNumber }}"
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
                                    name="newEmploymentGenerated[quarter{{ $quarterNumber }}][noOfEmployees]"
                                    type="text"
                                    value="{{ $quarterData['noOfEmployees'] }}"
                                    :isEditable="$isEditable"
                                />
                            </td>
                            <td>
                                <x-custom-input.input
                                    class="noOfMale"
                                    name="newEmploymentGenerated[quarter{{ $quarterNumber }}][noOfMale]"
                                    type="text"
                                    value="{{ $quarterData['noOfMale'] }}"
                                    :isEditable="$isEditable"
                                />
                            </td>
                            <td>
                                <x-custom-input.input
                                    class="noOfFemale"
                                    name="newEmploymentGenerated[quarter{{ $quarterNumber }}][noOfFemale]"
                                    type="text"
                                    value="{{ $quarterData['noOfFemale'] }}"
                                    :isEditable="$isEditable"
                                />
                            </td>
                            <td>
                                <x-custom-input.input
                                    class="noOfPersonWithDisability"
                                    name="newEmploymentGenerated[quarter{{ $quarterNumber }}][noOfPersonWithDisability]"
                                    type="text"
                                    value="{{ $quarterData['noOfPersonWithDisability'] }}"
                                    :isEditable="$isEditable"
                                />
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        @endforeach
    </div>
</div>
