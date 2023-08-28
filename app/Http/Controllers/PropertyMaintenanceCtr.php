<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Login;
use App\Models\Room;
use App\Models\Maintenance;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class PropertyMaintenanceCtr extends Controller
{
    public function index(){
        if(Session::has('LoggedUser')){
            $users2 = DB::table('tbl_user')->where('id','=', session('LoggedUser'))->first();
             $data = [
                 'LoggedUserInfo' => $users2
             ];
             $users3 = Login::all();
             $users4 = Room::orderBy('id', 'ASC')->where('vacantnumber', '!=', 0)->where('status', '!=', 0)->get();
             return view('property-maintenance', $data)->with('users3',$users3)->with('users4',$users4);
         }
    }

    public function tenantpropertymaintenance_property(){
        $getEm = $this->getProperty();
        if(request()->ajax())
            {
            return datatables()->of($getEm)
            ->addColumn('action', function($getEm){
            $button = '<a class="btn btn-sm btn-success m-1" id="btn-edit-property" employer-id='. $getEm->id .' data-toggle="modal" data-target="#editRoomModal">
                <i class="fa fa-edit"></i></a>';
                $button .= '<a class="btn btn-sm btn-danger m-1" id="btn-delete-property" employer-id='. $getEm->id .' data-toggle="modal" data-target="#RoomArchiveModal">
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
}
