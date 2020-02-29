@extends('admin')

@section('content')
<div class="page-bar">
	<ul class="page-breadcrumb">
		<li>
			<a href="/admin">Главная</a>
			<i class="fa fa-circle"></i>
		</li>
		<li>
			<span>Выводы</span>
		</li>
	</ul>
</div>

<h1 class="page-title"> Выводы пользователей </h1>

<div class="flash-message">
    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
      @if(Session::has('alert-' . $msg))

      <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
      @endif
    @endforeach
</div>

<div class="row">
	<div class="col-md-12">
		<div class="portlet light bordered">
			<div class="portlet-body">
				<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
					<thead>
						<tr>
							<th>ID</th>
							<th>Пользователь</th>
							<th>Система</th>
							<th>Кошелек</th>
							<th>Сумма</th>
							<th>Время</th>
							<th>Статус</th>
							<th>Редактировать</th>
						</tr>
					</thead>
					<tbody>
					@if(isset($withdrows))
						@foreach($withdrows as $withdrow)
						<tr>
							<td style="vertical-align: middle;">{{$withdrow->id}}</td>
							<td style="vertical-align: middle;"><a href="https://vk.com/{{ $withdrow->user->login }}" target="_blank">{{ $withdrow->user->username }}</a> | <div data-toggle="modal" data-target="#user_edit" href="/admin/user/{{ $withdrow->user->id }}/edit" style="display: inline-block;
																									cursor: pointer;">Инфо</div></td>
							<td style="vertical-align: middle;">@if(isset($withdrow->koshelek))
																@if($withdrow->koshelek == 'yandex')
																<center><img src="/img/icons/yandex.png" width="70px" alt = 'Yandex Money'></center>
																@elseif($withdrow->koshelek == 'qiwi')
																<center><img src="/img/icons/qiwi.png" width="30px" alt = 'Qiwi Visa Wallet'></center>
																@elseif($withdrow->koshelek == 'payeer')
																<center><img src="/img/icons/payeer.png" width="70px" alt = 'Qiwi Visa Wallet'></center>
																@else
																<center><img src="/img/icons/webmoney.png" width="70px" alt = 'WebMoney'></center>
																@endif</td>
																@endif
							<td style="vertical-align: middle;">{{$withdrow->nomer}}</td>
							<td style="vertical-align: middle;">{{$withdrow->amount}}</td>
							<td style="vertical-align: middle;">{{$withdrow->dfh}}</td>
																@if(isset($withdrow->status))
							<td style="vertical-align: middle;">@if($withdrow->status == 0)
																<div class="btn green btn-sm">Ожидает</div>
																@elseif($withdrow->status == 1)
																<div class="btn orange btn-sm">Выплачено</div>
																@elseif($withdrow->status == 2)
																<div class="btn red btn-sm">Отказано</div>
																@endif</td>
																@endif
							<td style="vertical-align: middle;">@if(isset($withdrow->status) && isset($withdrow->id)) @if($withdrow->status == 0)<a class="btn blue btn-sm" data-toggle="modal" data-target="#usr_edit" href="/admin/withdraw/{{ $withdrow->id }}/edit">Редактировать</a>@endif @endif</td>
						</tr>
						@endforeach
					@endif
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
@if(!empty($withdrows))
<div class="modal fade" id="usr_edit" tabindex="-1" role="basic" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			@if(isset($withdrow))
			@include('admin.includes.modal_withdrows', ['user' => $withdrow])
			@else
			@endif
		</div>
	</div>
</div>
<div class="modal fade" id="user_edit" tabindex="-1" role="basic" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			@include('admin.includes.modal_users', ['user' => $withdrow->user])
		</div>
	</div>
</div>
@endif
@endsection