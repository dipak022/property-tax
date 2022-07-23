<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
class SelectCategoryController extends Controller
{
    public function getMunicipality(Request $request){
		$cid=$request->post('cid');
		$municipalitie=DB::table('municipalities')->where('district_id',$cid)->orderBy('id','asc')->get();
		$html='<option value="">Select Municipalitie</option>';
		foreach($municipalitie as $list){
			$html.='<option value="'.$list->municipalitie_name.'">'.$list->municipalitie_name	.'</option>';
		}
		echo $html;
	}
	
	public function getWard(Request $request){
		$wid=$request->post('wid');
		$ward=DB::table('wards')->where('municipalitie_id',$wid)->orderBy('id','asc')->get();
		$html='<option value="">Select ward</option>';
		foreach($ward as $list){
			$html.='<option value="'.$list->ward.'">'.$list->ward.'</option>';
		}
		echo $html;
	}

	public function getBlock(Request $request){
		$bid=$request->post('bid');
		$block=DB::table('blocks')->where('ward_id',$bid)->orderBy('id','asc')->get();
		$html='<option value="">Select Block</option>';
		foreach($block as $list){
			$html.='<option value="'.$list->block_name.'">'.$list->block_name.'</option>';
		}
		echo $html;
	}

	public function getSubBlock(Request $request){
		$sbid=$request->post('sbid');
		$subblock=DB::table('subblocks')->where('block_id',$sbid)->orderBy('id','asc')->get();
		$html='<option value="">Select Subblock</option>';
		foreach($subblock as $list){
			$html.='<option value="'.$list->subblock_name.'">'.$list->subblock_name.'</option>';
		}
		echo $html;
	}
}
