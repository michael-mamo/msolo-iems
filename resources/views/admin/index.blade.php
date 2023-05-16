@extends('admin.adminMaster')
@section('content')
@if(Auth::User()->isactive == '1')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>My Dashboard</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">My Dashboard</a></li>
                        <li class="breadcrumb-item active">My Dashboard</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{number_format($thisYearTotalIncome, 2)}} ETB<button
                                    class="btn btn-success float-right" data-toggle="modal"
                                    data-target="#modal-newIncome"><span class="fas fa-plus"></span></button></h3>
                            <p>Total Income ({{$year}}) <i class="fa fa-money-check-alt"></i></p>
                        </div>

                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="{{route('myIncome.view')}}" class="small-box-footer">More Info <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
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
                                                    <input name='date[]' required type="date"
                                                        class="form-control form-control-sm" id="date">
                                                </div>
                                                <div class="row">
                                                    <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
                                                        <div class="row mb-0">
                                                            <div class="form-group col-12">
                                                                <select required name="incomeType[]"
                                                                    class="selectIncome form-control form-control-sm"
                                                                     style="width: 100%;">
                                                                    <option value="">--Choose Income Type--</option>
                                                                    @foreach($incomeTypeData as $incomeType)
                                                                    <option value="{{$incomeType->id}}">
                                                                        {{$incomeType->name}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="form-group col-12">
                                                                <input name="amount[]" required type="number" min=0 step=".01"
                                                                    class="form-control form-control-sm" id="amount"
                                                                    placeholder="Type the amount in Birr here">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
                                                        <textarea name="description[]" id="" rows="3"
                                                            class="form-control form-control-sm"
                                                            placeholder="Some description about the income"></textarea>
                                                    </div>
                                                    <div class="mt-2 mb-2 col-xs-12 col-sm-12 col-md-2 col-lg-2 text-center">
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
                            </div>
                        </div>
                <!-- ./col -->
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>{{number_format($thisYearTotalExpense, 2)}} ETB<button
                                    class="btn btn-danger float-right" data-toggle="modal"
                                    data-target="#modal-newExpense"><span class="fas fa-plus"></span></button></h3>
                            <p>Total Expense ({{$year}}) <i class="fa fa-money-check-alt"></i></p>
                        </div>

                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="{{route('myExpense.view')}}" class="small-box-footer">More Info <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
            </div>
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
                                                    <input name='date[]' required type="date"
                                                        class="form-control form-control-sm" id="date">
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-12 col-xs-12 col-md-5 col-lg-5">
                                                        <div class="row mb-0">
                                                            <div class="form-group col-12">
                                                                <select required name="expenseType[]"
                                                                    class="selectExpense form-control form-control-sm"
                                                                    style="width: 100%;">
                                                                    <option value="">--Choose Expense Type--</option>
                                                                    @foreach($expenseTypeData as $expenseType)
                                                                    <option value="{{$expenseType->id}}">
                                                                        {{$expenseType->name}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="form-group col-12">
                                                                <input name="amount[]" required type="number" min=0 step=".01"
                                                                    class="form-control form-control-sm" id="amount"
                                                                    placeholder="Type the amount in Birr here">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12 col-xs-12 col-md-5 col-lg-5">
                                                        <textarea name="description[]" id="" rows="3"
                                                            class="form-control form-control-sm"
                                                            placeholder="Some description about the expense"></textarea>
                                                    </div>
                                                    <div class="mb-2 mt-2 col-sm-12 col-xs-12 col-md-2 col-lg-2 text-center">
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
                            </div>
                        </div>
            <!-- /.row -->
            <div class="row">
                <!-- ./col -->
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <!-- small box -->
                    <div class="small-box bg-orange">
                        <div class="inner">
                            <h4>{{number_format($thisYearTotalSaving, 2)}}<button class="btn btn-orange float-right" data-toggle="modal"
                                    data-target="#modal-saving">
                                    <span class="text-primary fas fa-piggy-bank"></span></button></h4>
                            <p>Total Savings ({{$year}})</p>

                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>

                        <a href="#" class="small-box-footer">More Info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="modal fade" id="modal-saving">
                                <div class="modal-dialog modal-lg">
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
                                                    <label>Saving Type</label>
                                                    <select  name = "savingType" class="selectSaving form-control">
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
                                                    <input name="amount" required type="number" min=0 step=".01" class="form-control" id="amount"
                                                    placeholder="Type Amount here (in ETB)">
                                                </div>
                                                <div class="form-group">
                                                    <label for="targetAmount">Target Amount</label>
                                                    <input name="targetAmount" required type="number" min=0 step=".01" class="form-control" id="targetAmount"
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
                <!-- ./col -->
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h4>{{number_format($thisYearSavingCompleted)}}<span
                                    class="text-success fas fa-check float-right"></span>
                            </h4>
                            <p>Saving Plan Completed ({{$year}})</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                        </div>
                        <a href="#" class="small-box-footer">More Info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <!-- small box -->
                    <div class="small-box bg-green">
                        <div class="inner">
                            <h4>{{isset($topFiveIncomeTypes[0])?$topFiveIncomeTypes[0]:'None So Far'}}<span
                                    class="fa fa-wallet float-right"></span></h4>
                            <p>Highest Income Type ({{$year}})</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <a href="#" class="small-box-footer">More Info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h4>{{isset($topFiveExpenseTypes[0])?$topFiveExpenseTypes[0]:'None So Far'}}<span
                                    class="text-danger fa fa-shopping-cart float-right"></span></h4>
                            <p>Highest Expense Type ({{$year}})</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <a href="#" class="small-box-footer">More Info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- /.content -->
    <section>
        <div class="row container-fluid">
            <!-- /.col-md-6 -->
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="card">
                    <div class="card-header border-0">
                        <div class="d-flex justify-content-between">
                            <h4 class="card-title">This Year Income and Expense</h4>
                            <a href="javascript:void(0);">More</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="d-flex">
                            <p class="d-flex flex-column">
                                <span>Income({{$year}}): {{number_format($thisYearTotalIncome)}} </span>
                                <span>Expense({{$year}}): {{number_format($thisYearTotalExpense)}}</span>
                            </p>
                            @if($thisYearDifference >= 0)
                            <p class="ml-auto d-flex flex-column text-right">
                                <span class="text-success">
                                    <i class="fas fa-arrow-up"></i> {{number_format($thisYearDifference,2)}}%
                                </span>
                                <span class="text-muted">Income Higher than Expense</span>
                            </p>
                            @else
                            <p class="ml-auto d-flex flex-column text-right">
                                <span class="text-danger">
                                    <i class="fas fa-arrow-down"></i> {{number_format($thisYearDifference,2)}}%
                                </span>
                                <span class="text-muted">Income Lower than Expense</span>
                            </p>
                            @endif
                        </div>
                        <!-- /.d-flex -->

                        <div class="position-relative mb-4">
                            <canvas id="sales-chart1" height="200"></canvas>
                        </div>

                        <div class="d-flex flex-row justify-content-end">
                            <span class="mr-2">
                                <i class="fas fa-square text-green"></i> Income
                            </span>

                            <span>
                                <i class="fas fa-square text-red"></i> Expense
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card -->
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="card">
                    <div class="card-header border-0">
                        <div class="d-flex justify-content-between">
                            <h4 class="card-title">Last Year Income and Expense</h4>
                            <a href="javascript:void(0);">More</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="d-flex">
                            <p class="d-flex flex-column">
                                <span>Income({{$lastYear}}): {{number_format($lastYearTotalIncome)}} </span>
                                <span>Expense({{$lastYear}}): {{number_format($lastYearTotalExpense)}}</span>
                            </p>
                            @if($lastYearDifference >= 0)
                            <p class="ml-auto d-flex flex-column text-right">
                                <span class="text-success">
                                    <i class="fas fa-arrow-up"></i> {{number_format($lastYearDifference,2)}}%
                                </span>
                                <span class="text-muted">Income Higher than Expense</span>
                            </p>
                            @else
                            <p class="ml-auto d-flex flex-column text-right">
                                <span class="text-danger">
                                    <i class="fas fa-arrow-down"></i> {{number_format($lastYearDifference,2)}}%
                                </span>
                                <span class="text-muted">Income Lower than Expense</span>
                            </p>
                            @endif
                        </div>
                        <!-- /.d-flex -->
                        <div class="position-relative mb-4">
                            <canvas id="sales-chart2" height="200"></canvas>
                        </div>

                        <div class="d-flex flex-row justify-content-end">
                            <span class="mr-2">
                                <i class="fas fa-square text-green"></i> Income
                            </span>

                            <span>
                                <i class="fas fa-square text-red"></i> Expense
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
                <!-- DONUT CHART -->
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Top 5 Income Categories ({{$year}})</h4>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <canvas id="donutChart1"></canvas>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
                <!-- DONUT CHART -->
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Top 5 Expense Categories ({{$year}})</h4>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <canvas id="donutChart2"></canvas>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- <div style="visibility: hidden;" class="row">
                <div class="col-md-6 col-6">

                </div>
                <div class="col-md-6 col-6">

                </div>
            </div> -->
        </div>
    </section>
</div>

<!-- plugin for the charts -->
<script src="{{asset('backend/assets/plugins/chart.js/Chart.min.js')}}"></script>
<!-- Script file for the charts -->
<script type="text/javascript">
    $(function () {

        'use strict'

        var ticksStyle = {
            fontColor: '#495057',
            fontStyle: 'bold'
        }

        var mode = 'index'
        var intersect = true

        var $salesChart1 = $('#sales-chart1')

        // chart 1
        var salesChart1 = new Chart($salesChart1, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                datasets: [
                    {
                        backgroundColor: 'green',
                        borderColor: 'green',
                        data: [@foreach($thisYearIncomeData as $key=>$value)
                                {{ $value }},
                                @endforeach]
          },
    {
        backgroundColor: 'red',
            borderColor: 'red',
                data: [@foreach($thisYearExpenseData as $key=> $value)
                            {{ $value }},
                        @endforeach]
          }
        ]
      },
    options: {
        maintainAspectRatio: false,
            tooltips: {
            mode: mode,
                intersect: intersect
        },
        hover: {
            mode: mode,
                intersect: intersect
        },
        legend: {
            display: false
        },
        scales: {
            yAxes: [{
                // display: false,
                gridLines: {
                    display: true,
                    lineWidth: '4px',
                    color: 'rgba(0, 0, 0, .2)',
                    zeroLineColor: 'transparent'
                },
                ticks: $.extend({
                    beginAtZero: true,

                    // Include a dollar sign in the ticks
                    callback: function (value) {
                        if (value >= 1000) {
                            value /= 1000
                            value += '  K'
                        }

                        return value
                    }
                }, ticksStyle)
            }],
                xAxes: [{
                    display: true,
                    gridLines: {
                        display: false
                    },
                    ticks: ticksStyle
                }]
        }
    }
    })
    // Chart two
    var $salesChart2 = $('#sales-chart2')

    // eslint-disable-next-line no-unused-vars
    var salesChart2 = new Chart($salesChart2, {
        type: 'bar',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            datasets: [
                {
                    backgroundColor: 'green',
                    borderColor: 'green',
                    data: [@foreach($lastYearIncomeData as $key=>$value)
                                {{ $value }},
                            @endforeach]
        },
    {
        backgroundColor: 'red',
            borderColor: 'red',
                data: [@foreach($lastYearExpenseData as $key=> $value)
                    {{ $value }},
    @endforeach]
        }
        ]
      },
    options: {
        maintainAspectRatio: false,
            tooltips: {
            mode: mode,
                intersect: intersect
        },
        hover: {
            mode: mode,
                intersect: intersect
        },
        legend: {
            display: false
        },
        scales: {
            yAxes: [{
                // display: false,
                gridLines: {
                    display: true,
                    lineWidth: '4px',
                    color: 'rgba(0, 0, 0, .2)',
                    zeroLineColor: 'transparent'
                },
                ticks: $.extend({
                    beginAtZero: true,

                    // Include a dollar sign in the ticks
                    callback: function (value) {
                        if (value >= 1000) {
                            value /= 1000
                            value += '  K'
                        }

                        return value
                    }
                }, ticksStyle)
            }],
                xAxes: [{
                    display: true,
                    gridLines: {
                        display: false
                    },
                    ticks: ticksStyle
                }]
        }
    }
    })
    // Donut 1
    var donutChartCanvas1 = $('#donutChart1').get(0).getContext('2d')
    var donutData = {
        labels: [
            @foreach($topFiveIncomeTypes as $key=>$value)
    '{{$value}}',
        @endforeach
      ],
    datasets: [
        {
            data: [@foreach($topFiveIncomeAmounts as $key=> $value)
              '{{$value}}',
            @endforeach],
            backgroundColor: ['#f56954', '#00a65a', '#f39c12', '#00c0ef', 'White'],
        }
    ]
    }
    var donutOptions = {
        maintainAspectRatio: false,
        responsive: true,
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    var donutChart = new Chart(donutChartCanvas1, {
        type: 'doughnut',
        data: donutData,
        options: donutOptions
    })
    // Donut 2
    var donutChartCanvas2 = $('#donutChart2').get(0).getContext('2d')
    var donutData = {
        labels: [
            @foreach($topFiveExpenseTypes as $key=>$value)
    '{{$value}}',
        @endforeach
      ],
    datasets: [
        {
            data: [@foreach($topFiveExpenseAmounts as $key=> $value)
              '{{$value}}',
            @endforeach],
            backgroundColor: ['#f56954', '#00a65a', '#f39c12', '#00c0ef', 'purple'],
        }
    ]
    }
    var donutOptions = {
        maintainAspectRatio: false,
        responsive: true,
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    var donutChart = new Chart(donutChartCanvas2, {
        type: 'doughnut',
        data: donutData,
        options: donutOptions
    })
  })
</script>
<script type="text/javascript">
    $('.selectIncome').select2()
    $('.selectExpense').select2()

    $(document).ready(function(){
        var incomeSelect = 0;
        var expenseSelect = 0;
        $(document).on('click', '.addincome', function(){
            incomeSelect++;
            var selectIncomeClass = 'selectInc'+incomeSelect;
            // var whole_extra_item_add_income = $('#whole_extra_item_add_income').html();
            var whole_extra_item_add_income = "<div class='whole_extra_item_add_income'id='whole_extra_item_add_income'><div class='delete_extra_item_income' id='delete_extra_item_income'><div class='form-group'><input name='date[]' required type='date'class='form-control form-control-sm' id='date'></div><div class='row'><div class='col-sm-12 col-xs-12 col-md-5 col-lg-5'><div class='row'><div class='form-group col-12'><select required name='incomeType[]' style='width: 100%;' class='"+selectIncomeClass+" form-control form-control-sm'><option value=''>--Choose Income Type--</option>@foreach($incomeTypeData as $incomeType)<option value='{{$incomeType->id}}'>{{$incomeType->name}}</option>@endforeach</select></div><div class='form-group col-12'><input  name='amount[]' required type='number' min=0 step='.01' class='form-control form-control-sm'id='amount'placeholder='Type the amount in Birr here'></div></div></div><div class='col-sm-12 col-xs-12 col-md-5 col-lg-5'><textarea name='description[]' id='' rows='3'class='form-control form-control-sm'placeholder='Some description about the income'></textarea></div><div class='mt-2 mb-2 col-sm-12 col-xs-12 col-md-2 col-lg-2 text-center'><span id='addincome' class='btn btn-success btn-sm addincome'><span class='fas fa-plus'></span></span><span id='removeincome' class='btn btn-danger btn-sm removeincome'><span class='fas fa-minus'></span></span></div></div></div></div>";
            $(".card_addincome").append(whole_extra_item_add_income);
            $('.'+selectIncomeClass).select2()
        });
        $(document).on('click', '.removeincome', function(event) {
            $(this).closest(".delete_extra_item_income").remove();
            incomeSelect--;
        });
        $(document).on('click', '.addexpense', function() {
            expenseSelect++;
            var selectExpenseClass = 'selectExp'+expenseSelect;
            var whole_extra_item_add_expense = "<div class='whole_extra_item_add_expense'id='whole_extra_item_add_expense'><div class='delete_extra_item_expense' id='delete_extra_item_expense'><div class='form-group'><input name='date[]' required type='date'class='form-control form-control-sm' id='date'></div><div class='row'><div class='col-sm-12 col-xs-12 col-md-5 col-lg-5'><div class='row'><div class='form-group col-12'><select style='width: 100%;' required name='expenseType[]'class='"+selectExpenseClass+" form-control form-control-sm' id='expenseType'><option value=''>--Choose Expense Type--</option>@foreach($expenseTypeData as $expenseType)<option value='{{$expenseType->id}}'>{{$expenseType->name}}</option>@endforeach</select></div><div class='form-group col-12'><input name='amount[]' required type='number' min=0 step='.01' class='form-control form-control-sm'id='amount'placeholder='Type the amount in Birr here'></div></div></div><div class='col-sm-12 col-xs-12 col-md-5 col-lg-5'><textarea name='description[]' id='' rows='3' class='form-control form-control-sm' placeholder='Some description about the expense'></textarea></div><div class='mt-2 mb-2 col-sm-12 col-xs-12 col-md-2 col-lg-2 text-center'><span id='addexpense' class='btn btn-success btn-sm addexpense'><span class='fas fa-plus'></span></span><span id='removeexpense'class='btn btn-danger btn-sm removeexpense'><span class='fas fa-minus'></span></span></div></div></div></div>";
            $(this).closest(".card_addexpense").append(whole_extra_item_add_expense);
            $('.'+selectExpenseClass).select2();
        });
        $(document).on('click', '.removeexpense', function(event) {
            expenseSelect--;
            $(this).closest(".delete_extra_item_expense").remove();
        });
    });

</script>
@endsection

@else
<div class="alert alert-warning">
    <h3 class="alert-title">Waiting for Approval</h3>
    <div class="alert-body">
        <p>Dear user, your account is waiting for approval. If the approval is waiting for too long please contact the admin <a href="https://t.me/solo_learner" target="_blank">Contact Admin</a></p>
    </div>
    <h4 class="text-danger"><a class="text-danger" href="{{ route('logout')}}">Logout</a></h4>
</div>
@endif
