<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
	<h4 class="modal-title">{{ trans('Create user') }}</h4>
</div>
<form method="post" action="/administrator/user/create" class="horizontal-form" id="create">
<div class="modal-body">
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	<div class="form-body">
		<div class="row">
			<div class="col-md-12">
				<div class="form-group">
					<label class="control-label">{{ trans('Login') }}</label>
					<input type="text" class="form-control" name="name" value="" required>
				</div>
			</div>
			<div class="col-md-12">
				<div class="form-group">
					<label class="control-label">{{ trans('Balance') }}</label>
					<input type="number" class="form-control" name="money" value="" onchange="if (this.value < 0) this.value=0" required>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label class="control-label">{{ trans('Role') }}</label>
					<select class="form-control" tabindex="1" name="role">
						<option value="12">{{ trans('Administrator') }}</option>
						<option value="11" selected>{{ trans('Manager') }}</option>
						<option value="1">{{ trans('User') }}</option>
					</select>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label class="control-label">{{ trans('Manager') }}</label>
					<select class="form-control" tabindex="1" name="manager_id">
						<option value="">{{  trans('Choose manager') }}</option>
						@foreach($managers as $manager)
						<option value="{{  $manager->id }}">{{  $manager->name }}</option>
						@endforeach
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