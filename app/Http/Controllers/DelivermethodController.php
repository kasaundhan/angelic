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
use App\models\DeliveryMethod;
use Illuminate\Contracts\Pagination\Paginator;
use App\Http\Controllers\Controller;

class DelivermethodController extends Controller
{
    public function index(){
		$data= DeliveryMethod::orderBy('id','desc')->paginate(10);
        return view('panel.delivery-method')->with('data',$data);
    }
	
	public function create(){
        return view('panel.add-delivery-method');
    }
	
	public function postCreate(){
		$metal =new DeliveryMethod;
		$metal->label=Input::get('label');
		$metal->name=Input::get('name');
		if(Input::has('enable')){
			$metal->enable=1;
		}
		else{
			$metal->enable=0;
		}
		$metal->save();
		if($metal->save()){
			Session::flash('msg','New Delivery Method Added!!');	
		}else{
			Session::flash('msg','Somthing went wrong!!');
		}
		return Redirect('delivery');
	}
	
	public function delete($id){
		if(DeliveryMethod::find($id)->delete()){
		Session::flash('msg','Delivery Method deleted!!');
		}else{
		Session::flash('msg','Somthing went wrong!!');
		}
		return back();
	}
	
	public function edit($id){
		$deliverymethod =DeliveryMethod::find($id);
		return view('panel.edit-delivery-method')->with('deliverymethod',$deliverymethod);
	}
	
	public function postEdit(){
		$metal =DeliveryMethod::find(Input::get('id'));
		$metal->label=Input::get('label');
		$metal->name=Input::get('name');
		if(Input::has('enable')){
			$metal->enable=1;
		}
		else{
			$metal->enable=0;
		}
		$metal->save();
		if($metal->save()){
			Session::flash('msg','Delivery Method Updated!!');
		}else{
			Session::flash('msg','Somthing went wrong!!');
		}
			return Redirect('delivery');	

 	}

}
