<?php


namespace App\Http\Controllers;

use Auth;
use App\User;
use DB;
use Carbon\Carbon;
use App\Settings;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function vklogin(Request $r)
    {
		$settings = Settings::where('id', 1)->first();
        $client_id = '5771677';
        $client_secret = 'OG54RLqYjZms27ZsDajS';
        $redirect_uri = 'azino-case.com';
        if (!is_null($r->code)) 
		{
			$obj = json_decode($this->curl('https://oauth.vk.com/access_token?client_id=' . $client_id . '&client_secret=' . $client_secret . '&redirect_uri=http://' . $redirect_uri . '/login/vkontakte&code=' . $r->code));
			if (isset($obj->access_token))
			{
				$info = json_decode($this->curl('https://api.vk.com/method/users.get?user_ids&fields=photo_200&access_token=' . $obj->access_token . '&v=V'), true);
				$user = User::where('login2', $info['response'][0]['uid'])->first();
				if($user == NULL) 
				{
					if(array_key_exists('photo_200', $info['response'][0]))
					{
						$photo = $info['response'][0]['photo_200'];
					}else
					{
						$photo = 'http://vk.com/images/camera_200.png';
					}
					if ($r->session()->has('ref')) {
						$has = DB::table('users')->where('ref_code', session('ref'))->first();
						if(!empty($has))
						{
							$ref_user = session('ref');
							$money = $settings->ref_sum;
						}
						else
						{
							$ref_user = NULL;
							$money = 0;
						}
					}
					else
					{
						$ref_user = NULL;
						$money = 0;
					}
					$user = User::create([
						'username' => $info['response'][0]['first_name'] . ' ' . $info['response'][0]['last_name'],
						'avatar' => $photo,
						'login' => 'id'.$info['response'][0]['uid'],
						'money' => $money,
						'login2' => $info['response'][0]['uid'],
						'ref_user' => $ref_user,
						'bonus_money' => 1000
					]);
					$int_id =  \DB::table('operations')->insertGetId([
						'amount' => 1000, 
						'user' => $user->id, 
						'type' => 4, // ТИП - вознаграждение
						'status' => 1,
						'timestamp' => Carbon::now()
					]);
					
				} 
				else 
				{
					if(array_key_exists('photo_200', $info['response'][0]))
					{
						$photo = $info['response'][0]['photo_200'];
					}
					else
					{
						$photo = 'http://vk.com/images/camera_200.png';
					}
					$user->username = $info['response'][0]['first_name'] . ' ' . $info['response'][0]['last_name'];
					$user->avatar = $photo;
					$user->login = 'id'.$info['response'][0]['uid'];
					$user->login2 = $info['response'][0]['uid'];
					$user->save();
				}
				Auth::login($user, true);
				return redirect('/');
			}
		} 
		else 
		{
			return redirect('https://oauth.vk.com/authorize?client_id=' . $client_id . '&display=page&redirect_uri=http://' . $redirect_uri . '/login/vkontakte&scope=friends,photos,status,offline,&response_type=code&v=5.53');
		}
	}
	
	public function oklogin(Request $r)
	{
		$client_id = '1259033600'; // Application ID
		$public_key = 'CBAFFMAMEBABABABA'; // Публичный ключ приложения
		$client_secret = 'F6EDF3B25D935EE4788ECD13'; // Секретный ключ приложения
		$redirect_uri = 'https://coinscube.ru/login/odnoklassniki'; // Ссылка на приложение
		if(!isset($r->code))
		{
			$url = 'http://www.odnoklassniki.ru/oauth/authorize';
			$params = array(
				'client_id'     => $client_id,
				'response_type' => 'code',
				'redirect_uri'  => $redirect_uri
			);
			$uri = $url.'?'.urldecode(http_build_query($params));
			return redirect($uri);
		}
		else
		{
			$params = array(
				'code' => $r->code,
				'redirect_uri' => $redirect_uri,
				'grant_type' => 'authorization_code',
				'client_id' => $client_id,
				'client_secret' => $client_secret
			);

			$url = 'http://api.odnoklassniki.ru/oauth/token.do';
			
			$curl = curl_init();
			curl_setopt($curl, CURLOPT_URL, $url);
			curl_setopt($curl, CURLOPT_POST, 1);
			curl_setopt($curl, CURLOPT_POSTFIELDS, urldecode(http_build_query($params)));
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
			$result = curl_exec($curl);
			curl_close($curl);
			
			
			$tokenInfo = json_decode($result, true);
			
			if(isset($tokenInfo['access_token']))
			{
				$sign = md5("application_key=".$public_key."format=jsonmethod=users.getCurrentUser" . md5($tokenInfo['access_token'].$client_secret));
				$params = array(
					'method'          => 'users.getCurrentUser',
					'access_token'    => $tokenInfo['access_token'],
					'application_key' => $public_key,
					'format'          => 'json',
					'sig'             => $sign
				);
				$userInfo = json_decode(file_get_contents('http://api.odnoklassniki.ru/fb.do' . '?' . urldecode(http_build_query($params))), true);
				if(isset($userInfo['name']))
				{
					$user = User::where('login2', $userInfo['uid'])->first();
					if($user == NULL)
					{
						if ($r->session()->has('ref')) {
							$has = DB::table('users')->where('ref_code', session('ref'))->first();
							if(!empty($has))
							{
								$ref_user = session('ref');
								$money = 0;
							}
							else
							{
								$ref_user = NULL;
								$money = 0;
							}
						}
						else
						{
							$ref_user = NULL;
							$money = 0;
						}
						$user = User::create([
							'username' => $userInfo['name'],
							'avatar' => $userInfo['pic_1'],
							'login' => 'https://ok.ru/profile/'.$userInfo['uid'],
							'money' => $money,
							'login2' => $userInfo['uid'],
							'ref_user' => $ref_user,
							'bonus_money' => 1000
						]);
						$int_id =  \DB::table('operations')->insertGetId([
							'amount' => 1000, 
							'user' => $user->id, 
							'type' => 4, // ТИП - вознаграждение
							'status' => 1,
							'timestamp' => Carbon::now()
						]);
					}
					else
					{
						$user->username = $userInfo['name'];
						$user->avatar = $userInfo['pic_2'];
						$user->save();
					}
					Auth::login($user, true);
					if(isset($ref_user))
					{
						if($ref_user != NULL)
						{
							$payment = DB::table('operations')->insertGetId([
								'amount' => (int)10, 
								'user' => Auth::user()->id, 
								'time' => time(), 
								'timestamp' => Carbon::now(),
								'status' => 1,
								'type' => 1,
							]);
						}
					}	
					return redirect('/');
				}
				else
				{
					return redirect('/');
				}
			}
			else
			{
				dd($tokenInfo);	
			}
		}
	}
		
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

    public function curl($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $output = curl_exec($ch);
        curl_close($ch);
        return $output;
    }

    public function generate_name()
    {
        $length = 8;
        $chars = 'abdefhiknrstyzABDEFGHKNQRSTYZ23456789';
        $numChars = strlen($chars);
        $string = '';
        for ($i = 0; $i < $length; $i++) {
            $string .= substr($chars, rand(1, $numChars) - 1, 1);
        }
        return $string;
    }

    public function generate()
    {
        $length = 13;
        $chars = 'abdefhiknrstyzABDEFGHKNQRSTYZ23456789';
        $numChars = strlen($chars);
        $string = '';
        for ($i = 0; $i < $length; $i++) {
            $string .= substr($chars, rand(1, $numChars) - 1, 1);
        }
        return $string;
    }
}
