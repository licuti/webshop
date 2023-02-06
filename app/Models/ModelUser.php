<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelUser extends Model
{
    protected $fillable = [
    'username',
    'password',
    'fullname_user',
    'email_user',
    'phone_user',
    'address_user',
    'avatar_user',
    'status_user',
    'created_at',
    'updated_at'
    ];
    protected $primaryKey = 'id_user';
    protected $table = 'user';
    public $timestamps  = true;
}
