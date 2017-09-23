@extends ('layouts.admin')
@section('content')
<style>
#table-list table:nth-child(even) {
    background-color: #f7f7f7;
}#table-list table:nth-child(odd) {
    background-color: #eee;
}#price:not(.nostyle)

</style>
      <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Order</h3>
                   <button type="button" id="newaddress" data-toggle="modal" data-address="New Address" class="btn btn-primary" data-target="#viewModal"> Add New Address</button>

              </div>
              
              <div class="row">    
 <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title"><h2>Customer Detail</h2>
                      <div class="clearfix"></div>
                  </div>
         <div class="x_content">     
          <div class="col-md-12">
            <div class="form-group">
              <label>Customer Name</label>
              <input type="text" class="form-control" name="customer_name" id="customer_name" @if(!empty($customer)) value="{{$customer->first_name." ".$customer->last_name}}" @endif readonly="readonly">
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label>Customer Email id</label>
              <input type="text" class="form-control" name="customer_email" id="customer_email" @if(!empty($customer)) value="{{$customer->email}}" @endif readonly="readonly">
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label>Customer Phone no.</label>
              <input type="text" class="form-control" name="customer_phone" id="customer_phone" @if(!empty($customer)) value="{{$customer->phone}}" @endif readonly="readonly">
            </div>
          </div>
        </div>
        </div>
        </div>
        </div>
         <div class="row">
              @if(!empty($result))
                @php $i=1 @endphp
         @foreach($result as $addressbook)    
            <div class="col-md-4 col-sm-4 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                  <h2>  </h2>
                    <ul class="nav navbar-right panel_toolbox">
                    <li> @if($addressbook->is_billing==1) <i title="Billing address" class="fa fa-credit-card"></i> @endif @if($addressbook->is_shipping==1) <i title="Shipping address" class="fa fa-truck"></i> @endif</li>
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
         
         	@endif
            </div>
            <div class="row">    
			 <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title"><h2>Create Order</h2>
                      <div class="clearfix"></div>
                  </div>
     		
         <div class="x_content">
      <form role="form" action="{{url('order/save')}}" method="post" id="quote_add" class="form-validate" data-parsley-validate >
        <div class="col-md-12">
          <div id="table-list"  style="display:block;">
              
            <table class="table table-bordered" border="1">
              <tr class="row-temp">
                <td><div class="form-group">
                    <label>Item code </label>
                    <input type="text" class="form-control"  placeholder="Item code" name="itm_code[]" data-parsley-required>
                  </div></td>
                <td><div class="form-group">
                    <label>Metal </label>
                    <select name="metal[]" class="form-control" data-parsley-required>
                      <option value="">Select Metal</option>
                        @if(count($metals)>0)
            			  @foreach($metals as $metal)
            			   <option value="{{$metal->id}}">{{$metal->metal_label}}</option>
             			  @endforeach
             			 @endif             
             		 </select>
                  </div></td>
                <td><div class="form-group">
                    <label>Ring Size </label>
                    <select name="ringsize[]" class="form-control" data-parsley-required>
                      <option value="">Select Ring Size</option>
                      <option value="na">NA</option>
                    @if(count($ringsizes)>0)
                        @foreach($ringsizes as $ringsize)
                          <option value="{{$ringsize->id}}">{{$ringsize->ring_size_label}}</option>
                        @endforeach
                    @endif             
                    </select>
                  </div></td>
                <td><div class="form-group">
                    <label>Description</label>
                    <textarea name="description[]" placeholder="Description" class="form-control"></textarea>
                  </div></td>
              <td rowspan="2" style="vertical-align:middle"><div class="btn-group">
                   <button type="button" id="add_row" class="btn btn-primary btn-sm add-row" title="Add New Row"><i class="fa fa-fw fa-plus"></i></button>
                    <button type="button" class="btn btn-danger btn-sm remove-row" title="Remove Row"><i class="fa fa-fw fa-minus"></i></button>
                  </div></td>
              </tr>
              <tr class="row-temp2">
                <td><div class="form-group">
                    <label>Quantity </label>
                    <input type="text" class="form-control quantity" placeholder="Quantity" name="quantity[]" data-parsley-required data-parsley-pattern="^[0-9]+$" data-parsley-pattern-message="Only digits are allowed ">
                  </div></td>
                <td><div class="form-group">
                    <label>Price </label>
                    <input type="text" class="form-control  price1" placeholder="Price" name="price[]" data-parsley-required data-parsley-pattern="^[0-9]+$" data-parsley-pattern-message="Only digits are allowed ">
                  </div></td>
                <td><div class="form-group">
                    <label>Total </label>
                    <input type="text" class="form-control total" placeholder="Total" name="total[]" readonly="readonly">
                  </div></td>
                <td><div class="form-group">
                    <label>Subtotal </label>
                    <input type="text" class="form-control subtotal" placeholder="Subtotal" name="subtotal[]" readonly="readonly">
                  </div></td>
              </tr>
            </table>
          </div>
        </div>
        <div class="col-md-12">
          <div class="form-group">
            <label>Delivery Method</label>
           <select class="form-control" name="delivery_method">
           <option value="">--select--</option>
            @if(count($methods)>0)
              @foreach($methods as $method)
               <option value="{{$method->id}}">{{$method->label}}</option>
              @endforeach
            @endif  
           </select>
          </div>
        </div>
        <div class="col-md-12">
          <div class="form-group">
            <label>Customer Notes</label>
           <textarea  class="form-control" name="customer_note" placeholder="Customer Notes"></textarea>
          </div>
        </div>
        <div class="col-md-12">
          <div class="form-group">
            <label>Staff Notes</label>
           <textarea  class="form-control" name="staff_note" placeholder="Staff Notes" data-parsley-required></textarea>
          </div>
        </div>
        <div class="col-md-12">
          <div class="form-group">
             <input type="hidden" name="_token" value="{{ csrf_token() }}">
             <input type="hidden" name="customer_id" @if(!empty($customer)) value="{{$customer->id}}" @endif />
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
            <input type="hidden" name="email" @if(!empty($customer)) value="{{$customer->id}}" @endif />
        	<button type="submit" class="btn btn-success">Submit</button>
        </div>
      </form>
    </div>
    </div>
  </div>
  </div>
