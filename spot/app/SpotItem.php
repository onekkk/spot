<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SpotItem extends Model
{
    protected $table = 'spot_items';

   	protected $guarded = [
		'id',
		'created_at',
		'updated_at',
	];              
}
