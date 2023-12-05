<?php

namespace App\Http\Controllers;
use Luigel\Paymongo\Facades\Paymongo;

use App\Models\Login;
use App\Models\Tenant;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class PaymentCtr extends Controller
{
    public function index(){
        session()->forget('source');  
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
        return view('tenant-payment', $data);
    }

    public function index_error(){
        session()->forget('source');  
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
        return view('tenant-payment-error', $data);
    }
    
    public function gcashPayment(Request $request)
    {     
        //session()->forget('source');  
        $source_ss = session()->get('source');

        $amount = $request->input('payment-amount');
        $description = $request->input('payment-description');
        session()->put('description', $description);
        session()->put('amount', $amount);
         

        if(empty($source_ss)) {
            $source = $this->makeStatusChargable($amount,$description);
            $source_ss = [
                    'source_id' => $source->id,            
                    'amount' => $source->amount,
                    'status' => $source->status           
            ];
            session()->put('source', $source_ss);


            return redirect($source->getRedirect()['checkout_url']);      
        }
        else{
            if($source_ss['status'] !== 'pending')
            {      
                $source = $this->makeStatusChargable($amount,$description);
                
                $source_ss = [
                    'source_id' => $source->id,            
                    'amount' => $source->amount,
                    'status' => $source->status           
                ];
                session()->put('source', $source_ss);    
                return redirect($source->getRedirect()['checkout_url']); 
            }     

            $this->makePayment($source_ss,$description);        
       
        }
    }

    public function gcashPaymentCheckout(Request $request)
    {     
        //session()->forget('source');  
        $source_ss = session()->get('source');

        $amount = session()->get('amount');
        $description = session()->get('description');
         

        if(empty($source_ss)) {
            $source = $this->makeStatusChargable($amount,$description);
            $source_ss = [
                    'source_id' => $source->id,            
                    'amount' => $source->amount,
                    'status' => $source->status           
            ];
            session()->put('source', $source_ss);


            return redirect($source->getRedirect()['checkout_url']);      
        }
        else{
            if($source_ss['status'] !== 'pending')
            {      
                $source = $this->makeStatusChargable($amount,$description);
                
                $source_ss = [
                    'source_id' => $source->id,            
                    'amount' => $source->amount,
                    'status' => $source->status           
                ];
                session()->put('source', $source_ss);    
                return redirect($source->getRedirect()['checkout_url']); 
            }
            // else{
            //     return redirect('/tenant-payment')->send();
            // }     

            $this->makePayment($source_ss,$description);        
       
        }
    }

    public function makeStatusChargable($amount,$description)
    {
        return Paymongo::source()->create([
                    'type' => 'gcash',
                    'amount' => $amount,
                    'currency' => 'PHP',
                    'redirect' => [
                        'success' => route('gcash-payment-checkout'),
                        'failed' => 'https://fbapp.online/tenant-payment-error'
                    ]
                ]);

                    // $client = new \Adyen\Client();
                    // $client->setXApiKey("AQElhmfuXNWTK0Qc+iSWsEYtruifQYVKa/VRKzNocCf7vgBUZHA9xBDBXVsNvuR83LVYjEgiTGAH-AurpKfWJ2EAgJExVxOCSwR3qeJr2gtZ2W9llyEDi4QE=-KaXA2@cDh46@~E3Q");
                    // $client->setEnvironment(\Adyen\Environment::TEST);
                    // $service = new \Adyen\Service\Checkout($client);
                    
                    // $params = array(
                    // "amount" => array(
                    //     "currency" => "PHP",
                    //     "value" => 1000
                    // ),
                    // "reference" => "YOUR_ORDER_NUMBER",
                    // "paymentMethod" => array(
                    //     "type" => "gcash"
                    // ),
                    // "returnUrl" => "https://your-company.com/checkout?shopperOrder=12xy..",
                    // "merchantAccount" => "FBBuildingECOM"
                    // );
                    // $result = $service->payments($params);

                    // $client = new \Adyen\Client();
                    //  $client->setXApiKey("AQElhmfuXNWTK0Qc+iSWsEYtruifQYVKa/VRKzNocCf7vgBUZHA9xBDBXVsNvuR83LVYjEgiTGAH-AurpKfWJ2EAgJExVxOCSwR3qeJr2gtZ2W9llyEDi4QE=-KaXA2@cDh46@~E3Q");
                    // $client->setEnvironment(\Adyen\Environment::TEST);
                    // $service = new \Adyen\Service\Checkout($client);
                    
                    // $params = array(
                    // "amount" => array(
                    //     "currency" => "PHP",
                    //     "value" => 1000
                    // ),
                    // "reference" => "YOUR_ORDER_NUMBER",
                    // "paymentMethod" => array(
                    //     "type" => "gcash",
                    // ),
                    // "returnUrl" => "https://your-company.com/checkout?shopperOrder=12xy..",
                    // "merchantAccount" => "FBBuildingECOM"
                    // );

                    // $result = $service->payments($params);

                    // return dd($result);
    }

    public function makePayment($source_ss,$description)
    {
        Paymongo::payment()
        ->create([
            'amount' => $source_ss['amount'],
            'currency' => 'PHP',
            'description' => $description,
            'statement_descriptor' => 'Test',
            'source' => [
                'id' => $source_ss['source_id'],
                'type' => 'source'
            ]
        ]);

        // $tenant_room = DB::table('tbl_sales AS BR')
        // ->select('BR.invoice_no')
        // ->where('tbl_tenant.tenant_id', session('LoggedUser'))
        // ->first();

        $nextdate = DB::table('tbl_schedulepayment AS BR')
        ->select('BR.next_payment')
        ->where('BR.tenant_id', session('LoggedUser'))
        ->first();

        DB::table('tbl_sales')
        ->insert([
        'tenant_id' => session('LoggedUser'),
        'invoice_no' => $source_ss['source_id'],
        'product_name' => $description,
        'amount' => $source_ss['amount'],
        'payment_method' => 'GCash',
        'created_at' => \Carbon\Carbon::now(),
        'updated_at' => \Carbon\Carbon::now(),
        ]);

        DB::table('tbl_schedulepayment')
        ->where('tbl_schedulepayment.tenant_id', session('LoggedUser'))
        ->update([
            'paid_status' => '1',
            'next_payment' => Carbon::parse($nextdate->next_payment)->addMonthsNoOverflow(1)->format('Y-m-d'),
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);

        session()->forget('source');
        return redirect('/tenant-payment')->with('success', 'Your Online Payment Transaction is Successfully Created')->send();
        //return dd(Carbon::parse($nextdate->next_payment)->addMonthsNoOverflow(1)->format('Y-m-d'));
    }
}


