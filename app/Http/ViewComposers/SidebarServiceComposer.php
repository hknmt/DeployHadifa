<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use Request;
use App\Service;
use App\Category;
use App\Subcategory;
use App\Tfe;
use App\Partner;

class SidebarServiceComposer
{

	public function __construct()
	{
		//
	}

	public function compose(View $view)
	{
		
		$uri = Request::segments();
		$result = Service::where('slug', $uri[1])->first()->toArray();
		$result['category'] = Service::find($result['id'])->Categories()->get()->toArray();
		foreach($result['category'] as $key => $value) {
			$result['category'][$key]['subcategory'] = Category::find($value['id'])->Subcategorys()->get()->toArray();
		}
		$view->with([
			'resultSidebar' => $result,
			'uri'           => $uri,
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