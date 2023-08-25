<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Billing extends Model
{
    protected $table = 'tbl_billingtray';

    public function readCashieringTray(){
        return DB::table('tbl_billingtray as C')
            ->select("C.*")
            ->where('C.cashiering_id',session('LoggedUser'))
            ->get();
    }

    public function readTotalAmount(){
        return $this->max();
    }
}
