@extends('goldenmines.layout')

@section('title')
{{ __('Users reviews') }}
@stop

@section('opinions')
nav-line__link_active
@stop



@section('content')
<div class="content">
	<?php
	$settings = \DB::table('settings')->where('id', SITE_ID)->first();
	?>
	<div class="container">
		<div class="button-line"><a href="/" class="button-line__button button-rounding button-rounding_trans-big button-rounding_trans-hlight">{{ __('Back') }}
				<div class="button-line__button-icon"></div>
			</a>
			<a class="button-line__button button-line__button_right button-rounding button-rounding_trans-big button-rounding_trans-light" href="{{$settings->vk_group}}" target="_blank">{{ __('Write a review') }}</a>
		</div>
	</div>
	<div class="reviews-block">
		<div class="container">
			<div class="row">
				<div class="reviews-block__header-line top-block__header">
					<div class="top-block__header-line"></div>
					<div class="top-block__header-text">{!! __('<span>Users</span> reviews') !!}</div>
					<div class="top-block__header-line"></div>
				</div>
				@foreach($reviews as $r)
				<div class="reviews-block__reviews-card-wrapper">
					<div class="reviews-block__reviews-card">
						<div class="reviews-block__header-wrapper">
							<div class="reviews-block__header"><a href="{{$r->user_link}}" target="_blank">
									<div class="reviews-block__ava-wrapper"><img src="{{$r->user_avatar}}" alt="" class="reviews-block__ava-img"></div>{{$r->username}}
								</a>
								<div class="reviews-block__header-border"></div>
							</div>
							<div class="reviews-block__reviews-date text-block text-block_color_gray">{{$r->created_at}}</div>
						</div>
						<div class="reviews-block__reviews-text text-block">{{$r->text}}</div>
						<div class="reviews-block__reviews-file">
							<div class="reviews-block__reviews-file-header text-block text-block_color_gray">
								@if(isset($r->photo) && $r->photo != '')
								<img src="/img/system/clip-icon.png" alt="" class="reviews-block__reviews-file-icon">{{ __('Attached') }}:
								@endif
								<div class="reviews-block__reviews-link text-block"><a href="{{$r->opinion_link}}" target="_blank" class="text-block__link">{{ __('Original review') }}</a></div>
							</div>
							@if(isset($r->photo) && $r->photo != ''))
							<img src="{{$r->photo}}" alt="" class="reviews-block__reviews-file-img">
							@endif
						</div>
					</div>
				</div>
				@endforeach
			</div>
		</div>
	</div>
</div>
@stop

@section('foo_opinions')
footer__nav-link_active
@stop


@section('header_opinions')
header-menu__link_active
@stop