<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TeamModel;
use App\Http\Requests\TeamFormRequest;
use App\Traits\CommonFunctions;
use Yajra\DataTables\Facades\DataTables;
use Exception;
use App\Traits\ResponseAPI;

class TeamController extends Controller
{

    use CommonFunctions;
    use ResponseAPI;

    public function index(){
        return view('Dashboard.Pages.Admin_team_manage');

       }
    //    Get All Data
    public function GetAllData(){
        $query = TeamModel::select('id','name','email','image','address','post','occupation','education','expertise','focus','message');
       return DataTables::of($query)
        ->addIndexColumn()
        ->addColumn('action',function($row){
          $btn_edt = '<a data-row_id= "'.$row->{'id'}.'"  href="javascript:void(0)" class="edit btn btn-primary btn-sm">Edit</a>';
           $btn_delete = '<a  onclick="DeleteData('.$row->{'id'}.')" href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
           return $btn_edt.$btn_delete;
        })
        ->rawColumns(['action','name'])
        ->make(true);
    }

    //All Actions like Add ,Edit , and delete for master function
    public function SaveMaster(TeamFormRequest $req){
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
    public function insert(TeamFormRequest $req){
        $date = date("Y-m-d");
        if($req->file('image')){
            $image = $req->file('image');
            $fileName = $image->getClientOriginalName();

            $fileName = "IMG_.$date".preg_replace('/[^A-Za-z0-9.\-]/','',$fileName);
            $IMAGE_PATH = "/upload/team/image/";
            $image->move(public_path().$IMAGE_PATH,$fileName);
            $imageName = $IMAGE_PATH.$fileName;
        };
        $data = [
            'name'=>$req->input('name'),
            'email'=>$req->input('email'),
            'image'=>$imageName,
            //   'address'=>$req->input('address'),
            'post'=>$req->input('post'),
            'occupation'=>$req->input('occupation'),
            'education'=>$req->input('education'),
            'expertise'=>$req->input('expertise'),
            'focus'=>$req->input('focus'),
            'message'=>$req->input('message'),
            'created_at' =>$date,
            ];
        $InsertData = TeamModel::insert($data);
        if($InsertData){
            $return = $this->returnMessage("Saved successfully.", true);
            return $return;
        }

    }

    // UPDATE TEAM
    public function update(TeamFormRequest $req){
        $id = $req->input('id');
        if($id){
            $date = date("Y-m-d");
            if($req->file('image')){
                $image = $req->file('image');
                $fileName = $image->getClientOriginalName();

                $fileName = "IMG_.$date".preg_replace('/[^A-Za-z0-9.\-]/','',$fileName);
                $IMAGE_PATH = "/upload/team/image/";
                $image->move(public_path().$IMAGE_PATH,$fileName);
                $imageName = $IMAGE_PATH.$fileName;
            }else{
            $getImageData = TeamModel::find($id);
            if($getImageData['image']){
                $imageName = $getImageData['image'];
            }
            }

        $dataArray = [
            'name'=>$req->input('name'),
            'email'=>$req->input('email'),
            'image'=>$imageName,
            // 'address'=>$req->input('address'),
            'post'=>$req->input('post'),
            'occupation'=>$req->input('occupation'),
            'education'=>$req->input('education'),
            'expertise'=>$req->input('expertise'),
            'focus'=>$req->input('focus'),
            'message'=>$req->input('message'),
            ];

    $UpdateData = TeamModel::where('id',$id)->update($dataArray);
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
        $GetDataById = TeamModel::find($request->input('id'));
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
    public function delete(Request $req)
    {
        try{
        $findById = TeamModel::find($req->input('id'));
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
