<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{

	protected $table = 'subcategories';

	protected $fillable = [
		'category_id',
		'name',
		'slug',
		'image'
	];
    
	/**
	 *Get Category owns the subcategory.
	 */
	public function Category()
	{

		return $this->belongsTo('App\Category', 'category_id');

	}

	/**
	 *Get Posts for Subcategory
	 */
	public function Posts()
	{
		return $this->hasMany('App\Post', 'subcategory_id');
	}


}
