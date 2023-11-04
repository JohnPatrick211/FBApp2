<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Login;
use App\Models\Tenant;
use App\Models\Employee;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;


class TenantApprovalCtr extends Controller
{
    public function index(){
        return view('admin-tenant-approval');
    }

    public function TenantApproval()
    {
        $getEm = $this->getTenant();
         if(request()->ajax())
             {
                return datatables()->of($getEm)
                ->addColumn('action', function($getEm){
                $button = '<a class="btn btn-sm" id="btn-view-upload" employer-id='. $getEm->id .' data-toggle="modal" data-target="#ApprovalModal">
                    <i class="fas fa-eye"></i></a>';

                return $button;
            })
            ->rawColumns(['action'])
            ->make(true);
             }
    }

    public function PatientApproved()
    {
        $getEm = $this->getPatientApproved();
         if(request()->ajax())
             {
                return datatables()->of($getEm)
                ->addColumn('action', function($getEm){
                $button = '<a class="btn btn-sm" id="btn-view-upload" employer-id='. $getEm->id .' data-toggle="modal" data-target="#patientapprovalModal">
                    <i class="fas fa-eye"></i></a>';

                return $button;
            })
            ->rawColumns(['action'])
            ->make(true);
             }
    }

    public function countValidationEmployer(){

        $getEm = $this->getEmployer();

        return $getEm->count();
    }

    public function getTenant()
    {
            return DB::table('tbl_user AS BR')
            ->select('BR.*','tbl_tenant.*', 'tbl_room.*', 'tbl_room.id AS roomid', 'tbl_tenant.tenant_id AS tenantid')
            ->leftJoin('tbl_tenant', 'BR.id', '=', 'tbl_tenant.tenant_id')
            ->leftJoin('tbl_room', 'tbl_tenant.room_id', '=', 'tbl_room.id')
            ->where('tbl_tenant.status',2)
            ->get();
        
    }



    public function getPatientApproved()
    {
        $getpatientapproved = DB::table('tbl_user')
        ->select('tbl_user.*')
        ->where('user_role','Patient')
        ->where('status','Approved')
         ->get();

        return $getpatientapproved;       
    }
    public function getVerificationInfo($id){
        $verification_info = DB::table('tbl_user')
        ->select('tbl_user.*')
        ->where('tbl_user.id',$id)
        ->get();
         return  $verification_info;
    }
}
