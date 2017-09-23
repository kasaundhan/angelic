@extends ('layouts.admin')

@section('content')
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Plain Page</h3>
              </div>
              <div class="row">    
        
 <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title"><h2>Customers</h2>
                      <div class="clearfix"></div>
                  </div>
  <div class="col-lg-6">
  <h2></h2>
    <form role="form" action="{{url('customer/updatedetail')}}" method="post" id="customerdetail">
      <div id="shipping_detail" >
      <div class="form-group">
      	<label>First Name</label><span style="color:#F00">*</span>
      	<input class="form-control" name="firstname" value="{{$customer->first_name}}">
      </div>
      <div class="form-group">
      	<label>Last Name</label>
      	<input class="form-control" name="lastname"  value="{{$customer->last_name}}">
      </div>
      <div class="form-group">
      	<label>Email Address</label><span style="color:#F00">*</span>
      	<input class="form-control" name="emailid"  value="{{$customer->email}}">
      </div>
      <div class="form-group">
      	<label>Phone Number</label><span style="color:#F00">*</span>
      	<input class="form-control" name="mobile"  value="{{$customer->phone}}">
      </div>
      <div class="form-group"> 
      	<input type="hidden" name="_token" value="{{ csrf_token() }}">
      	<input type="hidden" name="customer_id" id="customer_id" value="{{$customer->id}}">
      	<button type="submit" class="btn btn-default">Submit</button>
      </div>
      </div>
    </form>
  </div>
  <button type="button" id="newaddress" data-toggle="modal" data-address="New Address" class="btn btn-default" data-target="#viewModal"> Add New Address</button>
  <div class="col-lg-6">
  @foreach($result as $addressbook)
  @if($addressbook->is_billing==1)
    <div>
    <div class="form-group">
    <label>Billing Address</label>
    <a class="btn bg-olive addressmodal" data-toggle="modal" data-target="#viewModal" id="addressmodal" data-address="Billing Address"  data-val="{{$addressbook->id}}"><i class="fa fa-pencil"></i></a>
    </div>
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
  @endif
  @if($addressbook->is_shipping==1)
    <div>
    <div class="form-group">
    <label>Shipping Address</label>
    <a class="btn bg-olive addressmodal" data-toggle="modal" data-target="#viewModal" id="addressmodal"  data-address="Shipping Address" data-val="{{$addressbook->id}}"><i class="fa fa-pencil"></i></a>
    </div>
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
  @endif
  @endforeach
  </div>


</div>
</div>
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
    <h4 class="modal-title"><span id="address"></span></h4>
   	</div>
    <div class="modal-body" >
    <div class="box-body">
      <form role="form" action="{{url('customer/updateaddress')}}" method="post" id="" name="billdetail">
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
                	<input type="checkbox" id="billing" name="billing" value="billing">Billing Address
                </label>
            </div>
            <div class="checkbox">
                <label>
                	<input type="checkbox" id="shipping" name="shipping" value="shipping">Shipping Address
                </label>
            </div>
        </div>
        <div class="form-group"> 
        	<input type="hidden" name="_token" value="{{ csrf_token() }}">
        	<input type="hidden" id="address_id" name="address_id" >
           	<input type="hidden" name="email" value="{{$customer->email}}">
        	<button type="submit" class="btn btn-default">Submit</button>
        </div>
      </form>
    </div>
    </div>
  </div>
  </div>
</div>

<script type="text/javascript">
$(document).on('submit', '#billdetail', function(){
	if($('#billing').prop("checked")==false && $('#shipping').prop("checked")==false){
		alert("check atleast one from billing and shipping address!");	
		return false;
	}
});

$(document).on('click', '#newaddress', function(){
	$('#billdetail')[0].reset();
	$('#address_id').val('');
});


<!-------------------display values in modal------------------------>
$(document).on("click", "#addressmodal", function () {

var address = $(this).data('address');
$(".modal-title #address").text(address);
});

$(document).on('click','#addressmodal', function(event){
	event.preventDefault();
var address_id= $(this).attr('data-val');
$.ajax({
type:'GET',
url:"{{url('customer/addressdetail')}}?address_id="+address_id,
success: function(val){
$('.modal-body #firstname').val(val.firstname);
$('.modal-body #lastname').val(val.lastname);
$('.modal-body #phone').val(val.phone);
$('.modal-body #address').val(val.address);
$('.modal-body #address2').val(val.address2);
$('.modal-body #city').val(val.city);
$('.modal-body #postal').val(val.postal);
$('.modal-body #country').val(val.country);
if(val.billing==1){	
	$('.modal-body #billing').prop('checked',true);
	$('.modal-body #shipping').prop('checked',false);
}
if(val.shipping==1){
	$('.modal-body #billing').prop('checked',false);
	$('.modal-body #shipping').prop('checked',true);
}
$('.modal-body #address_id').val(address_id);
}
});
});
<!-----------------------form validate----------------------------->
$(document).ready(function(e) {
        $("#customerdetail").validate({
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
					emailid:{
						required: true,
						email: true,
					},
					mobile:{
						required: true,
						number: true,
						minlength: 10,
						maxlength:11
					}
			}
         });
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
</script>
@endsection