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
              <h1>My Receivable</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item active">My Receivable</li>
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
                <h4 class = "text-gray float-left">My Receivable Data</h4>
                  <button type="button" class="btn btn-primary float-right btn-md" data-toggle="modal" data-target="#modal-newReceivable">
                    New Receivable <span class="fa fa-plus"></span>
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
                    <span class="info-box-text">What I Lent </span>
                    <span class="info-box-number">{{number_format($totalAmount, 2, '.', ',')}}</span>
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
                    <span class="info-box-text">What I Received</span>
                    <span class="info-box-number">{{number_format($receivedAmount, 2, '.', ',')}}</span>
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
                <span class="info-box-text">What I Will Receive</span>
                <span class="info-box-number">{{number_format($willReceiveAmount, 2, '.', ',')}}</span>

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
                <div class="modal fade" id="modal-newReceivable">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title">Add New Receivable </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                      <form method="POST" action="{{route('myReceivable.add')}}">
                            @csrf
                            <div class="card-body card_addreceivable" id="card_addreceivable">
                                <div class="form-group">
                                    <label for="date">Date</label>
                                    <input name='date' required type="date"
                                        class="form-control form-control-sm" id="date">
                                </div>
                                <div class="row">
                                    <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                                        <div class="row mb-0">
                                            <div class="form-group col-6">
                                                <select required name="receivableType[]"
                                                    class="form-control form-control-sm"
                                                    id="receivableType">
                                                    <option value="">--Receivable Type--</option>
                                                    @foreach($receivableTypeData as $receivableType)
                                                    <option value="{{$receivableType->id}}">
                                                        {{$receivableType->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group col-6">
                                                <input name='borrower[]' required type="text"
                                                    class="form-control form-control-sm" id="borrower" placeholder="Borrower Name Here">
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
                                    <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                                        <textarea name="description[]" id="" rows="3"
                                            class="form-control form-control-sm"
                                            placeholder="Some description about the receivable"></textarea>
                                    </div>
                                    <div class="mb-2 mt-2 col-lg-2 col-md-2 col-sm-12 col-xs-12 text-center">
                                        <span id="addreceivable" class="btn btn-success btn-sm addreceivable"><span
                                                class="fas fa-plus"></span></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group text-center">
                                <button type="submit" class="btn btn-primary">Add Reveivable</button>
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
                      <th>Borrower</th>
                      <th>Receivable Type</th>
                      <th>Total Amount</th>
                      <th>Amount Recieved</th>
                      <th>Amount Left</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($myReceivableData as $keyone=>$myReceivable)
                        @php
                            $thisReceivedAmount = 0.00;
                            $thisLeftAmount = 0.00;
                        @endphp
                        @foreach($myReceivablePaymentData as $key=>$received)
                            @if($received->receivableid == $myReceivable->id)
                                @php
                                    $thisReceivedAmount += $received->amount;
                                @endphp
                            @endif
                        @endforeach
                        @php
                            $thisLeftAmount = $myReceivable->amount - $thisReceivedAmount;
                        @endphp
                    <tr>
                      <td>{{$keyone+1}}</td>
                      <td>{{$myReceivable->date}}</td>
                      <td>{{$myReceivable->borrower}}</td>
                      <td>{{$myReceivable['ReceivableType']['name'] }}</td>
                      <td>{{$myReceivable->amount}}</td>
                      <td>{{$thisReceivedAmount}}</td>
                      <td>{{$thisLeftAmount}}</td>
                      <td class="text-center">
                        <div class="btn-group bg-success">
                          <button type="button" class="btn btn-sm btn-secondary float-left" data-toggle="modal"
                            data-target="#modal-editmyReceivable{{$myReceivable->id}}">
                            <i class="fas fa-edit"></i></span>
                          </button>
                          <button type="button" class="btn btn-sm btn-success float-left" data-toggle="modal"
                            data-target="#modal-payReceivable{{$myReceivable->id}}">
                            <i class="fas fa-plus"></i></span>
                          </button>
                          <a id='delete' href="{{route('myReceivable.delete', $myReceivable->id)}}"  type="button" class="btn btn-sm btn-danger">
                            <i class="fas fa-trash"></i>
                          </a>
                        </div>
                      </td>
                    </tr>
                    <div class="modal fade text-left" id="modal-editmyReceivable{{$myReceivable->id}}">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h4 class="modal-title">Edit My Receivable</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <form action="{{route('myReceivable.edit', $myReceivable->id)}}" method="POST">
                              @csrf
                              <div class="card-body">
                                <div class="form-group">
                                  <label for="date">Date</label>
                                  <input name='date' value="{{$myReceivable->date}}" type="date" class="form-control" id="date">
                                </div>
                                <div class="form-group">
                                  <label for="borrower">Borrower</label>
                                  <input name='borrower' value="{{$myReceivable->borrower}}" type="text" class="form-control" id="borrower">
                                </div>
                                <div class="form-group">
                                  <label for="editReveivableType">Reveivable Type</label>
                                  <select name="receivableTypeId" class="form-control" id="editReveivableType">
                                    <option value="">--Reveivable Type</option>
                                    @foreach($receivableTypeData as $receivableType)
                                    <option {{$receivableType->id == $myReceivable->receivabletypeid?"selected":""}} value="{{$receivableType->id}}">{{$receivableType->name}}</option>
                                    @endforeach
                                  </select>
                                </div>
                                <div class="form-group">
                                  <label for="editAmount">Amount</label>
                                  <input name='amount' value="{{$myReceivable->amount}}" type="number" min=0 step=".01" class="form-control" id="editAmount"
                                    placeholder="Amount in birr">
                                </div>
                                <div class="form-group">
                                  <label for="editDuration">Duration</label>
                                  <input name='duration' value="{{$myReceivable->duration}}" type="number" min=0 step=".01" class="form-control" id="editDuration"
                                    placeholder="Duration in Days">
                                </div>
                                <div class="form-group">
                                  <label for="description">Description</label>
                                  <textarea name='description' class="form-control" rows="4" id="description"
                                    placeholder="Type some description about the receivable">{{$myReceivable->description}}</textarea>
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
                      <th>Borrower</th>
                      <th>Receivable Type</th>
                      <th>Total Amount</th>
                      <th>Amount Reveived</th>
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
                <div class="whole_extra_item_add_receivable"
                    id="whole_extra_item_add_receivable">
                    <div class="delete_extra_item_receivable" id="delete_extra_item_receivable">
                        <div class="row">
                            <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                                <div class="row">
                                    <div class="form-group col-6">
                                        <select required name="receivableType[]"
                                            class="form-control form-control-sm"
                                            id="receivableType">
                                            <option value="">--liability Type--
                                            </option>
                                            @foreach($receivableTypeData as $receivableType)
                                            <option value="{{$receivableType->id}}">
                                                {{$receivableType->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-6">
                                        <input name='borrower[]' required type="text"
                                            class="form-control form-control-sm" id="borrower" placeholder="Borrower Name Here">
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
                            <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                                <textarea name="description[]" id="" rows="3"
                                    class="form-control form-control-sm"
                                    placeholder="Some description about the receivable"></textarea>
                            </div>
                            <div class="mt-2 mb-2 col-lg-2 col-md-2 col-sm-12 col-xs-12 text-center">
                                <span id="addreceivable" class="btn btn-success btn-sm addreceivable"><span
                                        class="fas fa-plus"></span></span>
                                <span id="removereceivable" class="btn btn-danger btn-sm removereceivable"><span
                                        class="fas fa-minus"></span></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      </section>
  </div>
  @foreach($myReceivableData as $key=>$myReceivable)
  <div class="modal fade text-left" id="modal-payReceivable{{$myReceivable->id}}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title">Reveivable Payment</h4>
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
                    @foreach($myReceivablePaymentData as $key=>$payment)
                    @if($payment->receivableid == $myReceivable->id)
                    @php
                    $paymentMade += $payment->amount;
                    @endphp
                    <tr>
                    <td>{{$payment->date}}</td>
                    <td>{{$payment->amount}}</td>
                    <td class="text-center">
                        <div class="btn-group bg-success">
                        <a id='delete' href="{{route('myReceivablePayment.delete', $payment->id)}}"  type="button" class="btn btn-sm btn-danger">
                            <i class="fas fa-trash"></i>
                        </a>
                        </div>
                    </td>
                    </tr>
                    @endif
                    @endforeach
                </tbody>
            </table>
            <form action="{{route('myReceivablePayment.add', $myReceivable->id)}}" method="POST">
                @csrf
                <div class="card-body">
                <div class="form-group">
                    <label for="date">Date</label>
                    <input name='date' required type="date" class="form-control" id="date">
                </div>
                <div class="form-group">
                    <label for="editAmount">Amount</label>
                    <input name='amount' required type="number" min=0 step=".01" max="{{$myReceivable->amount - $paymentMade}}" class="form-control" id="editAmount"
                    placeholder="Amount in birr">
                </div>
                <div class="form-group">
                    <label for="editAmount" class="text-danger">Left upaid Amount: {{$myReceivable->amount - $paymentMade}} Birr</label>
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
        $(document).on('click', '.addreceivable', function(){
            var whole_extra_item_add_receivable = $('#whole_extra_item_add_receivable').html();
            $(".card_addreceivable").append(whole_extra_item_add_receivable);
        });
        $(document).on('click', '.removeliability', function(event) {
            $(this).closest(".delete_extra_item_receivable").remove();
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
                title: '{{$fullName}} \'s receivable as of date {{$todayDate}}'
            },
            {
                extend: 'excelHtml5',
                exportOptions: {
                    columns: ':visible'
                },
                title: '{{$fullName}} \'s receivable as of date {{$todayDate}}'
            },
            {
                extend: 'pdfHtml5',
                exportOptions: {
                    columns: ':visible'
                },
                title: '{{$fullName}} \'s receivable as of date {{$todayDate}}',
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
                title: '{{$fullName}} \'s receivable as of date {{$todayDate}}'
            },
            {
              extend: 'print',
                exportOptions: {
                    columns: ':visible',
                },
                title: '{{$fullName}} \'s receivable as of date {{$todayDate}}'
            },
            'colvis'
                ]
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
  </script>
</body>
@endsection
