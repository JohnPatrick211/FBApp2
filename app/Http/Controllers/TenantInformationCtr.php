<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Login;
use App\Models\Room;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class TenantInformationCtr extends Controller
{
    public function index(){
        if(Session::has('LoggedUser')){
            $users2 = DB::table('tbl_user')->where('id','=', session('LoggedUser'))->first();
             $data = [
                 'LoggedUserInfo' => $users2
             ];
             $users3 = Login::all();
             $users4 = Room::orderBy('id', 'ASC')->where('vacantnumber', '!=', 0)->where('status', '!=', 0)->get();
             return view('tenant-information', $data)->with('users3',$users3)->with('users4',$users4);
         }
    }

    public function tenantinformation_tenant(){
        $getEm = $this->getTenantInfo();
        if(request()->ajax())
            {
            return datatables()->of($getEm)
            ->addColumn('action', function($getEm){
            $button = '<a class="btn btn-sm btn-primary m-1" id="btn-info-tenant" employer-id='. $getEm->tenant_id .' data-toggle="modal" data-target="#TenantInfoModal">
                <i class="fa fa-eye"></i></a>';

            return $button;
        })
        ->rawColumns(['action'])
        ->make(true);
         }
    }

    public function getTenantInfo(){
        return DB::table('tbl_tenant AS BR')
        ->select('BR.*')
        ->where('BR.status',1)
        ->get();
    }

    public function getTenantInfoDetails($id)
    {
            return DB::table('tbl_tenant AS BR')
            ->select('BR.*', 'tbl_room.*', 'tbl_room.roomnumber AS room_number')
            ->leftJoin('tbl_room', 'BR.room_id', '=', 'tbl_room.id')
            ->where('BR.tenant_id',$id)
            ->get();
        
    }
}
