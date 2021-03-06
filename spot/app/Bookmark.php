<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bookmark extends Model
{
    protected $table = 'bookmarks';

    protected $guarded = [
		'id',
		'created_at',
		'updated_at',
	];
}
