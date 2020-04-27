@extends('manager')

@section('content')
<div class="page-bar">
	<ul class="page-breadcrumb">
		<li>
			<a href="/manager">{{ trans('Home') }}</a>
			<i class="fa fa-circle"></i>
		</li>
		<li>
			<span>{{ trans('Tickets Categories') }}</span>
		</li>
	</ul>
</div>


<div class="">
	<button type="button" class="btn blue btn-sm" data-toggle="modal" data-target="#tickets_category"
		style="float:right;" href="/manager/tickets/categories/create">{{ trans('Create') }}</button>
	<h1 class="page-title"> {{ trans('Tickets Categories') }}</h1>
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
				<table id="ticketsCategories" class="table table-striped table-bordered" cellspacing="0" width="100%">
					<thead>
						<tr>
							<th>ID</th>
							<th>{{ __('Title') }}</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						@foreach($categories as $category)
						<tr>
							<td>{{$category->id}}</td>
							<td>{{ $category->title }}</td>
							<td align="center" style="vertical-align: middle;">
								<button type="button" class="btn blue btn-sm" data-toggle="modal"
									data-target="#tickets_category"
									href="/manager/tickets/categories/{{ $category->id }}/edit">{{ trans('Edit') }}</button>
								<button type="button" class="btn red btn-sm" data-toggle="modal"
									data-target="#tickets_category"
									href="/manager/tickets/categories/{{ $category->id }}/delete">{{ trans('Delete') }}</button>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="tickets_category" tabindex="-1" role="basic" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
		</div>
	</div>
</div>
@endsection