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
use App\Models\User;

class UserRegistationController extends Controller
{
    public function Registation(){
        return view('auth.reg');
    }
    public function RegistationOne(Request $request){
         //return $request->all();

        $nid_number = $request->nid_number;
        $date_of_birth = strtotime($request->date_of_birth) ? (new DateTime($request->date_of_birth))->format('Y-m-d') : null;
        $nid_details=DB::table('nids')->where('nid_number',$nid_number)
            ->whereDate('date_of_birth','=', $date_of_birth)
            ->first();               

        return view('auth.reg1',compact('nid_details'));
    }
    public function RegistationTwo(Request $request){
         //return $request->all();
         Session::put('registation',[
            'name'=>$request->name,
            'nid_number'=>$request->nid_number,
            'father_name'=>$request->father_name,
            'mother_name'=>$request->mother_name,
            'date_of_birth'=>strtotime($request->date_of_birth) ? (new DateTime($request->date_of_birth))->format('Y-m-d') : null,
            'gender'=>$request->gender,
            'permanent_address'=>$request->permanent_address,
            'image'=>$request->image,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'current_address'=>$request->current_address,
            'password'=>$request->password,
        ]);
        return view('auth.reg3');
    }
    public function RegistationThree(Request $request){
        Session::push('registation',[
            'email'=>$request->email,
            'phone'=>$request->phone,
            'current_address'=>$request->current_address,
            'password'=>Hash::make($request->password),
        ]);
        $nid_number = Session::get('registation')['nid_number'];
        $date_of_birth = Session::get('registation')['date_of_birth'];
        $nid_details=DB::table('nids')->where('nid_number',$nid_number)
            ->whereDate('date_of_birth','=', $date_of_birth)
            ->first();               
        return view('auth.reg4',compact('nid_details'));
    }
    public function ConfirmRegistation(){
        //return Session::get('registation');
        $user = new User();
        // $user['name'] =Session::get('registation')[0]['name'];
        // $user['nid_number'] =Session::get('registation')[0]['nid_number'];
        // $user['father_name'] =Session::get('registation')[0]['father_name'];
        // $user['mother_name'] =Session::get('registation')[0]['mother_name'];
        // $user['date_of_birth'] =Session::get('registation')[0]['date_of_birth'];
        // $user['gender'] =Session::get('registation')[0]['gender'];
        // $user['permanent_address'] =Session::get('registation')[0]['permanent_address'];
        // $user['image'] =Session::get('registation')[0]['image'];
        // $user['email'] =Session::get('registation')[1]['email'];
        // $user['phone'] =Session::get('registation')[1]['phone'];
        // $user['current_address'] =Session::get('registation')[1]['current_address'];
        // $user['password'] =Session::get('registation')[1]['password'];


        $user['name'] =Session::get('registation')['name'];
        $user['nid_number'] =Session::get('registation')['nid_number'];
        $user['father_name'] =Session::get('registation')['father_name'];
        $user['mother_name'] =Session::get('registation')['mother_name'];
        $user['date_of_birth'] =Session::get('registation')['date_of_birth'];
        $user['gender'] =Session::get('registation')['gender'];
        $user['permanent_address'] =Session::get('registation')['permanent_address'];
        $user['image'] =Session::get('registation')['image'];
        $user['email'] =Session::get('registation')[0]['email'];
        $user['phone'] =Session::get('registation')[0]['phone'];
        $user['current_address'] =Session::get('registation')[0]['current_address'];
        $user['password'] =Session::get('registation')[0]['password'];
        $user['role'] =3;
        //dd($user);
        $status = $user->save();
        if($status){
             Session::forget('registation');
             $notification = array(
                 'message' => 'Registation Complete Successfully',
                 'alert-type' => 'success'
             );
             return view('auth.success');
         }else{
             $notification = array(
                 'message' => 'Order Complete Unsuccessfully',
                 'alert-type' => 'error'
             );
             return redirect()->route('reg')->with($notification);
         }
    }
}
