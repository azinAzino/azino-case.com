@extends('admin')

@section('content')
<div class="top-bar">
	<h3>{{ __('Last 20 Payments') }}</h3>
</div>
<div class="portlet light bordered">
	<div class="portlet-body">
		<p id="date_filter">
			<span id="date-label-from" class="date-label">{{ __('From') }}: </span><input class="date_range_filter date" type="text" id="datepicker_from" />
			<span id="date-label-to" class="date-label">{{ __('To') }}:<input class="date_range_filter date" type="text" id="datepicker_to" />
		</p>
		<table id="paymentsTable" class="table table-striped table-bordered">
			<thead>
				<tr>
					<th>#</th>
					<th>{{ __('User') }}</th>
					<th>{{ __('Amount') }}</th>
					<th>{{ __('Date') }}</th>
				</tr>
			</thead>
			<tbody>
				@if(!empty($a))
				@foreach($a as $b)
				<tr>
					<td>{{$b->id}}</td>
					<td><a href="/user/{{$b->name_id}}" target="blank">{{$b->name}}</a></td>
					<td>{{$b->amount}}$</td>
					<td>{{$b->timestamp}}</td>
				</tr>
				@endforeach
				@else
				<tr>
					<td> <b>{{ __('No data') }}</b> </td>
				</tr>
				@endif
			</tbody>
		</table>
	</div>
</div>
@stop