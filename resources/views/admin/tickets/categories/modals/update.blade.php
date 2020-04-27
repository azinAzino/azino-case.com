<form method="post" action="/admin/tickets/categories/{{ $category->id }}" class="horizontal-form">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title">{{ trans('Update tickets category') }}</h4>
    </div>
    <div class="modal-body">
        <div class="form-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="control-label">{{ trans('Title') }}</label>
                        <input type="text" class="form-control" name="title" value="{{ $category->title }}" required>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn dark btn-outline" data-dismiss="modal">{{ trans('Close') }}</button>
        <button type="submit" class="btn green"><i class="fa fa-check"></i> {{ trans('Save') }}</button>
    </div>
</form>