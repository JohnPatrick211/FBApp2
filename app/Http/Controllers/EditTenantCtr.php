<?php

namespace App\Http\Controllers;

use App\Models\Login;
use App\Models\Tenant;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class EditTenantCtr extends Controller
{
    public function index(){
        $user = Login:: where('id','=', session('LoggedUser'))->first();
        $user_tenant = Tenant::where('tenant_id','=', session('LoggedUser'))->first();
        $tenant_room = DB::table('tbl_room AS BR')
          ->select('BR.roomnumber','tbl_tenant.*')
          ->leftJoin('tbl_tenant', 'BR.id', '=', 'tbl_tenant.room_id')
          ->where('tbl_tenant.tenant_id', session('LoggedUser'))
          ->first();
        $data = [
            'LoggedUserInfo' => $user,
            'TenantInfo' =>  $user_tenant,
            'TenantRoom' =>  $tenant_room,
        ];
        return view('tenant-editprofile', $data);
    }
}
