<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;
use Illuminate\Support\Str;
use DB;
class BannerController extends Controller
{
    public function index()
    {
        $banners=Banner::orderBy('id','DESC')->get(); 
        return view('backend.superadmin.banner.manage',compact('banners'));
    }

    public function BannerStatus(Request $request){
        //dd($request->all());
        if($request->mode == 'true'){
            $status = DB::table('banners')->where('id',$request->id)->update(['active'=>1]);
        }else{
            $status = DB::table('banners')->where('id',$request->id)->update(['active'=>0]);
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
        $imageName = $request->file('image');
        $image = $imageName->getClientOriginalName();
        $directory = 'images/banner/';
        $imgUrl = $directory.$image;
        $imageName->move($directory,$image);



        $banner = new Banner();
        $banner->title = $request->title;
        $banner->description = $request->description;
        $banner->image = $imgUrl;
        $banner->active = $request->active;
        $done = $banner->save();

        if ($done) {
            $notification = array(
                'message' => 'Banner Added Successfully.',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        }else{
            $notification = array(
                'message' => 'Banner Added Unuccessfully',
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
        $check_image= $request->file('image');
        if($check_image){
            $oldImage = $request->oldimage;
            if(file_exists($oldImage)){
                unlink($oldImage);
            }
            $banner = Banner::find($id);
            $imageName = $request->file('image');
            $image = $imageName->getClientOriginalName();
            $directory = 'images/banner/';
            $imgUrl = $directory.$image;
            $imageName->move($directory,$image);


            $banner->title = $request->title;
            $banner->description = $request->description;
            $banner->active = $request->active;
            $banner->image = $imgUrl;
            $done = $banner->save();
            

        }else{
            $banner = Banner::find($id);
            $banner->title = $request->title;
            $banner->description = $request->description;
            $banner->active = $request->active;
            $done = $banner->save();

        }
        


        if ($done) {
            $notification = array(
                'message' => 'Banner Update Successfully.',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        }else{
            $notification = array(
                'message' => 'Banner Update Unuccessfully',
                'alert-type' => 'danger'
            );
            return redirect()->back()->with($notification);
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
        $banner = Banner::find($id);
        $done = $banner->delete();
        if ($done) {
            $notification = array(
                'message' => 'Banner Delete Successfully.',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        }else{
            $notification = array(
                'message' => 'Banner Delete Unuccessfully',
                'alert-type' => 'danger'
            );
            return redirect()->back()->with($notification);
        }
    }
}
