@if ($isEditable)
    <input
        class="{{ $class ?? '' }}"
        type="{{ $type }}"
        value="{{ $value ?? '' }}"
        @isset($name) name="{{ $name }}" @endisset
        @if ($type == 'checkbox' || $type == 'radio') @checked(isset($value)) @endIf
    >
@else
    @if ($type == 'text' || $type == 'number')
        {{ $value ?? '' }}
    @elseif($type == 'checkbox' || $type == 'radio')
        {{ isset($value) ? '✓' : '' }}
    @elseif($type == 'date')
        {{ $value->format('Y-m-d') ?? '' }}
    @endif
@endif
