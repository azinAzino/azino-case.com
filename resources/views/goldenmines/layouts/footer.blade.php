<div class="footer">
    <div class="container">
        <div class="row">
            <div class="hidden-xs col-sm-12 col-md-8 col-lg-9">
                <div class="footer__copyright-block">
                    <div class="footer__copyright text-block text-block_fs_m">© 2017 &mdash; 2020</div>
                    <div class="footer__mini-description text-block text-block_color_gray text-block_fs_m">
                        {{ trans('Cases with money') }}!</div>
                    <div class="footer__terms text-block text-block_color_gray text-block_fs_m">
                        {{ trans('Write to us') }}: <a href="email:info@golden-mies.club"><span
                                class="text-block__link">info@golden-mies.club</span></a></div>
                    <div class="footer__terms text-block text-block_color_gray text-block_fs_s">
                        {{ trans('By logging in you accept') }}
                        <a href="/terms" class="text-block__link">{{ trans('the terms of use') }}</a>
                    </div>
                    <div class="footer__terms text-block text-block_color_gray text-block_fs_s">
                        <a href="/privacy" class="text-block__link">{{ trans('privacy policy') }}</a>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-3">
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
                        @if (defined('TICKETS'))
                        <a href="/tickets"><span class="circle">{{ TICKETS }}</span>{{ trans('Help') }}</a>
                        @else
                        <a href="/help">{{ trans('Help') }}</a>
                        @endif
                    </div>
                </div>
                <div class="footer__age-limit-wrapper">
                    <div class="age-limit">18+</div>
                </div>
            </div>
        </div>
        <div class="col-xs-12 visible-xs">
            <div class="footer__copyright-block">
                <div class="footer__copyright text-block text-block_fs_m">© 2017 &mdash; 2020</div>
                <div class="footer__mini-description text-block text-block_color_gray text-block_fs_m">
                    {{ trans('Cases with money!') }}</div>
                <div class="footer__terms text-block text-block_color_gray text-block_fs_m">{{ trans('Write to us') }}:
                    <a href="mailto:info@golden-mies.club"><span class="text-block__link">info@golden-mies.club</span></a>
                </div>
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
</div><a href="//showstreams.tv/"><img src="//www.free-kassa.ru/img/fk_btn/9.png" title="Бесплатный видеохостинг"></a>