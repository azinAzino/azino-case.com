<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
	<h4 class="modal-title">{{ trans('User Created') }}</h4>
</div>
<div class="modal-body">
    Зарегистрировал Вам кабинет<br />
    Сайт, где Вы будете работать: http://golden-mines.club/ <br/>
	{{ trans('Логин') }}: {{ Session::get('created_name') }}<br/>
	{{ trans('Пароль') }}: {{ Session::get('created_password') }}<br/>
	{{ trans('Пополнил вам баланс на') }}: {{ Session::get('created_money') }}<br/>
</div>
<div class="modal-footer">
</div>
</form>