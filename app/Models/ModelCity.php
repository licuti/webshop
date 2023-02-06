<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelCity extends Model
{
    protected $fillable = ['name_city','type_city'];
    protected $primaryKey = 'id_city';
    protected $table = 'city';
    public $timestamps  = false;
}
