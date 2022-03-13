<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Comment extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'comment', 'comment_name_user', 'comment_product_id', 'comment_date', 'comment_parent', 'comment_status'
    ];
    protected $primaryKey = 'comment_id';
    protected $table = 'tbl_comment';

    public function product() {
        return $this->belongsTo('App\Models\Product','comment_product_id');
    }
}
