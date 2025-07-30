<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PartnersModel extends Model
{
    use HasFactory;
    protected $table = "partner";
    protected $fillable = ['id','image_type','image','created_at'];
}
