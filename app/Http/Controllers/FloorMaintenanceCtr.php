<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Login;
use App\Models\Floor;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class FloorMaintenanceCtr extends Controller
{
    public function index(){
        if(Session::has('LoggedUser')){
            $users2 = DB::table('tbl_user')->where('id','=', session('LoggedUser'))->first();
             $data = [
                 'LoggedUserInfo' => $users2
             ];
             $users3 = Login::all();
             return view('floor-maintenance', $data)->with('users3',$users3);
         }
    }

    public function floormaintenance_floor(){
        $getEm = $this->getFloor();
        if(request()->ajax())
            {
            return datatables()->of($getEm)
            ->addColumn('action', function($getEm){
            $button = '<a class="btn btn-sm btn-success m-1" id="btn-edit-floor" employer-id='. $getEm->id .' data-toggle="modal" data-target="#editFloorModal">
                <i class="fa fa-edit"></i></a>';
                $button .= '<a class="btn btn-sm btn-danger m-1" id="btn-archive-floor" employer-id='. $getEm->id .' data-toggle="modal" data-target="#FloorArchiveModal">
                <i class="fa fa-archive"></i></a>';


            return $button;
        })
        ->rawColumns(['action'])
        ->make(true);
         }
    }

    public function getFloor()
    {
        return DB::table('tbl_floor AS BR')
                ->select('BR.*')
                ->get();
    }

    //Add
    public function AddFloor(Request $request){
        $room = new Floor();
        $validateroom =  Floor::where('floornumber','=', $request->input('floornumber'))->first();
        if($validateroom)
        {
            return back()->with('danger', 'Floor Already Exist');
        }
        else
        {
        $room->floornumber = $request->input('floornumber');
        $room->no_of_room = $request->input('no_of_room');
        $room->save();
        // $getname = Session::get('Name');
        // $getusertype = Session::get('User-Type');
        // base::recordAction( $getname, $getusertype,'Category Maintenance', 'Add Category Successfully');
        // return redirect('maintenance-category')->with('success', 'Category Saved');
         return back()->with('success', 'Floor Saved');
        }
    }

    //get Floor
    public function getRoomDetails($id){
        return DB::table('tbl_floor AS BR')
            ->select('BR.*')
            ->where('BR.id',$id)
            ->get();
    }
    //Edit
    public function updateRoom(Request $request){
        $id = $request->id;
        $floornumber = $request->floornumber;
        $no_of_room = $request->no_of_room;

        $existroom = Floor::where('floornumber', '=', $floornumber)->first();
        
        if($existroom){
            return 1;  
        }
        else{
            DB::table('tbl_floor')
            ->where('id', $id)
            ->update([
                'floornumber' => $floornumber,
                'no_of_room' => $no_of_room,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ]);
        }

            // $getname = Session::get('Name');
            // $getusertype = Session::get('User-Type');
            // base::recordAction( $getname, $getusertype,'User Maintenance', 'update');
    }
    //Archive
    public function ArchiveFloor($id)
    {
        DB::table('tbl_floor')
        ->where('id', $id)
        ->delete();
        // $getname = Session::get('Name');
        // $getusertype = Session::get('User-Type');
        // base::recordAction( $getname, $getusertype,'Archive', 'Retrieve Patient Account Successfully ID number: '.$id);
    }
}
