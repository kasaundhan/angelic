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
                  <div class="x_title"><h2>Add Customer</h2>
                      <div class="clearfix"></div>
                  </div>
     
         <div class="x_content">
        <form role="form" action="{{url('customer/create')}}" method="post" class="form-validate" id="createcustomer">
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
  
          
       <div class="billing_address_div">
         <div class="x_title"><h2>Billing</h2>
                      <div class="clearfix"></div>
                  </div>
        <div class="checkbox">
                    <label>
                       <input type="checkbox" id="billing" name="billing" value="billing">Billing Address
                    </label>
                </div>
          <div id="billing_div" style="display:none">
      <div class="x_content">
          <div class="col-lg-12">
            <div class="col-lg-6">
              <div class="form-group">
                <label>First Name</label>
                <span class="required">*</span>
                <input type="text" class="form-control billing_address" name="b_firstname" id="b_firstname" >
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <label>Last Name</label>
                <input type="text"  class="form-control " name="b_lastname" id="b_lastname"  />
              </div>
            </div>
          </div>
          <div class="col-lg-12">
      
            <div class="col-lg-6">
              <div class="form-group">
                <label>Phone Number</label>
                <span class="required">*</span>
                <input type="text" class="form-control billing_address"  name="b_phone" id="b_phone" >
              </div>
            </div>
          </div>
          <div class="col-lg-12">
            <div class="col-lg-12">
              <div class="form-group">
                <label>Address</label>
                <span class="required">*</span>
                <textarea class="form-control billing_address" name="b_address" id="b_address"></textarea>
              </div>
            </div>
            <div class="col-lg-12">
              <div class="form-group">
                <label>Address(Line 2)</label>
                <textarea class="form-control" name="b_address2" id="b_address2"></textarea>
              </div>
            </div>
          </div>
          <div class="col-lg-12">
            <div class="col-lg-6">
              <div class="form-group">
                <label>City</label>
                <span class="required">*</span>
                <input type="text" class="form-control billing_address" name="b_city" id="b_city">
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <label>Postal code</label>
                <span class="required">*</span>
                <input type="text" class="form-control billing_address" name="b_postal" id="b_postal" autocomplete="off">
              </div>
            </div>
          </div>
          <div class="col-lg-12">
            <div class="col-lg-6">
              <div class="form-group">
                <label>Country</label>
                <span class="required">*</span>
                <input type="text" class="form-control billing_address" name="b_country" id="b_country">
              </div>
            </div>
          </div>
      </div>
      </div>
      </div>
         <div class="shipping_address_div">
         <div class="x_title"><h2>Shipping</h2>
                      <div class="clearfix"></div>
                  </div>
        <div class="checkbox">
                    <label>
                       <input type="checkbox" id="shipping" name="shipping" value="shipping">Shipping Address
                    </label>
                </div>
                 <div id="shipping_div" style="display:none">
      <div class="x_content">
          <div class="col-lg-12">
            <div class="col-lg-6">
              <div class="form-group">
                <label>First Name</label>
                <span class="required">*</span>
                <input type="text" class="form-control shipping_address" name="s_firstname" id="s_firstname" />
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <label>Last Name</label>
                <input type="text"  class="form-control" name="s_lastname" id="s_lastname" />
              </div>
            </div>
          </div>
          <div class="col-lg-12">
            
            <div class="col-lg-6">
              <div class="form-group">
                <label>Phone Number</label>
                <span class="required">*</span>
                <input type="text" class="form-control shipping_address" name="s_phone" id="s_phone" />
              </div>
            </div>
          </div>
          <div class="col-lg-12">
            <div class="col-lg-12">
              <div class="form-group">
                <label>Address</label>
                <span class="required">*</span>
                <textarea class="form-control shipping_address" name="s_address" id="s_address"></textarea>
              </div>
            </div>
            <div class="col-lg-12">
              <div class="form-group">
                <label>Address(Line 2)</label>
                <textarea class="form-control " name="s_address2" id="s_address2"></textarea>
              </div>
            </div>
          </div>
          <div class="col-lg-12">
            <div class="col-lg-6">
              <div class="form-group">
                <label>City</label>
                <span class="required">*</span>
                <input type="text" class="form-control shipping_address" name="s_city" id="s_city" />
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <label>Postal code</label>
                <span class="required">*</span>
                <input type="text" class="form-control shipping_address" name="s_postal" id="s_postal" autocomplete="off">
              </div>
            </div>
          </div>
          <div class="col-lg-12">
            <div class="col-lg-6">
              <div class="form-group">
                <label>Country</label>
                <span class="required">*</span>
                <input type="text" class="form-control shipping_address" name="s_country" id="s_country">
              </div>
         </div>
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
$("#billing").on('change', function(){
	$(this).parents('div.billing_address_div').find('#billing_div').toggle('slow');
});
$("#shipping").on('change', function(){
	$(this).parents('div.shipping_address_div').find('#shipping_div').toggle('slow');
});

<!----------------------form validation--------------------------->
		$(document).ready(function(e) {
			$("#billing").on('change', function(){
			if ($(this).prop('checked')) {
				$(this).parents('div.billing_address_div').find('.billing_address').each(function(index, element) {
				$(this).attr('required',true);
			});
			$('#b_phone').attr('number',true);
			$('#b_phone').attr('minlength',10);
			$('#b_phone').attr('maxlength',11);

			}else{
				$(this).parents('div.billing_address_div').find('.billing_address').each(function(index, element) {
				$(this).attr('required',false);
			});
			}
			})
			
			$("#shipping").on('change', function(){
			  if ($(this).prop('checked')) {
				  $(this).parents('div.shipping_address_div').find('.shipping_address').each(function(index, element) {
				  $(this).attr('required',true);
				  
			  });
				$('#s_phone').attr('number',true);
				$('#s_phone').attr('minlength',10);
				$('#s_phone').attr('maxlength',11);
			  }else{
				  $(this).parents('div.shipping_address_div').find('.shipping_address').each(function(index, element) {
				  $(this).attr('required',false);
			  });
			  }
			})
		});


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
var config = {accessToken: '7646f-95f0a-e0220-00815'};
cc = new clickToAddress(config);
cc.attach({
    search:     'b_postal',
    town:       'b_city',
    postcode:   'b_postal',
    county:     'b_country',
    line_1:     'b_address', 
	line_2:     'b_address2',
});
cc.attach({
    search:     's_postal',
    town:       's_city',
    postcode:   's_postal',
    county:     's_country',
    line_1:     's_address', 
	line_2:     's_address2',
	county:     's_country',
});
</script>
@stop