<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'description',
        'cost_price',
        'selling_price'
    ];

    public function stocks() {
        return $this->hasMany(Stock::class);
    }

    public function transactionItems() {
        return $this->hasMany(TransactionItem::class);
    }

    public function distributions() {
        return $this->hasMany(Distribution::class);
    }
}
