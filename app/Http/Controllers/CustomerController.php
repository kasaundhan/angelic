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
use App\models\Customer;
use App\models\Addressbook;
use Illuminate\Contracts\Pagination\Paginator;
use App\Http\Controllers\Controller;

class CustomerController extends Controller
{
    public function index(){
		  $data= Customer::orderBy('id','desc')->paginate(1);
		  return view('panel.customers')->with('data',$data);
    	}
		
	public function filter(Request $request){
		
		$data=Customer::where(function($query){
		  if(Input::has('first')){
			  $query->where('first_name','LIKE','%'.Input::get('first').'%');
		  }
		  if(Input::has('last')){
			  $query->where('last_name','LIKE','%'.Input::get('last').'%');
		  }
		  if(Input::has('email')){
			  $query->where('email','LIKE','%'.Input::get('email').'%');
		  }
		  if(Input::has('phone')){
			  $query->where('phone','LIKE','%'.Input::get('phone').'%');
		  }
		  if(Input::has('zip')){
			$address=Addressbook::where('postcode','LIKE','%'.Input::get('zip').'%')->pluck('customer_id');
 			/*
			$adds = array();	  
			foreach($address as $addres){
				array_push($adds,$addres);					
			}*/
			$query->whereIn('id',($address));

			//$query->addressbooks->where('postcode','LIKE','%'.Input::get('zip').'%')->first();
			//->leftJoin('Addressbook', 'Addressbook.customer_id','id')
		  }
		  })->orderBy('id','desc')->paginate(1);

		  $val='';
		  $val.='<table class="table table-striped table-hover jambo_table">
	<thead>
		<tr>
        <th>Sn.</th>
			<th>Name</th>
			<th>Email</th>
			<th>Phone no.</th>
            <th>Billing Address</th>
            <th>Shipping Address</th>
            <th>Action</th>
		</tr>
	</thead>
	<tbody>';
     $i=0;
    foreach($data as $rec){
		$val.='<tr><td>'.++$i.'</td>
			<td>'.$rec->first_name.' '.$rec->last_name.'</td>
			<td>'.$rec->email.'</td>
			<td>'.$rec->phone.'</td>';
            if($result=Addressbook::where('customer_id',$rec->id)->where('is_billing','1')->first())
            {
				$val.='<td>'.$result->address.'</td>';
			}
            else{
			$val.='<td></td>';
			}
            if($result=Addressbook::where('customer_id',$rec->id)->where('is_shipping','1')->first())
            {
				$val.='<td>'.$result->address.'</td>';
			}
            else{
				$val.='<td></td>';
			}
            $val.='<td>   
          		<a class="btn btn-small btn-danger" onclick="return confirm(Are you sure you want to delete?)" href="'.url('customer/delete').'/'.$rec->id.'"><i class="fa fa-trash"></i> Delete</a>
          <a class="btn btn-small btn-info" href="'.url('customer/show').'/'.$rec->id.'">View</a>
          <a class="btn btn-small btn-success" href="'.url('customer/edit').'/'.$rec->id.'"><i class="fa fa-pencil-square-o"></i> Edit</a>
		 <a class="btn btn-small btn-primary" href="'.url('quote/add').'/'.$rec->id.'"><i class="fa fa-pencil-square-o"></i> Create Quote</a>
          </td>
		</tr>';
	}
	$val.='</tbody></table><button class="less">Previous</button><button class="more">Next</button>';
	if ($request->ajax()) {
		
		if(count($data)<=0){
  			return $notfound='<button class="less">Previous</button>No records found';
  		}
  		else{	
  			return $val;
  		}
	}
	/*if($request->query()){
	$val.=$data->appends($request->query())->links().'</div></div>';
	}
	else{*/
		
	//}
		

	return $val;
	}
	
	public function create(){
        return view('panel.createcustomer');
    }
	
