<div class="footer-wrapper">
    <div class="footer">
        <div class="container">
            <div class="row">
                <div class="col-sm-5 col-md-3 col-lg-3 hidden-xs">
                    <div class="footer__copyright-block">
                        <div class="footer__copyright text-block text-block_fs_m">© 2017 &mdash; 2020</div>
                        <div class="footer__mini-description text-block text-block_color_gray text-block_fs_m">
                            {{ trans('Cases with money') }}!</div>
                        <div class="footer__terms text-block text-block_color_gray text-block_fs_m">
                            {{ trans('Write to us') }}: <a href="email:info@azino-case.com"><span
                                    class="text-block__link">info@azino-case.com</span></a></div>
                        <div class="footer__terms text-block text-block_color_gray text-block_fs_s">
                            {{ trans('By logging in you accept') }}
                            <a href="/terms" class="text-block__link">{{ trans('the terms of use') }}</a>
                        </div>
                        <div class="footer__terms text-block text-block_color_gray text-block_fs_s">
                            <a href="/privacy" class="text-block__link">{{ trans('privacy policy') }}</a>
                        </div>
                        <div class="footer__age-limit-wrapper">
                            <div class="age-limit">18+</div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-3 col-md-2 col-lg-2">
                    <div class="footer__nav-block">
                        <div class="footer__nav-link  @yield('foo_index') ">
                            <a href="/">{{ trans('Home') }}</a>
                        </div>
                        @if(Auth::guest())
                        <div class="footer__nav-link @yield('foo_profile')">
                            <a href="#" class="modal-toggle" data-toggle="login"
                                data-title="{{ trans('Log in') }} &lt;span&gt;{{ trans('to the site') }}&lt;/span&gt;">
                                {{ trans('Cabinet') }}
                            </a>
                        </div>
                        @else
                        <div class="footer__nav-link @yield('foo_profile')">
                            <a href="/profile">{{ trans('Cabinet') }}</a>
                        </div>
                        @endif
                        <div class="footer__nav-link @yield('foo_faq')">
                            <a href="/faq">{{ trans('FAQ') }}</a>
                        </div>
                        <div class="footer__nav-link @yield('foo_help')">
                            @if (defined('tickets'))
                            <a href="/tickets"><span class="circle">{{ TICKETS }}</span>{{ trans('Help') }}</a>
                            @else
                            <a href="/help">{{ trans('Help') }}</a>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-xs-6 col-sm-4 col-md-3 col-lg-3">

                </div>

                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="footer__pay-system-header text-block text-block_fs_m">{{ trans('We accept') }}:</div>
                    <div class="pay-system">
                        <div class="pay-system__img-wrapper"><img src="/img/system/pay-icon_visa_mc.png"
                                alt="Visa/MasterCard" title="Visa/MasterCard" class="pay-system__img" /></div>
                        <div class="pay-system__img-wrapper"><img src="/img/system/pay-icon_ym.png"
                                alt="{{ trans('Yandex.Money') }}" title="{{ trans('Yandex.Money') }}"
                                class="pay-system__img" /></div>
                        <div class="pay-system__img-wrapper"><img src="/img/system/pay-icon_qiwi.png" alt="Qiwi"
                                title="Qiwi" class="pay-system__img" /></div>
                        <div class="pay-system__img-wrapper"><img src="/img/system/pay-icon_payeer.png"
                                alt="{{ trans('Payeer') }}" title="{{ trans('Payeer') }}" class="pay-system__img" />
                        </div>
                        <div class="pay-system__img-wrapper"><img src="/img/system/pay-icon_1.png"
                                alt="{{ trans('Webmoney') }}" title="{{ trans('WebMoney') }}" class="pay-system__img" />
                        </div>
                        <div class="pay-system__img-wrapper"><img src="/img/system/pay-icon_2.png"
                                alt="{{ trans('Advcache') }}" title="{{ trans('AdvCache') }}" class="pay-system__img" />
                        </div>
                        <div class="pay-system__img-wrapper"><img src="/img/system/pay-icon_3.png"
                                alt="{{ trans('Neteller') }}" title="{{ trans('Neteller') }}" class="pay-system__img" />
                        </div>
                        <div class="pay-system__img-wrapper" style="opacity:0;"><a href="//showstreams.tv/"><img
                                    src="//www.free-kassa.ru/img/fk_btn/14.png" title="Бесплатный видеохостинг"></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 visible-xs">
                <div class="footer__copyright-block">
                    <div class="footer__copyright text-block text-block_fs_m">© 2017 &mdash; 2020</div>
                    <div class="footer__mini-description text-block text-block_color_gray text-block_fs_m">
                        {{ trans('Cases with money!') }}</div>
                    <div class="footer__terms text-block text-block_color_gray text-block_fs_m">
                        {{ trans('Write to us') }}: <a href="mailto:info@azino-case.com"><span
                                class="text-block__link">info@azino-case.com</span></a></div>
                    <div class="footer__terms text-block text-block_color_gray text-block_fs_s">
                        {{ trans('By logging in you accept') }}
                        <a href="/terms" class="text-block__link">{{ trans('the terms of use') }}</a>
                        <div class="footer__age-limit-wrapper">
                            <div class="age-limit">18+</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>