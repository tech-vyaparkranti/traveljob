<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutUsModel extends Model
{
    use HasFactory;
    protected $table = 'about_us';
    // Add 'about_image' to the fillable array
    protected $fillable = ['id', 'about_desc', 'sort_about_us', 'about_image', 'created_at'];
}