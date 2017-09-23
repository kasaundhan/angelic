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
      <form role="form" action="{{url('quote/update')}}" method="post" id="quote_update" class="form-validate" data-parsley-validate >
        <div class="col-md-12">
        @php $i=0 @endphp
        @if(!empty($quoteitem))
           @foreach($quoteitem as $quoteitems)
           @php $i++ @endphp
            <table class="table table-bordered" border="1">
              <tr class="row-temp">
                <td><div class="form-group">
           			<input type="hidden" id="quoteitemid" name="quoteitemid[]" value="{{$quoteitems->id}}">
                    <label>Item code </label>
                    <input type="text" class="form-control" placeholder="Item code" name="itm_code[]" value="{{$quoteitems->item_code}}" data-parsley-required>
                  </div></td>
                <td><div class="form-group">
                    <label>Metal </label>
                    <select name="metal[]" class="form-control" data-parsley-required>
                        @if(count($metals)>0)
            			  @foreach($metals as $metal)
            			   <option value="{{$metal->id}}" @if($quoteitems->metal==$metal->id) selected @endif>
                           {{$metal->metal_label}}</option>
             			  @endforeach
             			 @endif             
             		 </select>
                  </div></td>
                <td>
                <div class="form-group">
                    <label>Ring Size </label>
                    <select name="ringsize[]" class="form-control" data-parsley-required>
	               	 <option value="na" @if($quoteitems->ring=='na') selected @endif>NA</option>
                    @if(count($ringsizes)>0)
                        @foreach($ringsizes as $ringsize)
                          <option value="{{$ringsize->id}}" @if($quoteitems->ring==$ringsize->id) selected @endif>{{$ringsize->ring_size_label}}</option>
                        @endforeach


                    @endif 
            		</select>
                  </div></td>
                <td><div class="form-group">
                    <label>Description</label>
                    <textarea name="description[]" placeholder="Description" class="form-control">{{$quoteitems->description}}</textarea>
                  </div></td>
              <td rowspan="2" style="vertical-align:middle"><div class="btn-group">
                <?php /*?> @if($i==1)<button type="button" id="add_row" class="btn btn-primary btn-sm add-row" title="Add New Row"><i class="fa fa-fw fa-plus"></i></button>@endif<?php */?>
                    <button type="button" class="btn btn-danger btn-sm remove-row" title="Remove Row" id="{{$quoteitems->id}}"><i class="fa fa-fw fa-times"></i></button>
                  </div></td>
              </tr>
              <tr class="row-temp2">
                <td><div class="form-group">
                    <label>Quantity </label>
                    <input type="text" class="form-control quantity" placeholder="Quantity" name="quantity[]" data-parsley-required data-parsley-pattern="^[0-9]+$" data-parsley-pattern-message="Only digits are allowed" value="{{$quoteitems->quantity}}">
                  </div></td>
                <td><div class="form-group">
                    <label>Price </label>
                    <input type="text" class="form-control  price1" placeholder="Price" name="price[]" data-parsley-required data-parsley-pattern="^[0-9.]+$" data-parsley-pattern-message="Only digits are allowed" value="{{$quoteitems->price}}">
                  </div></td>
                <td><div class="form-group">
                    <label>Total </label>
                    <input type="text" class="form-control total" placeholder="Total" name="total[]" readonly="readonly" value="{{$quoteitems->total}}">
                  </div></td>
                <td><div class="form-group">
                    <label>Subtotal </label>
                    <input type="text" class="form-control subtotal" placeholder="Subtotal" name="subtotal[]" readonly="readonly" value="{{$quoteitems->subtotal}}">
                  </div></td>
              </tr>
            </table>
            @endforeach
            @endif
            <div id="table-list" style="display:block;">
            <table class="table table-bordered new-tab" border="1">
              <tr class="row-temp">
                <td><div class="form-group">
                    <label>Item code </label>
                    <input type="text" class="form-control"  placeholder="Item code" name="itm_code[]" >
                  </div></td>
                <td><div class="form-group">
                    <label>Metal </label>
                    <select name="metal[]" class="form-control">
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
                    <select name="ringsize[]" class="form-control">
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
                    <button type="button" class="btn btn-danger btn-sm remove-row" id="" title="Remove Row" style="display:none"><i class="fa fa-fw fa-times"></i></button>
                  </div></td>
              </tr>
              <tr class="row-temp2">
                <td><div class="form-group">
                    <label>Quantity </label>
                    <input type="text" class="form-control quantity" placeholder="Quantity" name="quantity[]">
                  </div></td>
                <td><div class="form-group">
                    <label>Price </label>
                    <input type="text" class="form-control  price1" placeholder="Price" name="price[]" >
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
           <label>Customer Notes</label>
           <textarea  class="form-control" name="customer_note" placeholder="Customer Notes"></textarea>
          </div>
        </div>
        <div class="col-md-12">
          <div class="form-group">
           <label>Staff Notes</label>
           <textarea  class="form-control" id="staff_note" name="staff_note" placeholder="Staff Notes">   @if(!empty($quoteitem)){{$quoteitem[0]->staff_note}}@endif
           </textarea>
          </div>
          
        </div>
        <div class="col-md-12">
          <div class="form-group">
             <input type="hidden" name="_token" value="{{ csrf_token() }}">
             <input type="hidden" name="customer_id" @if(!empty($customer)) value="{{$customer->id}}" @endif />
             <input type="hidden" name="quoteid" value="{{$quote->id}}">
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
<!--------------------------form validation--------------------------->
/*$('#quote_update').on('submit',function(){
	if(!$('#table-list').is(':visble')css('display')){
			$('#quote_update').parsley().destroy();
		}
	});*/
	$(document).ready(function(e) {
		if($('#quoteitemid').length==0){
			$('#table-list').css('display','block');
		}
	///if($('.table').length >0 || $('#table-list table').length >0){
		      
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
			  },
			  "staff_note":{
			  	required: true,
			  }
			}
		});
	 // }
	
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
			var new_row_data = '<table class="table table-bordered">'+ $(this).parents('table').html() + '</table>';
					
			$(this).parents('#table-list').append(new_row_data);
			$(this).parents('table').next('table').find('input,select').val('');
			$('#table-list').css('display','block');
			$(this).parents('table').find('.remove-row').css('display','block');
			$(this).parents('table').find('.add-row').css('display','none');
			return true;
		}else{
			alert('Max 10 row allows');	
		}
		}
	})
	///////////////////////////////////////////remove product row//////////////////////////////////////////////////
	
	$(document).on('click','.remove-row',function(){
			if($('table').length >1){
			  if(confirm('Are you sure?')){
				  	var id=$(this).attr('id');
	  //alert(id);
	 	 if(id!=''){
			//$('html,body').load("{{url('/quote/delete_quoteitem')}}?id="+id);
			$.ajax({
				type:'GET',
				url:"{{url('/quote/delete_quoteitem')}}?id="+id,
				success: function(data){
					if(data==1){
					 // $(this).closest('table').remove();
					 location.reload(true);

					}	
				}
				});
			 }
			 else {
				// $.find('table:last').find('.add-row').css('display','block');
				 $(this).closest('table').remove();
			  }
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

</script> 
@stop