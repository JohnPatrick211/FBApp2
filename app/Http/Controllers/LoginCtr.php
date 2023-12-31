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

class LoginCtr extends Controller
{
    public $user;

    public function index(){
        return view('login');
    }

    public function check(Request $request)
    {
        $request->validate([
            'username'=>'required',
            'password'=>'required|min:5'
        ],
         [
        'username.required' => 'Please type your username',
        'password.required' => 'Please type your password',
        'password.min' => 'Password must have minimum of 5 characters'
        
    ]);

        // $user = Login:: where('username','=', $request-> username)
        // ->where('password','=', $request-> password)->first();

        $pass = Login:: where('username','=', $request-> username)->first();

        if($pass){
            $CheckedHash = Hash::check($request->password, $pass->password);
        }
        else{
            return back()->with('fail','Invalid Username and Password');
        }
        

        if($CheckedHash){
            // $user = DB::table('tbl_user')
            // ->select('tbl_user.*','tbl_admin.*','tbl_tenant.*','tbl_employee.*')
            // ->leftJoin('tbl_admin', 'tbl_user.id', '=', 'tbl_admin.admin_id')
            // ->leftJoin('tbl_tenant', 'tbl_user.id', '=', 'tbl_tenant.tenant_id')
            // ->leftJoin('tbl_employee', 'tbl_user.id', '=', 'tbl_employee.emp_id')
            // ->where('tbl_user.username','=', $request->username)
            // ->where('tbl_user.password','=',  $CheckedHash)
            //->get();

            $this->user = DB::table('tbl_user')
            ->select('tbl_user.*')
            ->where('tbl_user.username','=', $request->username)
            ->get();

            
        }

        if($this->user)
        {
            // if($this->user->status == '0')
            // {
            //     return back()->with('fail','Your account is Archived, please contact your system administrator using this email: admin@opticalclinic.online and contact number: 09397177711');
            // }
            // else
            // {
            if($this->user[0]->user_role == 'System Admin')
            {
                $useradmin = DB::table('tbl_user')
                ->select('tbl_user.*','tbl_admin.*')
                ->leftJoin('tbl_admin', 'tbl_user.id', '=', 'tbl_admin.admin_id')
                ->where('tbl_user.id','=', $this->user[0]->id)
                ->where('tbl_admin.admin_id','=',  $this->user[0]->id)
                ->get();

                    $request->session()->put('LoggedUser', $useradmin[0]->id);
                    Session::put('LoggedUser',$useradmin[0]->id);
                    // Session::put('Branch',$staff->branch_id);
                    Session::put('Name',$useradmin[0]->fname . ' ' . $useradmin[0]->mname . ' ' . $useradmin[0]->lname);
                    Session::put('User-Type',$useradmin[0]->user_role);
                    Session::put('profile_pic',$useradmin[0]->profile_pic);
                    // $getname = Session::get('Name');
                    // $getusertype = Session::get('User-Type');
                    // base::recordAction( $getname, $getusertype,'Login', 'login');
                    return redirect('admin-dashboard');
                    //return $useradmin;
            }
            else if($this->user[0]->user_role == 'Employee')
            {
                $useremp = DB::table('tbl_user')
                ->select('tbl_user.*','tbl_employee.*')
                ->leftJoin('tbl_employee', 'tbl_user.id', '=', 'tbl_employee.emp_id')
                ->where('tbl_user.id','=', $this->user[0]->id)
                ->where('tbl_employee.emp_id','=',  $this->user[0]->id)
                ->get();
                   
                $request->session()->put('LoggedUser', $useremp[0]->emp_id);
                Session::put('LoggedUser',$useremp[0]->emp_id);
                // Session::put('Branch',$staff->branch_id);
                Session::put('Name',$useremp[0]->fname . ' ' . $useremp[0]->mname . ' ' . $useremp[0]->lname);
                Session::put('User-Type',$useremp[0]->user_role);
                Session::put('profile_pic',$useremp[0]->profile_pic);
                // $getname = Session::get('Name');
                // $getusertype = Session::get('User-Type');
                // base::recordAction( $getname, $getusertype,'Login', 'login');

                    if($useremp[0]-> status == '0'){
                        //return redirect('/error')->with('fail','Your account is Archived, please contact your system administrator using this email: admin@fbbuilding.online and contact number: 09397177711');
                        return view('account-archive');
                    }
                    else{
                        //return  $usertenant;
                        return redirect('employee-forum');
                    }
            }
            else if($this->user[0]->user_role == 'Tenant')
            {
                $usertenant = DB::table('tbl_user')
                ->select('tbl_user.*','tbl_tenant.*')
                ->leftJoin('tbl_tenant', 'tbl_user.id', '=', 'tbl_tenant.tenant_id')
                ->where('tbl_user.id','=', $this->user[0]->id)
                ->where('tbl_tenant.tenant_id','=',  $this->user[0]->id)
                ->get();
                   
                $request->session()->put('LoggedUser', $usertenant[0]->tenant_id);
                Session::put('LoggedUser',$usertenant[0]->tenant_id);
                // Session::put('Branch',$staff->branch_id);
                Session::put('Name',$usertenant[0]->fname . ' ' . $usertenant[0]->mname . ' ' . $usertenant[0]->lname);
                Session::put('User-Type',$usertenant[0]->user_role);
                Session::put('profile_pic',$usertenant[0]->profile_pic);
                // $getname = Session::get('Name');
                // $getusertype = Session::get('User-Type');
                // base::recordAction( $getname, $getusertype,'Login', 'login');

                    if($usertenant[0]-> status == '0'){
                       // return redirect('/error')->with('fail','Your account is Archived, please contact your system administrator using this email: admin@opticalclinic.online and contact number: 09397177711');
                       return view('account-archive');
                    }
                    else if($usertenant[0]-> status == '2'){
                        return view('account-pending');
                    }
                    else{
                        //return  $usertenant;
                        return redirect('tenant-dashboard');
                    }
            }
                // else if($staff->user_role == 'Staff')
                // {
                //     $branch = ClinicBranch::where('id','=',$staff->branch_id)->first();
                //     $request->session()->put('LoggedUser',$staff->id);
                //     Session::put('LoggedUser',$staff->id);
                //     Session::put('Branch',$staff->branch_id);
                //     Session::put('BranchName',$branch->branchname);
                //     Session::put('Name',$staff->name);
                //     Session::put('User-Type',$staff->user_role);
                //         $getname = Session::get('Name');
                //         $getusertype = Session::get('User-Type');
                //         base::recordAction( $getname, $getusertype,'Login', 'login');
                //     return redirect('staff-dashboard');
                // }
                // else if($staff->user_role == 'Patient' && $staff->status == 'Approved')
                // {
                //     $request->session()->put('LoggedUser',$staff->id);
                //     Session::put('LoggedUser',$staff->id);
                //     Session::put('Name',$staff->name);
                //     Session::put('User-Type',$staff->user_role);
                //         $getname = Session::get('Name');
                //         $getusertype = Session::get('User-Type');
                //         base::recordAction( $getname, $getusertype,'Login', 'login');
                //     return redirect('patient-dashboard');
                // }
                // else if($staff->user_role == 'Patient' && $staff->status == 'Pending')
                // {
                //     return back()->with('fail','Your Account is Pending in the Approval List, Please wait for the confirmation to your email');
                // }
            else
            {
                return back()->with('fail','Invalid Username and Password');
            }
            //}
         }
         else
         {
              return back()->with('fail','Invalid Username and Password');
         }
        
     }
     //logout
     function logout(){
        if(Session::has('LoggedUser')){
              $getname = Session::get('Name');
                     $getusertype = Session::get('User-Type');
                    //base::recordAction( $getname, $getusertype,'Logout', 'logout');
            Session::pull('LoggedUser');
            return redirect('/');
        }
    }

