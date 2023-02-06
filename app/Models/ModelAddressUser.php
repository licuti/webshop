<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelAddressUser extends Model
{
    protected $fillable = ['id_user','id_city','id_district','id_cwt','street_address'];
    protected $primaryKey = 'id_address';
    protected $table = 'address_user';
    public $timestamps  = true;


    public function user(){
        return $this->belongsTo('App\Models\ModelUser','id_user');
    }
    public function city(){
        return $this->belongsTo('App\Models\ModelCity','id_city');
    }
    public function district(){
        return $this->belongsTo('App\Models\ModelDistrict','id_district');
    }
    public function cwt(){
        return $this->belongsTo('App\Models\ModelCommuneWardTown','id_cwt');
    }
}
