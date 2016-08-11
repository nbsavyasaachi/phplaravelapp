<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	// specify the table name if it is not categories
    protected $table = 'category'; 

    public function tasks()
    {
    	return $this->hasMany('App\Task');
    }

}
