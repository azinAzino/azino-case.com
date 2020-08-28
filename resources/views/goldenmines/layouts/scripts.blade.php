<!--<a href="//showstreams.tv/"><img src="//www.free-kassa.ru/img/fk_btn/16.png" title="Бесплатный видеохостинг"></a>-->
@php
 $settings = App\Settings::where('id', SITE_ID)->first();   
@endphp
<script src="http://{{ $settings->url }}:3000/socket.io/socket.io.js"></script>
<script data-cfasync="false" src="/cdn-cgi/scripts/af2821b0/cloudflare-static/email-decode.min.js"></script>