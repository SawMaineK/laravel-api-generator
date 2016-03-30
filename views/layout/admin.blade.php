<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Admin-Generator</title>

    <link href="http://fonts.googleapis.com/css?family=Lato:100,300,400,700" media="all" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/stylesheets/bootstrap.min.css') }}" media="all" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/stylesheets/font-awesome.min.css') }}" media="all" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/stylesheets/se7en-font.css') }}" media="all" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/stylesheets/isotope.css') }}" media="all" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/stylesheets/isotope.css') }}" media="all" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/stylesheets/jquery.fancybox.css') }}" media="all" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/stylesheets/fullcalendar.css') }}" media="all" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/stylesheets/wizard.css') }}" media="all" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/stylesheets/select2.css') }}" media="all" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/stylesheets/morris.css') }}" media="all" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/stylesheets/datatables.css') }}" media="all" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/stylesheets/datepicker.css') }}" media="all" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/stylesheets/timepicker.css') }}" media="all" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/stylesheets/colorpicker.css') }}" media="all" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/stylesheets/bootstrap-switch.css') }}" media="all" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/stylesheets/bootstrap-editable.css') }}" media="all" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/stylesheets/daterange-picker.css') }}" media="all" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/stylesheets/typeahead.css') }}" media="all" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/stylesheets/summernote.css') }}" media="all" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/stylesheets/ladda-themeless.min.css') }}" media="all" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/stylesheets/social-buttons.css') }}" media="all" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/stylesheets/pygments.css') }}" media="all" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/stylesheets/style.css') }}" media="all" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/stylesheets/color/green.css') }}" media="all" rel="alternate stylesheet" title="green-theme" type="text/css" />
    <link href="{{ asset('admin/stylesheets/color/orange.css') }}" media="all" rel="alternate stylesheet" title="orange-theme" type="text/css" /><link href="{{ asset('admin/stylesheets/color/magenta.css') }}" media="all" rel="alternate stylesheet" title="magenta-theme" type="text/css" />
    <link href="{{ asset('admin/stylesheets/color/gray.css') }}" media="all" rel="alternate stylesheet" title="gray-theme" type="text/css" />
    <link href="{{ asset('admin/stylesheets/jquery.fileupload-ui.css') }}" media="screen" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/stylesheets/dropzone.css') }}" media="screen" rel="stylesheet" type="text/css" />

    <!--page level css-->
    @yield('header_styles')
    <!--end of page level css-->

    <!-- JavaScripts -->
    <script src="http://code.jquery.com/jquery-1.10.2.min.js" type="text/javascript"></script>
    <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js" type="text/javascript"></script>
    <script src="{{ asset('admin/javascripts/bootstrap.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin/javascripts/raphael.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin/javascripts/selectivizr-min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin/javascripts/jquery.mousewheel.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin/javascripts/jquery.vmap.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin/javascripts/jquery.vmap.sampledata.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin/javascripts/jquery.vmap.world.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin/javascripts/jquery.bootstrap.wizard.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin/javascripts/fullcalendar.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin/javascripts/gcal.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin/javascripts/jquery.dataTables.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin/javascripts/datatable-editable.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin/javascripts/jquery.easy-pie-chart.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin/javascripts/excanvas.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin/javascripts/jquery.isotope.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin/javascripts/isotope_extras.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin/javascripts/modernizr.custom.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin/javascripts/jquery.fancybox.pack.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin/javascripts/select2.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin/javascripts/styleswitcher.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin/javascripts/wysiwyg.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin/javascripts/typeahead.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin/javascripts/summernote.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin/javascripts/jquery.inputmask.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin/javascripts/jquery.validate.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin/javascripts/bootstrap-fileupload.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin/javascripts/bootstrap-datepicker.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin/javascripts/bootstrap-timepicker.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin/javascripts/bootstrap-colorpicker.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin/javascripts/bootstrap-switch.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin/javascripts/typeahead.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin/javascripts/spin.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin/javascripts/ladda.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin/javascripts/moment.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin/javascripts/mockjax.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin/javascripts/bootstrap-editable.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin/javascripts/xeditable-demo-mock.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin/javascripts/xeditable-demo.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin/javascripts/address.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin/javascripts/daterange-picker.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin/javascripts/date.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin/javascripts/morris.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin/javascripts/skycons.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin/javascripts/fitvids.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin/javascripts/jquery.sparkline.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin/javascripts/dropzone.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin/javascripts/main.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin/javascripts/respond.js') }}" type="text/javascript"></script>
    