	public function postCreate(){
		// DB::beginTransaction();

		//try {
			$CountCustomer= Customer::where('email',Input::get('email'))->count();	
			//echo Input::get('email') ;echo $CountCustomer;die;	
			if($CountCustomer<=0){
			$customer = new Customer;
			$customer->first_name=Input::get('firstname');
			$customer->last_name=Input::get('lastname');
			$customer->email=Input::get('email');
			$customer->phone=Input::get('phone');
			$customer->save();	
					
			if(Input::get('billing')==true){
				$addressbook =new Addressbook;
				$addressbook->is_billing=1;
				$addressbook->first_name=Input::get('b_firstname');
				$addressbook->last_name=Input::get('b_lastname');
				$addressbook->phone=Input::get('b_phone');
				$addressbook->address=Input::get('b_address');
				$addressbook->address2=Input::get('b_address2');
				$addressbook->city=Input::get('b_city');
				$addressbook->postcode=Input::get('b_postal');
				$addressbook->country=Input::get('b_country');
				$customer->addressbooks()->save($addressbook);

			}
			
			if(Input::get('shipping')==true){
				$addressbook =new Addressbook;
				$addressbook->is_shipping=1;
				$addressbook->first_name=Input::get('s_firstname');
				$addressbook->last_name=Input::get('s_lastname');
				$addressbook->phone=Input::get('s_phone');
				$addressbook->address=Input::get('s_address');
				$addressbook->address2=Input::get('s_address2');
				$addressbook->city=Input::get('s_city');
				$addressbook->postcode=Input::get('s_postal');
				$addressbook->country=Input::get('s_country');
				$customer->addressbooks()->save($addressbook);
			}


			//DB::commit();
			return Redirect('customer')->with('msg','New Customer Added!!');
			}else{
			return Redirect('customer')->with('msg','User already Exist');

			}

		 
		/*} catch (\Exception $e) {
			DB::rollback();
			return Redirect('customer')->with('error','Somthing went wrong !! Please try again');
		}*/
	}
		
	public function address(){
        return view('panel.address');
    }
	
	public function search(){
   	$term=$_GET["term"];
	$values= Customer::where('email', 'like', '%'.$term.'%')->orderBy('id', 'desc')->get();
 	$json=array();
	foreach($values as $value)
	         $json[]=array(
                    'value'=>$value["email"],
                    'label'=>$value["email"],
					'id'=>$value["id"]
					);
	echo json_encode($json);
	}
	
	
	public function postAddress(){
					
		$customer= Customer::where('id',Input::get('email'))->first();
		/*if(Input::has('billing') && $customer->currentbilling->where('address',Input::get('address'))->where('postcode',Input::get('postal'))->count()>0){
			 return Redirect('customer')->with('msg','Address already exist!!');
		}
		elseif(Input::has('shipping') && $customer->currentshipping()->where('address',Input::get('address'))->where('postcode',Input::get('postal'))->count()>0){ 
			 return Redirect('customer')->with('msg','Address already exist!!');
		}*/		 
		
		if(Input::get('billing')==true){
			
			$total=Addressbook::where('address',Input::get('address'))
							->where('postcode',Input::get('postal'))
							->where('customer_id',$customer->id)
							->where('is_billing',1)->get();
		}
		elseif(Input::get('shipping')==true){
			$total=Addressbook::where('address',Input::get('address'))
							->where('postcode',Input::get('postal'))
							->where('customer_id',$customer->id)
							->where('is_shipping',1)->get();	
		}
		else{
			$total='';
		}
		if(count($total)>0){
			return Redirect('customer')->with('msg','Address already exist!!');
		}
		else{
 		
			if(Input::get('billing')==true){
				$billingaddress=Addressbook::where('customer_id',$customer->id)->where('is_billing',1)->first();
				if(count($billingaddress)>0){
					$billingaddress->is_billing=0;
					$billingaddress->save();
				}	
			}
			if(Input::get('shipping')==true){
				$shippingaddress=Addressbook::where('customer_id',$customer->id)->where('is_shipping',1)->first();
				if(count($shippingaddress)>0){
					$shippingaddress->is_shipping=0;
					$shippingaddress->save();
				}	
			}
 			$addressbook =new Addressbook;
 			$addressbook->first_name=Input::get('firstname');
			$addressbook->last_name=Input::get('lastname');
			$addressbook->phone=Input::get('phone');
			$addressbook->address=Input::get('address');
			$addressbook->address2=Input::get('address2');
			$addressbook->city=Input::get('city');
			$addressbook->postcode=Input::get('postal');
			$addressbook->country=Input::get('country');
			if(Input::get('billing')==true){
				$addressbook->is_billing=1;
			}
			if(Input::get('shipping')==true){
				$addressbook->is_shipping=1;
			}
			
			$customer->addressbooks()->save($addressbook);
			//DB::commit();
			return Redirect('customer')->with('msg','New Address Add!!');
		}
		/*} catch (\Exception $e) {
			DB::rollback();*/
			return Redirect('customer')->with('msg','Somthing went wrong !! Please try again');
		//}

	}

