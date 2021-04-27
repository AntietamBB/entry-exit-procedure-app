<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tasks extends Model
{
    protected $table='tasks';
	
	protected $fillable = [
		'employee_id','admin_id','category_id','target_date',
	];

	public function admin()
    {
        return $this->belongsTo('App\Models\User','admin_id');
    }

	public function employee()
    {
        return $this->belongsTo('App\Models\User','employee_id');
    }

	public function category()
    {
        return $this->belongsTo('App\Models\Roles','category_id');
    }

}
