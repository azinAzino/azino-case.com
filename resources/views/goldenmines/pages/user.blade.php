@extends('goldenmines.layout')

@section('title')
{{ ('Profile of user') }} - {{ $user->username }}
@stop

@section('content')
<div class="content">
<?php  $settings = \DB::table('settings')->where('id', SITE_ID)->first(); 
		$my_refs = \DB::table('users')->where('ref_user',$user->id)->count();
		$zarabotal = \DB::table('operations')->where('ref_user',$user->id)->where('type', 0)->where('status', 1)->sum('amount');
		if($zarabotal == '')
		{
			$zarabotal = 0;
		}
		?>
            <div class="container">
        <div class="button-line">
            <a href="#" onclick="return history.back()" class="button-line__button button-rounding button-rounding_trans-big button-rounding_trans-hlight">
            {{ ('Back') }}
                <div class="button-line__button-icon"></div>
            </a>
        </div>
    </div>
    <div class="profile-row">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-3 col-md-offset-0 col-lg-3 col-lg-offset-0">
                    <div class="profile-row__user-info-wrapper">
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-sm-offset-3 col-md-12 col-md-offset-0 col-lg-12 col-lg-offset-0">
                                <div class="profile-row__user-avatar">
                                    <div class="profile-row__user-avatar-wrapper"><img src="{{$user->avatar}}" alt="{{$user->username}}" class="profile-row__user-avatar-img"></div>
                                </div>
                                <div class="profile-row__user-name">{{$user->username}}</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
                    <div class="row">
                        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                            <div class="profile-row__user-stat-block">
                                <div class="profile-row__user-stat-value">
                                {{ __('Opened cases') }}&nbsp;<span>{{$user->opened}}</span><br>
                                {{ __('For the amount') }}:&nbsp;<span>{{$user->profit}}<span class="dollar yellow">$</span></span>
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
                    <div class="lk-block">
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
                                <button class="button-line__button button-rounding button-rounding_trans-big button-rounding_trans-hlight" id="profile_games_more" data-user-id="{{$user->id}}" data-last-game="{{$last_g}} ">
									{{ __('Show more')}}
                                </button>
                            </div>
                            <div class="button-line button-line_center hidden">
								<p>{{ __('User has not played any balance games yet.') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@stop