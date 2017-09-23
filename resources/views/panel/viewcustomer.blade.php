@extends ('layouts.admin')
@section('content')
  <div class="right_col" role="main">
          <div class="">
          <div class="clearfix"></div>
            <div class="page-title">
              <div class="title_left">
                <h3>Customer</h3>
              </div>
                <button type="button" id="newaddress" data-toggle="modal" data-address="New Address" class="btn btn-primary" data-target="#viewModal"> Add New Address</button>
  		@if (Session::has('msg'))
   			<div class="alert alert-info col-xs-12 msg">{{ Session::get('msg') }}
            <button type="button" id="close" class="close">&times;</button>
            </div>
		@endif
 			<div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Personal detail <small></small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    <form id="demo-form2" class="form-horizontal form-label-left">

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">First Name 
                        </label>
                        <div class="control-label col-md-2 col-sm-2">{{$customer->first_name}}
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Last Name 
                        </label>
                       <div class="control-label col-md-2 col-sm-2">{{$customer->last_name}}
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Email Address</label>
                        <div class="control-label col-md-2 col-sm-2">{{$customer->email}} </div>
                      </div>
                    <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Phone No.</label>
                        <div class="control-label col-md-2 col-sm-2">{{$customer->phone}}
                      </div>
                      </div>
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                            <a class="btn btn-success" href="{{ URL::to('customer/edit')}}/{{$customer->id}}">Edit</a>

                        </div>
                      </div>

                    </form>
                  </div>
                </div>
              </div>
            </div>
                 <div class="row">
                 @php $i=1 @endphp
         @foreach($result as $addressbook)    
       
            <div class="col-md-4 col-sm-4 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                  <h2> {{$i++}}  </h2>
                 
                    <ul class="nav navbar-right panel_toolbox">
                    <li>   @if($addressbook->is_billing==1) <i title="Billing address" class="fa fa-credit-card"></i> @endif @if($addressbook->is_shipping==1) <i title="Shipping address" class="fa fa-truck"></i> @endif</li>
                      <li><a class="collapse-link" title="minimize"><i class="fa fa-chevron-up"></i></a>
                      </li>
                   
                      <li><a class="" title="delete" onclick="return confirm('Are you sure you want to delete?'); " href="{{url('customer/address_delete')}}/{{$addressbook->id}}"><i class="redicon fa fa-close"></i></a>
                      </li>
                      <li><a class=" addressmodal" title="edit" data-toggle="modal" data-target="#viewModal" id="addressmodal" data-val="{{$addressbook->id}}" @if($addressbook->is_billing==1) data-address="Billing Address" @elseif($addressbook->is_shipping==1) data-address="Shipping Address" @else data-address="" @endif ><i class="greenicon fa fa-pencil"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <form class="form-horizontal form-label-left">
                        <div>
                            <div class="form-group">
                            	{{$addressbook->first_name}} {{@$addressbook->last_name}}
                            </div>
                            <div class="form-group">
                            	{{$addressbook->address}} {{@$addressbook->address2}}
                            </div>
                            <div class="form-group">
                            	{{$addressbook->city}}
                            </div>
                            <div class="form-group">
                            	{{$addressbook->postcode}}
                            </div>
                            <div class="form-group">
                            	{{$addressbook->country}}
                            </div>
                            <div class="form-group">
                            	{{$addressbook->phone}}
                            </div>
                        </div>
                    </form>
                  </div>
                </div>
              </div>
             
                @endforeach
           
            </div>
</div>
</div>
</div>


