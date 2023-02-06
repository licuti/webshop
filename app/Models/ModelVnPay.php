<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelVnPay extends Model
{
    protected $fillable = ['id_user','id_bill','amount_vnp','bankcode_vnp','banktranno_vnp','cardtype_vnp','paydate_vnp','transaction_vnp'];
    protected $primaryKey = 'id_vnp';
    protected $table = 'vnpay';
    public $timestamps  = true;
}
