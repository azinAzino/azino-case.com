@include('azinocase.layouts.head')

@if(Auth::guest())
<body data-user-id="0" data-user-balance="0">
@else
<body data-user-id="{{Auth::user()->id}}" data-user-balance="@if(Auth::user()->deposit == 0 && Auth::user()->money == 0) {{Auth::user()->bonus_money}} @else {{Auth::user()->money}} @endif">
@endif
@if (!Auth::guest() && (float)Auth::user()->deposit <= 0)
<div class="bonus-banner_auth">
    <div class="hidden-xs container-fluid">
        <button data-toggle="bonus-modal" class="bonus-banner__button modal-toggle"> {{ __('Read') }} </button>
    </div>
</div>
@endif
<div class="main-wrapper @yield('bonus')">
@include('azinocase.layouts.header')
@include('azinocase.layouts.live')
@yield('content')
</div>
@include('azinocase.layouts.footer')
@include('azinocase.layouts.header.menu')
@include('azinocase.layouts.modals')
@yield('modal')
@include('azinocase.layouts.scripts')
<audio class="sound_heart" preload="auto">
    <source src="/img/system/sound/heart.mp3" type="audio/mpeg">
    <source src="/img/system/sound/heart.ogg" type="audio/ogg; codecs=vorbis">
</audio>
<audio class="sound_win" preload="auto">
    <source src="/img/system/sound/win.mp3" type="audio/mpeg">
    <source src="/img/system/sound/win.ogg" type="audio/ogg; codecs=vorbis">
</audio>
<script>locale = '{{ App::getLocale() }}'</script>
<script>
    window._translations = {!! cache('translations' . App::getLocale()) !!};
</script>
<script type="text/javascript" src="/js/app.js?{{ time() }}"></script>
</body>
</html>