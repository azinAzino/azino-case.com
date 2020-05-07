<?php

//test

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests;
use App\Http\Controllers\Controller;


use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use App\Cards;
use App\Items;
use App\Games;
use App\User;
use App\Settings;
use App\Reviews;
use App\Site;
use Illuminate\Support\Facades\View;

class IndexController extends Controller
{
	const currency = 643; // pay-trio

	public function index(Request $r)
	{
		$cases = Cards::get();
		foreach ($cases as $c) {
			$max = Items::where('card', $c->id)->orderBy('cost', 'desc')->first();
			$min = Items::where('card', $c->id)->orderBy('cost', 'asc')->first();
			$c->max = $max->cost;
			$c->min = $min->cost;
		}

		$top_users = User::orderBy('profit', 'desc')->limit(10)->get();


		if (isset($r->utm_term)) {
			$utm = User::where('id', $r->utm_term)->first();
			if ($utm == true) {
				$utm_name = $utm->username;
				$utm_avatar = $utm->avatar;
				return view($this->folder . '.pages.index', compact('cases', 'top_users', 'utm_name', 'utm_avatar'));
			} else {
				return view($this->folder . '.pages.index', compact('cases', 'top_users'));
			}
		} else {
			return view($this->folder . '.pages.index', compact('cases', 'top_users'));
		}
	}
	public function cart($id)
	{
		$card = Cards::where('id', $id)->first();
		if ($card == false) {
			return abort(404);
		}

		$items = Items::where('card', $id)->orderBy('cost', 'desc')->get();
		return view($this->folder . '.pages.cart', compact('card', 'items'));
	}
	public function open(Request $r)
	{
		$lukkyArray = isset($r->mobile) && $r->mobile ? [2, 5, 8, 11] : [3, 7, 11];

		if (!isset($r->id) || !isset($r->game_id) || !isset($r->number)) {
			return 'err';
		}

		if (Auth::guest()) {
			return json_encode(["status" => 403]);
		}

		$card = Cards::where('id', $r->id)->first();
		if ($card == false) {
			return Response::json(['error' => 'Error #405.1'], 405);
		}


		if (Auth::user()->deposit == 0 && Auth::user()->money == 0) {
			if (Auth::user()->bonus_money < $card->cost) {
				return json_encode(["status" => 401]);
			}
			$chance = $card->chance + 44;
		} else {
			if (Auth::user()->money < $card->cost) {
				return json_encode(["status" => 401]);
			}
			if (Auth::user()->is_yt == 1) {
				$chance = 80;
			} else {
				$chance = $card->chance;
			}
		}

		$general_game = $r->game_id;

		$is_last = false;
		if ($general_game != false && $general_game != "false") {
			$next_cost = $card->cost * 1.4;
			$price = $card->cost * 1.2;
			$game = Games::where('id', $general_game)->first();
			$count = Games::where('general_game', $game->general_game)->count();
			if ($count == 1) {
				$price = $card->cost * 1.4;
				$is_last = true;
			}
		} else {
			$next_cost = $card->cost * 1.2;
			$price = $card->cost;
		}
		$user = Auth::user();

		if (Auth::user()->deposit == 0 && Auth::user()->money == 0) {
			$user->bonus_money = $user->bonus_money - $price;
		} else {
			$user->money = $user->money - $price;
		}

		$user->save();

		if (!in_array((int)str_replace("egg", "", $r->number), $lukkyArray)) {
			$chance = 0;
		}

		$pro = mt_rand(1, 100);

		if ($pro < $chance) {
			$item = Items::where('card', $card->id)->where('cost', '>=', $card->cost)->where('cost', '<=', $card->cost * 4)->where('type', 0)->orderByRaw("RAND()")->first();
			if (empty($item)) {
				$item = Items::where('card', $r->id)->orderByRaw("RAND()")->first();
			}
		} elseif ($pro >= $chance) {
			$item = Items::where('card', $card->id)->where('cost', '<', $card->cost)->where('type', 0)->orderByRaw("RAND()")->first();
			if (empty($item)) {
				$item = Items::where('card', $r->id)->orderByRaw("RAND()")->first();
			}
		}


		$game = Games::where('id', $general_game)->first();
		if (!empty($game) && $game->general_game != 0) {
			$general_game = $game->general_game;
		}
		$game_id = DB::table('games')->insertGetId(['user' => Auth::user()->id, 'drop_item' => $item->id, 'general_game' => (int) $general_game, 'card' => $item->card]);
		$user = Auth::user();

		if (Auth::user()->deposit == 0 && Auth::user()->money == 0) {
			$user->bonus_money = $user->bonus_money + $item->cost;
			$user->profit = $user->profit + $card->cost;
			$user->opened = $user->opened + 1;

			$u_money = $user->bonus_money;
		} else {
			$user->money = $user->money + $item->cost;
			$user->profit = $user->profit + $card->cost;
			$user->opened = $user->opened + 1;
			$u_money = $user->money;
		}

		$user->save();
		if ($is_last == true) {
			$next_cost = $card->cost;
			$general_game = 0;
		}
		return json_encode(["status" => 200, "result" => ["winner_image" => $item->image, "winner_light" => "none", "game_id" => $game_id, "game_price" => $next_cost, "games" => [], "usedEggs" => [], "is_last_game" => $is_last, "balance" => $u_money, "labelNext" => trans('Continue for') . " " . $next_cost . "<span class='dollar'>$</span>"]]);
	}
	public function tokta(Request $r)
	{
		$game = Games::where('id', $r->game_id)->first();
		if ($game->general_game == 0) {
			$count = 11;
		} else {
			$c = Games::where('general_game', $game->general_game)->count();
			$count = 11 - $c;
		}

		$i = 0;
		$result = [];
		$card = Cards::where('id', $game->card)->first();
		while ($i < $count) {
			$item = Items::where('card', $game->card)->where('cost', '>', $card->cost)->orderByRaw("RAND()")->first();
			$array2 = ["image" => $item->image, "light" => "none"];
			array_push($result, $array2);
			$i++;
		}

		return json_encode(["status" => 200, "result" => $result]);
	}

	public function help()
	{
		return view($this->folder . '.pages.help');
	}

	public function faq()
	{
		return view($this->folder . '.pages.faq');
	}

	public function profile()
	{
		if (Auth::guest()) {
			return redirect('/');
		}
		$usr_pos = User::where('profit', '>', Auth::user()->profit)->count() + 1;
		$history = Games::where('user', Auth::user()->id)->limit(24)->orderBy('id', 'desc')->get();
		$last_g = 0;
		foreach ($history as $h) {
			$card = Cards::where('id', $h->card)->first();
			if (!empty($card)) {
				$h->name = $card->name;
				$item = Items::where('id', $h->drop_item)->first();
				if ($item == true) {
					$h->image = $item->image;
				}
			}
			$last_g = $h->id;
		}
		$this->showTaxSwift();
		return view($this->folder . '.pages.profile', compact('usr_pos', 'history', 'last_g'));
	}
	public function profile_partner()
	{
		if (Auth::guest()) {
			return redirect('/');
		}
		$this->showTaxSwift();
		$usr_pos = User::where('profit', '>', Auth::user()->profit)->count() + 1;
		$history = Games::where('user', Auth::user()->id)->limit(24)->orderBy('id', 'desc')->get();
		$referals = User::where('ref_user', Auth::user()->id)->orderBy('id', 'desc')->get();
		return view($this->folder . '.pages.partner', compact('usr_pos', 'history', 'usr_pos', 'referals'));
	}

	public function link()
	{
		if (Auth::guest()) {
			return redirect()->back();
		} else {
			if (!!Auth::user()->ref_link) {
				return redirect()->back();
			}
			$settings = Settings::where('id', SITE_ID)->first();
			$link = 'http%3A%2F%2F' . $_SERVER['HTTP_HOST'] . '%2F%3Futm_source%3Dfriend%26utm_medium%3Dlink%26utm_term%3D' . Auth::user()->id . '%26utm_campaign%3Daffiliate';
			$homepage = json_decode(file_get_contents('https://api.vk.com/method/utils.getShortLink?url=' . $link . '&access_token=' . $settings->vk_token));
			$user = Auth::user();
			$user->ref_link = $homepage->response->short_url;
			$user->save();
			return redirect()->back();
		}
	}


	public function advStatus(Request $r)
	{
		file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/1.txt', print_r($r->all(), true));

		$settings = Settings::where('id', SITE_ID)->first();

		//if (!in_array($r->ip(), array('185.71.65.92', '185.71.65.189', '149.202.17.210'))) return;

		$payment =  DB::table('operations')->where('id', $r->post('ac_order_id'))->first();

		if (empty($payment)) {
			return redirect('/');
			return $r->post('PAYMENT_ID') . '|error';
		}

		$string = hash(
			'sha256',
			$r->post('ac_transfer') . ':' .
				$r->post('ac_start_date') . ':' .
				$r->post('ac_sci_name') . ':' .
				$r->post('ac_src_wallet') . ':' .
				$r->post('ac_dest_wallet') . ':' .
				$r->post('ac_order_id') . ':' .
				$r->post('ac_amount') . ':' .
				'qw64nK30$t'
		);

		$hash = strtoupper(md5($string));

		if ($hash == $r->post('ac_hash') && (float) $r->post('ac_amount') >= (float) $payment->amount) {

			$opration = DB::table('operations')->where('id', $payment->id)->first();

			if ($opration->operation) {

				$opration1 = DB::table('operations')->where('id', $opration->operation)->first();

				if ($opration1) {

					if ($opration->is_tax) {

						DB::table('operations')->where('id', $opration->operation)->update(['tax' => 1]);
					} elseif ($opration->is_swift) {

						DB::table('operations')->where('id', $opration->operation)->update(['swift' => 1]);
					}
				}
			} else {

				$user = User::where('id', $payment->user)->first();
				$user->money = $user->money + $payment->amount;
				$user->save();

				$te = User::where('id', $user->ref_user)->first();
				if (!empty($te)) {
					$bon = ($settings->ref_percent / 100) * $payment->amount;
					$te->money =   $te->money + $bon;
					$te->save();
					$int_id =  DB::table('operations')->insertGetId([
						'amount' => $bon,
						'user' => $te->id,
						'type' => 3, // ТИП - Партнер
						'status' => 1,
						'timestamp' => Carbon::now()
					]);
				}

				if (!$user->deposit) {

					$user->money = $user->money + $payment->amount;

					$int_id =  DB::table('operations')->insertGetId([

						'amount' => $payment->amount,
						'user' => $user->id,
						'type' => 2, // ТИП - Бонус
						'status' => 1,
						'timestamp' => Carbon::now()

					]);
				}
				$user->deposit = $user->deposit + $payment->amount;
				$user->save();
			}

			DB::table('operations')
				->where('id', $payment->id)
				->update(['status' => 1]);

			//return redirect('/');
			return $r->m_orderid . '|success';
		} else {
			//return redirect('/');
			return $r->m_orderid . '|error';
		}
	}

