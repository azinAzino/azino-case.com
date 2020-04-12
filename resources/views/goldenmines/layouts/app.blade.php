@include('goldenmines.layouts.head')
@if(Auth::guest())
<body data-user-id="0" data-user-balance="0">
@else
<body data-user-id="{{Auth::user()->id}}" data-user-balance="@if(Auth::user()->deposit == 0 && Auth::user()->money == 0) {{Auth::user()->bonus_money}} @else {{Auth::user()->money}} @endif">
@endif
@yield('banner')
<div class="main-wrapper @yield('bonus')">
@include('goldenmines.layouts.header')
@include('goldenmines.layouts.live')
@yield('content')
</div>
@include('goldenmines.layouts.footer')
@include('goldenmines.layouts.header.menu')
@include('goldenmines.layouts.modals')
@yield('modal')
@include('goldenmines.layouts.scripts')
<script>locale = '{{ App::getLocale() }}'</script>
<script>
    window._translations = {!! cache('translations' . App::getLocale()) !!};
</script>
<script type="text/javascript" src="/js/app.js"></script>
</body>
</html>