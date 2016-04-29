<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'middle_name',
        'email',
        'phone_num',
    ];

    public function insurances()
    {
        return $this->belongsToMany('App\Insurance', 'customer_insurances');
    }

    public function requests()
    {
        return $this->hasMany('App\Request');
    }
}
