@extends('goldenmines.layout')

@section('title')
{{ __('Profile') }}
@stop

@section ('top')
nav-line__link_active
@stop

@section('banner')
<a href="/bonus" class=" bonus-banner bonus-banner_auth  ">
    <div class="hidden-xs bonus-banner__button">{{ __('Read') }}</div>
</a>
@stop
@section('content')
<div class="content">
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
                                    <button class="profile-row__button button-line__button button-rounding button-rounding_big button-rounding_small button-rounding_hlight modal-toggle" data-toggle="add-cash">{{ __('Top up balance') }}</button>
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
                                    {{ __('Opened cases') }}:&nbsp;<span>{{Auth::user()->opened}}</span><br>
                                    {{ __('For the amount') }}:&nbsp;<span>{{Auth::user()->profit}}<span class="dollar yellow">$</span></span>
                                    <img src="/img/system/egg-icon_64.png" alt="" class="profile-row__user-stat-img">
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                            <div class="profile-row__user-stat-block">
                                <div class="profile-row__user-stat-value profile-row__user-stat-value_alone">
                                    {{ __('Top place') }}:&nbsp;<span>{{$usr_pos}}</span>
                                    <img src="/img/system/position-icon_64.png" alt="" class="profile-row__user-stat-img">
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                            <div class="profile-row__user-stat-block">
                                <div class="profile-row__user-stat-value">
                                    {{ __('Invited') }}:&nbsp;<span>{{$my_refs}}</span><br>
                                    {{ __('Earned') }}:&nbsp;<span>{{$zarabotal}}<span class="dollar yellow">$</span></span>
                                    <img src="/img/system/users-icon_64.png" alt="" class="profile-row__user-stat-img">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="lk-tabs button-line">
                        <a href="/profile" class="lk-tabs__lk-tab button-line__button button-rounding button-rounding_med button-rounding_trans-dark">
                            {{ __('Game history') }}
                        </a>
                        {{-- <a href="/profile/partner" class="lk-tabs__lk-tab button-line__button button-rounding button-rounding_med button-rounding_trans-dark">
                            {{ __('Affiliate program') }}
                        </a> --}}
                        <a href="/profile/finance" class="lk-tabs__lk-tab button-line__button button-rounding button-rounding_med button-rounding_dark button-rounding_active">
                            {{ __('Finance') }}
                        </a>
                    </div>
                    <div id="finance" class="lk-block finance">
                        <div class="lk-block__header">
                            <div class="lk-block__header-line"></div>
                            <div class="lk-block__header-text">{!! __('Financial <span>operations</span>') !!}</div>
                            <div class="lk-block__header-line"></div>
                        </div>
                        <div class="nav-line finance__nav-line">
                            <div class="nav-line__element finance__nav-element">
                                <div data-toggleup="" data-toggledown=".finance__tr_cashout, .finance__tr_cashin, .finance__tr_bonus, .finance__tr_affiliate" class="nav-line__link finance__filter-button nav-line__link_active">
                                    {{ __('All operations') }}
                                </div>
                            </div>
                            <div class="nav-line__element finance__nav-element">
                                <div data-toggleup=".finance__tr_cashout, .finance__tr_affiliate" data-toggledown=".finance__tr_cashin, .finance__tr_bonus" class="nav-line__link finance__filter-button">
                                    {{ __('Recharge') }}
                                </div>
                            </div>
                            <div class="nav-line__element finance__nav-element">
                                <div data-toggleup=".finance__tr_cashin, .finance__tr_bonus, .finance__tr_affiliate" data-toggledown=".finance__tr_cashout" class="nav-line__link finance__filter-button">
                                    {{ __('Conclusions') }}
                                </div>
                            </div>
                            {{-- <div class="nav-line__element finance__nav-element">
                                <div data-toggleup=".finance__tr_cashout, .finance__tr_cashin, .finance__tr_bonus" data-toggledown=".finance__tr_affiliate" class="nav-line__link finance__filter-button">
                                    {{ __('Affiliate deductions') }}
                                </div>
                            </div> --}}
                        </div>
                        <div class="table-col">
                            <table class="finance__table main-table">
                                <thead>
                                    <tr>
                                        <th class="main-table__th main-table__th_center">№</th>
                                        <th class="main-table__th main-table__th_left">{{ __('Type of transaction') }}</th>
                                        <th class="main-table__th main-table__th_left">{{ __('Title') }}</th>
                                        <th class="main-table__th main-table__th_center">{{ __('Amount') }}</th>
                                        <th class="main-table__th main-table__th_center">{{ __('Status') }}</th>
                                        <th class="main-table__th main-table__th_center">{{ __('Date') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($operations as $key => $o)
                                    <tr class="main-table__tbody-tr finance__tr @if($o->type == 0) finance__tr_cashin @elseif($o->type == 1) finance__tr_cashout @elseif($o->type == 3) finance__tr_affiliate @elseif($o->type == 4) finance__tr_bonus @endif" style="">
                                        <td class="main-table__td main-table__td_reg main-table__th_center">{{$o->id}}</td>
                                        <td class="main-table__td main-table__td_reg main-table__td_left">
                                            <div class="finance__type">@if($o->type == 0) {{ __('Balance replenishment') }}@elseif($o->type == 1) {{ __('Withdraw fund') }} @elseif($o->type == 2) {{ __('Bonus') }} @elseif($o->type == 3) {{ __('Affiliate accrual') }} @elseif($o->type == 4) {{ __('Bonus accrual') }}@endif</div>
                                        </td>
                                        <td class="main-table__td main-table__td_reg main-table__td_left">@if($o->type == 0) {{ __('Balance replenishment through the payment system') }} @elseif($o->type == 1) {{ __('Withdraw funds to the wallet') }} {{ $o->koshelek }} @elseif($o->type == 3) {{ __('Refill your account with a referral') }} @elseif($o->type == 4) {{ __('Bonus accrual for registration') }} @endif</td>
                                        <td class="main-table__td main-table__td_reg main-table__td_center">{{$o->amount}}<span class="dollar dollar_white">$</span></td>
                                        <td class="main-table__td main-table__td_reg main-table__td_center">
                                            <div class="finance__status finance__status_expects">@if($o->status == 0) {{ __('Wating') }} @elseif($o->status == 1) {{ __('Completed') }} @elseif($o->status == 3) {{ __('Rejected') }} @endif</div>
                                        </td>
                                        <td class="main-table__td main-table__td_reg main-table__td_center">{{$o->timestamp}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="button-line button-line_center hidden">
                                <button class="button-line__button button-rounding button-rounding_trans-big button-rounding_trans-hlight" id="profile_finance_more" data-last-transaction="">
                                    {{ __('More') }}
                                </button>
                            </div>
                            <div class="button-line button-line_center hidden">
                                <p>{{ __('You have no financial transactions yet.') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop