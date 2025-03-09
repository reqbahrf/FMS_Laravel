@if ($isEditable)
    @if ($type == 'checkbox' || $type == 'radio')
        <input
            class="{{ $class ?? '' }}"
            name="{{ $name ?? '' }}"
            type="{{ $type }}"
            @isset($id) id="{{ $id }}" @endisset
            {{ $attributes->only('readonly', 'class', 'style') }}
            @if ($attributes->has('readonly')) @disabled(true) @endif
            @if ($value === true || $value === 'on' || $value === 1 || $value !== '') checked @endif
        >
    @else
        <input
            class="{{ $class ?? '' }}"
            type="{{ $type }}"
            value="{{ $value ?? '' }}"
            @isset($style) style="{{ $style }}" @endisset
            @isset($id) id="{{ $id }}" @endisset
            {{ $attributes->only('readonly', 'class', 'style') }}
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
