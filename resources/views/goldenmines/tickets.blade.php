<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta name="theme-color" content="#ffffff">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ __('My tickets') }} — Egger</title>
    <link rel="stylesheet" href="/css/goldenmines.css?{{ time() }}">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" href="/favicon-32x32.png" sizes="32x32">
    <link rel="icon" type="image/png" href="/favicon-16x16.png" sizes="16x16">
    <link rel="manifest" href="/manifest.json">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
	<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.4/summernote.js"></script>
    <?php 
    global $settings;
    $settings = DB::table('settings')->where('id', SITE_ID)->first();
    ?>
	<script> var vk_group = '{{$settings->vk_group}}'; </script>
</head>
@if(Auth::guest())
<body data-user-id="0" data-user-balance="0">
    @else
    <body data-user-id="{{Auth::user()->id}}" data-user-balance="@if(Auth::user()->deposit == 0 && Auth::user()->money == 0) {{Auth::user()->bonus_money}} @else {{Auth::user()->money}} @endif">
        @endif
        

@if (!Auth :: guest ())
<div class="bonus-banner_auth">
    <div class="hidden-xs container">
        <button data-toggle="bonus-modal" class="bonus-banner__button modal-toggle"> {{ __('Read') }} </button>
    </div>
</div>
@endif
        <div class="main-wrapper @yield('bonus')">
            @include('goldenmines.layouts.header')
            @include('goldenmines.layouts.live')
            <div class="container">
                <div class="HelpLg">
                    <div class="HelpLg__wrapper">
                        <div style="padding:1.4em;background-color: #1e2832;color:#fff;" class="PodLogin">
                            @yield('content')
                            @yield('page')
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('goldenmines.layouts.footer')
        @include('goldenmines.layouts.header.menu')
        @include('goldenmines.layouts.modals')
        @yield('modal')
        @include('goldenmines.layouts.scripts')
        @yield('footer')
        <script>
            locale = '{{ App::getLocale() }}'
        </script>
        <script>
            window._translations = {!! cache('translations'.App::getLocale()) !!};
        </script>
        <script type="text/javascript" src="/js/app.js"></script>
        <script type="text/javascript" src="/js/bootstrap.min.js"></script>
    </body>

    </html>