<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelDistrict extends Model
{
    protected $fillable = ['name_district','type_district','id_city'];
    protected $primaryKey = 'id_district';
    protected $table = 'district';
    public $timestamps  = false;
}
