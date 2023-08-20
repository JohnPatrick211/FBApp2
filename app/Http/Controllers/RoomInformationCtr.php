<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Login;
use App\Models\Room;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class RoomInformationCtr extends Controller
{
    public function index(){
        if(Session::has('LoggedUser')){
            $users2 = DB::table('tbl_user')->where('id','=', session('LoggedUser'))->first();
             $data = [
                 'LoggedUserInfo' => $users2
             ];
             $users3 = Login::all();
             $users4 = Room::orderBy('id', 'ASC')->where('vacantnumber', '!=', 0)->where('status', '!=', 0)->get();
             return view('room-information', $data)->with('users3',$users3)->with('users4',$users4);
         }
    }

    public function roominformation_room(){
        $getEm = $this->getRoomInfo();
        if(request()->ajax())
            {
            return datatables()->of($getEm)
            ->addColumn('action', function($getEm){
            $button = '<a class="btn btn-sm btn-primary m-1" id="btn-info-room" employer-id='. $getEm->id .' data-toggle="modal" data-target="#RoomInfoModal">
                <i class="fa fa-eye"></i></a>';

            return $button;
        })
        ->rawColumns(['action'])
        ->make(true);
         }
    }

    public function getRoomInfo()
    {
        return DB::table('tbl_room AS BR')
                ->select('BR.*')
                ->where('BR.status','=','1')
                ->get();
    }

    public function getRoomInfoDetails($id){
        return DB::table('tbl_room AS BR')
            ->select('BR.*')
            ->where('BR.id',$id)
            ->get();
    }

    public function roominformation_tenantroom($id){
        $getEm = $this->getTenantRoomInfo($id);
        if(request()->ajax())
            {
            return datatables()->of($getEm)
            ->addColumn('action', function($getEm){
            $button = '<a class="btn btn-sm btn-danger m-1" id="btn-archive-tenant" employer-id='. $getEm->tenant_id .' data-toggle="modal" data-target="#RoomTenantArchiveModal">
                <i class="fa fa-archive"></i></a>';

            return $button;
        })
        ->rawColumns(['action'])
        ->make(true);
         }
    }

    public function getTenantRoomInfo($id){
        return DB::table('tbl_tenant AS BR')
        ->select('BR.*', 'tbl_room.*', 'tbl_room.id AS roomid')
        ->leftJoin('tbl_room', 'BR.room_id', '=', 'tbl_room.id')
        ->where('BR.room_id',$id)
        ->where('BR.status',1)
        ->get();
    }

    //Archive
    public function ArchiveTenantRoom($id)
    {
        $roomid = DB::table('tbl_tenant AS BR')
        ->select('BR.room_id')
        ->where('BR.tenant_id',$id)
        ->get();

        $presentroomid = $roomid[0]->room_id;

        DB::table('tbl_tenant')
        ->where('tenant_id', $id)
        ->update([
            'status' => '0',
            'room_id' => 0
        ]);

        DB::table('tbl_room')
        ->where('id', $presentroomid)
        ->update([
            'vacantnumber' => DB::raw('vacantnumber +'. 1),
        ]);

        $aftergetDBvacantnumber = DB::table('tbl_room AS BR')
        ->select('BR.vacantnumber')
        ->where('BR.id',$presentroomid)
        ->get();
        $aftergetDBroomcapacity = DB::table('tbl_room AS BR')
        ->select('BR.roomcapacity')
        ->where('BR.id',$presentroomid)
        ->get();

        $latestroomcapacity = $aftergetDBroomcapacity[0]->roomcapacity;
        $latestvacantnumber = $aftergetDBvacantnumber[0]->vacantnumber;

        if($latestroomcapacity > $latestvacantnumber){
            if($latestvacantnumber == 0){
                DB::table('tbl_room')
                ->where('id', $presentroomid)
                ->update([
                    'isOccupied' => 1,
                ]);
            }
            else if( $latestvacantnumber <= -1){
                DB::table('tbl_room')
                ->where('id', $presentroomid)
                ->update([
                    'isOccupied' => 3,
                ]);
            }
            else{
                DB::table('tbl_room')
                ->where('id', $presentroomid)
                ->update([
                    'isOccupied' => 2,
                ]);
            }
        }
        else if($latestroomcapacity == $latestvacantnumber){
            DB::table('tbl_room')
            ->where('id', $presentroomid)
            ->update([
                'isOccupied' => 0,
            ]);
        }
        else if( $latestvacantnumber <= -1){
            DB::table('tbl_room')
            ->where('id', $presentroomid)
            ->update([
                'isOccupied' => 3,
            ]);
        }
        // $getname = Session::get('Name');
        // $getusertype = Session::get('User-Type');
        // base::recordAction( $getname, $getusertype,'Archive', 'Retrieve Patient Account Successfully ID number: '.$id);
    }
}
