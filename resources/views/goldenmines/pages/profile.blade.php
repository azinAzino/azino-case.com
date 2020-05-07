@extends('goldenmines.layout')

@section('title')
{{ __('Profile') }}
@stop

@section ('top')
nav-line__link_active
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
						<a href="/profile" class="lk-tabs__lk-tab button-line__button button-rounding button-rounding_med button-rounding_trans-dark button-rounding_active">
							{{ __('Game history') }}
						</a>
						{{-- <a href="/profile/partner" class="lk-tabs__lk-tab button-line__button button-rounding button-rounding_med button-rounding_trans-dark">
							{{ __('Affiliate program') }}
						</a> --}}
						<a href="/profile/finance" class="lk-tabs__lk-tab button-line__button button-rounding button-rounding_med button-rounding_dark">
							{{ __('Finance') }}
						</a>
					</div>
					<div id="game-history" class="lk-block game-history">
						<div class="lk-block__header">
							<div class="lk-block__header-line"></div>
							<div class="lk-block__header-text">{!! __('Game <span>history</span>') !!}</div>
							<div class="lk-block__header-line"></div>
						</div>
						<div class="game__contains">
							<div class="row">
								@if(isset($history) && !empty($history))
								@foreach($history as $h)
								@if(isset($h->image))
								<div class="col-xs-6 col-sm-3 col-md-3 col-lg-3">
									<div class="game__contains-cell game__contains-cell_none">

										<div class="game__contains-img-wrapper game__contains-img-wrapper_with-header">
											<div class="game__contains-header">{{ __($h->name) }}</div>
											<div class="game__contains-egg-glow"></div><img src="{{$h->image}}" alt="" class="game__contains-egg-img">
										</div>

									</div>
								</div>
								@endif
								@endforeach
								@endif
							</div>
							<div class="button-line button-line_center @if(count($history) != 24) hidden @endif">
								<button class="button-line__button button-rounding button-rounding_trans-big button-rounding_trans-hlight" id="profile_games_more" data-user-id="{{Auth::user()->id}}" data-last-game="{{$last_g}} ">
									{{ __('Show more')}}
								</button>
							</div>
							<div class="button-line button-line_center @if(isset($history) && count($history) != 0) hidden @endif">
								<p>{{ __('You have not played any balance games yet.') }}</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@stop