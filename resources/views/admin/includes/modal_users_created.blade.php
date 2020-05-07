<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
	<h4 class="modal-title">{{ trans('User Created') }}</h4>
</div>
<div class="modal-body">
    <p>Зарегистрировал Вам кабинет</p>
    <p>Сайт, где Вы будете работать: {{ $settings->url }} </p>
	<p>{{ trans('Логин') }}: {{ Session::get('created_name') }}</p>
	<p>{{ trans('Пароль') }}: {{ Session::get('created_password') }}</p>
	<p>{{ trans('Пополнил вам баланс на') }}: {{ Session::get('created_money') }}</p>
	<p>{!! nl2br($settings->created_text) !!}</p>
</div>
<div class="modal-footer">
</div>
</form>

