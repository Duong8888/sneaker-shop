<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;
    public $timestamps  = false;
    protected $fillable = [
        'name_brand',
        'image',
        'slug'
    ];

    public function product()
    {
        return $this->hasMany(Product::class);
    }
}
