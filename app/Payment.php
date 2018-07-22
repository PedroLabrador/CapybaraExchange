<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = ['concept', 'amount', 'user_id'];

    public function user() {
    	$this->belongsTo('User::class');
    }
}
