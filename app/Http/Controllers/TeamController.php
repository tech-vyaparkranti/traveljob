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

    public function index()
    {
        return view('Dashboard.Pages.Admin_team_manage');
    }
    
    // Get All Data
    public function GetAllData()
    {
        $query = TeamModel::select('id', 'name', 'post', 'message', 'image');

        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $btn_edt = '<a data-row_id="' . $row->id . '" href="javascript:void(0)" class="edit btn btn-primary btn-sm">Edit</a>';
                $btn_delete = '<a onclick="DeleteData(' . $row->id . ')" href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
                return $btn_edt . ' ' . $btn_delete;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    // All Actions like Add, Edit, and delete for master function
    public function SaveMaster(TeamFormRequest $req)
    {
        switch ($req->input('action')) {
            case 'insert':
                return $this->insert($req);
            case 'update':
                return $this->update($req);
            case 'delete':
                return $this->delete($req);
        }
    }

    // INSERT DATA
    public function insert(TeamFormRequest $req)
    {
        $date = date("Y-m-d");
        $imageName = null;

        if ($req->file('image')) {
            $image = $req->file('image');
            $fileName = $image->getClientOriginalName();
            $fileName = "IMG_.$date" . preg_replace('/[^A-Za-z0-9.\-]/', '', $fileName);
            $IMAGE_PATH = "/upload/team/image/";
            $image->move(public_path() . $IMAGE_PATH, $fileName);
            $imageName = $IMAGE_PATH . $fileName;
        }
        
        $data = [
            'name'       => $req->input('name'),
            'post'       => $req->input('post'),
            'message'    => $req->input('message'),   // ✅ added
            'image'      => $imageName,
            'created_at' => $date,
        ];
        
        $InsertData = TeamModel::insert($data);
        if ($InsertData) {
            return $this->returnMessage("Saved successfully.", true);
        }
        return $this->error("Something went wrong.", 500);
    }

    // UPDATE TEAM
    public function update(TeamFormRequest $req)
    {
        $id = $req->input('id');
        if ($id) {
            $date = date("Y-m-d");
            $imageName = TeamModel::find($id)->image;

            if ($req->file('image')) {
                $image = $req->file('image');
                $fileName = $image->getClientOriginalName();
                $fileName = "IMG_.$date" . preg_replace('/[^A-Za-z0-9.\-]/', '', $fileName);
                $IMAGE_PATH = "/upload/team/image/";
                $image->move(public_path() . $IMAGE_PATH, $fileName);
                $imageName = $IMAGE_PATH . $fileName;
            }

            $dataArray = [
                'name'    => $req->input('name'),
                'post'    => $req->input('post'),
                'message' => $req->input('message'),  // ✅ added
                'image'   => $imageName,
            ];

            $UpdateData = TeamModel::where('id', $id)->update($dataArray);
            if ($UpdateData) {
                return $this->returnMessage("Update successfully.", true);
            }
        } else {
            return $this->error("Id is required", 200);
        }
        return $this->error("Something went wrong.", 500);
    }

    // GET DATA BY ID
    public function dataById(Request $request)
    {
        try {
            if ($request->input('id')) {
                $GetDataById = TeamModel::find($request->input('id'));
                if ($GetDataById) {
                    return $this->success("success", $GetDataById);
                } else {
                    return $this->error("No data found.", 200);
                }
            } else {
                return $this->error("Id is required", 200);
            }
        } catch (Exception $exception) {
            $this->reportException($exception);
            return $this->error("Something Went Wrong.", 500);
        }
    }

    // DELETE DATA BY ID
    public function delete(Request $req)
    {
        try {
            $findById = TeamModel::find($req->input('id'));
            if ($findById) {
                $delete = $findById->delete();
                if ($delete) {
                    return $this->success("Delete Successfully", true);
                } else {
                    return $this->error("Something went wrong", 500);
                }
            }
        } catch (Exception $exception) {
            $this->reportException($exception);
            return $this->error("Something went wrong");
        }
    }
}
