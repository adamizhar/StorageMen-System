<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Product;


class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id',
        'type',
        'quantity',
        'date',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
        return $this->belongsTo(Product::class);
    }

    public function user()
    {
    return $this->belongsTo(User::class);
    
    }

}
