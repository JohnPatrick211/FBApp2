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
use Mail;
use App\Models\MailVerify;


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
                $button = '<a class="btn btn-sm" id="btn-view-upload" employer-id='. $getEm->tenantid .' data-toggle="modal" data-target="#ApprovalModal">
                    <i class="fas fa-eye"></i></a>';

                return $button;
            })
            ->rawColumns(['action'])
            ->make(true);
             }
    }

    public function TenantApproved()
    {
        $getEm = $this->getTenantApproved();
         if(request()->ajax())
             {
                return datatables()->of($getEm)
                ->addColumn('action', function($getEm){
                $button = '<a class="btn btn-sm" id="btn-view-upload" employer-id='. $getEm->tenantid .' data-toggle="modal" data-target="#ApprovalModal">
                    <i class="fas fa-eye"></i></a>';

                return $button;
            })
            ->rawColumns(['action'])
            ->make(true);
             }
    }

    public function getTenant()
    {
            return DB::table('tbl_user AS BR')
            ->select('BR.*','tbl_tenant.*', 'tbl_room.*', 'tbl_room.id AS roomid', 'tbl_tenant.id AS tenantid')
            ->leftJoin('tbl_tenant', 'BR.id', '=', 'tbl_tenant.tenant_id')
            ->leftJoin('tbl_room', 'tbl_tenant.room_id', '=', 'tbl_room.id')
            ->where('tbl_tenant.status',2)
            ->get();
        
    }



    public function getTenantApproved()
    {
        $getpatientapproved = DB::table('tbl_user AS BR')
        ->select('BR.*','tbl_tenant.*', 'tbl_room.*', 'tbl_room.id AS roomid', 'tbl_tenant.id AS tenantid')
        ->leftJoin('tbl_tenant', 'BR.id', '=', 'tbl_tenant.tenant_id')
        ->leftJoin('tbl_room', 'tbl_tenant.room_id', '=', 'tbl_room.id')
        ->where('tbl_tenant.status',1)
        ->get();

        return $getpatientapproved;       
    }
    public function getVerificationInfo($id){
        $verification_info = DB::table('tbl_user AS BR')
        ->select('BR.*','tbl_tenant.*', 'tbl_room.*', 'tbl_room.id AS roomid', 'tbl_tenant.id AS tenantid', 'tbl_tenant.status AS pendingstatus')
        ->leftJoin('tbl_tenant', 'BR.id', '=', 'tbl_tenant.tenant_id')
        ->leftJoin('tbl_room', 'tbl_tenant.room_id', '=', 'tbl_room.id')
        ->where('tbl_tenant.id',$id)
        ->get();
         return  $verification_info;
    }

    public function approve($id,$room){
        DB::table('tbl_tenant')
        ->where('tbl_tenant.id', $id)
        ->update([
            'status' => '1'
        ]);

        DB::table('tbl_room')
                ->where('id', $room)
                ->update([
                    'vacantnumber' => DB::raw('vacantnumber -'. 1),
                ]);

                $aftergetDBvacantnumber = DB::table('tbl_room AS BR')
                ->select('BR.vacantnumber')
                ->where('BR.id',$room)
                ->get();
                $aftergetDBroomcapacity = DB::table('tbl_room AS BR')
                ->select('BR.roomcapacity')
                ->where('BR.id',$room)
                ->get();

                $latestroomcapacity = $aftergetDBroomcapacity[0]->roomcapacity;
                $latestvacantnumber = $aftergetDBvacantnumber[0]->vacantnumber;

                if($latestroomcapacity > $latestvacantnumber){
                    if($latestvacantnumber == 0){
                        DB::table('tbl_room')
                        ->where('id', $room)
                        ->update([
                            'isOccupied' => 1,
                        ]);
                    }
                    else if( $latestvacantnumber <= -1){
                        DB::table('tbl_room')
                        ->where('id', $room)
                        ->update([
                            'isOccupied' => 3,
                        ]);
                    }
                    else{
                        DB::table('tbl_room')
                        ->where('id', $room)
                        ->update([
                            'isOccupied' => 2,
                        ]);
                    }
                }
                else if($latestroomcapacity == $latestvacantnumber){
                    DB::table('tbl_room')
                    ->where('id', $room)
                    ->update([
                        'isOccupied' => 0,
                    ]);
                }
                else if( $latestvacantnumber <= -1){
                    DB::table('tbl_room')
                    ->where('id', $room)
                    ->update([
                        'isOccupied' => 3,
                    ]);
                }


        $users = Tenant::where('id', '=', $id)->first();

        $email = DB::table('tbl_tenant')
        ->select('tbl_tenant.email')
        ->where('tbl_tenant.id',$id)
        ->get();

        $message =  "<p>" . "Good day " . $users->name  . "your account has been verified according to your submitted information. You may proceed using our system and also you can change your profile anytime as you requested. Have a Nice Day!" . "</p>";

    Mail::to($email)->send(new MailVerify($message));


}

public function reject($id){

    $email = DB::table('tbl_tenant')
    ->select('tbl_tenant.email')
    ->where('tbl_tenant.id',$id)
    ->get();

    $tenantid = DB::table('tbl_tenant')
    ->select('tbl_tenant.tenant_id')
    ->where('tbl_tenant.id',$id)
    ->first();

    $users = Login::where('id', '=', $id)->get();

    $message =  "Good Day " . $users->name  . "<br><br>"."<p>We really appreciate the effort you put into this. Unfortunately, We are unable to approve your account at this time. We received and have reviewed the content of your information. At this moment, we would encourage you to check and re-arrange the details herein. You may sign up again in our website. <br><br>Have a Nice Day!<p>";

    Mail::to($email)->send(new MailVerify($message));
        
     DB::table('tbl_tenant')
    ->where('tbl_tenant.id', $id)
    ->delete();

    DB::table('tbl_user')
    ->where('tbl_user.id', $tenantid->tenant_id)
    ->delete();
    
    
}


}
