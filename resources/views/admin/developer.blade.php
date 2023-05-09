@extends('admin.adminMaster')
@section('content')
<body class="hold-transition sidebar-mini dark-mode">
    <!-- Site wrapper -->
    <div class="wrapper">
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Developer</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                                <li class="breadcrumb-item active">Developer</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>
            <section class="content">
                <div class="container-fluid">
                    <div class="card card-solid">
                        <div class="card-body pb-0">
                            <div class="row d-flex align-items-stretch">
                                <div class="col-12 col-sm-12 col-md-12 align-items-stretch">
                                    <div class="card bg-light">
                                        <div class="card-body pt-0">
                                            <div class="row">
                                                <div class="col-md-5 col-lg-5 col-sm-12 col-xs-12 text-center">
                                                    <img style="height: 350px; width: 350px;"
                                                        src="{{url('uploads/developer/developer.JPG')}}"
                                                        alt="user-avatar" class="img-circle img-fluid">
                                                </div>
                                                <div class="col-md-7 col-lg-7 col-sm-12 col-xs-12">
                                                    <h2 class="text-muted"><b>Michael Mamo Teklebirhan</b></h2>
                                                    <p class="text-muted text-sm"><b>I am: </b> Web Designer / Web
                                                        Developer / Full Stack Developer / Data Engineer / Network
                                                        Marketor </p>
                                                    <ul class="ml-10 mb-0 fa-ul text-muted">
                                                        <li><span class="fa-li"><i
                                                                    class="fas fa-lg fa-globe"></i></span> Personal
                                                            Website #: <a href="https://personal.msolo-iems.com"
                                                                target="_blank">Visit My Site</a></li>
                                                        <li><span class="fa-li"><i class="fas fa-lg fa-home"></i></span>
                                                            Address: Addis Ababa, bole, wereda 13</li>
                                                        <li><span class="fa-li"><i
                                                                    class="fas fa-lg fa-phone"></i></span> Phone:
                                                            +251-935030322 / +251-906625917</li>
                                                        <li><span class="fa-li"><i
                                                                    class="fas fa-lg fa-building"></i></span> Work
                                                            Place: Bank of Abyssinia / Junior IT officer / MIS
                                                            Department</li>
                                                        <li><span class="fa-li"><i
                                                                    class="fas fa-lg fa-laptop"></i></span> Total
                                                            Projects #: Above 25</li>
                                                        <li><span class="fa-li"><i
                                                                    class="fas fa-lg fa-chart-line"></i></span> Sold
                                                            Projects #: Above 10</li>
                                                        <li><span class="fa-li"><i class="fas fa-lg fa-user"></i></span>
                                                            Freelance: <i class="text-success">Available</i></li>
                                                        <li><span class="fa-li"><i
                                                                    class="fas fa-lg fa-comments"></i></span>Any
                                                            Comments about the system would be appreciated via <a href="https://t.me/michael_solo_learner" target="_blank">Telegram</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <div class="text-right">
                                                <a href="#" class="btn btn-sm">
                                                <i class="fa fa-telegram" aria-hidden="true"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        @endsection
