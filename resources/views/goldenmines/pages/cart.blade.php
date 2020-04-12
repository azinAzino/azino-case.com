@extends('goldenmines.layout')

@section('title')
{{ trans($card->name) }}
@stop



@section('content')
<div class="content">
    <div class="container">
        <div class="game" data-price="{{$card->cost}}">
            <div class="game__header">
                <div class="game__header-line"></div>
                <div class="game__header-text">{{ trans($card->name) }}</div>
                <div class="game__header-line"></div>
            </div>
            <div class="game__game-field">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 col-lg-offset-2">
                        <div class="game__row game__row_none row">
                            <div class="game__info-layout game__info-layout_start">
                                <div class="game__button-wrapper">
                                    <button class="game__win-button button-rounding button-rounding_trans-big button-rounding_hlight game__win-button_start">{{ trans('Start the game for') }} {{$card->cost}}<span class="dollar yellow">$</span></button>
                                </div>
                            </div>
                            <div class="game__info-layout game__info-layout_restart">
                                <div class="game__button-wrapper">
                                    <button class="game__win-button button-rounding button-rounding_trans-big button-rounding_hlight game__win-button_restart">{{ trans('Play again for') }} {{$card->cost}}<span class="dollar yellow">$</span></button>
                                </div>
                            </div>
                            <div class="game__win-layout">
                                <div class="game__game-cell_win-cell game__game-cell_win-cell-start game__game-cell" data-class="game__game-cell_win-cell-start">
                                    <div class="game__img-wrapper">
                                        <div class="game__egg-glow game__egg-glow_main"></div>
                                        <img src="/img/system/egg200/egg1.png" alt="" class="game__egg-img game__egg-img_win" />
                                    </div>
                                    <div class="game__button-wrapper">
                                        <button class="game__win-button button-rounding button-rounding_trans-big button-rounding_hlight game__win-button_continue">{{ trans('Continue') }}</button>
                                        <button class="game__win-button button-rounding button-rounding_trans-big button-rounding_light game__win-button_play_balance">{{ trans('Play for balance') }}</button>
                                        <button class="game__win-button button-rounding button-rounding_trans-big button-rounding_trans-light game__win-button_show_all">{{ trans('Start over') }}</button>
                                    </div>
                                </div>
                            </div>
                            @for($i = 0; $i < 12; $i++) <div class="game__col col-xs-4 col-sm-4 col-md-3 col-lg-3">
                                <div class="game__game-cell game__game-cell_blue game__game-cell_close game__game-cell_item" id="egg{{$i}}" data-class="game__game-cell_close" data-cart-id="{{$card->id}}">
                                    <div class="game__img-wrapper">
                                        <img src="{{$card->item_image}}" alt="" class="game__egg-img game__egg-img_blue" />
                                        <div class="game__result-egg">
                                            <img src="/img/coins/150/null.png" alt="" class="game__egg-img game__egg-img_result" />
                                        </div>
                                    </div>
                                </div>
                        </div>
                        @endfor
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="game__header">
        <div class="game__header-line"></div>
        <div class="game__subheader-text">{{ trans('Guaranteed winnings') }}:</div>
        <div class="game__header-line"></div>
    </div>
    <div class="game__contains">
        <div class="row">
            @foreach($items as $i)
            <div class="col-xs-6 col-sm-4 col-md-3 col-lg-2">
                <div class="game__contains-cell">
                    <div class="game__contains-img-wrapper">
                        <img src="@if(isset($i->image)) {{$i->image}} @endif" alt="" class="game__contains-egg-img" />
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
</div>
</div>
</div>
@stop