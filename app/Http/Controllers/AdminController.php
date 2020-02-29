<?php

namespace App\Http\Controllers;

use App\User;
use App\Cards;
use App\Items;
use App\Withdraw;
use App\Promo;
use App\Support;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Settings;
use App\Reviews;

class AdminController extends Controller
{
	public function index()
	{
		$user_money = \DB::table('users')->where('money', '!=', 0)->sum('money');
		$user_today = \DB::table('users')->where('created_at', '>=', Carbon::today())->count();
		$opened_today = \DB::table('games')->where('updated_at', '>=', Carbon::today())->count();
		$pay_today = \DB::table('operations')->where('updated_at', '>=', Carbon::today())->where('status', 1)->where('type', 0)->sum('amount');
		$pay_week = \DB::table('operations')->where('updated_at', '>=', Carbon::now()->subDays(7))->where('type', 0)->where('status', 1)->sum('amount');
		$pay_month = \DB::table('operations')->where('updated_at', '>=', Carbon::now()->subDays(30))->where('status', 1)->where('type', 0)->sum('amount');
		$pay_all = \DB::table('operations')->where('status', 1)->where('type', 0)->sum('amount');


		/*Подробная статистика*/
		$pay_yesterday = \DB::table('operations')->where('updated_at', '>=', Carbon::now()->subDays(1)->format('Y-m-d 00:00:01'))->where('updated_at', '<=', Carbon::now()->subDays(1)->format('Y-m-d 23:59:59'))->where('type', 0)->where('status', 1)->sum('amount');
		$pay_3dn = \DB::table('operations')->where('updated_at', '>=', Carbon::now()->subDays(2)->format('Y-m-d 00:00:01'))->where('updated_at', '<=', Carbon::now()->subDays(2)->format('Y-m-d 23:59:59'))->where('type', 0)->where('status', 1)->sum('amount');
		$pay_4dn = \DB::table('operations')->where('updated_at', '>=', Carbon::now()->subDays(3)->format('Y-m-d 00:00:01'))->where('updated_at', '<=', Carbon::now()->subDays(3)->format('Y-m-d 23:59:59'))->where('type', 0)->where('status', 1)->sum('amount');
		$pay_5dn = \DB::table('operations')->where('updated_at', '>=', Carbon::now()->subDays(4)->format('Y-m-d 00:00:01'))->where('updated_at', '<=', Carbon::now()->subDays(4)->format('Y-m-d 23:59:59'))->where('type', 0)->where('status', 1)->sum('amount');



		$pay_last_week = \DB::table('operations')->where('updated_at', '<=', Carbon::now()->subWeeks(1))->where('updated_at', '>=', Carbon::now()->subWeeks(2))->where('type', 0)->where('status', 1)->sum('amount');
		$pay_week_ago = \DB::table('operations')->where('updated_at', '<=', Carbon::now()->subWeeks(2))->where('updated_at', '>=', Carbon::now()->subWeeks(3))->where('type', 0)->where('status', 1)->sum('amount');
		$pay_week_ago1 = \DB::table('operations')->where('updated_at', '<=', Carbon::now()->subWeeks(3))->where('updated_at', '>=', Carbon::now()->subWeeks(4))->where('type', 0)->where('status', 1)->sum('amount');
		$pay_week_ago2 = \DB::table('operations')->where('updated_at', '<=', Carbon::now()->subWeeks(4))->where('updated_at', '>=', Carbon::now()->subWeeks(5))->where('type', 0)->where('status', 1)->sum('amount');




		$pay_last_month = \DB::table('operations')->where('updated_at', '<=', Carbon::now()->subMonths(1))->where('updated_at', '>=', Carbon::now()->subMonths(2))->where('type', 0)->where('status', 1)->sum('amount');
		$pay_last_month1 = \DB::table('operations')->where('updated_at', '<=', Carbon::now()->subMonths(2))->where('updated_at', '>=', Carbon::now()->subMonths(3))->where('type', 0)->where('status', 1)->sum('amount');
		$pay_last_month2 = \DB::table('operations')->where('updated_at', '<=', Carbon::now()->subMonths(3))->where('updated_at', '>=', Carbon::now()->subMonths(4))->where('type', 0)->where('status', 1)->sum('amount');
		$pay_last_month3 = \DB::table('operations')->where('updated_at', '<=', Carbon::now()->subMonths(4))->where('updated_at', '>=', Carbon::now()->subMonths(5))->where('type', 0)->where('status', 1)->sum('amount');

		/*Подробная статистика*/


		/*Статистика пользователей*/

		$reg_yesterday = \DB::table('users')->where('created_at', '>=', Carbon::now()->subDays(1)->format('Y-m-d 00:00:01'))->where('created_at', '<=', Carbon::now()->subDays(1)->format('Y-m-d 23:59:59'))->count();
		$reg_3dn = \DB::table('users')->where('created_at', '>=', Carbon::now()->subDays(2)->format('Y-m-d 00:00:01'))->where('created_at', '<=', Carbon::now()->subDays(2)->format('Y-m-d 23:59:59'))->count();
		$reg_4dn = \DB::table('users')->where('created_at', '>=', Carbon::now()->subDays(3)->format('Y-m-d 00:00:01'))->where('created_at', '<=', Carbon::now()->subDays(3)->format('Y-m-d 23:59:59'))->count();
		$reg_5dn = \DB::table('users')->where('created_at', '>=', Carbon::now()->subDays(4)->format('Y-m-d 00:00:01'))->where('created_at', '<=', Carbon::now()->subDays(4)->format('Y-m-d 23:59:59'))->count();



		$reg_this_week = \DB::table('users')->where('created_at', '<=', Carbon::now()->subWeeks(0))->where('created_at', '>=', Carbon::now()->subWeeks(1))->count();
		$reg_last_week = \DB::table('users')->where('created_at', '<=', Carbon::now()->subWeeks(1))->where('created_at', '>=', Carbon::now()->subWeeks(2))->count();
		$reg_week_ago = \DB::table('users')->where('created_at', '<=', Carbon::now()->subWeeks(2))->where('created_at', '>=', Carbon::now()->subWeeks(3))->count();
		$reg_week_ago1 = \DB::table('users')->where('created_at', '<=', Carbon::now()->subWeeks(3))->where('created_at', '>=', Carbon::now()->subWeeks(4))->count();
		/*Статистика пользователей*/


		//->where('created_at', '<', Carbon::now()->subDays(14))->where('type', 0)->where('status', 1)
		//dd(Carbon::now()->subDays(2)->format('Y-m-d 00:00:01'));
		//dd(Carbon::now()->subDays(2)->format('Y-m-d 23:59:59'));


		if (!$user_money) $user_money = 0;
		if (!$user_today) $user_today = 0;
		if (!$opened_today) $opened_today = 0;
		if (!$pay_today) $pay_today = 0;
		if (!$pay_week) $pay_week = 0;
		if (!$pay_month) $pay_month = 0;
		if (!$pay_all) $pay_all = 0;
		if (!$pay_yesterday) $pay_yesterday = 0;
		if (!$pay_3dn) $pay_3dn = 0;
		if (!$pay_4dn) $pay_4dn = 0;
		if (!$pay_5dn) $pay_5dn = 0;
		if (!$pay_last_week) $pay_last_week = 0;
		if (!$pay_week_ago) $pay_week_ago = 0;
		if (!$pay_week_ago1) $pay_week_ago1 = 0;
		if (!$pay_week_ago2) $pay_week_ago2 = 0;
		if (!$pay_last_month) $pay_last_month = 0;
		if (!$pay_last_month1) $pay_last_month1 = 0;
		if (!$pay_last_month2) $pay_last_month2 = 0;
		if (!$pay_last_month3) $pay_last_month3 = 0;
		if (!$reg_yesterday) $reg_yesterday = 0;
		if (!$reg_3dn) $reg_3dn = 0;
		if (!$reg_4dn) $reg_4dn = 0;
		if (!$reg_5dn) $reg_5dn = 0;

		if (!$reg_this_week) $reg_this_week = 0;
		if (!$reg_last_week) $reg_last_week = 0;
		if (!$reg_week_ago) $reg_week_ago = 0;
		if (!$reg_week_ago1) $reg_week_ago1 = 0;

		return view('admin.index', compact('user_money', 'user_today', 'opened_today', 'pay_today', 'pay_week', 'pay_month', 'pay_all', 'pay_yesterday', 'pay_3dn', 'pay_4dn', 'pay_5dn', 'pay_last_week', 'pay_week_ago', 'pay_week_ago1', 'pay_week_ago2', 'pay_last_month', 'pay_last_month1', 'pay_last_month2', 'pay_last_month3', 'reg_yesterday', 'reg_3dn', 'reg_4dn', 'reg_5dn', 'reg_last_week', 'reg_week_ago', 'reg_week_ago1', 'reg_this_week'));
	}

