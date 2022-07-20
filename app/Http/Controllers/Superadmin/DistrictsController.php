<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use App\Models\District;
use Illuminate\Support\Str;
use DB;
class DistrictsController extends Controller
{
    public function index()
    {
        $District=District::orderBy('id','DESC')->get(); 
        return view('backend.superadmin.category.district.manage',compact('District'));
    }
    
    
    public function store(Request $request)
    {
        $District = new District(); 
        $District->district_name = $request->district_name;
        $done = $District->save();

        if ($done) {
            $notification = array(
                'message' => 'District Added Successfully.',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        }else{
            $notification = array(
                'message' => 'District Added Unuccessfully',
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

        $District = District::find($id);
        if($District){
            $District->district_name = $request->district_name;
            $done = $District->save();
            if ($done) {
                $notification = array(
                    'message' => 'District Update Successfully.',
                    'alert-type' => 'success'
                );
                return redirect()->back()->with($notification);
            }else{
                $notification = array(
                    'message' => 'District Update Unuccessfully',
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
        $District = District::find($id);
        if($District){
            $status = $District->delete();
            if ($status) {
                $notification = array(
                    'message' => 'District Delete Successfully.',
                    'alert-type' => 'success'
                );
                return redirect()->route('district.index')->with($notification);
            }
        }else{
            $notification = array(
                'message' => 'District Delete Unsuccessfully',
                'alert-type' => 'danger'
            );
            return redirect()->back()->with($notification);
        }
    }
}
