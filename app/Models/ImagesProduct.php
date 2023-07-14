<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImagesProduct extends Model
{
    use HasFactory;
    public $timestamps = false;
    public $fillable = [
        'url',
        'product_id',
    ];
    public function product(){
        return $this->belongsTo(Product::class);
    }
}
