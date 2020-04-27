
<link rel="stylesheet" href="/assets/admin/plugins/font-awesome/css/font-awesome.min.css">
<div class="col-xs-12 history">
    <h4 class="ttl">История Тикетов</h4>
    <button id="remove_selected_tickets_btn" class="remove_selected" onclick="removeSelectedTickets()">Удалить выбранные
    </button>
    <span>&nbsp;</span>
    <button id="select_all_tickets_btn" class="remove_selected" onclick="selectAllTickets()">Выбрать все
    </button>
    @foreach($tickets as $ticket)
    <div class="history_item ">
        <div class="history_item_head" style="background:@if($ticket->direction == 'answer') #8BC63F @else #6cc3e8 @endif">
            <span>
                <i class="fa fa-clock-o"> </i> {{ $ticket->created_at }}
            </span>
            @if($ticket->direction == 'answer')
            <i class="fa fa-user"></i> <span> TO: {{ $ticket->user->username }}</span>
            <i class="fa fa-user"></i> <span> FROM: {{ $ticket->manager->username }}</span>
            @else
            <i class="fa fa-user"></i> <span> FROM: {{ $ticket->manager->username }}</span>
            @endif
            @if(count($ticket->attachments))
            @foreach($ticket->attachments as $attachment)
            <br><a href="/uploads/tickets/{{ $ticket->id }}/{{ $attachment->file }}" target="_blank">{{ $attachment->filename }}</a>
            @endforeach
            @endif
            <div class="action">
                <a
                    href="/admin/tickets/edit/{{ $ticket->id }}"><i
                        class="fa fa-pencil"></i></a>
                <a href="/admin/tickets/delete/{{ $ticket->id }}"><i class="fa fa-trash"></i></a>
                <input type="checkbox" value="{{ $ticket->id }}">
            </div>
            @if($ticket->status == 'read')<i class="fa fa-check-square-o" style="float: right;line-height: 32px"></i>@endif
        </div>
        <p class="txt">{{ $ticket->text }}</p>
    </div>
    @endforeach
</div>
<style>
    body {
        font-size: 14px;
        padding: 15px;
        font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
    }

    .history_item.deleted {
        opacity: .4;
        pointer-events: none;
        color: #000 !important;
    }

    .history_item_head {
        background: #999;
        padding: 0 10px;
        color: #fff;
        font-size: 13px;
        line-height: 32px;
    }

    .history_item_head i {
        margin: 0 5px 0 15px;
        font-size: 14px;
    }

    .history_item_head i:first-child {
        margin-left: 0;
    }

    .txt {
        padding: 10px;
        margin: 0;
        word-break: break-all;
    }

    .txt p {
        margin-top: 0;
    }

    .subject {
        background: rgba(0, 0, 0, .15);
        padding: 5px;
        font-size: 12px;
    }

    p.attached_file,
    p.attached_file a {
        font-size: 11px;
        color: #111;
        margin: 5px 0;
    }

    .history_item {
        background: #f9f9f9;
    }

    .remove_selected {
        font-size: 14px;
        margin-bottom: 20px;
        background: #f60;
        color: #fff;
        border: none;
        padding: 5px 10px;
        box-shadow: 0 0 5px rgba(0, 0, 0, .3);
    }

    .remove_selected:hover {
        background: #f50;
        cursor: pointer;
    }

    .action {
        display: inline-block;
        float: right;
        padding: 0 10px;
        background: rgba(0, 0, 0, .5);
        margin-right: -10px;
        margin-left: 15px;
    }

    .action a i,
    .action button i {
        font-size: 16px;
        color: #fff;
        cursor: pointer;
        margin: 0 5px !important;
    }

    .action button {
        border: none;
        padding: 0;
        background: transparent;
    }
</style>



<script>

    function selectAllTickets() {
      var checkboxes = document.querySelectorAll('input[type=checkbox]');
      checkboxes.forEach(function (o) {
        o.checked = true
      });
    }
  
    function removeSelectedTickets() {
      var to_remove = [];
      var checkboxes = document.querySelectorAll('input[type=checkbox]:checked');
  
      for (var i = 0; i < checkboxes.length; i++) {
        to_remove.push(checkboxes[i].value)
      }
  
      fetch('/admin/tickets/bulk_delete', {
        method: 'post',
        credentials: 'same-origin',
        headers: {
          'Accept': 'application/json, text/plain, */*',
          'Content-Type': 'application/json'
        },
        body: JSON.stringify({to_remove: to_remove})
      }).then(function () {
        window.location.reload(true)
      });
    }
  </script>