	public function pmStatus(Request $r)
	{
		file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/1.txt', print_r($r->all(), true));

		$settings = Settings::where('id', SITE_ID)->first();

		//if (!in_array($r->ip(), array('185.71.65.92', '185.71.65.189', '149.202.17.210'))) return;

		$payment =  DB::table('operations')->where('id', $r->post('PAYMENT_ID'))->first();

		if (empty($payment)) {
			return redirect('/');
			return $r->post('PAYMENT_ID') . '|error';
		}

		$string =
			$r->post('PAYMENT_ID') . ':' . $r->post('PAYEE_ACCOUNT') . ':' .
			$r->post('PAYMENT_AMOUNT') . ':' . $r->post('PAYMENT_UNITS') . ':' .
			$r->post('PAYMENT_BATCH_NUM') . ':' .
			$r->post('PAYER_ACCOUNT') . ':' . strtoupper(md5('o3o857Kr6tgrbDePVEnQrfWdH')) . ':' .
			$r->post('TIMESTAMPGMT');

		$hash = strtoupper(md5($string));

		if ($hash == $r->post('V2_HASH') && (float) $r->post('PAYMENT_AMOUNT') >= (float) $payment->amount) {

			$opration = DB::table('operations')->where('id', $payment->id)->first();

			if ($opration->operation) {

				$opration1 = DB::table('operations')->where('id', $opration->operation)->first();

				if ($opration1) {

					if ($opration->is_tax) {

						DB::table('operations')->where('id', $opration->operation)->update(['tax' => 1]);
					} elseif ($opration->is_swift) {

						DB::table('operations')->where('id', $opration->operation)->update(['swift' => 1]);
					}
				}
			} else {

				$user = User::where('id', $payment->user)->first();
				$user->money = $user->money + $payment->amount;
				$user->save();

				$te = User::where('id', $user->ref_user)->first();
				if (!empty($te)) {
					$bon = ($settings->ref_percent / 100) * $payment->amount;
					$te->money =   $te->money + $bon;
					$te->save();
					$int_id =  DB::table('operations')->insertGetId([
						'amount' => $bon,
						'user' => $te->id,
						'type' => 3, // ТИП - Партнер
						'status' => 1,
						'timestamp' => Carbon::now()
					]);
				}

				if (!$user->deposit) {

					$user->money = $user->money + $payment->amount;

					$int_id =  DB::table('operations')->insertGetId([

						'amount' => $payment->amount,
						'user' => $user->id,
						'type' => 2, // ТИП - Бонус
						'status' => 1,
						'timestamp' => Carbon::now()

					]);
				}
				$user->deposit = $user->deposit + $payment->amount;
				$user->save();
			}

			DB::table('operations')
				->where('id', $payment->id)
				->update(['status' => 1]);

			//return redirect('/');
			return $r->m_orderid . '|success';
		} else {
			//return redirect('/');
			return $r->m_orderid . '|error';
		}
	}

	public function profile_finance()
	{
		if (Auth::guest()) {
			return redirect()->back();
		}

		$this->showTaxSwift();

		$show_taxes = DB::table('operations')->where('user', Auth::user()->id)->where('is_swift', 1)->where('status', 1)->where('is_fake', 0)->count();
		$operations = DB::table('operations')->where('user', Auth::user()->id)->orderBy('id', 'desc')->limit(100)->get();
		if ($show_taxes)
			$operations = DB::table('operations')->where('user', Auth::user()->id)->orderBy('id', 'desc')->limit(100)->get();
		else
			$operations = DB::table('operations')->where('user', Auth::user()->id)->where('is_tax', 0)->orderBy('id', 'desc')->limit(100)->get();
		$usr_pos = User::where('profit', '>', Auth::user()->profit)->count() + 1;
		$o = null;
		return view($this->folder . '.pages.finance', compact('usr_pos', 'operations', 'o'));
	}

	protected function showTaxSwift()
	{

		$ops = DB::table('operations')->where('user', Auth::user()->id)->where('type', 1)->where('status', 0)->first();
		if ($ops) {
			$show_swift = !$ops->swift;
			$show_tax = $ops->swift && !$ops->tax;
			$tax_amount = round($ops->amount * .13, 2);
			View::share('tax_amount', $tax_amount);
		} else {
			$show_swift = null;
			$show_tax = null;
		}
		View::share('show_swift', $show_swift);
		View::share('show_tax', $show_tax);
	}

	public function bonus()
	{
		return view($this->folder . '.pages.bonus');
	}

