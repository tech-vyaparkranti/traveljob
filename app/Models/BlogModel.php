<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogModel extends Model
{
    use HasFactory;
    protected $table  = "blog";
    protected $fillable = ['id','blog_title','blog_desc','blog_date','image','created_at'];
}
