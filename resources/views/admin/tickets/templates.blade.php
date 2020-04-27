@extends('admin')

@section('content')
<div class="page-bar">
	<ul class="page-breadcrumb">
		<li>
			<a href="/admin">{{ trans('Home') }}</a>
			<i class="fa fa-circle"></i>
		</li>
		<li>
			<span>{{ trans('Tickets Templates') }}</span>
		</li>
	</ul>
</div>


<div class="">
	<button type="button" class="btn blue btn-sm" data-toggle="modal" data-target="#tickets_template"
		style="float:right;" href="/admin/tickets/templates/create">{{ trans('Create') }}</button>
	<h1 class="page-title"> {{ trans('Tickets Templates') }}</h1>
</div>

<div class="flash-message">
	@foreach (['danger', 'warning', 'success', 'info'] as $msg)
	@if(Session::has('alert-' . $msg))
	<p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert"
			aria-label="close">&times;</a></p>
	@endif
	@endforeach
</div>

<div class="row">
	<div class="col-md-12">
		<div class="portlet light bordered">
			<div class="portlet-body">
				<table id="ticketsTemplates" class="table table-striped table-bordered" cellspacing="0" width="100%">
					<thead>
						<tr>
							<th>ID</th>
							<th>{{ __('Title') }}</th>
							<th>{{ __('Category') }}</th>
							<th>{{ __('Text') }}</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						@foreach($templates as $template)
						<tr>
							<td>{{$template->id}}</td>
							<td>{{ $template->title }}</td>
							<td>{{ $template->category ? $template->category->title : __('without category') }}</td>
							<td>{{ $template->text }}</td>
							<td align="center" style="vertical-align: middle;">
								<button type="button" class="btn blue btn-sm" data-toggle="modal"
									data-target="#tickets_template"
									href="/admin/tickets/templates/{{ $template->id }}/edit">{{ trans('Edit') }}</button>
								<button type="button" class="btn red btn-sm" data-toggle="modal"
									data-target="#tickets_template"
									href="/admin/tickets/templates/{{ $template->id }}/delete">{{ trans('Delete') }}</button>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="tickets_template" tabindex="-1" role="basic" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
		</div>
	</div>
</div>
@endsection