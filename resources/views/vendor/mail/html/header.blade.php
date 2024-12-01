@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: flex; align-items: center; gap: 0.5rem; justify-content: center;">
@if (trim($slot) === 'Laravel')
<img src="https://laravel.com/img/notification-logo.png" class="logo" alt="Laravel Logo">
@else
<img src="{{ $message->embed(asset('DOST_ICON.svg')) }}" alt="{{ config('app.name') }}" style="width: 60px;">
<span style="font-size: 30px;">{{ config('app.name') }}</span>
@endif
</a>
</td>
</tr>
