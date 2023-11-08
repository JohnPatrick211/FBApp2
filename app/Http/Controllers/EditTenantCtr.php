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

    public function update(Request $request)
    {


        DB::table('tbl_user')
        ->where('id', $request->input('editids'))
        ->update([
            'username' => $request->input('editusername'),
            'password' => Hash::make($request->input('editpassword')),
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);   

        if ($request->hasFile('editprofilepic')) { 
            $profilepic = $this->imageUpload($request->file('editprofilepic'), 'pic_only');
            
            DB::table('tbl_tenant')
            ->where('tenant_id', $request->input('editids'))
            ->update([
                'fname' => $request->input('editfname'),
                'mname' => $request->input('editmname'),
                'lname' => $request->input('editlname'),
                'email' => $request->input('editemail'),
                'address' => $request->input('editaddress'),
                'phone' => $request->input('editphone_no'),
                'age' => $request->input('editage'),
                'birthdate' => $request->input('editbirthdate'),
                'gender' => $request->input('editgender'),
                'civilstatus' => $request->input('editcivilstatus'),
                'profile_pic' => $profilepic,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ]);
        }
        else{
            DB::table('tbl_tenant')
            ->where('tenant_id', $request->input('editids'))
            ->update([
                'fname' => $request->input('editfname'),
                'mname' => $request->input('editmname'),
                'lname' => $request->input('editlname'),
                'email' => $request->input('editemail'),
                'address' => $request->input('editaddress'),
                'phone' => $request->input('editphone_no'),
                'age' => $request->input('editage'),
                'birthdate' => $request->input('editbirthdate'),
                'gender' => $request->input('editgender'),
                'civilstatus' => $request->input('editcivilstatus'),
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ]);

        }

        return back()->with('success', 'Your Information is Successfully Update');

    }

public function imageUpload($request, $type) 
    {
        $folder_to_save = 'profile_pic';

        if ($type == 'pic_only') {
            $image_name = uniqid() . "." . $request->extension();
            $request->move(public_path('images/' . $folder_to_save), $image_name);
            return $folder_to_save . "/" . $image_name;
        }
    }

}