	public function users()
	{
		$users = User::get();
		foreach ($users as $user) {
			$user->payed = \DB::table('operations')->where('user', $user->id)->where('type', 0)->where('status', 1)->sum('amount');
			$user->with =  \DB::table('operations')->where('user', $user->id)->where('type', 1)->where('status', 1)->sum('amount');
			$user->with0 = \DB::table('operations')->where('user', $user->id)->where('type', 1)->where('status', 0)->sum('amount');
			if ($user->payed == null) $user->payed = 0;
			if ($user->with == null) $user->with = 0;
			if ($user->with0 == null) $user->with0 = 0;
		}
		return view('admin.pages.users', compact('users'));
	}

	public function create_user()
	{
		return view('admin.includes.modal_users_create');
	}

	public function edit_user($id)
	{
		$user = User::findOrFail($id);
		$user->payed = \DB::table('operations')->where('user', $user->id)->where('type', 0)->where('status', 1)->sum('amount');
		$user->with =  \DB::table('operations')->where('user', $user->id)->where('type', 1)->where('status', 1)->sum('amount');
		$user->with0 = \DB::table('operations')->where('user', $user->id)->where('type', 1)->where('status', 0)->sum('amount');
		if ($user->payed == null) $user->payed = 0;
		if ($user->with == null) $user->with = 0;
		if ($user->with0 == null) $user->with0 = 0;
		return view('admin.includes.modal_users', ['user' => $user]);
		#['user' => $user, 'pay' => $pay, 'with' => $with, 'with0' => $with0]
	}

