
<!--header menu-->
<div class="header-menu-layout"></div>
<!--header menu layout-->
<div class="header-menu">
    <div class="header-menu__logo-line"><img src="/img/logo-big.svg" alt="" class="header-menu__logo-img"></div>
    <div class="header-menu__close-button">
        <img src="/img/close-mobile-menu.svg" alt="" class="header-menu__close-button-img">
        <img src="/img/close-mobile-menu-hover.svg" alt="" class="header-menu__close-button-img header-menu__close-button-img_hover">
    </div>
    <div class="header-menu__link-line">
        <a href="/">
            <div class="header-menu__link @yield('index')">{{ trans('Home') }}</div>
        </a>
    </div>
    @if(Auth::guest())
    <div class="header-menu__link-line">
        <a href="#" class="modal-toggle header-menu__close2-button" data-toggle="login"data-title="{{ trans('Log in') }} &lt;span&gt;{{ trans('to the site') }}&lt;/span&gt;">
            <div class="header-menu__link @yield('top')">{{ trans('Cabinet') }}</div>
        </a>
    </div>
    @else
    <div class="header-menu__link-line">
        <a href="/profile">
            <div class="header-menu__link @yield('top')">{{ trans('Cabinet') }}</div>
        </a>
    </div>
    @endif
    <div class="header-menu__link-line">
        <a href="/faq">
            <div class="header-menu__link @yield('faq')">{{ trans('FAQ') }}</div>
        </a>
    </div>
    <div class="header-menu__link-line">
        @if (defined('TICKETS'))
        <a href="/tickets"><div class="header-menu__link @yield('help')"><span class="circle">{{ TICKETS }}</span>{{ trans('Help') }}</a></div>
        @else
        <a href="/help"><div class="header-menu__link @yield('help')">{{ trans('Help') }}</div></a>
        @endif
    </div>
    @foreach (config('app.available_locales') as $locale)
    <div class="header-menu__link-line">
        <a href="/locale/{{ $locale }}">
            <div class="header-menu__link" @if (App::getLocale() == $locale) style="opacity:.5" @endif>
                <img src="/img/{{ $locale }}.png" alt="" width="33">
            </div>
        </a>
    </div>
    @endforeach
</div>
