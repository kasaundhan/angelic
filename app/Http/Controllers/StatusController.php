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
use App\models\Status;
use Illuminate\Contracts\Pagination\Paginator;
use App\Http\Controllers\Controller;

class StatusController extends Controller
{
    public function index(){
		$data= Status::orderBy('id','desc')->paginate(10);
        return view('panel.status')->with('data',$data);
    }
	
	public function create(){
        return view('panel.add-status');
    }
	
	public function postCreate(){
		$metal =new Status;
		$metal->status_label=Input::get('label');
		$metal->status_name=Input::get('name');
		if(Input::has('enable')){
			$metal->enable=1;
		}
		else{
			$metal->enable=0;
		}
		$metal->save();
		if($metal->save()){
			Session::flash('msg','New Status Added!!');	
		}else{
			Session::flash('msg','Somthing went wrong!!');
		}
		return Redirect('status');
	}
	
	public function delete($id){
		if(Status::find($id)->delete()){
		Session::flash('msg','Status deleted!!');
		}else{
		Session::flash('msg','Somthing went wrong!!');
		}
		return back();
	}
	
	public function edit($id){
		$status =Status::find($id);
		return view('panel.edit-status')->with('status',$status);
	}
	
	public function postEdit(){
		$status =Status::find(Input::get('id'));
		$status->status_label=Input::get('label');
		$status->status_name=Input::get('name');
		if(Input::has('enable')){
			$status->enable=1;
		}
		else{
			$status->enable=0;
		}
		$status->save();
		if($status->save()){
			Session::flash('msg','Status Updated!!');
		}else{
			Session::flash('msg','Somthing went wrong!!');
		}
			return Redirect('status');	

 	}

}
