<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Sales extends Model
{
    protected $table = 'tbl_sales';

    public function readSales($date_from, $date_to, $order_from, $payment_method){
        return DB::table('tbl_sales as S')
        ->select('S.*', 'P.*', 'S.qty', 'S.id as id',
                'U.name as unit', 
                DB::raw('S.created_at as date_time'))
        ->leftJoin('tbl_product as P', 'P.id', '=', 'S.product_code')
        ->where('S.status', 1)
        ->where('S.order_from', $order_from)
        ->where('S.payment_method', $payment_method)
        ->whereBetween(DB::raw('DATE(S.created_at)'), [$date_from, $date_to])
        ->orderBy   ('S.invoice_no', 'desc')
        ->get();
    }

    public function computeTotalSales($date_from, $date_to, $payment_method){

        if($payment_method == "All Payment Method"){
            return DB::table('tbl_sales')
            ->whereBetween(DB::raw('DATE(created_at)'), [$date_from, $date_to])
            ->sum('amount');
        }
        else{
            return DB::table('tbl_sales')
            ->whereBetween(DB::raw('DATE(created_at)'), [$date_from, $date_to])
            ->where('payment_method', $payment_method)
            ->sum('amount');
        }
    }
}
