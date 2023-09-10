<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Luigel\Paymongo\Facades\Paymongo;
use App\Models\Login;
use App\Models\Tenant;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class PaymentAPICtr extends Controller
{
    public function getPayment(Request $request)
    {     
        //session()->forget('source');  
        $source_ss = session()->get('source');

        $id = $request->id;
        $amount = $request->amount;
        $description = $request->description;
        session()->put('description', $description);
        session()->put('amount', $amount);

        $source_id = DB::table('tbl_onlinepayment as BR')
        ->select('BR.online_id')
        ->where('BR.tenant_id','=', $id)
        ->first();

        $url = DB::table('tbl_onlinepayment as BR')
        ->select('BR.url')
        ->where('BR.tenant_id','=', $id)
        ->first();

        $status = DB::table('tbl_onlinepayment as BR')
        ->select('BR.status')
        ->where('BR.tenant_id','=', $id)
        ->first();
         

        if(empty($source_id)) {
            $source = $this->makeStatusChargable($amount,$description,$id);
            $source_ss = [
                    'source_id' => $source->id,            
                    'amount' => $source->amount,
                    'status' => $source->status           
            ];
            session()->put('source', $source_ss);

            DB::table('tbl_onlinepayment')
            ->insert([
            'tenant_id' => $id,
            'online_id' => $source_ss['source_id'],
            'amount' => $source_ss['amount'],
            'description' => $description,
            'url' => $source->getRedirect()['checkout_url'],
            'status' => $source->status,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
            ]);

            // return redirect($source->getRedirect()['checkout_url']);
            
            return response()->json([
                'success' => true,
                'redirect' => $source->getRedirect()['checkout_url'],
                'id' => $source_ss['source_id'],
                'looper' => 1,
            ]);
        }
        else{
            if($status->status !== 'pending'){
                $source = $this->makeStatusChargable($amount,$description,$id);
                $source_ss = [
                        'source_id' => $source->id,            
                        'amount' => $source->amount,
                        'status' => $source->status           
                ];
                session()->put('source', $source_ss);
    
                DB::table('tbl_onlinepayment')
                ->insert([
                'tenant_id' => $id,
                'online_id' => $source_ss['source_id'],
                'amount' => $source_ss['amount'],
                'description' => $description,
                'url' => $source->getRedirect()['checkout_url'],
                'status' => $source['status'],
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
                ]);
    
                // return redirect($source->getRedirect()['checkout_url']);
                
                return response()->json([
                    'success' => true,
                    'redirect' => $source->getRedirect()['checkout_url'],
                    'id' => $source_ss['source_id'],
                    'looper' => 1,
                ]);
            }
            else{

                $str = $url->url;
                $split = explode("id=",$str);
                return response()->json([
                    'success' => true,
                    'redirect' =>  $url->url,
                    'id' => $split[1],
                ]);  
            }
        }
                        
    }

    public function gcashPaymentCheckoutAPI(Request $request)
    {  
        $tenant_id = $request->id;   
        //session()->forget('source');  
        $source_id = DB::table('tbl_onlinepayment as BR')
            ->select('BR.online_id')
            ->where('BR.tenant_id','=', $request->id)
            ->first();

            $amount = DB::table('tbl_onlinepayment as BR')
            ->select('BR.amount')
            ->where('BR.tenant_id','=', $request->id)
            ->where('BR.online_id','=', $source_id->online_id)
            ->first();
        $description = $request->description;

        $finalamount = (float)$amount->amount;

        if(empty($source_id)) {
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
            return $this->makePayment($finalamount,$description,$source_id,$tenant_id);   
            
         }
    }

    public function makeStatusChargable($amount,$description,$id)
    {

        return Paymongo::source()->create([
                    'type' => 'gcash',
                    'amount' => $amount,
                    'currency' => 'PHP',
                    'redirect' => [
                         'success' => route('gcashPaymentCheckoutAPI', ['id' => $id, 'amount' => $amount, 'description' => $description]),
                         'failed' => 'https://fbapp.online/tenant-payment-error'
                    ]
                ]);
    }

    public function makePayment($finalamount,$description,$source_id,$tenant_id)
    {
        Paymongo::payment()
        ->create([
            'amount' => $finalamount,
            'currency' => 'PHP',
            'description' => $description,
            'statement_descriptor' => 'Test',
            'source' => [
                'id' => $source_id->online_id,
                'type' => 'source'
            ]
        ]);

        DB::table('tbl_onlinepayment')->where('online_id', $source_id->online_id)->delete();

        DB::table('tbl_sales')
        ->insert([
        'tenant_id' => $tenant_id,
        'invoice_no' => $source_id->online_id,
        'product_name' => $description,
        'amount' => $finalamount,
        'payment_method' => 'GCash',
        'created_at' => \Carbon\Carbon::now(),
        'updated_at' => \Carbon\Carbon::now(),
        ]);

        session()->forget('source');

        return response()->json([
            'success' => true,
            'message' => 'payment successfully, return to mobile app'
        ]);
    }
}
