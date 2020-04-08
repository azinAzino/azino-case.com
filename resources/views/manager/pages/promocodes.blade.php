@extends('manager')

@section('content')
<div class="page-bar">
	<ul class="page-breadcrumb">
		<li>
			<a href="/manager">Главная</a>
			<i class="fa fa-circle"></i>
		</li>
		<li>
			<span>Промо-коды</span>
		</li>
	</ul>
</div>

<h1 class="page-title">Промо-коды </h1>
<div class="flash-message">
    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
      @if(Session::has('alert-' . $msg))

      <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
      @endif
    @endforeach
</div> <!-- end .flash-message -->
<div class="row">
	<div class="col-md-12">
		<form class="form-horizontal" method="POST" action="/manager/createpromo">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<div class="form-group">
				<label for="amount" class="control-label col-xs-1">Сумма</label>
				<div class="col-xs-4">
					<input type="number" class="form-control" id="amount" placeholder="Сумма" onchange="if (this.value < 1) this.value=1" name='amount' value='100'>
				</div>
				<label for="count" class="control-label col-xs-1">Количество</label>
				<div class="col-xs-4">
					<input type="number" class="form-control" id="count" placeholder="Количество" onchange="if (this.value < 1) this.value=1" name="count" value='1'>
				</div>
				<button type="submit" class="btn btn-primary col-xs-1"><i class="fa fa-plus-circle" aria-hidden="true"></i> Создать</button>
			</div>
		</form>
		<div class="portlet light bordered">
			<div class="portlet-body">
				<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
					<thead>
						<tr>
							<th>#</th>
							<th>Код</th>
							<th>Сумма за активацию</th>
						</tr>
					</thead>
					<tbody>
						@foreach($a as $b)
						<tr>
							<td style="vertical-align: middle;">{{$b->id}}</td>
							<td align="center">{{ $b->code }}</td>
							<td style="vertical-align: middle;">{{$b->price}}</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

@endsection