@include('admin.body.header')

<!-- <body class="hold-transition login-page dark-mode"> -->
<body class="hold-transition login-page">
  <div class="login-box">
    <!-- /.login-logo -->
    <div class="card card-outline card-primary">
      <div class="card-header text-center">
        <a href="#" class="h1"><b>Forget Password</b></a>
      </div>
      <div class="card-body">
        <p class="login-box-msg">Please provide your phone number that you
          have used to create your account and we will send you your new password through sms</p>
        <form action="{{ route('password.email') }}" method="POST">
            @csrf
          <div class="input-group mb-1">
            <input type="text" name="email" class="form-control" placeholder="Type your phone number here">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-phone"></span>
              </div>
            </div>
          </div>
          @error('email')
          <span class="text-danger mb-1 mt-1"> This service is not working currently</span>
            <!-- <span class="text-danger">{{ $message }}</span> -->
          @enderror
          <div class="row">
            <!-- /.col -->
            <div class="col-12">
              <button type="submit" class="btn btn-primary btn-block">Send Password Reset link</button>
            </div>
            <!-- /.col -->
          </div>
        </form>
        <p class="mt-2 text-center">
          <a href="{{route('login')}}" class="text-center">Get back to login</a>
        </p>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
  <!-- /.login-box -->
  <!-- Include basic script -->
  @include('admin.body.script')
</body>
</html>
