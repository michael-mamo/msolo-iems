@if(Auth::User()->isactive == '1')
<!-- Navbar -->
<nav id="navBarToggle" class="main-header navbar navbar-expand navbar-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
  </ul>

  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">
    <!-- Notifications Dropdown Menu -->
    <li class="nav-item dropdown user-menu">
      <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
      @php
      $profile = Auth::User()->profile_photo_path;
      $name = Auth::User()->name;
      $fullName = Auth::User()->name.' '.Auth::User()->lname;
      $role = Auth::User()->role;
      $reg_date = Auth::User()->created_at;
      @endphp
        <img src="{{(!empty(Auth::User()->profile_photo_path))? url('uploads/userImages/'.$profile): url('uploads/userImages/maleDefault.png')}}" class="user-image img-circle elevation-2" alt="User Image">
        <span class="d-none d-md-inline">{{$name}}</span>
      </a>
      <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <!-- User image -->
        <li class="user-header">
          <img src="{{(!empty(Auth::User()->profile_photo_path))? url('uploads/userImages/'.$profile): url('uploads/userImages/maleDefault.png')}}" class="img-circle elevation-2" alt="User Image">

          <p>
            {{$fullName}} - {{$role}}
            <small>Since {{$reg_date}}</small>
          </p>
        </li>
        <!-- Menu Footer-->
        <li class="user-footer">
          <a href="#" class="btn btn-secondary btn-flat">Change pwd<span class="fa fa-key"></span></a>
          <a href="{{ route('logout')}}" class="btn btn-danger btn-flat float-right">Logout <span class="fa fa-power-off"></span></a>
        </li>
      </ul>
    </li>
    <!-- <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="flag-icon flag-icon-us"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right p-0">
          <a href="#" class="dropdown-item active">
            <i class="flag-icon flag-icon-us mr-2"></i> English
          </a>
          <a href="#" class="dropdown-item">
            <i class="flag-icon flag-icon-de mr-2"></i> German
          </a>
          <a href="#" class="dropdown-item">
            <i class="flag-icon flag-icon-fr mr-2"></i> French
          </a>
          <a href="#" class="dropdown-item">
            <i class="flag-icon flag-icon-es mr-2"></i> Spanish
          </a>
        </div>
    </li> -->
    <li class="nav-item">
      <a class="nav-link" data-widget="fullscreen" href="#" role="button">
        <i class="fas fa-expand-arrows-alt"></i>
      </a>
    </li>
    <!-- Language Dropdown Menu -->

    <li class="nav-item">
      <!-- <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
        <i class="fas fa-th-large"></i>
      </a> -->
      <a class="nav-link" href="#" ><i id="darkIcon" onclick="toggleDark()" class="fa fa-moon"></i></a>

    </li>
  </ul>
</nav>
<!-- /.navbar -->
@endif
