<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelShippingFees extends Model
{
    protected $fillable = ['city_fee','district_fee','cwt_fee','shipping_fee'];
    protected $primaryKey = 'id_fee';
    protected $table = 'shipping_fees';
    public $timestamps  = true;

    public function city(){
        return $this->belongsTo('App\Models\ModelCity','city_fee');
    }
    public function district(){
        return $this->belongsTo('App\Models\ModelDistrict','district_fee');
    }
    public function cwt(){
        return $this->belongsTo('App\Models\ModelCommuneWardTown','cwt_fee');
    }
}