	public function payment(Request $r)
	{

		if ($r->currency == '') {
			return Response::json([
				'message' => 'The given data was invalid.',
				'errors' => ['currency' => [trans('You must select a payment system') . '!'], 'provider' => [trans('
				Field is required')]]
			], 422);
		} else {
			$settings = Settings::where('id', SITE_ID)->first();


			$amount = $r->amount;
			$type = $r->currency;

			if (isset($r->type) && $r->type == 'swift-90' || $r->type == 'swift-120' || $r->type == 'tax') {

				if ($r->type == 'swift-90' || $r->type == 'swift-120') {
					$ops = DB::table('operations')->where('user', Auth::user()->id)->where('type', 1)->where('swift', 0)->where('status', 0)->first();

					if (!$ops) {
						return Response::json([
							'message' => trans('The given data was invalid.'),
							'errors' => ['amount' => [trans('No operation for pay swift')]]
						], 422);
					}
				} else {
					$ops = DB::table('operations')->where('user', Auth::user()->id)->where('type', 1)->where('tax', 0)->where('status', 0)->first();

					if (!$ops) {
						return Response::json([
							'message' => trans('The given data was invalid.'),
							'errors' => ['amount' => [trans('No operation for pay tax')]]
						], 422);
					}
				}

				$insData = [
					'amount' => $amount,
					'user' => Auth::user()->id,
					'type' => 0, // ТИП - ПОПОЛНЕНИЕ
					'status' => 0,
					'ref_user' => Auth::user()->ref_user,
					'timestamp' => Carbon::now(),
					'operation' => $ops->id
				];

				switch ($r->type) {

					case "swift-90":
						DB::table('operations')
							->where('operation', $ops->id)
							->where('is_swift', 1)
							->where('status', 0)
							->delete();
						$m_desc = base64_encode(__('Pay swift on azino-case.com'));
						$insData['is_swift'] = 1;
						$int_id =  DB::table('operations')->insertGetId($insData);
						break;
					case "swift-120":
						DB::table('operations')
							->where('operation', $ops->id)
							->where('is_swift', 1)
							->where('status', 0)
							->delete();
						$m_desc = base64_encode(__('Pay swift on azino-case.com'));
						$insData['is_swift'] = 1;
						$int_id =  DB::table('operations')->insertGetId($insData);
						break;
					case "tax":
						DB::table('operations')
							->where('operation', $ops->id)
							->where('is_tax', 1)
							->where('status', 0)
							->delete();
						$m_desc = base64_encode(__('Pay tax on azino-case.com'));
						$insData['is_tax'] = 1;
						$amount = round($ops->amount * .13, 2);
						$int_id =  DB::table('operations')->insertGetId($insData);
						break;
				}
			} else {

				if ((float) $amount < 1) {
					$amount = $settings->min_dep;
				}

				if ($r->amount < $settings->min_dep) {
					return Response::json([
						'message' => 'The given data was invalid.',
						'errors' => ['amount' => [trans('Minimum replenishment amount') . ': ' . $settings->min_dep . ' $']]
					], 422);
				}

				$int_id =  DB::table('operations')->insertGetId([
					'amount' => (float) $amount,
					'user' => Auth::user()->id,
					'type' => 0, // ТИП - ПОПОЛНЕНИЕ
					'status' => 0,
					'ref_user' => Auth::user()->ref_user,
					'timestamp' => Carbon::now()
				]);
				$site = Site::find(SITE_ID);
				$m_desc = base64_encode(__('Пополнение баланса на ' . $site->url));
			}

			$orderID = $int_id;
			$settings = Settings::where('id', SITE_ID)->first();
			$amount = number_format(($amount * 1.08), 2, '.', '');

			if ($type == 10) { // Payeer = 10
				$m_shop = $settings->payeer_shopid;
				$m_orderid = $orderID;
				$m_amount = number_format($amount, 2, '.', '');
				$m_curr = 'USD';
				$m_key = $settings->payeer_secret;

				$arHash = array(
					$m_shop,
					$m_orderid,
					$m_amount,
					$m_curr,
					$m_desc
				);

				$arHash[] = $m_key;

				$sign = strtoupper(hash('sha256', implode(':', $arHash)));

				return json_encode([
					'method' => "post",
					'url' => "https://payeer.com/merchant/",
					'hiddens' => [
						'm_shop' => $m_shop,
						'm_orderid' => $m_orderid,
						'm_amount' => $m_amount,
						'm_curr' => $m_curr,
						'm_desc' => $m_desc,
						'm_sign' => $sign,
						'm_process' => "send"
					]
				]);?>
				<?php 
			} elseif ($type == 136) {

				$m_orderid = $orderID;
				$m_amount = number_format($amount, 2, '.', '');
				return json_encode([
					'method' => "post",
					'url' => "https://wallet.advcash.com/sci/",
					'hiddens' => [
						'ac_account_email' => "marsel.monet@yandex.by",
						'ac_sci_name' => "Azino-Case",
						'ac_amount' => $m_amount,
						'ac_currency' => "USD",
						'ac_order_id' => $m_orderid,
						'ac_sign' => hash('sha256', 'marsel.monet@yandex.by:Azino-Case:' . $m_amount . ':USD:qw64nK30$t:' . $m_orderid)
					]
				]);
			} elseif ($type == 64) {

				$m_orderid = $orderID;
				$m_amount = number_format($amount, 2, '.', '');
				return json_encode([
					'method' => "post",
					'url' => "https://perfectmoney.is/api/step1.asp",
					'hiddens' => [
						'PAYEE_ACCOUNT' => "U11077229",
						'PAYEE_NAME' => "azino-case.com",
						'PAYMENT_ID' => $m_orderid,
						'PAYMENT_AMOUNT' => $m_amount,
						'PAYMENT_UNITS' => "USD",
						"STATUS_URL" => "http://azino-case.com/statuspm",
						"PAYMENT_URL" => "http://azino-case.com",
						"PAYMENT_URL_METHOD" => "GET",
						"NOPAYMENT_URL" => "http://azino-case.com",
						"NOPAYMENT_URL_METHOD" => "GET",
						"SUGGESTED_MEMO" => "",
						"BAGGAGE_FIELDS" => "",
						"PAYMENT_METHOD" => "Pay Now!",
					]
				]);
			} elseif ($settings->payment_type == 0) {
				$sign = md5($settings->fk_id . ':' . $amount . ':' . $settings->fk_secret1 . ':' . $orderID);
				if ($type == 1) {
					$type = 160;
				} // VISA
				elseif ($type == 5) {
					$type = 45;
				} // yM
				elseif ($type == 4) {
					$type = 63;
				} // QIWI
				elseif ($type == 10) {
					$type = 114;
				} // PAYEER
				elseif ($type == 19) {
					$type = 84;
				} // MTS
				elseif ($type == 18) {
					$type = 82;
				} // MEGAFON
				elseif ($type == 21) {
					$type = 83;
				} // BEELINE
				elseif ($type == 20) {
					$type = 132;
				} // TELE2

				$url = 'https://www.free-kassa.ru/merchant/cash.php?m=' . $settings->fk_id . '&oa=' . $amount . '&o=' . $orderID . '&s=' . $sign . '&lang=ru&i=' . $type;
				return json_encode(['url' => $url, "method" => 'get']);
			} elseif ($settings->payment_type == 1) {
				$currency = self::currency;
				$shop_id = $settings->pt_shopid;
				$secret = $settings->pt_secret;

				$request = array("amount" => $amount, "currency" => $currency, "shop_id" => $shop_id, "shop_invoice_id" => $orderID);
				ksort($request);
				$vals = array_values($request);
				$joined = join(":", $vals);
				$sign = md5($joined . $secret);

				$TIP_URL = 'https://tip.pay-trio.com/ru';
				$request["sign"] = $sign;
				$get_url = $TIP_URL . "?" . http_build_query($request);
				$response = array("url" => $get_url, "method" => 'get');
				return json_encode($response);
			}
		}
	}


	public function get_games(Request $r)
	{
		$games = Games::where('id', '<', $r->last_game_id)->where('user', $r->user_id)->orderBy('id', 'desc')->limit(24)->get();
		$content = '';
		$last = '';
		if ($games == false) {
			return json_encode(["status" => 200, "result" => ["content" => $content, 'count' => count($games)]]);
		}
		$count = count($games);
		foreach ($games as $key => $g) {
			$last = $g->id;
			$card = Cards::where('id', $g->card)->first();
			$item = Items::where('id', $g->drop_item)->first();
			$content = $content . '<div class="col-xs-6 col-sm-3 col-md-3 col-lg-3">
									<div class="game__contains-cell game__contains-cell_none">
										
											<div class="game__contains-img-wrapper game__contains-img-wrapper_with-header">
												<div class="game__contains-header">' . $card->name . '</div>
												<div class="game__contains-egg-glow"></div><img src="' . $item->image . '" alt="" class="game__contains-egg-img">
											</div>
										
									</div>
								</div> ';
		}
		return json_encode(["status" => 200, "result" => ["content" => $content, 'count' => count($games), 'last_id' => $last]]);
	}

	public function getpayment(Request $r)
	{

		$settings = Settings::where('id', SITE_ID)->first();

		if (isset($r->MERCHANT_ORDER_ID)) {

			$sign = md5($settings->fk_id . ':' . $r->AMOUNT . ':' . $settings->fk_secret2 . ':' . $r->MERCHANT_ORDER_ID);

			$payment = DB::table('operations')->where('id', $r->MERCHANT_ORDER_ID)->first();

			if (empty($payment)) {
				return "err[#1]";
			} else {
				if ($payment->status != 0) {
					return "err[#2]";
				} else {
					// if ($payment->amount != $r->AMOUNT) {
					if ($r->SIGN != $sign) {
						return "err[#3]";
					} else {
						if ($payment->type != 0) {
							return "err[#4]";
						}

						$opration = DB::table('operations')->where('id', $payment->id)->first();

						if ($opration->operation) {

							$opration1 = DB::table('operations')->where('id', $opration->operation)->first();

							if (!empty($opration1)) {

								if ($opration->is_tax) {

									DB::table('operations')->where('id', $opration->operation)->update(['tax' => 1]);
								} elseif ($opration->is_swift) {

									DB::table('operations')->where('id', $opration->operation)->update(['swift' => 1]);
								}
							}
						} else {

							$user = User::where('id', $payment->user)->first();
							$user->money = $user->money + $payment->amount;
							$user->save();
							$te = User::where('id', $user->ref_user)->first();
							if (!empty($te)) {
								$bon = ($settings->ref_percent / 100) * $payment->amount;
								$te->money =   $te->money + $bon;
								$te->save();
								$int_id =  DB::table('operations')->insertGetId([
									'amount' => $bon,
									'user' => $te->id,
									'type' => 3, // ТИП - Партнер
									'status' => 1,
									'timestamp' => Carbon::now()
								]);
							}

							if (!$user->deposit) {

								$user->money = $user->money + $payment->amount;

								$int_id =  DB::table('operations')->insertGetId([

									'amount' => $payment->amount,
									'user' => $user->id,
									'type' => 2, // ТИП - Бонус
									'status' => 1,
									'timestamp' => Carbon::now()

								]);
							}
							$user->deposit = $user->deposit + $payment->amount;
							$user->save();
						}

						DB::table('operations')->where('id', $payment->id)->update(['status' => 1]);
						return 'YES';
					}
				}
			}
		} elseif (isset($r->shop_invoice_id)) {
			$payment =   DB::table('operations')->where('id', $r->shop_invoice_id)->first();
			if (empty($payment)) {
				return "err#1";
			} else {
				if ($payment->status != 0) {
					return "err#2";
				} else {
					if ($payment->amount != $r->client_price) {
						return "err#3";
					} else {
						if ($payment->type != 0) {
							return "err#4";
						}

						$opration = DB::table('operations')->where('id', $payment->id)->first();

						if ($opration->operation) {

							$opration1 = DB::table('operations')->where('id', $opration->operation)->first();

							if ($opration1) {

								if ($opration->is_tax) {

									DB::table('operations')->where('id', $opration->operation)->update(['tax' => 1]);
								} elseif ($opration->is_swift) {

									DB::table('operations')->where('id', $opration->operation)->update(['swift' => 1]);
								}
							}
						} else {

							$user = User::where('id', $payment->user)->first();
							$user->money = $user->money + $payment->amount;
							$user->save();

							$te = User::where('id', $user->ref_user)->first();
							if (!empty($te)) {
								$bon = ($settings->ref_percent / 100) * $payment->amount;
								$int_id =  DB::table('operations')->insertGetId([
									'amount' => $bon,
									'user' => $te->id,
									'type' => 3, // ТИП - Партнер
									'status' => 1,
									'timestamp' => Carbon::now()
								]);
								$te->money =   $te->money + $bon;
								$te->save();
							}

							if (!$user->deposit) {

								$user->money = $user->money + $payment->amount;

								$int_id =  DB::table('operations')->insertGetId([

									'amount' => $payment->amount,
									'user' => $user->id,
									'type' => 2, // ТИП - Бонус
									'status' => 1,
									'timestamp' => Carbon::now()

								]);
							}
							$user->deposit = $user->deposit + $payment->amount;
							$user->save();
						}

						DB::table('operations')->where('id', $payment->id)->update(['status' => 1]);
						return 'OK';
					}
				}
			}
		}
	}
	public function pavailable()
	{
		if (!Auth::guest()) {
			return '{"status":200,"amount":' . Auth::user()->money . ',"purses":{"qiwi":null,"yandex":null,"payeer":null,"pm":null,"sber":null}}';
		}
	}


	public function payeerStatus(Request $r)
	{
		$settings = Settings::where('id', SITE_ID)->first();

		//if (!in_array($r->ip(), array('185.71.65.92', '185.71.65.189', '149.202.17.210'))) return;

		$payment =  DB::table('operations')->where('id', $r->m_orderid)->first();

		if (empty($payment)) {
			return redirect('/');
			return $r->m_orderid . '|error';
		}

		if (isset($r->m_operation_id) && isset($r->m_sign)) {
			$m_key = $settings->payeer_secret;

			$arHash = array(
				$r->m_operation_id,
				$r->m_operation_ps,
				$r->m_operation_date,
				$r->m_operation_pay_date,
				$r->m_shop,
				$r->m_orderid,
				$r->m_amount,
				$r->m_curr,
				$r->m_desc,
				$r->m_status
			);

			if (isset($r->m_params)) {
				$arHash[] = $r->m_params;
			}

			$arHash[] = $m_key;

			$sign_hash = strtoupper(hash('sha256', implode(':', $arHash)));

			if ($r->m_sign == $sign_hash && $r->m_status == 'success') {

				$opration = DB::table('operations')->where('id', $payment->id)->first();

				if ($opration->operation) {

					$opration1 = DB::table('operations')->where('id', $opration->operation)->first();

					if ($opration1) {

						if ($opration->is_tax) {

							DB::table('operations')->where('id', $opration->operation)->update(['tax' => 1]);
						} elseif ($opration->is_swift) {

							DB::table('operations')->where('id', $opration->operation)->update(['swift' => 1]);
						}
					}
				} else {

					$user = User::where('id', $payment->user)->first();
					$user->money = $user->money + $payment->amount;
					$user->save();

					$te = User::where('id', $user->ref_user)->first();
					if (!empty($te)) {
						$bon = ($settings->ref_percent / 100) * $payment->amount;
						$te->money =   $te->money + $bon;
						$te->save();
						$int_id =  DB::table('operations')->insertGetId([
							'amount' => $bon,
							'user' => $te->id,
							'type' => 3, // ТИП - Партнер
							'status' => 1,
							'timestamp' => Carbon::now()
						]);
					}

					if (!$user->deposit) {

						$user->money = $user->money + $payment->amount;

						$int_id =  DB::table('operations')->insertGetId([

							'amount' => $payment->amount,
							'user' => $user->id,
							'type' => 2, // ТИП - Бонус
							'status' => 1,
							'timestamp' => Carbon::now()

						]);
					}
					$user->deposit = $user->deposit + $payment->amount;
					$user->save();
				}

				DB::table('operations')
					->where('id', $payment->id)
					->update(['status' => 1]);

				return redirect('/');
				return $r->m_orderid . '|success';
			}

			return redirect('/');
			return $r->m_orderid . '|error';
		}
	}

	public function advcache(Request $r)
	{
		if (!Auth::guest()) {
			if ($r->amount == '') {
				return Response::json([
					'message' => trans('The given data was invalid.'),
					'errors' => ['amount' => [trans('Enter amount') . '!']]
				], 422);
			}

			if ($r->purse == '') {
				return Response::json([
					'message' => trans('The given data was invalid.'),
					'errors' => ['purse' => [trans('Choose a system to withdraw') . '!']]
				], 422);
			}

			$settings = Settings::where('id', SITE_ID)->first();

			if ((float) $r->amount < (float) $settings->min_width) {
				return Response::json([
					'message' => 'The given data was invalid.',
					'errors' => ['amount' => [trans('Minimum withdraw amount') . ': ' . $settings->min_width . '!']]
				], 422);
			}

			if (Auth::user()->money < $r->amount) {
				return Response::json([
					'message' => 'The given data was invalid.',
					'errors' => ['amount' => [trans('Not enough funds on balance') . '!']]
				], 422);
			}

			$ops = DB::table('operations')->where('user', Auth::user()->id)->where('type', 1)->where('status', 0)->count();

			if ($ops >= 1) {
				return Response::json([
					'message' => 'The given data was invalid.',
					'errors' => ['amount' => [trans('Wait for the previous output') . '!']]
				], 422);
			}

			$user = Auth::user();
			$user->money = $user->money - $r->amount;
			$user->save();
			$int_id =  DB::table('operations')->insertGetId([
				'amount' => (float) $r->amount,
				'user' => Auth::user()->id,
				'type' => 1, // ТИП - ВЫВОД
				'status' => 0,
				'koshelek' => 'advcache',
				'nomer' => $r->purse,
				'timestamp' => Carbon::now()
			]);

			return json_encode(["status" => 200, "balance" => $user->money]);
		}
	}

	public function card(Request $r)
	{
		if (!Auth::guest()) {
			if ($r->amount == '') {
				return Response::json([
					'message' => trans('The given data was invalid.'),
					'errors' => ['amount' => [trans('Enter amount') . '!']]
				], 422);
			}
			if ($r->purse == '') {
				return Response::json([
					'message' => trans('The given data was invalid.'),
					'errors' => ['purse' => [trans('Choose a system to withdraw') . '!']]
				], 422);
			}

			$settings = Settings::where('id', SITE_ID)->first();

			if ((float) $r->amount < (float) $settings->min_width) {
				return Response::json([
					'message' => 'The given data was invalid.',
					'errors' => ['amount' => [trans('Minimum withdraw amount') . ': ' . $settings->min_width . '!']]
				], 422);
			}

			if (Auth::user()->money < $r->amount) {
				return Response::json([
					'message' => 'The given data was invalid.',
					'errors' => ['amount' => [trans('Not enough funds on balance') . '!']]
				], 422);
			}

			$ops = DB::table('operations')->where('user', Auth::user()->id)->where('type', 1)->where('status', 0)->count();

			if ($ops >= 1) {
				return Response::json([
					'message' => 'The given data was invalid.',
					'errors' => ['amount' => [trans('Wait for the previous output') . '!']]
				], 422);
			}

			$user = Auth::user();
			$user->money = $user->money - $r->amount;
			$user->save();
			$int_id =  DB::table('operations')->insertGetId([
				'amount' => (float) $r->amount,
				'user' => Auth::user()->id,
				'type' => 1, // ТИП - ВЫВОД
				'status' => 0,
				'koshelek' => 'card',
				'nomer' => $r->purse,
				'timestamp' => Carbon::now()
			]);

			return json_encode(["status" => 200, "balance" => $user->money]);
		}
	}

	public function payeer(Request $r)
	{
		if (!Auth::guest()) {
			if ($r->amount == '') {
				return Response::json([
					'message' => trans('The given data was invalid.'),
					'errors' => ['amount' => [trans('Enter amount') . '!']]
				], 422);
			}
			if ($r->purse == '') {
				return Response::json([
					'message' => trans('The given data was invalid.'),
					'errors' => ['purse' => [trans('Choose a system to withdraw') . '!']]
				], 422);
			}

			$settings = Settings::where('id', SITE_ID)->first();

			if ((float) $r->amount < (float) $settings->min_width) {
				return Response::json([
					'message' => 'The given data was invalid.',
					'errors' => ['amount' => [trans('Minimum withdraw amount') . ': ' . $settings->min_width . '!']]
				], 422);
			}

			if (Auth::user()->money < $r->amount) {
				return Response::json([
					'message' => 'The given data was invalid.',
					'errors' => ['amount' => [trans('Not enough funds on balance') . '!']]
				], 422);
			}

			$ops = DB::table('operations')->where('user', Auth::user()->id)->where('type', 1)->where('status', 0)->count();

			if ($ops >= 1) {
				return Response::json([
					'message' => 'The given data was invalid.',
					'errors' => ['amount' => [trans('Wait for the previous output') . '!']]
				], 422);
			}

			$user = Auth::user();
			$user->money = $user->money - $r->amount;
			$user->save();
			$int_id =  DB::table('operations')->insertGetId([
				'amount' => (float) $r->amount,
				'user' => Auth::user()->id,
				'type' => 1, // ТИП - ВЫВОД
				'status' => 0,
				'koshelek' => 'payeer',
				'nomer' => $r->purse,
				'timestamp' => Carbon::now()
			]);

			return json_encode(["status" => 200, "balance" => $user->money]);
		}
	}
	public function qiwi(Request $r)
	{
		if (!Auth::guest()) {
			if ($r->amount == '') {
				return Response::json([
					'message' => 'The given data was invalid.',
					'errors' => ['amount' => ['Введите сумму!']]
				], 422);
			}
			if ($r->purse == '') {
				return Response::json([
					'message' => 'The given data was invalid.',
					'errors' => ['purse' => [trans('Choose a system to withdraw') . '!']]
				], 422);
			}

			$settings = Settings::where('id', SITE_ID)->first();

			if ((float) $r->amount < (float) $settings->min_width) {
				return Response::json([
					'message' => 'The given data was invalid.',
					'errors' => ['amount' => [trans('Minimum withdraw amount') . ': ' . $settings->min_width . '!']]
				], 422);
			}

			if (Auth::user()->money < $r->amount) {
				return Response::json([
					'message' => 'The given data was invalid.',
					'errors' => ['amount' => [trans('Not enough funds on balance') . '!']]
				], 422);
			}

			$ops = DB::table('operations')->where('user', Auth::user()->id)->where('type', 1)->where('status', 0)->count();

			if ($ops >= 1) {
				return Response::json([
					'message' => 'The given data was invalid.',
					'errors' => ['amount' => [trans('Wait for the previous output') . '!']]
				], 422);
			}

			$user = Auth::user();
			$user->money = $user->money - $r->amount;
			$user->save();
			$int_id =  DB::table('operations')->insertGetId([
				'amount' => (float) $r->amount,
				'user' => Auth::user()->id,
				'type' => 1, // ТИП - ВЫВОД
				'status' => 0,
				'koshelek' => 'qiwi',
				'nomer' => $r->purse,
				'timestamp' => Carbon::now()
			]);

			return json_encode(["status" => 200, "balance" => $user->money]);
		}
	}
	public function yandex(Request $r)
	{
		if (!Auth::guest()) {
			if ($r->amount == '') {
				return Response::json([
					'message' => 'The given data was invalid.',
					'errors' => ['amount' => ['Введите сумму!']]
				], 422);
			}
			if ($r->purse == '') {
				return Response::json([
					'message' => 'The given data was invalid.',
					'errors' => ['purse' => [trans('Choose a system to withdraw') . '!']]
				], 422);
			}

			$settings = Settings::where('id', SITE_ID)->first();

			if ((float) $r->amount < (float) $settings->min_width) {
				return Response::json([
					'message' => 'The given data was invalid.',
					'errors' => ['amount' => [trans('Minimum withdraw amount') . ': ' . $settings->min_width . '!']]
				], 422);
			}

			if (Auth::user()->money < $r->amount) {
				return Response::json([
					'message' => 'The given data was invalid.',
					'errors' => ['amount' => [trans('Not enough funds on balance') . '!']]
				], 422);
			}

			$ops = DB::table('operations')->where('user', Auth::user()->id)->where('type', 1)->where('status', 0)->count();

			if ($ops >= 1) {
				return Response::json([
					'message' => 'The given data was invalid.',
					'errors' => ['amount' => [trans('Wait for the previous output') . '!']]
				], 422);
			}

			$user = Auth::user();
			$user->money = $user->money - $r->amount;
			$user->save();
			$int_id =  DB::table('operations')->insertGetId([
				'amount' => (float) $r->amount,
				'user' => Auth::user()->id,
				'type' => 1, // ТИП - ВЫВОД
				'status' => 0,
				'koshelek' => 'yandex',
				'nomer' => $r->purse,
				'timestamp' => Carbon::now()
			]);

			return json_encode(["status" => 200, "balance" => $user->money]);
		}
	}
	public function pm(Request $r)
	{
		if (!Auth::guest()) {
			if ($r->amount == '') {
				return Response::json([
					'message' => 'The given data was invalid.',
					'errors' => ['amount' => ['Введите сумму!']]
				], 422);
			}
			if ($r->purse == '') {
				return Response::json([
					'message' => 'The given data was invalid.',
					'errors' => ['purse' => [trans('Choose a system to withdraw') . '!']]
				], 422);
			}

			$settings = Settings::where('id', SITE_ID)->first();

			if ((float) $r->amount < (float) $settings->min_width) {
				return Response::json([
					'message' => 'The given data was invalid.',
					'errors' => ['amount' => [trans('Minimum withdraw amount') . ': ' . $settings->min_width . '!']]
				], 422);
			}

			if (Auth::user()->money < $r->amount) {
				return Response::json([
					'message' => 'The given data was invalid.',
					'errors' => ['amount' => [trans('Not enough funds on balance') . '!']]
				], 422);
			}

			$ops = DB::table('operations')->where('user', Auth::user()->id)->where('type', 1)->where('status', 0)->count();

			if ($ops >= 1) {
				return Response::json([
					'message' => 'The given data was invalid.',
					'errors' => ['amount' => [trans('Wait for the previous output') . '!']]
				], 422);
			}

			$user = Auth::user();
			$user->money = $user->money - $r->amount;
			$user->save();
			$int_id =  DB::table('operations')->insertGetId([
				'amount' => (float) $r->amount,
				'user' => Auth::user()->id,
				'type' => 1, // ТИП - ВЫВОД
				'status' => 0,
				'koshelek' => 'pm',
				'nomer' => $r->purse,
				'timestamp' => Carbon::now()
			]);

			return json_encode(["status" => 200, "balance" => $user->money]);
		}
	}
	public function sber(Request $r)
	{
		if (!Auth::guest()) {
			if ($r->amount == '') {
				return Response::json([
					'message' => 'The given data was invalid.',
					'errors' => ['amount' => ['Введите сумму!']]
				], 422);
			}
			if ($r->purse == '') {
				return Response::json([
					'message' => 'The given data was invalid.',
					'errors' => ['purse' => [trans('Choose a system to withdraw') . '!']]
				], 422);
			}

			$settings = Settings::where('id', SITE_ID)->first();

			if ((float) $r->amount < (float) $settings->min_width) {
				return Response::json([
					'message' => 'The given data was invalid.',
					'errors' => ['amount' => [trans('Minimum withdraw amount') . ': ' . $settings->min_width . '!']]
				], 422);
			}

			if (Auth::user()->money < $r->amount) {
				return Response::json([
					'message' => 'The given data was invalid.',
					'errors' => ['amount' => [trans('Not enough funds on balance') . '!']]
				], 422);
			}

			$ops = DB::table('operations')->where('user', Auth::user()->id)->where('type', 1)->where('status', 0)->count();

			if ($ops >= 1) {
				return Response::json([
					'message' => 'The given data was invalid.',
					'errors' => ['amount' => [trans('Wait for the previous output') . '!']]
				], 422);
			}

			$user = Auth::user();
			$user->money = $user->money - $r->amount;
			$user->save();
			$int_id =  DB::table('operations')->insertGetId([
				'amount' => (float) $r->amount,
				'user' => Auth::user()->id,
				'type' => 1, // ТИП - ВЫВОД
				'status' => 0,
				'koshelek' => 'sber',
				'nomer' => $r->purse,
				'timestamp' => Carbon::now()
			]);

			return json_encode(["status" => 200, "balance" => $user->money]);
		}
	}
	public function lastOpen($id)
	{
		$game = Games::where('id', $id)->first();
		$item = Items::where('id', $game->drop_item)->first();
		$user = User::where('id', $game->user)->first();

		$total = Games::count();

		return json_encode(['boxId' => $game->card, "image" => "/img/coins/90/" . str_replace('.', '_', $item->cost) . ".png", "light" => "none", "link" => "/user/" . $game->user, "photo" => $user->avatar, "total" => $total, "totalBox" => 18, "userId" => $user->id]);
	}

	public function u_count()
	{
		$count = User::count();
		return json_encode(["count" => $count]);
	}

	public function terms()
	{
		return view($this->folder . '.pages.terms');
	}
	public function privacy()
	{
		return view($this->folder . '.pages.privacy');
	}

	public function user($id)
	{
		$user = User::where('id', $id)->first();
		if ($user == false) {
			abort(404);
		}
		if (!Auth::guest() && Auth::user()->id == $id) {
			return redirect('/profile');
		}

		$usr_pos = User::where('profit', '>', $user->profit)->count() + 1;
		$history = Games::where('user', $user->id)->limit(24)->orderBy('id', 'desc')->get();
		$last_g = 0;
		foreach ($history as $h) {
			$card = Cards::where('id', $h->card)->first();
			if (!empty($card)) {
				$h->name = $card->name;
				$item = Items::where('id', $h->drop_item)->first();
				if ($item == true) {
					$h->image = $item->image;
				}
			}
			$last_g = $h->id;
		}
		return view($this->folder . '.pages.user', compact('user', 'usr_pos', 'history', 'last_g'));
	}

	public function top100()
	{
		$top10 = User::orderBy('profit', 'desc')->limit(10)->get();

		$top90 = User::orderBy('profit', 'desc')->skip(10)->limit(90)->get();
		return view($this->folder . '.pages.top', compact('top10', 'top90'));
	}
	public function opinions()
	{
		$reviews = Reviews::orderBy('id', 'desc')->get();
		return view($this->folder . '.pages.opinions', compact('reviews'));
	}

	public function success()
	{
		return redirect('/');
	}

	public function fail()
	{
		return redirect('/');
	}
}
