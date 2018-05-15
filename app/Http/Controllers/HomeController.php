<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use URL;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $totalEmp = DB::table('employees')->count();
        $totalUser = DB::table('users')->count();
        $countings = array('totalEmployees'=>$totalEmp,'totalUsers'=>$totalUser);

        return view('dashboard')->with('info',$countings);;
    }

    public function getLoggedUser(){
        $date = new DateTime();


        $loggedin_users = DB::table('users')
            ->leftjoin('sessions', 'sessions.user_id', '=', 'users.id')
            ->select('users.id', 'users.name')
            ->where('user_id','<>',Auth::user()->id)
            //->where('last_activity >', $timestamp) //This condition is needed only if lifetime is set and expire_on_close is false
            ->get();
        $loggedin_instances = json_encode(json_decode($loggedin_users));
        $html = '';$success = false;
        if(count($loggedin_instances)){
            $success = true;
            $html = view('onlineusers',compact('loggedin_users'))->render();
        }
        return response()->json(['available' => $success,'viewHtml' => $html]);
    }


}
