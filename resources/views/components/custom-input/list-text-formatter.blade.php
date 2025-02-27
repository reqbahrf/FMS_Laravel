@if ($isEditable)
    <textarea
        class="form-control"
        name="{{ $name }}"
    >{{ $text }}</textarea>
    <small class="form-text text-muted">Use * at the beginning of a line to create a bullet point</small>
@else
    <div class="formatted">
        {!! $formattedText() !!}
    </div>
@endif
