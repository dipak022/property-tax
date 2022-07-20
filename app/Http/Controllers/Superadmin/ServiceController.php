<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Service;
use Illuminate\Support\Str;
use DB;
class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services=Service::orderBy('id','DESC')->get(); 
        return view('backend.superadmin.service.manage',compact('services'));
    }

    public function ServiceStatus(Request $request){
        //dd($request->all());
        if($request->mode == 'true'){
            $status = DB::table('services')->where('id',$request->id)->update(['active'=>1]);
        }else{
            $status = DB::table('services')->where('id',$request->id)->update(['active'=>0]);
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
        $service = new Service(); 
        $service->service_name = $request->name;
        $service->description = $request->description;
        $service->active = $request->active;
        $done = $service->save();

        if ($done) {
            $notification = array(
                'message' => 'Service Added Successfully.',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        }else{
            $notification = array(
                'message' => 'Service Added Unuccessfully',
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
        $service = Service::find($id);
        if($service){
            $service->service_name = $request->name;
            $service->description = $request->description;
            $service->active = $request->active;
            $done = $service->save();
            if ($done) {
                $notification = array(
                    'message' => 'Service Update Successfully.',
                    'alert-type' => 'success'
                );
                return redirect()->back()->with($notification);
            }else{
                $notification = array(
                    'message' => 'Service Update Unuccessfully',
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
        $service = Service::find($id);
        if($service){
            $status = $service->delete();
            if ($status) {
                $notification = array(
                    'message' => 'Service Delete Successfully.',
                    'alert-type' => 'success'
                );
                return redirect()->route('service.index')->with($notification);
            }
        }else{
            $notification = array(
                'message' => 'Service Delete Unsuccessfully',
                'alert-type' => 'danger'
            );
            return redirect()->back()->with($notification);
        }
    }
}
