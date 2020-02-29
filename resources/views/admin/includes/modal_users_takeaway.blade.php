<script>
	$("#range_1").ionRangeSlider({
		type: "single",
		min: 0,
		max: 100,
		step: 10,
	});
</script>
<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
	<h4 class="modal-title">{{ trans('Reduce balance') }}</h4>
</div>
<form method="post" action="/admin/user/balance_reduce" class="horizontal-form" id="balance_reduce">
<div class="modal-body">
	<div class="row">
		<div class="col-md-12">
			<a href="https://vk.com/{{ $user->login }}" target="_blank"><img style="width: 150px;margin: 0 auto;border-radius: 50% !important;display: block;margin-bottom: 15px;" src="{{ $user->avatar }}" /></a>
		</div>
	</div>
	<input name="id" value="{{$user->id}}" type="hidden">
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	<div class="form-body">
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label class="control-label">{{ trans('Name Second name') }}</label>
					<input type="text" class="form-control" name="name" value="{{ $user->username }}" readonly="readonly">
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label class="control-label">{{ trans('Balance') }}</label>
					<input type="number" class="form-control" name="money" value="{{ $user->money }}"readonly="readonly">
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label class="control-label">{{ trans('Amount') }}</label>
					<input type="number" class="form-control" name="amount" value="" onchange="if (this.value < 0) this.value=0">
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label class="control-label" for="make_ransaction">{{ trans('Make trnsaction?') }}</label><br>
					<input type="checkbox" id="make_ransaction" name="make_ransaction">
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