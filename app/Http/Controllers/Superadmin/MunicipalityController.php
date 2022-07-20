<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

//Municipality

use App\Models\District;
use App\Models\Municipality;
use Illuminate\Support\Str;
use DB;
class MunicipalityController extends Controller
{
    public function index()
    {
        $Municipality=Municipality::orderBy('id','DESC')->get(); 
        $Municipality=DB::table('municipalities')
            ->join('districts','municipalities.district_id','districts.id')
            ->select('municipalities.*','districts.district_name')
            ->get();
        return view('backend.superadmin.category.municipality.manage',compact('Municipality'));
    }
    
    
    public function store(Request $request)
    {
        $Municipality = new Municipality(); 
        $Municipality->district_id = $request->district_id;
        $Municipality->municipalitie_name = $request->municipalitie_name;
        $done = $Municipality->save();

        if ($done) {
            $notification = array(
                'message' => 'Municipality Added Successfully.',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        }else{
            $notification = array(
                'message' => 'Municipality Added Unuccessfully',
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

        $Municipality = Municipality::find($id);
        if($Municipality){
            $Municipality->district_id = $request->district_id;
            $Municipality->municipalitie_name = $request->municipalitie_name;
            $done = $Municipality->save();
            if ($done) {
                $notification = array(
                    'message' => 'Municipality Update Successfully.',
                    'alert-type' => 'success'
                );
                return redirect()->back()->with($notification);
            }else{
                $notification = array(
                    'message' => 'Municipality Update Unuccessfully',
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
        $Municipality = Municipality::find($id);
        if($Municipality){
            $status = $Municipality->delete();
            if ($status) {
                $notification = array(
                    'message' => 'Municipality Delete Successfully.',
                    'alert-type' => 'success'
                );
                return redirect()->route('municipality.index')->with($notification);
            }
        }else{
            $notification = array(
                'message' => 'Municipality Delete Unsuccessfully',
                'alert-type' => 'danger'
            );
            return redirect()->back()->with($notification);
        }
    }
}
