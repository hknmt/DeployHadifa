<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    
	public function Categories()
	{

		return $this->hasMany('App\Category', 'service_id');

	}

	public function Subcategorys()
	{

		return $this->hasManyThrough(
			'App\Subcategory', 'App\Category',
			'service_id', 'category_id', 'id'
		);

	}

}
