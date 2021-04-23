<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tasks extends Model
{
    // protected $table='users';
	
	protected $fillable = [
		'employee_id','admin_id','category_id','target_date',
	];
}
