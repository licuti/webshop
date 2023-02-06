<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelFavourite extends Model
{
    protected $fillable = ['id_user','id_product'];
    protected $primaryKey = 'id_favourite';
    protected $table = 'favourite';

    public function product(){
        return $this->belongsTo('App\Models\ModelProduct','id_product');
    }

}
