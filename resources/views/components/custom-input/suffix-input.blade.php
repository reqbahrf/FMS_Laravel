<div class="col-12 col-md-2">
    <label
        class="form-label"
        for="suffix"
    >Suffix: </label>
    <input
        class="form-control"
        id="suffix"
        name="suffix"
        value="{{ old('suffix') }}"
        list="suffixList"
    >
    <datalist id="suffixList">
        <option value="Jr.">Jr.</option>
        <option value="Sr.">Sr.</option>
        <option value="II">II</option>
        <option value="III">III</option>
        <option value="IV">IV</option>
        <option value="Esq.">Esq.</option>
        <option value="Ph.D.">Ph.D.</option>
    </datalist>
</div>
