<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tfe extends Model
{
    
	protected $table = 'tves';

	protected $fillable = [
		'name',
		'slug',
		'status',
		'image',
		'description',
		'start',
		'end'
	];

	public function Post()
	{

		return $this->hasOne('App\Posttfe', 'tves_id');

	}

	public function Slideshows()
	{
		return $this->hasManyThrough(
			'App\Slideshowtfe', 'App\Posttfe',
			'tves_id', 'post_id', 'id'
		);
	}

}
