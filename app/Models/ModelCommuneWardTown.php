<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelCommuneWardTown extends Model
{
    protected $fillable = ['name_cwt','type_cwt','id_district'];
    protected $primaryKey = 'id_cwt';
    protected $table = 'commune_ward_town';
    public $timestamps  = false;
}
