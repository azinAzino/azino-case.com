@extends ('azinocase.layout')
@section ('title')
{{ __('Cases with money') }}
@stop


@section ('index')
nav-line__link_active
@stop
@section ('content')
<div class="content">
    <div class="cases-line">
        <div class="container">
            <div class="row eggs-cases-row">
                @foreach ($cases as $c)
                <div class="new-card-col col-xs-12 col-sm-4 col-md-3 col-lg-3" id="list-box - {{$c->id}}">
                    <a href="/cart/{{$c->id}} " onclick="/*$('.sound_heart')[0].play();*/">
                        <div class="new-card">
                            <img class="new-card__bg-img" src="{{$c->image}}" alt="" />
                            <div class="new-card__header">
                                <div class="new-card__price">
                                    {{$c->cost}} <span class="dollar yellow"> $</span>
                                </div>
                            </div>
                            <div class="new-card__footer">
                                <div class="new-card__name"> {{__ ($c->name) }} </div>
                                <div class="new-card__content">
                                    {{ __('Win from') }}
                                    <span>
                                        {{$c->min}} <span class="dollar yellow"> $</span>
                                    </span>
                                    {{ __('to') }}
                                    <span>
                                        {{$c->max}} <span class="dollar yellow"> $</span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="top-line hidden-xs">
        <div class="container">
            <div class="top-line__header">
                <div class="top-line__header-line"></div>
                <div class="top-line__header-text">{!! __('Top<span>10</span>') !!}</div>
                <div class="top-line__header-line"></div>
            </div>
            <div class="row">
                @foreach ($top_users as $key => $user)
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                    <div class="@if($key == 0) top-line__card top-line__card_gold @elseif($key == 1) top-line__card top-line__card_red @elseif($key == 2) top-line__card top-line__card_blue @else top-line__card top-line__card_default @endif">
                        <a href="/user/{{$user->id}}">
                            <div class="top-line__position">{{$key + 1}}</div>
                            <div class="top-line__user-ava">
                                <div class="circle-ava">
                                    <img src="{{$user->avatar}}" alt="{{$user->username}}" class="circle-ava__img" />
                                </div>
                            </div>
                            <div class="top-line__user-name">{{$user->username}}</div>
                            <div class="top-line__user-stat-block">
                                <div class="top-line__user-stat">
                                    <div class="top-line__user-stat-icon"> <img src="/img/system/egg-icon_gold.png" alt="" class="top-line__user-stat-icon-img">
                                    </div>
                                    <div class="top-line__user-stat-value">{{$user->opened}}</div>
                                </div>
                                <div class="top-line__user-stat">
                                    <div class="top-line__user-stat-icon"> <img src="/img/system/money__icon_yellow.png" alt="" class="top-line__user-stat-icon-img"> </div>
                                    <div class="top-line__user-stat-value"> {{$user->profit}} <span class="dollar yellow"></span>$<span></div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="advantages-block">
        <div class="container">
            <div class="advantages-block__header">
                <div class="advantages-block__header-line"></div>
                <div class="advantages-block__header-text">{!! __('Our <span> advantages </span>') !!}</div>
                <div class="advantages-block__header-line"></div>
            </div>
            <div class="advantages-block__advantages-wrapper">
                <div class="advantages-block__icon-wrapper hidden-xs">
                    <div class="advantages-block__icon-glow"></div>
                    <div class="advantages-block__icon-block"><img src="/img/system/rocket.png" alt="" class="advantages-block__icon" /></div>
                </div>
                <div class="advantages">
                    <div class="advantages__header">{{ __('Quick payouts') }}</div>
                    <div class="advantages__text">{{ __('The minimum payout time is only 1 minute! All payments are automatic. You no longer need to wait 24 hours for your winnings! The minimum amount for withdrawal is only 100 rubles! All payments are made without additional fees! ') }}</div>
                </div> 
            </div>
            <div class="advantages-block__advantages-wrapper">
                <div class="advantages-block__icon-wrapper hidden-xs">
                    <div class="advantages-block__icon-glow"></div>
                    <div class="advantages-block__icon-block"><img src="/img/system/wifi.png" alt="" class="advantages-block__icon"></div>
                </div>
                <div class="advantages">
                    <div class="advantages__header"> {{ __('Security') }}</div>
                    <div class="advantages__text">{{ __('All data is secure and transmitted over SSL encrypted protocol, making your account completely safe.') }}</div>
                </div>
            </div>
            <div class="advantages-block__advantages-wrapper">
                <div class="advantages-block__icon-wrapper hidden-xs">
                    <div class="advantages-block__icon-glow"></div>
                    <div class="advantages-block__icon-block"><img src="/img/system/happy-man.png" alt="" class="advantages-block__icon"></div>
                </div>
                <div class="advantages">
                    <div class="advantages__header">{{ __('Openness and Security') }}</div>
                    <div class="advantages__text">{{ __('All games are displayed in a live stream. Player profiles are open along with the history of all games! In order to prevent fraud, we do not publish confidential user information!') }}</div>
                </div>    
            </div>
        </div>
    </div>
</div>
@stop
@section ('modal')
@if (Auth::guest () && isset ($utm_name) && isset ($utm_avatar))
<!-- Welcome modal -->
<div id="hi-modal" class="modal-window modal-window_size_s modal-window_color_default" style="display: none; margin-top: -154.5px; margin-left: -260px;">
        <div class="modal-window__wrapper">
                <div class="modal-window__header-wrapper">
                        <div class="modal-window__header">
                                {{ __('Hello!') }}
                            </div>
                        <button class="modal-window__close-button">
                                <img src="/img/close-mobile-menu.svg" alt="close" class="modal-window__close-button-img modal-window__close-button-img_blur">
                                <img src="/img/close-mobile-menu-hover.svg" alt="close" class="modal-window__close-button-img modal-window__close-button-img_hover">
                            </button>
                    </div>
                <div class="modal-window__content-wrapper">
                        <div class="row">
                                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                                        <div class="modal-window__user-ava modal-window__element circle-ava">
                        <img src="{{$utm_avatar}}" alt="" class="circle-ava__img">
                    </div>
                                    </div>
                                <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                                        <div class="modal-window__element text-block text-block_fs_mb">{{ __('Cash bonus from') }} {{$utm_name}} </div>
                                        <div class="modal-window__element text-block text-block_color_gray"> {{ __('To get a bonus go through a simple registration!') }} </div>
                                        <div class="modal-window__element">
                        <button data-toggle="login" data-title="Register <span> on the site </span>" class="modal-toggle modal-window__button button-rounding button-rounding_big button-rounding_light"> {{ __('Sign up') }} </button>
                                            </div>
                                    </div>
                            </div>
                    </div>
            </div>
</div>
@endif
@stop

@section ('foo_index')
footer__nav-link_active
@stop

@section ('header_index')
header-menu__link_active
@stop