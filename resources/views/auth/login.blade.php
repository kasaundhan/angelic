@extends ('layouts.plane')
@section ('body')
<div class="container">
  <div class="row">
    <div class="col-md-4 col-md-offset-4"> <br />
      <br />
      <br />
      @if ( count( $errors ) > 0 )
      @foreach ($errors->all() as $error)
      <div>{{ $error }}</div>
      @endforeach
      @endif
      
      @if(Session::has('error'))
      <div class="alert alert-warning alert-dismissible">
        <h4><i class="icon fa fa-warning"></i> {{Session::get('error')}}</h4>
      </div>
      @endif
      @section ('login_panel_title','Please Sign In')
      @section ('login_panel_body')
      <form role="form" method="POST" action="{{ route('login') }}">
        {{ csrf_field() }}
        <fieldset>
          <div class="form-group">
            <input class="form-control" placeholder="E-mail" name="email" type="email" autofocus>
          </div>
          <div class="form-group">
            <input class="form-control" placeholder="Password" name="password" type="password" value="">
          </div>
          <div class="checkbox">
            <label>
              <input name="remember" type="checkbox" value="Remember Me">
              Remember Me </label>
          </div>
          <!-- Change this to a button or input when using this as a form -->
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <button type="submit" class="btn btn-lg btn-success btn-block">Login</button>
        </fieldset>
      </form>
      @endsection
      @include('widgets.panel', array('as'=>'login', 'header'=>true)) </div>
  </div>
</div>
@stop