<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Seting;
use Illuminate\Support\Str;
use DB;
class SetingController extends Controller
{
  
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $seting=Seting::first();
        return view('backend.superadmin.seting.update',compact('seting'));
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
        //
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
        $seting = Seting::find($id);
        if($seting){
            $seting->website_name = $request->website_name;
            $seting->short_desc = $request->short_desc;
            $seting->address = $request->address;
            $seting->email = $request->email;
            $seting->phone = $request->phone;
            $seting->footer = $request->footer;
            $seting->facebook_url = $request->facebook_url;
            $seting->twitter_url = $request->twitter_url;
            $seting->linkedin_url = $request->linkedin_url;
            $seting->skype_link = $request->skype_link;
            $seting->instagram_link = $request->instagram_link;
          
            $done = $seting->save();
            if ($done) {
                $notification = array(
                    'message' => 'Seting Update Successfully.',
                    'alert-type' => 'success'
                );
                return redirect()->back()->with($notification);
            }else{
                $notification = array(
                    'message' => 'Seting Update Unuccessfully',
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
