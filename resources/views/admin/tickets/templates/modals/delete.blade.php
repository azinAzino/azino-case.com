<form method="post" action="/admin/tickets/templates/{{ $template->id }}/destroy" class="horizontal-form">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title">{{ trans('Delete tickets template') }}</h4>
    </div>
    <div class="modal-body">
        <h5>{{ $template->title }}</h5>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn dark btn-outline" data-dismiss="modal">{{ trans('Close') }}</button>
        <button type="submit" class="btn red"><i class="fa fa-check"></i> {{ trans('Delete') }}</button>
    </div>
</form>