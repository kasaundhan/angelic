<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Input;
use App\Http\Requests;
use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Auth;
use Admin;
use Mail;
use DB;
use Hash; 
use Session; 
use Redirect;
use App\models\Metals; 
use App\models\Ringsize; 
use App\models\Quote;
use App\models\QuoteItem; 
use App\models\Customer;
use App\models\Addressbook;
use Illuminate\Contracts\Pagination\Paginator;
use App\Http\Controllers\Controller;

class QuoteController extends Controller
{
    public function index(){
		$data= Quote::orderBy('id','desc')->paginate(1);
		$item= QuoteItem::all();
        return view('panel.quote')->with('data',$data)->with('item',$item);
    }
	
	public function filter(Request $request){	
		$data=Quote::where(function($query){
		  if(Input::has('first')){
			  $customer=Customer::where('first_name','LIKE','%'.Input::get('first').'%')->distinct()->pluck('id');
			  $query->whereIn('customer_id',$customer);
		  }
		  if(Input::has('last')){
			 $customer=Customer::where('last_name','LIKE','%'.Input::get('last').'%')->distinct()->pluck('id');
			 $query->whereIn('customer_id',$customer);
		  }
		  if(Input::has('quote_id')){
			  $query->where('quote_id','LIKE','%'.Input::get('quote_id').'%');
		  }
		 })->orderBy('id','desc')->paginate(1);
		 
		 $val='';
		 $val.='<table class="table table-hover table-striped jambo_table">
                    <thead>
                        <tr>
                        <th>Sn.</th>
                        <th>Quote Number</th>
                        <th>Date and Time</th>
                        <th>Name and Email Address</th>
                        <th>Amount</th>
                        <th>Action</th>
                        </tr>
                    </thead><tbody';
                      $i=0;
                    foreach($data as $result){
                        $val.='<tr>
                           <td>'.++$i.'</td>
                           <td>'.$result->quote_id.'</td>
 	                       <td>'.date('d-m-Y H:i',strtotime($result->created_at)).'</td>
                           <td>'.$result->customer->first_name.' '.$result->customer->last_name.'<br />'.$result->customer->email.'</td>
                           <td>'.$result->quoteitems->sum('total').'</td>
                           <td>
                           	<a class="btn btn-small btn-danger" onclick="return confirm(Are you sure you want to delete?)" href="'.url('quote/delete').'/'.$result->id.'"><i class="fa fa-trash"></i> Delete</a>
                   			<a class="btn btn-small btn-info" href="'.url('quote/view').'/'.$result->id.'"> View</a>
                            <a class="btn btn-small btn-success" href="'.url('quote/edit').'/'.$result->id.'"><i class="fa fa-pencil-square-o"></i> Edit</a>
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
		return $val;
		//return view('panel.quote')->with('data',$data);
}
	public function create($customerid){
		if(!empty($customerid)){
			$customer= Customer::find($customerid);	
		}
		else{
			$customer='';	
		}
		$metals  =    Metals::all();
		$ringsizes  = Ringsize::all();		
        return view('panel.add-quote')->with('metals',$metals)->with('ringsizes',$ringsizes)->with('customer',$customer);
    }

	public function QuoteView($quoteid){
		$quote = Quote::find($quoteid);
		$quote_item=QuoteItem::where('quote_id',$quote->id)->get();
		return view('panel.view-quote')->with('quote',$quote)->with('quote_item',$quote_item);
	}
	public function postCreate(){
		// print"<pre>";
		// print_r(Input::all());
		 $quote = new Quote;
		 $quote->customer_id= Input::get('customer_id');
		 $quote->save();
		 
		 $quoteid=Quote::find($quote->id);
		 $quoteid->quote_id="Q".sprintf('%03d',$quote->id);
		 $quoteid->save();
		 
		 $quoteitems = new QuoteItem;
		 //$quoteitems->customer_id= Input::get('customer_id');
		 
		 if(count(Input::get('price'))>0){	
			$i=0;	 
		 foreach(Input::get('price') as $price){	 
		 $quoteitems = new QuoteItem;
		 $quoteitems->item_code = Input::get('itm_code.'.$i.'');
		 $quoteitems->metal = Input::get('metal.'.$i.'');
		 $quoteitems->ring = Input::get('ringsize.'.$i.'');
		 $quoteitems->description = Input::get('description.'.$i.'');
		 $quoteitems->quantity = Input::get('quantity.'.$i.'');
		 $quoteitems->price = Input::get('price.'.$i.'');
		 $quoteitems->total = Input::get('total.'.$i.'');
		 $quoteitems->subtotal = Input::get('subtotal.'.$i.'');
		 $quoteitems->customer_note = Input::get('customer_note.'.$i.'');
		 $quoteitems->staff_note = Input::get('staff_note');
		 $quote->quoteitems()->save($quoteitems);
		 $i++;
		 }
		 }
		 return redirect('quote/')->with('msg','Quote Added');
	}
	
	public function delete($id){
		$delete=QuoteItem::where('quote_id',$id)->delete();
		if(Quote::find($id)->delete()){
		Session::flash('msg','Quote deleted!!');
		}else{
		Session::flash('msg','Somthing went wrong!!');
		}
		return back();
	}
	
	public function emailsearch(){
		$email=Input::get('email');
		$result=Customer::where('email',$email)->first();
		return array('name'=>$result->first_name, 'phone'=>$result->phone);
	}
	
	public function customersearch(){
   	$term=Input::get('term');	
	if(Customer::where('email', 'like', '%'.$term.'%')->orWhere('first_name', 'like', '%'.$term.'%')->orWhere('last_name', 'like', '%'.$term.'%')->orWhere(DB::raw('concat(first_name," ",last_name)'), 'like', '%'.$term.'%')->orderBy('id', 'desc')->count()>0){
		$values= Customer::where('email', 'like', '%'.$term.'%')->orWhere('first_name', 'like', '%'.$term.'%')->orWhere('last_name', 'like', '%'.$term.'%')->orWhere(DB::raw('concat(first_name," ",last_name)'), 'like', '%'.$term.'%')->orderBy('id', 'desc')->get();
	}
 	elseif(Addressbook::where('postcode','like', '%'.$term.'%')->count()>0){
		$customer_ids =  array();
		foreach(Addressbook::select('customer_id')->where('postcode','like', '%'.$term.'%')->get() as $addressbook){
			if(!in_array($addressbook->customer_id,$customer_ids)){
				array_push($customer_ids,$addressbook->customer_id);
			}
		}
 		$values= Customer::whereIn('id',$customer_ids)->get();
	}
	else{
		$values= array();
	}
	
 	$json=array();
	foreach($values as $value)
	         $json[]=array(
                    'value'=>$value["email"],
                    'label'=>$value["email"],
					'id'=>$value["id"]
					);
	echo json_encode($json);
	}
	
	public function edit($id){
		$quote= Quote::find($id);
		if(count(QuoteItem::where('quote_id',$id)->get())>0){
			$quoteitem=QuoteItem::where('quote_id',$id)->get();
		}
		else{
			$quoteitem='';
		}
		$customer= Customer::find($quote->customer_id);	
		$metals  =    Metals::all();
		$ringsizes  = Ringsize::all();

		return view('panel.edit-quote')->with('quote',$quote)->with('customer',$customer)->with('metals',$metals)->with('ringsizes',$ringsizes)->with('quoteitem',$quoteitem);
	}
	
	public function update(){
		//echo '<pre>';
		//print_r(Input::all());
		//die;
		$quoteid=Input::get('quoteid');
		$customerid=Input::get('customer_id');
$i=0;
		foreach(Input::get('itm_code') as $itmcode){	
		//print_r(Input::get('itm_code'));
		//echo count(QuoteItem::find(Input::get('quoteitemid')));
		//die;
		 
	/*	if(count(QuoteItem::find(Input::get('quoteitemid')))>0){
		  //$quoteitemid=Input::get('quoteitemid');
	 		print_r(Input::get('quoteitemid'));
die; */
			if(count(QuoteItem::find(Input::get('quoteitemid.'.$i)))>0){
			$item=QuoteItem::find(Input::get('quoteitemid.'.$i));
			$item->item_code = Input::get('itm_code.'.$i.'');
			$item->metal = Input::get('metal.'.$i.'');
			$item->ring = Input::get('ringsize.'.$i.'');
			$item->description = Input::get('description.'.$i.'');
			$item->quantity = Input::get('quantity.'.$i.'');
			$item->price = Input::get('price.'.$i.'');
			$item->total = Input::get('total.'.$i.'');
			$item->subtotal = Input::get('subtotal.'.$i.'');
			$item->customer_note = Input::get('customer_note');
			$item->staff_note = Input::get('staff_note');
			$item->save();
			$i++;
	
	}
	else{
		if(!empty(Input::get('itm_code.'.$i.''))){
			$quoteitems = new QuoteItem;
			$quoteitems->quote_id = $quoteid;
			$quoteitems->item_code = Input::get('itm_code.'.$i.'');
			$quoteitems->metal = Input::get('metal.'.$i.'');
			$quoteitems->ring = Input::get('ringsize.'.$i.'');
			$quoteitems->description = Input::get('description.'.$i.'');
			$quoteitems->quantity = Input::get('quantity.'.$i.'');
			$quoteitems->price = Input::get('price.'.$i.'');
			$quoteitems->total = Input::get('total.'.$i.'');
			$quoteitems->subtotal = Input::get('subtotal.'.$i.'');
			$quoteitems->customer_note = Input::get('customer_note');
			$quoteitems->staff_note = Input::get('staff_note');
			$quoteitems->save();
			$i++;	
		}
	}
	}
	return redirect('/quote')->with('msg','updated');
	}
	
	public function delete_quoteitem(){
		$item= QuoteItem::find(Input::get('id'))->delete();
		return 1;		
	}
	
	public function getPdf($id){
		$quote = Quote::find($id);	
		
      	$pdf = PDF::loadView('panel.pdf',compact('quote'));
      	return $pdf->download('invoice.pdf');
	}
	
	public function sendQuote($id){
		$quote = Quote::find($id);	
		Mail::send('emails.pdf',$quote, function($message) {
			$message->to($quote->customer->email)
					->subject('Quote description');
		});
	}

}