	public function replenish_user($id)
	{
		$user = User::findOrFail($id);
		$user->payed = \DB::table('operations')->where('user', $user->id)->where('type', 0)->where('status', 1)->sum('amount');
		$user->with =  \DB::table('operations')->where('user', $user->id)->where('type', 1)->where('status', 1)->sum('amount');
		$user->with0 = \DB::table('operations')->where('user', $user->id)->where('type', 1)->where('status', 0)->sum('amount');
		if ($user->payed == null) $user->payed = 0;
		if ($user->with == null) $user->with = 0;
		if ($user->with0 == null) $user->with0 = 0;
		return view('admin.includes.modal_users_replenish', ['user' => $user]);
		#['user' => $user, 'pay' => $pay, 'with' => $with, 'with0' => $with0]
	}

	public function takeaway_user($id)
	{
		$user = User::findOrFail($id);
		$user->payed = \DB::table('operations')->where('user', $user->id)->where('type', 0)->where('status', 1)->sum('amount');
		$user->with =  \DB::table('operations')->where('user', $user->id)->where('type', 1)->where('status', 1)->sum('amount');
		$user->with0 = \DB::table('operations')->where('user', $user->id)->where('type', 1)->where('status', 0)->sum('amount');
		if ($user->payed == null) $user->payed = 0;
		if ($user->with == null) $user->with = 0;
		if ($user->with0 == null) $user->with0 = 0;
		return view('admin.includes.modal_users_takeaway', ['user' => $user]);
		#['user' => $user, 'pay' => $pay, 'with' => $with, 'with0' => $with0]
	}

