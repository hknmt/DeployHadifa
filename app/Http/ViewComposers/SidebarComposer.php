<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use Request;
use App\Service;
use App\Category;
use App\Subcategory;
use App\Tfe;
use App\Partner;

class SidebarComposer
{

	public function __construct()
	{
		//
	}

	public function compose(View $view)
	{
		
		$uri = Request::segments();
		if(array_key_exists(1, $uri)) {
			if($uri[1] == 'trade-fair-exhibition')
				$active = 1;
			else
				$active = 0;
		} else
			$active = 0;
		$result = Service::all()->toArray();
		foreach($result as $key => $value) {
			$result[$key]['category'] = Service::find($value['id'])->Categories()->get()->toArray();
		}
		$view->with([
			'resultSidebar' => $result,
			'link'          => $active,
			'showTfe'       => $this->showTFE(),
			'showPartner'   => $this->showPartner()
		]);

	}

	public function showTFE()
	{

		$category = Tfe::all();

		return $category;

	}

	public function showPartner()
	{

		$partner = Partner::all();

		return $partner;

	}

}