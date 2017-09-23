@extends ('layouts.admin')
@section('content')

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
                <h3>Order</h3>
              </div>
              <div class="row">  
            
   		@if (Session::has('msg'))
        <div class="alert alert-info col-xs-12 msg">{{ Session::get('msg') }}<button type="button" id="close" class="close">&times;</button>
            </div>
		@endif
         
  </div>
    <div class="row">    
 <div class="col-md-12 col-sm-12 col-xs-12">
			 <div class="x_panel">
                  
         <div class="x_content">
          <div class="form-group">
                <label>Search</label>
                <input type="text"  class="form-control" name="search" />
              </div>
         </div>
         </div>
         </div>
         </div>
         
           <div class="row">    
 <div class="col-md-12 col-sm-12 col-xs-12">
			 <div class="x_panel">
                  <div class="x_title"><h2>Orders</h2>
                      <div class="clearfix"></div>
                  </div>
         <div class="x_content" id="result">
                <table class="table table-hover table-striped jambo_table">
                    <thead>
                        <tr>
                        	<th>Sn.</th>
                            <th>Customer Name</th>
                            <th>Quote Code</th>
                            <th>Item Code</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                     @php $i=0 @endphp
                    @foreach($data as $result)
                        <tr>
                           <td>{{++$i}}</td>
                           <td>{{$result->customer->first_name}} {{$result->customer->last_name}}</td>
                           <td>{{ $result->order_id}}</td>
                           <td>
                            @php @$val=App\models\OrderItem::where('order_id',$result->id)->get() @endphp
                           {{ $val->implode('item_code', ', ') }} 
                           </td>
                           <td>{{date('d-m-Y',strtotime($result->created_at))}}</td>
                           <td>
                           	<a class="btn btn-small btn-danger" onclick="return confirm('Are you sure you want to delete?'); " href="{{url('order/delete')}}/{{$result->id}}"><i class="fa fa-trash"></i> Delete</a>
                   			<a class="btn btn-small btn-info" href="{{url('order/view')}}/{{$result->id}}"> View</a>
                            <a class="btn btn-small btn-success" href="{{url('order/edit')}}/{{$result->id}}"><i class="fa fa-pencil-square-o"></i> Edit</a>
                           </td>
                        </tr>
                     @endforeach
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
	var first=$('#first_name').val();
	var last=$('#last_name').val();
	var quote_id=$('#quote_id').val();
		$('.myoverlay').fadeIn();

    $.ajax({
        type: 'GET',
        url: "{{url('/quote/filter')}}",
        data:'first='+first+'&last='+last+'&quote_id='+quote_id,
        success: function (data) {
	//$("#result").load(document.URL + "#result");
      $('#result').html(data);
		}
    });
	$('.myoverlay').fadeOut();
});


   var page=1; 
	$(document).on('click','.more',function(e){
	var first=$('#first_name').val();
	var last=$('#last_name').val();
	var quote_id=$('#quote_id').val();
	page++;
	  var location= '{{url("/quote/filter")}}?page=' + page+'&first='+first+'&last='+last+'&quote_id='+quote_id;
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
	var first=$('#first_name').val();
	var last=$('#last_name').val();
	var quote_id=$('#quote_id').val();
	page--;
	  var location= '{{url("/quote/filter")}}?page=' + page+'first='+first+'&last='+last+'&quote_id='+quote_id;
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
@stop