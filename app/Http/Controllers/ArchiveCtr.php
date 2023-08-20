<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Login;
use App\Models\Room;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class ArchiveCtr extends Controller
{
    public function index(Request $request)
    {
        if(Session::has('LoggedUser')){
            $users2 = DB::table('tbl_user')->where('id','=', session('LoggedUser'))->first();
             $data = [
                 'LoggedUserInfo' => $users2
             ];
             $users3 = Login::all();
             $users4 = Room::orderBy('id', 'ASC')->where('vacantnumber', '!=', 0)->where('status', '!=', 1)->get();
             return view('archive', $data)->with('users3',$users3)->with('users4',$users4);
         }

    }
    //Archive Admin
    public function archive_admin(Request $request)
    {
            if(request()->ajax())
            {
                return datatables()->of($this->getArchiveAdmin())
                ->addColumn('action', function($b){
                    $button = ' <a class="btn btn-sm btn-primary" id="btn-retrieve-admin" employer-id="'. $b->admin_id .'"
                    data-toggle="modal" data-target="#retrieveAdminModal"><i class="fa fa-recycle"></i></a>';

                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
            }
    }
    public function getArchiveAdmin()
    {
        return DB::table('tbl_user AS BR')
        ->select('BR.*', 'tbl_admin.*')
        ->leftJoin('tbl_admin', 'BR.id', '=', 'tbl_admin.admin_id')
        ->where('tbl_admin.status','=','0')
        ->get();
    }

    public function archiveadmin_retrieve($id)
    {
        DB::table('tbl_admin')
        ->where('admin_id', $id)
        ->update([
            'status' => '1'
        ]);
        // $getname = Session::get('Name');
        // $getusertype = Session::get('User-Type');
        // base::recordAction( $getname, $getusertype,'Archive', 'Retrieve Patient Account Successfully ID number: '.$id);
    }
    // Archive Employee
    public function archive_employee(Request $request)
    {
            if(request()->ajax())
            {
                return datatables()->of($this->getArchiveEmployee())
                ->addColumn('action', function($b){
                    $button = ' <a class="btn btn-sm btn-primary" id="btn-retrieve-employee" employer-id="'. $b->emp_id .'"
                    data-toggle="modal" data-target="#retrieveEmployeeModal"><i class="fa fa-recycle"></i></a>';

                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
            }
    }
    public function getArchiveEmployee()
    {
        return DB::table('tbl_user AS BR')
        ->select('BR.*','tbl_employee.*')
        ->leftJoin('tbl_employee', 'BR.id', '=', 'tbl_employee.emp_id')
        ->where('tbl_employee.status','=','0')
        ->get();
    }

    public function archiveemployee_retrieve($id)
    {
        DB::table('tbl_employee')
        ->where('emp_id', $id)
        ->update([
            'status' => '1'
        ]);
        // $getname = Session::get('Name');
        // $getusertype = Session::get('User-Type');
        // base::recordAction( $getname, $getusertype,'Archive', 'Retrieve Patient Account Successfully ID number: '.$id);
    }

    // Archive Tenant
    public function archive_tenant(Request $request)
    {
            if(request()->ajax())
            {
                return datatables()->of($this->getArchiveTenant())
                ->addColumn('action', function($b){
                    $button = ' <a class="btn btn-sm btn-primary" id="btn-retrieve-tenant" employer-id="'. $b->tenant_id .'"
                    data-toggle="modal" data-target="#retrieveTenantModal"><i class="fa fa-recycle"></i></a>';

                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
            }
    }
    public function getArchiveTenant()
    {
        return DB::table('tbl_user AS BR')
                ->select('BR.*', 'tbl_tenant.*','tbl_room.*', 'tbl_tenant.id AS tenantid')
                ->leftJoin('tbl_tenant', 'BR.id', '=', 'tbl_tenant.tenant_id')
                ->leftJoin('tbl_room', 'tbl_tenant.room_id', '=', 'tbl_room.id')
                ->where('tbl_tenant.status','=','0')
                ->get();
    }

    public function archivetenant_retrieve($id)
    {
        DB::table('tbl_tenant')
        ->where('tenant_id', $id)
        ->update([
            'status' => '1'
        ]);
        // $getname = Session::get('Name');
        // $getusertype = Session::get('User-Type');
        // base::recordAction( $getname, $getusertype,'Archive', 'Retrieve Patient Account Successfully ID number: '.$id);
    }

    // Archive Room
    public function archive_room(Request $request)
    {
            if(request()->ajax())
            {
                return datatables()->of($this->getArchiveRoom())
                ->addColumn('action', function($b){
                    $button = ' <a class="btn btn-sm btn-primary" id="btn-retrieve-room" employer-id="'. $b->id .'"
                    data-toggle="modal" data-target="#retrieveRoomModal"><i class="fa fa-recycle"></i></a>';

                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
            }
    }
    public function getArchiveRoom()
    {
        return DB::table('tbl_room AS BR')
                ->select('BR.*')
                ->where('BR.status','=','0')
                ->get();
    }

    public function archiveroom_retrieve($id)
    {
        DB::table('tbl_room')
        ->where('id', $id)
        ->update([
            'status' => '1'
        ]);
        // $getname = Session::get('Name');
        // $getusertype = Session::get('User-Type');
        // base::recordAction( $getname, $getusertype,'Archive', 'Retrieve Patient Account Successfully ID number: '.$id);
    }
}
