<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    
	protected $fillable = [
		'name',
		'email',
		'phone',
		'company',
		'address',
		'title',
		'content',
		'read',
		'location'
	];

	protected $guarded = [
		'id',
		'created_at',
		'updated_at'
	];

}
