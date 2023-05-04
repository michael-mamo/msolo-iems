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
                        <div class="row text-sm mt-5">
                        <div class="col-3 table-responsive">
                                <h6 class="text-center" >Top Income</h6>
                                <table class="table table-striped table-sm">
                                    <thead>
                                    <tr>
                                    <th>Income Type</th>
                                    <th>Amount</th>
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
                                    <tr>
                                    <td>{{$income['IncomeType']['name']}}</td>
                                    <td>{{number_format($income->sum,2)}} Birr</td>
                                    </tr>
                                    <tr>
                                    @endforeach
                                    <tr>
                                    <th>Other Types</th>
                                    <th>{{number_format($totalIncome - $topTotalIncome,2)}} Birr</th>
                                    </tr>
                                    <tr>
                                    <th>Total Income</th>
                                    <th>{{number_format($totalIncome,2)}} Birr</th>
                                    </tr>
                                    <tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-3 table-responsive">
                                <h6 class="text-center" >Top Expense</h6>
                                <table class="table table-striped table-sm">
                                    <thead>
                                    <tr>
                                    <th>Expense Type</th>
                                    <th>Amount</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                    $topTotalExpense = 0.00;
                                    @endphp
                                    @foreach($topExpense as $key=>$expense)
                                    @php
                                    $topTotalExpense += $expense->sum;
                                    @endphp
                                    <tr>
                                    <td>{{$expense['ExpenseType']['name']}}</td>
                                    <td>{{number_format($expense->sum,2)}} Birr</td>
                                    </tr>
                                    <tr>
                                    @endforeach
                                    <tr>
                                    <th>Other Types</th>
                                    <th>{{number_format($totalExpense - $topTotalExpense,2)}} Birr</th>
                                    </tr>
                                    <tr>
                                    <th>Total Income</th>
                                    <th>{{number_format($totalExpense,2)}} Birr</th>
                                    </tr>
                                    <tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-3 table-responsive">
                                <h6 class="text-center" >Top Income</h6>
                                <table class="table table-striped table-sm">
                                    <thead>
                                    <tr>
                                    <th>Saving Type</th>
                                    <th>Amount</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                    $topTotalSaving = 0.00;
                                    @endphp
                                    @foreach($topSaving as $key=>$saving)
                                    @php
                                    $topTotalSaving += $saving->sum;
                                    @endphp
                                    <tr>
                                    <td>{{$saving['SavingType']['name']}}</td>
                                    <td>{{number_format($saving->sum,2)}} Birr</td>
                                    </tr>
                                    <tr>
                                    @endforeach
                                    <tr>
                                    <th>Other Types</th>
                                    <th>{{number_format($totalSaving - $topTotalSaving,2)}} Birr</th>
                                    </tr>
                                    <tr>
                                    <th>Total Income</th>
                                    <th>{{number_format($totalSaving,2)}} Birr</th>
                                    </tr>
                                    <tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-3 table-responsive">
                                <h6 class="text-center" >Top Unpaid Liabilities</h6>
                                <table class="table table-striped table-sm">
                                    <thead>
                                    <tr>
                                    <th>Lender</th>
                                    <th>Amount</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                    $topTotalLiability = 0.00;
                                    @endphp
                                    @foreach($topLiability as $key=>$liability)
                                    @php
                                    $topTotalLiability += $liability->sum;
                                    @endphp
                                    <tr>
                                    <td>{{$liability->lender}}</td>
                                    <td>{{number_format($liability->sum,2)}} Birr</td>
                                    </tr>
                                    <tr>
                                    @endforeach
                                    <tr>
                                    <th>Other Types</th>
                                    <th>{{number_format($totalLiability - $topTotalLiability,2)}} Birr</th>
                                    </tr>
                                    <tr>
                                    <th>Total Income</th>
                                    <th>{{number_format($totalLiability,2)}} Birr</th>
                                    </tr>
                                    <tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                        <div class="row">
                            <!-- accepted payments column -->
                            <div class="col-6">
                            <p class="lead">Quick Notes:</p>
                            <p class="text-muted well well-sm shadow-none" >
                                Bubjet part will be included here
                            </p>
                            </div>
                            <!-- /.col -->
                            <div class="col-6">
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
                                    <td>Total Liability:</td>
                                    <td></td>
                                    <td>{{number_format($totalSaving,2)}} Birr</td>
                                </tr>
                                <tr>
                                    <th>Capital:</th>
                                    <th></th>
                                    <th>{{number_format($totalSaving - $totalLiability,2)}} Birr</th>
                                </tr>
                                </table>
                            </div>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                        <!-- this row will not appear when printing -->
                        <div class="row no-print">
                            <div class="col-12">
                            <a onclick="printReport()" rel="noopener" class="btn btn-default"><i class="fas fa-print"></i> Print</a>
                            <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
                                <i class="fas fa-download"></i> Generate PDF
                            </button>
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
