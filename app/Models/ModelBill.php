<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelBill extends Model
{
    protected $fillable = ['id_user','id_discount','name_bill','phone_bill','email_bill','address_bill','total_bill','note_bill','status_bill','payment_bill'];
    protected $primaryKey = 'id_bill';
    protected $table = 'bill';
    public $timestamps  = true;
}
