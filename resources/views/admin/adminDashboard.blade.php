@extends('admin.adminMaster')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Admin Dashboard</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">My Dashboard</a></li>
                <li class="breadcrumb-item active">Admin Dashboard</li>
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
            <div class="col-lg-3 col-md-6 col-sm-12">
                <!-- small box -->
                <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{number_format($userCount)}}<span class="fa fa-user float-right"></span></h3>
                    <p>Total Users</p>
                    <p class="text-sm">{{number_format($activeUserCount)}} Active | {{number_format($inActiveUserCount)}} Inactive</p>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
                <a href="{{route('user.view')}}" class="small-box-footer">More Info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-md-6 col-sm-12">
                <!-- small box -->
                <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{number_format($userTypeCount)}}<span class="fas fa-cart float-right"></span></h3>
                    <p>Total Usertype</p>
                    <p class="text-sm">{{number_format($activeUserTypeCount)}} Active | {{number_format($inActiveUserTypeCount)}} Inactive</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <a href="{{route('usertype.view')}}" class="small-box-footer">More Info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-md-6 col-sm-12">
                <!-- small box -->
                <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{number_format($incomeTypeCount)}}<span class="fa fa-users float-right"></span></h3>
                    <p>Total Income Type</p>
                    <p class="text-sm">{{number_format($activeIncomeTypeCount)}} Active | {{number_format($inActiveIncomeTypeCount)}} Inactive</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
                <a href="{{route('incomeType.view')}}" class="small-box-footer">More Info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-md-6 col-sm-12">
                <!-- small box -->
                <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{number_format($expenseTypeCount)}}<span class="fa fa-ban float-right"></span></h3>
                    <p>Total Expense Type</p>
                    <p class="text-sm">{{number_format($activeExpenseTypeCount)}} Active | {{number_format($inActiveExpenseTypeCount)}} Inactive</p>
                </div>
                <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                </div>
                <a href="{{route('expenseType.view')}}" class="small-box-footer">More Info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    <section class="container">
        <div class="row">
            <!-- /.col-md-6 -->
            <div class="col-lg-8 col-sm-12 col-md-12">
            <div class="card">
                <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                    <h3 class="card-title">Total Monthly Registrants</h3>
                    <a href="javascript:void(0);">More</a>
                </div>
                </div>
                <div class="card-body">
                <div class="d-flex">
                    <p class="d-flex flex-column">
                    <span>Active Users({{$year}}): {{$thisYearActiveUser}}  </span>
                    <span>Active Users({{$lastYear}}): {{$lastYearActiveUser}}</span>
                    <span>Total Annual Registrant ({{$lastYear}} - {{$year}})</span>
                    </p>
                    @if($thisYearDifference >= 0)
                    <p class="ml-auto d-flex flex-column text-right">
                      <span class="text-success">
                        <i class="fas fa-arrow-up"></i> {{number_format($thisYearDifference,2)}}%
                      </span>
                      <span class="text-muted">This Year Higher than Last Year</span>
                    </p>
                    @else
                    <p class="ml-auto d-flex flex-column text-right">
                      <span class="text-danger">
                        <i class="fas fa-arrow-down"></i> {{number_format($thisYearDifference,2)}}%
                      </span>
                      <span class="text-muted">This Year Lower than Last Year</span>
                    </p>
                    @endif
                </div>
                <!-- /.d-flex -->

                <div class="position-relative mb-4">
                    <canvas id="sales-chart" height="200"></canvas>
                </div>

                <div class="d-flex flex-row justify-content-end">
                    <span class="mr-2">
                    <i class="fas fa-square text-primary"></i> This Year
                    </span>

                    <span>
                    <i class="fas fa-square text-gray"></i> Last Year
                    </span>
                </div>
                </div>
            </div>
            </div>
            <!-- /.card -->
            <div class="col-lg-4 col-md-12 col-sm-12">
            <!-- DONUT CHART -->
            <div class="card">
                <div class="card-header">
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
                <canvas id="donutChart"
                    style="min-height: 320px; height: 320px; max-height: 320px; max-width: 100%;"></canvas>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
            </div>
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

      var $salesChart = $('#sales-chart')
      // eslint-disable-next-line no-unused-vars
      var salesChart = new Chart($salesChart, {
        type: 'bar',
        data: {
          labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
          datasets: [
            {
              backgroundColor: '#007bff',
              borderColor: '#007bff',
              data: [@foreach($thisYearMonthlyUser as $key=>$value)
              '{{$value}}',
              @endforeach]
            },
            {
              backgroundColor: '#ced4da',
              borderColor: '#ced4da',
              data: [@foreach($lastYearMonthlyUser as $key=>$value)
              '{{$value}}',
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
      var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
      var donutData = {
        labels: [
          @foreach($topUserTypeName as $key=>$value)
          '{{$value}}',
          @endforeach
        ],
        datasets: [
          {
            data: [@foreach($topUserTypeCount as $key=>$value)
                  '{{$value}}',
                  @endforeach],
            backgroundColor: ['#f56954', '#00a65a', '#f39c12', '#00c0ef'],
          }
        ]
      }
      var donutOptions = {
        maintainAspectRatio: false,
        responsive: true,
      }
      //Create pie or douhnut chart
      // You can switch between pie and douhnut using the method below.
      var donutChart = new Chart(donutChartCanvas, {
        type: 'doughnut',
        data: donutData,
        options: donutOptions
      })
    })
  </script>
  @endsection
