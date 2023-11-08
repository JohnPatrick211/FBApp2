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
            $password =  Hash::make($request->password);
            if ($request->profilepic) {
                $file_path = time().'.jpg';
                file_put_contents(public_path() . '/images/profile_pic/'.$file_path,base64_decode($request->profilepic));
                $profile_pic = $file_path;
            }
            else{
                $profile_pic = null;
            }

            $user->where('id', $id)
            ->update(['username' => $username,
                      'profile_pic' => $profile_pic]);
    
    
                    //   DB::table('tbl_tenant')
                    //   ->where('tenant_id', $request->input('id'))
                    //   ->update([
                    //       'fname' => $request->input('fname'),
                    //       'mname' => $request->input('mname'),
                    //       'lname' => $request->input('lname'),
                    //       'email' => $request->input('email'),
                    //       'address' => $request->input('address'),
                    //       'phone' => $request->input('phone'),
                    //       'age' => $request->input('age'),
                    //       'birthdate' => $request->input('birthdate'),
                    //       'contract_start' => $request->input('contractstart'),
                    //       'contract_end' => $request->input('contractend'),
                    //       'date_of_occupancy' => $request->input('dateofoccupancy'),
                    //       'gender' => $request->input('gender'),
                    //       'civilstatus' => $request->input('civilstatus'),
                    //       'created_at' => \Carbon\Carbon::now(),
                    //       'updated_at' => \Carbon\Carbon::now(),
                    //   ]);
    
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