<div class="modal fade" id="viewModal" role="dialog">
  <div class="modal-dialog"> 
  <!-- Modal content-->
  <div class="modal-content aprtment-pop-view">
    <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title">Address<span id=""></span></h4>
   	</div>
    <div class="modal-body" >
    <div class="box-body">
      <form role="form" action="{{url('customer/updateaddress')}}" method="post" id="billdetail" class="billdetail" name="billdetail">
        <div class="form-group">
          <label>First Name</label><span style="color:#F00">*</span>
          <input type="text" class="form-control" name="firstname" id="firstname" />
        </div>
        <div class="form-group">
        	<label>Last Name</label>
        	<input type="text"  class="form-control" name="lastname" id="lastname" />
        </div>
        <div class="form-group">
        	<label>Phone Number</label><span style="color:#F00">*</span>
        	<input type="text" class="form-control" name="phone" id="phone">
        </div>
        <div class="form-group">
       		<label>Address</label><span style="color:#F00">*</span>
        	<textarea class="form-control" name="address" id="address"></textarea>
        </div>
        <div class="form-group">
        	<label>Address(Line 2)</label>
        	<textarea class="form-control" name="address2" id="address2"></textarea>
        </div>
        <div class="form-group">
        	<label>City</label><span style="color:#F00">*</span>
        	<input type="text" class="form-control" name="city" id="city">
        </div>
        <div class="form-group">
        	<label>Postal code</label><span style="color:#F00">*</span>
        	<input type="text" class="form-control" name="postal" id="postal">
        </div>
        <div class="form-group">
        	<label>Country</label><span style="color:#F00">*</span>
        	<input type="text" class="form-control" name="country" id="country">
        </div>
        <div class="form-group">
	    	<div class="checkbox">
            	<label>
                	<input type="checkbox" id="billing" name="billing" value="1">Billing Address
                </label>
            </div>
            <div class="checkbox">
                <label>
                	<input type="checkbox" id="shipping" name="shipping" value="1">Shipping Address
                </label>
            </div>
        </div>
        <div class="form-group"> 
        	<input type="hidden" name="_token" value="{{ csrf_token() }}">
        	<input type="hidden" id="address_id" name="address_id" >
           	<input type="hidden" name="email" value="{{$customer->email}}">
        	<button type="submit" class="btn btn-success">Submit</button>
        </div>
      </form>
    </div>
    </div>
  </div>
  </div>
</div>
<script>

/*$(document).on('submit', '#billdetail', function(){
	if($('#billing').prop("checked")==false && $('#shipping').prop("checked")==false){
		alert("check atleast one from billing and shipping address!");	
		return false;
	}
});*/



<!-------------------display values in modal------------------------>
$(document).on('click', '#newaddress', function(){
	$('#billdetail')[0].reset();
	$('#address_id').val('');
	$(".modal-title #addresstype").text('');
});
$(document).on('click','#addressmodal', function(event){
	event.preventDefault();
	
	var addresstype = $(this).data('address');
$(".modal-title #addresstype").text(addresstype);

	var address_id= $(this).attr('data-val');
	$.ajax({
		type:'GET',
		url:"{{url('customer/addressdetail')}}?address_id="+address_id,
		success: function(val){
		  $('.modal-body #firstname').val(val.firstname);
		  $('.modal-body #lastname').val(val.lastname);
		  $('.modal-body #phone').val(val.phone);
		  $('.modal-body #address').val(val.address1);
		  $('.modal-body #address2').val(val.address2);
		  $('.modal-body #city').val(val.city);
		  $('.modal-body #postal').val(val.postal);
		  $('.modal-body #country').val(val.country);
			if(val.billing==1){	
			$('.modal-body #addresstype').text('Billing Address');
			$('.modal-body #billing').prop('checked',true);
			$('.modal-body #shipping').prop('checked',false);
		}
		if(val.shipping==1){
			$('.modal-body #addresstype').text('Shipping Address');
			$('.modal-body #billing').prop('checked',false);
			$('.modal-body #shipping').prop('checked',true);
		}
		$('.modal-body #address_id').val(address_id);
		}
	});
});


<!-----------------------form validate----------------------------->
$(document).ready(function(e) {
    
		$("#billdetail").validate({
			errorElement: 'span',
			errorClass: 'help-block',
			highlight: function(element, errorClass, validClass) {
				$(element).closest('.form-group').addClass("has-error");
			},
			unhighlight: function(element, errorClass, validClass) {
						$(element).closest('.form-group').removeClass("has-error");
			},
            rules: {
				firstname:{
						required: true,
				},
				phone:{
					required: true,
					number: true,
					minlength: 10,
					maxlength:11
				},
				address:{
					required: true,
				},
				city:{
					required: true,
				},
				postal:{
					required: true,
				},
				country:{
					required: true,
				}
		}
   });
});
new clickToAddress({
    accessToken: '7646f-95f0a-e0220-00815', // Replace this with your access token
    dom: {
        search:     'postal', // 'search_field' is the name of the search box element
        line_1:     'address',
        line_2:     'address2',
        town:       'city',
        postcode:   'postal',
        country:    'country'
    },
    domMode: 'name' // Use names to find form elements
});  
$(document).on('click', '#close', function(){
	$('.msg').hide();
	});
</script>
@stop