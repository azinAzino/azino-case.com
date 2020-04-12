@extends('goldenmines.layout')

@section('bonus')
bonus-page
@stop


@section('content')
<div class="content">
	<div class="bonus">
        <div class="container">
            <div class="bonus__content">
                <div class="bonus__info-wrapper">
					<div class="bonus__info-header">{{ trans('Your bonus has been activated!') }}</div>
                            <div class="bonus__button-line"></div>
                                        <div class="bonus__info-text">{{ trans('You can open any case on them, as when playing for real money. But there are two differences') }}:</div>
                    <div class="bonus__info-litext">
                        <img src="/img/oval-4.svg" class="bonus__info-litext-icon" alt="oval-4" title="oval-4">
                        {{ trans('Bonus money cannot be withdrawn') }}
                    </div>
                    <div class="bonus__info-litext">
                        <img src="/img/oval-4.svg" class="bonus__info-litext-icon" alt="oval-4" title="oval-4">
                        {{ trans('It burn out when replenishing the balance') }}
                    </div>
                </div>
                <div class="bonus__img-wrapper">
                    <img src="/img/faya.gif" class="bonus__img" alt="faya" title="faya">
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.bonus-page {
    background: #050202;
}
.live-win{
	display: none;
}
</style>
@stop