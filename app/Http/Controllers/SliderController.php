<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slider;
use App\Http\Requests\SliderRequest;
use App\Traits\CommonFunctions;
use Yajra\DataTables\Facades\DataTables;
use Exception;
use App\Traits\ResponseAPI;


class SliderController extends Controller
{
    use CommonFunctions;
    use ResponseAPI;
    public function index(){
      return view('Dashboard.Pages.HomeSlider');
     }


     public function GetAllSliderData(){
        $query = Slider::select('id','slider_title','slider_image','sort_about','button_link');
       return DataTables::of($query)
        ->addIndexColumn()
        ->addColumn('action',function($row){
          $btn_edt = '<a data-row_id= "'.$row->{'id'}.'"  href="javascript:void(0)" class="edit btn btn-primary btn-sm">Edit</a>';
           $btn_delete = '<a  onclick="DeleteSliderData('.$row->{'id'}.')" href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
           return $btn_edt.$btn_delete;
        })
        ->rawColumns(['action','about_text'])
        ->make(true);
     }




     public function SaveSliderMaster(SliderRequest $req){
       switch($req->input('action')){
            case 'insert' :
                  return $this->InsertSliderData($req);
                  break;
            case 'update':
                  return $this->UpdateSliderData($req);
                  break;
            case 'delete':
                  return $this->deleteSliderRow($req);
                }
     }

    public function InsertSliderData(SliderRequest $req){
        $date = date("Y-m-d");
        if($req->file('slider_image')){
             $image = $req->file('slider_image');
             $fileName = $image->getClientOriginalName();

             $fileName = "IMG_.$date".preg_replace('/[^A-Za-z0-9.\-]/','',$fileName);
             $Slider_IMAGE_PATH = "/upload/slider/image/";
             $image->move(public_path().$Slider_IMAGE_PATH,$fileName);
             $imageName = $Slider_IMAGE_PATH.$fileName;
        }

      $SliderArray = [
         'slider_title'=>$req->input('slider_title'),
         'slider_image'=>$imageName,
         'sort_about'=>$req->input('sort_about'),
         'button_link'=>$req->input('button_link'),
         'created_at' =>$date,
      ];
   $InsertData = Slider::insert($SliderArray);
    if($InsertData){
        $return = $this->returnMessage("Saved successfully.", true);
        return $return;
    }


    }
    public function UpdateSliderData(SliderRequest $req){
        $id = $req->input('id');
        if($id){
            $date = date("Y-m-d");
            if($req->file('slider_image')){
                 $image = $req->file('slider_image');
                 $fileName = $image->getClientOriginalName();

                 $fileName = "IMG_.$date".preg_replace('/[^A-Za-z0-9.\-]/','',$fileName);
                 $Slider_IMAGE_PATH = "/upload/slider/image/";
                 $image->move(public_path().$Slider_IMAGE_PATH,$fileName);
                 $imageName = $Slider_IMAGE_PATH.$fileName;
            }else{
             $getImageData = Slider::find($id);
              if($getImageData['slider_image']){
                $imageName = $getImageData['slider_image'];
              }
            }

          $SliderArray = [
             'slider_title'=>$req->input('slider_title'),
             'slider_image'=>$imageName,
             'sort_about'=>$req->input('sort_about'),
             'button_link'=>$req->input('button_link'),
            //  'created_at' =>$date,
          ];
       $UpdateData = Slider::where('id',$id)->update($SliderArray);
        if($UpdateData){
            $return = $this->returnMessage("Update successfully.", true);
            return $return;
        }
        }else{
          return  $this->error("Id is required",200);

        }

    }



    public function GetSliderDataById(Request $request){
        try{
       if($request->input('id')){
          $sliderData = Slider::find($request->input('id'));
          if($sliderData){
           $return = $this->success("success",$sliderData);
          }else{
            $return = $this->error("No data found.",200);
          }
       }else{
       $return = $this->error("Id is required",200);
       }
        }catch(Exception $exception){
          $this->reportException($exception);
            $return = $this->error("Something Went Wrong.",500);
        }
        return $return;
    }



    public function deleteSlider(Request $req){
       try{
        $SliderFind = Slider::find($req->input('id'));
         if($SliderFind){
          $delete = $SliderFind->delete();
          if($delete){
           return $this->success("Delete Successfully",true);
          }else{
           return $this->error("Something went wrong",500);
          }
         }
       }catch(Exception $exception){
         $this->reportException($exception);
        return $this->error("Something went wrong");
       }


    }

}
