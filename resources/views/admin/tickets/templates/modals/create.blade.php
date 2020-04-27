<form method="post" action="/admin/tickets/templates" class="horizontal-form" id="save">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title">{{ __('Create template') }}</h4>
    </div>
    <div class="modal-body">
        <div class="form-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="control-label">{{ trans('Title') }}</label>
                        <input type="text" class="form-control" name="title" value="" required>
                    </div>
                    <div class="form-group">
                        <label class="control-label">{{ trans('Title') }}</label>
                        <select name="ticket_category_id" class="form-control">
                            <option value="">{{  __('Without category') }}</option>
                            @foreach($categories as $category)
                            <option value="{{  $category->id }}">{{  $category->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="control-label">{{ trans('Text') }}</label>
                        <textarea type="text" class="form-control" name="text" required rows="7"></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn dark btn-outline" data-dismiss="modal">{{ trans('Close') }}</button>
        <button type="submit" class="btn green"><i class="fa fa-check"></i>
            {{ trans('Save') }}</button>
    </div>
</form>