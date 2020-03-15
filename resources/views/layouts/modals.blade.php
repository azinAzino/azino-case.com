<div class="modal-layout"></div>
<?php global $settings; ?>
<div id="login" class="modal-window modal-window_size_s modal-window_color_default">
    <div class="modal-window__wrapper">
        <div class="modal-window__header-wrapper">
            <div class="modal-window__header">
                {!! trans('Sign <span>in</span>') !!}
            </div>
        </div>
        <div class="modal-window__content-wrapper">
            <div class="modal-window__element modal-window__social-button-block">
                <form method="POST" action="/auth/register">
                    {!! csrf_field() !!}
                    <div class="form-group">
                        <label for="auth_login" class="modal-window__element-header text-block text-block_tf_up">{{ trans('Login') }}</label>
                        <input placholder="Login" type="text" id="auth_login" name="username" value="{{ old('username') }}" class="input-block__input">
                        <span class="error-text" id="error-username"></span>
                    </div>
                    <div class="form-group">
                        <label for="auth_password" class="modal-window__element-header text-block text-block_tf_up">{{ trans('Password') }}</label>
                        <input type="password" id="auth_password" name="password" value="" class="input-block__input">
                        <span class="error-text" id="error-password"></span>
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <label for="authg_remember" class="modal-window__element-header text-block text-block_tf_up"><input class="form-check-input" name="reg_remember" type="checkbox" id="authg_remember"> {{ trans('Remember Me') }}</label>
                        </div>
                    </div>
                    <div class="form-group submit-group">
                        <button type="submit" class="button-rounding button-rounding_big button-rounding_hlight">{{ trans('Authorize') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<div id="register" class="modal-window modal-window_size_s modal-window_color_default">
    <div class="modal-window__wrapper">
        <div class="modal-window__header-wrapper">
            <div class="modal-window__header">
                {!! trans('Sign <span>up</span>') !!}
            </div>
        </div>
        <div class="modal-window__content-wrapper">
            <div class="modal-window__element modal-window__social-button-block">
                <form method="POST" action="/auth/register">
                    {!! csrf_field() !!}
                    <div class="form-group">
                        <label for="reg_username" class="modal-window__element-header text-block text-block_tf_up">{{ trans('Login') }}</label>
                        <input type="text" id="reg_username" name="username" value="{{ old('username') }}" class="input-block__input">
                        <span class="error-text" id="error-username"></span>
                    </div>

                    <div class="form-group">
                        <label for="reg_email" class="modal-window__element-header text-block text-block_tf_up">{{ trans('Email') }}</label>
                        <input type="email" id="reg_email" name="email" value="{{ old('email') }}" class="input-block__input">
                        <span class="error-text" id="error-email"></span>
                    </div>
                    <div class="form-group">
                        <label for="password" class="modal-window__element-header text-block text-block_tf_up">{{ trans('Password') }}</label>
                        <input type="password" id="reg_password" name="password" value="" class="input-block__input">
                        <span class="error-text" id="error-password"></span>
                    </div>
                    <div class="form-group">
                        <label for="reg_password_confirmation" class="modal-window__element-header text-block text-block_tf_up">{{ trans('Confirm Password') }}</label>
                        <input type="password" id="reg_password_confirmation" name="password_confirmation" value="" class="input-block__input">
                        <span class="error-text" id="error-password_confirmation"></span>
                    </div>
                    <div class="form-group submit-group">
                        <button type="submit" class="button-rounding button-rounding_big button-rounding_hlight">{{ trans('Register') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<div id="add-cash" class="modal-window modal-window_size_m modal-window_color_default">
    <div class="modal-window__wrapper">
        <div class="modal-window__header-wrapper">
            <div class="modal-window__header">
                {!! trans('Refill <span>balance</span>') !!}
            </div>
            <button class="modal-window__close-button">
                <img src="/img/close-mobile-menu.svg" alt="close" class="modal-window__close-button-img modal-window__close-button-img_blur">
                <img src="/img/close-mobile-menu-hover.svg" alt="close" class="modal-window__close-button-img modal-window__close-button-img_hover">
            </button>
        </div>
        <div class="modal-window__content-wrapper">
            <div class="modal-window__element-header text-block text-block_tf_up text-block_align_center">{{ trans('Enter amount') }}:</div>
            <div class="modal-window__element modal-window__input-block modal-window__element_with-header">
                <div class="input-block modal-window__input-wrapper">
                    <input class="input-block__input payment-amount" title="{{ trans('Amount of payment') }}" value="<?php echo $settings->min_dep; ?>">
                </div>
            </div>
            <div class="modal-window__element-header text-block text-block_tf_up text-block_align_center">{{ trans('Choose a replenishment method') }}:</div>
            <div class="modal-window__element modal-window__pay-system-wrapper modal-window__element_with-header">
                <div class="modal-window__pay-system pay-system">
                    <div class="modal-window__img-wrapper_main modal-window__img-wrapper pay-system__img-wrapper" data-currency="1" data-provider="3">
                        <img src="/img/system/pay-icon_mc-visa_l.png" alt="{{ trans('Bank card') }}" class="pay-system__img">
                    </div>
                    <div class="modal-window__img-wrapper_main modal-window__img-wrapper pay-system__img-wrapper" data-currency="5" data-provider="3">
                        <img src="/img/system/pay-icon_ym_l.png" alt="{{ trans('Yandex.Money') }}" class="pay-system__img">
                    </div>
                    <div class="modal-window__img-wrapper_main modal-window__img-wrapper pay-system__img-wrapper" data-currency="4" data-provider="3">
                        <img src="/img/system/pay-icon_qiwi_l.png" alt="Qiwi" class="pay-system__img">
                    </div>
                    <div class="modal-window__img-wrapper_main modal-window__img-wrapper pay-system__img-wrapper" data-currency="10" data-provider="3">
                        <img src="/img/system/pay-icon_payeer_l.png" alt="{{ trans('Payeer') }}" class="pay-system__img">
                    </div>
                    <!-- <div class="modal-window__img-wrapper_additionally modal-window__img-wrapper pay-system__img-wrapper" data-currency="19" data-provider="3">
                        <img src="/img/system/pay-icon_mts_l.png" alt="{{ trans('MTS') }}" class="pay-system__img">
                    </div>
                    <div class="modal-window__img-wrapper_additionally modal-window__img-wrapper pay-system__img-wrapper" data-currency="18" data-provider="3">
                        <img src="/img/system/pay-icon_mf_l.png" alt="{{ trans('Megafon') }}" class="pay-system__img">
                    </div>
                    <div class="modal-window__img-wrapper_additionally modal-window__img-wrapper pay-system__img-wrapper" data-currency="21" data-provider="3">
                        <img src="/img/system/pay-icon_bee_l.png" alt="{{ trans('Beeline') }}" class="pay-system__img">
                    </div>
                    <div class="modal-window__img-wrapper_additionally modal-window__img-wrapper pay-system__img-wrapper" data-currency="20" data-provider="3">
                        <img src="/img/system/pay-icon_tele2_l.png" alt="{{ trans('TELE2') }}" class="pay-system__img">
                    </div> -->
                    <!-- <div class="pay-system__img-wrapper pay-system__more pay-system__more_show">
                        <div class="pay-system__more-button">{{ trans('More') }}</div>
                    </div>
                    <div class="pay-system__img-wrapper pay-system__more pay-system__more_hide">
                        <div class="pay-system__more-button">{{ trans('Hide') }}</div>
                    </div> -->
                </div>
                <input type="hidden" class="payment-currency">
                <input type="hidden" class="payment-provider">
            </div>
            <div class="modal-window__element modal-window__button-block">
                <button class="modal-window__button button-rounding button-rounding_big button-rounding_long button-rounding_hlight" id="payment-in-submit">{{ trans('Fill up') }}</button>
            </div>
        </div>
    </div>
</div>


@if(!Auth::guest() && (true || Auth::user()->deposit >= $settings->min_width))
<div id="alert-modal" class="modal-window modal-window_size_s">
    <div class="modal-window__wrapper">
        <div class="modal-window__header-wrapper">
            <div class="modal-window__header"></div>
            <button class="modal-window__close-button">
                <img src="/img/close-mobile-menu.svg" alt="close" class="modal-window__close-button-img modal-window__close-button-img_blur">
                <img src="/img/close-mobile-menu-hover.svg" alt="close" class="modal-window__close-button-img modal-window__close-button-img_hover">
            </button>
        </div>
        <div class="modal-window__content-wrapper">
            <div class="modal-window__element text-block text-block_color_gray text-block_align_center"></div>
            <div class="modal-window__element modal-window__button-block">
                <button class="modal-window__button button-rounding button-rounding_big button-rounding_vlong button-rounding_hlight">{{ trans('Login') }}</button>
            </div>
        </div>
    </div>
</div>
@endif



@if(!Auth::guest() && (Auth::user()->deposit >= $settings->min_width || true))
<div id="remove-cash" class="modal-window modal-window_size_s modal-window_color_default" style="display: none; margin-top: -124.5px; margin-left: -260px;">
    <div class="modal-window__wrapper">
        <div class="modal-window__header-wrapper">
            <div class="modal-window__header">
                {!! trans('Withdraw <span>funds</span>') !!}
            </div>
            <button class="modal-window__close-button">
                <img src="/img/close-mobile-menu.svg" alt="close" class="modal-window__close-button-img modal-window__close-button-img_blur">
                <img src="/img/close-mobile-menu-hover.svg" alt="close" class="modal-window__close-button-img modal-window__close-button-img_hover">
            </button>
        </div>
        <div class="modal-window__content-wrapper">
            <div class="modal-window__element-header text-block text-block_tf_up text-block_align_center text-block_align_center">{{ trans('Choose a payment system') }}:</div>
            <div class="modal-window__element modal-window__pay-system-wrapper modal-window__element_with-header">
                <div class="modal-window__pay-system pay-system modal-window__pay-system_center">
                    <div class="modal-window__img-wrapper_main modal-window__img-wrapper modal-window__img-wrapper_big pay-system__img-wrapper is_payout" data-currency="1" data-provider="3">
                        <img width="103" src="/img/system/pay-icon_mc-visa_l.png" alt="{{ trans('Bank card') }}" class="pay-system__img">
                    </div>
                    <div class="modal-window__img-wrapper_main modal-window__img-wrapper modal-window__img-wrapper_big pay-system__img-wrapper is_payout" data-currency="11" data-provider="3">ADVCASH
                    </div>
                    <div class="modal-window__img-wrapper_main modal-window__img-wrapper modal-window__img-wrapper_big pay-system__img-wrapper is_payout" data-currency="5" data-provider="3">
                        <img src="/img/system/pay-icon_ym_l_big.png" alt="{{ trans('Yandex.Money') }}" class="pay-system__img">
                    </div>
                    <div class="modal-window__img-wrapper_main modal-window__img-wrapper modal-window__img-wrapper_big pay-system__img-wrapper is_payout" data-currency="4" data-provider="3">
                        <img src="/img/system/pay-icon_qiwi_l_big.png" alt="Qiwi" class="pay-system__img">
                    </div>
                    <div class="modal-window__img-wrapper_main modal-window__img-wrapper modal-window__img-wrapper_big pay-system__img-wrapper is_payout" data-currency="10" data-provider="2">
                        <img src="/img/system/pay-icon_payeer_l_big.png" alt="{{ trans('Payeer') }}" class="pay-system__img">
                    </div>
                </div>
                <input type="hidden" class="payment-currency">
                <input type="hidden" class="payment-provider">
            </div>
            <div class="modal-window__amount_purse hidden">
                <div class="modal-window__element-header modal-window__element-header_no-margin-bottom text-block text-block_tf_up text-block_align_center">{{ trans('Available for withdrawal') }}: <span class="yellow total_amount">0</span><span class="dollar yellow">$</span></div>
                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                        <div class="modal-window__element-header text-block text-block_tf_up text-block_align_center">{{ trans('Enter amount') }}:</div>
                        <div class="modal-window__element modal-window__input-block modal-window__element_with-header">
                            <div class="input-block modal-window__input-wrapper">
                                <input class="input-block__input payment-amount" title="{{ trans('Payout amount') }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                        <div class="enterWalletNumber modal-window__element-header text-block text-block_tf_up text-block_align_center purse_label">{{ trans('Enter wallet number') }}:</div>
                        <div class="hidden enterCardNumber modal-window__element-header text-block text-block_tf_up text-block_align_center purse_label">{{ trans('Enter card number') }}:</div>
                        <div class="modal-window__element modal-window__input-block modal-window__element_with-header">
                            <div class="input-block modal-window__input-wrapper">
                                <input class="input-block__input payment-purse">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-window__element modal-window__element_no-margin-top modal-window__button-block">
                    <button class="modal-window__button button-rounding button-rounding_big button-rounding_long button-rounding_trans-hlight" id="payment-out-submit">{{ trans('Withdraw') }}</button>
                </div>
            </div>
        </div>
    </div>
</div>
@else
<div id="remove-cash" class="modal-window modal-window_size_s modal-window_color_default">
    <div class="modal-window__wrapper">
        <div class="modal-window__header-wrapper">
            <div class="modal-window__header">
                {!! trans('Withdraw <span>funds</span>') !!}
            </div>
            <button class="modal-window__close-button">
                <img src="/img/close-mobile-menu.svg" alt="close" class="modal-window__close-button-img modal-window__close-button-img_blur">
                <img src="/img/close-mobile-menu-hover.svg" alt="close" class="modal-window__close-button-img modal-window__close-button-img_hover">
            </button>
        </div>
        <div class="modal-window__content-wrapper">
            <div class="modal-window__element text-block text-block_color_gray text-block_align_center">{{ trans('To activate the withdrawal of funds, you need to replenish the balance from') }} {{$settings->min_width}} {{ config('app.currency', '$') }}</div>
            <div class="modal-window__element modal-window__button-block">
                <button data-toggle="add-cash" class="modal-toggle modal-window__button button-rounding button-rounding_big button-rounding_vlong button-rounding_hlight">{{ trans('Top up balance') }}</button>
            </div>
        </div>
    </div>
</div>
@endif



<div id="alert-modal" class="modal-window modal-window_size_s">
    <div class="modal-window__wrapper">
        <div class="modal-window__header-wrapper">
            <div class="modal-window__header"></div>
            <button class="modal-window__close-button">
                <img src="/img/close-mobile-menu.svg" alt="close" class="modal-window__close-button-img modal-window__close-button-img_blur">
                <img src="/img/close-mobile-menu-hover.svg" alt="close" class="modal-window__close-button-img modal-window__close-button-img_hover">
            </button>
        </div>
        <div class="modal-window__content-wrapper">
            <div class="modal-window__element text-block text-block_color_gray text-block_align_center"></div>
            <div class="modal-window__element modal-window__button-block">
                <button class="modal-window__button button-rounding button-rounding_big button-rounding_vlong button-rounding_hlight">{{ trans('Login') }}</button>
            </div>
        </div>
    </div>
</div>
<div id="entering-modal" class="modal-window modal-window_size_s modal-window_color_info">
    <div class="modal-window__wrapper">
        <div class="modal-window__header-wrapper">
            <div class="modal-window__header">
                {{ trans('Login') }}
            </div>
            <button class="modal-window__close-button">
                <img src="/img/close-mobile-menu.svg" alt="close" class="modal-window__close-button-img modal-window__close-button-img_blur">
                <img src="/img/close-mobile-menu-hover.svg" alt="close" class="modal-window__close-button-img modal-window__close-button-img_hover">
            </button>
        </div>
        <div class="modal-window__content-wrapper">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="modal-window__element text-block text-block_fs_mb">
                        {{ trans('Login in progress, please wait ...') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@if(isset($show_tax) && $show_tax)
<div id="add-tax" class="modal-window modal-window_size_m modal-window_color_default">
    <div class="modal-window__wrapper">
        <div class="modal-window__header-wrapper">
            <div class="modal-window__header">
                {!! trans('Pay <span>tax</span>') !!}
            </div>
            <button class="modal-window__close-button">
                <img src="/img/close-mobile-menu.svg" alt="close" class="modal-window__close-button-img modal-window__close-button-img_blur">
                <img src="/img/close-mobile-menu-hover.svg" alt="close" class="modal-window__close-button-img modal-window__close-button-img_hover">
            </button>
        </div>
        <div class="modal-window__content-wrapper">
            <div class="modal-window__element-header text-block text-block_big text-block_align_center">{{ $tax_amount }}$</div>
            <input type="hidden" class="input-block__input payment-amount" title="{{ trans('Amount of payment') }}" value="{{ $tax_amount }}">
            <div class="modal-window__element-header text-block text-block_tf_up text-block_align_center">{{ trans('Choose a pay method') }}:</div>
            <div class="modal-window__element modal-window__pay-system-wrapper modal-window__element_with-header">
                <div class="modal-window__pay-system pay-system">
                    <div class="modal-window__img-wrapper_main modal-window__img-wrapper pay-system__img-wrapper" data-currency="1" data-provider="3">
                        <img src="/img/system/pay-icon_mc-visa_l.png" alt="{{ trans('Bank card') }}" class="pay-system__img">
                    </div>
                    <div class="modal-window__img-wrapper_main modal-window__img-wrapper pay-system__img-wrapper" data-currency="5" data-provider="3">
                        <img src="/img/system/pay-icon_ym_l.png" alt="{{ trans('Yandex.Money') }}" class="pay-system__img">
                    </div>
                    <div class="modal-window__img-wrapper_main modal-window__img-wrapper pay-system__img-wrapper" data-currency="4" data-provider="3">
                        <img src="/img/system/pay-icon_qiwi_l.png" alt="Qiwi" class="pay-system__img">
                    </div>
                    <div class="modal-window__img-wrapper_main modal-window__img-wrapper pay-system__img-wrapper" data-currency="10" data-provider="2">
                        <img src="/img/system/pay-icon_payeer_l.png" alt="{{ trans('Payeer') }}" class="pay-system__img">
                    </div>
                    <!-- <div class="modal-window__img-wrapper_additionally modal-window__img-wrapper pay-system__img-wrapper" data-currency="19" data-provider="3">
                        <img src="/img/system/pay-icon_mts_l.png" alt="{{ trans('MTS') }}" class="pay-system__img">
                    </div>
                    <div class="modal-window__img-wrapper_additionally modal-window__img-wrapper pay-system__img-wrapper" data-currency="18" data-provider="3">
                        <img src="/img/system/pay-icon_mf_l.png" alt="{{ trans('Megafon') }}" class="pay-system__img">
                    </div>
                    <div class="modal-window__img-wrapper_additionally modal-window__img-wrapper pay-system__img-wrapper" data-currency="21" data-provider="3">
                        <img src="/img/system/pay-icon_bee_l.png" alt="{{ trans('Beeline') }}" class="pay-system__img">
                    </div>
                    <div class="modal-window__img-wrapper_additionally modal-window__img-wrapper pay-system__img-wrapper" data-currency="20" data-provider="3">
                        <img src="/img/system/pay-icon_tele2_l.png" alt="{{ trans('TELE2') }}" class="pay-system__img">
                    </div> -->
                    <!-- <div class="pay-system__img-wrapper pay-system__more pay-system__more_show">
                        <div class="pay-system__more-button">{{ trans('More') }}</div>
                    </div>
                    <div class="pay-system__img-wrapper pay-system__more pay-system__more_hide">
                        <div class="pay-system__more-button">{{ trans('Hide') }}</div>
                    </div> -->
                </div>
                <input type="hidden" class="payment-currency">
                <input type="hidden" class="payment-provider">
            </div>
            <div class="modal-window__element modal-window__button-block">
                <button class="modal-window__button button-rounding button-rounding_big button-rounding_long button-rounding_hlight" id="payment-tax-submit">{{ trans('Pay') }}</button>
            </div>
        </div>
    </div>
</div>
@endif






@if(isset($show_swift) && $show_swift)
<div id="add-swift-90" class="modal-window modal-window_size_m modal-window_color_default">
    <div class="modal-window__wrapper">
        <div class="modal-window__header-wrapper">
            <div class="modal-window__header">
                {!! trans('Pay <span>swift</span>') !!}
            </div>
            <button class="modal-window__close-button">
                <img src="/img/close-mobile-menu.svg" alt="close" class="modal-window__close-button-img modal-window__close-button-img_blur">
                <img src="/img/close-mobile-menu-hover.svg" alt="close" class="modal-window__close-button-img modal-window__close-button-img_hover">
            </button>
        </div>
        <div class="modal-window__content-wrapper">
            <div class="modal-window__element-header text-block text-block_big text-block_align_center">90$</div>
            <input type="hidden" class="input-block__input payment-amount" value="90">
            <div class="modal-window__element-header text-block text-block_tf_up text-block_align_center">{{ trans('Choose a pay method') }}:</div>
            <div class="modal-window__element modal-window__pay-system-wrapper modal-window__element_with-header">
                <div class="modal-window__pay-system pay-system">
                    <div class="modal-window__img-wrapper_main modal-window__img-wrapper pay-system__img-wrapper" data-currency="1" data-provider="3">
                        <img src="/img/system/pay-icon_mc-visa_l.png" alt="{{ trans('Bank card') }}" class="pay-system__img">
                    </div>
                    <div class="modal-window__img-wrapper_main modal-window__img-wrapper pay-system__img-wrapper" data-currency="5" data-provider="3">
                        <img src="/img/system/pay-icon_ym_l.png" alt="{{ trans('Yandex.Money') }}" class="pay-system__img">
                    </div>
                    <div class="modal-window__img-wrapper_main modal-window__img-wrapper pay-system__img-wrapper" data-currency="4" data-provider="3">
                        <img src="/img/system/pay-icon_qiwi_l.png" alt="Qiwi" class="pay-system__img">
                    </div>
                    <div class="modal-window__img-wrapper_main modal-window__img-wrapper pay-system__img-wrapper" data-currency="10" data-provider="2">
                        <img src="/img/system/pay-icon_payeer_l.png" alt="{{ trans('Payeer') }}" class="pay-system__img">
                    </div>
                    <!-- <div class="modal-window__img-wrapper_additionally modal-window__img-wrapper pay-system__img-wrapper" data-currency="19" data-provider="3">
                        <img src="/img/system/pay-icon_mts_l.png" alt="{{ trans('MTS') }}" class="pay-system__img">
                    </div>
                    <div class="modal-window__img-wrapper_additionally modal-window__img-wrapper pay-system__img-wrapper" data-currency="18" data-provider="3">
                        <img src="/img/system/pay-icon_mf_l.png" alt="{{ trans('Megafon') }}" class="pay-system__img">
                    </div>
                    <div class="modal-window__img-wrapper_additionally modal-window__img-wrapper pay-system__img-wrapper" data-currency="21" data-provider="3">
                        <img src="/img/system/pay-icon_bee_l.png" alt="{{ trans('Beeline') }}" class="pay-system__img">
                    </div>
                    <div class="modal-window__img-wrapper_additionally modal-window__img-wrapper pay-system__img-wrapper" data-currency="20" data-provider="3">
                        <img src="/img/system/pay-icon_tele2_l.png" alt="{{ trans('TELE2') }}" class="pay-system__img">
                    </div> -->
                    <!-- <div class="pay-system__img-wrapper pay-system__more pay-system__more_show">
                        <div class="pay-system__more-button">{{ trans('More') }}</div>
                    </div>
                    <div class="pay-system__img-wrapper pay-system__more pay-system__more_hide">
                        <div class="pay-system__more-button">{{ trans('Hide') }}</div>
                    </div> -->
                </div>
                <input type="hidden" class="payment-currency">
                <input type="hidden" class="payment-provider">
            </div>
            <div class="modal-window__element modal-window__button-block">
                <button class="modal-window__button button-rounding button-rounding_big button-rounding_long button-rounding_hlight" id="payment-swift-90-submit">{{ trans('Pay') }}</button>
            </div>
        </div>
    </div>
</div>

<div id="add-swift-185" class="modal-window modal-window_size_m modal-window_color_default">
    <div class="modal-window__wrapper">
        <div class="modal-window__header-wrapper">
            <div class="modal-window__header">
                {!! trans('Pay <span>swift</span>') !!}
            </div>
            <button class="modal-window__close-button">
                <img src="/img/close-mobile-menu.svg" alt="close" class="modal-window__close-button-img modal-window__close-button-img_blur">
                <img src="/img/close-mobile-menu-hover.svg" alt="close" class="modal-window__close-button-img modal-window__close-button-img_hover">
            </button>
        </div>
        <div class="modal-window__content-wrapper">
            <div class="modal-window__element-header text-block  text-block_big text-block_align_center">185$</div>
            <input type="hidden" class="input-block__input payment-amount" value="185">
            <div class="modal-window__element-header text-block text-block_tf_up text-block_align_center">{{ trans('Choose a pay method') }}:</div>
            <div class="modal-window__element modal-window__pay-system-wrapper modal-window__element_with-header">
                <div class="modal-window__pay-system pay-system">
                    <div class="modal-window__img-wrapper_main modal-window__img-wrapper pay-system__img-wrapper" data-currency="1" data-provider="3">
                        <img src="/img/system/pay-icon_mc-visa_l.png" alt="{{ trans('Bank card') }}" class="pay-system__img">
                    </div>
                    <div class="modal-window__img-wrapper_main modal-window__img-wrapper pay-system__img-wrapper" data-currency="5" data-provider="3">
                        <img src="/img/system/pay-icon_ym_l.png" alt="{{ trans('Yandex.Money') }}" class="pay-system__img">
                    </div>
                    <div class="modal-window__img-wrapper_main modal-window__img-wrapper pay-system__img-wrapper" data-currency="4" data-provider="3">
                        <img src="/img/system/pay-icon_qiwi_l.png" alt="Qiwi" class="pay-system__img">
                    </div>
                    <div class="modal-window__img-wrapper_main modal-window__img-wrapper pay-system__img-wrapper" data-currency="10" data-provider="2">
                        <img src="/img/system/pay-icon_payeer_l.png" alt="{{ trans('Payeer') }}" class="pay-system__img">
                    </div>
                    <!-- <div class="modal-window__img-wrapper_additionally modal-window__img-wrapper pay-system__img-wrapper" data-currency="19" data-provider="3">
                        <img src="/img/system/pay-icon_mts_l.png" alt="{{ trans('MTS') }}" class="pay-system__img">
                    </div>
                    <div class="modal-window__img-wrapper_additionally modal-window__img-wrapper pay-system__img-wrapper" data-currency="18" data-provider="3">
                        <img src="/img/system/pay-icon_mf_l.png" alt="{{ trans('Megafon') }}" class="pay-system__img">
                    </div>
                    <div class="modal-window__img-wrapper_additionally modal-window__img-wrapper pay-system__img-wrapper" data-currency="21" data-provider="3">
                        <img src="/img/system/pay-icon_bee_l.png" alt="{{ trans('Beeline') }}" class="pay-system__img">
                    </div>
                    <div class="modal-window__img-wrapper_additionally modal-window__img-wrapper pay-system__img-wrapper" data-currency="20" data-provider="3">
                        <img src="/img/system/pay-icon_tele2_l.png" alt="{{ trans('TELE2') }}" class="pay-system__img">
                    </div> -->
                    <!-- <div class="pay-system__img-wrapper pay-system__more pay-system__more_show">
                        <div class="pay-system__more-button">{{ trans('More') }}</div>
                    </div>
                    <div class="pay-system__img-wrapper pay-system__more pay-system__more_hide">
                        <div class="pay-system__more-button">{{ trans('Hide') }}</div>
                    </div> -->
                </div>
                <input type="hidden" class="payment-currency">
                <input type="hidden" class="payment-provider">
            </div>
            <div class="modal-window__element modal-window__button-block">
                <button class="modal-window__button button-rounding button-rounding_big button-rounding_long button-rounding_hlight" id="payment-swift-185-submit">{{ trans('Fill up') }}</button>
            </div>
        </div>
    </div>
</div>
@endif


@if(!Auth::guest())
<div id="bonus-modal" class="modal-window modal-window_size_s">
    <div class="modal-window__wrapper">
        <div class="modal-window__header-wrapper">
            <div class="modal-window__header">{{ trans('HeaderBonusModal') }}</div>
            <button class="modal-window__close-button">
                <img src="/img/close-mobile-menu.svg" alt="close" class="modal-window__close-button-img modal-window__close-button-img_blur">
                <img src="/img/close-mobile-menu-hover.svg" alt="close" class="modal-window__close-button-img modal-window__close-button-img_hover">
            </button>
        </div>
        <div class="modal-window__content-wrapper">
            <div class="modal-window__element text-block text-block_color_gray text-block_align_center">

                {!! trans('ContentBonusModal') !!}

            </div>
            <div class="modal-window__element modal-window__button-block">
                <button class="modal-window__close-button modal-window__button button-rounding button-rounding_big button-rounding_vlong button-rounding_hlight" style="position:relative;top:auto;right:auto;left:auto;bottom:auto;">{{ trans('Close') }}</button>
            </div>
        </div>
    </div>
</div>
@endif