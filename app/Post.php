<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    
	protected $fillable = [
		'subcategory_id',
		'name',
		'slug',
		'image',
		'information',
		'view'
	];

	/**
	 *Get Subcategory owns the Post
	 */
	public function Subcategory()
	{

		return $this->belongsTo('App\Subcategory', 'subcategory_id');

	}

	/**
	 *Get slideshow for the post
	 */
	public function Slideshows()
	{
		return $this->hasMany('App\Slideshow', 'post_id');
	}

}
