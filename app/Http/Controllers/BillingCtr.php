<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Login;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Models\Billing;
use App\Models\Sales;
use App\Helpers\base;
use Carbon\Carbon;

class BillingCtr extends Controller
{
    public function index()
    {
            $staff = Login:: where('id','=', session('LoggedUser'))->first();
            $data = [
                'LoggedUserInfo' => $staff,
            ];
            return view('billing', $data);
    }

    public function addToTray(Request $request)
    {
            $product_name = $request->input('product_name');
            $id = $request->input('id');
            $amount = $request->input('amount');
           
            if($this->isProductExists($product_name)){
                // DB::table('tbl_billingtray')
                // ->where('product_id', $product_code)
                // ->update(array(
                //     'amount' => DB::raw('amount + '. $amount),
                //     'qty' => DB::raw('qty + '. $qty)));
                return false;
            }
            else{
                $c = new Billing;
                $c->product_name = $product_name;
                $c->cashiering_id = session('LoggedUser');
                $c->tenant_id = $id;
                $c->amount = $amount;
                $c->save();

                return true;
            }
    }

    public function isProductExists($product_name){
        $p = DB::table('tbl_billingtray')->where('product_name', $product_name)->where('cashiering_id', session('LoggedUser'));
        if($p->count() > 0){
            return true;
        }
        else{
            return false;
        }
    }

    public function readTray(){
        $cashiering = new Billing;
        return $cashiering->readCashieringTray();
    }

    public function void(Request $request, $id)
    {
        $username = $request->input('username');
        $password = $request->input('password');
        
        $data = DB::table('tbl_user')
            ->where('username', $username)
            ->where('user_role', 'System Admin')
            ->orWhere('user_role', 'Employee')
            ->first();
            
        if ($data) {
            // if password is correct, void the item.
            $CheckedHash = Hash::check($request->password, $data->password); 
            if ($CheckedHash) {      
                DB::table('tbl_billingtray')->where('id', $id)->delete();
                return 'success';
            }
            else {
                return 'failed';
            }
        }
        else {
            return 'failed';
        }
       
    }

    public function recordSale(Request $request)
    {
        $input =$request->all();
        $cashiering = new Billing;
        $data = $cashiering->readCashieringTray();
        $invoice_no = $input['invoice_no'];

        if (!$this->isInvoiceExists($invoice_no)) {
            foreach ($data as $items) {
                $sales = new Sales;
                $sales->invoice_no = $invoice_no;
                $sales->product_name = $items->product_name;
                $sales->amount = $items->amount;
                $sales->payment_method = $input['payment_method'];
                $sales->tenant_id = $input['id'];
                $sales->save();
            }

            return 'success';
        }
        else {
            return 'invoice_exists';
        }
    }

    public function isInvoiceExists($invoice_no){
        $row = DB::table('tbl_sales')->where('invoice_no', $invoice_no)->get();
        return count($row) > 0 ? true : false;
    }

    public function previewInvoice($tenantname, $invoice){
       
        
        $cashiering = new Billing;
        $data = $cashiering->readCashieringTray();
        $output = $this->generateSalesInvoice($data, $tenantname, $invoice);

        $this->removeAllTrayProducts();

        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($output);
        $pdf->setPaper('A5', 'portrait');
    
        return $pdf->stream('Invoice-#');
    }

    public function generateSalesInvoice($product, $tenantname, $invoice){
        $date = '';
        foreach ($product as $data) {
            $date =  $data->created_at;
            
        }
        
        $output ='
        <style>
        @page { margin: 10px; }
        body{ font-family: sans-serif; }
        th{
            border: 1px solid;
        }
        td{
            font-size: 14px;
            border: 1px solid;
            padding-right: 2px;
            padding-left: 2px;
        }

        .p-name{
            text-align:center;
            margin-bottom:5px;
        }

        .address{
            text-align:center;
            margin-top:0px;
        }

        .p-details{
            margin:0px;
        }

        .ar{
            text-align:right;
        }

        .al{
            text-left:right;
        }

        .align-text{
            text-align:right;
        }

        .align-text td{
        }

        .w td{
            width:20px;
        }

   

        .b-text .line{
            margin-bottom:0px;
        }

        .b-text .b-label{
            font-size:12px;
            margin-top:-7px;
            margin-right:12px;
            font-style:italic;
        }

        .f-courier{
            font-family: monospace, sans-serif;
            font-size:14px;
        }


         </style>
        <div style="width:100%">
        <h3 style="text-align:center;">OFFICIAL RECEIPT</h3>
        <br/>
        <p class="p-details address" style="text-align:right;"> Date: '. $date .'</p>
        <p class="p-details address" style="text-align:left;">Tenant Name: '.$tenantname .'</p>
        <p class="p-details address" style="text-align:left;">Invoice No.: '.$invoice .'</p>
        <br/>

     
    
        <table width="100%" style="border-collapse:collapse; border: 1px solid;">                
            <thead>
                <tr>
                    <th th colspan="1"">Product/Description</th>    
                    <th colspan="2">Amount</th>
                <tr>      
            </thead>
        <tbody>
            ';
            $total_amount = 0;
            $sub_total = 0;
            if($product){
                foreach ($product as $data) {
                    $total_amount += $data->amount;
                        $output .='
                <tr class="align-text">                             
                    <td class="f-courier">'. $data->product_name .'</td>   
                    <td class="f-courier align-text" colspan="2" style="width:210px;">'. number_format($data->amount,2,'.',',') .'</td>  
                </tr>
                ';
                                  
                } 
            }
            else{
                echo "No data found";
            }

            $output .='

            <tr>
                <td style="text-align:right;" colspan="2">Total Amount Due </td>
                <td class="align-text f-courier">PhP '. number_format(($total_amount),2,'.',',')  .'</td>
            </tr>

            </tbody>
        </table>
    
        <div class="b-text">
            <p class="ar line">----------------------------------------</p>
            <p class="ar b-label">Cashier/Authorized Representative</p>
        </div>
    </div>';

        return $output;
    }

    public function removeAllTrayProducts() {
        // $cashiering = new Billing;
        // $cashiering->truncate();
        DB::table('tbl_billingtray')->where('cashiering_id', session('LoggedUser'))->delete();
    }

    public function getTenantInfo($id)
    {
        $get_username = DB::table('tbl_tenant')
        ->select('tbl_tenant.*', 'tbl_room.*', 'tbl_room.id AS roomid')
        ->leftJoin('tbl_room', 'tbl_tenant.room_id', '=', 'tbl_room.id')
        ->where('tenant_id',$id)
        ->where('tbl_tenant.status',1)
        ->get();

         return  $get_username;
    }
}
