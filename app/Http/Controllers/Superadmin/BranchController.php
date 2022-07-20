<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Branch;
use Illuminate\Support\Str;
use DB;
class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $branchs=Branch::orderBy('id','DESC')->get(); 
        return view('backend.superadmin.setup.branch.manage',compact('branchs'));
    }
    
    public function BranchStatus(Request $request){
        //dd($request->all());
        if($request->mode == 'true'){
            $status = DB::table('branches')->where('id',$request->id)->update(['active'=>1]);
        }else{
            $status = DB::table('branches')->where('id',$request->id)->update(['active'=>0]);
        }
        if ($status) {
            $notification = array(
                'message' => 'Branch Delete Successfully.',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        }
        else{
            $notification = array(
                'message' => 'Status Change Unuccessfully',
                'alert-type' => 'danger'
            );
            return redirect()->back()->with($notification);
        } 
        
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
        $branch = new Branch(); 
        $branch->branch_name = $request->branch_name;
        $branch->active = $request->active;
        $done = $branch->save();

        if ($done) {
            $notification = array(
                'message' => 'Branch Added Successfully.',
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
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
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

        $branch = Branch::find($id);
        if($branch){
            $branch->branch_name = $request->branch_name;
            $branch->active = $request->active;
            $done = $branch->save();
            if ($done) {
                $notification = array(
                    'message' => 'Branch Update Successfully.',
                    'alert-type' => 'success'
                );
                return redirect()->back()->with($notification);
            }else{
                $notification = array(
                    'message' => 'Branch Update Unuccessfully',
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
        $branch = Branch::find($id);
        if($branch){
            $status = $branch->delete();
            if ($status) {
                $notification = array(
                    'message' => 'Branch Delete Successfully.',
                    'alert-type' => 'success'
                );
                return redirect()->route('branch.index')->with($notification);
            }
        }else{
            $notification = array(
                'message' => 'Branch Delete Unsuccessfully',
                'alert-type' => 'danger'
            );
            return redirect()->back()->with($notification);
        }
    }
}
