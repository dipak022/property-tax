<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Ward;
use App\Models\Municipality;
use Illuminate\Support\Str;
use DB;
class WardController extends Controller
{
    public function index()
    {

        $Ward=DB::table('wards')
            ->join('municipalities','wards.municipalitie_id','municipalities.id')
            ->select('wards.*','municipalities.municipalitie_name')
            ->get();
        return view('backend.superadmin.category.ward.manage',compact('Ward'));
    }
    
    
    public function store(Request $request)
    {
        $Ward = new Ward(); 
        $Ward->municipalitie_id = $request->municipalitie_id;
        $Ward->ward = $request->ward;
        $done = $Ward->save();

        if ($done) {
            $notification = array(
                'message' => 'Ward Added Successfully.',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        }else{
            $notification = array(
                'message' => 'Ward Added Unuccessfully',
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

        $Ward = Ward::find($id);
        if($Ward){
            $Ward->municipalitie_id = $request->municipalitie_id;
            $Ward->ward = $request->ward;
            $done = $Ward->save();
            if ($done) {
                $notification = array(
                    'message' => 'Ward Update Successfully.',
                    'alert-type' => 'success'
                );
                return redirect()->back()->with($notification);
            }else{
                $notification = array(
                    'message' => 'Ward Update Unuccessfully',
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
        $Ward = Ward::find($id);
        if($Ward){
            $status = $Ward->delete();
            if ($status) {
                $notification = array(
                    'message' => 'Ward Delete Successfully.',
                    'alert-type' => 'success'
                );
                return redirect()->route('ward.index')->with($notification);
            }
        }else{
            $notification = array(
                'message' => 'Ward Delete Unsuccessfully',
                'alert-type' => 'danger'
            );
            return redirect()->back()->with($notification);
        }
    }
}
