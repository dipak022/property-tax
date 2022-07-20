<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Seting;
use App\Models\Problem;
use Illuminate\Support\Str;
use DB;
class AdminController extends Controller
{
    
    
       public function __construct()
       {
           $this->middleware('auth');
       }
       function index(){
       return view('backend.admin.index');
       }
       public function show(){
        $problems=Problem::where('officer_id',2)->orderBy('id','DESC')->get(); 
        return view('backend.admin.problem.manage',compact('problems'));
        }

        public function EquipmentUpdate(Request $request, $id){
            $problem = Problem::find($id);
            if($problem){
                $problem->equipment_details = $request->equipment_details;
                $problem->status = 5;
                $done = $problem->save();
                if ($done) {
                    $notification = array(
                        'message' => 'Equipment Assign  Successfully.',
                        'alert-type' => 'success'
                    );
                    return redirect()->back()->with($notification);
                }else{
                    $notification = array(
                        'message' => 'Equipment Assign Unuccessfully',
                        'alert-type' => 'danger'
                    );
                    return redirect()->back()->with($notification);
                }
            }

        }
}