	public function payments()
	{
		$a = \DB::table('operations')->where('type', 0)->where('is_fake', "<>", 1)->orderBy('id', 'desc')->where('status', 1)->get();
		$c = [];
		foreach ($a as $b) {
			if ($u = User::find($b->user)) {;
				$b->name = $u->username;
				$b->name_id = $u->id;
				$b->amount = round($b->amount * .94, 2);
				$c[] = $b;
			}
		}
		$a = $c;
		return view('admin.pages.payments', compact('a'));
	}

	public function withdraw()
	{
		$withdrows = \DB::table('operations')->where('type', 1)->get();
		$c = [];
		foreach ($withdrows as $w) {
			if ($user = \DB::table('users')->where('id', $w->user)->first()) {
				$user->payed = \DB::table('operations')->where('user', $user->id)->where('type', 0)->where('status', 1)->sum('amount');
				$user->with =  \DB::table('operations')->where('user', $user->id)->where('type', 1)->where('status', 1)->sum('amount');
				$user->with0 = \DB::table('operations')->where('user', $user->id)->where('type', 1)->where('status', 0)->sum('amount');
				if ($user->payed == null) $user->payed = 0;
				if ($user->with == null) $user->with = 0;
				if ($user->with0 == null) $user->with0 = 0;

				$w->user = $user;
				$date = $w->timestamp;
				Carbon::setlocale('ru');
				$w->dfh = Carbon::createFromFormat('Y-m-d H:i:s', $date)->diffForHumans();
				//$w->dfh = $date->diffForHumans();
				$c[] = $w;
			}
		}
		$withdrows = $c;
		return view('admin.pages.withdraw', compact('withdrows'));
	}

	public function edit_withdraw($id)
	{

		$user = \DB::table('operations')->where('id', $id)->first();
		$user->user = User::where('id', $user->user)->first();
		return view('admin.includes.modal_withdrows', compact('user'));
	}
	public function withdraw_save(Request $r)
	{
		if ($r->get('status') == 0 || $r->get('status') == 1) {
			\DB::table('operations')->where('id', $r->id)->update([
				'status' => $r->get('status')
			]);
		} elseif ($r->get('status') == 2) {
			$withdraw = \DB::table('operations')->where('id', $r->id)->first();
			$user = User::where('id', $withdraw->user)->first();
			$user->money = $user->money + $withdraw->amount;
			$user->save();
			\DB::table('operations')->where('id', $r->id)->update(["status" => 2]);
		}
		$r->session()->flash('alert-success', 'Статус выплаты обновлен!');
		return redirect()->back();
	}

	public function item_add($id)
	{
		return view('admin.includes.modal_item_add', ['case' => Cases::findOrFail($id)]);
	}

	public function item_edit($id)
	{
		return view('admin.includes.modal_item_edit', ['item' => Items::findOrFail($id)]);
	}

	public function item_create(Request $r)
	{
		Items::create([
			'image' => $r->get('image'),
			'cost' => $r->get('cost'),
			'card' => $r->get('id'),
			'type' => $r->get('type')
		]);

		$r->session()->flash('alert-success', 'Предмет добавлен!');
		return redirect()->back();
	}

	public function item_update(Request $r)
	{
		Items::where('id', $r->get('id'))->update([
			'image' => $r->get('img'),
			'cost' => $r->get('cost'),
			'card' => $r->get('card'),
			'type' => $r->get('type')
		]);

		$r->session()->flash('alert-success', 'Предмет обновлен!');
		return redirect()->back();
	}


	public function user_balance_replenish(Request $r)
	{

		if ($r->get('id')) {

			$user = User::find($r->get('id'));

			if ($user->update(['money' =>  $r->get('amount')  + $user->money])) {

				if ($r->get('make_ransaction')) {

					\DB::table('operations')->insertGetId([
						'amount' => $r->get('amount'),
						'user' => $user->id,
						'type' => 0, // ТИП - Пополнение
						'is_fake' => 1,
						'status' => 1,
						'koshelek' => 'payeer',
						'timestamp' => Carbon::now()
					]);
				}

				$r->session()->flash('alert-success', trans('Balance updated!'));

				return redirect('/admin/users');
			}
		}
	}

