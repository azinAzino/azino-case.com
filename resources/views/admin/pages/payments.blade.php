@extends('admin')

@section('content')
<style>
	.res-payments dl {display: flex;font-size:1.6em;}
	.res-payments dt {padding-right:10px;}
	.res-payments dd {padding-right:10px; font-weight: 700;color: orange}
</style>
<div class="top-bar">
	<h3>{{ __('Payments') }}</h3>
</div>
<div class="res-payments">
	<dl>
		<dt>{{ __('Всего заводов:') }}</dt>
		<dd id="payments-itog">{{number_format($itogo, 2, '.', ' ')}}$</dd>
		<dt>{{ __('Заработано оператором:') }}</dt>
		<dd id="payments-zar">{{number_format($zarabotano, 2, '.', ' ')}}$</dd>
	</dl>
</div>
<div class="portlet light bordered">
	<div class="portlet-body">
		<p id="date_filter">
			<span id="date-label-from" class="date-label">{{ __('From') }}: </span><input class="date_range_filter date"
				type="text" id="datepicker_from" />
			<span id="date-label-to" class="date-label">{{ __('To') }}:<input class="date_range_filter date" type="text"
					id="datepicker_to" />
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
					<td>{{$b->amount}}</td>
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