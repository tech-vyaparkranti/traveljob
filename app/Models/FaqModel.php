<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FaqModel extends Model
{
    use HasFactory;
    protected $table = "faq";
    protected $fillable = ['id','faq_question','faq_answer','created_at'];
}