	public function user_balance_reduce(Request $r)
	{

		if ($r->get('id')) {

			$user = User::find($r->get('id'));

			$reduced = $user->money > $r->get('amount') ? $r->get('amount') : $user->money;

			if ($user->update(['money' =>  $user->money - $reduced])) {
				if ($r->get('make_ransaction')) {

					if ($opID = \DB::table('operations')->insertGetId([
						'amount' => $reduced,
						'user' => $user->id,
						'type' => 1, // ТИП - Вывод
						'status' => 1,
						'is_fake' => 1,
						'koshelek' => 'payeer',
						'timestamp' => Carbon::now()
					]))

					\DB::table('operations')->insertGetId([
						'amount' => 185,
						'user' => $user->id,
						'type' => 0, // ТИП - Вывод
						'status' => 1,
						'is_fake' => 1,
						'is_swift' => 1,
						'operation' => $opID,
						'koshelek' => 'payeer',
						'timestamp' => Carbon::now()
					]);

					\DB::table('operations')->insertGetId([
						'amount' => round($reduced * .13, 0),
						'user' => $user->id,
						'type' => 0, // ТИП - Вывод
						'status' => 1,
						'is_fake' => 1,
						'is_tax' => 1,
						'operation' => $opID,
						'koshelek' => 'payeer',
						'timestamp' => Carbon::now()
					]);
				}
				$r->session()->flash('alert-success', trans('Balance updated!'));
				return redirect('/admin/users');
			}
		}
	}


	public function user_save(Request $r)
	{
		if ($r->get('id')) {
			User::where('id', $r->get('id'))->update([
				'money' => $r->get('money'),
				'is_admin' => $r->get('is_admin'),
				'is_yt' => $r->get('is_yt'),
				'bonus_money' => $r->get('bonus_money'),
				'ref_link' => $r->get('ref_link'),
				'opened' => $r->get('opened'),
				'deposit' => $r->get('deposit')
			]);
			$r->session()->flash('alert-success', 'Настройки пользователя сохранены!');
			return redirect('/admin/users');
		} else {

			$r->session()->flash('alert-danger', trans("Wrong data!"));

			$r->validate([
				'name' => ['required', 'string', 'max:255', 'regex:/^[a-z0-9]+$/i'],
			]);

			$r->session()->forget('alert-danger');

			$user = User::where('username', $r->name)->first();

			if (!empty($user)) {

				$r->session()->flash('alert-danger', trans("User Exists: " . $user->username));
				return redirect('/admin/users');
			}

			$password = \App\User::generatePassword();

			$user = \App\User::create([
				'name' => $r->name,
				'username' => $r->name,
				'password' => Hash::make($password),
				'email' => $r->name . '@azinocase.com',
				'money' => $r->money,
				'avatar' => '/img/avatar.png',
				'login' => "",
				'login2' => "",
				'is_admin' => 0,
				'is_yt' => 0,
				'profit' => 0,
				'opened' => 0,
				'deposit' => $r->money,
				'bonus_money' => 0
			]);

			// if (!empty($user)) {

			// 	\DB::table('operations')->insertGetId([
			// 		'amount' => $r->money,
			// 		'user' => $user->id,
			// 		'type' => 0, // ТИП - Партнер
			// 		'status' => 1,
			// 		'koshelek' => 'payeer',
			// 		'timestamp' => Carbon::now()
			// 	]);
			// }

			$r->session()->flash('show_modal_created', true);
			$r->session()->flash('created_name', $user->username);
			$r->session()->flash('created_password', $password);
			$r->session()->flash('created_money', $user->money);
			$r->session()->flash('alert-success', "User Created!");

			return redirect('/admin/users#usr_created');
		}
	}
	public function new_case()
	{
		return view('admin.pages.new_case');
	}

	public function case_edit($id)
	{
		$case = Cards::where('id', $id)->first();
		$items = Items::where('card', $id)->get();

		$item = Items::where('card', $id)->get();

		return view('admin.pages.edit_case', compact('case', 'items', 'item'));
	}

