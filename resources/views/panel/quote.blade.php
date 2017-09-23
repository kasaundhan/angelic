@extends ('layouts.admin')
@section('content')
@php use App\models\QuoteItem @endphp 
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
                <h3>Quote</h3>
              </div>
              <div class="row">  
             <!--  <a href="{{url('quote/add')}}" class="btn btn-small btn-info">Create Quote</a>-->
    
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
                <input type="text" class="form-control" name="first_name" id="first_name" value="" />
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <label>Last Name</label>
                <input type="text"  class="form-control" name="last_name" id="last_name" value="" />
              </div>
            </div>
          </div>
          <div class="col-lg-12">
            <div class="col-lg-6">
              <div class="form-group">
                <label>Quote Id</label>
                <input type="text" class="form-control" name="quote_id" id="quote_id" value="" />
              </div>
            </div>
  
          </div>
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
  </div>
           <div class="row">    
 <div class="col-md-12 col-sm-12 col-xs-12">
			 <div class="x_panel">
                  <div class="x_title"><h2>Quotes</h2>
                      <div class="clearfix"></div>
                  </div>
         <div class="x_content" id="result">
                <table class="table table-hover table-striped jambo_table">
                    <thead>
                        <tr>
                        <th>Sn.</th>
                        <th>Quote Number</th>
                        <th>Date and Time</th>
                        <th>Name and Email Address</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th>Action</th>
                        </tr>
                    </thead>
                     @php $i=0 @endphp
                    @foreach($data as $result)
                        <tr>
                           <td>{{++$i}}</td>
                           <td>{{$result->quote_id}}</td>
 	                       <td>{{date('d-m-Y H:i',strtotime($result->created_at))}}</td>
                           <td>{{$result->customer->first_name}} {{$result->customer->last_name}}<br />{{$result->customer->email}}</td>
                           <td>{{$result->quoteitems->sum('total')}}</td>
                           <td></td>
                           <td> 
                           	<a class="btn btn-small btn-danger" onclick="return confirm('Are you sure you want to delete?'); " href="{{url('quote/delete')}}/{{$result->id}}"><i class="fa fa-trash"></i> Delete</a>
                   			<a class="btn btn-small btn-info" href="{{url('quote/view')}}/{{$result->id}}"> View</a>
                            <a class="btn btn-small btn-success" href="{{url('quote/edit')}}/{{$result->id}}"><i class="fa fa-pencil-square-o"></i> Edit</a>
                            <a class="btn btn-small btn-primary" href="{{url('quote/pdf')}}/{{$result->id}}"><i class="fa fa-file-pdf-o"></i> Generate PDF</a>
                            <a class="btn btn-small btn-primary" href="{{url('quote/mail')}}/{{$result->id}}"><i class="fa fa-mail-forward"></i> Send Mail</a>
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