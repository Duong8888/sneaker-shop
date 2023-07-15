<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'product_name',
        'description',
        'slug',
        'brand_id'
    ];

    public function variations()
    {
        return $this->hasMany(Variations::class);
    }

    public function color(){
        return $this->belongsTo(Color::class,'Variations');
    }

    public function size(){
        return $this->belongsTo(Size::class,'Variations');
    }
    public function brand(){
        return $this->belongsTo(Brand::class);
    }

    public function imgages(){
        return $this->hasMany(ImagesProduct::class);
    }

}
