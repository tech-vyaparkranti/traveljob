<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamModel extends Model
{
    use HasFactory;

    protected $table = "team";
    protected $fillable = ['id','name','email','image','address','post','occupation','education','expertise','focus','message','created_at'];
}
