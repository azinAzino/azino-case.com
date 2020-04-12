@extends('goldenmines.layout')

@section('title')
Рейтинг пользователей - Топ 100
@stop

@section('top')
nav-line__link_active
@stop

@section('content')
<div class="content">
            <div class="container">
        <div class="button-line">
            <a href="#" onclick="return history.back()" class="button-line__button button-rounding button-rounding_trans-big button-rounding_trans-hlight">
                Назад
                <div class="button-line__button-icon"></div>
            </a>
        </div>
    </div>
    <div class="top-block top-block_nobg top-block_nopadtop">
        <div class="container">
            <div class="top-block__header">
                <div class="top-block__header-line"></div>
                <div class="top-block__header-text">Топ<span>100</span> пользователей</div>
                <div class="top-block__header-line"></div>
            </div>
            <div class="row">
                <div class="col xs-12 col-sm-6 col-md-6 col-lg-6">
					@foreach($top10 as $key => $user)
					<div class="@if($key == 0) top-line__card top-line__card_gold @elseif($key == 1) top-line__card top-line__card_red @elseif($key == 2) top-line__card top-line__card_blue @else top-line__card top-line__card_default @endif">
						<a href="/user/{{$user->id}}">
							<div class="top-line__position">{{$key+1}}</div>
							<div class="top-line__user-ava">
								<div class="circle-ava">
									<img src="{{$user->avatar}}" alt="{{$user->username}}" class="circle-ava__img"/>
								</div>
							</div>
							<div class="top-line__user-name">{{$user->username}}</div>
							<div class="top-line__user-stat-block">
								<div class="top-line__user-stat">
									<div class="top-line__user-stat-icon"><img src="/img/system/egg-icon_gold.png" alt="" class="top-line__user-stat-icon-img"/></div>
									<div class="top-line__user-stat-value">{{$user->opened}}</div>
								</div>
								<div class="top-line__user-stat">
									<div class="top-line__user-stat-icon"><img src="/img/system/money__icon_yellow.png" alt="" class="top-line__user-stat-icon-img"/></div>
									<div class="top-line__user-stat-value">{{$user->profit}}<span class="dollar yellow">$</span></div>
								</div>
							</div>
						</a>
					</div>   
					@endforeach
					</div>
                <div class="table-col col-xs-12 col-sm-6 col-md-6 col-lg-6">
                    <table class="main-table">
                        <thead>
                        <tr>
                            <th class="main-table__th main-table__th_left">№</th>
                            <th class="main-table__th main-table__th_left">Игрок</th>
                            <th class="main-table__th main-table__th_center"><img src="/img/system/egg-icon_gold.png" alt="" class="main-table__icon-img"></th>
                            <th class="main-table__th main-table__th_center"><img src="/img/system/money__icon_yellow.png" alt="" class="main-table__icon-img"></th>
                        </tr>
                        </thead>
                        <tbody>
							@foreach($top90 as $key => $u)
							<tr class="main-table__tbody-tr">                                                                                                                                                                                                                                                                                                                                               <tr class="main-table__tbody-tr">
                                <td class="main-table__td main-table__td_left">{{$key+1}}</td>
                                <td class="main-table__td main-table__td_left">
                                    <a href="/user/{{$u->id}}">
                                        <div class="main-table__ava-wrapper">
                                            <img src="{{$u->avatar}}" alt="" class="main-table__ava-img">
                                        </div>
                                        {{$u->username}}
                                    </a>
                                </td>
                                <td class="main-table__td main-table__td_center"><span>{{$u->opened}}</span></td>
                                <td class="main-table__td main-table__td_center"><span>{{$u->profit}}<span class="dollar yellow">$</span></span></td>
                            </tr>
							@endforeach                                         
						</tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('foo_top')
footer__nav-link_active
@stop

@section('header_top')
header-menu__link_active
@stop