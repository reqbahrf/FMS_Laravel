<style>
    #projectStatusDescriptions td {
        padding: 8px;
        text-align: left;
        border: none;
    }

    #projectStatusDescriptions .section-title {
        font-weight: normal;
        padding-top: 15px;
    }
</style>
<div
    class=""
    id="projectStatusDescriptions"
>
    <table>
        <tr>
            <td class="section-title">
                • Improvement in production efficiency (includes quantitative indicators on improvement in number and
                quality of materials, number and value of produce, waste minimization, reject reduction, etc.)
            </td>
        </tr>
        <tr>
            <td>
                <x-custom-input.list-text-formatter
                    name="projectStatusDescription"
                    :text="''"
                    :isEditable="$isEditable"
                />
            </td>
        </tr>
        <tr>
            <td class="section-title">VII. Problems met & actions taken during project implementation</td>
        </tr>
        <tr>
            <td>
                <x-custom-input.list-text-formatter
                    name="projectStatusDescription"
                    :text="''"
                    :isEditable="$isEditable"
                />
            </td>
        </tr>
        <tr>
            <td class="section-title">VIII. Action/ plan for the improvement of project's operation</td>
        </tr>
        <tr>
            <td>
                <x-custom-input.list-text-formatter
                    name="projectStatusDescription"
                    :text="''"
                    :isEditable="$isEditable"
                />
            </td>
        </tr>
        <tr>
            <td class="section-title">IX. Linkages/Promotional Plan</td>
        </tr>
        <tr>
            <td>
                <x-custom-input.list-text-formatter
                    name="projectStatusDescription"
                    :text="''"
                    :isEditable="$isEditable"
                />
            </td>
        </tr>
    </table>

</div>
