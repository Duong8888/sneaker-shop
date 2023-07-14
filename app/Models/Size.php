<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    use HasFactory;
    public $timestamps  = false;
    protected $fillable = [
        'size_value',
    ];
    public function product(){
        return $this->belongsTo(Product::class, 'variations');
    }
}
