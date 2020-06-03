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
	<h4 class="modal-title">{{ $user->username }}</h4>
</div>
<form method="post" action="/admin/user/save" class="horizontal-form" id="save">
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
					<input type="number" class="form-control" name="money" value="{{ $user->money }}" onchange="if (this.value < 0) this.value=0">
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label class="control-label">{{ trans('Role') }}</label>
					<select class="form-control" tabindex="1" name="role" value="{{ $user->role }}">
						<option value="10" @if($user->role == 10) selected @endif>{{ trans('Admin') }}</option>
						<option value="12" @if($user->role == 12) selected @endif>{{ trans('Administrator') }}</option>
						<option value="11" @if($user->role == 11) selected @endif>{{ trans('Manager') }}</option>
						<option value="1" @if($user->role == 1) selected @endif>{{ trans('User') }}</option>
					</select>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label class="control-label">{{ trans('Manager') }}</label>
					<select class="form-control" tabindex="1" name="manager_id">
						<option value="">{{  trans('Choose manager') }}</option>
						@foreach($managers as $manager)
						<option value="{{  $manager->id }}" @if($user->manager_id == $manager->id) selected @endif>{{  $manager->name }}</option>
						@endforeach
					</select>
				</div>
			</div>
			<input type="hidden" name="is_yt" value="{{ $user->is_yt }}">
			{{-- <div class="col-md-6">
				<div class="form-group">
					<label class="control-label">Ютубер</label>
					<select class="form-control" tabindex="1" name="is_yt" value="{{ $user->is_yt }}">
						<option value="1" @if($user->is_yt == 1) selected @endif>{{ trans('Yes') }}</option>
						<option value="0" @if($user->is_yt == 0) selected @endif>{{ trans('No') }}</option>
					</select>
				</div>
			</div> --}}
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label class="control-label">{{ trans('Bonus balance') }}</label>
					<input type="number" class="form-control" name="bonus_money" value="{{ $user->bonus_money }}" onchange="if (this.value < 0) this.value=0">
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label class="control-label">{{ trans('Referal link') }}</label>
					<input type="text" class="form-control" name="ref_link" value="{{ $user->ref_link }}">
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label class="control-label">{{ trans('Opened cases') }}</label>
					<input type="number" class="form-control" name="opened" value="{{ $user->opened }}" onchange="if (this.value < 0) this.value=0">
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label class="control-label">{{ trans('Amount') }}</label>
					<input type="number" class="form-control" name="deposit" value="{{ $user->deposit }}" onchange="if (this.value < 0) this.value=0">
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4">	
				<div class="form-group">
					<label class="control-label">{{ trans('Replenished the amount') }}: </label>
					<input type="text" class="form-control" value="{{ $user->payed }} $" readonly="readonly">
				</div>
			</div>
			<div class="col-md-4">	
				<div class="form-group">
					<label class="control-label">{{ trans('Withdrew on the amount') }}: </label>
					<input type="text" class="form-control" value="{{ $user->with }} $" readonly="readonly">
				</div>
			</div>
			<div class="col-md-4">	
				<div class="form-group">
					<label class="control-label">{{ trans('Pending Payout') }}: </label>
					<input type="text" class="form-control" value="{{ $user->with0 }} $" readonly="readonly">
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