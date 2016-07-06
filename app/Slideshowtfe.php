<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slideshowtfe extends Model
{
    
	protected $table = 'slideshowtves';

	protected $fillable = [
		'image',
		'thumbnail'
	];

	public function Post()
	{

		return $this->belongsTo('App\Posttfe', 'post_id');

	}

}
