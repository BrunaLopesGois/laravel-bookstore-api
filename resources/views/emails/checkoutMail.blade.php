@component('mail::message')
<a data-flickr-embed="true" data-header="true" href="https://www.flickr.com/photos/193894977@N06/51486849017/in/dateposted-public/" title="logolivraria"><img src="https://live.staticflickr.com/65535/51486849017_65304757f6_m.jpg" width="198" height="167" alt="logolivraria"></a><script async src="//embedr.flickr.com/assets/client-code.js" charset="utf-8"></script>

# {{ $content['title'] }}<br>

{{ $content['body'] }}

{{-- @component('mail::button', ['url' => ''])
Button Text
@endcomponent --}}

Agradecemos a preferência,<br>
{{ config('app.name') }}
@endcomponent
