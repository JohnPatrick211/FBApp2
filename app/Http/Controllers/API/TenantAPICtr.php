<?php

namespace App\Http\Controllers\API;

use App\Models\Login;
use App\Models\Tenant;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class TenantAPICtr extends Controller
{
    public function getTenantProfile(Request $request){

        $id = $request->id;

        $usertenant = DB::table('tbl_tenant as BR')
                ->select('BR.*')
                ->where('BR.tenant_id','=',  $id)
                ->first();

                    return response()->json([
                        'success' => true,
                        'user' => $usertenant
                    ]);
    }
}
