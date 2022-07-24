<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Models\Poperty_tax;
use Illuminate\Support\Str;
use DB;
use DateTime;
use Image;
class PopertyTexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //return $request->all();
        $image=$request->file('image');
        if($image){
            $image_upload= hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(150,150)->save('Poperty_tax/Image/'.$image_upload);
            $imgUrl ='Poperty_tax/Image/'.$image_upload;
        
            $Poperty_tax = new Poperty_tax(); 
            $Poperty_tax->image = $imgUrl; 
            $Poperty_tax->divition = $request->divition;
            $Poperty_tax->municipality = $request->municipality;
            $Poperty_tax->ward = $request->ward;
            $Poperty_tax->block = $request->block;
            $Poperty_tax->subblock = $request->subblock;
            $Poperty_tax->holding_number = $request->holding_number;
            $Poperty_tax->user_id = auth()->user()->id;
            $Poperty_tax->active = 1;
            $Poperty_tax->year = date("Y");
            $Poperty_tax->month = date("m");
            $done = $Poperty_tax->save();
        }else{
            $Poperty_tax = new Poperty_tax(); 
            $Poperty_tax->divition = $request->divition;
            $Poperty_tax->municipality = $request->municipality;
            $Poperty_tax->ward = $request->ward;
            $Poperty_tax->block = $request->block;
            $Poperty_tax->subblock = $request->subblock;
            $Poperty_tax->holding_number = $request->holding_number;
            $Poperty_tax->user_id = auth()->user()->id;
            $Poperty_tax->active = 1;
            $Poperty_tax->year = date("Y");
            $Poperty_tax->month = date("m");
            $done = $Poperty_tax->save();

        }

        if ($done) {
            $notification = array(
                'message' => 'Poperty Tax Added Successfully.',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        }else{
            $notification = array(
                'message' => 'Poperty Tax Added Unuccessfully',
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
        //
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
