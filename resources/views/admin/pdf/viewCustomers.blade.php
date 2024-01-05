@extends('admin.adminMaster')
@section('content')
@php
use Carbon\Carbon;
@endphp
<style>
    @page {
        size: auto;
        margin: 0mm;
    }

    @media print {
        #viewBa {
            display: block;
        }
    }
    .table {
    padding:0; 
    margin:0;
    cellpadding: 0; 
    cellspacing: 0;
    }
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
                                <table id="example1" class="table table-bordered table-condensed table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Passport Number</th>
                                            <th>Full Name</th>
                                            <th>View/Download</th>
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
                                                        data-toggle="modal" data-target="#viewBa{{$customer->id}}">
                                                        BA</span>
                                                    </button>
                                                    <button type="button" class="btn btn-sm btn-secondary float-left"
                                                        data-toggle="modal" data-target="#viewBa{{$customer->id}}">
                                                        BA</span>
                                                    </button>
                                                    <button type="button" class="btn btn-sm btn-secondary float-left"
                                                        data-toggle="modal" data-target="#viewBa{{$customer->id}}">
                                                        BA</span>
                                                    </button>
                                                    <button type="button" class="btn btn-sm btn-secondary float-left"
                                                        data-toggle="modal" data-target="#viewBa{{$customer->id}}">
                                                        BA</span>
                                                    </button>
                                                    <!-- <button type="button" class="btn btn-sm btn-secondary float-left"
                                                        data-toggle="modal" data-target="#viewDu{{$customer->id}}">
                                                        DU</span>
                                                    </button> -->
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
                                            <th>View/Download</th>
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
        <div class="modal-dialog modal-lg" id="downloadBa{{$customer->id}}">
            <div class="modal-content" id="printBa{{$customer->id}}">
                <div class="modal-body" id="downloadKendo{{$customer->id}}">
                    <img src="{{url('uploads/pdfimages/static/ba.png')}}" style="height:60px; width:100%;">
                    <div class="row">
                        <div class="col-3 text-center">
                            <img src="{{url('uploads/pdfimages/protraitimage/'.$customer->protraitimage)}}"
                                style="height:120px; width:150px;" />
                        </div>
                        <div class="col-9">
                            <small class="float-left text-bold">PHONE:- {{$customer->phone}}</small>
                            <small class="text-danger float-right">REF:</small>
                            <table class="table table-bordered table-condensed table-condensed table-sm text-sm">
                                <tr>
                                    <th>POST APPLIED FOR</th>
                                    <td>{{$customer->appliedfor}}</td>
                                    <td>arabic part</td>
                                </tr>
                                <tr>
                                    <th>MONTHLY SALARY</th>
                                    <td>{{$customer->salary}}</td>
                                    <td>arabic part</td>
                                </tr>
                                <tr>
                                    <th>CONTRACT PERIOD</th>
                                    <td>{{$customer->contactperiod}}</td>
                                    <td>arabic part</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <table class="table table-bordered table-condensed table-sm text-sm">
                                <tr>
                                    <th>NAME IN FULL</th>
                                    <th>{{$customer->fullname}}</th>
                                    <td>arabic part</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <small>DETAILS OF APPLICATION</small>
                            <table class="table table-bordered table-condensed table-condensed table-sm text-sm">
                                <tr>
                                    <td><b>NATIONALITY</b></td>
                                    <td>ETHIOPIA</td>
                                    <td>arabic part</td>
                                </tr>
                                <tr>
                                    <td><b>RELEGION</b></td>
                                    <td>{{$customer->relegion}}</td>
                                    <td>arabic part</td>
                                </tr>
                                <tr>
                                    <th>DATE OF BIRTH</th>
                                    <td>{{$customer->dateofbirth}}</td>
                                    <td>arabic part</td>
                                </tr>
                                <tr>
                                    <th>AGE</th>
                                    <td>{{ Carbon::parse($customer->dateofbirth)->age ?? 0 }}</td>
                                    <td>arabic part</td>
                                </tr>
                                <tr>
                                    <th>PLACE OF BIRTH</th>
                                    <td>{{$customer->place}}</td>
                                    <td>arabic part</td>
                                </tr>
                                <tr>
                                    <th>LIVING TOWN</th>
                                    <td>{{$customer->town}}</td>
                                    <td>arabic part</td>
                                </tr>
                                <tr>
                                    <th>MARITAL STATUS</th>
                                    <td>{{$customer->maritalstatus}}</td>
                                    <td>arabic part</td>
                                </tr>
                                <tr>
                                    <th>NO. OF CHILDEREN</th>
                                    <td>{{$customer->children}}</td>
                                    <td>arabic part</td>
                                </tr>
                                <tr>
                                    <th>WEIGHT</th>
                                    <td>{{$customer->weight}}</td>
                                    <td>arabic part</td>
                                </tr>
                                <tr>
                                    <th>HEIGHT</th>
                                    <td>{{$customer->height}}</td>
                                    <td>arabic part</td>
                                </tr>
                                <tr>
                                    <th>COMPLEXION</th>
                                    <td>{{$customer->complexion}}</td>
                                    <td>arabic part</td>
                                </tr>
                                <tr>
                                    <th>EDUCATIONAL</th>
                                    <td>{{$customer->education}}</td>
                                    <td>arabic part</td>
                                </tr>
                            </table>
                            <small class="float-left">KNOWLEDGE OF LANGUAGE</small>
                            <small class="float-right">arabic part</small>
                            <table class="table table-bordered table-condensed table-sm text-sm">
                                <tr>
                                    <th>LANGUAGE</th>
                                    <th>SPEAK</th>
                                    <th>WRITE</th>
                                    <th>READ</th>
                                </tr>
                                <tr>
                                    <th>ARABIC</th>
                                    <td>{{$customer->arabics == 1?'YES':'NO'}}</td>
                                    <td>{{$customer->arabicw == 1?'YES':'NO'}}</td>
                                    <td>{{$customer->arabicr == 1?'YES':'NO'}}</td>
                                </tr>
                                <tr>
                                    <th>ENGLISH</th>
                                    <td>{{$customer->englishs == 1?'YES':'NO'}}</td>
                                    <td>{{$customer->englishw == 1?'YES':'NO'}}</td>
                                    <td>{{$customer->englishr == 1?'YES':'NO'}}</td>
                                </tr>
                            </table>
                            <small class="float-left">PREVIOUS EMPLOYEMENT BROAD</small>
                            <small class="float-right">arabic part</small>
                            <table class="table table-condensed table-bordered table-sm text-sm">
                                <tr>
                                    <th>COUNTRY</th>
                                    <td>{{$customer->empcountry}}</td>
                                    <td>arabic part</td>
                                </tr>
                                <tr>
                                    <th>PERIOD</th>
                                    <td>{{$customer->empperiod}}</td>
                                    <td>arabic part</td>
                                </tr>
                            </table>
                            <small class="float-left">WORK EXPERIANCE</small>
                            <small class="float-right">arabic part</small>
                            <table class="table table-condensed table-bordered table-sm text-sm">
                                <tr>
                                    <th>DRIVING</th>
                                    <td>{{$customer->driving == 1?'YES':'NO'}}</td>
                                    <td>arabicpart</td>
                                </tr>
                                <tr>
                                    <th>COOKING</th>
                                    <td>{{$customer->cooking == 1?'YES':'NO'}}</td>
                                    <td>arabicpart</td>
                                </tr>
                                <tr>
                                    <th>CLEANING</th>
                                    <td>{{$customer->cleaning == 1?'YES':'NO'}}</td>
                                    <td>arabicpart</td>
                                </tr>
                                <tr>
                                    <th>WASHING</th>
                                    <td>{{$customer->washing == 1?'YES':'NO'}}</td>
                                    <td>arabicpart</td>
                                </tr>
                                <tr>
                                    <th>BABY SITTING</th>
                                    <td>{{$customer->babyseat == 1?'YES':'NO'}}</td>
                                    <td>arabicpart</td>
                                </tr>
                                <tr>
                                    <th>SEWING</th>
                                    <td>{{$customer->sewing == 1?'YES':'NO'}}</td>
                                    <td>arabicpart</td>
                                </tr>
                            </table>
                            <small>{{$customer->delala}}</small>
                            <br>
                            <small class="float-left">DATE _____________________________________ </small>
                            <small class="float-right">arabic part</small>
                        </div>
                        <div class="col-6">
                            <small class="float-left">PASSPORT DETAILS</small>
                            <table class="table table-bordered table-condensed table-sm text-sm">
                                <tr>
                                    <th>NUMBER</th>
                                    <td>{{$customer->passportnumber}}</td>
                                    <td>arabic part</td>
                                </tr>
                                <tr>
                                    <th>DATE OF ISSUE</th>
                                    <td>{{$customer->pdate}}</td>
                                    <td>arabic part</td>
                                </tr>
                                <tr>
                                    <th>PLACE OF ISSUE</th>
                                    <td>{{$customer->pplace}}</td>
                                    <td>arabic part</td>
                                </tr>
                                <tr>
                                    <th>DATE OF ESP.</th>
                                    <td>{{$customer->pexpiry}}</td>
                                    <td>arabic part</td>
                                </tr>
                            </table>
                            <img src="{{url('uploads/pdfimages/fullimage/'.$customer->fullimage)}}"
                                style="height:700px; width:100%; border: 1px;" alt="">
                        </div>
                    </div>
                    <img src="{{url('uploads/pdfimages/static/baFooter.png')}}" style="height:30px; width:100%;">
                    <div class="row mt-5">
                        <img src="{{url('uploads/pdfimages/passportimage/'.$customer->passportimage)}}"
                            style="height:800px; width:100%;">
                    </div>
                </div>
                <div class="modal-footer text-center">
                    <!-- <button id="btnDownloadBaModal{{$customer->id}}" class="btn btn-secondary">Download</button> -->
                    <button onclick='saveToPDF{{$customer->id}}()' class="btn btn-success">Save to PDF</button>
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
    <script src="https://rawgit.com/eKoopmans/html2pdf/master/dist/html2pdf.bundle.js"></script>


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
        function saveToPDF{{$customer->id}}() {
            window.scrollTo(0, 0);
            var contentToSave = document.getElementById('downloadKendo{{$customer->id}}');
            html2pdf(contentToSave, {
                filename: '{{$customer->fullname}} BA.pdf',
                jsPDF: { unit: 'in', format: 'a4', orientation: 'portrait' }
            });
        }
        @endforeach
    </script>

    <script>

        @foreach($allData as $key=> $customer)
        $("#btnDownloadBaModal{{$customer->id}}").click(function () {
            // Convert the DOM element to a drawing using kendo.drawing.drawDOM
            // $('#downloadKendo{{$customer->id}}').addClass('show');
            // console.log(document.getElementById("printBa{{$customer->id}}"));
            kendo.drawing.drawDOM($('#downloadKendo{{$customer->id}}'))
                .then(function (group) {
                    // Render the result as a PDF file
                    return kendo.drawing.exportPDF(group, {
                        paperSize: "a4",
                        // margin: { left: "1cm", top: "1cm", right: "1cm", bottom: "1cm" }
                        forcePageBreak: ".page-break"
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
            kendo.drawing.drawDOM($(".downloadDu{{$customer->id}}").modal(), { forcePageBreak: ".page-break" })
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
        function printReportBA() {
            var printData = document.getElementById("printBa{{$customer->id}}").innerHTML
            var originalContents = document.body.innerHTML
            document.body.innerHTML = printData
            window.print();
            document.body.innerHTML = originalContents;
        }
        function printReportDU() {
            var printData = document.getElementById("printDu{{$customer->id}}").innerHTML
            var originalContents = document.body.innerHTML
            document.body.innerHTML = printData
            window.print();
            document.body.innerHTML = originalContents;
        }
        @endforeach
    </script>
</body>
@endsection