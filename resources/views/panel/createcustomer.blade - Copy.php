@extends ('layouts.admin')
@section('content')
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Customer</h3>
              </div>
              <div class="row">    
        
 <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title"><h2>New Customer</h2>
                      <div class="clearfix"></div>
                  </div>
     
         <div class="x_content">
        <form role="form" action="{{url('customer/create')}}" method="post" class="form-validate"  id="createcustomer">
          <div class="col-lg-12">
            <div class="col-lg-6">
              <div class="form-group">
                <label>First Name</label>
                <span class="required">*</span>
                <input type="text" class="form-control" name="firstname" id="firstname" >
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <label>Last Name</label>
                <input type="text"  class="form-control" name="lastname" id="lastname"  />
              </div>
            </div>
          </div>
          <div class="col-lg-12">
            <div class="col-lg-6">
              <div class="form-group">
                <label>Email Address</label>
                <span class="required">*</span>
                <input type="text" class="form-control" name="email" id="email">
                <div class="help-block" id="email-msg" style="color:#a94442"></div>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <label>Phone Number</label>
                <span class="required">*</span>
                <input type="text" class="form-control" name="phone" id="phone" >
              </div>
            </div>
          </div>
          
              
         <div class="x_title"><h2>Billing</h2>
                      <div class="clearfix"></div>
                  </div>
      
      <div class="x_content">
        <form role="form" action="{{url('customer/create')}}" method="post" class="form-validate"  id="createcustomer">
          <div class="col-lg-12">
            <div class="col-lg-6">
              <div class="form-group">
                <label>First Name</label>
                <span class="required">*</span>
                <input type="text" class="form-control" name="firstname" id="firstname" >
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <label>Last Name</label>
                <input type="text"  class="form-control" name="lastname" id="lastname"  />
              </div>
            </div>
          </div>
          <div class="col-lg-12">
            <div class="col-lg-6">
              <div class="form-group">
                <label>Email Address</label>
                <span class="required">*</span>
                <input type="text" class="form-control" name="email" id="email">
                <div class="help-block" id="email-msg" style="color:#a94442"></div>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <label>Phone Number</label>
                <span class="required">*</span>
                <input type="text" class="form-control" name="phone" id="phone" >
              </div>
            </div>
          </div>
          <div class="col-lg-12">
            <div class="col-lg-12">
              <div class="form-group">
                <label>Address</label>
                <span class="required">*</span>
                <textarea class="form-control" name="address"></textarea>
              </div>
            </div>
            <div class="col-lg-12">
              <div class="form-group">
                <label>Address(Line 2)</label>
                <textarea class="form-control" name="address2"></textarea>
              </div>
            </div>
          </div>
          <div class="col-lg-12">
            <div class="col-lg-6">
              <div class="form-group">
                <label>City</label>
                <span class="required">*</span>
                <input type="text" class="form-control" name="city">
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <label>Postal code</label>
                <span class="required">*</span>
                <input type="text" class="form-control" name="postal" autocomplete="off">
              </div>
            </div>
          </div>
          <div class="col-lg-12">
            <div class="col-lg-6">
              <div class="form-group">
                <label>Country</label>
                <span class="required">*</span>
                <input type="text" class="form-control" name="country">
              </div>
            </div><div class="col-lg-12">
            <div class="col-lg-6">
                      <div class="form-group">
	            <div class="checkbox">
                    <label>
                    <input type="checkbox" id="billing" name="billing" value="billing" checked>Billing Address
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                       <input type="checkbox" id="shipping" name="shipping" value="shipping">Shipping Address
                    </label>
                </div>
            </div>
               </div>
            </div>
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="col-lg-12">
              <div class="form-group">
                <button type="submit" class="btn btn-primary" id="save">Submit</button>
              </div>
            </div>
          </div>
        </form>
               
      </div>
      
          
         <div class="x_title"><h2>Billing</h2>
                      <div class="clearfix"></div>
                  </div>
      
      <div class="x_content">
        <form role="form" action="{{url('customer/create')}}" method="post" class="form-validate"  id="createcustomer">
          <div class="col-lg-12">
            <div class="col-lg-6">
              <div class="form-group">
                <label>First Name</label>
                <span class="required">*</span>
                <input type="text" class="form-control" name="firstname" id="firstname" >
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <label>Last Name</label>
                <input type="text"  class="form-control" name="lastname" id="lastname"  />
              </div>
            </div>
          </div>
          <div class="col-lg-12">
            <div class="col-lg-6">
              <div class="form-group">
                <label>Email Address</label>
                <span class="required">*</span>
                <input type="text" class="form-control" name="email" id="email">
                <div class="help-block" id="email-msg" style="color:#a94442"></div>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <label>Phone Number</label>
                <span class="required">*</span>
                <input type="text" class="form-control" name="phone" id="phone" >
              </div>
            </div>
          </div>
          <div class="col-lg-12">
            <div class="col-lg-12">
              <div class="form-group">
                <label>Address</label>
                <span class="required">*</span>
                <textarea class="form-control" name="address"></textarea>
              </div>
            </div>
            <div class="col-lg-12">
              <div class="form-group">
                <label>Address(Line 2)</label>
                <textarea class="form-control" name="address2"></textarea>
              </div>
            </div>
          </div>
          <div class="col-lg-12">
            <div class="col-lg-6">
              <div class="form-group">
                <label>City</label>
                <span class="required">*</span>
                <input type="text" class="form-control" name="city">
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <label>Postal code</label>
                <span class="required">*</span>
                <input type="text" class="form-control" name="postal" autocomplete="off">
              </div>
            </div>
          </div>
          <div class="col-lg-12">
            <div class="col-lg-6">
              <div class="form-group">
                <label>Country</label>
                <span class="required">*</span>
                <input type="text" class="form-control" name="country">
              </div>
            </div><div class="col-lg-12">
            <div class="col-lg-6">
                      <div class="form-group">
	            <div class="checkbox">
                    <label>
                    <input type="checkbox" id="billing" name="billing" value="billing" checked>Billing Address
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                       <input type="checkbox" id="shipping" name="shipping" value="shipping">Shipping Address
                    </label>
                </div>
            </div>
               </div>
            </div>
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="col-lg-12">
              <div class="form-group">
                <button type="submit" class="btn btn-primary" id="save">Submit</button>
              </div>
            </div>
          </div>
        </form>
               
      </div>
          
        </form>
               
      </div>
  
      <!-- /.row (nested) --> 
    </div>
    <!-- /.panel-body --> 
  </div>
  <!-- /.panel --> 
</div>
</div>
</div>
</div>
<script>
<!--------------------------validation for billing or shipping box checkbox------------------->

$(document).on('submit', '#createcustomer', function(){
	if($('#billing').prop("checked")==false && $('#shipping').prop("checked")==false){
		alert("check atleast one from billing and shipping address!");	
		 return false;
	}
});
<!----------------------form validation--------------------------->
$(document).ready(function(e) {
        $("#createcustomer").validate({
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
						email:{
							required: true,
							email: true,
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
							required: true
							 
						},
						country:{
							required: true
						}	 
					}
      });
<!-------------------------unique record with email -------------------->
 	$("#email").on('blur', function() {
		$("#save").attr('disabled', false);
		$('#email-msg').html('');
          var emailid = $(this).val();
                $.ajax({
                    url: "{{url('customer/checkemail')}}?emailid="+emailid,
                    type: "GET",                   
                    success:function(data) {
						if(data==1){
                     		$('#email-msg').html('Email ID already Exist');
	                    	$("#save").attr('disabled', true);
						}
					}
            });
	});     
});

<!-------------------------------crafty clicks--------------------------->
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
@stop