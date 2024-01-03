@extends('admin.adminMaster')
@section('content')
@php
use Carbon\Carbon;
@endphp

<style>
@page { size: auto;  margin: 0mm; }
</style>
<body class="hold-transition sidebar-mini dark-mode">
    <div class="wrapper">
        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>PDF Generator</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="">Dashboard</a></li>
                                <li class="breadcrumb-item active">PDF Generator</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </section>
            <section class="content" id="printMe">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <!-- /.card-header -->
                            <div class="card-body">
                                <a class="btn btn-primary float-left" target="_blank" href="{{route('customer.add')}}">
                                    Register <span class="fa fa-plus"></span>
                                </a>
                                <!-- list of registered roles in table -->
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Passport Number</th>
                                            <th>Full Name</th>
                                            <th>View</th>
                                            <th>Print</th>
                                            <th>Download</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($allData as $key=>$customer)
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>{{$customer->passportnumber}}</td>
                                            <td>{{$customer->fullname}}</td>
                                            <td class="text-center">
                                                <div class="btn-group bg-success">
                                                    <button type="button" class="btn btn-sm btn-secondary float-left"
                                                        data-toggle="modal"
                                                        data-target="#viewBa{{$customer->id}}">
                                                        BA</span>
                                                    </button>
                                                    <button type="button" class="btn btn-sm btn-secondary float-left"
                                                        data-toggle="modal"
                                                        data-target="#viewDu{{$customer->id}}">
                                                        DU</span>
                                                    </button>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <div class="btn-group bg-success">
                                                    <button class="btn btn-sm btn-success" onclick="printReportBA()"><i>BA</i>
                                                    </button>
                                                    <button class="btn btn-sm btn-success" onclick="printReportDU()"><i>DU</i>
                                                    </button>
                                                </div>
                                            </td>
                                            
                                            <td class="text-center">
                                                <div class="btn-group bg-success">
                                                    <a type="button" id="btnDownloadBa{{$customer->id}}" class="btn btn-sm btn-danger">
                                                        <i>BA</i>
                                                    </a>
                                                    <a type="button" id="btnDownloadDu{{$customer->id}}" class="btn btn-sm btn-danger">
                                                        <i>DU</i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Passport Number</th>
                                            <th>Full Name</th>
                                            <th>View</th>
                                            <th>Print</th>
                                            <th>Download</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </section>
        </div>
        <!-- /.content-wrapper -->
        <!-- Include the footer here -->
    </div>
    @foreach($allData as $key=>$customer)
    <div class="modal fade text-left" id="viewBa{{$customer->id}}">
        <div class="modal-dialog modal-xl" id="downloadBa{{$customer->id}}">
            <div class="modal-content" id="printBa{{$customer->id}}">
                <div class="modal-header">
                    <img src="{{url('uploads/pdfimages/static/ba.png')}}" style="height:120px; width:100%;">
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-3">
                            <img src="{{url('uploads/pdfimages/protraitimage/'.$customer->protraitimage)}}"
                                style="height:150px; width:100%;" />
                        </div>
                        <div class="col-9">
                            <h6 class="float-left">phone: {{$customer->phone}}
                            </h6>
                            <h4 class="text-danger float-right">REF:
                            </h4>
                            <table class="table table-bordered table-sm">
                                <tr>
                                    <td>POST APPLIED FOR</td>
                                    <td>{{$customer->appliedfor}}</td>
                                    <td>arabic part</td>
                                </tr>
                                <tr>
                                    <td>Post Applied For</td>
                                    <td>{{$customer->appliedfor}}</td>
                                    <td>arabic part</td>
                                </tr>
                                <tr>
                                    <td>Post Applied For</td>
                                    <td>{{$customer->appliedfor}}</td>
                                    <td>arabic part</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <table class="table table-bordered table-sm">
                                <tr>
                                    <td>NAME IN FULL</td>
                                    <td>{{$customer->fullname}}</td>
                                    <td>arabic part</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <h6>DETAILS OF APPLICATION</h6>
                            <table class="table table-bordered table-condensed table-sm">
                                <tr>
                                    <td><small>NATIONALITY</small></td>
                                    <td><small>ETHIOPIA</small></td>
                                    <td><small>arabic part</small></td>
                                </tr>
                                <tr>
                                    <td><small>RELEGION</small></td>
                                    <td><small>{{$customer->relegion}}</small></td>
                                    <td><small>arabic part</small></td>
                                </tr>
                                <tr>
                                    <td><small>DATE OF BIRTH</small></td>
                                    <td><small>{{$customer->dateofbirth}}</small></td>
                                    <td><small>arabic part</small></td>
                                </tr>
                                <tr>
                                    <td><small>AGE</small></td>
                                    <td><small>{{ Carbon::parse($customer->dateofbirth)->age ?? 0 }}</small></td>
                                    <td><small>arabic part</small></td>
                                </tr>
                                <tr>
                                    <td><small>PLACE OF BIRTH</small></td>
                                    <td><small>{{$customer->place}}</small></td>
                                    <td><small>arabic part</small></td>
                                </tr>
                                <tr>
                                    <td><small>LIVING TOWN</small></td>
                                    <td><small>{{$customer->town}}</small></td>
                                    <td><small>arabic part</small></td>
                                </tr>
                                <tr>
                                    <td><small>MARITAL STATUS</small></td>
                                    <td><small>{{$customer->maritalstatus}}</small></td>
                                    <td><small>arabic part</small></td>
                                </tr>
                                <tr>
                                    <td><small>NO. OF CHILDEREN</small></td>
                                    <td><small>{{$customer->children}}</small></td>
                                    <td><small>arabic part</small></td>
                                </tr>
                                <tr>
                                    <td><small>WEIGHT</small></td>
                                    <td><small>{{$customer->weight}}</small></td>
                                    <td><small>arabic part</small></td>
                                </tr>
                                <tr>
                                    <td><small>HEIGHT</small></td>
                                    <td><small>{{$customer->height}}</small></td>
                                    <td><small>arabic part</small></td>
                                </tr>
                                <tr>
                                    <td><small>COMPLEXION</small></td>
                                    <td><small>{{$customer->complexion}}</small></td>
                                    <td><small>arabic part</small></td>
                                </tr>
                                <tr>
                                    <td><small>EDUCATIONAL</small></td>
                                    <td><small>{{$customer->education}}</small></td>
                                    <td><small>arabic part</small></td>
                                </tr>
                            </table>
                            <h6 class="float-left">KNOWLEDGE OF LANGUAGE</h6>
                            <h6 class="float-right">arabic part</h6>
                            <table class="table table-bordered table-sm">
                                <tr>
                                    <td>LANGUAGE</td>
                                    <td>SPEAK</td>
                                    <td>WRITE</td>
                                    <td>READ</td>
                                </tr>
                                <tr>
                                    <td>ARABIC</td>
                                    <td>{{$customer->arabics == 1?'YES':'NO'}}</td>
                                    <td>{{$customer->arabicw == 1?'YES':'NO'}}</td>
                                    <td>{{$customer->arabicr == 1?'YES':'NO'}}</td>
                                </tr>
                                <tr>
                                    <td>ENGLISH</td>
                                    <td>{{$customer->englishs == 1?'YES':'NO'}}</td>
                                    <td>{{$customer->englishw == 1?'YES':'NO'}}</td>
                                    <td>{{$customer->englishr == 1?'YES':'NO'}}</td>
                                </tr>
                            </table>
                            <h6 class="float-left">PREVIOUS EMPLOYEMENT BROAD</h6>
                            <h6 class="float-right">arabic part</h6>
                            <table class="table table-bordered table-sm">
                                <tr>
                                    <td>COUNTRY</td>
                                    <td>{{$customer->empcountry}}</td>
                                    <td>arabic part</td>
                                </tr>
                                <tr>
                                    <td>PERIOD</td>
                                    <td>{{$customer->empperiod}}</td>
                                    <td>arabic part</td>
                                </tr>
                            </table>
                            <h6 class="float-left">WORK EXPERIANCE</h6>
                            <h6 class="float-right">arabic part</h6>
                            <table class="table table-bordered table-sm">
                                <tr>
                                    <td>DRIVING</td>
                                    <td>{{$customer->driving == 1?'YES':'NO'}}</td>
                                    <td>arabicpart</td>
                                </tr>
                                <tr>
                                    <td>COOKING</td>
                                    <td>{{$customer->cooking == 1?'YES':'NO'}}</td>
                                    <td>arabicpart</td>
                                </tr>
                                <tr>
                                    <td>CLEANING</td>
                                    <td>{{$customer->cleaning == 1?'YES':'NO'}}</td>
                                    <td>arabicpart</td>
                                </tr>
                                <tr>
                                    <td>WASHING</td>
                                    <td>{{$customer->washing == 1?'YES':'NO'}}</td>
                                    <td>arabicpart</td>
                                </tr>
                                <tr>
                                    <td>BABY SITTING</td>
                                    <td>{{$customer->babyseat == 1?'YES':'NO'}}</td>
                                    <td>arabicpart</td>
                                </tr>
                                <tr>
                                    <td>SEWING</td>
                                    <td>{{$customer->sewing == 1?'YES':'NO'}}</td>
                                    <td>arabicpart</td>
                                </tr>

                            </table>
                            <h4>{{$customer->delala}}</h4>
                            <h6>DATE ____________________________________________ arabic part</h6>
                        </div>
                        <div class="col-6">
                            <h6>PASSPORT DETAILS</h6>
                            <table class="table table-bordered table-condensed table-sm">
                                <tr>
                                    <td><small><b>NUMBER</b></small></td>
                                    <td><small>{{$customer->passportnumber}}</small></td>
                                    <td><small>arabic part</small></td>
                                </tr>
                                <tr>
                                    <td><small>DATE OF ISSUE</small></td>
                                    <td><small>{{$customer->pdate}}</small></td>
                                    <td><small>arabic part</small></td>
                                </tr>
                                <tr>
                                    <td><small>PLACE OF ISSUE</small></td>
                                    <td><small>{{$customer->pplace}}</small></td>
                                    <td><small>arabic part</small></td>
                                </tr>
                                <tr>
                                    <td><small>DATE OF ESP.</small></td>
                                    <td><small>{{$customer->pexpiry}}</small></td>
                                    <td><small>arabic part</small></td>
                                </tr>
                            </table>
                            <img src="{{url('uploads/pdfimages/fullimage/'.$customer->fullimage)}}"
                                style="height:800px; width:100%; border: 1px;" alt="">
                        </div>
                    </div>
                    <div class="row bg-blue ">
                        <div class="col-12 text-center">
                            <h2 class="text-orange">BADAWOOD RECRUITING OFFICE</h2>
                        </div>

                    </div>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <div class=" modal fade text-left" id="viewDu{{$customer->id}}">
        <div class="modal-dialog modal-xl">
            <div class="modal-content downloadDu{{$customer->id}}" id="printDu{{$customer->id}}">
                <div class="modal-header">
                    <img style="height:150px; width:100%;" src="{{url('uploads/pdfimages/static/du.png')}}">
                </div>
                <div class="modal-body">
                    <div></div>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    @endforeach
    <!-- ./wrapper -->
    <script>
        $(function () {
            $("#example1").DataTable({
                scrollX: true,
                "responsive": false, "lengthChange": true, "autoWidth": false,
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        });
    </script>
    <script>
        @foreach($allData as $key=> $customer)
        $("#btnDownloadBa{{$customer->id}}").click(function () {
            // Convert the DOM element to a drawing using kendo.drawing.drawDOM
            $('#viewBa{{$customer->id}}').addClass('show');
            // console.log(document.getElementById("printBa{{$customer->id}}"));
            kendo.drawing.drawDOM($('#viewBa{{$customer->id}}'))
                .then(function (group) {
                    // Render the result as a PDF file
                    return kendo.drawing.exportPDF(group, {
                        paperSize: "A4",
                        margin: { left: "1cm", top: "1cm", right: "1cm", bottom: "1cm" }
                    });
                })
                .done(function (data) {
                    // Save the PDF file
                    kendo.saveAs({
                        dataURI: data,
                        fileName: "{{$customer->fullname}}-BA.pdf",
                    });
                });
        });
        $("#btnDownloadDu{{$customer->id}}").click(function () {
            // Convert the DOM element to a drawing using kendo.drawing.drawDOM
            // $("#downloadDu{{$customer->id}}").show();
            kendo.drawing.drawDOM($(".downloadDu{{$customer->id}}").modal(), {forcePageBreak: ".page-break" })
                .then(function (group) {
                    // Render the result as a PDF file
                    
                    return kendo.drawing.exportPDF(group, {
                        paperSize: "auto",
                        multiPage: true,
                        margin: { left: "1cm", top: "1cm", right: "1cm", bottom: "1cm" }
                    });
                })
                .done(function (data) {
                    // Save the PDF file
                    kendo.saveAs({
                        dataURI: data,
                        fileName: "{{$customer->fullname}}-BA.pdf",
                    });
                });
        });
        @endforeach
    </script>
    <script>
        @foreach($allData as $key=> $customer)
        function printReportBA(){
            var printData =  document.getElementById("printBa{{$customer->id}}").innerHTML
            var originalContents = document.body.innerHTML
            document.body.innerHTML = printData
            window.print();
            document.body.innerHTML = originalContents;
        }
        function printReportDU(){
            var printData =  document.getElementById("printDu{{$customer->id}}").innerHTML
            var originalContents = document.body.innerHTML
            document.body.innerHTML = printData
            window.print();
            document.body.innerHTML = originalContents;
        }
        @endforeach
</script>
</body>
@endsection