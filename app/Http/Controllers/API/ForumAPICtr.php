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

        $id = $request->id;

        if($id == 'ALL')
        {
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
        else{
            $forum = DB::table('tbl_forum AS BR')
            ->select('BR.*', 'tbl_tenant.*','tbl_employee.*','tbl_admin.*','BR.id AS forum_id', 'tbl_user.*','tbl_user.user_role AS role'
            ,'tbl_employee.fname AS emp_fname', 'tbl_employee.mname AS emp_mname', 'tbl_employee.lname AS emp_lname'
            ,'tbl_tenant.fname AS tenant_fname','tbl_tenant.mname AS tenant_mname', 'tbl_tenant.lname AS tenant_lname', 'BR.created_at AS created')
            ->leftJoin('tbl_tenant', 'BR.author_id', '=', 'tbl_tenant.tenant_id')
            ->leftJoin('tbl_employee', 'BR.author_id', '=', 'tbl_employee.emp_id')
            ->leftJoin('tbl_admin', 'BR.author_id', '=', 'tbl_admin.admin_id')
            ->leftJoin('tbl_user', 'BR.author_id', '=', 'tbl_user.id')
            ->where('BR.author_id', $id)
            ->get();

            return response()->json([
                'success' => true,
                'forum' => $forum
            ]);
        }    
    }

    public function addForum(Request $request){
        $forum = new Forum();
        $validateforum =  Forum::where('title','=', $request->title)->first();
        if($validateforum)
        {
            return response()->json([
                'success' => false,
                'message' => 'Forum Title Already Exist'
            ]);
        }
        else
        {
            $forum->title = $request->title;
            $forum->body = $request->body;
            $forum->author_id = $request->author_id;
            $forum->save();

            return response()->json([
                'success' => true,
                'message' => 'Forum Created Successfully'
            ]);
        }
    }

    public function updateForum(Request $request){
        DB::table('tbl_forum')
        ->where('id', $request->id)
        ->update([
            'title' => $request->title,
            'body' => $request->body,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
        
        return response()->json([
            'success' => true,
            'message' => 'Forum Edited Successfully'
        ]);
    }

    public function deleteForum(Request $request){
        DB::table('tbl_forum')->where('id', $request->id)->delete();
        //DB::table('tbl_comment')->where('parent_id', $request->parent_id)->delete();

        return response()->json([
            'success' => true,
            'message' => 'Forum Deleted Successfully'
        ]);
    }

    // Comment
    public function getComment(Request $request){

        $forum_id = $request->forum_id;

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
            ->groupBy('BR.id')
            ->get();

            return response()->json([
                'success' => true,
                'comment' => $comment
            ]);
    }
}