</div>
<script>
<!----------------------form validation--------------------------->


$(document).ready(function(e) {
	//$('.form-validate').validator();
	
        $(".form-validate").validate({
					errorElement: 'span',
					errorClass: 'help-block',
					highlight: function(element, errorClass, validClass) {
						$(element).closest('.form-group').addClass("has-error");
					},
					unhighlight: function(element, errorClass, validClass) {
						$(element).closest('.form-group').removeClass("has-error");
					},
					
					 
             		rules: {
						"itm_code[]":{
							required: true,
						},
						"metal[]":{
							required: true,
						},
						"ringsize[]":{
							required: true,
						},
						"quantity[]":{
							required: true,
							digits:true,
						},
						"price[]":{
							required: true,
							digits:true,
						},
						"staff_note":{
							required: true,
						}
				}
      });
	});
 

	$(document).ready(function(e) {
		$('#customer_email').on('change',function(){
			var email=$(this).val();
$.ajax({
	type:'GET',
	url:"{{url('/quote/emailsearch')}}?email="+email,
	success: function(data){
		$('#customer_name').val(data.name);
		$('#customer_phone').val(data.phone);
	}
	});
	});
		
		$("#customer_email").autocomplete({
			source:"{{url('quote/customersearch')}}",
			minLength:3,
			 change: function (event, ui) {
                if(!ui.item){
                 $(this).val("");
                }
            },
			select: function (event, ui) {        
			//alert(ui.item.id);
			if(ui.item.id!=''){
			$('input[name="customer_id"]').val(ui.item.id);
			$('#table-list').slideDown();
			}
			return false;
			},
			}).data( "ui-autocomplete" )._renderItem = function( ul, item )
			{  
			return $( "<li></li>" )  
			.data( "item.autocomplete", item )  
			.append("<span class='email-list-address'><span class='email-list'>"+item.label+"</span></span>")  
			.appendTo( ul ); 
			};
	///////////////////////////////////////////add product row//////////////////////////////////////////////////
		$(document).on('click','.add-row',function(){

			if($(this).parents('table').find('input[name="itm_code[]"]').val()==''){
				alert('Enter item Code');
				$(this).parents('table').find('input[name="itm_code[]"]').focus();
								
			}
			else if($(this).parents('table').find('select[name="metal[]"]').val()==''){
				alert('Select metal');
				$(this).parents('table').find('select[name="metal[]"]').focus();
			}
			else if($(this).parents('table').find('select[name="ringsize[]"]').val()==''){
				alert('Select ring size');
				$(this).parents('table').find('select[name="ringsize[]"]').focus();
			}
			else if($(this).parents('table').find('input.quantity').val()==''){
				alert('Enter product quantity');
				$(this).parents('table').find('input.quantity').focus();
			}
			else if($(this).parents('table').find('input.price1').val()==''){
				alert('Enter product price');
				$(this).parents('table').find('input.price1').focus();
			}else{
				if($('#table-list table').length<=9){
				//	$(".form-validate").validationEngine('detach');
				var new_row_data = '<table class="table table-bordered">'+ $(this).parents('table').html() + '</table>';
					$(this).parents('#table-list').append(new_row_data);
					$(this).parent().find('.add-row').css('display','none');
		
				//$(".form-validate").validationEngine();
					
					return true;
				}else{
					alert('Max 10 row allows');	
				}
			}
})
	///////////////////////////////////////////remove product row//////////////////////////////////////////////////
		 
		  // setupValidation();
		$(document).on('click','.remove-row',function(){
			if($('#table-list table').length >= 2){
			  if(confirm('Are you sure?')){
				
  				$('table').parent().find('#add_row').css('display','block');
				  $(this).parents('table').remove();

			  }else {
				  return false;
			  }
			}else{
				alert("Can't delete single row");
			}
		})	
	});
 /////////////////////////////////////calculation//////////////////////////////////////////////////////////////////
 			$(document).on('blur','.quantity,.price1 ',function(){
				var quantity = 	 parseFloat($(this).parents('table').find('input.quantity').val());
				var price = 	 	parseFloat($(this).parents('table').find('input.price1').val());
				if(!isNaN(quantity) && !isNaN(price)){
  				$(this).parents('table').find('input.total').val((quantity*price).toFixed(2));
  				$(this).parents('table').find('input.subtotal').val((quantity*price).toFixed(2));
				}
				else {
				$(this).parents('table').find('input.total').val('');
				$(this).parents('table').find('input.subtotal').val('');
				}
			});
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

</script> 
@stop