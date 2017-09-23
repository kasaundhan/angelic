     <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
               <img src="{{URL::asset('/resources/asset/images/image.jpg')}}" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
               
              </div>
              <div class="clearfix"></div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                  <li><a><i class="fa fa-home"></i> Customer <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{ url('/customer') }}">List</a></li>
                      <li><a href="{{ url('/customer/create') }}">Create</a></li>
                      <li><a href="{{ url('customer/addressbook') }}">Address book</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-edit"></i> Quote <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li> <a href="{{ url('/quote') }}">List</a></li>
                      @php $val=0 @endphp
                      <!--<li> <a href="{{url('/quote/add/')}}/{{$val}}">Create</a></li>-->
                    </ul>
                  </li>
                  <li><a><i class="fa fa-edit"></i> Order <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li> <a href="{{ url('/order') }}">List</a></li>
                     </ul>
                  </li>
                  <li>
                  <a><i class="fa fa-edit"></i> Advance <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li> <a href="{{ url ('/metals') }}">Metals</a></li>
                             <li>
                            <a href="{{ url ('/ringsize') }}">Ring Size</a>
                        </li>
                        <li>
                            <a href="{{ url ('/status') }}">Status</a>
                        </li>
                        <li>
                            <a href="{{ url ('/delivery') }}">Delivery Methods</a>
                        </li>
                        <li>
                            <a href="{{ url ('/payment') }}">Payment Methods</a>
                        </li>
                    </ul>
                  </li>
                  
                  
                  
                  
                </ul>
              </div>
        

            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
         
                  <a data-toggle="tooltip" data-placement="top" title="Logout" href="{{url('/logout')}}">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>

       
        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
           
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->
