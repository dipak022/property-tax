<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Questions;
use Illuminate\Support\Str;
use DB;
class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions=Questions::orderBy('id','DESC')->get(); 
        return view('backend.superadmin.question.manage',compact('questions'));
    }
    public function QuestionStatus(Request $request){
        //dd($request->all());
        if($request->mode == 'true'){
            $status = DB::table('questions')->where('id',$request->id)->update(['active'=>1]);
        }else{
            $status = DB::table('questions')->where('id',$request->id)->update(['active'=>0]);
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
        $questions = new Questions(); 
        $questions->question = $request->question;
        $questions->answer = $request->answer;
        $questions->active = $request->active;
        $done = $questions->save();

        if ($done) {
            $notification = array(
                'message' => 'Questions Added Successfully.',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        }else{
            $notification = array(
                'message' => 'Questions Added Unuccessfully',
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
        $questions = Questions::find($id);
        if($questions){
            $questions->question = $request->question;
            $questions->answer = $request->answer;
            $questions->active = $request->active;
            $done = $questions->save();
            if ($done) {
                $notification = array(
                    'message' => 'Questions Update Successfully.',
                    'alert-type' => 'success'
                );
                return redirect()->back()->with($notification);
            }else{
                $notification = array(
                    'message' => 'Questions Update Unuccessfully',
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
        $questions = Questions::find($id);
        if($questions){
            $status = $questions->delete();
            if ($status) {
                $notification = array(
                    'message' => 'Questions Delete Successfully.',
                    'alert-type' => 'success'
                );
                return redirect()->route('service.index')->with($notification);
            }
        }else{
            $notification = array(
                'message' => 'Questions Delete Unsuccessfully',
                'alert-type' => 'danger'
            );
            return redirect()->back()->with($notification);
        }
    }
}
