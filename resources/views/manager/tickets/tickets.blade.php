@extends('manager')

@section('content')
<div class="page-bar">
	<ul class="page-breadcrumb">
		<li>
			<a href="/manager">{{ trans('Home') }}</a>
			<i class="fa fa-circle"></i>
		</li>
		<li>
			<span>{{ trans('Tickets') }}</span>
		</li>
	</ul>
</div>


<div class="">
	<h1 class="page-title"> {{ trans('Tickets') }}</h1>
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
				<table id="tickets" class="table table-striped table-bordered" cellspacing="0" width="100%">
					<thead>
						<tr>
							<th></th>
							<th>{{ __('Manager') }}</th>
							<th>{{ __('User') }}</th>
							<th>{{ __('Date') }}</th>
							<th>{{ __('Attachments') }}</th>
							<th>{{ __('Text') }}</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						@foreach($tickets as $ticket)
						<tr>
							<td>{{$ticket->id}}</td>
							<td>{{$ticket->manager->username}}</td>
							<td>{{$ticket->user->username}}</td>
							<td>{{$ticket->created_at}}</td>
							<td>
								@if(count($ticket->attachments))
								@foreach($ticket->attachments as $attachment)
								<a href="/uploads/tickets/{{ $ticket->id }}/{{ $attachment->file }}" target="_blank">{{ $attachment->filename }}</a><br>
								@endforeach
								@endif
							</td>
							<td>{{$ticket->text}}</td>
							<td align="center" style="vertical-align: middle;">
								<div class="icons_blk">
									<ul>
										<li><a href="/manager/tickets/show/{{ $ticket->id }}"><i
													class="fa fa-envelope"></i></a></li>
										<li><a title="Edit" data-toggle="modal" data-target="#tickets_category"
												href="/manager/user/{{ $ticket->user_id }}/edit"><i
													class="fa fa-pencil"></i></a></li>
										<li><a title="Add money" data-toggle="modal" data-target="#tickets_category"
												href="/manager/user/{{ $ticket->user_id }}/replenish"
												style="color: #8BC34A"><i class="fa fa-money"></i></a></li>
										<li><a title="Withdraw money" data-toggle="modal"
												data-target="#tickets_category" href="/manager/user/180/takeaway"
												style="color: #F44336"><i class="fa fa-money"></i></a></li>




										{{-- <li>
											<a class="icon btn_unread_5ea63d077cee417920668aba" href="#0"
												style="padding-left: 10px"
												onclick="list_view_set_read(event, '5ea63d077cee417920668aba');"
												urn="/">
												<i class="fa fa-check-square"></i>Отметить как прочитаное
											</a>
										</li> --}}
										{{-- <li><a href="/user_transactions/5ea5e715f2c969219a70990c/" target="_blank"><i
													class="fa fa-usd"></i></a></li> --}}
										{{-- <li><a href="/usergamehistory/5ea5e715f2c969219a70990c/" target="_blank"><i
													class="fa fa-calendar"></i></a></li> --}}
										{{-- <li><a href="/user/kill_session/5ea5e715f2c969219a70990c/"
												onclick="kill_session(this, this.href);return false;"><i
													class="fa fa-unlock"></i></a></li> --}}
										{{-- <li><a href="#" title="" data-toggle="modal" data-target="#modal_buffer"
												data-remote="/search/5ea5e715f2c969219a70990c" data-backdrop="static"
												style="color: #8BC34A"><i class="fa fa-search"></i></a></li> --}}
									</ul>
								</div>
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
<style>
	.icons_blk ul,
	.pop_icons ul {
		margin: 0;
		padding: 0;
		display: flex;
		width: 100%;
	}

	.icons_blk ul li,
	.pop_icons ul li {
		display: inline;
		list-style: none;
		margin-right: 7px;
		flex: 1;
	}
</style>
@endsection