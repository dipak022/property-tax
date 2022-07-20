<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SuperadminController extends Controller 
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    function index(){
    return view('backend.superadmin.index');
    }
    function profile(){
        return view('dashboards.admins.profile');
    }
    function settings(){
        return view('dashboards.admins.settings');
    }
}
