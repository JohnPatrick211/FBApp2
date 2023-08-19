<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Login;
use App\Models\Room;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class RoomMaintenanceCtr extends Controller
{
    public function index(){
        if(Session::has('LoggedUser')){
            $users2 = DB::table('tbl_user')->where('id','=', session('LoggedUser'))->first();
             $data = [
                 'LoggedUserInfo' => $users2
             ];
             $users3 = Login::all();
             $users4 = Room::orderBy('id', 'ASC')->where('vacantnumber', '!=', 1)->get();
             return view('room-maintenance', $data)->with('users3',$users3)->with('users4',$users4);
         }
    }

    public function roommaintenance_room(){
        $getEm = $this->getRoom();
        if(request()->ajax())
            {
            return datatables()->of($getEm)
            ->addColumn('action', function($getEm){
            $button = '<a class="btn btn-sm btn-success m-1" id="btn-edit-room" employer-id="'. $getEm->id .'data-toggle="modal" data-target="#editRoomModal">
                <i class="fa fa-edit"></i></a>';
                $button .= '<a class="btn btn-sm btn-danger m-1" id="btn-archive-room" employer-id='. $getEm->id .' data-toggle="modal" data-target="#RoomArchiveModal">
                <i class="fa fa-archive"></i></a>';


            return $button;
        })
        ->rawColumns(['action'])
        ->make(true);
         }
    }

    public function getRoom()
    {
        return DB::table('tbl_room AS BR')
                ->select('BR.*')
                ->where('BR.status','=','1')
                ->get();
    }

    //Add

    //get Room

    //Edit

    //Archive
    public function ArchiveRoom($id)
    {
        DB::table('tbl_room')
        ->where('id', $id)
        ->update([
            'status' => '0'
        ]);
        // $getname = Session::get('Name');
        // $getusertype = Session::get('User-Type');
        // base::recordAction( $getname, $getusertype,'Archive', 'Retrieve Patient Account Successfully ID number: '.$id);
    }
}
