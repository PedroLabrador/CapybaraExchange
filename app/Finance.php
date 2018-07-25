<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Finance extends Model
{
    protected $fillable = ['payment_id', 'btc_won', 'btc_spent'];

    public function payment() {
    	return $this->belongsTo(Payment::class);
    }
}
