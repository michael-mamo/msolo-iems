@extends('admin.adminMaster')
@section('content')
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
              <h1>Tutorial</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="">Dashboard</a></li>
                <li class="breadcrumb-item active">Tutorial</li>
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
                <button type="button" class="btn btn-primary float-left" data-toggle="modal"
                  data-target="#modal-tutorial">
                  Add <span class="fa fa-plus"></span>
                </button>
                <div class="modal fade" id="modal-tutorial">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title">Add tutorial</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <form action="{{route('tutorial.add')}}" enctype ="multipart/form-data" method="POST">
                          @csrf
                          <div class="card-body">
                            <div class="row">
                              <div class="col-md-6 col-sm-6 col-6 form-group">
                                <label for="title text-sm">Title</label>
                                <input name="title" type="text" class="form-control form-control-sm" id="title"
                                  placeholder="Type title here">
                                  @error('title')
                                  <span class="text-danger text-sm">{{$message}}</span>
                                  @enderror
                              </div>
                              <div class=" col-md-6 col-6 col-sm-6 form-group">
                                <label for="subTitle text-sm">Subtitle</label>
                                <input name="subTitle" type="text" class="form-control form-control-sm" id="subTitle"
                                  placeholder="Type subtitle here">
                                  @error('subTitle')
                                  <span class="text-danger text-sm">{{$message}}</span>
                                  @enderror
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="description">Description</label>
                              <textarea name="description" placeholder="Type some descrition here"
                                class="form-control" id="description" cols="30" rows="4"></textarea>
                                @error('description')
                                  <span class="text-danger text-sm">{{$message}}</span>
                                  @enderror
                            </div>
                            <div class="form-group">
                              <label for="file">File</label>
                              <div class="input-group">
                                  <input name="video" type="file" id="video">
                                  @error('description')
                                  <span class="text-danger text-sm">{{$message}}</span>
                                  @enderror
                              </div>
                            </div>
                          </div>
                          <div class="form-check">
                            <input name="isActive" type="checkbox" class="form-check-input" id="isActive">
                            <label class="form-check-label" for="isActive">Is Active</label>
                          </div>
                          <!-- /.card-body -->
                          <div class="form-group">
                            <button type="submit" class="btn btn-primary float-right">Add</button>
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
                      <th>Title</th>
                      <th>Subtitle</th>
                      <th>File</th>
                      <th>Is Active</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach($allData as $key=>$tutorial)
                    <tr>
                      <td>{{$key+1}}</td>
                      <td>{{$tutorial->title}}</td>
                      <td>{{$tutorial->subtitle}}</td> 
                      <td class="text-center"><video height="100px" width="100px" controls src="{{url('uploads/tutorials/'.$tutorial->file)}}"></video></td>
                      <td>@if($tutorial->isactive == '1')
                          Yes
                          @else
                          No
                          @endif
                      </td>
                      <td class="text-center">
                        <div class="btn-group bg-success">
                          <button type="button" class="btn btn-sm btn-secondary float-left" data-toggle="modal"
                            data-target="#modal-editTutorial{{$tutorial->id}}">
                            <i class="fas fa-edit"></i></span>
                          </button>
                          <a href="{{route('tutorial.delete', $tutorial->id)}}" type="button" id="delete" class="btn btn-sm btn-danger">
                            <i class="fas fa-trash"></i>
                          </a>
                        </div>
                      </td>
                    </tr>
                    <div class="modal fade text-left" id="modal-editTutorial{{$tutorial->id}}">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h4 class="modal-title">Edit {{$tutorial->title}}</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <form action="{{route('tutorial.edit', $tutorial->id)}}" method="POST">
                              @csrf
                              <div class="card-body">
                                <div class="row">
                                  <div class="col-md-6 col-sm-6 col-6 form-group">
                                    <label for="editTitle text-sm">Title</label>
                                    <input name="title" type="text" value="{{$tutorial->title}}"
                                      class="form-control form-control-sm" id="editTitle" placeholder="Type your name here">
                                  </div>
                                  <div class=" col-md-6 col-6 col-sm-6 form-group">
                                    <label for="subtitle text-sm">Sub Title</label>
                                    <input type="text" name="subTitle" value="{{$tutorial->subtitle}}"
                                      class="form-control form-control-sm" id="subtitle"
                                      placeholder="Type your father name here">
                                      @error('subtitle')
                                      <span class="text-danger text-sm">{{$message}}</span>
                                      @enderror
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label for="description">Description</label>
                                  <textarea name="description" placeholder="Type some descrition here"
                                    class="form-control" id="description" cols="30" rows="4">{{$tutorial->description}}</textarea>
                                    @error('description')
                                    <span class="text-danger text-sm">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                              <label for="file">File</label>
                                <div class="input-group">
                                    <input name="file" type="file" id="video">
                                    @error('video')
                                    <span class="text-danger text-sm">{{$message}}</span>
                                    @enderror
                                </div>
                              </div>
                              </div>
                              <div class="form-check">
                                <input type="checkbox" name="isActive" class="form-check-input" id="editIsActive" {{($tutorial->isactive==1?"checked":"")}} >
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
                      <th>Title</th>
                      <th>Subtitle</th>
                      <th>File</th>
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
    <!-- Include footer here -->
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