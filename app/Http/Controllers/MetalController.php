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
use App\models\Metals;
use Illuminate\Contracts\Pagination\Paginator;
use App\Http\Controllers\Controller;

class MetalController extends Controller
{
    public function index(){
		$data= Metals::orderBy('id','desc')->paginate(10);
        return view('panel.metals')->with('data',$data);
    }
	
	public function create(){
        return view('panel.addmetal');
    }
	
	public function postCreate(){
		$metal =new Metals;
		$metal->metal_label=Input::get('label');
		$metal->metal_name=Input::get('name');
		if(Input::get('enable')==true){
			$metal->enable=1;
		}
		else{
			$metal->enable=0;
		}
		$metal->save();
		if($metal->save()==1){
			$msg="New Metal Added!!";	
		}
		return Redirect('metals')->with('msg',$msg);
	}
	
	public function delete($id){
		$metal =Metals::find($id)->delete();
		return Redirect('metals')->with('msg','metal deleted!!');
	}
	
	public function edit($id){
		$metal =Metals::where('id',$id)->first();
		return view('panel.editmetal')->with('metal',$metal);
	}
	
	public function postEdit(){
		$metal =Metals::where('id',Input::get('id'))->first();
		$metal->metal_label=Input::get('label');
		$metal->metal_name=Input::get('name');
		if(Input::get('enable')==true){
			$metal->enable=1;
		}
		else{
			$metal->enable=0;
		}
		$metal->save();
		if($metal->save()==1){
			$msg="Metal Detail Updated!!";	
		}
		return Redirect('metals')->with('msg',$msg);
	}

}
