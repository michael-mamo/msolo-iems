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
                        @foreach($tutorialCategory as $category)
                        <div class="col-md-12 col-lg-12 col-sm-12">
                            <div class="card">
                                <div class="ribbon-wrapper ribbon-xl">
                                    <div class=" ribbon ribbon-sm bg-success text-xm">
                                        {{$category->name}}
                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <div height="300px" class="card-body">
                                    <div class="row">
                                        @foreach($allData as $tutorial)
                                        @if($tutorial->category == $category->id )
                                        <div class="col-md-6 col-sm-12 col-lg-4 ">
                                            <div class="card card-outline card-primary">
                                                <div class="card-header">
                                                    <h6 class="username">{{$tutorial->title}}</h6>

                                                </div>
                                                <!-- /.card-header -->
                                                <div class="card-body p-0 m-0">
                                                    <video height="100%" width="100%" controls
                                                        src="{{url('uploads/tutorials/'.$category->name.'/'.$tutorial->file)}}">\
                                                    </video>
                                                </div>
                                                <div class="card-footer ">
                                                    <div id="accordion{{$tutorial->id}}">
                                                        <h6 class="card-title w-100 pt-0">
                                                            <a class="text-sm" data-toggle="collapse"
                                                                href="#collapse{{$tutorial->id}}">
                                                                {{$tutorial->subtitle}}
                                                            </a>
                                                        </h6>
                                                    </div>
                                                    <div id="collapse{{$tutorial->id}}" class="collapse p-0 m-0"
                                                        data-parent="#accordion{{$tutorial->id}}">
                                                        <span
                                                            class="text-muted text-sm">{{$tutorial->description}}</span>
                                                        <span
                                                            class="float-right text-muted text-xs"><b>{{$tutorial->created_at}}</b></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                        @endforeach
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