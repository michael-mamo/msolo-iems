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
              <h1>My Expense</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item active">My Expense</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>
      <!-- Main content -->
      <section class="content">
        <!-- Genetal expense widgets -->
        <!-- row -->
        <div class="row text-sm">
            <div class="col-md-12 col-12 callout callout-info">
                <div class="text-center">
                <h4 class = "text-gray float-left">My Expense Data</h4>
                <button type="button" class="btn btn-primary float-right btn-md" data-toggle="modal" data-target="#modal-newExpense">
                  New Expense <span class="fa fa-plus"></span>
                </button>
                </div>
            </div>
        </div>
        <div class="row">
          <div class="col-md-4 col-sm-4 col-lg-4">
            <div class="info-box bg-orange">
              <span class="info-box-icon"><i class="fa fa-coins"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Today's Expense ({{$todayDay}})</span>
                <span class="info-box-number">{{number_format($todayExpense, 2, '.', ',')}}</span>

                <div class="progress">
                  <div class="progress-bar" style="width: {{$differenceInDay}}%"></div>
                </div>
                  @if($differenceInDay > 0)
                  <span class="progress-description text-danger text-bold">
                   {{number_format($differenceInDay, 2, '.', ',')}} % Increase than yesterday
                   </span>
                   @elseif($differenceInDay < 0)
                   <span class="progress-description text-primary text-bold">
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
          <div class="col-md-4 col-sm-4 col-lg-4">
            <div class="info-box bg-warning">
              <span class="info-box-icon"><i class="fa fa-coins"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">This Month Income ({{$todayMonth}})</span>
                <span class="info-box-number">{{number_format($thisMonthExpense, 2, '.', ',')}}</span>
                <div class="progress">
                  <div class="progress-bar" style="width: {{$differenceInMonth}}%"></div>
                </div>
                @if($differenceInMonth > 0)
                  <span class="progress-description text-danger text-bold">
                   {{number_format($differenceInMonth, 2, '.', ',')}} % Increase than Last Month
                   </span>
                   @elseif($differenceInMonth < 0)
                   <span class="progress-description text-primary text-bold">
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
          <div class="col-md-4 col-sm-4 col-lg-4">
            <div class="info-box bg-green">
              <span class="info-box-icon"><i class="fa fa-coins"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">This Year Income ({{$todayYear}})</span>
                <span class="info-box-number">{{number_format($thisYearExpense, 2, '.', ',')}}</span>

                <div class="progress">
                  <div class="progress-bar" style="width: {{$differenceInYear}}%"></div>
                </div>
                @if($differenceInYear > 0)
                  <span class="progress-description text-danger text-bold">
                   {{number_format($differenceInYear, 2, '.', ',')}} % Increase than Last Year
                   </span>
                   @elseif($differenceInYear < 0)
                   <span class="progress-description text-primary text-bold">
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
                <div class="modal fade" id="modal-newExpense">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title">Add New Expense </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                      <form method="POST" action="{{route('myExpense.add')}}">
                            @csrf
                            <div class="card-body card_addexpense" id="card_addexpense">
                                <div class="form-group">
                                    <label for="date">Date</label>
                                    <input name='date' required type="date"
                                        class="form-control form-control-sm" id="date">
                                </div>
                                <div class="row">
                                    <div class="col-5">
                                        <div class="row mb-0">
                                            <div class="form-group col-12">
                                                <select required name="expenseType[]"
                                                    class="form-control form-control-sm"
                                                    id="incomeType">
                                                    <option value="">--Choose Expense Type--</option>
                                                    @foreach($expenseTypeData as $expenseType)
                                                    <option value="{{$expenseType->id}}">
                                                        {{$expenseType->name}}</option>
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
                                            placeholder="Some description about the expense"></textarea>
                                    </div>
                                    <div class="col-2 text-center">
                                        <span id="addexpense" class="btn btn-success btn-sm addexpense"><span
                                                class="fas fa-plus"></span></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group text-center">
                                <button type="submit" class="btn btn-primary">Add Expense</button>
                            </div>
                        </form>
                      </div>
                    </div>
                    <!-- /.modal-content -->
                  </div>
                  <!-- /.modal-dialog -->
                </div>
                <!-- list of registered roles in table -->
                <table id="example1" class="table table-bordered table-striped table-sm dTable">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Date</th>
                      <th>Expense Type</th>
                      <th>Amount</th>
                      <th>Description</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($myExpenseData as $key=>$myExpense)
                    <tr>
                      <td>{{$key+1}}</td>
                      <td>{{$myExpense->date}}</td>
                      <td>{{$myExpense['ExpenseType']['name'] }}</td>
                      <td>{{$myExpense->amount}}</td>
                      <td>{{$myExpense->description}}</td>
                      <td class="text-center">
                        <div class="btn-group bg-success">
                          <button type="button" class="btn btn-sm btn-secondary float-left" data-toggle="modal"
                            data-target="#modal-editMyExpense{{$myExpense->id}}">
                            <i class="fas fa-edit"></i></span>
                          </button>
                          <a id='delete' href="{{route('myExpense.delete', $myExpense->id)}}"  type="button" class="btn btn-sm btn-danger">
                            <i class="fas fa-trash"></i>
                          </a>
                        </div>
                      </td>
                    </tr>
                    <div class="modal fade text-left" id="modal-editMyExpense{{$myExpense->id}}">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h4 class="modal-title">Edit My Expense</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <form action="{{route('myExpense.edit', $myExpense->id)}}" method="POST">
                              @csrf
                              <div class="card-body">
                                <div class="form-group">
                                  <label for="date">Date</label>
                                  <input name='date' value="{{$myExpense->date}}" type="date" class="form-control" id="date">
                                </div>
                                <div class="form-group">
                                  <label for="editExpenseType">Expense Type</label>
                                  <select name="expenseType" class="form-control" id="editExpenseType">
                                    <option value="">--Choose Expense Type</option>
                                    @foreach($expenseTypeData as $expenseType)
                                    <option {{$expenseType->id == $myExpense->expensetypeid?"selected":""}} value="{{$expenseType->id}}">{{$expenseType->name}}</option>
                                    @endforeach
                                  </select>
                                </div>
                                <div class="form-group">
                                  <label for="editAmount">Amount</label>
                                  <input name='amount' value="{{$myExpense->amount}}" type="number" min=0 step=".01" class="form-control" id="editAmount"
                                    placeholder="Type the ammount in Birr here">
                                </div>
                                <div class="form-group">
                                  <label for="description">Description</label>
                                  <textarea name='description' class="form-control" rows="4" id="description"
                                    placeholder="Type some description about the income">{{$myExpense->description}}</textarea>
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
        <div style="visibility: hidden;">
            <div class="whole_extra_item_add_expense"
                id="whole_extra_item_add_expense">
                <div class="delete_extra_item_expense" id="delete_extra_item_expense">
                    <div class="row">
                        <div class="col-5">
                            <div class="row">
                                <div class="form-group col-12">
                                    <select required name="expenseType[]"
                                        class="form-control form-control-sm"
                                        id="expenseType">
                                        <option value="">--Choose Expense Type--
                                        </option>
                                        @foreach($expenseTypeData as $expenseType)
                                        <option value="{{$expenseType->id}}">
                                            {{$expenseType->name}}</option>
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
                                placeholder="Some description about the expense"></textarea>
                        </div>
                        <div class="col-2 text-center">
                            <span id="addexpense" class="btn btn-success btn-sm addexpense"><span
                                    class="fas fa-plus"></span></span>
                            <span id="removeexpense"
                                class="btn btn-danger btn-sm removeexpense"><span
                                    class="fas fa-minus"></span></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      </section>
    </div>
  </div>
  <script src="assets/plugins/sweetalert2/sweetalert2.min.js"></script>
  <!-- Toastr -->
  <script src="assets/plugins/toastr/toastr.min.js"></script>
  <script>
    $(function () {
      $("#example1").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
        "buttons": [{
                extend: 'copyHtml5',
                exportOptions: {
                    columns: ':visible'
                },
                title: '{{$fullName}} \'s expense as of date {{$todayDate}}'
            },
            {
                extend: 'excelHtml5',
                exportOptions: {
                    columns: ':visible'
                },
                title: '{{$fullName}} \'s expense as of date {{$todayDate}}'
            },
            {
                extend: 'pdfHtml5',
                exportOptions: {
                    columns: ':visible'
                },
                title: '{{$fullName}} \'s expense as of date {{$todayDate}}',
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
                title: '{{$fullName}} \'s expense as of date {{$todayDate}}'
            },
            {
              extend: 'print',
                exportOptions: {
                    columns: ':visible',
                },
                title: '{{$fullName}} \'s expense as of date {{$todayDate}}'
            },
            'colvis'
                ]
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
  </script>
  <script type="text/javascript">
    $(document).ready(function(){
        $(document).on('click', '.addexpense', function() {
            var whole_extra_item_add_expense = $('#whole_extra_item_add_expense').html();
            $(this).closest(".card_addexpense").append(whole_extra_item_add_expense);
        });
        $(document).on('click', '.removeexpense', function(event) {
            $(this).closest(".delete_extra_item_expense").remove();
        });
    });
</script>

</body>
@endsection
