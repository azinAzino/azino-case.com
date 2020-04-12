<div class="header">
    <div class="container">
        <div class="header-row">
            <div class="header-row__element_static">
                <div class="header-menu-button visible-xs visible-sm">
                    <div class="header-menu-button__wrapper">
                        <div class="header-menu-button__line"></div>
                        <div class="header-menu-button__line"></div>
                        <div class="header-menu-button__line"></div>
                    </div>
                </div>
            </div>
            <div class="header-row__element_static header-row__element_sm-rubber header-row__element_xs-rubber">
                <div class="logo-wrapper hidden-xs"><a href="/"><img src="/img/logo-big.svg" alt="{{ config('app.name', 'Laravel') }}" class="logo-wrapper__img"></a></div>
                <div class="logo-wrapper visible-xs"><a href="/"><img src="/img/logo-min.svg" alt="{{ config('app.name', 'Laravel') }}" class="logo-wrapper__img"></a></div>
            </div>
            <div class="header-row__element header-row__element_lg-rubber header-row__element_md-rubber">
                <nav class="nav-line hidden-sm hidden-xs">
                    <div class="nav-line__element">
                        <a href="/">
                            <div class="nav-line__link  @yield('index')">{{ trans('Home') }}</div>
                        </a>
                    </div>
                    @if(Auth::guest())
                    <div class="nav-line__element">
                        <a href="#" class="modal-toggle" data-toggle="login"data-title="{{ trans('Log in') }} &lt;span&gt;{{ trans('to the site') }}&lt;/span&gt;">
                            <div class="nav-line__link @yield('top')">{{ trans('Cabinet') }}</div>
                        </a>
                    </div>
                    @else
                    <div class="nav-line__element">
                        <a href="/profile">
                            <div class="nav-line__link @yield('top')">{{ trans('Cabinet') }}</div>
                        </a>
                    </div>
                     @endif
                    <div class="nav-line__element">
                        <a href="/faq">
                            <div class="nav-line__link @yield('faq')">{{ trans('FAQ') }}</div>
                        </a>
                    </div>
                    <div class="nav-line__element">
                       @if (defined('TICKETS'))
                       <a href="/tickets">
                            <div class="nav-line__link @yield('help')"><span class="circle">{{ TICKETS }}</span>{{ trans('Help') }}</div>
                        </a>
                        @else
                        <a href="/help">
                             <div class="nav-line__link @yield('help')">{{ trans('Help') }}</div>
                         </a>
                        @endif
                    </div>
                    @foreach (config('app.available_locales') as $locale)
                    <div class="nav-line__element">
                        <a href="/locale/{{ $locale }}">
                            <div class="nav-line__link" @if (App::getLocale() == $locale) style="opacity:.5" @endif>
                                <img src="/img/{{ $locale }}.png" alt="" width="33">
                            </div>
                        </a>
                    </div>
                    @endforeach
                </nav>
            </div>
            @if(Auth::guest())
            <div class="header-row__element_static">
                <div class="header-row__login-button">
                    <button data-toggle="login" data-title="{{ trans('Log in') }} &lt;span&gt;{{ trans('to the site') }}&lt;/span&gt;" class="modal-toggle button-rounding button-rounding_big button-rounding_hlight">{{ trans('Log in') }}</button>
                    <button data-toggle="register" data-title="{{ trans('Registration') }} &lt;span&gt;{{ trans('on the site') }}&lt;/span&gt;" class="modal-toggle button-rounding button-rounding_big button-rounding_trans-hlight hidden-500">{{ trans('Registration') }}</button>
                </div>
            </div>
            @else
            <div class="header-row__element_static">
                <div class="user-block">
                    <div class="user-block__wrapper hidden-xs">
                        <a href="/profile">
                            <div class="user-block__avatar">
                                <img src="{{Auth::user()->avatar}}" class="user-block__avatar-img" alt="{{ trans('Profile') }}">
                            </div>
                        </a>
                    </div>
                    <div class="user-block__wrapper">
                        <div class="user-block__balance-block">
                            <div class="user-block__counters">
                                <div class="user-block__counter-balance">
                                    <span class="user-block__balance_value">@if(Auth::user()->deposit == 0 && Auth::user()->money == 0) {{ number_format(Auth::user()->bonus_money, 2, ',', ' ') }} @else {{ number_format(Auth::user()->money, 2, ',', ' ') }} @endif</span> $
                                </div>
                                <a href="/profile" class="user-block__counters-name-link">{{ trans('Profile') }}</a>
                            </div>
                            <div class="user-block__cash-buttons">
                                <button data-toggle="add-cash" class="modal-toggle user-block__cashin">
                                    <img src="/img/plus.svg" class="user-block__cash-button-img" alt="{{ trans('Replenish') }}" title="{{ trans('Replenish') }}">
                                    <img src="/img/plus-w.svg" class="user-block__cash-button-img user-block__cash-button-img_hover" alt="{{ trans('Replenish') }}" title="{{ trans('Replenish') }}">
                                    {{ trans('Replenish') }}
                                </button>
                                <button data-toggle="remove-cash" class="modal-toggle user-block__cashout">
                                    <img src="/img/minus.svg" class="user-block__cash-button-img" alt="{{ trans('Withdraw') }}" title="{{ trans('Withdraw') }}">
                                    <img src="/img/minus-w.svg" class="user-block__cash-button-img user-block__cash-button-img_hover" alt="{{ trans('Withdraw') }}" title="{{ trans('Withdraw') }}">
                                    {{ trans('Withdraw') }}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>