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
                <h3>Quote</h3>
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
			 <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title"><h2>Add Quote</h2>
                      <div class="clearfix"></div>
                  </div>
     		
         <div class="x_content">
      <form role="form" action="{{url('quote/add')}}" method="post" id="quote_add" class="form-validate" data-parsley-validate >
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
                    <button type="button" class="btn btn-danger btn-sm remove-row" title="Remove Row"><i class="fa fa-fw fa-times"></i></button>
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
                <td></td>
              </tr>
            </table>
          </div>
        </div>
        <div class="col-md-12">
         <div class="form-group">
                    <label>Subtotal </label>
                    <input type="text" class="form-control subtotal" placeholder="Subtotal" name="subtotal" readonly="readonly">
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
$(document).on('blur','.price1 ',function(){
		var sum = 0;
$('.total').each(function()
{
		if($('.price1').val()!=''){
    sum += parseFloat($(this).val());
		}
});
$('.subtotal').val(sum);
});			
/*	 $('.quantity').each(function() {
			 var rate = parseFloat($(this).val());
			 var eachamount = $(this).parents('tr').find('input.amount').val();
 			if(exporttype==1) 
				{ 
					if(!isNaN(rate) && !isNaN(eachamount)){
					$(this).parents('tr').find('input.cgst').val((((eachamount*rate)/100)/2).toFixed(2));
					$(this).parents('tr').find('input.sgst').val(((eachamount*rate/100)/2).toFixed(2));
					$(this).parents('tr').find('input.igst').val('');
					}
				}*/
</script> 
@stop