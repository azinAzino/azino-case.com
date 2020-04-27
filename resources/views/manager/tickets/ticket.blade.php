@extends('manager')
@section('content')
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="/manager">{{ trans('Home') }}</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>{{ trans('Tickets') }}</span>
        </li>
    </ul>
</div>
<div class="">
    <h1 class="page-title"> {{ trans('Tickets') }}</h1>
</div>
<div class="flash-message">
    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
    @if(Session::has('alert-' . $msg))
    <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert"
            aria-label="close">&times;</a></p>
    @endif
    @endforeach
</div>
<div class="row">
    {{-- <div style="overflow: hidden">
        <div class="all_ticket">
            @foreach ($tickets as $tick)
            <div class="col-md-6">
                <div class=" tik_view">
                    <div class="ttl">
                        <i class="fa fa-clock-o"></i><small class="ticket_create_date" data-index="1">
                            {{ $tick->created_at }}</small>
                        <small>Время ожидания ответа: </small><small class="ticket_wait_answer" data-index="1"></small>
                        <input type="checkbox" id="toggled_read"
                            onclick="form_view_toggle_read(event, {{ $tick->id }})">
                    </div>
                    <div class="txt">{{ $tick->text }}</div>
                </div>
            </div>
            @endforeach
        </div>
    </div> --}}
    <div class="col-md-6" style="min-height: 365px;">
        <div class="tik_reply">
            <div id="send-mail-pattern">
                <div class="form-group">
                    <label>
                        Категории шаблонов:
                    </label>
                    <select class="form-control" id="pattern_category" name="pattern_category">
                        <option value="">Все</option>
                        @foreach($categories as $category)
                        <option value="{{  $category->id }}">{{  $category->title }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>
                        Шаблон:
                    </label>
                    <select class="form-control" id="pattern" name="pattern">
                        <option value="">Нет</option>
                        @foreach($templates as $template)
                        <option value="{{  $template->id }}">{{  $template->title }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <form method="POST" enctype="multipart/form-data" action="/manager/tickets/answer/{{  $ticket->id }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="tik_txt_col_right">
                    <input id="csrf_token" name="csrf_token" type="hidden"
                        value="IjRhNTkxYTAzMWY2N2RmZmU1MzE5MmZmYTFmY2M5NDczNDNjY2M1Y2Yi.XqZIbg.mA33biD52T9aZJyerKSPGnbfVt4">



                    <label>Текст</label>
                    <textarea class="form-control" id="text" name="text" required="">Здравствуйте, уважаемый игрок!


С уважением, служба поддержки azino-case.com.</textarea>
                    <div class="txt_in">

                    </div>
                    <div class="upload">
                        <input accept=".png,.jpg,.jpeg" id="attachments" multiple="" name="attachments" type="file">
                    </div>
                    <div class="control-group  btns">
                        <div class="controls text-center">
                            <input type="submit" class="btn btn-success" value="Answer">
                        </div>
                    </div>

                </div>
            </form>

        </div>
    </div>

    <div class="col-md-6">
        <div class="history_blk">
            <iframe id="history" src="/manager/tickets/history/{{ $ticket->user_id }}"
                style="width:100%;margin:0px;height: 410px;font-size: 13px;padding: 0;border: none"></iframe>
        </div>
    </div>

</div>

<style>
    .tik_reply,
    .history_blk,
    .call_blk,
    .blk,
    .call_history {
        background: #eee;
        border-radius: 10px;
        padding: 10px 15px;
        margin-bottom: 15px;
        box-shadow: 0px 1px 1px #999;
    }

    .tik_view {
        box-shadow: 0px 1px 1px #c14b4b;
        border: 1px solid #ff8181;
        border-radius: 10px;
        overflow: hidden;
        margin-bottom: 15px;
    }

    .tik_view .ttl {
        background: #ff7676;
        padding: 8px 10px;
        color: #fff;
        font-weight: bold;
    }

    .tik_view .txt {
        padding: 8px 15px;
    }

    .tik_txt_col_right textarea {
        height: 153px;
    }
</style>


<script>
    var pattern = document.getElementById("pattern");
    var message = document.getElementById("text");
    var pattern_category = document.getElementById("pattern_category");

    pattern.onchange = function () {
        $.ajax({
            url: "/manager/tickets/pattern/" + pattern.value,
            success: function (data, textStatus) {
                message.value = "Здравствуйте, уважаемый игрок!\n" + data + "\nС уважением, служба поддержки .";
            }
        });
    };
    pattern_category.onchange = function () {
        $.ajax({
            type: "GET",
            url: "/manager/tickets/get_patterns/" + pattern_category.value,
            success: function (data, textStatus) {
                pattern.innerHTML = data;
            }
        });
    };

</script>
@endsection