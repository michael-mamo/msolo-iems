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
              <h1>Role</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="adminDashboard.html">Dashboard</a></li>
                <li class="breadcrumb-item active">Role</li>
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
                <a href="" type="button" class="btn btn-primary float-left" data-toggle="modal" data-target="#modal-role">
                  Register <span class="fa fa-plus"></span>
                </a>
                <div class="modal fade" id="modal-role">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title">Role Regstration</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <form method ="POST" action="{{route('role.add')}}">
                            @csrf
                          <div class="card-body">
                            <div class="form-group">
                              <label for="role">Role</label>
                              <input name = 'name' type="text" required class="form-control" id="role" placeholder="Type the role Here">
                              @error('name')
                              <span class = "text-danger text-sm">{{ $message }}</span>
                              @enderror
                            </div>
                            <div class="form-group">
                              <label>Description</label>
                              <textarea name = "description" class="form-control" rows="4" placeholder="Type some description"></textarea>
                              @error('description')
                              <span class = "text-danger text-sm">{{ $message }}</span>
                              @enderror
                            </div>
                          </div>
                          <div class="form-check">
                            <input name="isActive" type="checkbox" class="form-check-input" id="isActive">
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
                      <th>Role</th>
                      <th>Description</th>
                      <th>Is Active</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach($allData as $key => $role)
                    <tr>
                      <td>{{$key+1}}</td>
                      <td>{{$role->name}}</td>
                      <td>{{$role->description}}</td>
                      <td>@if($role->isactive == '1')
                          Yes
                          @else
                          No
                          @endif</td>
                      <td class="text-center">
                        <div class="btn-group bg-success">
                            <a href="" type="button" class="btn btn-sm btn-secondary float-left" data-toggle="modal"
                                data-target="#modal-editRole{{$role->id}}">
                                <i class="fas fa-edit"></i></span>
                            </a>
                            <a href="{{route('role.delete', $role->id)}}" type="button" id="delete" class="btn btn-sm btn-danger">
                                <i class="fas fa-trash"></i>
                            </a>
                        </div>
                      </td>
                    </tr>
                    <div class="modal fade" id="modal-editRole{{$role->id}}">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h4 class="modal-title">Edit {{$role->name}}</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <form action = "{{route('role.edit', $role->id)}}" method = "POST">
                              @csrf
                              <div class="card-body text-left">
                                <div class="form-group">
                                  <label>Description</label>
                                  <textarea name = "description" class="form-control" rows="4"
                                    placeholder="Type some description about the role">{{$role->description}}
                                  </textarea>
                                  @error('description')
                                  <span class = "text-danger text-sm">{{ $message }}</span>
                                  @enderror
                                </div>
                              </div>
                              <div class="form-check text-left">
                                <input name = "isActive" type="checkbox" class="form-check-input" id="editIsActive" {{ $role->isactive == 1?"checked":""}} >
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
                      <th>Role</th>
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
