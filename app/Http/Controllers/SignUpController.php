<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Login;
use App\Models\Room;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Mail;
use App\Models\MailVerify;

class SignUpController extends Controller
{
    public function index(){
        $users4 = Room::orderBy('id', 'ASC')->where('vacantnumber', '!=', 0)->where('status', '!=', 0)->get();
        return view('signup')->with('users4',$users4);
    }

    public function signUp(Request $request){

        $firstname =  $request->input('firstname');
        $middlename =  $request->input('middlename');
        $lastname =  $request->input('lastname');
        $phone_no =  $request->input('phone_no');
        $password =  $request->input('password');
        $email =  $request->input('email');
        $roomnumber =  $request->input('roomnumber');
        $dateofoccupancy =  $request->input('dateofoccupancy');
        $contractstart =  $request->input('contractstart');
        $contractend =  $request->input('contractend');
        $address =  $request->input('address');
        $username =  $request->input('username');
        $birthdate =  $request->input('birthdate');
        $gender =  $request->input('gender');
        $age =  $request->input('age');
        $civilstatus =  $request->input('civilstatus');
        
        $patient_acc = new Login;
        $patient_acc->user_role =  'Tenant';
        $patient_acc->username =  $request->input('username');
        $patient_acc->password =  Hash::make($request->input('password'));

        $patient_acc->save();

        $id = $patient_acc->id;

            DB::table('tbl_tenant')
            ->insert([
            'tenant_id' => $id,
            'room_id' => $roomnumber,
            'fname' => $firstname,
            'mname' => $middlename,
            'lname' => $lastname,
            'email' => $email,
            'address' => $address,
            'gender' => $gender,
            'civilstatus' => $civilstatus,
            'age' => $age,
            'phone' => $phone_no,
            'birthdate' => $birthdate,
            'date_of_occupancy' => $dateofoccupancy,
            'contract_start' => $contractstart,
            'contract_end' => $contractend,
            'status' => '2',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
            ]);
        

        Session::forget('otp');

        $message =  "<p>From: " . "FB Building"  . "</p>" .
                    "<p>Message: " . "Good Day, Your Registration Has been sent to the approval list, Please Wait for the email result for the verification of your credentials" . "</p>";

        Mail::to($email)->send(new MailVerify($message));
        
        return back();         
      
    }

    public function sendOTP(Request $request){
        $email =  $request->input('email');


         $otp = rand(1000,9999);
       //$otp = rand(1000,1001);
      
       $message =  "<p>From: " . "FB Building"  . "</p>" .
                    "<p>Message: " . "NEVER SHARE YOUR OTP. To allow this account to gain access to the system. Your OTP is ' . $otp. ' from FB Building. Use this OTP to validate your login. If you DID NOT make this request, please ignore this message. Thank you!" . "</p>";

       Mail::to($email)->send(new MailVerify($message));
            
        Session::put('otp', $otp);

    }

    public function validateOTP($otp){
        if(Session::get('otp') == $otp){
            return '1';
        }
        else{
            return '0';
        }
    }
}
