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

class EditTenantAPICtr extends Controller
{
    public function editprofile(Request $request){
        $user = new Login();

            $id = $request->id;
            $username =  $request->username;

            if($request->password == null){
                $user->where('id', $id)
                ->update(['username' => $username]);
            }
            else{
                $password =  Hash::make($request->password);
                $user->where('id', $id)
                ->update(['username' => $username,
                          'password' => $password]);
            }


            if ($request->profilepic) {
                $file_path = time().'.jpg';
                file_put_contents(public_path() . '/images/profile_pic/'.$file_path,base64_decode($request->profilepic));
                $profile_pic = $file_path;

                DB::table('tbl_tenant')
                      ->where('tenant_id', $id)
                      ->update([
                          'fname' => $request->input('fname'),
                          'mname' => $request->input('mname'),
                          'lname' => $request->input('lname'),
                          'email' => $request->input('email'),
                          'address' => $request->input('address'),
                          'phone' => $request->input('phone'),
                          'age' => $request->input('age'),
                          'profile_pic' => $profile_pic,
                          'gender' => $request->input('gender'),
                          'civilstatus' => $request->input('civilstatus'),
                          'created_at' => \Carbon\Carbon::now(),
                          'updated_at' => \Carbon\Carbon::now(),
                      ]);
            }
            else{
                DB::table('tbl_tenant')
                      ->where('tenant_id', $id)
                      ->update([
                          'fname' => $request->input('fname'),
                          'mname' => $request->input('mname'),
                          'lname' => $request->input('lname'),
                          'email' => $request->input('email'),
                          'address' => $request->input('address'),
                          'phone' => $request->input('phone'),
                          'age' => $request->input('age'),
                          'gender' => $request->input('gender'),
                          'civilstatus' => $request->input('civilstatus'),
                          'created_at' => \Carbon\Carbon::now(),
                          'updated_at' => \Carbon\Carbon::now(),
                      ]);
            }

    
                $result =  DB::table('tbl_user')
                ->select('tbl_user.*','tbl_tenant.*')
                ->leftJoin('tbl_tenant', 'tbl_user.id', '=', 'tbl_tenant.tenant_id')
                ->where('tbl_user.id','=', $id)
                ->where('tbl_tenant.tenant_id','=',  $id)
                ->first();
    
                return response()->json([
                    'success' => true,
                    'message' => 'Update Successfully',
                    'result' => $result
                ]);
    }
}
