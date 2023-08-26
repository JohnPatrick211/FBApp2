<?php

namespace App\Http\Controllers;

use App\Models\Login;
use App\Models\Forum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;


class ForumCtr extends Controller
{
    public function index()
    {
            $staff = Login:: where('id','=', session('LoggedUser'))->first();
            $forum = DB::table('tbl_forum AS BR')
            ->select('BR.*', 'tbl_tenant.*','tbl_employee.*','tbl_admin.*','BR.id AS forum_id', 'tbl_user.*','tbl_user.user_role AS role'
            ,'tbl_employee.fname AS emp_fname', 'tbl_employee.mname AS emp_mname', 'tbl_employee.lname AS emp_lname'
            ,'tbl_tenant.fname AS tenant_fname','tbl_tenant.mname AS tenant_mname', 'tbl_tenant.lname AS tenant_lname')
            ->leftJoin('tbl_tenant', 'BR.author_id', '=', 'tbl_tenant.tenant_id')
            ->leftJoin('tbl_employee', 'BR.author_id', '=', 'tbl_employee.emp_id')
            ->leftJoin('tbl_admin', 'BR.author_id', '=', 'tbl_admin.admin_id')
            ->leftJoin('tbl_user', 'BR.author_id', '=', 'tbl_user.id')
            ->get();
            
            $data = [
                'LoggedUserInfo' => $staff,
            ];

            return view('forum', $data)->with('forums',$forum);

    }

    public function showindex($forum_id)
    {
            $staff = Login:: where('id','=', session('LoggedUser'))->first();
            $forum = DB::table('tbl_forum AS BR')
            ->select('BR.*', 'tbl_tenant.*','tbl_employee.*','tbl_admin.*', 'tbl_comment.*','BR.id AS forum_id', 'tbl_user.*','tbl_user.user_role AS role'
            ,'tbl_employee.fname AS emp_fname', 'tbl_employee.mname AS emp_mname', 'tbl_employee.lname AS emp_lname'
            ,'tbl_tenant.fname AS tenant_fname','tbl_tenant.mname AS tenant_mname', 'tbl_tenant.lname AS tenant_lname'
            ,'tbl_employee.profile_pic AS emp_profile_pic','tbl_tenant.profile_pic AS tenant_profile_pic')
            ->leftJoin('tbl_tenant', 'BR.author_id', '=', 'tbl_tenant.tenant_id')
            ->leftJoin('tbl_employee', 'BR.author_id', '=', 'tbl_employee.emp_id')
            ->leftJoin('tbl_admin', 'BR.author_id', '=', 'tbl_admin.admin_id')
            ->leftJoin('tbl_comment', 'BR.author_id', '=', 'tbl_comment.user_id')
            ->leftJoin('tbl_user', 'BR.author_id', '=', 'tbl_user.id')
            ->where('BR.id',$forum_id)
            ->first();

            $comment = DB::table('tbl_comment AS BR')
            ->select('BR.*', 'tbl_tenant.*','tbl_employee.*','tbl_admin.*', 'tbl_forum.*','BR.id AS comment_id', 'tbl_user.*','tbl_user.user_role AS role'
            ,'tbl_employee.fname AS emp_fname', 'tbl_employee.mname AS emp_mname', 'tbl_employee.lname AS emp_lname'
            ,'tbl_tenant.fname AS tenant_fname','tbl_tenant.mname AS tenant_mname', 'tbl_tenant.lname AS tenant_lname'
            ,'tbl_employee.profile_pic AS emp_profile_pic','tbl_tenant.profile_pic AS tenant_profile_pic')
            ->leftJoin('tbl_tenant', 'BR.user_id', '=', 'tbl_tenant.tenant_id')
            ->leftJoin('tbl_employee', 'BR.user_id', '=', 'tbl_employee.emp_id')
            ->leftJoin('tbl_admin', 'BR.user_id', '=', 'tbl_admin.admin_id')
            ->leftJoin('tbl_forum', 'BR.parent_id', '=', 'tbl_forum.author_id')
            ->leftJoin('tbl_user', 'BR.user_id', '=', 'tbl_user.id')
            ->where('BR.parent_id',$forum_id)
            ->get();

            //$forum = Forum::find($forum_id)->first();
            
            $data = [
                'LoggedUserInfo' => $staff,
            ];

           return view('show-forum-comment', $data)->with('forums',$forum)->with('comments',$comment);
           //return dd($comment);
          // return dd($forum);

    }

    public function store(Request $request)
    {
        // store code
    }
}
