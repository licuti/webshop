<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelCodeDiscount extends Model
{
    protected $fillable = ['name_discount','code_discount','times_discount','percent_discount','type_discount','status_category','created_at','updated_at'];
    protected $primaryKey = 'id_discount';
    protected $table = 'code_discount';
    public $timestamps  = true;
}
