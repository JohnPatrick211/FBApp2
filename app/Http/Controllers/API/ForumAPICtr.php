<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Login;
use App\Models\Forum;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class ForumAPICtr extends Controller
{
    public function getForum(Request $request){
        $forum = DB::table('tbl_forum AS BR')
            ->select('BR.*', 'tbl_tenant.*','tbl_employee.*','tbl_admin.*','BR.id AS forum_id', 'tbl_user.*','tbl_user.user_role AS role'
            ,'tbl_employee.fname AS emp_fname', 'tbl_employee.mname AS emp_mname', 'tbl_employee.lname AS emp_lname'
            ,'tbl_tenant.fname AS tenant_fname','tbl_tenant.mname AS tenant_mname', 'tbl_tenant.lname AS tenant_lname', 'BR.created_at AS created')
            ->leftJoin('tbl_tenant', 'BR.author_id', '=', 'tbl_tenant.tenant_id')
            ->leftJoin('tbl_employee', 'BR.author_id', '=', 'tbl_employee.emp_id')
            ->leftJoin('tbl_admin', 'BR.author_id', '=', 'tbl_admin.admin_id')
            ->leftJoin('tbl_user', 'BR.author_id', '=', 'tbl_user.id')
            ->get();

            return response()->json([
                'success' => true,
                'forum' => $forum
            ]);    
    }
}
