<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = ['user_id', 'bankaccount_id', 'currency', 'amount', 'to_pay', 'link'];

    public function user() {
    	return $this->belongsTo(User::class);
    }

    public function bankaccount() {
    	return $this->belongsTo(Bankaccount::class);
    }

    public function currency() {
    	return $this->belongsTo(Currency::class);
    }
}
