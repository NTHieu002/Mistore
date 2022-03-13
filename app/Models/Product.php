<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'product_name', 'category_id', 'brand_id', 'product_desc', 'product_price', 'product_quantity', 'product_status'
    ];
    protected $primaryKey = 'product_id';
    protected $table = 'tbl_products';

    public function comment() {
        return $this->hasMany('App\Comment');
    }
}
