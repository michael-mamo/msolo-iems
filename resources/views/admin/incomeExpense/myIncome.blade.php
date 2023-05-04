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
              <h1>My Income</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item active">My Income</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>
      <!-- Main content -->
      <section class="content">
        <!-- Button for new expense -->
        <div class="row text-sm">
            <div class="col-md-12 col-12 callout callout-info">
                <div class="text-center">
                <h4 class = "text-gray float-left">My Income Data</h4>
                  <button type="button" class="btn btn-primary float-right btn-md" data-toggle="modal" data-target="#modal-newIncome">
                    New Income <span class="fa fa-plus"></span>
                  </button>
                </div>
            </div>
        </div>
        <!-- row -->
        <!-- Genetal expense widgets -->
        <div class="row">
          <div class="col-md-4 col-sm-6 col-12">
            <div class="info-box bg-orange">
              <span class="info-box-icon"><i class="fa fa-coins"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Today's Income ({{$todayDay}})</span>
                <span class="info-box-number">{{number_format($todayIncome, 2, '.', ',')}}</span>

                <div class="progress">
                  <div class="progress-bar" style="width: {{$differenceInDay}}%"></div>
                </div>
                  @if($differenceInDay > 0)
                  <span class="progress-description text-primary text-bold">
                   {{number_format($differenceInDay, 2, '.', ',')}} % Increase than yesterday
                   </span>
                   @elseif($differenceInDay < 0)
                   <span class="progress-description text-danger text-bold">
                   {{number_format($differenceInDay, 2, '.', ',')}} % Increase than yesterday
                   </span>
                   @elseif($differenceInDay == 0)
                   <span class="progress-description text-secondary text-bold">
                   0 % Increase than yesterday
                   </span>
                   @endif
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-4 col-sm-6 col-12">
            <div class="info-box bg-warning">
              <span class="info-box-icon"><i class="fa fa-coins"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">This Month Income ({{$todayMonth}})</span>
                <span class="info-box-number">{{number_format($thisMonthIncome, 2, '.', ',')}}</span>
                <div class="progress">
                  <div class="progress-bar" style="width: {{$differenceInMonth}}%"></div>
                </div>
                @if($differenceInMonth > 0)
                  <span class="progress-description text-primary text-bold">
                   {{number_format($differenceInMonth, 2, '.', ',')}} % Increase than Last Month
                   </span>
                   @elseif($differenceInMonth < 0)
                   <span class="progress-description text-danger text-bold">
                   {{number_format($differenceInMonth, 2, '.', ',')}} % Increase than Last Month
                   </span>
                   @elseif($differenceInMonth == 0)
                   <span class="progress-description text-secondary text-bold">
                   0 % Increase than Last Month
                   </span>
                   @endif
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-4 col-sm-6 col-12">
            <div class="info-box bg-green">
              <span class="info-box-icon"><i class="fa fa-coins"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">This Year Income ({{$todayYear}})</span>
                <span class="info-box-number">{{number_format($thisYearIncome, 2, '.', ',')}}</span>

                <div class="progress">
                  <div class="progress-bar" style="width: {{$differenceInYear}}%"></div>
                </div>
                @if($differenceInYear > 0)
                  <span class="progress-description text-primary text-bold">
                   {{number_format($differenceInYear, 2, '.', ',')}} % Increase than Last Year
                   </span>
                   @elseif($differenceInYear < 0)
                   <span class="progress-description text-danger text-bold">
                   {{number_format($differenceInYear, 2, '.', ',')}} % Increase than Last Year
                   </span>
                   @elseif($differenceInYear == 0)
                   <span class="progress-description text-secondary text-bold">
                   0 % Increase than Last Year
                   </span>
                   @endif
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
        </div>
        <!-- row -->
        <div class="row">
          <div class="col-12">
            <div class="card">
              <!-- /.card-header -->
              <div class="card-body">
                <div class="modal fade" id="modal-newIncome">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title">Add New Income </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                      <form method="POST" action="{{route('myIncome.add')}}">
                                            @csrf
                                            <div class="card-body card_addincome" id="card_addincome">
                                                <div class="form-group">
                                                    <label for="date">Date</label>
                                                    <input name='date' required type="date"
                                                        class="form-control form-control-sm" id="date">
                                                </div>
                                                <div class="row">
                                                    <div class="col-5">
                                                        <div class="row mb-0">
                                                            <div class="form-group col-12">
                                                                <select required name="incomeType[]"
                                                                    class="form-control form-control-sm"
                                                                    id="incomeType">
                                                                    <option value="">--Choose Income Type--</option>
                                                                    @foreach($incomeTypeData as $incomeType)
                                                                    <option value="{{$incomeType->id}}">
                                                                        {{$incomeType->name}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="form-group col-12">
                                                                <input name="amount[]" type="number" min=0 step=".01"
                                                                    class="form-control form-control-sm" id="amount"
                                                                    placeholder="Type the amount in Birr here">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-5">
                                                        <textarea name="description[]" id="" rows="3"
                                                            class="form-control form-control-sm"
                                                            placeholder="Some description about the income"></textarea>
                                                    </div>
                                                    <div class="col-2 text-center">
                                                        <span id="addincome" class="btn btn-success btn-sm addincome"><span
                                                                class="fas fa-plus"></span></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group text-center">
                                                <button type="submit" class="btn btn-primary">Add Income</button>
                                            </div>
                                        </form>
                      </div>
                    </div>
                    <!-- /.modal-content -->
                  </div>
                  <!-- /.modal-dialog -->
                </div>
                <!-- list of registered roles in table -->
                <table id="example1" class="table table-bordered table-striped table-sm">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Date</th>
                      <th>Income Type</th>
                      <th>Amount</th>
                      <th>Description</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($myIncomeData as $key=>$myIncome)
                    <tr>
                      <td>{{$key+1}}</td>
                      <td>{{$myIncome->date}}</td>
                      <td>{{ $myIncome['IncomeType']['name'] }}</td>
                      <td>{{$myIncome->amount}}</td>
                      <td>{{$myIncome->description}}</td>
                      <td class="text-center">
                        <div class="btn-group bg-success">
                          <button type="button" class="btn btn-sm btn-secondary float-left" data-toggle="modal"
                            data-target="#modal-editMyIncome{{$myIncome->id}}">
                            <i class="fas fa-edit"></i></span>
                          </button>
                          <a id='delete' href="{{route('myIncome.delete', $myIncome->id)}}"  type="button" class="btn btn-sm btn-danger">
                            <i class="fas fa-trash"></i>
                          </a>
                        </div>
                      </td>
                    </tr>
                    <div class="modal fade text-left" id="modal-editMyIncome{{$myIncome->id}}">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h4 class="modal-title">Edit My Income</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <form action="{{route('myIncome.edit', $myIncome->id)}}" method="POST">
                              @csrf
                              <div class="card-body">
                                <div class="form-group">
                                  <label for="date">Date</label>
                                  <input name='date' value="{{$myIncome->date}}" type="date" class="form-control" id="date">
                                </div>
                                <div class="form-group">
                                  <label for="editIncomeType">Income Type</label>
                                  <select name="incomeType" class="form-control" id="editIncomeType">
                                    <option value="">--Choose Income Type</option>
                                    @foreach($incomeTypeData as $incomeType)
                                    <option {{$incomeType->id == $myIncome->incometypeid?"selected":""}} value="{{$incomeType->id}}">{{$incomeType->name}}</option>
                                    @endforeach
                                  </select>
                                </div>
                                <div class="form-group">
                                  <label for="editAmount">Amount</label>
                                  <input name='amount' value="{{$myIncome->amount}}" type="number" min=0 step=".01" class="form-control" id="editAmount"
                                    placeholder="Type the ammount in Birr here">
                                </div>
                                <div class="form-group">
                                  <label for="description">Description</label>
                                  <textarea name='description' class="form-control" rows="4" id="description"
                                    placeholder="Type some description about the income">{{$myIncome->description}}</textarea>
                                </div>
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
                      <th>Date</th>
                      <th>Expense Type</th>
                      <th>Amount</th>
                      <th>Description</th>
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
        <div style="visibility:hidden;">
            <div class="whole_extra_item_add_income"
                id="whole_extra_item_add_income">
                <div class="delete_extra_item_income" id="delete_extra_item_income">
                    <div class="row">
                        <div class="col-5">
                            <div class="row">
                                <div class="form-group col-12">
                                    <select required name="incomeType[]"
                                        class="form-control form-control-sm"
                                        id="incomeType">
                                        <option value="">--Choose Income Type--
                                        </option>
                                        @foreach($incomeTypeData as $incomeType)
                                        <option value="{{$incomeType->id}}">
                                            {{$incomeType->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-12">
                                    <input name="amount[]" type="number" min=0
                                        step=".01"
                                        class="form-control form-control-sm"
                                        id="amount"
                                        placeholder="Type the amount in Birr here">
                                </div>
                            </div>
                        </div>
                        <div class="col-5">
                            <textarea name="description[]" id="" rows="3"
                                class="form-control form-control-sm"
                                placeholder="Some description about the income"></textarea>
                        </div>
                        <div class="col-2 text-center">
                            <span id="addincome" class="btn btn-success btn-sm addincome"><span
                                    class="fas fa-plus"></span></span>
                            <span id="removeincome" class="btn btn-danger btn-sm removeincome"><span
                                    class="fas fa-minus"></span></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
      </section>


  </div>
  <!-- SweetAlert2 -->
  <script src="assets/plugins/sweetalert2/sweetalert2.min.js"></script>
  <!-- Toastr -->
  <script src="assets/plugins/toastr/toastr.min.js"></script>
  <script type="text/javascript">
    $(document).ready(function(){
        $(document).on('click', '.addincome', function(){
            var whole_extra_item_add_income = $('#whole_extra_item_add_income').html();
            $(".card_addincome").append(whole_extra_item_add_income);
        });
        $(document).on('click', '.removeincome', function(event) {
            $(this).closest(".delete_extra_item_income").remove();
        });
    });
</script>
  <script>
    $(function () {
      $("#example1").DataTable({
        scrollX: true,
        "responsive": false, "lengthChange": true, "autoWidth": false,
        "buttons": [{
                extend: 'copyHtml5',
                exportOptions: {
                    columns: ':visible'
                },
                title: '{{$fullName}} \'s income as of date {{$todayDate}}'
            },
            {
                extend: 'excelHtml5',
                exportOptions: {
                    columns: ':visible'
                },
                title: '{{$fullName}} \'s income as of date {{$todayDate}}'
            },
            {
                extend: 'pdfHtml5',
                exportOptions: {
                    columns: ':visible'
                },
                title: '{{$fullName}} \'s income as of date {{$todayDate}}',
                customize: function (doc) {
                    doc.content[1].table.widths =
                        Array(doc.content[1].table.body[0].length + 1).join('*').split('');
                  }
            },
            {
              extend: 'csv',
                exportOptions: {
                    columns: ':visible'
                },
                title: '{{$fullName}} \'s income as of date {{$todayDate}}'
            },
            {
              extend: 'print',
                exportOptions: {
                    columns: ':visible',
                },
                title: '{{$fullName}} \'s income as of date {{$todayDate}}'
            },
            'colvis'
                ]
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
