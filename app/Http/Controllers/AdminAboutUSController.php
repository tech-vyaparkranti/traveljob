<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AboutUsModel;
use App\Http\Requests\AboutUsRequest;
use App\Traits\CommonFunctions;
use Yajra\DataTables\Facades\DataTables;
use Exception;
use App\Traits\ResponseAPI;
use Illuminate\Support\Facades\File;


class AdminAboutUSController extends Controller
{
    use CommonFunctions;
    use ResponseAPI;

    public function index()
    {
        return view('Dashboard.Pages.About-us-manage');
    }

    public function GetAllData()
    {
        // Add 'about_image' to the select statement
        $query = AboutUsModel::select('id', 'about_image', 'about_desc', 'sort_about_us');
        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('about_image', function ($row) {
                if ($row->about_image) {
                    return '<img src="' . asset($row->about_image) . '" width="100px">';
                }
                return 'No Image';
            })
            ->addColumn('action', function ($row) {
                $btn_edt = '<a data-row_id= "' . $row->{'id'} . '"  href="javascript:void(0)" class="edit btn btn-primary btn-sm">Edit</a>';
                $btn_delete = '<a  onclick="DeleteAboutData(' . $row->{'id'} . ')" href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
                return $btn_edt . $btn_delete;
            })
            // Add 'about_image' to rawColumns to render the HTML correctly
            ->rawColumns(['action', 'about_desc', 'about_image'])
            ->make(true);
    }

    public function SaveMaster(AboutUsRequest $req)
    {
        switch ($req->input('action')) {
            case 'insert':
                return $this->insert($req);
                break;
            case 'update':
                return $this->update($req);
                break;
            case 'delete':
                return $this->delete($req);
                break;
        }
    }

    public function insert(AboutUsRequest $req)
    {
        $date = date("Y-m-d");
        $imageName = null;

        // Handle image upload
        if ($req->file('about_image')) {
            $image = $req->file('about_image');
            $fileName = time() . '_' . $image->getClientOriginalName();
            $ABOUT_IMAGE_PATH = "upload/about/image/";
            $image->move(public_path($ABOUT_IMAGE_PATH), $fileName);
            $imageName = $ABOUT_IMAGE_PATH . $fileName;
        }

        $data = [
            'about_desc' => $req->input('about_desc'),
            'sort_about_us' => $req->input('sort_about_us'),
            'about_image' => $imageName,
            'created_at' => $date,
        ];
        
        $InsertData = AboutUsModel::create($data); // Using create() is better here

        if ($InsertData) {
            return $this->returnMessage("Saved successfully.", true);
        } else {
            return $this->error("Failed to save data.", 500);
        }
    }

    public function update(AboutUsRequest $req)
    {
        $id = $req->input('id');
        if ($id) {
            $date = date("Y-m-d");
            $aboutUs = AboutUsModel::find($id);
            if (!$aboutUs) {
                return $this->error("Record not found.", 404);
            }

            $dataArray = [
                'about_desc' => $req->input('about_desc'),
                'sort_about_us' => $req->input('sort_about_us'),
            ];

            // Handle image update
            if ($req->hasFile('about_image')) {
                // Delete the old image if it exists
                if ($aboutUs->about_image && File::exists(public_path($aboutUs->about_image))) {
                    File::delete(public_path($aboutUs->about_image));
                }

                $image = $req->file('about_image');
                $fileName = time() . '_' . $image->getClientOriginalName();
                $ABOUT_IMAGE_PATH = "upload/about/image/";
                $image->move(public_path($ABOUT_IMAGE_PATH), $fileName);
                $dataArray['about_image'] = $ABOUT_IMAGE_PATH . $fileName;
            }

            $UpdateData = $aboutUs->update($dataArray);

            if ($UpdateData) {
                return $this->returnMessage("Update successfully.", true);
            } else {
                return $this->error("Failed to update data.", 500);
            }
        } else {
            return $this->error("Id is required", 400);
        }
    }

    public function dataById(Request $request)
    {
        try {
            if ($request->input('id')) {
                $GetDataById = AboutUsModel::find($request->input('id'));
                if ($GetDataById) {
                    $return = $this->success("success", $GetDataById);
                } else {
                    $return = $this->error("No data found.", 200);
                }
            } else {
                $return = $this->error("Id is required", 200);
            }
        } catch (Exception $exception) {
            $this->reportException($exception);
            $return = $this->error("Something Went Wrong.", 500);
        }
        return $return;
    }

    public function delete(Request $req)
    {
        try {
            $findById = AboutUsModel::find($req->input('id'));
            if ($findById) {
                // Delete the associated image file from the server
                if ($findById->about_image && File::exists(public_path($findById->about_image))) {
                    File::delete(public_path($findById->about_image));
                }

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
