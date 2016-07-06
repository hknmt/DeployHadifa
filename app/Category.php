<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

	protected $table = 'categories';

	protected $fillable = [
		'name',
		'slug'
	];
    
	/**
	 *Get subcategory for category.
	 */
	public function Subcategorys()
	{
		return $this->hasMany('App\Subcategory', 'category_id');
	}

	public function Service()
	{

		return $this->belongsTo('App\Service', 'service_id');

	}

}
