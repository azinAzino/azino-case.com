@extends('admin')

@section('content')
<div class="page-bar">
	<ul class="page-breadcrumb">
		<li>
			<a href="/admin">{{ trans('Home') }}</a>
			<i class="fa fa-circle"></i>
		</li>
		<li>
			<span>{{ trans('Users') }}</span>
		</li>
	</ul>
</div>

<div class="">
	<button 
		type="button" 
		class="btn blue btn-sm" 
		data-toggle="modal" 
		data-target="#usr_create" 
		style="float:right;"
		href="/admin/user/create">{{ trans('Create') }}</button>
	<h1 class="page-title"> {{ trans('Users') }}</h1>
</div>

<div class="flash-message">
    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
      @if(Session::has('alert-' . $msg))

      <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
      @endif
    @endforeach
</div> <!-- end .flash-message -->
<div class="row">
	<div class="col-md-12">
		<div class="portlet light bordered">
			<div class="portlet-body">
				<p id="date_filter">
					<span id="date-label-from" class="date-label">{{ __('From') }}: </span><input class="date_range_filter date" type="text" id="datepicker_from" />
					<span id="date-label-to" class="date-label">{{ __('To') }}:<input class="date_range_filter date" type="text" id="datepicker_to" />
				</p>
				<table id="usersTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
					<thead>
						<tr>
							<th>ID</th>
							<th>{{ trans('Name Lastname') }}</th>
							<th>{{ trans('Balance') }}</th>
							<th>{{ trans('Created') }}</th>
							<th>{{ trans('Manager') }}</th>
							<th>{{ trans('Manage') }}</th>
						</tr>
					</thead>
					<tbody>
						@foreach($users as $user)
						<tr>
							<td style="vertical-align: middle;">{{$user->id}}</td>
							<td style="vertical-align: middle;">{{$user->username}}</td>
							<td style="vertical-align: middle;">{{$user->money}}</td>
							<td style="vertical-align: middle;">{{$user->created_at}}</td>
							<td style="vertical-align: middle;">{{$user->manager->name}}</td>
							<td align="center" style="vertical-align: middle;">
								<button type="button" class="btn blue btn-sm" data-toggle="modal" data-target="#usr_edit" href="/admin/user/{{ $user->id }}/edit">{{ trans('Edit') }}</button>
								<button type="button" class="btn green btn-sm" data-toggle="modal" data-target="#usr_replenish" href="/admin/user/{{ $user->id }}/replenish">{{ trans('Replenish') }}</button>
								<button type="button" class="btn red btn-sm" data-toggle="modal" data-target="#usr_takeaway" href="/admin/user/{{ $user->id }}/takeaway">{{ trans('Reduce') }}</button>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="usr_create" tabindex="-1" role="basic" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			@include('admin.includes.modal_users_create')
		</div>
	</div>
</div>


@if(Session::has('show_modal_created'))
<div class="modal fade" id="usr_created" tabindex="-1" role="basic" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			@include('admin.includes.modal_users_created')
		</div>
	</div>
</div>
<script>
	$(function(){
		$('#usr_created').modal('show')
	})
</script>
@endif

<div class="modal fade" id="usr_edit" tabindex="-1" role="basic" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			@include('admin.includes.modal_users', ['user' => $user])
		</div>
	</div>
</div>

<div class="modal fade" id="usr_replenish" tabindex="-1" role="basic" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			@include('admin.includes.modal_users_replenish', ['user' => $user])
		</div>
	</div>
</div>

<div class="modal fade" id="usr_takeaway" tabindex="-1" role="basic" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			@include('admin.includes.modal_users_takeaway', ['user' => $user])
		</div>
	</div>
</div>
@endsection