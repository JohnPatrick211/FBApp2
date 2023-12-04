<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Login;
use App\Models\Room;
use App\Models\Floor;
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
             $users4 = Room::orderBy('id', 'ASC')->where('vacantnumber', '!=', 0)->where('status', '!=', 0)->get();
             $users5 = Floor::orderBy('id', 'ASC')->get();
             return view('room-maintenance', $data)->with('users3',$users3)->with('users4',$users4)->with('users5',$users5);
         }
    }

    public function roommaintenance_room(){
        $getEm = $this->getRoom();
        if(request()->ajax())
            {
            return datatables()->of($getEm)
            ->addColumn('action', function($getEm){
            $button = '<a class="btn btn-sm btn-success m-1" id="btn-edit-room" employer-id='. $getEm->id .' data-toggle="modal" data-target="#editRoomModal">
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
                ->select('BR.*','tbl_floor.floornumber')
                ->leftJoin('tbl_floor', 'BR.floor_id', '=', 'tbl_floor.id')
                ->where('BR.status','=','1')
                ->get();
    }

    //Add
    public function AddRoom(Request $request){
        $room = new Room();
        $validateroom =  Room::where('roomnumber','=', $request->input('roomnumber'))->first();
        if($validateroom)
        {
            return back()->with('danger', 'Room Already Exist');
        }
        else
        {
        $room->roomnumber = $request->input('roomnumber');
        $room->roomcapacity = $request->input('roomcapacity');
        $room->floor_id = $request->input('floor');
        $room->isOccupied = 0;
        $room->vacantnumber = $request->input('roomcapacity');
        $room->status = 1;
        $room->save();
        // $getname = Session::get('Name');
        // $getusertype = Session::get('User-Type');
        // base::recordAction( $getname, $getusertype,'Category Maintenance', 'Add Category Successfully');
        // return redirect('maintenance-category')->with('success', 'Category Saved');
         return back()->with('success', 'Room Saved');
        }
    }

    //get Room
    public function getRoomDetails($id){
        return DB::table('tbl_room AS BR')
            ->select('BR.*','tbl_floor.floornumber')
            ->leftJoin('tbl_floor', 'BR.floor_id', '=', 'tbl_floor.id')
            ->where('BR.id',$id)
            ->get();
    }
    //Edit
    public function updateRoom(Request $request){
        $id = $request->id;
        $roomnumber = $request->roomnumber;
        $roomcapacity = $request->roomcapacity;
        $getDBvacantnumber = DB::table('tbl_room AS BR')
        ->select('BR.vacantnumber')
        ->where('BR.id',$id)
        ->get();
        $getDBroomnumber = DB::table('tbl_room AS BR')
        ->select('BR.roomnumber')
        ->where('BR.id',$id)
        ->get();
        $getDBroomcapacity = DB::table('tbl_room AS BR')
        ->select('BR.roomcapacity')
        ->where('BR.id',$id)
        ->get();

        $existroom = Room::where('roomnumber', '=', $roomnumber)->first();

        $presentroomcapacity = $getDBroomcapacity[0]->roomcapacity;
        $presentroomnumber = $getDBroomnumber[0]->roomnumber;
        $vacantnumber = $getDBvacantnumber[0]->vacantnumber;

        $increment2 =  $vacantnumber - $roomcapacity;


        
        if($vacantnumber <= 0 && $roomcapacity <= $presentroomcapacity){
            return 0;
        }
        else if($existroom){
            if($presentroomnumber == $roomnumber){
                if($vacantnumber <= 0 && $roomcapacity <= $presentroomcapacity){
                    return 0;
                }
                // else if($increment2 < 0){
                //     return 0;
                // }
                else{
                    $increment =  $roomcapacity - $presentroomcapacity;
                    DB::table('tbl_room')
                    ->where('id', $id)
                    ->update([
                        'roomcapacity' => DB::raw('roomcapacity +'. $increment),
                        'vacantnumber' => DB::raw('vacantnumber +'. $increment),
                        'created_at' => \Carbon\Carbon::now(),
                        'updated_at' => \Carbon\Carbon::now(),
                    ]);

                    $aftergetDBvacantnumber = DB::table('tbl_room AS BR')
                    ->select('BR.vacantnumber')
                    ->where('BR.id',$id)
                    ->get();
                    $aftergetDBroomcapacity = DB::table('tbl_room AS BR')
                    ->select('BR.roomcapacity')
                    ->where('BR.id',$id)
                    ->get();

                    $latestroomcapacity = $aftergetDBroomcapacity[0]->roomcapacity;
                    $latestvacantnumber = $aftergetDBvacantnumber[0]->vacantnumber;

                    if($latestroomcapacity > $latestvacantnumber){
                        if($latestvacantnumber == 0){
                            DB::table('tbl_room')
                            ->where('id', $id)
                            ->update([
                                'isOccupied' => 1,
                            ]);
                        }
                        else if( $latestvacantnumber <= -1){
                            DB::table('tbl_room')
                            ->where('id', $id)
                            ->update([
                                'isOccupied' => 3,
                            ]);
                        }
                        else{
                            DB::table('tbl_room')
                            ->where('id', $id)
                            ->update([
                                'isOccupied' => 2,
                            ]);
                        }
                    }
                    else if($latestroomcapacity == $latestvacantnumber){
                        DB::table('tbl_room')
                        ->where('id', $id)
                        ->update([
                            'isOccupied' => 0,
                        ]);
                    }
                    else if( $latestvacantnumber <= -1){
                        DB::table('tbl_room')
                        ->where('id', $id)
                        ->update([
                            'isOccupied' => 3,
                        ]);
                    }
                
                return 'success1';

                }
                
            }
            else{
                return 1;
            }
            
        }
        else{

            $increment =  $roomcapacity - $presentroomcapacity;
            DB::table('tbl_room')
            ->where('id', $id)
            ->update([
                'roomnumber' => $roomnumber,
                'roomcapacity' => DB::raw('roomcapacity +'. $increment),
                'vacantnumber' => DB::raw('vacantnumber +'. $increment),
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ]);

            $aftergetDBvacantnumber = DB::table('tbl_room AS BR')
            ->select('BR.vacantnumber')
            ->where('BR.id',$id)
            ->get();
            $aftergetDBroomcapacity = DB::table('tbl_room AS BR')
            ->select('BR.roomcapacity')
            ->where('BR.id',$id)
            ->get();

            $latestroomcapacity = $aftergetDBroomcapacity[0]->roomcapacity;
            $latestvacantnumber = $aftergetDBvacantnumber[0]->vacantnumber;

            if($latestroomcapacity > $latestvacantnumber){
                if($latestvacantnumber == 0){
                    DB::table('tbl_room')
                    ->where('id', $id)
                    ->update([
                        'isOccupied' => 1,
                    ]);
                }
                else if( $latestvacantnumber <= -1){
                    DB::table('tbl_room')
                    ->where('id', $id)
                    ->update([
                        'isOccupied' => 3,
                    ]);
                }
                else{
                    DB::table('tbl_room')
                    ->where('id', $id)
                    ->update([
                        'isOccupied' => 2,
                    ]);
                }
            }
            else if( $latestvacantnumber <= -1){
                DB::table('tbl_room')
                ->where('id', $id)
                ->update([
                    'isOccupied' => 3,
                ]);
            }
            else if($latestroomcapacity == $latestvacantnumber){
                DB::table('tbl_room')
                ->where('id', $id)
                ->update([
                    'isOccupied' => 0,
                ]);
            }
            
            return 'success';
        }

            // $getname = Session::get('Name');
            // $getusertype = Session::get('User-Type');
            // base::recordAction( $getname, $getusertype,'User Maintenance', 'update');
    }
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
