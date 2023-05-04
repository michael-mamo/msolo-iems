@extends('admin.adminMaster')

@section('content')
<body class="hold-transition sidebar-mini dark-mode">
  <!-- Site wrapper -->
  <div class="wrapper">

    <!-- Include the navbar and the sidebar here -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>User Type</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item active">User Type</li>
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
                <button type="button" class="btn btn-primary float-left" data-toggle="modal" data-target="#modal-role">
                  Register <span class="fa fa-plus"></span>
                </button>
                <div class="modal fade" id="modal-role">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title">User Type Registration</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <form action="{{route('usertype.add')}}" method="POST">
                            @csrf
                          <div class="card-body">
                            <div class="form-group">
                              <label for="userType">User Type</label>
                              <input name="name" required type="text" class="form-control" id="userType"
                                placeholder="Type the user type Here">
                                @error('name')
                                <span class="text-danger text-sm">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                              <label for="duration">Duration</label>
                              <input name="duration" required type="number" class="form-control" id="duration" placeholder="Duration in month">
                                @error('duration')
                                <span class="text-danger text-sm">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                              <label>Description</label>
                              <textarea name="description" class="form-control" rows="4"
                                placeholder="Type some description about the user type"></textarea>
                                @error('description')
                                <span class="text-danger text-sm">{{$message}}</span>
                                @enderror
                            </div>
                          </div>
                          <div class="form-check">
                            <input type="checkbox" name="isActive" class="form-check-input" id="isActive">
                            <label class="form-check-label" for="isActive">is Active</label>
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
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>User Type</th>
                      <th>Duration</th>
                      <th>Description</th>
                      <th>Is Active</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                      @foreach($allData as $key=>$usertype)
                    <tr>
                      <td>{{$key+1}}</td>
                      <td>{{$usertype->name}}</td>
                      <td>{{$usertype->duration}} Months</td>
                      <td>{{$usertype->description}}</td>
                      <td>@if($usertype->isactive == 1)
                          Yes
                          @else
                          No
                          @endif
                      </td>
                      <td class="text-center">
                        <div class="btn-group bg-success">
                          <button type="button" class="btn btn-sm btn-secondary float-left" data-toggle="modal"
                            data-target="#modal-editRole{{$usertype->id}}">
                            <i class="fas fa-edit"></i></span>
                          </button>
                          <a href="{{route('usertype.delete', $usertype->id)}}" id="delete" type="button" class="btn btn-sm btn-danger">
                            <i class="fas fa-trash"></i>
                          </a>
                        </div>
                      </td>
                    </tr>
                    <div class="modal fade text-left" id="modal-editRole{{$usertype->id}}">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Edit {{$usertype->name}}</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{route('usertype.edit', $usertype->id)}}" method ="POST">
                                    @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                    <label for="editDuration">Duration</label>
                                    <input type="number" name="duration" value="{{$usertype->duration}}" class="form-control" id="editDuration"
                                        placeholder="Duration in month">
                                        @error('duration')
                                        <span class="text-danger text-sm">{{$message}}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                    <label>Description</label>
                                    <textarea name="description" class="form-control" rows="4"
                                        placeholder="Type some description about the role">{{$usertype->description}}</textarea>
                                        @error('description')
                                        <span class="text-danger text-sm">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-check">
                                    <input name = "isActive" type="checkbox" class="form-check-input" id="editIsActive" {{($usertype->isactive == '1'?"checked":"")}}>
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
                      <th>User Type</th>
                      <th>Duration</th>
                      <th>Description</th>
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
    <!-- Include the footer here -->
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
</body>
@endsection