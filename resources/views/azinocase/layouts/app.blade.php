@include('azinocase.layouts.head')
@if(Auth::guest())
<body data-user-id="0" data-user-balance="0">
@else
<body data-user-id="{{Auth::user()->id}}" data-user-balance="@if(Auth::user()->deposit == 0 && Auth::user()->money == 0) {{Auth::user()->bonus_money}} @else {{Auth::user()->money}} @endif">
@endif
@yield('banner')
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
<script>locale = '{{ App::getLocale() }}'</script>
<script>
    window._translations = {!! cache('translations' . App::getLocale()) !!};
</script>
<script type="text/javascript" src="/js/app.js"></script>
</body>
</html>