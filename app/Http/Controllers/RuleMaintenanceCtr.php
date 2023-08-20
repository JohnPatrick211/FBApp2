<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Login;
use App\Models\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class RuleMaintenanceCtr extends Controller
{
    public function index(){
        if(Session::has('LoggedUser')){
            $users2 = DB::table('tbl_user')->where('id','=', session('LoggedUser'))->first();
             $data = [
                 'LoggedUserInfo' => $users2
             ];
             $users3 = Login::all();
            // $users4 = Room::orderBy('id', 'ASC')->where('vacantnumber', '!=', 0)->where('status', '!=', 0)->get();
             return view('rule-maintenance', $data)->with('users3',$users3);
         }
    }

    public function getRuleDetails($id){
        return DB::table('tbl_rule AS BR')
            ->select('BR.*')
            ->where('BR.id',$id)
            ->get();
    }

    public function updateRule(Request $request){
        $rule = Rule::find(1);
        $rule->description = $request->input('rule');
        $rule->save();
        // $getname = Session::get('Name');
        // $getusertype = Session::get('User-Type');
        // base::recordAction( $getname, $getusertype,'Category Maintenance', 'Add Category Successfully');
        // return redirect('maintenance-category')->with('success', 'Category Saved');
         return back()->with('success', 'Rule Saved');   
    }

    // public function roommaintenance_room(){
    //     $getEm = $this->getRoom();
    //     if(request()->ajax())
    //         {
    //         return datatables()->of($getEm)
    //         ->addColumn('action', function($getEm){
    //         $button = '<a class="btn btn-sm btn-success m-1" id="btn-edit-room" employer-id='. $getEm->id .' data-toggle="modal" data-target="#editRoomModal">
    //             <i class="fa fa-edit"></i></a>';
    //             $button .= '<a class="btn btn-sm btn-danger m-1" id="btn-archive-room" employer-id='. $getEm->id .' data-toggle="modal" data-target="#RoomArchiveModal">
    //             <i class="fa fa-archive"></i></a>';


    //         return $button;
    //     })
    //     ->rawColumns(['action'])
    //     ->make(true);
    //      }
    // }
}
