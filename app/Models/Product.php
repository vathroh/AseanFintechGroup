<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function category(){
      return $this->belongsTo(\App\Models\Category::class);
    }

    public function productDetail(){
      return $this->hasOne(\App\Models\ProductDetail::class);
    }

}