<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use App\Models\Nid;
use Illuminate\Support\Str;
use DB;
use DateTime;
use Image;
class NidController extends Controller
{
    public function index()
    {
        $nids=Nid::orderBy('id','DESC')->get(); 
        return view('backend.superadmin.nid.manage',compact('nids'));
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
        $image=$request->file('image');
        if($image){
            $image_upload= hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(150,150)->save('Nid/Image/'.$image_upload);
            $imgUrl ='Nid/Image/'.$image_upload;
        }
        $Nid = new Nid(); 
        $Nid->image = $imgUrl; 
        $Nid->nid_number = $request->nid_number;
        $Nid->name = $request->name;
        $Nid->father_name = $request->father_name;
        $Nid->mother_name = $request->mother_name;
        $Nid->date_of_birth = strtotime($request->date_of_birth) ? (new DateTime($request->date_of_birth))->format('Y-m-d') : null;
        $Nid->phone = $request->phone;
        $Nid->gender = $request->gender;
        $Nid->permanent_address = $request->permanent_address;
        $done = $Nid->save();

        if ($done) {
            $notification = array(
                'message' => 'Nid Added Successfully.',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        }else{
            $notification = array(
                'message' => 'Nid Added Unuccessfully',
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
        $Nid = Nid::find($id);
        if($Nid){
            $image=$request->file('image');
            if($image){
                $image_upload= hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
                Image::make($image)->resize(150,150)->save('Nid/Image/'.$image_upload);
                $imgUrl ='Nid/Image/'.$image_upload;

                $Nid->image = $imgUrl; 
                $Nid->name = $request->name;
                $Nid->father_name = $request->father_name;
                $Nid->mother_name = $request->mother_name;
                $Nid->phone = $request->phone;
                $Nid->gender = $request->gender;
                $Nid->permanent_address = $request->permanent_address;
                $done = $Nid->save();
                if ($done) {
                    $notification = array(
                        'message' => 'Nid Update Successfully.',
                        'alert-type' => 'success'
                    );
                    return redirect()->back()->with($notification);
                }else{
                    $notification = array(
                        'message' => 'Nid Update Unuccessfully',
                        'alert-type' => 'danger'
                    );
                    return redirect()->back()->with($notification);
                }
            }else{
                $Nid->name = $request->name;
                $Nid->father_name = $request->father_name;
                $Nid->mother_name = $request->mother_name;
                $Nid->phone = $request->phone;
                $Nid->gender = $request->gender;
                $Nid->permanent_address = $request->permanent_address;
                $done = $Nid->save();
                if ($done) {
                    $notification = array(
                        'message' => 'Nid Update Successfully.',
                        'alert-type' => 'success'
                    );
                    return redirect()->back()->with($notification);
                }else{
                    $notification = array(
                        'message' => 'Nid Update Unuccessfully',
                        'alert-type' => 'danger'
                    );
                    return redirect()->back()->with($notification);
                }
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
        $Nid = Nid::find($id);
        if($Nid){
            $status = $Nid->delete();
            if ($status) {
                $notification = array(
                    'message' => 'Nid Delete Successfully.',
                    'alert-type' => 'success'
                );
                return redirect()->route('nid.index')->with($notification);
            }
        }else{
            $notification = array(
                'message' => 'Nid Delete Unsuccessfully',
                'alert-type' => 'danger'
            );
            return redirect()->back()->with($notification);
        }
    }
}
