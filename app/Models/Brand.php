<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Brand extends Model
{
    use HasFactory,SoftDeletes;
    public $timestamps = false;

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
