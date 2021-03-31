<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class ExitForm extends Model
{
    protected $table = 'exit_form';
    public $timestamps = false;
    protected $fillable = ['ability_id','user_id','created_at'];
}
