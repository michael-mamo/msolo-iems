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
      $userId = Auth::User()->id;
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
          <a href=""  type="button" class="btn btn-secondary btn-flat" data-toggle="modal"
                            data-target="#modal-changePwd">Change pwd<span class="fa fa-key"></span></a>
          <a href="{{route('logout')}}" class="btn btn-danger btn-flat float-right">Logout <span class="fa fa-power-off"></span></a>
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
      <!-- <a href="#" data-widget="control-sidebar">Toggle me</a> -->
      <!-- <a href="#" data-widget="control-sidebar" data-controlsidebar-slide="false">Toggle Control Sidebar</a> -->
    </li>
  </ul>
</nav>
<!-- /.navbar -->
<div class="modal fade text-left" id="modal-changePwd">
    <div class="modal-dialog modal-dialog-sm">
    <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-title">Change Password</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
        <form method = "POST" action="{{route('profile.changepassword', $userId)}}">
            @csrf
            <div class="card-body">
            <div class="row">
                <div class="col-12 form-group">
                <label for="editFirstName" class="text-sm">Old Password</label>
                <input type="text" required name = "oldPassword" class="form-control form-control-sm"
                    id="editFirstName" placeholder="Type your old password here">
                @error('oldPassword')
                    <span class = "text-danger text-sm">{{$message}}</span>
                @enderror
                </div>
                <div class="col-12 form-group">
                <label for="newPassword" class="text-sm">New Password</label>
                <input type="password" required name="password" class="form-control form-control-sm" id="newPassword"
                    placeholder="Type your new password here">
                @error('newPassword')
                    <span class = "text-danger text-sm">{{$message}}</span>
                @enderror
                </div>
                <div class="col-12 form-group">
                <label for="confirmPassword"  class="text-sm">Confirm Password</label>
                <input type="password" required name="password_confirmation" class="form-control form-control-sm" id="confirmPassword"
                    placeholder="Confirm your new password here">
                @error('confirmPassword')
                    <span class = "text-danger text-sm">{{$message}}</span>
                @enderror
                </div>
            </div>
            </div>
            <!-- /.card-body -->
            <div class="text-center form-group">
            <button type="submit" class="btn btn-success">Change <i class="fa fa-key"></i></button>
            </div>
        </form>
        </div>
    </div>
    <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
@endif
