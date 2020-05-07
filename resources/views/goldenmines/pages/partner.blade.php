@extends('goldenmines.layout')

@section('title')
{{ __('Your profile') }}
@stop

@section ('top')
nav-line__link_active
@stop


@section('content')

<div class="container">
    <?php $settings = \DB::table('settings')->where('id', SITE_ID)->first();
    $my_refs = \DB::table('users')->where('ref_user', Auth::user()->id)->count();
    $zarabotal = \DB::table('operations')->where('ref_user', Auth::user()->id)->where('type', 0)->where('status', 1)->sum('amount');
    if ($zarabotal == '') {
        $zarabotal = 0;
    }
    ?>
    <div class="profile-row">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-3 col-md-offset-0 col-lg-3 col-lg-offset-0">
                    <div class="profile-row__user-info-wrapper">
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-md-12 col-lg-12">
                                <div class="profile-row__user-avatar">
                                    <div class="profile-row__user-avatar-wrapper">
                                        <img src="{{Auth::user()->avatar}}" alt="{{Auth::user()->userame}}" class="profile-row__user-avatar-img">
                                    </div>
                                </div>
                                <div class="profile-row__user-name">{{Auth::user()->username}}</div>
                                <div class="profile-row__balance">
                                    <img src="/img/system/money__icon_yellow.png" alt="" class="profile-row__balance-img">
                                    {{Auth::user()->money}}<span class="dollar yellow">$</span>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-12 col-lg-12">
                                <div class="profile-row__button-line button-line">
                                    <button class="profile-row__button button-line__button button-rounding button-rounding_big button-rounding_small button-rounding_hlight modal-toggle" data-toggle="add-cash">{{ __('Refill balance') }}</button>
                                    <button class="profile-row__button button-line__button button-rounding button-rounding_big button-rounding_small button-rounding_trans-hlight modal-toggle" data-toggle="remove-cash">{{ __('Withdraw funds') }}</button>
                                    <a href="/logout" onclick="return confirm(window.__('Are you sure you want to sign out?'))" class="profile-row__button button-line__button button-rounding button-rounding_big button-rounding_small button-rounding_trans-dark">{{ __('Logout') }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
                    @if (isset($show_swift) && $show_swift) @include('goldenmines.finance.swift') @endif
                    @if (isset($show_tax) && $show_tax) @include('goldenmines.finance.tax') @endif
                    <div class="row">
                        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                            <div class="profile-row__user-stat-block">
                                <div class="profile-row__user-stat-value">
                                {{ __('Opened cases:') }} <span>{{Auth::user()->opened}}</span><br>
                                {{ __('For the amount of') }} <span>{{Auth::user()->profit}}<span class="dollar yellow">$</span></span>
                                    <img src="/img/system/egg-icon_64.png" alt="" class="profile-row__user-stat-img">
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                            <div class="profile-row__user-stat-block">
                                <div class="profile-row__user-stat-value profile-row__user-stat-value_alone">
                                {{ __('Top position:') }} <span>{{$usr_pos}}</span>
                                    <img src="/img/system/position-icon_64.png" alt="" class="profile-row__user-stat-img">
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                            <div class="profile-row__user-stat-block">
                                <div class="profile-row__user-stat-value">
                                {{ __('Invited:') }}  <span>{{$my_refs}}</span><br>
                                {{ __('Earned:') }} <span>{{$zarabotal*($settings->ref_percent/100)}}<span class="dollar yellow">$</span></span>
                                    <img src="/img/system/users-icon_64.png" alt="" class="profile-row__user-stat-img">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="lk-tabs button-line">
                        <a href="/profile" class="lk-tabs__lk-tab button-line__button button-rounding button-rounding_med button-rounding_trans-dark">
                        {{ __('Game history') }}
                        </a>
                        <a href="/profile/partner" class="lk-tabs__lk-tab button-line__button button-rounding button-rounding_med button-rounding_dark button-rounding_active">
                        {{ __('Affiliate program') }} 
                        </a>
                        <a href="/profile/finance" class="lk-tabs__lk-tab button-line__button button-rounding button-rounding_med button-rounding_trans-dark">
                        {{ __('Finance') }} 
                        </a>
                    </div>
                    <div class="lk-block">
                        <div class="lk-block__header">
                            <div class="lk-block__header-line"></div>
                            <div class="lk-block__header-text">{!! __('Affiliate <span> program </span>') !!}</div>
                            <div class="lk-block__header-line"></div>
                        </div>
                        <div class="profile-row__user-affiliate-line">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <div class="profile-row__user-affiliate-block">
                                        <div class="profile-row__user-affiliate-header text-block text-block_fs_m text-block_tf_up text-block_fw_bold">
                                        {!! __('Invite your friends and <span> earn') !!} {{$settings-> ref_percent}}% {!! __('</span> from all replenishment!') !!}
                                        </div>
                                        <div class="profile-row__user-affiliate-header-text text-block">{{ __('Send your unique link to friends and get') }} {{$settings->ref_percent}}% {{ __('from each balance top-up by a friend! For example: if your friend tops up his balance by $100 - we will charge') }} ${{100*($settings->ref_percent/100)}} {{ __('to your account!') }}</div>
                                        <div class="profile-row__user-affiliate-input input-block">
                                            @if(!!Auth::user()->ref_link)
                                            <input value="{{Auth::user()->ref_link}}" readonly="readonly" class="input-block__input input-block__input_size_full">
                                            @else
                                            <a href="/profile/partner/get-link" style="margin-top: 10px" id="get-partner-link" class="button-rounding button-rounding_big button-rounding_long button-rounding_hlight">{{ __('Get affiliate link') }}</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="faq-block">
                            <div class="faq-block__block">
                                <div class="faq-block__header text-block">{{ __('Questions and answers:') }}</div>
                                <div class="faq-block__question text-block text-block_fs_m text-block_fw_bold text-block_color_yellow">
                                {{ __('What do my friends get when registering via my link?') }}
                                </div>
                                <div class="faq-block__answer text-block">{{ __('Everyone who signs up for your link will receive 1000 bonus rubles!') }}</div>
                            </div>
                            <div class="faq-block__block">
                                <div class="faq-block__question text-block text-block_fs_m text-block_fw_bold text-block_color_yellow">
                                {{ __('Where can I distribute an affiliate link?') }}
                                </div>
                                <div class="faq-block__answer text-block">{{ __('You can send it in a personal message to your friends or put it in the video description on Youtube about our site. We do not limit the distribution of affiliate links, except in cases of SPAM. In case of detection of spam mailings with affiliate link we can block your account.') }}</div>
                            </div>
                            <div class="faq-block__block">
                                <div class="faq-block__question text-block text-block_fs_m text-block_fw_bold text-block_color_yellow">
                                {{ __('How are affiliate rewards paid?') }}
                                </div>
                                <div class="faq-block__answer text-block">{{ __('All affiliate deductions are credited to your balance. You can withdraw earned money at any time.') }}</div>
                            </div>
                        </div>
                        <div class="lk-block__subheader">{{ __('Attracted Players:') }}</div>
                        <div class="partner-list">
                            <div class="row">
                                <div class="table-col col-xs-12">
                                    <table class="partner-list__table main-table">
                                        <thead>
                                            <tr>
                                                <th class="main-table__th main-table__th_left">{{ __('Gamer') }}</th>
                                                <th class="main-table__th main-table__th_center">{{ __('Replenishment') }}</th>
                                                <th class="main-table__th main-table__th_center">{{ __('Deduction') }}</th>
                                                <th class="main-table__th main-table__th_center">{{ __('Date') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($referals as $r)
                                            <tr>
                                                <th class="main-table__th main-table__th_left">{{$r->username}}</th>
                                                <th class="main-table__th main-table__th_center">{{$r->deposit}}</th>
                                                <th class="main-table__th main-table__th_center">{{$settings->ref_percent}}%</th>
                                                <th class="main-table__th main-table__th_center">{{$r->updated_at}}</th>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div class="button-line button-line_center hidden">
                                        <button class="button-line__button button-rounding button-rounding_trans-big button-rounding_trans-hlight" id="profile_referrals_more" data-last-user="0">
                                        {{ __('Show more') }}
                                        </button>
                                    </div>
                                    <div class="button-line button-line_center @if(count($referals) > 0) hidden @endif">
                                        <p>{{ __('You have no players involved yet.') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop