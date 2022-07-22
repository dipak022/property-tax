<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use App\Mail\OredrMail;
use Response;
use Cart;
//use Session;
//use App\Url;
use Redirect;
use URL;
use DB;
use DateTime;
class UserRegistationController extends Controller
{
    public function Registation(){
        return view('auth.reg');
    }
    public function RegistationOne(Request $request){
         //return $request->all();
        //  Session::put('reg_frist_stap',[
        //     'nid_number'=>$request->nid_number,
        // ]);
        $nid_number = $request->nid_number;
        $date_of_birth = strtotime($request->date_of_birth) ? (new DateTime($request->date_of_birth))->format('Y-m-d') : null;
        
        $nid_details=DB::table('nids')->where('nid_number',$nid_number)
            ->whereDate('date_of_birth','=', $date_of_birth)
            ->first();               

        return view('auth.reg1',compact('nid_details'));
    }
    public function RegistationTwo(Request $request){
         //return $request->all();
        //  Session::put('reg_frist_stap',[
        //     'nid_number'=>$request->nid_number,
        // ]);               

        return view('auth.reg3');
    }
    public function RegistationThree(Request $request){
        return view('auth.success');
    }
}
