<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelProduct extends Model
{
    protected $fillable = [
    'id_category',
    'name_product',
    'describe_product',
    'detail_product',
    'image_product',
    'price_product',
    'discount_product',
    'evaluate_product',
    'sales_product',
    'slug_product',
    'keywords_product',
    'status_product',
    'created_at',
    'updated_at'
    ];
    protected $primaryKey = 'id_product';
    protected $table = 'product';
    public $timestamps  = true;

    public function category(){
        return $this->belongsTo('App\Models\ModelCategory','id_category');
    }
}
