<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


//
use App\Models\Ward;
use App\Models\Block;
use Illuminate\Support\Str;
use DB;
class BlockController extends Controller
{
    public function index()
    {

        $Block=DB::table('blocks')
            ->join('wards','blocks.ward_id','wards.id')
            ->select('blocks.*','wards.ward')
            ->get();
        return view('backend.superadmin.category.block.manage',compact('Block'));
    }
    
    
    public function store(Request $request)
    {
        $Block = new Block(); 
        $Block->ward_id = $request->ward_id;
        $Block->block_name = $request->block_name;
        $done = $Block->save();

        if ($done) {
            $notification = array(
                'message' => 'Block Added Successfully.',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        }else{
            $notification = array(
                'message' => 'Block Added Unuccessfully',
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

        $Block = Block::find($id);
        if($Block){
            $Block->ward_id = $request->ward_id;
            $Block->block_name = $request->block_name;
            $done = $Block->save();
            if ($done) {
                $notification = array(
                    'message' => 'Block Update Successfully.',
                    'alert-type' => 'success'
                );
                return redirect()->back()->with($notification);
            }else{
                $notification = array(
                    'message' => 'Block Update Unuccessfully',
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
        $Block = Block::find($id);
        if($Block){
            $status = $Block->delete();
            if ($status) {
                $notification = array(
                    'message' => 'Block Delete Successfully.',
                    'alert-type' => 'success'
                );
                return redirect()->route('block.index')->with($notification);
            }
        }else{
            $notification = array(
                'message' => 'Block Delete Unsuccessfully',
                'alert-type' => 'danger'
            );
            return redirect()->back()->with($notification);
        }
    }
}
