<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\About;
use Illuminate\Support\Str;
use DB;
class AboutContrioler extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $abouts=About::orderBy('id','DESC')->get(); 
        return view('backend.superadmin.aboutus.manage',compact('abouts'));
    }

    public function AboutUsStatus(Request $request){
        //dd($request->all());
        if($request->mode == 'true'){
            $status = DB::table('abouts')->where('id',$request->id)->update(['active'=>1]);
        }else{
            $status = DB::table('abouts')->where('id',$request->id)->update(['active'=>0]);
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
        $about = new About(); 
        $about->details = $request->details;
        $about->active = $request->active;
        $done = $about->save();

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
        $about = About::find($id);
        if($about){
            $about->details = $request->details;
            $about->active = $request->active;
            $done = $about->save();
            if ($done) {
                $notification = array(
                    'message' => 'About Us Update Successfully.',
                    'alert-type' => 'success'
                );
                return redirect()->back()->with($notification);
            }else{
                $notification = array(
                    'message' => 'About Us Update Unuccessfully',
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
        $about = About::find($id);
        if($about){
            $status = $about->delete();
            if ($status) {
                $notification = array(
                    'message' => 'About Us Delete Successfully.',
                    'alert-type' => 'success'
                );
                return redirect()->route('about_us.index')->with($notification);
            }
        }else{
            $notification = array(
                'message' => 'About Us Delete Unsuccessfully',
                'alert-type' => 'danger'
            );
            return redirect()->back()->with($notification);
        }
    }
}
