<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;

    protected $table= 'slider';
    protected  $fillable = ['id','slider_title','slider_image','sort_about','button_link','status','created_at'];


}
