<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamModel extends Model
{
    use HasFactory;

    protected $table = 'team'; // or whatever your table name is

    protected $fillable = [
        'name',
        'post',
        'message',   // ✅ added
        'image',
    ];
}
