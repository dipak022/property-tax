<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Service;
use DB;
class UserAcountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users=DB::table('users')->where('role',3)->get();
        return view('backend.superadmin.user.manage',compact('users'));
    }

    public function TechnicianAcountStatus(Request $request){
        //dd($request->all());
        if($request->mode == 'true'){
            $status = DB::table('users')->where('id',$request->id)->update(['active'=>1]);
        }else{
            $status = DB::table('users')->where('id',$request->id)->update(['active'=>0]);
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
        $tachnician = new User(); 
        $tachnician->name = $request->name;
        $tachnician->email = $request->email;
        $tachnician->type = $request->type;
        $tachnician->phone = $request->phone;
        $tachnician->password = Hash::make($request->password);
        $tachnician->active = 1;
        $tachnician->role = 4;
        $done = $tachnician->save();

        if ($done) {
            $notification = array(
                'message' => 'Tachnician Added Successfully.',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        }else{
            $notification = array(
                'message' => 'Tachnician Added Unuccessfully',
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
        $tachnician = User::find($id);
        if($tachnician){
            $tachnician->name = $request->name;
            $tachnician->active = $request->active;
            $tachnician->phone = $request->phone;
            $tachnician->role = 4;
            $done = $tachnician->save();
            if ($done) {
                $notification = array(
                    'message' => 'Tachnician Update Successfully.',
                    'alert-type' => 'success'
                );
                return redirect()->back()->with($notification);
            }else{
                $notification = array(
                    'message' => 'Tachnician Update Unuccessfully',
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
        $user = User::find($id);
        if($user){
            $status = $user->delete();
            if ($status) {
                $notification = array(
                    'message' => 'User Account Delete Successfully.',
                    'alert-type' => 'success'
                );
                return redirect()->route('user_account.index')->with($notification);
            }
        }else{
            $notification = array(
                'message' => 'User Delete Unsuccessfully',
                'alert-type' => 'danger'
            );
            return redirect()->back()->with($notification);
        }
    }
}
