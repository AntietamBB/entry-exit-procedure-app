<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use DB;
class Employee extends Model
{
	protected $table='users';
	
	protected $fillable = [
		'name', 'email', 'password', 'user_type', 'phone','startdate','exitdate','department','position',
	];

}