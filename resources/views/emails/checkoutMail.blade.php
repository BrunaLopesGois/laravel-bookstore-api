@component('mail::message')
# {{ $content['title'] }}<br>

{{ $content['body'] }}

{{-- @component('mail::button', ['url' => ''])
Button Text
@endcomponent --}}

Agradecemos a preferência,<br>
{{ config('app.name') }}
@endcomponent
