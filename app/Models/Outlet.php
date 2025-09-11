<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Outlet extends Model
{
    protected $fillable = [
        'name',
        'owner_name',
        'phone',
        'gps_lat',
        'gps_lng'
    ];

    public function transactions() {
        return $this->hasMany(Transaction::class);
    }
}
