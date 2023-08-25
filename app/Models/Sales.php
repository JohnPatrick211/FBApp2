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

    public function computeTotalSales($date_from, $date_to, $salesreportbranch){
        if($salesreportbranch == 'All Branches')
        {
            return DB::table('tbl_sales')
            ->where('status', 1)
            ->where('tbl_sales.product_id', 'LIKE', '1%')
            ->whereBetween(DB::raw('DATE(created_at)'), [$date_from, $date_to])
            ->sum('amount');
        }
        else{
            return DB::table('tbl_sales')
            ->where('status', 1)
            ->where('branch_id',$salesreportbranch)
            ->where('tbl_sales.product_id', 'LIKE', '1%')
            ->whereBetween(DB::raw('DATE(created_at)'), [$date_from, $date_to])
            ->sum('amount');
        }
    }

    public function computeTotalServices($date_from, $date_to, $servicesreportbranch){
        if($servicesreportbranch == 'All Branches')
        {
            return DB::table('tbl_sales')
            ->where('status', 1)
            ->where('tbl_sales.product_id', 'LIKE', '2%')
            ->whereBetween(DB::raw('DATE(created_at)'), [$date_from, $date_to])
            ->sum('amount');
        }
        else{
            return DB::table('tbl_sales')
            ->where('status', 1)
            ->where('branch_id',$servicesreportbranch)
            ->where('tbl_sales.product_id', 'LIKE', '2%')
            ->whereBetween(DB::raw('DATE(created_at)'), [$date_from, $date_to])
            ->sum('amount');
        }
    }
}
