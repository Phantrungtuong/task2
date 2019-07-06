<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
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
      <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
        <li class="active treeview">
            <li class=""><a href="{{route('getpost')}}"><i class="fa fa-circle-o"></i> Posts</a></li>

            <li class=""><a href="{{route('getcategory')}}"><i class="fa fa-circle-o"></i> Categories</a></li>

            <li class=""><a href="{{route('gettag')}}"><i class="fa fa-circle-o"></i> Tags</a></li>

            <li class=""><a href="{{route('getuser')}}"><i class="fa fa-circle-o"></i> Users</a></li>
            <li class=""><a href="{{route('getrole')}}"><i class="fa fa-circle-o"></i> Roles</a></li>
            <li class=""><a href="{{route('getpermission')}}"><i class="fa fa-circle-o"></i> Permissions</a></li>
        </li>
        
        
        
       
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>