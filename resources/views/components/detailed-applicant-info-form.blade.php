<x-application-form.form
    :ownerId="$ownerId"
    :draft_type="$draft_type"
    :withAction="false"
>
    <x-application-form.personal-info />
    <x-application-form.business-info :withFileInput="false" />
</x-application-form.form>
