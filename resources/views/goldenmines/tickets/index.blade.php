@extends('azinocase.layout')

@section ('title')
{{ __('Tickets') }}
@stop
@section('tickets')
tickets-page
@stop
@section('content')
<div class="content">
    <div class="tickets-block">
        <div class="container">
            <div class="tickets-container">
                <div class="tickets-container-inner">
                    <div class="flash-message">
                        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                        @if(Session::has('alert-' . $msg))
                        <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close"
                                data-dismiss="alert" aria-label="close">&times;</a></p>
                        @endif
                        @endforeach
                    </div>
                    <form method="post" action="/tickets" enctype="multipart/form-data"> <input type="hidden"
                        name="_token" value="{{ csrf_token() }}">
                        <div class="form-group">
                            <textarea class="form-control" id="ticketMessage" placeholder="{{ __('Message') }}" rows="7"
                                name="text"></textarea>
                        </div>
                        <div class="form-group">
                            <div class="custom-file text-right">
                                <input accept=".png,.jpg,.jpeg" style="display:inline-block;" class="form-control-file"
                                    id="attachments" multiple="" name="attachments[]" type="file">
                            </div>
                        </div>
                        <div class="form-group text-right">
                            <button
                                class="modal-window__button button-rounding button-rounding_big button-rounding_long button-rounding_hlight">
                                {{ __('Send') }}</button>
                        </div>
                    </form>
                </div>
                <div class="tickets-container-inner">
                    @foreach($tickets as $ticket)
                    @if($ticket->direction == 'answer')
                    <div class="panel panel-danger text-right mt-4 ticket w-100">
                        <div class="panel-heading">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                version="1.1" style="display: inline; vertical-align: middle;" x="0px" y="0px"
                                viewBox="0 0 459.668 459.668" xml:space="preserve" width="16px" height="16px">
                                <path
                                    d="M359.574,297.043c-18.204,25.002-47.692,41.286-80.916,41.286h-46.618c-16.104,0-29.818-10.224-35.011-24.534     c-6.41-1.912-12.696-4.394-18.83-7.442c-12.99-6.454-24.785-15.198-35.168-26.03c-67.35,14.796-117.757,74.808-117.757,146.603     v9.384c0,12.9,10.458,23.358,23.358,23.358h362.403c12.9,0,23.358-10.458,23.358-23.358v-9.384     C434.392,371.464,404.309,323.032,359.574,297.043z" />
                                <path
                                    d="M118.205,232.178c10.039,0,18.777-5.564,23.304-13.775c0.119,0.325,0.24,0.648,0.362,0.971     c0.036,0.097,0.072,0.194,0.108,0.291c10.62,27.954,31.284,51.388,58.532,61.627c6.59-10.471,18.243-17.435,31.53-17.435h46.618     c4.65,0,8.978-1.312,12.772-3.433c6.372-3.563,12.102-12.602,15.061-17.393c4.735-7.667,8.404-15.788,11.657-24.642     c1.828,3.32,4.342,6.208,7.354,8.471v11.431c0,25.83-21.014,46.845-46.845,46.845H232.04c-8.813,0-15.958,7.145-15.958,15.958     c0,8.814,7.145,15.958,15.958,15.958h46.618c43.429,0,78.761-35.332,78.761-78.761V226.86     c6.46-4.853,10.639-12.577,10.639-21.278v-48.119v-18.452c0-8.88-4.355-16.737-11.042-21.568C351.83,51.816,296.77,0,229.833,0     C162.895,0,107.836,51.816,102.65,117.442c-6.687,4.831-11.042,12.689-11.042,21.568v66.57     C91.608,220.311,103.575,232.178,118.205,232.178z M229.833,31.917c49.552,0,90.423,37.868,95.2,86.185     c-3.136,2.467-5.705,5.62-7.475,9.238c-15.058-39.286-48.672-66.638-87.726-66.638c-39.896,0-72.971,28.292-87.667,66.481     c-0.02,0.052-0.039,0.105-0.059,0.158c-1.77-3.618-4.339-6.771-7.475-9.238C139.411,69.785,180.281,31.917,229.833,31.917z" />
                            </svg>
                            {{ __('From support') }}
                            <span class="date">{{ $ticket->created_at }}</span>
                        </div>
                        <div class="panel-body text-left">
                            <p class="card-text">{{ $ticket->text }}</p>
                            @if(count($ticket->attachments))
                            <hr class="mb-1">
                            @foreach($ticket->attachments as $attachment)
                            <a href="/uploads/tickets/{{ $ticket->id }}/{{ $attachment->file }}" class="text-white d-block" target="_blank">{{ $attachment->filename }}</a><br>
                            @endforeach
                            @endif
                        </div>
                    </div>
                    @else
                    <div class="panel panel-info mt-4 ticket w-100">
                        <div class="panel-heading">
                            {{ __('From you') }}
                            <span class="date">{{ $ticket->created_at }}</span>
                        </div>
                        <div class="panel-body text-left">
                            <p class="card-text">{{ $ticket->text }}</p>
                            @if(count($ticket->attachments))
                            <hr class="mb-1">
                            @foreach($ticket->attachments as $attachment)
                            <a href="/uploads/tickets/{{ $ticket->id }}/{{ $attachment->file }}" class="text-white d-block" target="_blank">{{ $attachment->filename }}</a><br>
                            @endforeach
                            @endif
                        </div>
                    </div>
                    @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .tickets-block .container .tickets-container {
        background-color: #1e2832;
        padding: 4rem 1rem 1rem;
        border-radius: 10px;
        overflow: hidden;
        margin: 4rem auto;
        color: #fff;
    }

    .tickets-block .container .tickets-container-inner {
        padding: 25px;
        background-color: rgba(0, 0, 0, .6);
        border-radius: 10px;
        margin-bottom: 25px;
    }


    .tickets-block .container .tickets-container-inner textarea {

        background-color: transparent;
        border: 2px solid #1e2832;
        border-radius: 6px;
        outline: none;
        font: 18px opensans, Helvetica, Arial, sans-serif;
        font-weight: 400;
        color: #fff;
        padding: 15px 10px;
        -webkit-transition: all .2s;
        transition: all .2s;
        resize: vertical;
    }

    .tickets-block .container .tickets-container-inner .panel {
        background-color: transparent;
        color: #fff;
    }

    .tickets-block .container .tickets-container-inner .panel-danger>.panel-heading {
        color: #ebccd1;
        fill: #ebccd1;
        background-color: #f2dede44;
        border-color: #ebccd1;
    }

    .tickets-block .container .tickets-container-inner .panel-info>.panel-heading {
        color: #bce8f1;
        fill: #bce8f1;
        background-color: #d9edf744;
        border-color: #bce8f1;
    }
</style>
@stop