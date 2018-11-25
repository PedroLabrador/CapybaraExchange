<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bankaccount extends Model
{
    protected $fillable = ['user_id', 'bank_id', 'account', 'user_name', 'dni', 'account_type', 'memo'];

    public function bank() {
    	return $this->belongsTo(Bank::class);
    }

    public function user() {
    	return $this->belongsTo(User::class);
    }

    public function payments() {
    	return $this->hasMany(Payment::class);
    }
}
