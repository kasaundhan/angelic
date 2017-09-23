@extends('layouts.admin')
@section('content')
@php use App\models\Addressbook @endphp
<style>
.ajax-load{
  padding: 10px 0px;
  width: 100%;
  	}
</style>
<div class="myoverlay" style="height:100%; width:100%; top:0; left:0; margin:0; background:#000; opacity:0.3; position:absolute; z-index:1048; display:none"> <center><img src="{{ url('/assets/images/loading.gif') }} "height="200" width="250" /></center>
</div>
<div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Customer</h3>
                  <a href="{{url('customer/create')}}" class="btn btn-primary">Add</a>
              </div>
              <div class="row">    
        		@if (Session::has('msg'))
   			<div class="alert alert-info col-xs-12 msg">{{ Session::get('msg') }}<button type="button" id="close" class="close">&times;</button>
            </div>
		@endif
 <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title"><h2>Filter</h2>
                      <div class="clearfix"></div>
                  </div>
     
         <div class="x_content">
        <form role="form" class="form-validate" method="get">
          <div class="col-lg-12">
            <div class="col-lg-6">
              <div class="form-group">
                <label>First Name</label>
                <input type="text" class="form-control" name="firstname" id="firstname" value="" />
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <label>Last Name</label>
                <input type="text"  class="form-control" name="lastname" id="lastname" value="" />
              </div>
            </div>
          </div>
          <div class="col-lg-12">
            <div class="col-lg-6">
              <div class="form-group">
                <label>Email Address</label>
                <input type="text" class="form-control" name="email" id="email" value="" />
                <div class="help-block" id="email-msg" style="color:#a94442"></div>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <label>Phone Number</label>
                <input type="text" class="form-control" name="phone" id="phone" value="" />
              </div>
            </div>
          </div>
        <div class="col-lg-12">
            <div class="col-lg-6">
              <div class="form-group">
                <label>Zip</label>
                <input type="text" class="form-control" name="zip" id="zip" value="" />
              </div>
            </div>
            </div>
             <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="col-lg-12">
              <div class="form-group">
                <a class="btn btn-primary" id="search" name="search" value="yes">Search</a>
              </div>
            </div>
        </form>
      </div>
      <!-- /.row (nested) --> 
    </div>
    <!-- /.panel-body --> 
  </div>
  <!-- /.panel --> 
</div>
              <div class="row">    
 <div class="col-md-12 col-sm-12 col-xs-12">
              
                <div class="x_panel" >
                  <div class="x_title"><h2>Customers</h2>
                      <div class="clearfix"></div>
                  </div>
              <div class="x_content" id="result">
         	<table class="table table-striped table-hover jambo_table">
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
	<tbody >
    @php $i=0 @endphp
    @foreach($data as $rec)
		<tr>
        <td>{{++$i}}</td>
			<td>{{$rec->first_name}} {{$rec->last_name}}</td>
			<td>{{$rec->email}}</td>
			<td>{{$rec->phone}}</td>
            @if($result=Addressbook::where('customer_id',$rec->id)->where('is_billing','1')->first())
            		<td>{{$result->address}}</td>
            @else
            <td></td>
            @endif
            @if($result=Addressbook::where('customer_id',$rec->id)->where('is_shipping','1')->first())
            		<td>{{$result->address}}</td>
            @else
            <td></td>
            @endif
            <td>   
          <a class="btn btn-small btn-danger" onclick="return confirm('Are you sure you want to delete?'); " href="{{url('customer/delete')}}/{{$rec->id}}"><i class="fa fa-trash"></i> Delete</a>
          <a class="btn btn-small btn-info" href="{{url('customer/show')}}/{{$rec->id}}">View</a>
          <a class="btn btn-small btn-success" href="{{url('customer/edit')}}/{{$rec->id}}"><i class="fa fa-pencil-square-o"></i> Edit</a>
		 <a class="btn btn-small btn-primary" href="{{url('quote/add')}}/{{$rec->id}}"><i class="fa fa-pencil-square-o"></i> Create Quote</a>
		 <a class="btn btn-small btn-primary" href="{{url('order/create')}}/{{$rec->id}}">Create Order</a>
          </td>
		</tr>
	@endforeach
	</tbody>
</table>
@if($data->currentPage() > 1)
       <button>  <a href="{{ $data->previousPageUrl() }}">Previous</a></button>
    @endif

   @if($data->hasMorePages())
     <button>   <a href="{{ $data->nextPageUrl() }}">Next</a></button>
    @endif
 </div>
  
</div>
	</div>
    </div>
    </div>
    </div>
    </div>
    <script>
$(document).on('click', '#close', function(){
	$('.msg').hide();
	});
$(document).on('click','#search', function(page_num){
	var first=$('#firstname').val();
	var last=$('#lastname').val();
	var email=$('#email').val();
	var phone=$('#phone').val();
	var zip=$('#zip').val();
$('.myoverlay').fadeIn();
    $.ajax({
        type: 'GET',
        url: "{{url('/customer/filter')}}",
        data:'first='+first+'&last='+last+'&phone='+phone+'&email='+email+'&zip='+zip,
        success: function (data) {
         //$('html,body').html(data);
		 $('#result').html(data);
		}
    });
	$('.myoverlay').fadeOut();
});


   var page=1; 
	$(document).on('click','.more',function(e){
	var first=$('#firstname').val();
	var last=$('#lastname').val();
	var email=$('#email').val();
	var phone=$('#phone').val();
	var zip=$('#zip').val();
	page++;
	  var location= '{{url("/customer/filter")}}?page=' + page+'&first='+first+'&last='+last+'&phone='+phone+'&email='+email+'&zip='+zip;
	  $.ajax({
		  		url: location,
	            type: "get",
	         })
	        .done(function(data)
	        { 
			//alert(data);
			 $('#result').html(data);
	        })
			});
			
	$(document).on('click','.less',function(e){
	var first=$('#firstname').val();
	var last=$('#lastname').val();
	var email=$('#email').val();
	var phone=$('#phone').val();
	var zip=$('#zip').val();
	page--;
	  var location= '{{url("/customer/filter")}}?page=' + page+'&first='+first+'&last='+last+'&phone='+phone+'&email='+email+'&zip='+zip;
	  $.ajax({
		  		url: location,
	            type: "get",
	         })
	        .done(function(data)
	        { 
		//	alert(data);
			 $('#result').html(data);
	        })
			});
</script>
@endsection