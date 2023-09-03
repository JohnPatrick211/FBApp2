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

class LoginAPICtr extends Controller
{
    public function login(Request $request){

        $username = $request-> username;
        $password = $request-> password;

        $pass = Login:: where('username','=', $username)->first();

        if($pass){
            $CheckedHash = Hash::check($password, $pass->password);
        }
        else{
            return response()->json([
                'success' => false,
                'message' => 'Invalid Username and Password'
            ]);
        }

        if($CheckedHash){
            $this->user = DB::table('tbl_user')
            ->select('tbl_user.*')
            ->where('tbl_user.username','=', $request->username)
            ->get();
        }
        else{
            return response()->json([
                'success' => false,
                'message' => 'Invalid Username and Password'
            ]);
        }

        if($this->user)
        {
            if($this->user[0]->user_role == 'Tenant')
            {
                $usertenant = DB::table('tbl_user')
                ->select('tbl_user.*','tbl_tenant.*')
                ->leftJoin('tbl_tenant', 'tbl_user.id', '=', 'tbl_tenant.tenant_id')
                ->where('tbl_user.id','=', $this->user[0]->id)
                ->where('tbl_tenant.tenant_id','=',  $this->user[0]->id)
                ->first();

                if($usertenant-> status == '0'){
                    return response()->json([
                        'success' => false,
                        'message' => 'Your Account is Archived, Please Contact the System Administrator'
                    ]);
                }
                else{
                    return response()->json([
                        'success' => true,
                        'user' => $usertenant
                    ]);
                }
            }
            else{
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid Username and Password'
                ]);
            }
        }
        else{
            return response()->json([
                'success' => false,
                'message' => 'Invalid Username and Password'
            ]);
        }
    }
}
