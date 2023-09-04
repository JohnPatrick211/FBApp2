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

class RuleAPICtr extends Controller
{
    public function getRules(){
        $rule = DB::table('tbl_rule')->where('id','=', 1)->first();

        if($rule){
            return response()->json([
                'success' => true,
                'rules' => $rule
            ]);
        }
        else{
            return response()->json([
                'success' => false,
                'message' => $rule
            ]);
        }
    }
}
