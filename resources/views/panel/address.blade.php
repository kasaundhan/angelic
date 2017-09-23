@extends ('layouts.admin')
@section('content')
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Customers</h3>
              </div>
              <div class="row">    
        
 <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title"><h2>Address</h2>
                      <div class="clearfix"></div>
                  </div>
     
         <div class="x_content">

         <form role="form" action="{{url('customer/addressbook')}}" method="post" id="addressbook">
            <div class="form-group">
                <label>Customer email address<span style="color:#F00">*</span></label>
                <input type="text" class="form-control" name="email" id="email" autocomplete="off">
            </div>
            <div class="form-group">
                <label>First Name</label><span style="color:#F00">*</span>
                <input type="text" class="form-control" name="firstname" >
            </div>
            <div class="form-group">
                <label>Last Name</label>
                <input type="text"  class="form-control" name="lastname"/>
            </div>
             <div class="form-group">
                <label>Phone Number</label><span style="color:#F00">*</span>
                <input type="text" class="form-control" name="phone">
           </div>
            <div class="form-group">
                <label>Address</label><span style="color:#F00">*</span>
                <textarea class="form-control" name="address"></textarea>
            </div>
            <div class="form-group">
                <label>Address(Line 2)</label>
                <textarea class="form-control" name="address2"></textarea>
            </div>
            <div class="form-group">
                <label>City</label><span style="color:#F00">*</span>
                <input type="text" class="form-control" name="city">
            </div>
              <div class="form-group">
                <label>Postal code</label><span style="color:#F00">*</span>
                <input type="text" class="form-control" name="postal" autocomplete="off">
            </div>
             <div class="form-group">
                <label>Country</label><span style="color:#F00">*</span>
                <input type="text" class="form-control" name="country">
            </div>
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
    	    <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <button type="submit" class="btn btn-primary" id="save">Submit</button>
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
<!--------------------------auto-complete email address------------------------------->
<script>
$(document).ready(function(e) {
     $("#email").autocomplete({
                        source:"{{url('customer/search')}}",
                        minLength:3,
						}).data( "ui-autocomplete" )._renderItem = function( ul, item )
						 {  
						return $( "<li></li>" )  
					   .data( "item.autocomplete", item )  
					   .append("<span class='email-list-address'><span class='email-list'>"+item.label+"</span></span>")  
					   .appendTo( ul ); 
					    };
						
});

<!--------------------------validation for billing or shipping box checkbox------------------->

$(document).on('submit', '#addressbook', function(){
	if($('#billing').prop("checked")==false && $('#shipping').prop("checked")==false){
		alert("check atleast one from billing and shipping address!");	
		 return false;
	}
});
<!---------------------------------Form validation----------------------------------------->
$(document).ready(function(e) {
        $('#addressbook').validate({
					errorElement: 'span',
					errorClass: 'help-block',
					highlight: function(element, errorClass, validClass) {
						$(element).closest('.form-group').addClass("has-error");
					},
					unhighlight: function(element, errorClass, validClass) {
						$(element).closest('.form-group').removeClass("has-error");
					},
             					rules: {
						email:{
							required: true,
						},
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
							required: true
							 
						},
						country:{
							required: true
						}
						
					},
				
                });
      
});
<!-------------------------------crafty clicks--------------------------->
new clickToAddress({
    accessToken: '7646f-95f0a-e0220-00815', // Replace this with your access token
    dom: {
        search:     'postal', // 'search_field' is the name of the search box element
        address:     'address',
        address2:     'address2',
        city:       'city',
        postcode:   'postal',
        country:    'country'
    },
    domMode: 'name' // Use names to find form elements
});
</script>
@stop