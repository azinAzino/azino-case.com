@extends('goldenmines.layout')

@section ('name')
{{ __('Help') }}
@Stop

@section('title')
{{ __('Help') }}
@stop

@section ('help')
nav-line__link_active
@Stop



@section ('content')
<div class="content">
	<div class="HelpLg">
		<div class="HelpLg__wrapper container">
			<div class="HelpLg__header">{{ __('Help') }}</div>
			<div class="HelpLg__button-row row">
				<div class="Help__button-col col-md-4 col-sm-6 col-xs-12">
					<a href="mailto:info@golden-mies.club" target="_blank">
						<div class="HelpButton">
							<div class="HelpButton__img-wrapper"> <img class="HelpButton__img" src="/img/system/1.png" alt="info@golden-mies.club"> </div>
							<div class="HelpButton__text">
								<div class="HelpButton__title"> {{ __('For any questions') }} </div>
								<div class="HelpButton__link-wrapper"> <span class="HelpButton__link"> info@golden-mies.club </span>
								</div>
							</div>
						</div>
					</a>
				</div>
				<div class="Help__button-col col-md-4 col-sm-6 col-xs-12">
					@if(Auth::guest())
					<a href="#" class="modal-toggle" data-toggle="login" data-title="{{ trans('Log in') }} &lt;span&gt;{{ trans('to the site') }}&lt;/span&gt;">
						<div class="HelpButton">
							<div class="HelpButton__img-wrapper"> <img class="HelpButton__img" src="/img/system/2.png" alt="info@golden-mies.club"> </div>
							<div class="HelpButton__text">
								<div class="HelpButton__title"> {{ __('Tech Support') }} </div>
								<div class="HelpButton__link-wrapper"> <span class="HelpButton__link"> {{ __('Write') }} </span>
								</div>
							</div>
						</div>
					</a>
					@else
					<a href="/tickets">
						<div class="HelpButton">
							<div class="HelpButton__img-wrapper"> <img class="HelpButton__img" src="/img/system/2.png" alt="info@golden-mies.club"> </div>
							<div class="HelpButton__text">
								<div class="HelpButton__title"> {{ __('Tech Support') }} </div>
								<div class="HelpButton__link-wrapper"> <span class="HelpButton__link"> {{ __('Write') }} </span>
								</div>
							</div>
						</div>
					</a>
					@endif
				</div>
				<div class="Help__button-col col-md-4 col-sm-6 col-xs-12">
					<a href="mailto:reklama@golden-mies.club" target="_blank">
						<div class="HelpButton">
							<div class="HelpButton__img-wrapper"> <img class="HelpButton__img" src="/img/system/3.png" alt=" reklama@golden-mies.club"> </div>
							<div class="HelpButton__text">
								<div class="HelpButton__title"> {{ __('Advertising Suggestions') }} </div>
								<div class="HelpButton__link-wrapper"> <span class="HelpButton__link">  reklama@golden-mies.club </span>
								</div>
							</div>
						</div>
					</a>
				</div>
			</div>
		</div>
	</div>
</div>
@Stop

@section ('foo_help')
footer__nav-link_active
@Stop

@section ('header_help')
Title-menu__link_active
@Stop