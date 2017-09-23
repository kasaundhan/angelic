@extends ('layouts.admin')
@section('content')
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Ring Size</h3>
              </div>
              <div class="row">    
        
 <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title"><h2>New</h2>
                      <div class="clearfix"></div>
                  </div>
     
         <div class="x_content">
	<form role="form" action="{{url('ringsize/add')}}" method="post" id="addringsize"  >
    	<div class="col-lg-6">
        	<h2></h2>
            <div class="form-group">
                <label>Label</label><span style="color:#F00">*</span>
                <input type="text" class="form-control" name="label" id="label" >
            </div>
            <div class="form-group">
                <label>Name</label>
                <input type="text"  class="form-control" name="name" id="name"  />
            </div>
             <div class="form-group">
	            <div class="checkbox">
                    <label>
                    <input type="checkbox" id="enable" name="enable" checked>Enable
                    </label>
                </div>
            </div>
        	<input type="hidden" name="_token" value="{{ csrf_token() }}">
        	<button type="submit" class="btn btn-primary" id="save">Submit</button>
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
        $("#addringsize").validate({
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