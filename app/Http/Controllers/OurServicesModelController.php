<?php

namespace App\Http\Controllers;

use App\Http\Requests\OurServicesRequest;
use App\Http\Requests\StoreOurServicesModelRequest;
use App\Http\Requests\UpdateOurServicesModelRequest;
use App\Models\OurServicesModel;
use App\Traits\CommonFunctions;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Yajra\DataTables\Facades\DataTables;

class OurServicesModelController extends Controller
{
    use CommonFunctions;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function viewOurServicesMaster()
    {
        return view("Dashboard.Pages.ourServicesAdmin");
    }

    /**
     * saveOurServicesMaster
     *
     * @param  mixed $request
     * @return void
     */
    public function saveOurServicesMaster(OurServicesRequest $request)
    {
        // print_r($request->input("action"));die;
        Cache::forget("our_services");
        switch ($request->input("action")) {
            case "insert":
                $return = $this->insertData($request);
                break;
            case "update":
                $return = $this->updateData($request);
                break;
            case "enable":
                $return = $this->enableRow($request);
                break;
            case "disable":
                $return = $this->disableRow($request);
                break;
            default:
                $return = ["status" => false, "message" => "Unknown action.", "data" => null];
        }
        return response()->json($return);
    }

    /**
     * insertData
     *
     * @param  mixed $request
     * @return void
     */
    public function insertData(OurServicesRequest $request)
    {
        $checkDuplicate = OurServicesModel::where(OurServicesModel::SERVICE_NAME, $request->input(OurServicesModel::SERVICE_NAME))->first();

        if ($checkDuplicate) {
            $return = $this->returnMessage("Service name is already taken");
        } else {
            $imageName = null;
            if($request->file(OurServicesModel::SERVICE_IMAGE)){
                $image = $request->file(OurServicesModel::SERVICE_IMAGE);
                $fileName = $image->getClientOriginalName();
                $date = date("Y-m-d");
                $fileName = "Img_$date".preg_replace('/[^A-Za-z0-9.\-]/', '', $fileName);
                $image->move(public_path().OurServicesModel::SERVICE_IMAGE_PATH,$fileName);
                $imageName = OurServicesModel::SERVICE_IMAGE_PATH.$fileName;
            }

            $createNewRow = new OurServicesModel();
            $createNewRow->{OurServicesModel::SERVICE_NAME} = $request->input(OurServicesModel::SERVICE_NAME);
            // $createNewRow->{OurServicesModel::SERVICE_ICON} = $request->input(OurServicesModel::SERVICE_ICON); // Removed
            // $createNewRow->{OurServicesModel::SERVICE_DETAILS} = $request->input(OurServicesModel::SERVICE_DETAILS); // Removed
            $createNewRow->{OurServicesModel::POSITION} = $request->input(OurServicesModel::POSITION);
            $createNewRow->{OurServicesModel::STATUS} = 1;
            $createNewRow->{OurServicesModel::SERVICE_IMAGE} = $imageName;
            $createNewRow->{OurServicesModel::CREATED_BY} = Auth::user()->id;
            $createNewRow->save();
            $return = $this->returnMessage("Saved successfully.", true);
        }
        return $return;
    }

