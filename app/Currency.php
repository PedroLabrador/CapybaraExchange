<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    protected $fillable = [
        'name', 
        'price_cu', 
        'price_bs', 
        'deposit', 
        'memo', 
        'fixedmemo', 
        'increment', 
        'lmin', 
        'lmax'
    ];
}
