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
              <h1>Saving</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item active">Saving</li>
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
                <div class="text-center">
                  <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#modal-saving">
                    New Saving <span class="fa fa-plus"></span>
                  </button>
                </div>
                <!-- list of registered roles in table -->
                <div class="row">
                  @foreach($mySavingData as $mySaving)
                  <div class="col-md-6" id="accordion">
                    <!-- Widget: user widget style 2 -->
                    <div class="card card-widget">
                      <!-- Add the bg color to the header using any of the bg-* classes -->
                      <div class="widget-user-header">
                        <div class="btn-group float-right">
                        <button type="submit" data-toggle="modal" data-target="#modal-edit-saving{{$mySaving->id}}"
                            class="btn btn-sm"><i class="fa fa-edit text-info"></i></button>
                        <a href="{{route('mySaving.complete', $mySaving->id)}}" id="complete" type="submit" class="btn btn-sm "><i class="fa fa-check text-success"></i></a>
                        <a href="{{route('mySaving.terminate', $mySaving->id)}}" id="terminate" type="submit" class="btn btn-sm "><i class="text-warning fa fa-times text-bold"></i></a>
                        <a href="{{route('mySaving.delete', $mySaving->id)}}" id="delete" type="submit" class="btn btn-sm "><i class="fa fa-trash text-danger"></i></a>
                        </div>
                        <br>
                        <h3 class="ml-2 mr-2 widget-user-username text-center mb-2"><b>{{$mySaving->title}}</b></h3>
                        <h5 class="ml-1 mr-1 widget-user-desc">Amount Saved: <i class="badge bg-success">{{number_format($mySaving->amount,2)}}</i></h5>
                        <h6 class="ml-1 mr-1 mb-2 widget-user-desc">Saving for: <i class="text-sm">{{$mySaving->savingfor}}</i></h6>
                        <h6 class="ml-1 mr-1 mb-2 widget-user-desc">Saving type: <i class="text-sm">{{ $mySaving['SavingType']['name'] }}</i></h6>
                      </div>
                      <div class="card-footer p-0">
                        <ul class="nav flex-column">
                          <li class="nav-item text-center">
                            <a href="#" class="nav-link text-bold">
                              Progress Completed {{number_format($progress = 100 - ($mySaving->targetamount-$mySaving->amount)/$mySaving->targetamount * 100, 2, '.', ',')}} %<div class="progress">
                              <div class="progress-bar bg-white" style="width:{{$progress}}%"></div>
                              </div>
                            </a>
                          </li>
                          <li class="nav-item">
                            <a href="" class="nav-link text-warning text-bold">
                              Status <span class="float-right badge {{($mySaving->status == 'Terminated'?'bg-danger':($mySaving->status == 'In Progress'?'bg-warning':'bg-success'))}}">{{$mySaving->status}}</span>
                            </a>
                          </li>
                          <li class="nav-item">
                            <a href="#" class="nav-link text-info text-bold">
                              Target Amount <span class="float-right badge bg-info">{{number_format($mySaving->targetamount,2, '.', ',')}}</span>
                            </a>
                          </li>
                          <li class="nav-item">
                            <a href="#" class="nav-link text-danger text-bold">
                              Amount Left <span class="float-right badge bg-danger">{{number_format($mySaving->targetamount - $mySaving->amount,2, '.', ',')}}</span>
                            </a>
                          </li>
                          @if($mySaving->status == 'In Progress')
                          <li class="nav-item">
                            <div class="card card-success card-outline text-sm">
                              <a class="d-block w-100" data-toggle="collapse" href="#collapseOne{{$mySaving->id}}">
                                <div class="card-header">
                                  <h4 class="card-title w-100 text-success text-bold">
                                    Deposit <span class="badge bg-success"> {{number_format($mySavingDepositData->where('savingid',$mySaving->id)->count())}} </span><button type="submit"
                                      data-toggle="modal" data-target="#modal-deposit{{$mySaving->id}}"
                                      class="btn btn-success btn-sm float-right">New <i
                                        class="fa fa-plus text-white"></i></button>
                                  </h4>
                                </div>
                              </a>
                              <div id="collapseOne{{$mySaving->id}}" class="collapse" data-parent="#accordion">
                                <div class="card-body">
                                  <table class="table table-stripped">
                                    <thead>
                                      <tr>
                                        <th>Date</th>
                                        <th>Amount</th>
                                        <th>Action</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      @foreach($mySavingDepositData as $mySavingDeposit)
                                        @if($mySavingDeposit->savingid == $mySaving->id)
                                        <tr>
                                          <td>{{$mySavingDeposit->date}}</td>
                                          <td>{{$mySavingDeposit->amount}}</td>
                                          <td><a id='delete' href="{{route('mySavingDeposit.delete', $mySavingDeposit->id)}}" type="submit" class="btn float-right"><i
                                                class="fa fa-trash text-danger"></i></a></td>
                                        </tr>
                                        @endif
                                      @endforeach
                                    </tbody>
                                  </table>
                                </div>
                              </div>
                            </div>
                          </li>
                          <li class="nav-item">
                            <div class="card card-danger card-outline text-sm">
                              <a class="d-block w-100" data-toggle="collapse" href="#collapseTwo{{$mySaving->id}}">
                                <div class="card-header">
                                  <h4 class="card-title w-100 text-danger text-bold">
                                    Withdrawals <span class="badge bg-danger"> {{number_format($mySavingWithdrawalData->where('savingid',$mySaving->id)->count())}} </span><button type="submit"
                                      data-toggle="modal" data-target="#modal-withdrawal{{$mySaving->id}}"
                                      class="btn btn-danger btn-sm float-right">New <i
                                        class="fa fa-plus text-white"></i></button>
                                  </h4>
                                </div>
                              </a>
                              <div id="collapseTwo{{$mySaving->id}}" class="collapse" data-parent="#accordion">
                                <div class="card-body">
                                  <table class="table table-stripped">
                                    <thead>
                                      <tr>
                                        <th>Date</th>
                                        <th>Amount</th>
                                        <th>Action</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($mySavingWithdrawalData as $mySavingWithdrawal)
                                        @if($mySavingWithdrawal->savingid == $mySaving->id)
                                        <tr>
                                          <td>{{$mySavingWithdrawal->date}}</td>
                                          <td>{{$mySavingWithdrawal->amount}}</td>
                                          <td><a id='delete' href="{{route('mySavingWithdrawal.delete', $mySavingWithdrawal->id)}}" type="submit" class="btn float-right"><i
                                                class="fa fa-trash text-danger"></i></a></td>
                                        </tr>
                                        @endif
                                      @endforeach
                                    </tbody>
                                  </table>
                                </div>
                              </div>
                            </div>
                          </li>
                          @endif
                        </ul>
                      </div>
                    </div>
                    <!-- /.widget-user -->
                  </div>
                  <!-- Modal for editing saving -->
                  <div class="modal fade text-left" id="modal-edit-saving{{$mySaving->id}}">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h4 class="modal-title">Edit {{$mySaving->title}}</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <form action="{{route('mySaving.edit', $mySaving->id)}}" method="POST">
                            @csrf
                            <div class="card-body">
                              <div class="form-group">
                                <label for="title">Saving Title</label>
                                <input name="title" type="text" value="{{$mySaving->title}}" class="form-control" id="title" placeholder="Type title here">
                              </div>
                              <div class="form-group">
                                <label for="savingType">Saving Type</label>
                                <select name="savingType" id ="savingType" class="form-control">
                                  <option value="">--Choose Saving Type--</option>
                                  @foreach($savingTypeData as $savingType)
                                  <option value = "{{$savingType->id}}" {{$savingType->id == $mySaving->savingtypeid?"selected":""}}>{{$savingType->name}}</option>
                                  @endforeach
                                </select>
                              </div>
                              <div class="form-group">
                                <label for="savingFor">Saving For</label>
                                <input name="savingFor" value="{{$mySaving->savingfor}}" type="text" class="form-control" id="savingFor" placeholder="Type expense type here">
                              </div>
                              <div class="form-group">
                                <label for="targetAmount">Target Amount</label>
                                <input name ="targetAmount"  value="{{$mySaving->targetamount}}" type="number" min=0 step=".01" class="form-control" id="targetAmount"
                                  placeholder="Type target amount here">
                              </div>
                              <div class="form-group">
                                <label>Description</label>
                                <textarea name="description" class="form-control" rows="4" placeholder="Type some description"> {{$mySaving->description}}</textarea>
                              </div>
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
                  <!-- Modal for adding new deposit -->
                  <div class="modal fade" id="modal-deposit{{$mySaving->id}}">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h4 class="modal-title">New Deposit</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <form method="POST" action="{{route('mySavingDeposit.add', $mySaving->id)}}">
                            @csrf
                            <div class="card-body">
                              <div class="form-group">
                                <label for="depositDate">Date</label>
                                <input required name="date" type="date" class="form-control" id="depositDate">
                              </div>
                              <div class="form-group">
                                <label for="depositAmount">Amount</label>
                                <input required name="amount" type="number" step=".01" min="0" class="form-control" id="depositAmount"
                                  placeholder="Deposit amount here">
                              </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="form-group">
                              <button type="submit" class="btn btn-success float-right">Deposit</button>
                            </div>
                          </form>
                        </div>
                      </div>
                      <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                  </div>
                  <!-- Modal for adding withdrawal -->
                  <div class="modal fade" id="modal-withdrawal{{$mySaving->id}}">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h4 class="modal-title">New Withdrawal</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <form method="POST" action="{{route('mySavingWithdrawal.add', $mySaving->id)}}">
                            @csrf
                            <div class="card-body">
                              <div class="form-group">
                                <label for="depositDate">Date</label>
                                <input name='date' required type="date" class="form-control" id="depositDate">
                              </div>
                              <div class="form-group">
                                <label for="depositAmount">Amount</label>
                                <input required name ='amount' type="number" class="form-control" step=".01" min="0" id="depositAmount"
                                  placeholder="Withdrawal amount here">
                              </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="form-group">
                              <button type="submit" class="btn btn-danger float-right">Withdraw</button>
                            </div>
                          </form>
                        </div>
                      </div>
                      <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                  </div>
                  @endforeach
                </div>
                <!-- /.row -->
              </div>
              <!-- Modal for editing saving  -->
              <div class="modal fade" id="modal-saving">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title">Saving Registration</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <form action="{{route('mySaving.add')}}" method="POST">
                        @csrf
                        <div class="card-body">
                          <div class="form-group">
                            <label for="title">Saving Title</label>
                            <input name="title" type="text" class="form-control" id="title" placeholder="Type the title here">
                          </div>
                          <div class="form-group">
                            <label for="savingType">Saving Type</label>
                            <select id="savingType" name = "savingType" class="form-control">
                              <option value="">--Choose Saving Type--</option>
                              @foreach($savingTypeData as $savingType)
                              <option value="{{$savingType->id}}">{{$savingType->name}}</option>
                              @endforeach
                            </select>
                          </div>
                          <div class="form-group">
                            <label for="savingFor">Saving For</label>
                            <input name="savingFor" type="text" class="form-control" id="savingFor" placeholder="Type expense type here">
                          </div>
                          <div class="form-group">
                            <label for="amount">Amount</label>
                            <input name="amount" type="number" min=0 step=".01" class="form-control" id="amount"
                              placeholder="Type Amount here (in ETB)">
                          </div>
                          <div class="form-group">
                            <label for="targetAmount">Target Amount</label>
                            <input name="targetAmount" type="number" min=0 step=".01" class="form-control" id="targetAmount"
                              placeholder="Type target Amount here (in ETB)">
                          </div>
                          <div class="form-group">
                            <label>Description</label>
                            <textarea name="description" class="form-control" rows="4" placeholder="Type some description"></textarea>
                          </div>
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
