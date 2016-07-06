<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use Request;

use App\Customer;
use App\Service;
use App\Register;

class NavAdminComposer
{

	public function __construct()
	{

	}

	public function compose(View $view)
	{

		$result['customer'] = Customer::where('read', '==', 0)->get()->count();
		$result['service'] = Service::all()->toArray();
		$result['register'] = Register::where('read', 0)->get()->count();
		$active = Request::segments();
		$view->with([
			'nav'    => $result,
			'active' => $active
		]);

	}

}