<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SettingModel;
use App\Traits\ResponseAPI;
use App\Traits\CommonFunctions;

class SettingController extends Controller
{
    use ResponseAPI;
    use CommonFunctions;

    public function index(){
        return view('Dashboard.Pages.Admin_settings_manage');
    }


    public function GetAllData(){
        $getAllData = SettingModel::all();
          if(!empty($getAllData)){
           return $getAllData;
         }else{
          return null;
         }
    }

    public function UpdateSetting(Request $req){
        $date = date("Y-m-d");
        $id = $req->input('id');
     if($req->all()){
       if($req->file('logo')){
        $image  = $req->file('logo');
        $fileName = $image->getClientOriginalName();
        $fileName ="IMG".$date.preg_replace('/[^A-Za-z0-9.\-]/','',$fileName);
        $IMAGE_PATH = "/upload/logo/";
        $image->move(public_path().$IMAGE_PATH,$fileName);
        $imageName = $IMAGE_PATH.$fileName;
       }else{

        if(!empty($id)){
            $getImageData = SettingModel::find($id);
            if($getImageData['logo']){
              $imageName = $getImageData['logo'];
            }
        }else{
            $imageName = '';
        }

        }
    $data = [
        'logo'=>$imageName,
        'email'=>$req->input('email'),
        'mobile'=>$req->input('mobile'),
        'company_name'=>$req->input('company_name'),
        'instagram'=>$req->input('instagram'),
        'facebook'=>$req->input('facebook'),
        'twitter'=>$req->input('twitter'),
        'youtube'=>$req->input('youtube'),
        'address'=>$req->input('address'),
        'whatsapp_no'=>$req->input('whatsapp_no'),
        'call_no'=>$req->input('call_no'),
        'copyright_txt'=>$req->input('copyright_txt'),

    ];

if(!empty($id)){
    $UpdateSetting = SettingModel::where('id',$id)->update($data);
}else{
    $UpdateSetting = SettingModel::insert($data);
}
if($UpdateSetting){
    return $this->returnMessage('Setting Update Successfully',true);
}

     }
    }




}
