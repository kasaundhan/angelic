@extends ('layouts.admin')
@section('content')
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Payment Method</h3>
              </div>
              <div class="row">
  	 
        <a href="{{url('payment/add')}}" class="btn btn-small btn-info">Add</a>
        

 <div class="col-md-12 col-sm-12 col-xs-12">
   		@if (Session::has('msg'))
   			<div class="alert alert-info col-xs-12 msg">{{ Session::get('msg') }}<button type="button" id="close" class="close">&times;</button>
            </div>
		@endif
			       <div class="x_panel">
                  <div class="x_title"><h2>Payment Method</h2>
                      <div class="clearfix"></div>
                  </div>
     
         <div class="x_content">
                <table class="table table-striped table-hover jambo_table">
                    <thead>
                        <tr>
                        	<th>Sn.</th>
                            <th>Label</th>
                            <th>Name</th>
                            <th>Enable</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                     @php $i=0 @endphp
                    @foreach($data as $result)
                        <tr>
                            <td>{{++$i}}</td>
                            <td>{{$result->label}}</td>
                            <td>{{$result->name}}</td>
                            <td>@if($result->enable==1) Yes @else No @endif</td>
                            <td>
                                <a class="btn btn-small btn-danger" onclick="return confirm('Are you sure you want to delete?'); " href="{{url('payment/delete')}}/{{$result->id}}"><i class="fa fa-trash"></i> Delete</a>
                                
                              
                                
                                <a class="btn btn-small btn-info" href="{{url('payment/edit')}}/{{$result->id}}"><i class="fa fa-pencil-square-o"></i> Edit</a>
                           </td>
                        </tr>
                     @endforeach
                </table>
			</div>
            <div>{{$data->links()}}</div>

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
</script>
@stop