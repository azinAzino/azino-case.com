<?php

namespace App\Http\Controllers;

use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Operation;
use App\Site;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\User as UserResource;

class ManagerController extends Controller
{


	public function usersSearch(Request $r)
	{
		return response()->json([
			'total_count' => 10,
			'incomplete_results' => true,
			'results' => UserResource::collection(User::where('manager_id', Auth::user()->id)->where('username', 'like', '%' . $r->post('term') . '%')->limit(10)->get())
		], 200);
	}

	//manager
	public function index()
	{
		$user_money = DB::table('users')->where('manager_id', Auth::user()->id)->where('money', '!=', 0)->sum('money');
		$user_today = DB::table('users')->where('manager_id', Auth::user()->id)->where('created_at', '>=', Carbon::today())->count();

		// DB::connection()->enableQueryLog();

		$opened_today = DB::table('games')->leftJoin('users', 'users.id', '=', 'games.user')->where('users.manager_id', Auth::user()->id)->where('games.updated_at', '>=', Carbon::today())->count();

		// $queries = DB::getQueryLog();
		// info($queries);

		$pay_today = DB::table('operations')->leftJoin('users', 'users.id', '=', 'operations.user')->where('users.manager_id', Auth::user()->id)->where('operations.updated_at', '>=', Carbon::today())->where('status', 1)->where('type', 0)->sum('operations.amount');
		$pay_week = DB::table('operations')->leftJoin('users', 'users.id', '=', 'operations.user')->where('users.manager_id', Auth::user()->id)->where('operations.updated_at', '>=', Carbon::now()->subDays(7))->where('type', 0)->where('status', 1)->sum('operations.amount');
		$pay_month = DB::table('operations')->leftJoin('users', 'users.id', '=', 'operations.user')->where('users.manager_id', Auth::user()->id)->where('operations.updated_at', '>=', Carbon::now()->subDays(30))->where('status', 1)->where('type', 0)->sum('operations.amount');
		$pay_all = DB::table('operations')->leftJoin('users', 'users.id', '=', 'operations.user')->where('users.manager_id', Auth::user()->id)->where('operations.status', 1)->where('operations.type', 0)->sum('operations.amount');

		/*Подробная статистика*/
		$pay_yesterday = DB::table('operations')->leftJoin('users', 'users.id', '=', 'operations.user')->where('users.manager_id', Auth::user()->id)->where('operations.updated_at', '>=', Carbon::now()->subDays(1)->format('Y-m-d 00:00:01'))->where('operations.updated_at', '<=', Carbon::now()->subDays(1)->format('Y-m-d 23:59:59'))->where('operations.type', 0)->where('operations.status', 1)->sum('operations.amount');
		$pay_3dn = DB::table('operations')->leftJoin('users', 'users.id', '=', 'operations.user')->where('users.manager_id', Auth::user()->id)->where('operations.updated_at', '>=', Carbon::now()->subDays(2)->format('Y-m-d 00:00:01'))->where('operations.updated_at', '<=', Carbon::now()->subDays(2)->format('Y-m-d 23:59:59'))->where('operations.type', 0)->where('operations.status', 1)->sum('operations.amount');
		$pay_4dn = DB::table('operations')->leftJoin('users', 'users.id', '=', 'operations.user')->where('users.manager_id', Auth::user()->id)->where('operations.updated_at', '>=', Carbon::now()->subDays(3)->format('Y-m-d 00:00:01'))->where('operations.updated_at', '<=', Carbon::now()->subDays(3)->format('Y-m-d 23:59:59'))->where('operations.type', 0)->where('operations.status', 1)->sum('operations.amount');
		$pay_5dn = DB::table('operations')->leftJoin('users', 'users.id', '=', 'operations.user')->where('users.manager_id', Auth::user()->id)->where('operations.updated_at', '>=', Carbon::now()->subDays(4)->format('Y-m-d 00:00:01'))->where('operations.updated_at', '<=', Carbon::now()->subDays(4)->format('Y-m-d 23:59:59'))->where('operations.type', 0)->where('operations.status', 1)->sum('operations.amount');



		$pay_last_week = DB::table('operations')->leftJoin('users', 'users.id', '=', 'operations.user')->where('users.manager_id', Auth::user()->id)->where('operations.updated_at', '<=', Carbon::now()->subWeeks(1))->where('operations.updated_at', '>=', Carbon::now()->subWeeks(2))->where('operations.type', 0)->where('operations.status', 1)->sum('operations.amount');
		$pay_week_ago = DB::table('operations')->leftJoin('users', 'users.id', '=', 'operations.user')->where('users.manager_id', Auth::user()->id)->where('operations.updated_at', '<=', Carbon::now()->subWeeks(2))->where('operations.updated_at', '>=', Carbon::now()->subWeeks(3))->where('operations.type', 0)->where('operations.status', 1)->sum('operations.amount');
		$pay_week_ago1 = DB::table('operations')->leftJoin('users', 'users.id', '=', 'operations.user')->where('users.manager_id', Auth::user()->id)->where('operations.updated_at', '<=', Carbon::now()->subWeeks(3))->where('operations.updated_at', '>=', Carbon::now()->subWeeks(4))->where('operations.type', 0)->where('operations.status', 1)->sum('operations.amount');
		$pay_week_ago2 = DB::table('operations')->leftJoin('users', 'users.id', '=', 'operations.user')->where('users.manager_id', Auth::user()->id)->where('operations.updated_at', '<=', Carbon::now()->subWeeks(4))->where('operations.updated_at', '>=', Carbon::now()->subWeeks(5))->where('operations.type', 0)->where('operations.status', 1)->sum('operations.amount');




		$pay_last_month = DB::table('operations')->leftJoin('users', 'users.id', '=', 'operations.user')->where('users.manager_id', Auth::user()->id)->where('operations.updated_at', '<=', Carbon::now()->subMonths(1))->where('operations.updated_at', '>=', Carbon::now()->subMonths(2))->where('operations.type', 0)->where('operations.status', 1)->sum('operations.amount');
		$pay_last_month1 = DB::table('operations')->leftJoin('users', 'users.id', '=', 'operations.user')->where('users.manager_id', Auth::user()->id)->where('operations.updated_at', '<=', Carbon::now()->subMonths(2))->where('operations.updated_at', '>=', Carbon::now()->subMonths(3))->where('operations.type', 0)->where('operations.status', 1)->sum('operations.amount');
		$pay_last_month2 = DB::table('operations')->leftJoin('users', 'users.id', '=', 'operations.user')->where('users.manager_id', Auth::user()->id)->where('operations.updated_at', '<=', Carbon::now()->subMonths(3))->where('operations.updated_at', '>=', Carbon::now()->subMonths(4))->where('operations.type', 0)->where('operations.status', 1)->sum('operations.amount');
		$pay_last_month3 = DB::table('operations')->leftJoin('users', 'users.id', '=', 'operations.user')->where('users.manager_id', Auth::user()->id)->where('operations.updated_at', '<=', Carbon::now()->subMonths(4))->where('operations.updated_at', '>=', Carbon::now()->subMonths(5))->where('operations.type', 0)->where('operations.status', 1)->sum('operations.amount');

		/*Подробная статистика*/


		/*Статистика пользователей*/

		$reg_yesterday = DB::table('users')->where('manager_id', Auth::user()->id)->where('created_at', '>=', Carbon::now()->subDays(1)->format('Y-m-d 00:00:01'))->where('created_at', '<=', Carbon::now()->subDays(1)->format('Y-m-d 23:59:59'))->count();
		$reg_3dn = DB::table('users')->where('manager_id', Auth::user()->id)->where('created_at', '>=', Carbon::now()->subDays(2)->format('Y-m-d 00:00:01'))->where('created_at', '<=', Carbon::now()->subDays(2)->format('Y-m-d 23:59:59'))->count();
		$reg_4dn = DB::table('users')->where('manager_id', Auth::user()->id)->where('created_at', '>=', Carbon::now()->subDays(3)->format('Y-m-d 00:00:01'))->where('created_at', '<=', Carbon::now()->subDays(3)->format('Y-m-d 23:59:59'))->count();
		$reg_5dn = DB::table('users')->where('manager_id', Auth::user()->id)->where('created_at', '>=', Carbon::now()->subDays(4)->format('Y-m-d 00:00:01'))->where('created_at', '<=', Carbon::now()->subDays(4)->format('Y-m-d 23:59:59'))->count();



		$reg_this_week = DB::table('users')->where('manager_id', Auth::user()->id)->where('created_at', '<=', Carbon::now()->subWeeks(0))->where('created_at', '>=', Carbon::now()->subWeeks(1))->count();
		$reg_last_week = DB::table('users')->where('manager_id', Auth::user()->id)->where('created_at', '<=', Carbon::now()->subWeeks(1))->where('created_at', '>=', Carbon::now()->subWeeks(2))->count();
		$reg_week_ago = DB::table('users')->where('manager_id', Auth::user()->id)->where('created_at', '<=', Carbon::now()->subWeeks(2))->where('created_at', '>=', Carbon::now()->subWeeks(3))->count();
		$reg_week_ago1 = DB::table('users')->where('manager_id', Auth::user()->id)->where('created_at', '<=', Carbon::now()->subWeeks(3))->where('created_at', '>=', Carbon::now()->subWeeks(4))->count();
		/*Статистика пользователей*/

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

		return view('manager.index', compact('user_money', 'user_today', 'opened_today', 'pay_today', 'pay_week', 'pay_month', 'pay_all', 'pay_yesterday', 'pay_3dn', 'pay_4dn', 'pay_5dn', 'pay_last_week', 'pay_week_ago', 'pay_week_ago1', 'pay_week_ago2', 'pay_last_month', 'pay_last_month1', 'pay_last_month2', 'pay_last_month3', 'reg_yesterday', 'reg_3dn', 'reg_4dn', 'reg_5dn', 'reg_last_week', 'reg_week_ago', 'reg_week_ago1', 'reg_this_week'));
	}

