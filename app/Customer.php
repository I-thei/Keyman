<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

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
        return $this->belongsToMany('App\Insurance', 'customer_insurances')
            ->withPivot('valid_until')
            ->withTimestamps();
    }

    public function requests()
    {
        return $this->hasMany('App\KeymanRequest');
    }

    public function getFullNameAttribute()
    {
        return $this->last_name . ', ' . $this->first_name . ' ' . $this->middle_name;
    }

    public function getFullNameMIAttribute()
    {
        return Str::upper($this->last_name) . ', ' . $this->first_name . ' ' . ($this->middle_name ? $this->middle_name[0] . '.' : '');
    }

    // sortby = total_requests, name, email
    public function scopeOrderByName($query, $order = 'asc')
    {
        $query
            ->orderBy('customers.last_name', $order);
    }
    public function scopeOrderByRequests($query, $order = 'asc')
    {
        $query
            ->orderBy('customers.total_requests', $order);
    }
}
