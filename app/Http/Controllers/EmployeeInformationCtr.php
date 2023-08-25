<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Login;
use App\Models\Room;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class EmployeeInformationCtr extends Controller
{
    public function index(){
        if(Session::has('LoggedUser')){
            $users2 = DB::table('tbl_user')->where('id','=', session('LoggedUser'))->first();
             $data = [
                 'LoggedUserInfo' => $users2
             ];
             $users3 = Login::all();
             $users4 = Room::orderBy('id', 'ASC')->where('vacantnumber', '!=', 0)->where('status', '!=', 0)->get();
             return view('employee-information', $data)->with('users3',$users3)->with('users4',$users4);
         }
    }

    public function employeeinformation_employee(){
        $getEm = $this->getEmployeeInfo();
        if(request()->ajax())
            {
            return datatables()->of($getEm)
            ->addColumn('action', function($getEm){
            $button = '<a class="btn btn-sm btn-primary m-1" id="btn-info-employee" employer-id='. $getEm->emp_id .' data-toggle="modal" data-target="#EmployeeInfoModal">
                <i class="fa fa-eye"></i></a>';

            return $button;
        })
        ->rawColumns(['action'])
        ->make(true);
         }
    }

    public function getEmployeeInfo(){
        return DB::table('tbl_employee AS BR')
        ->select('BR.*')
        ->where('BR.status',1)
        ->get();
    }

    public function getEmployeeInfoDetails($id)
    {
            return DB::table('tbl_employee AS BR')
            ->select('BR.*')
            ->where('BR.emp_id',$id)
            ->get();
        
    }
}
