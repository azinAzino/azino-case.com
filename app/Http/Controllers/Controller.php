<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Site;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

	protected $site;
	protected $folder;

	public function __construct(Request $r)
	{
		$host = str_replace(".loc", "", $r->getHttpHost());
        $site = Site::where('url', 'like', '%'.$host.'%')->first();
        define('SITE_ID', $site->id);
		$this->folder = $site->folder;
		$this->site = $site;
	}
}
