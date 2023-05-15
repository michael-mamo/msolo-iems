
@extends('admin.adminMaster')
@section('content')
@php
    $userId = Auth::User()->id;
@endphp
<body class="hold-transition sidebar-mini dark-mode">
  <!-- Site wrapper -->
  <div class="wrapper">
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>My Profile</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item active">My Profile</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>
      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <form method = "POST" enctype ="multipart/form-data" action="{{route('profile.edit')}}">
                     @csrf
                    <div class="card-body">
                    <div class="row">
                        <div class="col-12 form-group">
                            <label for="editFirstName" class="text-sm">First Name</label>
                            <input type="text" name = "name" value="{{$profileData->name}}" class="form-control form-control-sm"
                                id="editFirstName" placeholder="Type your name here">
                            @error('name')
                                <span class = "text-danger text-sm">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-12 form-group">
                            <label for="editLastName" class="text-sm">Last Name</label>
                            <input type="text" name="lname" value="{{$profileData->lname}}" class="form-control form-control-sm" id="editLastName"
                                placeholder="Type your father name here">
                            @error('lname')
                                <span class = "text-danger text-sm">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-12 form-group">
                            <label for="editGender" class="text-sm">Gender</label>
                            <select name="gender" class="form-control form-control-sm" id="editGender">
                                <option value="">--Choose Gender--</option>
                                <option value="Male" {{$profileData->gender == 'Male'?"selected":""}}>Male</option>
                                <option value="Female" {{$profileData->gender == 'Female'?"selected":""}}>Female</option>
                            </select>
                            @error('gender')
                                <span class = "text-danger text-sm">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-12 form-group">
                            <label for="email" class="text-sm">Email</label>
                            <input type="email" value="{{$profileData->phonenumber}}" name = "phoneNumber" class="form-control form-control-sm" id="email"
                                placeholder="Type the email here">
                            @error('phoneNumber')
                                <span class = "text-danger text-sm">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-xs-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="editImage" class="text-sm">Image</label>
                                <input type="file" id="editImage" name="image" class="form-control-sm">
                            </div>
                        </div>
                        <div class="col-sm-12 col-xs-12 col-md-6 col-lg-6">
                            <div class="text-center form-group">
                                <img id = "showEditImage" src="{{(!empty($profileData->profile_photo_path))? url('uploads/userImages/'.$profileData->profile_photo_path): url('uploads/userImages/maleDefault.png')}}" width="100px" height="100px">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="form-group">
                    <a href="" type="button" class="float-left btn btn-secondary btn-flat" data-toggle="modal"
                            data-target="#modal-changePwd">Change pwd<span class="fa fa-key"></span></a>
                    <button type="submit" class="btn btn-success float-right">Update</button>
                    </div>
                 </form>
                </div>
            </div>
        </div>
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
</section>
<script type="text/javascript">
    $(document).ready(function(){
        $('#image').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#showImage').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });
  </script>
  <script type="text/javascript">
      $(document).ready(function(){
        $('#editImage').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#showEditImage').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    })
    ;
  </script>
@endsection




