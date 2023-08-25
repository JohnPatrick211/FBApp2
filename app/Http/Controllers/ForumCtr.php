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
            ->select('BR.*', 'tbl_tenant.*','BR.id AS forum_id')
            ->leftJoin('tbl_tenant', 'BR.author_id', '=', 'tbl_tenant.tenant_id')
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
            ->select('BR.*', 'tbl_tenant.*', 'tbl_comment.*','BR.id AS forum_id')
            ->leftJoin('tbl_tenant', 'BR.author_id', '=', 'tbl_tenant.tenant_id')
            ->leftJoin('tbl_comment', 'BR.author_id', '=', 'tbl_comment.user_id')
            ->where('BR.id',$forum_id)
            ->first();

            $comment = DB::table('tbl_comment AS BR')
            ->select('BR.*', 'tbl_tenant.*', 'tbl_forum.*','BR.id AS comment_id')
            ->leftJoin('tbl_tenant', 'BR.user_id', '=', 'tbl_tenant.tenant_id')
            ->leftJoin('tbl_forum', 'BR.parent_id', '=', 'tbl_forum.author_id')
            ->where('BR.parent_id',$forum_id)
            ->get();

            //$forum = Forum::find($forum_id)->first();
            
            $data = [
                'LoggedUserInfo' => $staff,
            ];

            return view('show-forum-comment', $data)->with('forums',$forum)->with('comments',$comment);
           // return dd($comment);

    }

    public function store(Request $request)
    {
        // store code
    }
}