</head>
<body class="page-header-fixed bg-2">
    <div class="modal-shiftfix">
        <!-- Navigation -->
        <div class="navbar navbar-fixed-top scroll-hide">
            <div class="container-fluid top-bar">
              <div class="pull-right">
                <ul class="nav navbar-nav pull-right">
                  <li class="dropdown notifications hidden-xs">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span aria-hidden="true" class="se7en-flag"></span>
                      <div class="sr-only">
                        Notifications
                      </div>
                      <p class="counter">
                        4
                      </p>
                    </a>
                    <ul class="dropdown-menu">
                      <li><a href="#">
                        <div class="notifications label label-info">
                          New
                        </div>
                        <p>
                          New user added: Jane Smith
                        </p></a>
                        
                      </li>
                      <li><a href="#">
                        <div class="notifications label label-info">
                          New
                        </div>
                        <p>
                          Sales targets available
                        </p></a>
                        
                      </li>
                      <li><a href="#">
                        <div class="notifications label label-info">
                          New
                        </div>
                        <p>
                          New performance metric added
                        </p></a>
                        
                      </li>
                      <li><a href="#">
                        <div class="notifications label label-info">
                          New
                        </div>
                        <p>
                          New growth data available
                        </p></a>
                        
                      </li>
                    </ul>
                  </li>
                  <li class="dropdown messages hidden-xs">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span aria-hidden="true" class="se7en-envelope"></span>
                      <div class="sr-only">
                        Messages
                      </div>
                      <p class="counter">
                        3
                      </p>
                    </a>
                    <ul class="dropdown-menu messages">
                      <li><a href="#">
                        <img width="34" height="34" src="{{ asset('admin/images/avatar-male2.png') }}" />Could we meet today? I wanted...</a>
                      </li>
                      <li><a href="#">
                        <img width="34" height="34" src="{{ asset('admin/images/avatar-female.png') }}" />Important data needs your analysis...</a>
                      </li>
                      <li><a href="#">
                        <img width="34" height="34" src="{{ asset('admin/images/avatar-male2.png') }}" />Buy Se7en today, it's a great theme...</a>
                      </li>
                    </ul>
                  </li>
                  <li class="dropdown user hidden-xs"><a data-toggle="dropdown" class="dropdown-toggle" href="#">
                    <img width="34" height="34" src="{{ asset('admin/images/avatar-male.jpg') }}" />John Smith<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                      <li><a href="#">
                        <i class="fa fa-user"></i>My Account</a>
                      </li>
                      <li><a href="#">
                        <i class="fa fa-gear"></i>Account Settings</a>
                      </li>
                      <li><a href="{{ asset('logout') }}">
                        <i class="fa fa-sign-out"></i>Logout</a>
                      </li>
                    </ul>
                  </li>
                </ul>
              </div>
              <button class="navbar-toggle"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button><a class="logo" href="index.html">se7en</a>
              <form class="navbar-form form-inline col-lg-2 hidden-xs">
                <input class="form-control" placeholder="Search" type="text">
              </form>
            </div>
            <div class="container-fluid main-nav clearfix">
              <div class="nav-collapse">
                <ul class="nav">
                  <li>
                    <a href="#"><span aria-hidden="true" class="se7en-home"></span>Dashboard</a>
                  </li>
                  <li><a href="#">
                    <span aria-hidden="true" class="se7en-feed"></span>Docs</a>
                  </li>
                  <li class="dropdown"><a href="{{ asset('admin/generators/create') }}">
                    <span aria-hidden="true" class="se7en-star"></span>New Model</a>
                  </li>
                  <li class="dropdown"><a data-toggle="dropdown" href="#">
                    <span aria-hidden="true" class="se7en-forms"></span>Models<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                    @include('layouts.menus')
                    </ul>
                  </li>
                  <li><a href="charts.html">
                    <span aria-hidden="true" class="se7en-charts"></span>Charts</a>
                  </li>
                  <li><a href="#">
                    <span aria-hidden="true" class="se7en-gallery"></span>APIs</a>
                  </li>
                </ul>
              </div>
            </div>
        </div>
        <!-- End Navigation -->
        <div class="container-fluid main-content">

        @yield('content')

        </div>
    </div>

    <div class="style-selector">
      <div class="style-selector-container">
        <h2>
          Layout Style
        </h2>
        <select name="layout"><option value="fluid">Fluid</option><option value="boxed">Boxed</option></select>
        <h2>
          Navigation Style
        </h2>
        <select name="nav"><option value="top">Top</option><option value="left">Left</option></select>
        <h2>
          Color Options
        </h2>
        <ul class="color-options clearfix">
          <li>
            <a class="blue" href="javascript:chooseStyle('none', 30)"></a>
          </li>
          <li>
            <a class="green" href="javascript:chooseStyle('green-theme', 30)"></a>
          </li>
          <li>
            <a class="orange" href="javascript:chooseStyle('orange-theme', 30)"></a>
          </li>
          <li>
            <a class="magenta" href="javascript:chooseStyle('magenta-theme', 30)"></a>
          </li>
          <li>
            <a class="gray" href="javascript:chooseStyle('gray-theme', 30)"></a>
          </li>
        </ul>
        <h2>
          Background Patterns
        </h2>
        <ul class="pattern-options clearfix">
          <li>
            <a class="active" href="#" id="bg-1"></a>
          </li>
          <li>
            <a href="#" id="bg-2"></a>
          </li>
          <li>
            <a href="#" id="bg-3"></a>
          </li>
          <li>
            <a href="#" id="bg-4"></a>
          </li>
          <li>
            <a href="#" id="bg-5"></a>
          </li>
        </ul>
        <div class="style-toggle closed">
          <span aria-hidden="true" class="se7en-gear"></span>
        </div>
      </div>
    </div>
    <!-- begin page level js -->
    @yield('footer_scripts')
    <!-- end page level js -->
    
</body>

</html>
