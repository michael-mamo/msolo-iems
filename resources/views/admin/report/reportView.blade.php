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
                            <h1>Report</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="adminDashboard.html">Dashboard</a></li>
                                <li class="breadcrumb-item active">Report</li>
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
                        <form action="{{route('report.generate')}}" method="get">
                            @csrf
                            <h5 class="text-center"><i class="fas fa-info"></i> Choose Date and Click Generate Report </h5>
                            <div class="row">

                                <div class="col-6 from-group">
                                    <label class="text-center" for="fromDate">From</label>
                                    @if(isset($fromDate))
                                    <input value="{{$fromDate}}" required type="date" name="fromDate" id="fromDate" class="form-control">
                                    @else
                                    <input required type="date" name="fromDate" id="fromDate" class="form-control">
                                    @endif
                                </div>
                                <div class="form-group col-6">
                                    <label class="text-center" for="toDate">To</label>
                                    @if(isset($toDate))
                                    <input value="{{$toDate}}" required type="date" name="toDate" id="toDate" class="form-control">
                                    @else
                                    <input required type="date" name="toDate" id="toDate" class="form-control">
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <button class="btn btn-success btn-block btn-lg">Generate Report</button>
                            </div>
                        </form>
                    </div>
                </div>
            </section>
            @if($report == 1)
            <section id="printable" class="content">
                <div class="container-fluid">
                    <div class="row">
                    <div class="col-12">
                        <div class="invoice p-3 mb-3">
                        <!-- title row -->
                        <div class="row">
                            <div class="col-12">
                            <h4>
                                <i class="fas fa-globe"></i> Income and Expense Management System
                                <small class="float-right">Report Date: {{$reportDate}}</small>
                            </h4>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- info row -->
                        <div class="row mt-4 text-center invoice-info">
                            <div class="col-md-6 col-6 col-lg-6 invoice-col">
                            From
                            <address>
                                <strong>{{$fromDate}}</strong><br>
                            </address>
                            </div>
                            <!-- /.col -->
                            <div class="col-md-6 col-6 col-lg-6 invoice-col">
                            To
                            <address>
                                <strong>{{$toDate}}</strong><br>
                            </address>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                        <!-- Table row -->
                        <div class="row mt-3">
                        <div class="col-lg-12 col-lg-12 col-sm-12 col-xs-12  table-responsive">
                                <h4 class="text-center" >Income Statement</h4>
                                <table class="table table-sm">
                                    <thead>
                                    <tr>
                                    <th>Category</th>
                                    <th>Debit</th>
                                    <th>Credit</th>
                                    </tr>
                                    </thead>
                                    <thead>
                                    <tr>
                                    <th colspan=3>Income</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                    $topTotalIncome = 0.00;
                                    @endphp
                                    @foreach($topIncome as $key=>$income)
                                    @php
                                    $topTotalIncome += $income->sum;
                                    @endphp
                                    <tr class="text-sm">
                                    <td>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp{{$income['IncomeType']['name']}}</td>
                                    <td>{{number_format($income->sum,2)}} Birr</td>
                                    <td></td>
                                    </tr>
                                    <tr>
                                    @endforeach
                                    <tr class="text-success">
                                    <th>Total Income</th>
                                    <th>{{number_format($totalIncome,2)}} Birr</th>
                                    <th></th>
                                    </tr>
                                    <thead>
                                    <tr>
                                    <th colspan=3>Expense</th>
                                    </tr>
                                    </thead>
                                    <tr>
                                    @php
                                    $topTotalExpense = 0.00;
                                    @endphp
                                    @foreach($topExpense as $key=>$expense)
                                    @php
                                    $topTotalExpense += $expense->sum;
                                    @endphp
                                    <tr class="text-sm">
                                    <td>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp{{$expense['ExpenseType']['name']}}</td>
                                    <td></td>
                                    <td>{{number_format($expense->sum,2)}} Birr</td>
                                    </tr>
                                    <tr>
                                    @endforeach
                                    <tr class="text-danger">
                                    <th>Total Expense</th>
                                    <th></th>
                                    <th >{{number_format($totalExpense,2)}} Birr</th>
                                    </tr>
                                    <tr>
                                    <thead class="{{$totalIncome >= $totalExpense?'text-success':'text-danger'}}">
                                    <th>Net Income</th>
                                    <th colspan="2" >{{number_format($totalIncome - $totalExpense,2)}} Birr</th>
                                    </tr>
                                    </thead>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /.row -->
                        <div class="row mt-3">
                        <div class="col-lg-12 col-lg-12 col-sm-12 col-xs-12  table-responsive">
                                <h4 class="text-center" >Balance Sheet</h4>
                                <table class="table table-sm">
                                    <thead>
                                    <tr>
                                    <th colspan="4">Account Recievable</th>
                                    <!-- <th colspan="3">Account Recievable</th> -->
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <td>Borrower</td>
                                    <td>Total Amount</td>
                                    <td>Payed Amount</td>
                                    <td>Unpayed Amount</td>
                                    @php
                                    $totalReceivableTotal = 0.00;
                                    $totalReceivablePayed = 0.00;
                                    $totalReceivableUnpayed = 0.00;
                                    @endphp
                                    @foreach($topReceivable as $key=>$receivable)
                                    @php
                                    $totalReceivableTotal += $receivable->total;
                                    $totalReceivablePayed += $receivable->payed;
                                    $totalReceivableUnpayed += $receivable->unpayed;
                                    @endphp
                                    <tr class="text-sm">
                                    <td>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp{{$receivable->borrower}}</td>
                                    <td>{{number_format($receivable->total,2)}} Birr</td>
                                    <td>{{number_format($receivable->payed,2)}} Birr</td>
                                    <td>{{number_format($receivable->unpayed,2)}} Birr</td>
                                    </tr>
                                    <tr>
                                    @endforeach
                                    <tr>
                                    <th>Total Receivable</th>
                                    <th>{{number_format($totalReceivableTotal,2)}} Birr</th>
                                    <th>{{number_format($totalReceivablePayed,2)}} Birr</th>
                                    <th>{{number_format($totalReceivableUnpayed,2)}} Birr</th>
                                    </tr>
                                    <!-- <tr class="text-success"> -->
                                    <!-- <th>Total Received Amount Between ('{{$fromDate}}' - '{{$toDate}}')</th> -->
                                    <!-- <th colspan="3" class="text-center">{{number_format($totalReceivablePayed,2)}} Birr</th> -->
                                    <!-- </tr> -->
                                    <thead>
                                    <thead>
                                    <tr>
                                    <th colspan="4">Liability</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <td>Lender</td>
                                    <td>Total Amount</td>
                                    <td>Payed Amount</td>
                                    <td>Unpayed Amount</td>
                                    @php
                                    $totalLiabilityTotal = 0.00;
                                    $totalLiabilityPayed = 0.00;
                                    $totalLiabilityUnpayed = 0.00;
                                    @endphp
                                    @foreach($topLiability as $key=>$liability)
                                    @php
                                    $totalLiabilityTotal += $liability->total;
                                    $totalLiabilityPayed += $liability->received;
                                    $totalLiabilityUnpayed += $liability->unpayed;
                                    @endphp
                                    <tr class="text-sm">
                                    <td>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp{{$liability->lender}}</td>
                                    <td>{{number_format($liability->total,2)}} Birr</td>
                                    <td>{{number_format($liability->payed,2)}} Birr</td>
                                    <td>{{number_format($liability->unpayed,2)}} Birr</td>
                                    </tr>
                                    <tr>
                                    @endforeach
                                    <tr>
                                    <th>Total Liability</th>
                                    <th>{{number_format($totalLiabilityTotal,2)}} Birr</th>
                                    <th>{{number_format($totalLiabilityPayed,2)}} Birr</th>
                                    <th>{{number_format($totalLiabilityUnpayed,2)}} Birr</th>
                                    </tr>
                                    <thead>
                                </table>
                            </div>
                        </div>

                        <div class="row">
                            <!-- accepted payments column -->
                            <div class="col-lg-6 col-md-6 col-sm-12 col-sx-12">
                            <h4 class="text-center" >Savings</h4>
                                <table class="table table-sm">
                                    <thead>
                                    <tr>
                                    <th>Saving Title</th>
                                    <th>Saved Amount</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                    $totalSaving = 0.00;
                                    @endphp
                                    @foreach($topSaving as $key=>$saving)
                                    @php
                                    $totalSaving += $saving->sum;
                                    @endphp
                                    <tr class="text-sm">
                                    <td>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp{{$saving->title}}</td>
                                    <td>{{number_format($saving->sum,2)}} Birr</td>
                                    <td></td>
                                    </tr>
                                    <tr>
                                    @endforeach
                                    <tr class="text-success">
                                    <th>Total Saving</th>
                                    <th>{{number_format($totalSaving,2)}} Birr</th>
                                    <th></th>
                                    </tr>
                                    </tbody>
                                </table>

                            </div>
                            <!-- /.col -->
                            <div class="col-lg-6 col-md-6 col-sm-12 col-sx-12">
                            <h4 class="text-center">Summary</h4>

                            <div class="table-responsive">
                                <table class="table table-sm">
                                <tr>
                                    <td>Total Income: </td>
                                    <td>{{number_format($totalIncome,2)}} Birr</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Total Expense: </td>
                                    <td></td>
                                    <td>{{number_format($totalExpense,2)}} Birr</td>
                                </tr>
                                <tr>
                                    <th>Net Income:</th>
                                    <th></th>
                                    <th>{{number_format($totalIncome - $totalExpense,2)}} Birr</th>
                                </tr>
                                <tr>
                                    <td>Total Saving:</td>
                                    <td>{{number_format($totalSaving,2)}} Birr</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Total Receivable:</td>
                                    <td>{{number_format($totalReceivableUnpayed,2)}} Birr</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Total Liability:</td>
                                    <td></td>
                                    <td>{{number_format($totalLiabilityUnpayed,2)}} Birr</td>
                                </tr>
                                <tr>
                                    <th>Capital:</th>
                                    <th></th>
                                    <!-- <th>{{number_format($totalSaving + $totalReceivable - $totalLiability,2)}} Birr</th> -->
                                    <th>{{number_format($totalSaving + $totalReceivableUnpayed - $totalLiabilityUnpayed,2)}} Birr</th>
                                </tr>
                                </table>
                            </div>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                        <div>
                            <p class="lead">Developed By:</p>
                            <ul class="text-muted list-unstyled">
                                <li><i class="fa fa-user"></i> Michael Mamo
                                <li><i class="fa fa-phone"></i> +251935030322
                            </ul>
                        </div>
                        <!-- this row will not appear when printing -->
                        <div class="row no-print">
                            <div class="text-center col-12">
                            <a onclick="printReport()" rel="noopener" class="btn btn-success btn-lg"><i class="fas fa-print"></i> Print</a>
                            <!-- <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
                                <i class="fas fa-download"></i> Generate PDF
                            </button> -->
                            </div>
                        </div>
                        </div>
                        <!-- /.invoice -->
                    </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </section>
            @endif
            </div>
        <!-- /.content-wrapper -->
        <!-- Include the footer here -->
    </div>
</body>
<script>
    function printReport(){
        var printData =  document.getElementById("printable").innerHTML
        var originalContents = document.body.innerHTML
        document.body.innerHTML = printData
        window.print();
        document.body.innerHTML = originalContents;
    }

</script>
</html>
@endsection
