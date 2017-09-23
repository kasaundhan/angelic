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
use App\models\Ringsize; 
use App\models\DeliveryMethod; 
use App\models\Order;
use App\models\OrderItem; 
use App\models\Customer;
use App\models\Addressbook;
use Illuminate\Contracts\Pagination\Paginator;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function index(){
		$data= Order::orderBy('id','desc')->paginate(1);
		$item= OrderItem::all();
        return view('panel.order')->with('data',$data)->with('item',$item);
    }
	
	public function create($customerid){
		if(!empty($customerid)){
			$customer= Customer::find($customerid);	
			$result =Addressbook::where('customer_id',$customerid)->get();
		}
		else{
			$customer='';	
		}
		$metals  =    Metals::all();
		$ringsizes  = Ringsize::all();	
		$methods  = DeliveryMethod::all();		
        return view('panel.create-order')->with('metals',$metals)->with('ringsizes',$ringsizes)->with('methods',$methods)->with('customer',$customer)->with('result',$result);
    }
	public function postCreate(){
		// print"<pre>";
		// print_r(Input::all());
		 $order = new Order;
		 $order->customer_id= Input::get('customer_id');
		 $order->save();
		 
		 $orderid=Order::find($order->id);
		 $orderid->order_id="TR".sprintf('%03d',$order->id);
		 $orderid->save();
				 
		 if(count(Input::get('price'))>0){	
			$i=0;	 
		 foreach(Input::get('price') as $price){	 
		 $orderitem = new OrderItem;
		 $orderitem->item_code = Input::get('itm_code.'.$i.'');
		 $orderitem->metal = Input::get('metal.'.$i.'');
		 $orderitem->ring = Input::get('ringsize.'.$i.'');
		 $orderitem->description = Input::get('description.'.$i.'');
		 $orderitem->quantity = Input::get('quantity.'.$i.'');
		 $orderitem->price = Input::get('price.'.$i.'');
		 $orderitem->total = Input::get('total.'.$i.'');
		 $orderitem->subtotal = Input::get('subtotal.'.$i.'');
		 $orderitem->delivery_method = Input::get('delivery_method.'.$i.'');
		 $orderitem->customer_note = Input::get('customer_note.'.$i.'');
		 $orderitem->staff_note = Input::get('staff_note');
		 $order->orderitems()->save($orderitem);
		 $i++;
		 }
		 }
		 return redirect('order/')->with('msg','Order Created');
	}

}