@extends('admin.adminMaster')

@section('content')
@php 
$userCount = 0;
@endphp 
  <!-- Theme style -->
<body class="hold-transition sidebar-mini dark-mode">
  <!-- Site wrapper -->
  <div class="wrapper">
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>User</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item active">User</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>
      <!-- Main content -->
      <section class="content">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <!-- /.card-header -->
              <div class="card-body">
                <a href="" type="button" class="btn btn-primary float-left" data-toggle="modal" data-target="#modal-user">
                  Register <span class="fa fa-plus"></span>
                </a>
                <div class="modal fade" id="modal-user">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title">User Registration</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                      <form action = "{{route('user.add')}}" enctype ="multipart/form-data" method = "POST"> 
                        @csrf
                        <div class="card-body">
                          <div class="row">
                            <div class="col-md-6 col-sm-6 col-12 form-group">
                              <label for="firstName" class="text-sm">First Name</label>
                              <input type="text" required name="name" class="form-control form-control-sm" id="firstName"
                                placeholder="Type first name here">
                                @error('name')
                                <span class = "text-danger text-sm">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="col-md-6 col-6 col-sm-12 form-group">
                              <label for="lastName"  class="text-sm">Last Name</label>
                              <input type="text" name = "lname" class="form-control form-control-sm" id="lastName"
                                placeholder="Type father name here">
                                @error('lname')
                                <span class = "text-danger text-sm">{{$message}}</span>
                                @enderror
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-6 col-6 col-sm-12 form-group">
                              <label for="gender" class="text-sm">Gender</label>
                              <select name = "gender" class="form-control form-control-sm" id="gender">
                                <option value="">--Choose Gender--</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                              </select>
                              @error('gender')
                              <span class = "text-danger text-sm">{{$message}}</span>
                              @enderror
                            </div>
                            <div class="col-md-6 col-6 col-sm-12 form-group">
                              <label for="email" class="text-sm">Email</label>
                              <input name = "email" required type="email" class="form-control form-control-sm" id="email"
                                placeholder="Type your email here">
                                @error('email')
                                <span class = "text-danger text-sm">{{$message}}</span>
                                @enderror
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-6 col-6 col-sm-12 form-group">
                              <label for="usertype" class="text-sm">User Type</label>
                              <select name="usertype" class="form-control form-control-sm" id="usertype">
                                <option value="">--Choose usertype--</option>
                                @foreach($usertypeData as $key=>$userType)
                                <option  value="{{$userType->id}}">{{$userType->name}}</option>
                                @endforeach
                              </select>
                              @error('usertype')
                              <span class = "text-danger text-sm">{{$message}}</span>
                              @enderror
                            </div>
                            <div class="col-md-6 col-6 col-sm-12 form-group">
                              <label for="role" class="text-sm">Role</label>
                              <select name="role" class="form-control form-control-sm" id="role">
                                <option value="">--Choose Role--</option>
                                <option value="Admin">Admin</option>
                                <option value="User">User</option>
                              </select>
                              @error('role')
                              <span class = "text-danger text-sm">{{$message}}</span>
                              @enderror
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-6 col-6 col-sm-12 form-group">
                              <label for="password" class="text-sm">Password</label>
                              <input type="password" name="password" class="form-control form-control-sm" id="password"
                                placeholder="Type password here">
                                @error('password')
                                <span class = "text-danger text-sm">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="col-md-6 col-6 col-sm-12 form-group">
                              <label for="password_confirmation" class="text-sm">confirm password</label>
                              <input type="password" name="password_confirmation" class="form-control form-control-sm" id="password_confiramtion"
                                placeholder="confirm your password here">
                                @error('password_confirmation')
                                <span class = "text-danger text-sm">{{$message}}</span>
                                @enderror
                            </div>
                          </div>
                          <div class="row">
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="editImage" class="text-sm">Image</label>
                                    <input type="file" name="image" class="form-control-sm" id="image">
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="text-center form-group">
                                    <img id="showImage" src="{{(!empty($user->profile_photo_path))? url('uploads/userImages/'.$user->profile_photo_path): url('uploads/userImages/maleDefault.png')}}" width="100px" height="100px">
                                </div>
                              </div>
                            </div>
                        </div>
                        <div class="form-check">
                          <input type="checkbox" name = "isActive" value="isActive" class="form-check-input" id="isActive">
                          <label class="form-check-label" for="isActive">Is Active</label>
                        </div>
                        <!-- /.card-body -->
                        <div class="form-group">
                          <button type="submit" class="btn btn-primary float-right">Register</button>
                        </div>
                      </form>
                      </div>
                    </div>
                    <!-- /.modal-content -->
                  </div>
                  <!-- /.modal-dialog -->
                </div>
                <!-- list of registered roles in table -->
                <table id="example1" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Full Name</th>
                      <th>Gender</th>
                      <th>Role</th>
                      <th>User Type</th>
                      <th>Is Active</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                      @foreach($userData as $key => $user)
                      @php 
                      $userCount+=1;
                      $no = $key+1;
                      @endphp
                    <tr>
                      <td>{{ $no }}</td>
                      <td>{{ $user->name." ".$user->lname}}</td>
                      <td>{{ $user->gender}}</td>
                      <td>{{ $user->role}}</td>
                      <td>{{ $user['Usertype']['name'] }}</td>
                      <td>@if($user->isactive == '1')
                          Yes
                          @else
                          No
                          @endif
                      </td>
                      <td class="text-center">
                        <div class="btn-group bg-success">
                          <a href="" type="button" class="btn btn-sm btn-secondary float-left" data-toggle="modal"
                            data-target="#modal-edit{{$user->id}}">
                            <i class="fas fa-edit"></i></span>
                          </a>
                          <a id="delete" href="{{route('user.delete', $user->id)}}" type="button" class="btn btn-sm btn-danger">
                            <i class="fas fa-trash"></i>
                          </a>
                        </div>
                      </td>
                    </tr>
                <div class="modal fade text-left" id="modal-edit{{$user->id}}">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title">Edit {{$user->email}}</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <form method = "POST" enctype ="multipart/form-data" action="{{route('user.edit', $user->id)}}">
                          @csrf
                          <div class="card-body">
                            <div class="row">
                              <div class="col-md-6 col-sm-6 col-12 form-group">
                                <label for="editFirstName" class="text-sm">First Name</label>
                                <input type="text" name = "name" value="{{$user->name}}" class="form-control form-control-sm"
                                  id="editFirstName" placeholder="Type your name here">
                                @error('name')
                                  <span class = "text-danger text-sm">{{$message}}</span>
                                @enderror
                              </div>
                              <div class="col-md-6 col-6 col-sm-12 form-group">
                                <label for="editLastName" class="text-sm">Last Name</label>
                                <input type="text" name="lname" value="{{$user->lname}}" class="form-control form-control-sm" id="editLastName"
                                  placeholder="Type your father name here">
                                @error('lname')
                                  <span class = "text-danger text-sm">{{$message}}</span>
                                @enderror
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-md-6 col-sm-6 col-12 form-group">
                                <label for="editGender" class="text-sm">Gender</label>
                                <select name="gender" class="form-control form-control-sm" id="editGender">
                                  <option value="">--Choose Gender--</option>
                                  <option value="Male" {{$user->gender == 'Male'?"selected":""}}>Male</option>
                                  <option value="Female" {{$user->gender == 'Female'?"selected":""}}>Female</option>
                                </select>
                                @error('gender')
                                  <span class = "text-danger text-sm">{{$message}}</span>
                                @enderror
                              </div>
                              <div class="form-group col-md-6 col-sm-6 col-12">
                                <label for="editRole" class="text-sm">Role</label>
                                <select name="role" class="form-control form-control-sm" id="editRole">
                                <option value="">--Choose role--</option>
                                  <option {{$user->role == 'Admin'?"selected":""}} value = "Admin">Admin</option>
                                  <option {{$user->role == 'User'?"selected":""}} value = "User" >User</option>
                                </select>
                                @error('role')
                                  <span class = "text-danger text-sm">{{$message}}</span>
                                @enderror
                              </div>
                            </div>
                            <div class="row">
                              <div class="form-group col-md-6 col-sm-6 col-12">
                                <label for="editUserType" class="text-sm">User Type</label>
                                <select name="usertype" class="form-control form-control-sm " id="editUserType">
                                  <option value="">--Choose Usertype--</option>
                                  @foreach($usertypeData as $key=>$userType)
                                  <option value="{{$userType->id}}"  {{$user->usertype == $userType->id?"selected":""}}>{{$userType->name}}</option>
                                  @endforeach
                                </select>
                                @error('usertype')
                                  <span class = "text-danger text-sm">{{$message}}</span>
                                @enderror
                              </div>
                              <div class="col-md-6 col-6 col-sm-12 form-group">
                                <label for="newPassword" class="text-sm">New Password</label>
                                <input type="text" name = "newPassword" class="form-control form-control-sm" id="newPassword"
                                  placeholder="Type new password here">
                                @error('newPassword')
                                  <span class = "text-danger text-sm">{{$message}}</span>
                                @enderror
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="editImage" class="text-sm">Image</label>
                                    <input type="file" id="editImage{{$no}}" name="image" class="form-control-sm">
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="text-center form-group">
                                    <img id = "showEditImage{{$no}}" src="{{(!empty($user->profile_photo_path))? url('uploads/userImages/'.$user->profile_photo_path): url('uploads/userImages/maleDefault.png')}}" width="100px" height="100px">
                                  </div>
                              </div>
                            </div>
                          </div>
                          
                          <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="editIsActive" name ="isActive" {{ $user->isactive == 1?"checked":""}}  >
                            <label class="form-check-label" for="editIsActive">Is Active</label>
                          </div>
                          <!-- /.card-body -->
                          <div class="form-group">
                            <button type="submit" class="btn btn-success float-right">Save</button>
                          </div>
                        </form>
                      </div>
                    </div>
                    <!-- /.modal-content -->
                  </div>
                  <!-- /.modal-dialog -->
                </div>
                  @endforeach
                  </tbody>
                  <tfoot>
                    <tr>
                      <th>No</th>
                      <th>Full Name</th>
                      <th>Gender</th>
                      <th>Role</th>
                      <th>User Type</th>
                      <th>Is Active</th>
                      <th>Action</th>
                    </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
      </section>
    </div>
    <!-- /.content-wrapper -->
  </div>
  <!-- ./wrapper -->
  <script>
    $(function () {
      $("#example1").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });
    });
  </script>
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
    var userCount = {{$userCount}};
    for(var i=1; i<=userCount; i++){
      $(document).ready(function(){
        $('#editImage'+i).change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#showEditImage'+i).attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    })
    }
    ;
  </script>
@endsection