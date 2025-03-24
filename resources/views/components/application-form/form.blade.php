@props(['ownerId', 'draft_type'])
<form
    class="g-3 p-5"
    id="applicationForm"
    data-get-draft="@secureGetDraft($draft_type, $ownerId)"
    data-store-draft="@secureStoreDraft($draft_type, $ownerId)"
    action="{{ URL::signedRoute('applicationFormSubmit', $ownerId) }}"
    novalidate
>
    {{ $slot }}
</form>
