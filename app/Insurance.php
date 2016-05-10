<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Insurance extends Model
{
    protected $fillable = [
        'name', 'insurance_type_id', 'payment',
    ];

    public function provider()
    {
        return $this->belongsTo('App\Provider');
    }

    public function insuranceType()
    {
        return $this->belongsTo('App\InsuranceType');
    }

    public function customers()
    {
        return $this->belongsToMany('App\Customer', 'customer_insurances')
            ->withPivot('valid_until')
            ->withTimestamps();
    }
    
    public function requests()
    {
        return $this->hasMany('App\KeymanRequest');
    }
}
