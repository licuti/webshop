<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelUserSocial extends Model
{
    public $timestamps = false;
    protected $fillable = [
    'id_user_provider',
    'provider',
    'id_user_social'
    ];

    protected $primaryKey = 'id_social';
    protected $table = 'user_social';
    public function login(){
        return $this->belongsTo('App\Models\ModelUser','id_user_social');
    }
}
