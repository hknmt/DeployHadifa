<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Service;
use Request;

class NavComposer
{

	public function __construct()
	{

	}

	public function compose(View $view)
	{

		$uri = Request::Segments();
		$list = service::all()->toArray();
		$view->with([
			'list' => $list,
			'nav'  => $uri
		]);

	}

}