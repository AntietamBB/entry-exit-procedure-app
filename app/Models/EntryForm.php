<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class EntryForm extends Model
{
    protected $table = 'entry_form';
    public $timestamps = false;
    protected $fillable = ['ability_id','user_id','created_at','employee_id'];

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
}
