@props(['ownerId', 'draft_type', 'withAction' => true])
<form
    class="g-3 p-5"
    id="applicationForm"
    data-get-draft="@secureGetDraft($draft_type, $ownerId)"
    data-store-draft="@secureStoreDraft($draft_type, $ownerId)"
    @if ($withAction) action="{{ URL::signedRoute('applicationFormSubmit', $ownerId) }}" @endif
    novalidate
>
    {{ $slot }}
</form>
