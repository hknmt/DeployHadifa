<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon as Carbon;

class Register extends Model
{
    
	protected $fillable = [
		'category',
		'post',
		'name',
		'email',
		'phone',
		'address',
		'company',
		'read'
	];

	protected $guarded = [];

	public function getCreatedAtAttribute($value)
	{

		return Carbon::parse($value)->format('d-m-Y');

	}

}
