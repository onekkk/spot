<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemDetail extends Model
{
	protected $table = 'items_details';
    
	protected $guarded = [
		'id',
		'created_at',
		'updated_at',
	];

}
