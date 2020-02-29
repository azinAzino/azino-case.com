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
	<h4 class="modal-title">{{ trans('Withdrawal request from') }} {{ $user->user->username }}</h4>
</div>
<form method="post" action="/admin/withdraw/save" class="horizontal-form" id="save">
<div class="modal-body">
	<div class="row">
		<div class="col-md-12">
			<a href="https://vk.com/{{ $user->user->login }}" target="_blank"><img style="width: 150px;margin: 0 auto;border-radius: 50% !important;display: block;margin-bottom: 15px;" src="{{ $user->user->avatar }}" /></a>
		</div>
	</div>
	
	<input name="id" value="{{$user->id}}" type="hidden">
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	<div class="form-body">
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label class="control-label">{{ trans('Wallet') }}</label>
					<input type="text" class="form-control" name="koshelek" value="{{ $user->koshelek }}" readonly="readonly">
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label class="control-label">{{ trans('Amount') }}</label>
					<input type="text" class="form-control" name="amount" value="{{ $user->amount }}" readonly="readonly"> 
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="form-group">
					<label class="control-label">{{ trans('Status') }}</label>
					<select class="form-control" tabindex="1" name="status" value="{{ $user->status }}">
						<option value="2" @if($user->status == 2) selected @endif>{{ trans('Denied') }}</option>
						<option value="1" @if($user->status == 1) selected @endif>{{ trans('Paid out') }}</option>
						<option value="0" @if($user->status == 0) selected @endif>{{ trans('Awaiting') }}</option>
					</select>
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