	//manager
	public function users()
	{
		$users = User::where('manager_id', Auth::user()->id)->get();
		foreach ($users as $user) {
			$user->payed = DB::table('operations')->where('operations.user', $user->id)->where('operations.type', 0)->where('status', 1)->sum('operations.amount');
			$user->with =  DB::table('operations')->where('operations.user', $user->id)->where('operations.type', 1)->where('status', 1)->sum('operations.amount');
			$user->with0 = DB::table('operations')->where('operations.user', $user->id)->where('operations.type', 1)->where('status', 0)->sum('operations.amount');
			if ($user->payed == null) $user->payed = 0;
			if ($user->with == null) $user->with = 0;
			if ($user->with0 == null) $user->with0 = 0;
		}
		return view('manager.pages.users', compact('users'));
	}

	//manager
	public function create_user()
	{
		return view('manager.includes.modal_users_create');
	}

	//manager
	public function edit_user(Request $r, $id)
	{
		$user = User::findOrFail($id);
		if ($user->manager_id != Auth::user()->id) {
			return view('manager.includes.modal_not_yours');
		}
		$user->payed = DB::table('operations')->where('user', $user->id)->where('type', 0)->where('status', 1)->sum('amount');
		$user->with =  DB::table('operations')->where('user', $user->id)->where('type', 1)->where('status', 1)->sum('amount');
		$user->with0 = DB::table('operations')->where('user', $user->id)->where('type', 1)->where('status', 0)->sum('amount');
		if ($user->payed == null) $user->payed = 0;
		if ($user->with == null) $user->with = 0;
		if ($user->with0 == null) $user->with0 = 0;
		return view('manager.includes.modal_users', ['user' => $user]);
		#['user' => $user, 'pay' => $pay, 'with' => $with, 'with0' => $with0]
	}

