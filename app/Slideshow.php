<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slideshow extends Model
{
    
	protected $fillable = [
		'image',
		'thumbnail'
	];

	/**
	 *Get post owns the slideshow
	 */
	public function Post()
	{

		return $this->belongsTo('App\Post', 'post_id');

	}

}
