<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SettingModel extends Model
{
    use HasFactory;
    protected $table= "settings";
protected $fillable = ['id','logo','email','mobile','company_name','instagram','facebook','twitter','youtube','address','whatsapp_no','call_no','copyright_txt','created_at'];
}
