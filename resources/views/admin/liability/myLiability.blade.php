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
              <h1>My Liability</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item active">My Liability</li>
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
                <h4 class = "text-gray float-left">My Liability Data</h4>
                  <button type="button" class="btn btn-primary float-right btn-md" data-toggle="modal" data-target="#modal-newLiability">
                    New Liability <span class="fa fa-plus"></span>
                  </button>
                </div>
            </div>
        </div>
        <!-- row -->
        <!-- Genetal expense widgets -->
        <div class="row">
            <div class="col-md-4 col-sm-12 col-12">
                <div class="info-box bg-success">
                <span class="info-box-icon"><i class="fa fa-coins"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">What I payed </span>
                    <span class="info-box-number">{{number_format($payedAmount, 2, '.', ',')}}</span>
                    <div class="progress">
                    <div class="progress-bar" ></div>
                    </div>
                </div>
                <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <div class="col-md-4 col-sm-12 col-12">
                <div class="info-box bg-warning">
                <span class="info-box-icon"><i class="fa fa-coins"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">What I Borrowed</span>
                    <span class="info-box-number">{{number_format($totalAmount, 2, '.', ',')}}</span>

                    <div class="progress">
                    <div class="progress-bar"></div>
                    </div>
                </div>
                <!-- /.info-box-content -->
                </div>
            <!-- /.info-box -->
          </div>

          <div class="col-md-4 col-sm-12 col-12">
            <div class="info-box bg-danger">
              <span class="info-box-icon"><i class="fa fa-coins"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">What I Owe</span>
                <span class="info-box-number">{{number_format($oweAmount, 2, '.', ',')}}</span>

                <div class="progress">
                  <div class="progress-bar"></div>
                </div>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

        </div>
        <!-- row -->
        <div class="row">
          <div class="col-12">
            <div class="card">
              <!-- /.card-header -->
              <div class="card-body">
                <div class="modal fade" id="modal-newLiability">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title">Add New Liability </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                      <form method="POST" action="{{route('myLiability.add')}}">
                                            @csrf
                                            <div class="card-body card_addliability" id="card_addliability">
                                                <div class="form-group">
                                                    <label for="date">Date</label>
                                                    <input name='date' required type="date"
                                                        class="form-control form-control-sm" id="date">
                                                </div>
                                                <div class="row">
                                                    <div class="col-5">
                                                        <div class="row mb-0">
                                                            <div class="form-group col-6">
                                                                <select required name="liabilityType[]"
                                                                    class="form-control form-control-sm"
                                                                    id="liabilityType">
                                                                    <option value="">--Liability Type--</option>
                                                                    @foreach($liabilityTypeData as $liabilityType)
                                                                    <option value="{{$liabilityType->id}}">
                                                                        {{$liabilityType->name}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="form-group col-6">
                                                                <input name='lender[]' required type="text"
                                                                    class="form-control form-control-sm" id="lender" placeholder="Lender Name Here">
                                                            </div>
                                                            <div class="form-group col-6">
                                                                <input name="amount[]" type="number" min=0 step=".01"
                                                                    class="form-control form-control-sm" id="amount"
                                                                    placeholder="Amount in birr">
                                                            </div>
                                                            <div class="form-group col-6">
                                                                <input name="duration[]" type="number" min=0 step=".01"
                                                                    class="form-control form-control-sm" id="duration"
                                                                    placeholder="Duration in Days">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-5">
                                                        <textarea name="description[]" id="" rows="3"
                                                            class="form-control form-control-sm"
                                                            placeholder="Some description about the liability"></textarea>
                                                    </div>
                                                    <div class="col-2 text-center">
                                                        <span id="addliability" class="btn btn-success btn-sm addliability"><span
                                                                class="fas fa-plus"></span></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group text-center">
                                                <button type="submit" class="btn btn-primary">Add Liability</button>
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
                      <th>Lender</th>
                      <th>Liability Type</th>
                      <th>Total Amount</th>
                      <th>Amount Payed</th>
                      <th>Amount Left</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($myLiabilityData as $keyone=>$myLiability)
                        @php
                            $thisPayedAmount = 0.00;
                            $thisLeftAmount = 0.00;
                        @endphp
                        @foreach($myLiabilityPaymentData as $key=>$payment)
                            @if($payment->liabilityid == $myLiability->id)
                                @php
                                    $thisPayedAmount += $payment->amount;
                                @endphp
                            @endif
                        @endforeach
                        @php
                            $thisLeftAmount = $myLiability->amount - $thisPayedAmount;
                        @endphp
                    <tr>
                      <td>{{$keyone+1}}</td>
                      <td>{{$myLiability->date}}</td>
                      <td>{{$myLiability->lender}}</td>
                      <td>{{$myLiability['LiabilityType']['name'] }}</td>
                      <td>{{$myLiability->amount}}</td>
                      <td>{{$thisPayedAmount}}</td>
                      <td>{{$thisLeftAmount}}</td>
                      <td class="text-center">
                        <div class="btn-group bg-success">
                          <button type="button" class="btn btn-sm btn-secondary float-left" data-toggle="modal"
                            data-target="#modal-editMyliability{{$myLiability->id}}">
                            <i class="fas fa-edit"></i></span>
                          </button>
                          <button type="button" class="btn btn-sm btn-success float-left" data-toggle="modal"
                            data-target="#modal-payLiability{{$myLiability->id}}">
                            <i class="fas fa-plus"></i></span>
                          </button>
                          <a id='delete' href="{{route('myLiability.delete', $myLiability->id)}}"  type="button" class="btn btn-sm btn-danger">
                            <i class="fas fa-trash"></i>
                          </a>
                        </div>
                      </td>
                    </tr>
                    <div class="modal fade text-left" id="modal-editMyliability{{$myLiability->id}}">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h4 class="modal-title">Edit My Liability</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <form action="{{route('myLiability.edit', $myLiability->id)}}" method="POST">
                              @csrf
                              <div class="card-body">
                                <div class="form-group">
                                  <label for="date">Date</label>
                                  <input name='date' value="{{$myLiability->date}}" type="date" class="form-control" id="date">
                                </div>
                                <div class="form-group">
                                  <label for="lender">Lender</label>
                                  <input name='lender' value="{{$myLiability->lender}}" type="text" class="form-control" id="lender">
                                </div>
                                <div class="form-group">
                                  <label for="editLiabilityType">Liability Type</label>
                                  <select name="liabilityTypeId" class="form-control" id="editLiabilityType">
                                    <option value="">--Liability Type</option>
                                    @foreach($liabilityTypeData as $liabilityType)
                                    <option {{$liabilityType->id == $myLiability->liabilitytypeid?"selected":""}} value="{{$liabilityType->id}}">{{$liabilityType->name}}</option>
                                    @endforeach
                                  </select>
                                </div>
                                <div class="form-group">
                                  <label for="editAmount">Amount</label>
                                  <input name='amount' value="{{$myLiability->amount}}" type="number" min=0 step=".01" class="form-control" id="editAmount"
                                    placeholder="Amount in birr">
                                </div>
                                <div class="form-group">
                                  <label for="editDuration">Duration</label>
                                  <input name='duration' value="{{$myLiability->amount}}" type="number" min=0 step=".01" class="form-control" id="editDuration"
                                    placeholder="Duration in Days">
                                </div>
                                <div class="form-group">
                                  <label for="description">Description</label>
                                  <textarea name='description' class="form-control" rows="4" id="description"
                                    placeholder="Type some description about the liability">{{$myLiability->description}}</textarea>
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
                      <th>Lender</th>
                      <th>Liability Type</th>
                      <th>Total Amount</th>
                      <th>Amount Payed</th>
                      <th>Amount Left</th>
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
                <div class="whole_extra_item_add_liability"
                    id="whole_extra_item_add_liability">
                    <div class="delete_extra_item_liability" id="delete_extra_item_liability">
                        <div class="row">
                            <div class="col-5">
                                <div class="row">
                                    <div class="form-group col-6">
                                        <select required name="liabilityType[]"
                                            class="form-control form-control-sm"
                                            id="liabilityType">
                                            <option value="">--liability Type--
                                            </option>
                                            @foreach($liabilityTypeData as $liabilityType)
                                            <option value="{{$liabilityType->id}}">
                                                {{$liabilityType->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-6">
                                        <input name='lender[]' required type="text"
                                            class="form-control form-control-sm" id="lender" placeholder="Lender Name Here">
                                    </div>
                                    <div class="form-group col-6">
                                        <input name="amount[]" type="number" min=0
                                            step=".01"
                                            class="form-control form-control-sm"
                                            id="amount"
                                            placeholder="Amount in birr">
                                    </div>
                                    <div class="form-group col-6">
                                        <input name="duration[]" type="number" min=0
                                            step=".01"
                                            class="form-control form-control-sm"
                                            id="duration"
                                            placeholder="Duration in Days">
                                    </div>
                                </div>
                            </div>
                            <div class="col-5">
                                <textarea name="description[]" id="" rows="3"
                                    class="form-control form-control-sm"
                                    placeholder="Some description about the liability"></textarea>
                            </div>
                            <div class="col-2 text-center">
                                <span id="addliability" class="btn btn-success btn-sm addliability"><span
                                        class="fas fa-plus"></span></span>
                                <span id="removeliability" class="btn btn-danger btn-sm removeliability"><span
                                        class="fas fa-minus"></span></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      </section>
  </div>
  @foreach($myLiabilityData as $key=>$myLiability)
  <div class="modal fade text-left" id="modal-payLiability{{$myLiability->id}}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title">Liability Payment</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
            <h6 class="text-center">Previous Payments</h6>
            <table class="table text-sm table-bordered table-striped table-sm">
                <thead>
                    <tr>
                    <th>Date</th>
                    <th>Amount</th>
                    <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $paymentMade = 0;
                    @endphp
                    @foreach($myLiabilityPaymentData as $key=>$payment)
                    @if($payment->liabilityid == $myLiability->id)
                    @php
                    $paymentMade += $payment->amount;
                    @endphp
                    <tr>
                    <td>{{$payment->date}}</td>
                    <td>{{$payment->amount}}</td>
                    <td class="text-center">
                        <div class="btn-group bg-success">
                        <a id='delete' href="{{route('myLiabilityPayment.delete', $payment->id)}}"  type="button" class="btn btn-sm btn-danger">
                            <i class="fas fa-trash"></i>
                        </a>
                        </div>
                    </td>
                    </tr>
                    @endif
                    @endforeach
                </tbody>
            </table>
            <form action="{{route('myLiabilityPayment.add', $myLiability->id)}}" method="POST">
                @csrf
                <div class="card-body">
                <div class="form-group">
                    <label for="date">Date</label>
                    <input name='date' required type="date" class="form-control" id="date">
                </div>
                <div class="form-group">
                    <label for="editAmount">Amount</label>
                    <input name='amount' required type="number" min=0 step=".01" max="{{$myLiability->amount - $paymentMade}}" class="form-control" id="editAmount"
                    placeholder="Amount in birr">
                </div>
                <div class="form-group">
                    <label for="editAmount" class="text-danger">Left upaid Amount: {{$myLiability->amount - $paymentMade}} Birr</label>
                </div>
                </div>
                <!-- /.card-body -->
                <div class="form-group text-center">
                <button type="submit" class="btn btn-success">Save</button>
                </div>
            </form>

            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
    </div>
@endforeach
  <script src="assets/plugins/sweetalert2/sweetalert2.min.js"></script>
  <!-- Toastr -->
  <script src="assets/plugins/toastr/toastr.min.js"></script>
  <script type="text/javascript">
    $(document).ready(function(){
        $(document).on('click', '.addliability', function(){
            var whole_extra_item_add_liability = $('#whole_extra_item_add_liability').html();
            $(".card_addliability").append(whole_extra_item_add_liability);
        });
        $(document).on('click', '.removeliability', function(event) {
            $(this).closest(".delete_extra_item_liability").remove();
        });
    });
</script>
  <script>
    $(function () {
      $("#example1").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
        "buttons": [{
                extend: 'copyHtml5',
                exportOptions: {
                    columns: ':visible'
                },
                title: '{{$fullName}} \'s liability as of date {{$todayDate}}'
            },
            {
                extend: 'excelHtml5',
                exportOptions: {
                    columns: ':visible'
                },
                title: '{{$fullName}} \'s liability as of date {{$todayDate}}'
            },
            {
                extend: 'pdfHtml5',
                exportOptions: {
                    columns: ':visible'
                },
                title: '{{$fullName}} \'s liability as of date {{$todayDate}}',
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
                title: '{{$fullName}} \'s liability as of date {{$todayDate}}'
            },
            {
              extend: 'print',
                exportOptions: {
                    columns: ':visible',
                },
                title: '{{$fullName}} \'s liability as of date {{$todayDate}}'
            },
            'colvis'
                ]
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
  </script>
</body>
@endsection