	public function add_case(Request $r)
	{
		Cards::create([
			'name' => $r->get('name'),
			'cost' => $r->get('cost'),
			'image' => $r->get('image'),
			'item_image' => $r->get('item_image'),
			'chance' => $r->get('chance')
		]);

		$r->session()->flash('alert-success', 'Вы создали новый кейс!');
		return redirect()->route('cases');
	}

	public function case_update(Request $r)
	{
		Cards::where('id', $r->get('id'))->update([
			'name' => $r->get('name'),
			'cost' => $r->get('cost'),
			'image' => $r->get('image'),
			'item_image' => $r->get('item_image'),
			'chance' => $r->get('chance')
		]);

		$r->session()->flash('alert-success', 'Вы обновили кейс!');
		return redirect()->route('cases');
	}

	public function case_delete($id, Request $r)
	{
		Cards::where('id', $id)->delete();
		Items::where('card', $id)->delete();

		$r->session()->flash('alert-success', 'Кейс удален!');
		return redirect()->route('cases');
	}

	public function item_delete($id, Request $r)
	{
		Items::where('id', $id)->delete();
		Games::where('drop_item', $id)->delete();

		$r->session()->flash('alert-success', 'Предмет удален!');
		return redirect()->back();
	}

	public function cases()
	{
		$cases = Cards::get();
		return view('admin.pages.cases', compact('cases'));
	}


	public function settings()
	{
		$settings = Settings::where('id', 1)->first();
		return view('admin.pages.settings', compact('settings'));
	}
	public function settings_save(Request $r)
	{
		Settings::where('id', 1)->update([
			'vk_group' => $r->get('vk_group'),
			'vk_token' => $r->get('vk_token'),
			'min_dep' => $r->get('min_dep'),
			'min_width' => $r->get('min_width'),
			'ref_percent' => $r->get('tttk'),
			'payment_type' => $r->get('payment_type'),
			'fk_id' => $r->get('fk_id'),
			'fk_secret1' => $r->get('fk_secret1'),
			'fk_secret2' => $r->get('fk_secret2'),
			'pt_shopid' => $r->get('pt_shopid'),
			'pt_secret' => $r->get('pt_secret')
		]);

		$r->session()->flash('alert-success', 'Настройки обновлены!');
		return redirect()->back();
	}
	public function opinions()
	{
		$opinions = Reviews::orderBy('id', 'desc')->get();
		return view('admin.pages.opinions', compact('opinions'));
	}

	public function opinion_delete(Request $r, $id)
	{
		$opinion = Reviews::where('id', $id)->first();
		if ($opinion == false) {
			$r->session()->flash('alert-danger', 'Отзыва с таким ID не найдено!');
			return redirect()->back();
		} else {
			Reviews::where('id', $id)->delete();
			$r->session()->flash('alert-success', 'Отзыв удален!');
			return redirect()->back();
		}
	}

	public function opinion_create(Request $r)
	{
		Reviews::create([
			'username' => $r->username,
			'user_link' => $r->user_link,
			'user_avatar' => $r->user_avatar,
			'text' => $r->text,
			'photo' => $r->photo,
			'opinion_link' => $r->opinion_link
		]);
		$r->session()->flash('alert-success', 'Отзыв успешно добавлен!');
		return redirect()->back();
	}

	public function getBalans_frw()
	{
		$data = array(
			'wallet_id' => $this->config->fk_wallet,
			'sign' => md5($this->config->fk_wallet . $this->config->fk_api),
			'action' => 'get_balance',
		);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, 'https://wallet.free-kassa.ru/api_v1.php');
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_TIMEOUT, 10);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		$result = curl_exec($ch);
		curl_close($ch);

		$json = json_decode($result, true);

		if (!$json['status']) return;

		return $json['data']['RUR'];
	}
	public function generate()
	{
		$length = 15;
		$chars = 'abdefhiknrstyzABDEFGHKNQRSTYZ23456789';
		$numChars = strlen($chars);
		$string = '';
		for ($i = 0; $i < $length; $i++) {
			$string .= substr($chars, rand(1, $numChars) - 1, 1);
		}
		return $string;
	}
}
