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
use App\models\PaymentMethod;
use Illuminate\Contracts\Pagination\Paginator;
use App\Http\Controllers\Controller;

class PaymentmethodController extends Controller
{
    public function index(){
		$data= PaymentMethod::orderBy('id','desc')->paginate(10);
        return view('panel.payment-method')->with('data',$data);
    }
	
	public function create(){
        return view('panel.add-payment-method');
    }
	
	public function postCreate(){
		$metal =new PaymentMethod;
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
			Session::flash('msg','New Payment Method Added!!');	
		}else{
			Session::flash('msg','Somthing went wrong!!');
		}
		return Redirect('payment');
	}
	
	public function delete($id){
		if(PaymentMethod::find($id)->delete()){
		Session::flash('msg','Payment Method deleted!!');
		}else{
		Session::flash('msg','Somthing went wrong!!');
		}
		return back();
	}
	
	public function edit($id){
		$paymentmethod =PaymentMethod::find($id);
		return view('panel.edit-payment-method')->with('paymentmethod',$paymentmethod);
	}
	
	public function postEdit(){
		$metal =PaymentMethod::find(Input::get('id'));
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
			return Redirect('payment');	

 	}

}
