<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use App\Models\Problem;
use Illuminate\Support\Str;
use DB;
use Auth;

use Gate;
use App\User;
use App\Course;
use Illuminate\Support\Facades\Input;
use Response;

use Session;
class UserController extends Controller
{
    public function __construct()
       {
           $this->middleware('auth');
       }
       function index(){
       return view('frontend.index');
       }

       public function profile(){
        $problems=Problem::where('user_id',auth()->user()->id)->orderBy('id','DESC')->get(); 
        return view('frontend.profile',compact('problems'));
       }

       public function Store(Request $request){

        if(Auth::check()){
            

            $problem = new Problem(); 
            $problem->name = $request->name;
            $problem->user_id = auth()->user()->id;
            $problem->email = $request->email;
            $problem->phone = $request->phone;
            $problem->problem_title = $request->problem_title;
            $problem->problem_details = $request->problem_details;
            $problem->room_number = $request->room_number;
            $problem->floor_number = $request->floor_number;
            $problem->equipment_number = $request->equipment_number;
            $problem->status = 1;
            $problem->service_id = $request->service_id;
            
            $done = $problem->save();

            if ($done) {
                $notification = array(
                    'message' => 'About Us Added Successfully.',
                    'alert-type' => 'success'
                );
                return redirect()->back()->with($notification);
            }else{
                $notification = array(
                    'message' => 'Branch Added Unuccessfully',
                    'alert-type' => 'danger'
                );
                return redirect()->back()->with($notification);
            }

        }else{
            
            $notification = array(
                'message' => 'AT first login your account',
                'alert-type' => 'warning'
            );
            return redirect()->route('login')->with($notification);
        }
        
       }


       public function delete($id)
       {
           $problem = Problem::find($id);
           if($problem){
               $status = $problem->delete();
               if ($status) {
                   $notification = array(
                       'message' => 'problem Delete Successfully.',
                       'alert-type' => 'success'
                   );
                   return redirect()->back()->with($notification);
               }
           }else{
               $notification = array(
                   'message' => 'problem Delete Unsuccessfully',
                   'alert-type' => 'danger'
               );
               return redirect()->back()->with($notification);
           }
       }

       
}
