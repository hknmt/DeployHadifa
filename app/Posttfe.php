<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Posttfe extends Model
{
    
	protected $table = 'posttves';

	protected $fillable = [
		'information',
		'content',
		'view',
		'tves_id'
	];

	public function Tfe()
	{

		return $this->belongsTo('App\Tfe', 'tves_id');

	}

	public function Slideshows()
	{

		return $this->hasMany('App\Slideshowtfe', 'post_id');

	}

}
