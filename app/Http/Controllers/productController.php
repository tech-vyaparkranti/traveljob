<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Exception;
use App\Traits\ResponseAPI;
use App\Traits\CommonFunctions;
use App\Models\ProductModel;
use App\Http\Requests\ProductFormRequest;

class productController extends Controller
{
    use ResponseAPI;
    use CommonFunctions;
            public function index(){
                 return  view('Dashboard.Pages.Admin_product_manage');
            }

            public function  GetAllData(){
               $query = ProductModel::select('id','p_name','p_desc','p_img');
                    return DataTables::of($query)
                    ->addIndexColumn()
                    ->addColumn('action',function($row){
                         $btn_edit = '<a data-row_id="'.$row->{'id'}.'"  href="javascript:void(0)" class="edit btn btn-primary btn-sm">Edit</a>';
                         $btn_delete = '<a  onclick="DeleteData('.$row->{'id'}.')" href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
                        return $btn_edit.$btn_delete;
                    })
                    ->rawColumns(['action','name'])
                    ->make(true);
            }




//All Actions like Add ,Edit , and delete for master function
public function SaveMaster(ProductFormRequest $req){
    switch($req->input('action')){
         case 'insert' :
               return $this->insert($req);
               break;
         case 'update':
               return $this->update($req);
               break;
         case 'delete':
               return $this->delete($req);
             }
  }

//   INSERT DATA
  public function insert(ProductFormRequest $req){
    $date = date("Y-m-d");
    if($req->file('p_img')){
         $image = $req->file('p_img');
         $fileName = $image->getClientOriginalName();

         $fileName = "IMG_.$date".preg_replace('/[^A-Za-z0-9.\-]/','',$fileName);
         $IMAGE_PATH = "/upload/product/image/";
         $image->move(public_path().$IMAGE_PATH,$fileName);
         $imageName = $IMAGE_PATH.$fileName;
    };
    $data = [
          'p_name'=>$req->input('p_name'),
          'p_desc'=>$req->input('p_desc'),
          'p_img'=>$imageName,
          'created_at' =>$date,
           ];
    $InsertData = ProductModel::insert($data);
     if($InsertData){
         $return = $this->returnMessage("Saved successfully.", true);
         return $return;
     }

}

// UPDATE TEAM
public function update(ProductFormRequest $req){
    $id = $req->input('id');
    if($id){
        $date = date("Y-m-d");
        if($req->file('p_img')){
             $image = $req->file('p_img');
             $fileName = $image->getClientOriginalName();

             $fileName = "IMG_.$date".preg_replace('/[^A-Za-z0-9.\-]/','',$fileName);
             $IMAGE_PATH = "/upload/product/image/";
             $image->move(public_path().$IMAGE_PATH,$fileName);
             $imageName = $IMAGE_PATH.$fileName;
        }else{
         $getImageData = ProductModel::find($id);
          if($getImageData['p_img']){
            $imageName = $getImageData['p_img'];
          }
        }

        $dataArray = [
            'p_name'=>$req->input('p_name'),
            'p_desc'=>$req->input('p_desc'),
            'p_img'=>$imageName,
              ];
   $UpdateData = ProductModel::where('id',$id)->update($dataArray);
    if($UpdateData){
        $return = $this->returnMessage("Update successfully.", true);
        return $return;
    }
    }else{
      return  $this->error("Id is required",200);

    }

}


// GET DATA BY ID
public function dataById(Request $request){
    try{
   if($request->input('id')){
      $GetDataById = ProductModel::find($request->input('id'));
      if($GetDataById){
       $return = $this->success("success",$GetDataById);
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


// DELETE DATA BY ID

public function delete(Request $req){
    try{
     $findById = ProductModel::find($req->input('id'));
      if($findById){
       $delete = $findById->delete();
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
