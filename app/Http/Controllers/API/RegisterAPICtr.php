<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Login;
use App\Models\Tenant;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class RegisterAPICtr extends Controller
{
    public function register(Request $request){

        $user = new Login();

        $user->user_role =  'Tenant';
        $user->username =  $request->username;
        $user->password =  Hash::make($request->password);
        if ($request->profilepic) {
            $file_path = time().'.jpg';
            file_put_contents(public_path() . '/images/profile_pic/'.$file_path,base64_decode($request->profilepic));
            $profile_pic = $file_path;
        }

        $user->save();

        $id = $user->id;


        DB::table('tbl_tenant')
            ->insert([
            'tenant_id' => $id,
            'room_id' => $request->room,
            'fname' => $request->fname,
            'mname' => $request->mname,
            'lname' => $request->lname,
            'email' => $request->email,
            'address' => $request->address,
            'gender' => $request->gender,
            'civilstatus' => $request->civilstatus,
            'age' => $request->age,
            'phone' => $request->phone,
            'birthdate' => $request->birthdate,
            'date_of_occupancy' => $request->dateofoccupancy,
            'contract_start' => $request->contractstart,
            'contract_end' => $request->contractend,
            'profile_pic' => $profile_pic,
            'status' => '2',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
            ]);

            $result =  DB::table('tbl_user')
            ->select('tbl_user.*','tbl_tenant.*')
            ->leftJoin('tbl_tenant', 'tbl_user.id', '=', 'tbl_tenant.tenant_id')
            ->where('tbl_user.id','=', $id)
            ->where('tbl_tenant.tenant_id','=',  $id)
            ->first();

            return response()->json([
                'success' => true,
                'message' => 'Register Successfully',
                'result' => $result
            ]);
    }
}
