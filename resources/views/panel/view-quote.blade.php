@extends ('layouts.admin')
@section('content')
@php use App\models\Metals @endphp 
  <div class="right_col" role="main">
          <div class="">
          <div class="clearfix"></div>
            <div class="page-title">
              <div class="title_left">
                <h3>Quote(s) for {{$quote->customer->first_name." ".$quote->customer->last_name}}</h3>
              </div>
              <div class="row">
                  <div class="col-md-12 col-sm-12 col-xs-12">
                 @php $i=1 @endphp
         @foreach($quote_item as $result)    
            <div class="col-md-4 col-sm-4 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                  <h2> {{$i++}}  </h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link" title="minimize"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <form class="form-horizontal form-label-left">
                        <div>
                           <div class="form-group">
                            <label>Item Code :</label>	{{$result->item_code}}
                            </div>
                            <div class="form-group">
                            <label>Metal :</label>	@php @$m= Metals::find($result->metal) @endphp
                            {{$m->metal_name}}
                            </div>
                            @if($result->ring!='na')
                         	<div class="form-group">
                            <label>Ring Size :</label>@php @$r= App\models\Ringsize::find($result->ring) @endphp
                            {{$r->ring_size_name}}
                            </div>
                            @endif
                            <div class="form-group">
                            <label>Price :</label>	{{$result->price}}
                            </div>
                            <div class="form-group">
                            <label>Quantity :</label>	{{$result->quantity}}
                            </div>
                            <div class="form-group">
                            <label>Total :</label>	{{$result->subtotal}}
                            </div>
                            @if($result->customer_note!='')
                         	<div class="form-group">
                            <label>Customer Note :</label>
                            {{$result->customer_note}}
                            </div>
                            @endif
                         	<div class="form-group">
                            <label>Staff Note :</label>
                            {{$result->staff_note}}
                            </div>
                        </div>
                    </form>
                  </div>
                </div>
              </div>
          @endforeach
         </div>
</div>
</div>
</div>
</div>

@stop