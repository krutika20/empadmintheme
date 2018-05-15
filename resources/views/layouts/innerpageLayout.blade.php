<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Employee | @yield('title')</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{ asset('/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('/bower_components/font-awesome/css/font-awesome.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ asset('/bower_components/Ionicons/css/ionicons.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('/bower_components/admin-lte/dist/css/AdminLTE.min.css') }}">

    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">

    <link rel="stylesheet" href="{{ asset('/bower_components/admin-lte/dist/css/skins/_all-skins.min.css') }}">

    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">

    <link rel="stylesheet" href="{{ asset('/bower_components/datatables.net-bs/css/responsive.bootstrap.min.css') }}">

     <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

    <!-- jQuery 3 -->
    <script src="{{ asset('/bower_components/jquery/dist/jquery.min.js')}}"></script>

    <!-- DataTables -->
    <script src="{{ asset('/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('/bower_components/datatables.net/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('/bower_components/datatables.net-bs/js/responsive.bootstrap.min.js') }}"></script>

    <script src="{{ asset('/bower_components/angular/angular.min.js') }}"></script>
    <script src="{{ asset('/bower_components/angular/angular-datatables.min.js') }}"></script>

</head>
<body class="skin-blue" ng-app="myApp">
<div class="wrapper">
    <!-- Integrate header here -->
    @include('layouts.header')

    <!-- Left side column. contains the logo and sidebar  and integrate side bar here -->
   @include('layouts.sidebar')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                @yield('title')

                <small>{{ $page_description or null }}</small>
            </h1>
            <!-- You can dynamically generate breadcrumbs here -->
            <ol class="breadcrumb">
                <li><a href="{{Url::to('/home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">@yield('page_name')</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Your Page Content Here -->
            @yield('content')
        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->

    <footer class="main-footer">
      <div class="pull-right hidden-xs">
        <b>Version</b> 2.4.0
      </div>
      <strong>Copyright &copy; 2014-2016 <a href="https://adminlte.io">Almsaeed Studio</a>.</strong> All rights reserved.
    </footer>

</div> <!-- wrapper -->

<!-- Control Sidebar -->
 <aside class="control-sidebar control-sidebar-dark">
   <!-- Create the tabs -->
   <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
     <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-users"></i> Online Users</a></li>

   </ul>
   <!-- Tab panes -->
   <div class="tab-content">
     <!-- Home tab content -->
     <div class="tab-pane" id="control-sidebar-home-tab">

       <ul class="control-sidebar-menu list_users">
         <li>
           <a href="javascript:void(0)">

                 <img class="direct-chat-img online_css" src="{{ asset('/bower_components/admin-lte/dist/img/user3-128x128.jpg')}}" alt="Message User Image"><!-- /.direct-chat-img -->
                 <label class="control-sidebar-subheading">
                      Boxed Layout
                     <input type="radio" data-layout="layout-boxed" class="pull-right custom_radio">
                     <p>Hi How are you</p>
                 </label>
            </a>

         </li>



       </ul>
       <!-- /.control-sidebar-menu -->
     </div>
     <!-- /.tab-pane -->

   </div>
 </aside>
 <!-- /.control-sidebar -->

<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('/bower_components/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->



<script>
  $.widget.bridge('uibutton', $.ui.button);
  var _globalObj = "{{ csrf_token() }}"
  var base_url = '{{URL::to("/")}}';
</script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ asset('/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('/bower_components/admin-lte/dist/js/adminlte.min.js') }}"></script>

<script type="text/javascript" src="{{ asset('js/custom.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/angularcontroller.js') }}"></script>
<!--<script src="{{ asset('js/echo.js') }}"></script>

<script src="https://js.pusher.com/4.1/pusher.min.js"></script>
<script src="{{ asset('js/custom_pusher.js') }}"></script>-->
</body>
</html>
