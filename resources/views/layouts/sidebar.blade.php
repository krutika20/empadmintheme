<!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{ asset('/bower_components/admin-lte/dist/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{ Auth::user()->name }}</p>
          <!-- <a href="#"><i class="fa fa-circle text-success"></i> Online</a> -->
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li class="customli">
          <a href="{{ Url::to('/home') }}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
        </li>
        <li class="treeview customli">
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span>Employees tab</span>
            <!-- <span class="pull-right-container">
              <span class="label label-primary pull-right">4</span>
            </span> -->
          </a>
          <ul class="treeview-menu">
            
            <li><a href="{{ route('emp.create') }}"><i class="fa fa-circle-o"></i>Add new</a></li>
            <li><a href="{{ route('emp.index') }}"><i class="fa fa-circle-o"></i>List</a></li>
            
          </ul>
        </li>
        <li class="customli">
          <a href="{{ route('dtexample') }}"><i class="fa fa-dashboard"></i> <span>Data Table Example</span></a>
        </li>
        <li class="customli">
          <a href="{{ route('performance') }}"><i class="fa fa-dashboard"></i> <span>Employee Performance</span></a>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>