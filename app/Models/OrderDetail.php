<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;
    public $timestamps  = false;
    protected $fillable = [
        'variations_id',
        'order_id',
    ];
    public function order(){
        return $this->belongsTo(Order::class);
    }
    public function variations(){
        return $this->belongsTo(Variations::class);
    }
}
