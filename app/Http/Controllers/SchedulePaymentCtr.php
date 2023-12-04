<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Login;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Models\Billing;
use App\Models\Schedule;
use App\Helpers\base; 
use Carbon\Carbon;

class SchedulePaymentCtr extends Controller
{
    public function index(){
        if(Session::has('LoggedUser')){
            $users2 = DB::table('tbl_user')->where('id','=', session('LoggedUser'))->first();
             $data = [
                 'LoggedUserInfo' => $users2
             ];
             //$users3 = User::where('role','employer')->get();
             return view('tenant-report', $data);


         }
    }

     public function TenantReportData(Request $request)
    {
        $getEm = $this->getTenantReport($request->date_from, $request->date_to, $request->payment_method);
         if(request()->ajax())
             {  
                return datatables()->of($getEm)
            ->make(true);
             }
    }

    public function getTenantReport($date_from, $date_to, $payment_method)
    {

        if($payment_method == 'All')
        {
            return DB::table('tbl_schedulepayment AS BR')
            ->select('BR.*','tbl_tenant.*')
            ->leftJoin('tbl_tenant', 'BR.tenant_id', '=', 'tbl_tenant.tenant_id')
            ->whereBetween('BR.next_payment', [$date_from, date('Y-m-d', strtotime($date_to. ' + 1 days'))])
            ->get();
        }
        else
        {
                
                return DB::table('tbl_schedulepayment AS BR')
            ->select('BR.*','tbl_tenant.*')
            ->leftJoin('tbl_tenant', 'BR.tenant_id', '=', 'tbl_tenant.tenant_id')
            ->whereBetween('BR.next_payment', [$date_from, date('Y-m-d', strtotime($date_to. ' + 1 days'))])
            ->where('BR.paid_status',$payment_method)
            ->get();
        }
    }
}
