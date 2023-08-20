<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Login;
use App\Models\Room;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class UserMaintenanceCtr extends Controller
{
    public function index(){
        if(Session::has('LoggedUser')){
            $users2 = DB::table('tbl_user')->where('id','=', session('LoggedUser'))->first();
             $data = [
                 'LoggedUserInfo' => $users2
             ];
             $users3 = Login::all();
             $users4 = Room::orderBy('id', 'ASC')->where('vacantnumber', '!=', 0)->where('status', '!=', 0)->get();
             return view('user-maintenance', $data)->with('users3',$users3)->with('users4',$users4);
         }
    }
    public function getAdmin()
    {
       return DB::table('tbl_user AS BR')
                ->select('BR.*', 'tbl_admin.*')
                ->leftJoin('tbl_admin', 'BR.id', '=', 'tbl_admin.admin_id')
                ->where('tbl_admin.status','=','1')
                ->get();
    }

    public function getEmployee()
    {
       return DB::table('tbl_user AS BR')
                ->select('BR.*','tbl_employee.*')
                ->leftJoin('tbl_employee', 'BR.id', '=', 'tbl_employee.emp_id')
                ->where('tbl_employee.status','=','1')
                ->get();
    }
    public function getTenant()
    {
       return DB::table('tbl_user AS BR')
                ->select('BR.*', 'tbl_tenant.*','tbl_room.*', 'tbl_tenant.id AS tenantid')
                ->leftJoin('tbl_tenant', 'BR.id', '=', 'tbl_tenant.tenant_id')
                ->leftJoin('tbl_room', 'tbl_tenant.room_id', '=', 'tbl_room.id')
                ->where('tbl_tenant.status','=','1')
                ->get();
    }
    public function usermaintenance_admin(){
        $getEm = $this->getAdmin();
        if(request()->ajax())
            {
            return datatables()->of($getEm)
            ->addColumn('action', function($getEm){
            $button = '<a class="btn btn-sm btn-success m-1" id="btn-edit-user" employer-id="'. $getEm->admin_id .'" user-type="'. $getEm->user_role .'"data-toggle="modal" data-target="#editUserModal">
                <i class="fa fa-edit"></i></a>';
                $button .= '<a class="btn btn-sm btn-danger m-1" id="btn-archive-user" employer-id='. $getEm->admin_id .' user-type="'. $getEm->user_role .'" data-toggle="modal" data-target="#archiveModal">
                <i class="fa fa-archive"></i></a>';


            return $button;
        })
        ->rawColumns(['action'])
        ->make(true);
         }
    }
    public function usermaintenance_employee()
    {
        $getEm = $this->getEmployee();
        if(request()->ajax())
        {
        return datatables()->of($getEm)
        ->addColumn('action', function($getEm){
        $button = '<a class="btn btn-sm btn-success m-1" id="btn-edit-user" employer-id="'. $getEm->emp_id .'" user-type="'. $getEm->user_role .'"data-toggle="modal" data-target="#editUserModal">
            <i class="fa fa-edit"></i></a>';
            $button .= '<a class="btn btn-sm btn-danger m-1" id="btn-archive-user" employer-id='. $getEm->emp_id .' user-type="'. $getEm->user_role .'" data-toggle="modal" data-target="#archiveModal">
            <i class="fa fa-archive"></i></a>';


        return $button;
    })
    ->rawColumns(['action'])
    ->make(true);
     }
    }
    public function usermaintenance_tenant()
    {
        $getEm = $this->getTenant();
        if(request()->ajax())
        {
        return datatables()->of($getEm)
        ->addColumn('action', function($getEm){
        $button = '<a class="btn btn-sm btn-success m-1" id="btn-edit-user" employer-id="'. $getEm->tenant_id .'" user-type="'. $getEm->user_role .'"data-toggle="modal" data-target="#editUserModal">
            <i class="fa fa-edit"></i></a>';
            $button .= '<a class="btn btn-sm btn-danger m-1" id="btn-archive-user" employer-id='. $getEm->tenant_id .' user-type="'. $getEm->user_role .'" data-toggle="modal" data-target="#archiveModal">
            <i class="fa fa-archive"></i></a>';


        return $button;
    })
    ->rawColumns(['action'])
    ->make(true);
     }
    }
    public function getUserDetails($id, $user_type)
    {

        if($user_type == 'System Admin')
        {
            return DB::table('tbl_user AS BR')
            ->select('BR.*','tbl_admin.*')
            ->leftJoin('tbl_admin', 'BR.id', '=', 'tbl_admin.admin_id')
            ->where('tbl_admin.admin_id',$id)
            ->get();
        }
        else if($user_type == 'Employee'){
            return DB::table('tbl_user AS BR')
            ->select('BR.*','tbl_employee.*')
            ->leftJoin('tbl_employee', 'BR.id', '=', 'tbl_employee.emp_id')
            ->where('tbl_employee.emp_id',$id)
            ->get();

        }
        else{
            return DB::table('tbl_user AS BR')
            ->select('BR.*','tbl_tenant.*', 'tbl_room.*', 'tbl_room.id AS roomid')
            ->leftJoin('tbl_tenant', 'BR.id', '=', 'tbl_tenant.tenant_id')
            ->leftJoin('tbl_room', 'tbl_tenant.room_id', '=', 'tbl_room.id')
            ->where('tbl_tenant.tenant_id',$id)
            ->get();
        }
        //  return DB::table('tbl_user AS BR')
        // ->select('BR.*','tbl_admin.*','tbl_employee.*','tbl_tenant.*', 'tbl_room.*')
        // ->leftJoin('tbl_admin', 'BR.id', '=', 'tbl_admin.admin_id')
        // ->leftJoin('tbl_employee', 'BR.id', '=', 'tbl_employee.emp_id')
        // ->leftJoin('tbl_tenant', 'BR.id', '=', 'tbl_tenant.tenant_id')
        // ->leftJoin('tbl_room', 'tbl_tenant.room_id', '=', 'tbl_room.id')
        // ->where('BR.id',$id)
        // ->get();
    }
    public function isAdminExist($user_role)
    {
        $row=DB::table('tbl_user')->where('user_role', $user_role);

        return $row->count() > 0 ? true : false;
    }
    public function isUserExist($username)
    {
        $row = DB::table('tbl_user')->where('username', $username);

        if($row->count() > 0){
            return true;
        }else{
            return false;
        }
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

    public function insertUser(Request $request)
    {

        $user = new Login();

        // DB::table('tbl_user')
        // ->insert([
        //     'user_role' => $user_role,
        //     'name' => $name,
        //     'email' => $email,
        //     'address' => $address,
        //     'contactNo' => $contact_no,
        //     'username' => $username,
        //     'password' => $password,
        //     'archive_status' => 'no',
        //     'branch_id' => $branch,
        //     'age' => $age,
        //     'birthdate' => $birthdate,
        //     'gender' => $gender,
        //     'civilstatus' => $civilstatus,
        //     'created_at' => \Carbon\Carbon::now(),
        //     'updated_at' => \Carbon\Carbon::now(),
        // ]);
        if($request->input('user_type') == 'Employee')
        {
            $user->user_role =  $request->input('user_type');
            // $user->fname =  $request->input('fname');
            // $user->lname =  $request->input('lname');
            // $user->mname =  $request->input('mname');
            //$user->email =  $request->input('email');
           // $user->address =  $request->input('address');
            //$user->phone =  $request->input('phone');
            $user->username =  $request->input('username');
            $user->password =  Hash::make($request->input('password'));
           // $user->status =  '1';
            // $user->age=  $request->input('age');
           // $user->gender =  $request->input('gender');
           // $user->birthdate =  $request->input('birthdate');
            //$user->password =  $request->input('password');
            // $user->civilstatus =  $request->input('civilstatus');
            if ($request->hasFile('profilepic')) {
                $file = $request->file('profilepic');
                // $file = $file->getClientOriginalName();
                $profile_pic = $this->imageUpload($file, 'pic_only');
            }

            $user->save();

            $id = $user->id;
            
            DB::table('tbl_employee')
            ->insert([
            'emp_id' => $id,
            'fname' => $request->input('fname'),
            'mname' => $request->input('mname'),
            'lname' => $request->input('lname'),
            'email' => $request->input('email'),
            'address' => $request->input('address'),
            'gender' => $request->input('gender'),
            'civilstatus' => $request->input('civilstatus'),
            'age' => $request->input('age'),
            'phone' => $request->input('phone'),
            'profile_pic' => $profile_pic,
            'birthdate' => $request->input('birthdate'),
            'status' => '1',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
            ]);
        }
        else if($request->input('user_type') == 'System Admin')
        {
            $user->user_role =  $request->input('user_type');
            // $user->fname =  $request->input('fname');
            // $user->lname =  $request->input('lname');
            // $user->mname =  $request->input('mname');
            //$user->email =  $request->input('email');
           // $user->address =  $request->input('address');
            //$user->phone =  $request->input('phone');
            $user->username =  $request->input('username');
            $user->password =  Hash::make($request->input('password'));
           // $user->status =  '1';
            // $user->age=  $request->input('age');
           // $user->gender =  $request->input('gender');
           // $user->birthdate =  $request->input('birthdate');
            //$user->password =  $request->input('password');
            // $user->civilstatus =  $request->input('civilstatus');
            if ($request->hasFile('profilepic')) {
                $file = $request->file('profilepic');
                // $file = $file->getClientOriginalName();
                $profile_pic = $this->imageUpload($file, 'pic_only');
            }

            $user->save();

            $id = $user->id;

            DB::table('tbl_admin')
            ->insert([
            'admin_id' => $id,
            'fname' => $request->input('fname'),
            'mname' => $request->input('mname'),
            'lname' => $request->input('lname'),
            'email' => $request->input('email'),
            'address' => $request->input('address'),
            'gender' => $request->input('gender'),
            'civilstatus' => $request->input('civilstatus'),
            'age' => $request->input('age'),
            'phone' => $request->input('phone'),
            'birthdate' => $request->input('birthdate'),
            'profile_pic' => $profile_pic,
            'status' => '1',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
            ]);
        }
        else{
            $user->user_role =  $request->input('user_type');
            // $user->fname =  $request->input('fname');
            // $user->lname =  $request->input('lname');
            // $user->mname =  $request->input('mname');
            //$user->email =  $request->input('email');
           // $user->address =  $request->input('address');
            //$user->phone =  $request->input('phone');
            $user->username =  $request->input('username');
            $user->password =  Hash::make($request->input('password'));
           // $user->status =  '1';
            // $user->age=  $request->input('age');
           // $user->gender =  $request->input('gender');
           // $user->birthdate =  $request->input('birthdate');
            //$user->password =  $request->input('password');
            // $user->civilstatus =  $request->input('civilstatus');
            if ($request->hasFile('profilepic')) {
                $file = $request->file('profilepic');
                // $file = $file->getClientOriginalName();
                $profile_pic = $this->imageUpload($file, 'pic_only');
            }

            $user->save();

            $id = $user->id;

            DB::table('tbl_tenant')
            ->insert([
            'tenant_id' => $id,
            'room_id' => $request->input('room'),
            'fname' => $request->input('fname'),
            'mname' => $request->input('mname'),
            'lname' => $request->input('lname'),
            'email' => $request->input('email'),
            'address' => $request->input('address'),
            'gender' => $request->input('gender'),
            'civilstatus' => $request->input('civilstatus'),
            'age' => $request->input('age'),
            'phone' => $request->input('phone'),
            'birthdate' => $request->input('birthdate'),
            'date_of_occupancy' => $request->input('dateofoccupancy'),
            'profile_pic' => $profile_pic,
            'status' => '1',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
            ]);
        }

        return redirect('user-maintenance')->with('success', 'User Saved');
  


        
        
        // $getname = Session::get('Name');
        //     $getusertype = Session::get('User-Type');
        //     base::recordAction( $getname, $getusertype,'User Maintenance', 'Add');
    }

    // public function AddUser(Request $request,$user_role, $name, $email, $contact_no, $address, $username,$password,$age,$birthdate,$gender,$civilstatus,$branch,$specialization)
    // {
        public function AddUser(Request $request)
        {

            if($request->input('user_type') == 'System Admin'){
                if(!$this->isAdminExist($request->input('user_type')))
                {
                    //return back()->with('danger', 'Admin already exist');
                    return $this->insertUser($request);
                }
                else{
                    return $this->insertUser($request);
                }
            }
            else{
                if($this->isUserExist($request->input('username')))
                {
                    return back()->with('danger', 'User already exist');
                }
                else{

                    return $this->insertUser($request);
                    // return response()->json(['status'=>1,'success'=>'success']);
                }
            }

    }
    public function updateUser(Request $request)
    {
        if($request->input('user_type') == 'System Admin')
        {
            DB::table('tbl_user')
            ->where('id', $request->input('id'))
            ->update([
                'username' => $request->input('username'),
                'password' => Hash::make($request->input('password')),
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ]);   

            if ($request->hasFile('profilepic')) { 
                $profilepic = $this->imageUpload($request->file('profilepic'), 'pic_only');
                
                DB::table('tbl_admin')
                ->where('admin_id', $request->input('id'))
                ->update([
                    'fname' => $request->input('fname'),
                    'mname' => $request->input('mname'),
                    'lname' => $request->input('lname'),
                    'email' => $request->input('email'),
                    'address' => $request->input('address'),
                    'phone' => $request->input('phone'),
                    'age' => $request->input('age'),
                    'birthdate' => $request->input('birthdate'),
                    'gender' => $request->input('gender'),
                    'civilstatus' => $request->input('civilstatus'),
                    'profile_pic' => $profilepic,
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                ]);
            }
            else{
                DB::table('tbl_admin')
                ->where('admin_id', $request->input('id'))
                ->update([
                    'fname' => $request->input('fname'),
                    'mname' => $request->input('mname'),
                    'lname' => $request->input('lname'),
                    'email' => $request->input('email'),
                    'address' => $request->input('address'),
                    'phone' => $request->input('phone'),
                    'age' => $request->input('age'),
                    'birthdate' => $request->input('birthdate'),
                    'gender' => $request->input('gender'),
                    'civilstatus' => $request->input('civilstatus'),
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                ]);
            }
            
            // $getname = Session::get('Name');
            // $getusertype = Session::get('User-Type');
            // base::recordAction( $getname, $getusertype,'User Maintenance', 'update');
        }
        else if($request->input('user_type') == 'Employee')
        {
            DB::table('tbl_user')
            ->where('id', $request->input('id'))
            ->update([
                'username' => $request->input('username'),
                'password' => Hash::make($request->input('password')),
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ]);   

            if ($request->hasFile('profilepic')) { 
                $profilepic = $this->imageUpload($request->file('profilepic'), 'pic_only');
                
                DB::table('tbl_employee')
                ->where('emp_id', $request->input('id'))
                ->update([
                    'fname' => $request->input('fname'),
                    'mname' => $request->input('mname'),
                    'lname' => $request->input('lname'),
                    'email' => $request->input('email'),
                    'address' => $request->input('address'),
                    'phone' => $request->input('phone'),
                    'age' => $request->input('age'),
                    'birthdate' => $request->input('birthdate'),
                    'gender' => $request->input('gender'),
                    'civilstatus' => $request->input('civilstatus'),
                    'profile_pic' => $profilepic,
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                ]);
            }
            else{
                DB::table('tbl_employee')
                ->where('emp_id', $request->input('id'))
                ->update([
                    'fname' => $request->input('fname'),
                    'mname' => $request->input('mname'),
                    'lname' => $request->input('lname'),
                    'email' => $request->input('email'),
                    'address' => $request->input('address'),
                    'phone' => $request->input('phone'),
                    'age' => $request->input('age'),
                    'birthdate' => $request->input('birthdate'),
                    'gender' => $request->input('gender'),
                    'civilstatus' => $request->input('civilstatus'),
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                ]);
            }
            
            // $getname = Session::get('Name');
            // $getusertype = Session::get('User-Type');
            // base::recordAction( $getname, $getusertype,'User Maintenance', 'update');
        }
        else
        {
             DB::table('tbl_user')
            ->where('id', $request->input('id'))
            ->update([
                'username' => $request->input('username'),
                'password' => Hash::make($request->input('password')),
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ]);   

            if ($request->hasFile('profilepic')) { 
                $profilepic = $this->imageUpload($request->file('profilepic'), 'pic_only');
                
                DB::table('tbl_tenant')
                ->where('tenant_id', $request->input('id'))
                ->update([
                    'fname' => $request->input('fname'),
                    'mname' => $request->input('mname'),
                    'lname' => $request->input('lname'),
                    'email' => $request->input('email'),
                    'room_id' => $request->input('room'),
                    'address' => $request->input('address'),
                    'phone' => $request->input('phone'),
                    'age' => $request->input('age'),
                    'birthdate' => $request->input('birthdate'),
                    'date_of_occupancy' => $request->input('dateofoccupancy'),
                    'gender' => $request->input('gender'),
                    'civilstatus' => $request->input('civilstatus'),
                    'profile_pic' => $profilepic,
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                ]);
            }
            else{
                DB::table('tbl_tenant')
                ->where('tenant_id', $request->input('id'))
                ->update([
                    'fname' => $request->input('fname'),
                    'mname' => $request->input('mname'),
                    'lname' => $request->input('lname'),
                    'room_id' => $request->input('room'),
                    'email' => $request->input('email'),
                    'address' => $request->input('address'),
                    'phone' => $request->input('phone'),
                    'age' => $request->input('age'),
                    'birthdate' => $request->input('birthdate'),
                    'date_of_occupancy' => $request->input('dateofoccupancy'),
                    'gender' => $request->input('gender'),
                    'civilstatus' => $request->input('civilstatus'),
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                ]);
            }
            
            // $getname = Session::get('Name');
            // $getusertype = Session::get('User-Type');
            // base::recordAction( $getname, $getusertype,'User Maintenance', 'update');
        }
    }
    public function updateUserWithoutPassword(Request $request)
    {
        if($request->input('user_type') == 'System Admin')
        {
            DB::table('tbl_user')
            ->where('id', $request->input('id'))
            ->update([
                'username' => $request->input('username'),
                'password' => Hash::make($request->input('password')),
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ]);   

            if ($request->hasFile('profilepic')) { 
                $profilepic = $this->imageUpload($request->file('profilepic'), 'pic_only');
                
                DB::table('tbl_admin')
                ->where('admin_id', $request->input('id'))
                ->update([
                    'fname' => $request->input('fname'),
                    'mname' => $request->input('mname'),
                    'lname' => $request->input('lname'),
                    'email' => $request->input('email'),
                    'address' => $request->input('address'),
                    'phone' => $request->input('phone'),
                    'age' => $request->input('age'),
                    'birthdate' => $request->input('birthdate'),
                    'gender' => $request->input('gender'),
                    'civilstatus' => $request->input('civilstatus'),
                    'profile_pic' => $profilepic,
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                ]);
            }
            else{
                DB::table('tbl_admin')
                ->where('admin_id', $request->input('id'))
                ->update([
                    'fname' => $request->input('fname'),
                    'mname' => $request->input('mname'),
                    'lname' => $request->input('lname'),
                    'email' => $request->input('email'),
                    'address' => $request->input('address'),
                    'phone' => $request->input('phone'),
                    'age' => $request->input('age'),
                    'birthdate' => $request->input('birthdate'),
                    'gender' => $request->input('gender'),
                    'civilstatus' => $request->input('civilstatus'),
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                ]);
            }
            
            // $getname = Session::get('Name');
            // $getusertype = Session::get('User-Type');
            // base::recordAction( $getname, $getusertype,'User Maintenance', 'update');
        }
        else if($request->input('user_type') == 'Employee')
        {
            DB::table('tbl_user')
            ->where('id', $request->input('id'))
            ->update([
                'username' => $request->input('username'),
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ]);   

            if ($request->hasFile('profilepic')) { 
                $profilepic = $this->imageUpload($request->file('profilepic'), 'pic_only');
                
                DB::table('tbl_employee')
                ->where('emp_id', $request->input('id'))
                ->update([
                    'fname' => $request->input('fname'),
                    'mname' => $request->input('mname'),
                    'lname' => $request->input('lname'),
                    'email' => $request->input('email'),
                    'address' => $request->input('address'),
                    'phone' => $request->input('phone'),
                    'age' => $request->input('age'),
                    'birthdate' => $request->input('birthdate'),
                    'gender' => $request->input('gender'),
                    'civilstatus' => $request->input('civilstatus'),
                    'profile_pic' => $profilepic,
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                ]);
            }
            else{
                DB::table('tbl_employee')
                ->where('emp_id', $request->input('id'))
                ->update([
                    'fname' => $request->input('fname'),
                    'mname' => $request->input('mname'),
                    'lname' => $request->input('lname'),
                    'email' => $request->input('email'),
                    'address' => $request->input('address'),
                    'phone' => $request->input('phone'),
                    'age' => $request->input('age'),
                    'birthdate' => $request->input('birthdate'),
                    'gender' => $request->input('gender'),
                    'civilstatus' => $request->input('civilstatus'),
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                ]);
            }
            
            // $getname = Session::get('Name');
            // $getusertype = Session::get('User-Type');
            // base::recordAction( $getname, $getusertype,'User Maintenance', 'update');
        }
        else
        {
             DB::table('tbl_user')
            ->where('id', $request->input('id'))
            ->update([
                'username' => $request->input('username'),
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ]);   

            if ($request->hasFile('profilepic')) { 
                $profilepic = $this->imageUpload($request->file('profilepic'), 'pic_only');
                
                DB::table('tbl_tenant')
                ->where('tenant_id', $request->input('id'))
                ->update([
                    'fname' => $request->input('fname'),
                    'mname' => $request->input('mname'),
                    'lname' => $request->input('lname'),
                    'email' => $request->input('email'),
                    'room_id' => $request->input('room'),
                    'address' => $request->input('address'),
                    'phone' => $request->input('phone'),
                    'age' => $request->input('age'),
                    'birthdate' => $request->input('birthdate'),
                    'date_of_occupancy' => $request->input('dateofoccupancy'),
                    'gender' => $request->input('gender'),
                    'civilstatus' => $request->input('civilstatus'),
                    'profile_pic' => $profilepic,
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                ]);
            }
            else{
                DB::table('tbl_tenant')
                ->where('tenant_id', $request->input('id'))
                ->update([
                    'fname' => $request->input('fname'),
                    'mname' => $request->input('mname'),
                    'lname' => $request->input('lname'),
                    'room_id' => $request->input('room'),
                    'email' => $request->input('email'),
                    'address' => $request->input('address'),
                    'phone' => $request->input('phone'),
                    'age' => $request->input('age'),
                    'birthdate' => $request->input('birthdate'),
                    'date_of_occupancy' => $request->input('dateofoccupancy'),
                    'gender' => $request->input('gender'),
                    'civilstatus' => $request->input('civilstatus'),
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                ]);
            }
            
            // $getname = Session::get('Name');
            // $getusertype = Session::get('User-Type');
            // base::recordAction( $getname, $getusertype,'User Maintenance', 'update');
        }
    }
    public function ArchiveUser($id,$user_type)
    {
            if($user_type == 'System Admin')
            {
                DB::table('tbl_admin')
                ->where('admin_id', $id)
                ->update([
                    'status' => '0',
                    'updated_at' => \Carbon\Carbon::now()
                    
                ]);
            }
            else if($user_type == 'Employee'){
                DB::table('tbl_employee')
                ->where('emp_id', $id)
                ->update([
                    'status' => '0',
                    'updated_at' => \Carbon\Carbon::now()
                    
                ]);
            }
            else{
                DB::table('tbl_tenant')
                ->where('tenant_id', $id)
                ->update([
                    'status' => '0',
                    'updated_at' => \Carbon\Carbon::now()
                    
                ]);
            }

            // $getname = Session::get('Name');
            // $getusertype = Session::get('User-Type');
            // base::recordAction( $getname, $getusertype,'User Maintenance', 'Archive');
    }

    // function import(Request $request)
    // {
    //     $file = $request->file('file');

    //     base::CSVImporter($file);
    //     $no_of_duplicates = Session::get('NO_OF_DUPLICATES');
    //     $getname = Session::get('Name');
    //         $getusertype = Session::get('User-Type');
    //         base::recordAction( $getname, $getusertype,'User Maintenance', 'import');

    //    if($no_of_duplicates>0)
    //    {
    //     return redirect('user-maintenance')
    //     ->with('success', 'PESO Staff information imported successfully! There are '.$no_of_duplicates.' user are not imported because the user is already exists.');
    //    }
    //    else
    //    {
    //     return redirect('user-maintenance')
    //     ->with('success', 'PESO Staff information imported successfully!');
    //    }
    // }

    // public function export(Request $request)
    // {

    //       base::CSVExporter($this->getPESOData());
    //       $getname = Session::get('Name');
    //         $getusertype = Session::get('User-Type');
    //         base::recordAction( $getname, $getusertype,'User Maintenance', 'export');
    // }

    // public function getPESOData()
    // {
    //     return DB::table('tbl_user as U')
    //             ->select('U.id','U.name','U.email','U.contactNo','U.address','U.username','U.password','U.archive_status','U.created_at','U.user_role','U.updated_at')
    //             ->where('user_role', 'PESO Staff')
    //             ->where('archive_status', 'no')
    //             ->get();
    // }
}
