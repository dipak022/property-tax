<?php

namespace App\Http\Controllers\Tachnician;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Seting;
use App\Models\Problem;
use Illuminate\Support\Str;
use DB;
class TachnicianController extends Controller
{
        public function __construct()
       {
           $this->middleware('auth');
       }

       function index(){
       return view('backend.tachnician.index');
       }

       public function show(){
        $problems=Problem::orderBy('id','DESC')->get(); 
        return view('backend.tachnician.problem.manage',compact('problems'));
        }

        public function OfficerUpdate(Request $request, $id){
            $problem = Problem::find($id);
            if($problem){
                $problem->officer_id = $request->officer_id;
                $problem->officer_details = $request->officer_details;
                $problem->status = 4;
                $done = $problem->save();
                if ($done) {
                    $notification = array(
                        'message' => 'Officer Assign  Successfully.',
                        'alert-type' => 'success'
                    );
                    return redirect()->back()->with($notification);
                }else{
                    $notification = array(
                        'message' => 'Officer Assign Unuccessfully',
                        'alert-type' => 'danger'
                    );
                    return redirect()->back()->with($notification);
                }
            }

        }

        public function SolveUpdate(Request $request, $id){
            $problem = Problem::find($id);
            if($problem){
                $problem->solve_note = $request->solve_note;
                $problem->status = 3;
                $done = $problem->save();
                if ($done) {
                    $notification = array(
                        'message' => 'Problem Solve Successfully.',
                        'alert-type' => 'success'
                    );
                    return redirect()->back()->with($notification);
                }else{
                    $notification = array(
                        'message' => 'Problem Solve Unuccessfully',
                        'alert-type' => 'danger'
                    );
                    return redirect()->back()->with($notification);
                }
            }

        }
       
}