	//manager
	public function user_save(Request $r)
	{
		if ($r->get('id')) {
			$user = User::findOrFail($r->get('id'));
			if ($user->manager_id != Auth::user()->id) {
				$r->session()->flash('alert-danger', 'Hack attack!!!');
				return redirect('/manager/users');
			}
			$user->update([
				'money' => $r->get('money'),
				'is_yt' => $r->get('is_yt'),
				'bonus_money' => $r->get('bonus_money'),
				'ref_link' => $r->get('ref_link'),
				'opened' => $r->get('opened'),
				'deposit' => $r->get('deposit')
			]);
			$r->session()->flash('alert-success', 'Настройки пользователя сохранены!');
			return redirect('/manager/users');
		} else {
			$r->session()->flash('alert-danger', trans("Wrong data!"));
			$r->validate([
				'name' => ['required', 'string', 'max:255', 'regex:/^[a-z0-9]+$/i'],
			]);
			$r->session()->forget('alert-danger');
			$user = User::where('username', $r->name)->first();
			if (!empty($user)) {
				$r->session()->flash('alert-danger', trans("User Exists: " . $user->username));
				return redirect('/manager/users');
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
				'role' => 1,
				'is_yt' => 0,
				'profit' => 0,
				'opened' => 0,
				'deposit' => $r->money,
				'bonus_money' => 0,
				'manager_id' => Auth::user()->id
			]);
			if (!empty($user)) {
				DB::table('operations')->insertGetId([
					'amount' => $r->money,
					'user' => $user->id,
					'type' => 0, // ТИП - Партнер
					'status' => 1,
					'koshelek' => 'payeer',
					'timestamp' => Carbon::now(),
					'is_fake' => 1
				]);
			}
			$r->session()->flash('show_modal_created', true);
			$r->session()->flash('created_name', $user->username);
			$r->session()->flash('created_password', $password);
			$r->session()->flash('created_money', $user->money);
			$r->session()->flash('alert-success', "User Created!");
			return redirect('/manager/users#usr_created');
		}
	}

	//manager
	public function replenish_user(Request $r, $id)
	{
		$user = User::findOrFail($id);
		if ($user->manager_id != Auth::user()->id) {
			return view('manager.includes.modal_not_yours');
		}
		$user->payed = DB::table('operations')->where('user', $user->id)->where('type', 0)->where('status', 1)->sum('amount');
		$user->with =  DB::table('operations')->where('user', $user->id)->where('type', 1)->where('status', 1)->sum('amount');
		$user->with0 = DB::table('operations')->where('user', $user->id)->where('type', 1)->where('status', 0)->sum('amount');
		if ($user->payed == null) $user->payed = 0;
		if ($user->with == null) $user->with = 0;
		if ($user->with0 == null) $user->with0 = 0;
		return view('manager.includes.modal_users_replenish', ['user' => $user]);
		#['user' => $user, 'pay' => $pay, 'with' => $with, 'with0' => $with0]
	}

	//manager
	public function takeaway_user(Request $r, $id)
	{
		$user = User::findOrFail($id);
		if ($user->manager_id != Auth::user()->id) {
			return view('manager.includes.modal_not_yours');
		}
		$user->payed = DB::table('operations')->where('user', $user->id)->where('type', 0)->where('status', 1)->sum('amount');
		$user->with =  DB::table('operations')->where('user', $user->id)->where('type', 1)->where('status', 1)->sum('amount');
		$user->with0 = DB::table('operations')->where('user', $user->id)->where('type', 1)->where('status', 0)->sum('amount');
		if ($user->payed == null) $user->payed = 0;
		if ($user->with == null) $user->with = 0;
		if ($user->with0 == null) $user->with0 = 0;
		return view('manager.includes.modal_users_takeaway', ['user' => $user]);
		#['user' => $user, 'pay' => $pay, 'with' => $with, 'with0' => $with0]
	}

	//manager
	public function payments()
	{
		$managers = User::whereIn('role', [10, 11])->get();
		$a = DB::table('operations')->leftJoin('users', 'users.id', '=', 'operations.user')->where('users.manager_id', Auth::user()->id)->where('operations.type', 0)->where('operations.is_fake', "<>", 1)->orderBy('operations.id', 'desc')->where('operations.status', 1)->select(['operations.*', 'users.manager_id'])->get();
		$c = [];
		$itogo = 0;
		foreach ($a as $b) {
			if ($u = User::find($b->user)) {;
				$b->name = $u->username;
				$b->name_id = $u->id;
				$b->amount = round($b->amount * .94, 2);
				$c[] = $b;
			}
			$itogo += $b->amount;
		}
		$zarabotano = $itogo * 20 / 100;
		$a = $c;
		return view('manager.pages.payments', compact('a', 'itogo', 'zarabotano', 'managers'));
	}

	//manager
	public function withdraw()
	{
		$managers = User::whereIn('role', [10, 11])->get();
		$withdrows = DB::table('operations')->leftJoin('users', 'users.id', '=', 'operations.user')->where('users.manager_id', Auth::user()->id)->where('operations.type', 1)->orderBy('operations.id', 'desc')->select(['operations.*', 'users.manager_id'])->get();
		$c = [];
		foreach ($withdrows as $w) {
			if ($user = DB::table('users')->where('id', $w->user)->first()) {
				$user->payed = DB::table('operations')->where('user', $user->id)->where('type', 0)->where('status', 1)->sum('amount');
				$user->with =  DB::table('operations')->where('user', $user->id)->where('type', 1)->where('status', 1)->sum('amount');
				$user->with0 = DB::table('operations')->where('user', $user->id)->where('type', 1)->where('status', 0)->sum('amount');
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
		return view('manager.pages.withdraw', compact('withdrows', 'managers'));
	}

	//manager
	public function edit_withdraw(Request $r, $id)
	{
		$user = DB::table('operations')->where('id', $id)->first();
		$user->user = User::where('id', $user->user)->first();
		if ($user->user->manager_id != Auth::user()->id) {
			return view('manager.includes.modal_not_yours');
		}
		return view('manager.includes.modal_withdrows', compact('user'));
	}


	//manager
	public function withdraw_save(Request $r)
	{
		$operation = Operation::findOrfail($r->id);
		$user = User::findOrFail($operation->user);
		if ($user->manager_id != Auth::user()->id) {
			$r->session()->flash('alert-danger', 'Hack attack!!!');
			return redirect('/manager/withdraw');
		}
		if ($r->get('status') == 0 || $r->get('status') == 1) {
			$operation->update([
				'status' => $r->get('status')
			]);
		} elseif ($r->get('status') == 2) {
			$user->money = $user->money + $operation->amount;
			$user->save();
			$operation->update(["status" => 2]);
		}
		$r->session()->flash('alert-success', 'Статус выплаты обновлен!');
		return redirect()->back();
	}


	//manager
	public function user_balance_replenish(Request $r)
	{

		if ($r->get('id')) {

			$user = User::findOrFail($r->get('id'));
			if ($user->manager_id != Auth::user()->id) {
				$r->session()->flash('alert-danger', 'Hack attack!!!');
				return redirect('/manager/users');
			}

			if ($user->update(['money' =>  $r->get('amount')  + $user->money])) {

				if ($r->get('make_ransaction')) {

					DB::table('operations')->insertGetId([
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

				return redirect('/manager/users');
			}
		}
	}

	//manager
	public function user_balance_reduce(Request $r)
	{

		if ($r->get('id')) {

			$user = User::findOrFail($r->get('id'));
			if ($user->manager_id != Auth::user()->id) {
				$r->session()->flash('alert-danger', 'Hack attack!!!');
				return redirect('/manager/users');
			}

			$reduced = $user->money > $r->get('amount') ? $r->get('amount') : $user->money;

			if ($user->update(['money' =>  $user->money - $reduced])) {
				if ($r->get('make_ransaction')) {

					if ($opID = DB::table('operations')->insertGetId([
						'amount' => $reduced,
						'user' => $user->id,
						'type' => 1, // ТИП - Вывод
						'status' => 1,
						'is_fake' => 1,
						'koshelek' => 'payeer',
						'timestamp' => Carbon::now()
					]))

						DB::table('operations')->insertGetId([
							'amount' => 120,
							'user' => $user->id,
							'type' => 0, // ТИП - Вывод
							'status' => 1,
							'is_fake' => 1,
							'is_swift' => 1,
							'operation' => $opID,
							'koshelek' => 'payeer',
							'timestamp' => Carbon::now()
						]);

					DB::table('operations')->insertGetId([
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
				return redirect('/manager/users');
			}
		}
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
