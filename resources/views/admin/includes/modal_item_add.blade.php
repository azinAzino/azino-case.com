<script>
	$("#range_1").ionRangeSlider({
		type: "single",
		min: 0.1,
		max: 100,
		step: 0.1
	});
</script>
<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
	<h4 class="modal-title">{{ trans('Create a new item') }}</h4>
</div>
<form method="post" action="/admin/item/add" class="horizontal-form" id="save">
<div class="modal-body">
	<input name="id" value="{{ $case->id }}" type="hidden">
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	<div class="form-body">
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label class="control-label">{{ trans('Price') }}</label>
					<input type="text" class="form-control" name="cost" value="">
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label class="control-label">{{ trans('Type') }}</label>
					<select class="form-control" tabindex="1" name="type" value="">
						<option value="0">{{ trans('Curreny') }}</option>
						<option value="1">{{ trans('Item') }}</option>
					</select>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="form-group text-center">
					<label class="control-label">{{ trans('Picture') }}</label>
					<input type="text" class="form-control" name="image" placeholder="{{ trans('Path to picture') }}: /style/coin-100.svg">
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