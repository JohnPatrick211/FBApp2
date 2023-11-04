<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Login;
use App\Models\Tenant;
use App\Models\Employee;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;


class TenantApprovalCtr extends Controller
{
    public function index(){
        return view('admin-tenant-approval');
    }
}
