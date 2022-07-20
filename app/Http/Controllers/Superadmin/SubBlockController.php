<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


//
use App\Models\Subblock;
use App\Models\Block;
use Illuminate\Support\Str;
use DB;
class SubBlockController extends Controller
{
    public function index()
    {

        $Subblock=DB::table('subblocks')
            ->join('blocks','subblocks.block_id','blocks.id')
            ->select('subblocks.*','blocks.block_name')
            ->get();
        return view('backend.superadmin.category.subblock.manage',compact('Subblock'));
    }
    
    
    public function store(Request $request)
    {
        $Subblock = new Subblock(); 
        $Subblock->block_id = $request->block_id;
        $Subblock->subblock_name = $request->subblock_name;
        $done = $Subblock->save();

        if ($done) {
            $notification = array(
                'message' => 'Subblock Added Successfully.',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        }else{
            $notification = array(
                'message' => 'Subblock Added Unuccessfully',
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

        $Subblock = Subblock::find($id);
        if($Subblock){
            $Subblock->block_id = $request->block_id;
            $Subblock->subblock_name = $request->subblock_name;
            $done = $Subblock->save();
            if ($done) {
                $notification = array(
                    'message' => 'Subblock Update Successfully.',
                    'alert-type' => 'success'
                );
                return redirect()->back()->with($notification);
            }else{
                $notification = array(
                    'message' => 'Subblock Update Unuccessfully',
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
        $Subblock = Subblock::find($id);
        if($Subblock){
            $status = $Subblock->delete();
            if ($status) {
                $notification = array(
                    'message' => 'Subblock Delete Successfully.',
                    'alert-type' => 'success'
                );
                return redirect()->route('subblock.index')->with($notification);
            }
        }else{
            $notification = array(
                'message' => 'Subblock Delete Unsuccessfully',
                'alert-type' => 'danger'
            );
            return redirect()->back()->with($notification);
        }
    }
}
