@if ($isEditable)
    @if ($type == 'checkbox' || $type == 'radio')
        <input
            class="{{ $class ?? '' }}"
            name="{{ $name ?? '' }}"
            type="{{ $type }}"
            {{ $attributes->only('readonly', 'class') }}
            @if ($attributes->has('readonly')) @disabled(true) @endif
            @if ($value === true || $value === 'on' || $value === 1 || $value !== '') checked @endif
        >
    @else
        <input
            class="{{ $class ?? '' }}"
            type="{{ $type }}"
            value="{{ $value ?? '' }}"
            {{ $attributes->only('readonly', 'class') }}
            @isset($name) name="{{ $name }}" @endisset
        >
    @endif
@else
    @if ($type == 'text' || $type == 'number')
        {{ $value ?? '' }}
    @elseif($type == 'checkbox' || $type == 'radio')
        {{ ($value ?? '') === true || ($value ?? '') === 'on' || ($value ?? '') === 1 || ($value ?? '') !== '' ? '✓' : '' }}
    @elseif($type == 'date')
        {{ $value instanceof \Carbon\Carbon ? $value->format('Y-m-d') : $value ?? '' }}
    @endif
@endif
