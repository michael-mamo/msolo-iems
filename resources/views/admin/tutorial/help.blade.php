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
                            <h1>Help</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                                <li class="breadcrumb-item active">Help</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">

                        @foreach($allData as $tutorial)
                        <div class="col-6 col-md-6 col-sm-12">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">{{$tutorial->subtitle}}</h3>
                                </div>
                                <!-- /.card-header -->
                                <div height="400px" class="card-body">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="position-relative ">
                                                <div class="mt-5 mr-5 card-img-overlay text-secondary flex-column">
                                                    <p class="card-text text-white pb-2 pt-1">{{$tutorial->description}}
                                                    </p>
                                                    <a href="#" class="text-white">Posted At:
                                                        {{$tutorial->created_at}}</a>
                                                </div>
                                                <video height="100%" width="100%" controls
                                                    src="{{url('uploads/tutorials/'.$tutorial->file)}}"></video>
                                                <div class="ribbon-wrapper ribbon-xl">
                                                    <div class="ribbon ribbon-sm bg-success text-sm">
                                                        {{$tutorial->title}}
                                                    </div>
                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                        @endforeach
                    </div>
                    <!-- /.row -->

                </div>
                <!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
</body>
@endsection