     //Admin Dashboard
     function admin()
    {
            $user = Login:: where('id','=', session('LoggedUser'))->first();
            //   $AppointmentForToday = DB::table('tbl_appointment')
            //   ->select('tbl_appointment.*','tbl_appointment.id AS P','tbl_doctor.name AS D','tbl_doctorschedule.id', 'tbl_doctorschedule.doctor_schedule_date',
            //   'tbl_doctorschedule.doctor_schedule_day', 'tbl_doctorschedule.doctor_schedule_start_time', 
            //   'tbl_doctorschedule.doctor_schedule_end_time','tbl_branch.branchname','tbl_branch.id AS B','tbl_user.name AS N','tbl_user.id')
            //   ->leftJoin('tbl_doctorschedule', 'tbl_appointment.doctor_schedule_id', '=', 'tbl_doctorschedule.id')
            //   ->leftJoin('tbl_branch', 'tbl_doctorschedule.branch_id', '=', 'tbl_branch.id')
            //   ->leftJoin('tbl_user', 'tbl_appointment.patient_id', '=', 'tbl_user.id')
            //   ->leftJoin('tbl_doctor', 'tbl_appointment.doctor_id', '=', 'tbl_doctor.doctor_id')
            //   ->where('tbl_doctorschedule.doctor_schedule_date', \Carbon\Carbon::now()->format('Y-m-d'))
            //   ->where('tbl_doctorschedule.status','Active')
            //   ->whereIn('tbl_appointment.status',['Approved','In Process'])
            //   ->count();
            //   $pendingappointmentapproval = $getmyappointment = DB::table('tbl_appointment')
            //   ->select('tbl_appointment.*','tbl_appointment.id AS P','tbl_doctor.name AS D','tbl_doctorschedule.id', 'tbl_doctorschedule.doctor_schedule_date',
            //   'tbl_doctorschedule.doctor_schedule_day', 'tbl_doctorschedule.doctor_schedule_start_time', 
            //   'tbl_doctorschedule.doctor_schedule_end_time','tbl_branch.branchname','tbl_user.name AS N','tbl_user.id','tbl_doctor.specialty')
            //   ->leftJoin('tbl_doctorschedule', 'tbl_appointment.doctor_schedule_id', '=', 'tbl_doctorschedule.id')
            //   ->leftJoin('tbl_branch', 'tbl_doctorschedule.branch_id', '=', 'tbl_branch.id')
            //   ->leftJoin('tbl_user', 'tbl_appointment.patient_id', '=', 'tbl_user.id')
            //   ->leftJoin('tbl_doctor', 'tbl_appointment.doctor_id', '=', 'tbl_doctor.doctor_id')
            //   ->whereBetween('tbl_doctorschedule.doctor_schedule_date', [\Carbon\Carbon::now()->format('Y-m-d'), \Carbon\Carbon::now()->addWeek()->format('Y-m-d')])
            //   ->where('tbl_appointment.status', 'Pending')
            //   ->count();
            //   $completeappointment = DB::table('tbl_appointmentreport AS BR')
            //   ->select('BR.*','tbl_branch.branchname','tbl_user.name AS U','tbl_doctor.name AS D')
            //   ->leftJoin('tbl_branch', 'BR.branch_id', '=', 'tbl_branch.id')
            //   ->leftJoin('tbl_user', 'BR.patient_id', '=', 'tbl_user.id')
            //   ->leftJoin('tbl_doctor', 'BR.doctor_id', '=', 'tbl_doctor.doctor_id')
            //   ->count();
            $numberOfRooms = DB::table('tbl_room')
              ->select('tbl_room.*')
              ->where('status',1)
              ->count();

              $numberOfVacantRoomsAvailable = DB::table('tbl_room')
              ->select('tbl_room.*')
              ->where('status',1)
              ->where('vacantnumber', '!=', 0)
              ->count();
              
              $numberOfVacantBedsAvailable = DB::table('tbl_room')
              ->select('tbl_room.*')
              ->where('status',1)
              ->where('vacantnumber', '!=', 0)
              ->sum('vacantnumber');  

              $numberofTenants = DB::table('tbl_tenant')
              ->select('tbl_tenant.*')
              ->where('status',1)
               ->count();

               $numberofEmployees = DB::table('tbl_employee')
               ->select('tbl_employee.*')
               ->where('status',1)
                ->count();

                $oldestTenant = DB::table('tbl_tenant')
               ->select('tbl_tenant.*')
               ->where('status',1)
               ->orderBy('created_at','asc')
                ->first();

                $sales = DB::table('tbl_sales')
                ->where(DB::raw('DATE(created_at)'), \Carbon\Carbon::now()->format('Y-m-d'))
                // ->where(DB::raw('DATE(created_at)'), DB::raw(' DATE_ADD(created_at, INTERVAL 1 month )'))
                ->sum('amount');
            //    $sales = DB::table('tbl_sales')
            //    ->where('status', 1)
            //    ->where('tbl_sales.product_id', 'LIKE', '1%')
            //    ->where(DB::raw('DATE(created_at)'), \Carbon\Carbon::now()->format('Y-m-d'))
            //    ->sum('amount');

            //   $date = \Carbon\Carbon::now()->format('Y-m-d');
            //   $dateadvance = \Carbon\Carbon::now()->addWeek()->format('Y-m-d');
            $data = [
                'LoggedUserInfo' => $user,
                 'numberOfRooms' =>  $numberOfRooms,
                 'numberOfVacantRoomsAvailable' =>  $numberOfVacantRoomsAvailable,
                 'numberofTenants' =>  $numberofTenants,
                 'numberofEmployees' => $numberofEmployees,
                 'sales' => $sales,
                 'numberOfVacantBedsAvailable' => $numberOfVacantBedsAvailable,
                 'oldestTenant' => $oldestTenant,
                // 'approvedpatient' => $approvedpatient,
                // 'date' => $date,
                // 'sales' => $sales,
                // 'dateadvance' => $dateadvance,
                // 'CountApprovedEmployer' => $CountApprovedEmployer,
                // 'CountPendingJob' => $CountPendingJob,
                // 'CountApprovedJob' => $CountApprovedJob
            ];
            return view('admin-dashboard', $data);
    }
    //Tenant Dashboard
    function tenant()
    {
            $user = Login:: where('id','=', session('LoggedUser'))->first();
            $user_tenant = Tenant::where('tenant_id','=', session('LoggedUser'))->first();
            $tenant_room = DB::table('tbl_room AS BR')
              ->select('BR.roomnumber','tbl_tenant.*','tbl_schedulepayment.next_payment AS nextpayment')
              ->leftJoin('tbl_tenant', 'BR.id', '=', 'tbl_tenant.room_id')
              ->leftJoin('tbl_schedulepayment', 'tbl_tenant.tenant_id', '=', 'tbl_schedulepayment.tenant_id')
              ->where('tbl_tenant.tenant_id', session('LoggedUser'))
              ->first();
            $data = [
                'LoggedUserInfo' => $user,
                'TenantInfo' =>  $user_tenant,
                'TenantRoom' =>  $tenant_room,
            ];
            return view('tenant-dashboard', $data);
    }

    //Tenant Dashboard
    function employee()
    {
            $user = Login:: where('id','=', session('LoggedUser'))->first();
            $user_employee = Employee::where('emp_id','=', session('LoggedUser'))->first();
            $data = [
                'LoggedUserInfo' => $user,
                'EmployeeInfo' =>  $user_employee,
            ];
            return view('employee-dashboard', $data);
    }
}
