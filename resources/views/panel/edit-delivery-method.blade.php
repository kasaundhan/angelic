@extends ('layouts.admin')
@section('content')
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3> Delivery Method</h3>
              </div>
              <div class="row">    
        
 <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title"><h2>Edit Delivery Method</h2>
                      <div class="clearfix"></div>
                  </div>
     
         <div class="x_content">
                                    <form role="form" action="{{url('delivery/edit')}}" method="post" class="form-validate" >
                                         
                                <div class="form-group">
                <label>Label</label>
                <input type="text" class="form-control" name="label" id="label" value="{{$deliverymethod->label}}" >
            </div>
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text"  class="form-control" name="name" id="name" value="{{$deliverymethod->name}}" />
                                </div>
                                 <div class="form-group">
                                    <div class="checkbox">
                                        <label>
                                        <input type="checkbox" id="enable" name="enable" @if($deliverymethod->enable==1)checked @endif>Enable
                                        </label>
                                    </div>
                                </div>
        	<input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="id" value="{{$deliverymethod->id}}">
        	<button type="submit" class="btn btn-default" id="save">Update</button>            
                                    </form>
                                </div>
                                <!-- /.col-lg-6 (nested) -->
                               
                            </div>
                                 <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                 <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
        
<script>
<!----------------------form validation--------------------------->
$(document).ready(function(e) {
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
						label:{
							required: true,
						},
						name:{
							required: true,
						}	 
				}
      });    
});


</script>

@stop