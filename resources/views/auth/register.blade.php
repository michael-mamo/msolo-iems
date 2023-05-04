@include('admin.body.header')
@include('admin.body.script')
<body class="hold-transition login-page dark-mode">
  <div>
    <div class="card card-outline card-primary">
      <div class="card-header text-center">
        <a href="#" class="h1"><b>IEMS</b></a>
      </div>
      <div class="card-body">
        <p class="login-box-msg">Fill in the form to register</p>
        <form action = "{{route('user.register')}}" enctype ="multipart/form-data" method = "POST"> 
          @csrf
          <div class="card-body">
            <div class="row">
              <div class="col-md-6 col-sm-6 col-12 form-group">
                <label for="firstName" class="text-sm">First Name</label>
                <input type="text" name="name" class="form-control form-control-sm" id="firstName"
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
                <input name = "email" type="email" class="form-control form-control-sm" id="email"
                  placeholder="Type your email here">
                  @error('email')
                  <span class = "text-danger text-sm">{{$message}}</span>
                  @enderror
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 col-6 col-sm-12 form-group">
                <label for="usertype" class="text-sm">Subscription Type</label>
                <select disabled name="userType" class="form-control form-control-sm" id="usertype">
                  <option value="">--Choose usertype--</option>
                  <option selected value="5">Free Trial</option>
                </select>
                @error('usertype')
                <span class = "text-danger text-sm">{{$message}}</span>
                @enderror
              </div>
              <div class="col-md-6 col-6 col-sm-12 form-group">
                <label for="role" class="text-sm">Role</label>
                <select disabled name="role" class="form-control form-control-sm" id="role">
                  <option value="">--Choose Role--</option>
                  <option value="Admin">Admin</option>
                  <option selected value="User">User</option>
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
                <label for="password_confirmation" class="text-sm">Confirm Password</label>
                <input type="password" name="password_confirmation" class="form-control form-control-sm" id="password_confiramtion"
                  placeholder="confirm your password here">
                  @error('password_confirmation')
                  <span class = "text-danger text-sm">{{$message}}</span>
                  @enderror
              </div>
            </div>
            <div class = "row">
            <div class="col-6 col-md-6 col-sm-12 form-group">
              <label for="image" class="text-sm">Image</label>
              <div class="input-group">
                <div class="custom-file">
                  <input type="file" name = "image" class="form-control-sm" id="image">
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="text-center form-group">
                <img id = "showImage" src="{{(!empty($user->profile_photo_path))? url('uploads/userImages/'.$user->profile_photo_path): url('uploads/userImages/maleDefault.png')}}" width="100px" height="100px">
              </div>
            </div>
            </div>
          </div>
          <!-- /.card-body -->
          <div class="form-group">
            <button type="submit" class="btn btn-primary float-right">Register</button>
          </div>
        </form>
        <p class="mt-4 text-center">Already have an account?
          <a href="{{ route('login') }}" class="text-center">Sign in</a>
        </p>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
  <!-- /.login-box -->
  @include('admin.body.script')
</body>
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
  <script type="text/javascript" src="{{asset('backend/js/toastr.js')}}"></script>
	<script>
	@if(Session::has('message'))
	var type = "{{ Session::get('alert-type','info') }}"
	switch(type){
		case 'info':
		toastr.info(" {{ Session::get('message') }} ");
		break;

		case 'success':
		toastr.success(" {{ Session::get('message') }} ");
		break;

		case 'warning':
		toastr.warning(" {{ Session::get('message') }} ");
		break;

		case 'error':
		toastr.error(" {{ Session::get('message') }} ");
		break; 
	}
	@endif 
	</script>
</html>