<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VariationsHistories extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'id',
        'product_id',
        'size_id',
        'color_id',
        'quantity',
        'price',
    ];
}
