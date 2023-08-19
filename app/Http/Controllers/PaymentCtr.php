<?php

namespace App\Http\Controllers;
use Luigel\Paymongo\Facades\Paymongo;

use Illuminate\Http\Request;

class PaymentCtr extends Controller
{
    public function index(){
          return view('payment');
    }
    
    public function gcashPayment()
    {     
        $source_ss = session()->get('source');   

        if(empty($source_ss)) {
        $source = Paymongo::source()->create([
            'type' => 'gcash',
            'amount' => 100.00,
            'currency' => 'PHP',
            'redirect' => [
                'success' => route('gcashpayment'),
                'failed' => route('gcashpayment')
            ]
        ]);
            $source_ss = [
                    'source_id' => $source->id,            
                    'amount' => $source->amount,
                    'status' => $source->status           
            ];
            session()->put('source', $source_ss);


        return redirect($source->getRedirect()['checkout_url']);      
        }
        else{
            Paymongo::payment()
            ->create([
                'amount' => $source_ss['amount'],
                'currency' => 'PHP',
                'description' => 'Davids Grill Test Payment',
                'statement_descriptor' => 'Test',
                'source' => [
                    'id' => $source_ss['source_id'],
                    'type' => 'source'
                ]
            ]);

            session()->forget('source');
            return redirect('/payment')->send();
        }
    }
}
