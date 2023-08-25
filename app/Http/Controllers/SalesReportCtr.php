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

class SalesReportCtr extends Controller
{
    public function index(){
        if(Session::has('LoggedUser')){
            $users2 = DB::table('tbl_user')->where('id','=', session('LoggedUser'))->first();
             $data = [
                 'LoggedUserInfo' => $users2
             ];
             //$users3 = User::where('role','employer')->get();
             return view('sales-report', $data);


         }
    }

     public function SalesReportData(Request $request)
    {
        $getEm = $this->getSalesReport($request->date_from, $request->date_to, $request->payment_method);
         if(request()->ajax())
             {  
                return datatables()->of($getEm)
            ->make(true);
             }
    }

    public function getSalesReport($date_from, $date_to, $payment_method)
    {

        if($payment_method == 'All Payment Method')
        {
            return DB::table('tbl_sales AS BR')
            ->select('BR.*','tbl_tenant.*')
            ->leftJoin('tbl_tenant', 'BR.tenant_id', '=', 'tbl_tenant.tenant_id')
            ->whereBetween('BR.created_at', [$date_from, date('Y-m-d', strtotime($date_to. ' + 1 days'))])
            ->get();
        }
        else
        {

            return DB::table('tbl_sales AS BR')
                ->select('BR.*','tbl_tenant.*')
                ->leftJoin('tbl_tenant', 'BR.tenant_id', '=', 'tbl_tenant.tenant_id')
                ->whereBetween('BR.created_at', [$date_from, date('Y-m-d', strtotime($date_to. ' + 1 days'))])
                ->where('BR.payment_method',$payment_method)
                ->get();    
        }
    }
    public function previewSalesReport($date_from, $date_to, $payment_method){
 
         $data= $this->getSalesReports($date_from, $date_to, $payment_method);
         $count = $this->countSalesReports($date_from, $date_to, $payment_method);
         $output = $this->generateSalesReport($data, $date_from, $date_to, $payment_method,  $count);
 
 
         $pdf = \App::make('dompdf.wrapper');
         $pdf->loadHTML($output);
         $pdf->setPaper('A4', 'landscape');
     
         return $pdf->stream();
     }
 
     public function getSalesReports($date_from, $date_to, $payment_method)
     {
        if($payment_method == 'All Payment Method')
        {
            return DB::table('tbl_sales AS BR')
            ->select('BR.*','tbl_tenant.*')
            ->leftJoin('tbl_tenant', 'BR.tenant_id', '=', 'tbl_tenant.tenant_id')
            ->whereBetween('BR.created_at', [$date_from, date('Y-m-d', strtotime($date_to. ' + 1 days'))])
            ->get(); 
        }
        else
        {
            return DB::table('tbl_sales AS BR')
                ->select('BR.*','tbl_tenant.*')
                ->leftJoin('tbl_tenant', 'BR.tenant_id', '=', 'tbl_tenant.tenant_id')
                ->whereBetween('BR.created_at', [$date_from, date('Y-m-d', strtotime($date_to. ' + 1 days'))])
                ->where('BR.payment_method',$payment_method)
                ->get(); 
        }
     }

     public function countSalesReports($date_from, $date_to, $payment_method)
     {
        if($payment_method == 'All Payment Method')
        {
            return DB::table('tbl_sales AS BR')
            ->select('BR.*','tbl_tenant.*')
            ->leftJoin('tbl_tenant', 'BR.tenant_id', '=', 'tbl_tenant.tenant_id')
            ->whereBetween('BR.created_at', [$date_from, date('Y-m-d', strtotime($date_to. ' + 1 days'))])
            ->count(); 
        }
        else
        {
            return DB::table('tbl_sales AS BR')
                ->select('BR.*','tbl_tenant.*')
                ->leftJoin('tbl_tenant', 'BR.tenant_id', '=', 'tbl_tenant.tenant_id')
                ->whereBetween('BR.created_at', [$date_from, date('Y-m-d', strtotime($date_to. ' + 1 days'))])
                ->where('BR.payment_method',$payment_method)
                ->count(); 
        }
     }

     public function generateSalesReport($data, $date_from, $date_to, $payment_method,  $count)
     {
        $sales = new Sales;
        $total_sales = $sales->computeTotalSales($date_from, $date_to, $payment_method);
         $add = '';
         $add2 = '';
         $add3 = '';
         $add4 = '';
         $td = '<td>';
         $tds = '</td>';
        $th1 = '';

        if($payment_method == 'All Payment Method')
         {
             $add = '';
         }
         else
         {
             $add = 'Payment Method: ' . $payment_method;
         }

         $output = '
         <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
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

         .peso{
            font-family: DejaVu Sans, sans-serif;
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
             text-align:center;
         }
 
         .align-text td{
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

         .ar2{
            position:absolute; 
            bottom:0px;
            right:0px;
            
        }

        .right {
            display: block;
            margin-left: auto;
            margin-right: auto;
            position:absolute;
            left:750px;
            }
 
 
          </style>
         <div style="width:100%">
         
         <h2 style="text-align:center;">Sales Report</h2>
         <h2 style="text-align:center;">For the Month of '.date("F", strtotime($date_from)).' '.date("Y", strtotime($date_from)).'</h2>
         <p style="text-align:right;">Date Coverage: '. date("M/d/Y", strtotime($date_from)) .' to '. date("M/d/Y", strtotime($date_to)).'</p>
         <p style="text-align:left;">Total sales: <span class = "peso">&#8369;</span> <b>'. number_format($total_sales,2,'.',',') .'</b></p>
         <p style="text-align:left;">No. of Sales: '.  $count .' </p>
         <p style="text-align:left;"> '.  $add. '</p>
 
      
     
         <table width="100%" style="border-collapse:collapse">                
             <thead>
                 <tr>
                    <th>Invoice No.</th>
                    <th>Tenant Name</th>
                    <th>Product/Description</th>
                    <th>Payment Method</th>
                    <th>Amount</th>
                    <th>Date Time</th>
                 <tr>      
             </thead>
             ';
             if($data){
                 foreach ($data as $datas) {

                                 $output .='
                         <tr class="align-text">                             
                             <td>INV-'. $datas->invoice_no .'</td>  
                             <td>'. $datas->fname . ' ' . $datas->mname . ' ' . $datas->lname .'</td>
                             <td>'. $datas->product_name .'</td>   
                             <td>'. $datas->payment_method .'</td>   
                             <td><span class = "peso">&#8369;</span>'. $datas->amount .'</td>
                             <td>'. $datas->created_at .'</td>      
                         </tr>
                         ';        
                 }
             }
             else{
                 echo "No data found";
             }

              $output .='
              </tbody>
              </table>
              <p class="ar2"> Date Generated: '. Carbon::now()->format('F d, Y').' <br/> Sales Report Generated By: '. Session::get('Name') .'</p>
              ';
         
         return $output;
     }
     public function computeSales(Request $request) {

        $input = $request->all();
        $date_from = $input['date_from'];
        $date_to = $input['date_to'];
        $payment_method = $input['payment_method'];

        $data = new Sales;
        return $data->computeTotalSales($date_from, $date_to, $payment_method);
    }
}
