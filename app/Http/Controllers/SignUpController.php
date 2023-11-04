<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Login;
use App\Models\Room;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class SignUpController extends Controller
{
    public function index(){
        $users4 = Room::orderBy('id', 'ASC')->where('vacantnumber', '!=', 0)->where('status', '!=', 0)->get();
        return view('signup')->with('users4',$users4);
    }
}
