@extends('admin')

@section('content')
<div class="page-bar">
	<ul class="page-breadcrumb">
		<li>
			<a href="/admin">Главная</a>
			<i class="fa fa-circle"></i>
		</li>
		<li>
			<span>Настройки</span>
		</li>
	</ul>
</div>

<h1 class="page-title"> Настройки сайта </h1>

<div class="flash-message">
    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
      @if(Session::has('alert-' . $msg))

      <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
      @endif
    @endforeach
</div>

<div class="row">
	<style>
	.bs-callout-danger {
		background-color: #fdf7f7;
		border-color: #d9534f;
	}
	.bs-callout {
		margin: 20px 0;
		padding: 20px;
		border-left: 3px solid #eee;
	}
	.bs-callout-danger h4 {
		color: #d9534f;
	}
	.bs-callout h4 {
		margin-top: 0;
		margin-bottom: 5px;
	}
	bs-callout p:last-child {
		margin-bottom: 0;
	}
	</style>
	<div class="col-md-12">
		<div class="bs-callout bs-callout-danger">
			<h4>Для чего необходим токен от страницы VK?</h4>
			<p>Токен от страницы используется при генерации реферальной ссылки для пользователя, рекомендуем настаятельно не брать токен с основного аккаунта ВКонтакте, а создать твинк. При переходе
			по ссылке для получения токена, в браузерной строке появится URL типа: <br>
			<pre>http://api.vk.com/blank.html#access_token=ac467e477285fe4144ad691886785e4551cfb0e90096fbb7ecde4b817ea1b8e22e4fa167e9048b2e817d6&expires_in=0&user_id=XXXXXXXXX</pre><br>
			Из которой нужно скопировать код, идущий после <code>#access_token=</code> и до <code>&expires_in</code><br>
			В нашем случае, это код:<br>
			<pre>ac467e477285fe4144ad691886785e4551cfb0e90096fbb7ecde4b817ea1b8e22e4fa167e9048b2e817d6</pre></p>
		</div>
	</div>
	<div class="col-md-12">
		<div class="bs-callout bs-callout-danger">
			<h4>URL'ы для настройки кассы: </h4>
			<p>В настройках кассы укажите следующие ссылки:<br>
			<b>URL оповещения: <code>{{ $_SERVER['HTTP_HOST'].'/checkpayment' }}</code>, метод: <code>POST</code><br>
			URL успешной / неуспешной оплаты: <code>{{ $_SERVER['HTTP_HOST'].'/success' }}</code>, метод: <code>GET</code></b></p>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-12">
		<div class="portlet light bordered">
			<div class="portlet-body">
				<form method="post" action="/admin/settings/save" class="horizontal-form">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<div class="form-body">
						<div class="row">
							<div class="col-md-12">
								<div class="portlet-title">
									<div class="form-group">
										<div class="caption font-red-sunglo">
											<span class="caption-subject bold uppercase">Основные настройки</span>
										</div>
									</div>
								</div>
							</div> 
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Сумма минимального пополнения</label>
									<input type="number" class="form-control" placeholder="20" name="min_dep" value="{{ $settings->min_dep }}" onchange="if (this.value < 0) this.value=0">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Сумма минимального вывода</label>
									<input type="number" class="form-control" placeholder="100" name="min_width" value="{{ $settings->min_width }}" onchange="if (this.value < 0) this.value=0">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label class="control-label">Ссылка на группу VK</label>
									<input type="text" class="form-control" placeholder="https://vk.com/cheap.scripts" name="vk_group" value="{{ $settings->vk_group }}">
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label class="control-label">Токен от страницы VK (<a href="http://goo.gl/KseyIT" target="blank">получить</a>)</label>
									<input type="text" class="form-control" placeholder="ac467e477285fe4144ad691886785e4551cfb0e90096fbb7ecde4b817ea1b8e22e4fa167e9048b2e817d6" name="vk_token" value="{{ $settings->vk_token }}">
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label class="control-label">Процент отчисления пригласившему</label>
									<input type="number" class="form-control" placeholder="5" name="tttk" value="{{ $settings->ref_percent }}">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="portlet-title">
									<div class="form-group">
										<div class="caption font-red-sunglo">
											<span class="caption-subject bold uppercase">Настройка оплаты</span>
										</div>
									</div>
								</div>
							</div> 
						</div>
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label class="control-label">Платежный шлюз:</label>
									<select class="form-control" tabindex="1" name="payment_type" value="{{ $settings->payment_type }}">
										<option value="1" @if($settings->payment_type == 1) selected @endif>Pay-trio(PT)</option>
										<option value="0" @if($settings->payment_type == 0) selected @endif>Free-Kassa(FK)</option>
									</select>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label class="control-label">ID магазина (PT)</label>
									<input type="text" class="form-control" placeholder="Секретный ключ #1" name="pt_shopid" value="{{ $settings->pt_shopid }}">
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label class="control-label">Секретный ключ (PT)</label>
									<input type="text" class="form-control" placeholder="Секретный ключ #2" name="pt_secret" value="{{ $settings->pt_secret }}">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label class="control-label">ID Магазина (FK)</label>
									<input type="number" class="form-control" placeholder="ID Магазина" name="fk_id" value="{{ $settings->fk_id }}" onchange="if (this.value < 0) this.value=0">
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label class="control-label">Секретный ключ #1 (FK)</label>
									<input type="text" class="form-control" placeholder="Секретный ключ #1" name="fk_secret1" value="{{ $settings->fk_secret1 }}">
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label class="control-label">Секретный ключ #2 (FK)</label>
									<input type="text" class="form-control" placeholder="Секретный ключ #2" name="fk_secret2" value="{{ $settings->fk_secret2 }}">
								</div>
							</div>
						</div>
					</div>
					<div class="form-actions right">
						<button type="submit" class="btn blue"><i class="fa fa-check"></i> Сохранить </button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>


@endsection