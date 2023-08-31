<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Login;
use App\Models\Room;
use App\Models\Tenant;
use App\Models\Maintenance;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class PropertyMaintenanceCtr extends Controller
{
    public function index(){
        if(Session::has('LoggedUser')){
            $users2 = DB::table('tbl_user')->where('id','=', session('LoggedUser'))->first();
            $user_tenant = Tenant::where('tenant_id','=', session('LoggedUser'))->first();
            $tenant_room = DB::table('tbl_room AS BR')
              ->select('BR.roomnumber','tbl_tenant.*')
              ->leftJoin('tbl_tenant', 'BR.id', '=', 'tbl_tenant.room_id')
              ->where('tbl_tenant.tenant_id', session('LoggedUser'))
              ->first();
             $data = [
                 'LoggedUserInfo' => $users2,
                 'TenantInfo' =>  $user_tenant,
                'TenantRoom' =>  $tenant_room,
             ];
             $users3 = Login::all();
             $users4 = Room::orderBy('id', 'ASC')->where('vacantnumber', '!=', 0)->where('status', '!=', 0)->get();
             return view('property-maintenance', $data)->with('users3',$users3)->with('users4',$users4);
         }
    }

    public function employeeindex(){
        if(Session::has('LoggedUser')){
            $users2 = DB::table('tbl_user')->where('id','=', session('LoggedUser'))->first();
             $data = [
                 'LoggedUserInfo' => $users2,
             ];
             $users3 = Login::all();
             $users4 = Room::orderBy('id', 'ASC')->where('vacantnumber', '!=', 0)->where('status', '!=', 0)->get();
             return view('employee-property-maintenance', $data);
         }
    }

    public function tenantpropertymaintenance_property(){
        $getEm = $this->getProperty();
        if(request()->ajax())
            {
            return datatables()->of($getEm)
            ->addColumn('action', function($getEm){
            $button = '<a class="btn btn-sm btn-success m-1" id="btn-edit-property" employer-id='. $getEm->maintenance_id .' data-toggle="modal" data-target="#EditPropertyModal">
                <i class="fa fa-edit"></i></a>';
                $button .= '<a class="btn btn-sm btn-danger m-1" id="btn-delete-property" employer-id='. $getEm->maintenance_id .' data-toggle="modal" data-target="#DeletePropertyModal">
                <i class="fa fa-archive"></i></a>';


            return $button;
        })
        ->rawColumns(['action'])
        ->make(true);
         }
    }

    public function employeepropertymaintenance_property(){
        $getEm = $this->getProperty();
        if(request()->ajax())
            {
            return datatables()->of($getEm)
            ->addColumn('action', function($getEm){
            $button = '<a class="btn btn-sm btn-success m-1" id="btn-edit-empproperty" employer-id='. $getEm->maintenance_id .' data-toggle="modal" data-target="#EmployeePropertyModal">
                <i class="fa fa-edit"></i></a>';
                $button .= '<a class="btn btn-sm btn-danger m-1" id="btn-delete-empproperty" employer-id='. $getEm->maintenance_id .' data-toggle="modal" data-target="#EmployeeDeletePropertyModal">
                <i class="fa fa-archive"></i></a>';


            return $button;
        })
        ->rawColumns(['action'])
        ->make(true);
         }
    }

    public function getProperty()
    {
        return DB::table('tbl_maintenance AS BR')
                ->select('BR.*','tbl_room.*','tbl_tenant.*', 'BR.id AS maintenance_id','BR.status AS maintenance_status')
                ->leftJoin('tbl_room', 'BR.room_id', '=', 'tbl_room.id')
                ->leftJoin('tbl_tenant', 'BR.user_id', '=', 'tbl_tenant.tenant_id')
                ->get();
    }

     //Add
     public function AddProperty(Request $request){
        $property = new Maintenance();
        $validateproperty =  Maintenance::where('maintenance_desc','=', $request->input('maintenance'))->first();
        if($validateproperty)
        {
            return back()->with('danger', 'Property Request Already Exist');
        }
        else
        {
            if($request->input('others') == 'none'){
                $property->user_id = session('LoggedUser');
                $property->maintenance_desc = $request->input('maintenance');
                $property->room_id = $request->input('property_roomid');
                $property->status = 0;
                $property->save();
            }
            else{
                $property->user_id = session('LoggedUser');
                $property->maintenance_desc = $request->input('others');
                $property->room_id = $request->input('property_roomid');
                $property->status = 0;
                $property->save();
            }
        // $getname = Session::get('Name');
        // $getusertype = Session::get('User-Type');
        // base::recordAction( $getname, $getusertype,'Category Maintenance', 'Add Category Successfully');
        // return redirect('maintenance-category')->with('success', 'Category Saved');
         return back()->with('success', 'Property Saved');
        }
    }

    function getPropertyInfoDetails($id){
        return DB::table('tbl_maintenance AS BR')
        ->select('BR.*','tbl_room.*','tbl_tenant.*', 'BR.id AS maintenance_id','BR.status AS maintenance_status')
        ->leftJoin('tbl_room', 'BR.room_id', '=', 'tbl_room.id')
        ->leftJoin('tbl_tenant', 'BR.user_id', '=', 'tbl_tenant.tenant_id')
        ->where('BR.id',$id)
        ->get();
    }

    function updateProperty(Request $request)
    {
        $id = $request->id;
        
        if($request->others == 'none')
        {
            $maintenance = $request->maintenance;
            $room_id = $request->room_id;
            return DB::table('tbl_maintenance')
                    ->where('id', $id)
                    ->update([
                        'maintenance_desc' => $maintenance,
                        'room_id' => $room_id,
                        'user_id' => session('LoggedUser'),
                        'created_at' => \Carbon\Carbon::now(),
                        'updated_at' => \Carbon\Carbon::now(),
                    ]);
        }
        else{
            $room_id = $request->room_id;
            $others = $request->others;
            return DB::table('tbl_maintenance')
                    ->where('id', $id)
                    ->update([
                        'maintenance_desc' => $others,
                        'room_id' => $room_id,
                        'user_id' => session('LoggedUser'),
                        'created_at' => \Carbon\Carbon::now(),
                        'updated_at' => \Carbon\Carbon::now(),
                    ]);
        }
    }

    function updateStatus(Request $request)
    {
        $id = $request->id;
        $status = $request->status;
            return DB::table('tbl_maintenance')
                    ->where('id', $id)
                    ->update([
                        'status' => $status,
                        'created_at' => \Carbon\Carbon::now(),
                        'updated_at' => \Carbon\Carbon::now(),
                    ]);
    }

    function DeleteProperty($id){
        return DB::table('tbl_maintenance')->where('id', $id)->delete();
    }
}
