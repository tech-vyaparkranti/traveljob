<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ReportModel;
use Exception;
use App\Http\Requests\ReportFormRequest;
use App\Traits\ResponseAPI;
use App\Traits\CommonFunctions;
use Yajra\DataTables\Facades\DataTables;


class ReportController extends Controller
{
    use ResponseAPI;
    use CommonFunctions;
    public function index(){
        return  view('Dashboard.Pages.Admin_report_manage');
   }

   public function  GetAllData(){
      $query = ReportModel::select('id','r_session','file');
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
public function SaveMaster(ReportFormRequest $req){
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
public function insert(ReportFormRequest $req){
$date = date("Y-m-d");
if($req->file('file')){
$image = $req->file('file');
$fileName = $image->getClientOriginalName();

$fileName = "IMG_.$date".preg_replace('/[^A-Za-z0-9.\-]/','',$fileName);
$IMAGE_PATH = "/upload/report/image/";
$image->move(public_path().$IMAGE_PATH,$fileName);
$imageName = $IMAGE_PATH.$fileName;
};
$data = [
  'r_session'=>$req->input('r_session'),
 'file'=>$imageName,
 'created_at' =>$date,
  ];
$InsertData = ReportModel::insert($data);
if($InsertData){
$return = $this->returnMessage("Saved successfully.", true);
return $return;
}

}

// UPDATE TEAM
public function update(ReportFormRequest $req){
$id = $req->input('id');
if($id){
$date = date("Y-m-d");
if($req->file('file')){
    $image = $req->file('file');
    $fileName = $image->getClientOriginalName();

    $fileName = "IMG_.$date".preg_replace('/[^A-Za-z0-9.\-]/','',$fileName);
    $IMAGE_PATH = "/upload/report/image/";
    $image->move(public_path().$IMAGE_PATH,$fileName);
    $imageName = $IMAGE_PATH.$fileName;
}else{
$getImageData = ReportModel::find($id);
 if($getImageData['file']){
   $imageName = $getImageData['file'];
 }
}

$dataArray = [
     'r_session'=>$req->input('r_session'),
      'file'=>$imageName,
     ];
$UpdateData = ReportModel::where('id',$id)->update($dataArray);
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
$GetDataById = ReportModel::find($request->input('id'));
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
$findById = ReportModel::find($req->input('id'));
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
