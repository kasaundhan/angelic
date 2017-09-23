<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Input;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Auth;
use Admin;
use DB;
use Hash; 
use Session; 
use Redirect;
use App\models\Ringsize;
use Illuminate\Contracts\Pagination\Paginator;
use App\Http\Controllers\Controller;

class RingsizeController extends Controller
{
    public function index(){
		$data= Ringsize::orderBy('id','desc')->paginate(10);
        return view('panel.ringsize')->with('data',$data);
    }
	
	public function create(){
        return view('panel.addringsize');
    }
	
	public function postCreate(){
		$ringsize =new Ringsize;
		$ringsize->ring_size_label=Input::get('label');
		$ringsize->ring_size_name=Input::get('name');
		if(Input::get('enable')==true){
			$ringsize->enable=1;
		}
		else{
			$ringsize->enable=0;
		}
		$ringsize->save();
		if($ringsize->save()==1){
			$msg="New Ring Size Added!!";	
		}
		return Redirect('ringsize')->with('msg',$msg);
	}
	
	public function delete($id){
		$ringsize =Ringsize::find($id)->delete();
		return Redirect('ringsize')->with('msg','Ring Size deleted!!');
	}
	
	public function edit($id){
		$data =Ringsize::where('id',$id)->first();
		return view('panel.editringsize')->with('data',$data);
	}
	
	public function postEdit(){
		$ringsize =Ringsize::where('id',Input::get('id'))->first();
		$ringsize->ring_size_label=Input::get('label');
		$ringsize->ring_size_name=Input::get('name');
		if(Input::get('enable')==true){
			$ringsize->enable=1;
		}
		else{
			$ringsize->enable=0;
		}
		$ringsize->save();
		if($ringsize->save()==1){
			$msg="Ring Size Detail Updated!!";	
		}
		return Redirect('ringsize')->with('msg',$msg);
	}

}
