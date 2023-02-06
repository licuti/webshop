<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelBlog extends Model
{
    protected $fillable = ['title_blog','describe_blog','content_blog','image_blog','slug_blog','status_blog'];
    protected $primaryKey = 'id_blog';
    protected $table = 'blog';
    public $timestamps  = true;
}