    /**
     * updateData
     *
     * @param  mixed $request
     * @return void
     */
    public function  updateData(OurServicesRequest $request)
    {
        $checkDuplicate = OurServicesModel::where([
            [OurServicesModel::SERVICE_NAME, $request->input(OurServicesModel::SERVICE_NAME)],
            [OurServicesModel::ID, "<>", $request->input(OurServicesModel::ID)]
        ])->first();

        if ($checkDuplicate) {
            $return = $this->returnMessage("Service name is already taken");
        } else {
            $updateModel = OurServicesModel::find($request->input(OurServicesModel::ID));

            if ($request->file(OurServicesModel::SERVICE_IMAGE)) {
                $image = $request->file(OurServicesModel::SERVICE_IMAGE);
                $fileName = $image->getClientOriginalName();
                $date = date("Y-m-d");
                $fileName = "Img_$date".preg_replace('/[^A-Za-z0-9.\-]/', '', $fileName);
                $image->move(public_path().OurServicesModel::SERVICE_IMAGE_PATH, $fileName);
                $updateModel->{OurServicesModel::SERVICE_IMAGE} = OurServicesModel::SERVICE_IMAGE_PATH.$fileName;
            }

            $updateModel->{OurServicesModel::SERVICE_NAME} = $request->input(OurServicesModel::SERVICE_NAME);
            // $updateModel->{OurServicesModel::SERVICE_ICON} = $request->input(OurServicesModel::SERVICE_ICON); // Removed
            // $updateModel->{OurServicesModel::SERVICE_DETAILS} = $request->input(OurServicesModel::SERVICE_DETAILS); // Removed
            $updateModel->{OurServicesModel::POSITION} = $request->input(OurServicesModel::POSITION);
            $updateModel->{OurServicesModel::STATUS} = 1;
            $updateModel->{OurServicesModel::UPDATED_BY} = Auth::user()->id;
            $updateModel->save();
            $return = $this->returnMessage("Service Update successfully.", true);
        }
        return $return;
    }

    /**
     * enableRow
     *
     * @param  mixed $request
     * @return void
     */

    public function enableRow(OurServicesRequest $request)
    {
        $check = OurServicesModel::where(OurServicesModel::ID, $request->input(OurServicesModel::ID))->first();
        if ($check) {
            $check->{OurServicesModel::STATUS} = 1;
            $check->{OurServicesModel::UPDATED_BY} = Auth::user()->id;
            $check->save();

            $return = $this->returnMessage("Enabled successfully.", true);
        } else {
            $return = $this->returnMessage("Details not found.");
        }
        return $return;
    }

    /**
     * disableRow
     *
     * @param  mixed $request
     * @return void
     */
    public function disableRow(OurServicesRequest $request)
    {
        $check = OurServicesModel::where(OurServicesModel::ID, $request->input(OurServicesModel::ID))->first();
        if ($check) {
            $check->{OurServicesModel::STATUS} = 0;
            $check->{OurServicesModel::UPDATED_BY} = Auth::user()->id;
            $check->save();

            $return = $this->returnMessage("Disabled successfully.", true);
        } else {
            $return = $this->returnMessage("Details not found.");
        }
        return $return;
    }

    /**
     * ourServicesData
     *
     * @return void
     */
    public function ourServicesData()
    {
        $query = OurServicesModel::select(
            OurServicesModel::SERVICE_NAME,
            OurServicesModel::SERVICE_IMAGE,
            OurServicesModel::POSITION,
            OurServicesModel::STATUS,
            OurServicesModel::ID
        );
        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $btn_edit = '<a data-row="' . base64_encode(json_encode($row)) . '" href="javascript:void(0)" class="edit btn btn-primary btn-sm">Edit</a>';

                $btn_disable = ' <a  href="javascript:void(0)" onclick="Disable(' . $row->{OurServicesModel::ID} . ')" class="btn btn-danger btn-sm">Disable</a>';
                $btn_enable = ' <a  href="javascript:void(0)" onclick="Enable(' . $row->{OurServicesModel::ID} . ')" class="btn btn-primary btn-sm">Enable</a>';
                if ($row->{OurServicesModel::STATUS} == 1) {
                    return $btn_edit . $btn_disable;
                } else {
                    return $btn_edit . $btn_enable;
                }
            })
            ->rawColumns(['action'])
            ->make(true);
    }
    public function getHomePageServices()
    {
        try {
            $homeServices = Cache::get("our_services");
            if (empty($homeServices)) {
                Cache::forget("our_services");
                $homeServices = OurServicesModel::where(OurServicesModel::STATUS, 1)
                    ->select(OurServicesModel::SERVICE_NAME, OurServicesModel::SERVICE_IMAGE)
                    ->orderBy(OurServicesModel::POSITION, "asc")
                    ->get();
                Cache::forever("our_services", $homeServices);

            }
            return response()->json($homeServices);
        } catch (Exception $exception) {
            $this->reportException($exception);
        }
    }
}