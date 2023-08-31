<?php

namespace App\Http\Controllers;

use App\Models\Login;
use App\Models\Forum;
use App\Models\Comment;
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
            ->groupBy('BR.id')
            ->get();

            //$forum = Forum::find($forum_id)->first();
            
            $data = [
                'LoggedUserInfo' => $staff,
            ];

           return view('show-forum-comment', $data)->with('forums',$forum)->with('comments',$comment);
           //return dd($comment);
          // return dd($forum);

    }
    //Add
    public function AddForum(Request $request)
    {
        $forum = new Forum();
        $validateforum =  Forum::where('title','=', $request->input('title'))->first();
        if($validateforum)
        {
            return back()->with('danger', 'Forum Already Exist');
        }
        else
        {
            $forum->title = $request->input('title');
            $forum->body = $request->input('body');
            $forum->author_id = Session::get('LoggedUser');
            $forum->save();
        // $getname = Session::get('Name');
        // $getusertype = Session::get('User-Type');
        // base::recordAction( $getname, $getusertype,'Category Maintenance', 'Add Category Successfully');
        // return redirect('maintenance-category')->with('success', 'Category Saved');
         return back()->with('success', 'Forum Saved');
        }
    }
    //Edit
    public function EditForum(Request $request,$id)
    {
        DB::table('tbl_forum')
        ->where('id', $id)
        ->update([
            'title' => $request->input('edittitle'),
            'body' => $request->input('editbody'),
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
        // $getname = Session::get('Name');
        // $getusertype = Session::get('User-Type');
        // base::recordAction( $getname, $getusertype,'Category Maintenance', 'Add Category Successfully');
        // return redirect('maintenance-category')->with('success', 'Category Saved');
         return back()->with('success', 'Forum Edited Successfully');
        
    }
    //Delete
    public function DeleteForum(Request $request,$id)
    {
        DB::table('tbl_forum')->where('id', $id)->delete();
        DB::table('tbl_comment')->where('parent_id', $id)->delete();
        // $getname = Session::get('Name');
        // $getusertype = Session::get('User-Type');
        // base::recordAction( $getname, $getusertype,'Category Maintenance', 'Add Category Successfully');
        // return redirect('maintenance-category')->with('success', 'Category Saved');
         return redirect('forum')->with('success', 'Forum Deleted Successfully');
        
    }
    //COMMENT
    //Add
    public function AddComment(Request $request)
    {
        $comment = new Comment();
        $validatecomment =  Comment::where('comment_body','=', $request->input('comment_body'))->first();
        if($validatecomment)
        {
            return back()->with('danger', 'Comment Already Exist');
        }
        else
        {
            $comment->parent_id = $request->input('parent_id');
            $comment->comment_body = $request->input('comment_body');
            $comment->user_id = Session::get('LoggedUser');
            $comment->save();
        // $getname = Session::get('Name');
        // $getusertype = Session::get('User-Type');
        // base::recordAction( $getname, $getusertype,'Category Maintenance', 'Add Category Successfully');
        // return redirect('maintenance-category')->with('success', 'Category Saved');
         return back()->with('success', 'Comment Posted');
        }
    }
    //Edit
    public function EditComment(Request $request)
    {
        DB::table('tbl_comment')
        ->where('id', $request->input('comment_id'))
        ->update([
            'comment_body' => $request->input('editcomment_body'),
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
        // $getname = Session::get('Name');
        // $getusertype = Session::get('User-Type');
        // base::recordAction( $getname, $getusertype,'Category Maintenance', 'Add Category Successfully');
        // return redirect('maintenance-category')->with('success', 'Category Saved');
         return back()->with('success', 'Comment Edited Successfully');
        
    }
    //get comment info
    public function getCommentInfo($id){
        return DB::table('tbl_comment AS BR')
            ->select('BR.*')
            ->where('BR.id',$id)
            ->get();
    }
    //Delete
    public function DeleteComment(Request $request)
    {
        DB::table('tbl_comment')->where('id', $request->input('forcommentdelete'))->delete();
        // $getname = Session::get('Name');
        // $getusertype = Session::get('User-Type');
        // base::recordAction( $getname, $getusertype,'Category Maintenance', 'Add Category Successfully');
        // return redirect('maintenance-category')->with('success', 'Category Saved');
         return back()->with('success', 'Comment Delete Successfully');
        
    }

    //---------------------------------------------//

    //TENANT SIDE

    //INDEX
    public function tenant_index()
    {
            $staff = Login:: where('id','=', session('LoggedUser'))->first();
            $forum = DB::table('tbl_forum AS BR')
            ->select('BR.*', 'tbl_tenant.*','tbl_employee.*','tbl_admin.*','BR.id AS forum_id', 'tbl_user.*','tbl_user.user_role AS role'
            ,'tbl_employee.fname AS emp_fname', 'tbl_employee.mname AS emp_mname', 'tbl_employee.lname AS emp_lname'
            ,'tbl_tenant.fname AS tenant_fname','tbl_tenant.mname AS tenant_mname', 'tbl_tenant.lname AS tenant_lname'
            ,'tbl_employee.profile_pic AS emp_profile_pic','tbl_tenant.profile_pic AS tenant_profile_pic')
            ->leftJoin('tbl_tenant', 'BR.author_id', '=', 'tbl_tenant.tenant_id')
            ->leftJoin('tbl_employee', 'BR.author_id', '=', 'tbl_employee.emp_id')
            ->leftJoin('tbl_admin', 'BR.author_id', '=', 'tbl_admin.admin_id')
            ->leftJoin('tbl_user', 'BR.author_id', '=', 'tbl_user.id')
            ->get();
            
            $data = [
                'LoggedUserInfo' => $staff,
                'forum' => $forum,
            ];

            return view('tenant-forum', $data);

    }

    public function showtenantindex($forum_id)
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
            ->groupBy('BR.id')
            ->get();

            //$forum = Forum::find($forum_id)->first();
            
            $data = [
                'LoggedUserInfo' => $staff,
            ];

           return view('tenant-show-forum-comment', $data)->with('forums',$forum)->with('comments',$comment);
           //return dd($comment);
          // return dd($forum);

    }

    //tenant delete forum
    public function DeleteForumByTenant(Request $request,$id)
    {
        DB::table('tbl_forum')->where('id', $id)->delete();
        DB::table('tbl_comment')->where('parent_id', $id)->delete();
        // $getname = Session::get('Name');
        // $getusertype = Session::get('User-Type');
        // base::recordAction( $getname, $getusertype,'Category Maintenance', 'Add Category Successfully');
        // return redirect('maintenance-category')->with('success', 'Category Saved');
         return redirect('tenant-forum')->with('success', 'Forum Deleted Successfully');
        
    }

    //Add Comment By Tenant
    public function AddCommentByTenant(Request $request)
    {
        $comment = new Comment();
        $validatecomment =  Comment::where('comment_body','=', $request->input('comment_body'))->first();
        if($validatecomment)
        {
            return back()->with('danger', 'Comment Already Exist');
        }
        else
        {
            $comment->parent_id = $request->input('parent_id');
            $comment->comment_body = $request->input('comment_body');
            $comment->user_id = Session::get('LoggedUser');
            $comment->save();
        // $getname = Session::get('Name');
        // $getusertype = Session::get('User-Type');
        // base::recordAction( $getname, $getusertype,'Category Maintenance', 'Add Category Successfully');
        // return redirect('maintenance-category')->with('success', 'Category Saved');
         return back()->with('success', 'Comment Posted');
        }
    }

    //---------------------------------------------//

    //EMPLOYEE SIDE

    //INDEX
    public function employee_index()
    {
            $staff = Login:: where('id','=', session('LoggedUser'))->first();
            $forum = DB::table('tbl_forum AS BR')
            ->select('BR.*', 'tbl_tenant.*','tbl_employee.*','tbl_admin.*','BR.id AS forum_id', 'tbl_user.*','tbl_user.user_role AS role'
            ,'tbl_employee.fname AS emp_fname', 'tbl_employee.mname AS emp_mname', 'tbl_employee.lname AS emp_lname'
            ,'tbl_tenant.fname AS tenant_fname','tbl_tenant.mname AS tenant_mname', 'tbl_tenant.lname AS tenant_lname'
            ,'tbl_employee.profile_pic AS emp_profile_pic','tbl_tenant.profile_pic AS tenant_profile_pic')
            ->leftJoin('tbl_tenant', 'BR.author_id', '=', 'tbl_tenant.tenant_id')
            ->leftJoin('tbl_employee', 'BR.author_id', '=', 'tbl_employee.emp_id')
            ->leftJoin('tbl_admin', 'BR.author_id', '=', 'tbl_admin.admin_id')
            ->leftJoin('tbl_user', 'BR.author_id', '=', 'tbl_user.id')
            ->get();
            
            $data = [
                'LoggedUserInfo' => $staff,
                'forum' => $forum,
            ];

            return view('employee-forum', $data);

    }

    public function showemployeeindex($forum_id)
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
            ->groupBy('BR.id')
            ->get();

            //$forum = Forum::find($forum_id)->first();
            
            $data = [
                'LoggedUserInfo' => $staff,
            ];

           return view('employee-show-forum-comment', $data)->with('forums',$forum)->with('comments',$comment);
           //return dd($comment);
          // return dd($forum);

    }

    //employee delete forum
    public function DeleteForumByEmployee(Request $request,$id)
    {
        DB::table('tbl_forum')->where('id', $id)->delete();
        DB::table('tbl_comment')->where('parent_id', $id)->delete();
        // $getname = Session::get('Name');
        // $getusertype = Session::get('User-Type');
        // base::recordAction( $getname, $getusertype,'Category Maintenance', 'Add Category Successfully');
        // return redirect('maintenance-category')->with('success', 'Category Saved');
         return redirect('employee-forum')->with('success', 'Forum Deleted Successfully');
        
    }

    //Add Comment By Employee
    public function AddCommentByEmployee(Request $request)
    {
        $comment = new Comment();
        $validatecomment =  Comment::where('comment_body','=', $request->input('comment_body'))->first();
        if($validatecomment)
        {
            return back()->with('danger', 'Comment Already Exist');
        }
        else
        {
            $comment->parent_id = $request->input('parent_id');
            $comment->comment_body = $request->input('comment_body');
            $comment->user_id = Session::get('LoggedUser');
            $comment->save();
        // $getname = Session::get('Name');
        // $getusertype = Session::get('User-Type');
        // base::recordAction( $getname, $getusertype,'Category Maintenance', 'Add Category Successfully');
        // return redirect('maintenance-category')->with('success', 'Category Saved');
         return back()->with('success', 'Comment Posted');
        }
    }
}