	public function address_delete($id){
		$addressbook =Addressbook::find($id)->delete();
		return back()->with('msg','Address deleted!!');
	}
		
	public function delete($id){
		$addressbook =Addressbook::where('customer_id',$id)->delete();
		$customer =Customer::find($id)->delete();
		return Redirect('customer')->with('msg','Customer detail deleted!!');
	}
		
	public function show($id){
		$customer =Customer::where('id',$id)->first();
		$result =Addressbook::where('customer_id',$id)->get();
		return view('panel.viewcustomer')->with('customer',$customer)->with('result',$result);
	}
	
	public function edit($id){
		$customer =Customer::where('id',$id)->first();
		$result =Addressbook::where('customer_id',$id)->get();
		return view('panel.editcustomer')->with('customer',$customer)->with('result',$result);
	}
	
	public function addressdetail(){
		$address_id=Input::get('address_id');
		$address= Addressbook::where('id',$address_id)->first();
		return array('firstname'=>$address->first_name,'lastname'=>@$address->last_name, 'phone'=>$address->phone, 'address1'=>$address->address, 'address2'=>@$address->address2, 'city'=>$address->city,
	 'postal'=>$address->postcode, 'country'=>$address->country, 'billing'=>$address->is_billing, 'shipping'=>$address->is_shipping);	
	}
	
	public function updateaddress(){
	/*
		if(!empty(Input::get('billing'))){
			$addressbook= Addressbook::find($address_id);
		}
		if(!empty(Input::get('shipping'))){
			
		}*/
		$address_id=Input::get('address_id');
		if(empty($address_id)){
			$this->postAddress();

		}
		else{
			$addressbook= Addressbook::find($address_id);		
			$addressbook->first_name=Input::get('firstname');
			$addressbook->last_name=Input::get('lastname');
			$addressbook->phone=Input::get('phone');
			$addressbook->address=Input::get('address');
			$addressbook->address2=Input::get('address2');
			$addressbook->city=Input::get('city');
			$addressbook->postcode=Input::get('postal');
			$addressbook->country=Input::get('country');
			$addressbook->save();
		
		}
			
		return back()->with('msg','Address updated!!');
	}
	public function updatedetail(){
		$customer_id=Input::get('customer_id');
		$customer =Customer::find($customer_id);
		$customer->first_name=Input::get('firstname');
		$customer->last_name=Input::get('lastname');
		$customer->email=Input::get('emailid');
		$customer->phone=Input::get('mobile');
		$customer->save();
			if($customer->save()==1){
				$msg="Customer detail updated!!";
			}
			else{
					$msg="Error!!";
			}
		return redirect('customer')->with('msg',$msg);
	}
	
	public function checkemail(){
		$emailid=Input::get('emailid');
		if(count(Customer::where('email',$emailid)->get())>0){
			return 1;
		}
	}

}
