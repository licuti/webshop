<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelCategory extends Model
{
    protected $fillable = ['name_category','describe_category','image_category','slug_category','status_category','created_at','updated_at'];
    protected $primaryKey = 'id_category';
    protected $table = 'category_product';
    public $timestamps  = true;
}
