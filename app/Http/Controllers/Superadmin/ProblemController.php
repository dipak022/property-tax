<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Problem;
use Illuminate\Support\Str;
use DB;
use Auth;
class ProblemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $problems=Problem::orderBy('id','DESC')->get(); 
        return view('backend.superadmin.problem.manage',compact('problems'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        return "Dipak Debnath";
        dd("Dipak Debnath");

        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $problem = new Problem(); 
        $problem->name = $request->name;
        //$problem->user_id = $request->auth()->user()->id;
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
                'message' => 'Problem Send Added Successfully.',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        }else{
            $notification = array(
                'message' => 'Problem Send Added Unuccessfully',
                'alert-type' => 'danger'
            );
            return redirect()->back()->with($notification);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $problem = Problem::find($id);
        if($problem){
            $problem->tachnician_id = $request->tachnician_id;
            $problem->tachnician_details = $request->tachnician_details;
            $problem->status = 2;
            $done = $problem->save();
            if ($done) {
                $notification = array(
                    'message' => 'Tachnician Assign  Successfully.',
                    'alert-type' => 'success'
                );
                return redirect()->back()->with($notification);
            }else{
                $notification = array(
                    'message' => 'Tachnician Assign Unuccessfully',
                    'alert-type' => 'danger'
                );
                return redirect()->back()->with($notification);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
