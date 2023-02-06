<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelGallery extends Model
{
    protected $fillable = ['id_gallery','id_product','name_gallery','link_gallery'];
    protected $primaryKey = 'id_gallery';
    protected $table = 'gallery';
}
