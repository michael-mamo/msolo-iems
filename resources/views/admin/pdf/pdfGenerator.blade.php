@include('admin.body.header')
@include('admin.body.script')
<!-- <body class="hold-transition login-page dark-mode"> -->

<body class="hold-transition">
    <div>
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="#" class="h1"><b>PDF Generator</b></a>
            </div>
            @if($isEdit == 0)
            <div class="card-body">
                <p class="login-box-msg">Fill in the form and click generate PDF</p>
                <form action="{{route('customer.register')}}" enctype="multipart/form-data" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <!-- left column -->
                            <div class="col-md-6">
                                <!-- general form elements -->
                                <div class="card card-outline card-primary">
                                    <div class="card-header text-center">
                                        <h4>Customer Data</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="fullname">Full Name</label>
                                            <input type="text" name="fullname" class="form-control form-control-sm"
                                                id="fullname" placeholder="Enter full name here">
                                        </div>
                                        <div class="form-group">
                                            <label for="phone">Phone</label>
                                            <input type="number" name="phone" class=" form-control form-control-sm"
                                                id="phone" placeholder="Enter phone number here">
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12 col-xs-12 col-md-6 col-lg-6">
                                                <div class="form-group">
                                                    <label for="portraitImage" class="text-sm">Portrait
                                                        Image</label>
                                                    <input type="file" id="portraitImage" name="portraitimage"
                                                        class="form-control-sm">
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-xs-12 col-md-6 col-lg-6">
                                                <div class="text-center form-group">
                                                    <img id="showPortraitImage" width="100px" height="100px">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12 col-xs-12 col-md-6 col-lg-6">
                                                <div class="form-group">
                                                    <label for="fullImage" class="text-sm">Full
                                                        Image</label>
                                                    <input type="file" id="fullImage" name="fullimage"
                                                        class="form-control-sm">
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-xs-12 col-md-6 col-lg-6">
                                                <div class="text-center form-group">
                                                    <img id="showFullImage" width="100px" height="100px">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12 col-xs-12 col-md-6 col-lg-6">
                                                <div class="form-group">
                                                    <label for="passportImage" class="text-sm">Passport
                                                        Image</label>
                                                    <input type="file" id="passportImage" name="passportimage"
                                                        class="form-control-sm">
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-xs-12 col-md-6 col-lg-6">
                                                <div class="text-center form-group">
                                                    <img id="showPassportImage" width="100px" height="100px">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card card-outline card-primary">
                                    <div class="card-header text-center">
                                        <h4>Details Of Application</h4>
                                    </div>
                                    <div class="card-body">
                                        <!-- <div class="form-group">
                                                <label for="nationality">Nationality</label>
                                                <select name="nationality" class="form-control form-control-sm"
                                                    id="nationality">
                                                    <option selected>Ethiopia</option>
                                                    <option>Other</option>
                                                </select>
                                            </div> -->
                                        <div class="form-group">
                                            <label for="dob">Religion</label>
                                            <select name="relegion" class="form-control form-control-sm" id="relegion">
                                                <option value="ORTHODOX" selected>ORTHODOX</option>
                                                <option value="MUSLIM">MUSLIM</option>
                                                <option value="CHRISTIAN">CHRISTIAN</option>
                                                <option value="OTHER">OTHER</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="dob">Date of Birth</label>
                                            <input type="date" name="dateofbirth" id="dob"
                                                class="form-control form-control-sm">
                                        </div>
                                        <div class="form-group">
                                            <label for="birthplace">Place of birth</label>
                                            <input type="text" name="placeofbirth" class="form-control form-control-sm "
                                                id="birthplace" placeholder="Enter birth place here">
                                        </div>
                                        <div class="form-group">
                                            <label for="town">Living Town</label>
                                            <input type="text" name="town" class="form-control form-control-sm "
                                                id="town" placeholder="Enter living town here">
                                        </div>
                                        <div class="form-group">
                                            <label for="maritalstatus">Marital Status</label>
                                            <select name="maritalstatus" name="maritalstatus"
                                                class="form-control form-control-sm" id="maritalstatus">
                                                <option value="SINGLE" selected>SINGLE</option>
                                                <option value="MARRIED">MARRIED</option>
                                                <option value="WIDOWED">WIDOWED</option>
                                                <option value="DIVORCED">DIVORCED</option>
                                                <option value="SEPARATED">SEPARATED</option>
                                                <option value="OTHER">OTHER</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="children">No of children</label>
                                            <input type="number" name="children" class="form-control form-control-sm "
                                                id="children" min="0" placeholder="Enter number of children here">
                                        </div>
                                        <div class="form-group">
                                            <label for="weight">Weight(in kgs)</label>
                                            <input type="number" name="weight" class="form-control form-control-sm "
                                                id="weight" min="0" placeholder="Enter weight here">
                                        </div>
                                        <div class="form-group">
                                            <label for="height">Height (in cm)</label>
                                            <input type="number" name="height" class="form-control form-control-sm "
                                                id="height" min="0" placeholder="Enter height here">
                                        </div>
                                        <div class="form-group">
                                            <label for="complexion">Complexion</label>
                                            <select name="complexion" name="complexion"
                                                class="form-control form-control-sm" id="complexion">
                                                <option value="BLACK" selected>BLACK</option>
                                                <option value="BROWN">BROWN</option>
                                                <option value="OTHER">OTHER</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="education">Education</label>
                                            <input type="number" name="education" class="form-control form-control-sm "
                                                id="education" placeholder="Enter education here">
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <!--/.col (left) -->
                            <!-- right column -->
                            <div class="col-md-6">
                                <!-- Form Element sizes -->
                                <div class="card card-outline card-primary">
                                    <div class="card-header text-center">
                                        <h4>Knowledge of language</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <!-- checkbox -->
                                            <div class="col-12">
                                                <label for="arabic">ARABIC</label>
                                            </div>
                                            <div class="form-check col-md-4 col-sm-4 col-lg-4 col-4">
                                                <input id="arabic" name="arabics" class="form-check-input"
                                                    type="checkbox">
                                                <label class="form-check-label">SPEAK</label>
                                            </div>
                                            <div class="form-check col-md-4 col-sm-4 col-lg-4 col-4">
                                                <input id="arabic" name="arabicw" class="form-check-input"
                                                    type="checkbox">
                                                <label class="form-check-label">WRITE</label>
                                            </div>
                                            <div class="form-check col-md-4 col-sm-4 col-lg-4 col-4">
                                                <input id="arabic" name="arabicr" class="form-check-input"
                                                    type="checkbox">
                                                <label class="form-check-label">READ</label>
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <!-- checkbox -->
                                            <div class="col-12">
                                                <label for="english">ENGLISH</label>
                                            </div>
                                            <div class="form-check col-md-4 col-sm-4 col-lg-4 col-4">
                                                <input id="english" name="englishs" class="form-check-input"
                                                    type="checkbox">
                                                <label class="form-check-label">SPEAK</label>
                                            </div>
                                            <div class="form-check col-md-4 col-sm-4 col-lg-4 col-4">
                                                <input id="english" name="englishw" class="form-check-input"
                                                    type="checkbox">
                                                <label class="form-check-label">WRITE</label>
                                            </div>
                                            <div class="form-check col-md-4 col-sm-4 col-lg-4 col-4">
                                                <input id="english" name="englishr" class="form-check-input"
                                                    type="checkbox">
                                                <label class="form-check-label">READ</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card card-outline card-primary">
                                    <div class="card-header text-center">
                                        <h4>Previous Employement Board</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="wcountry">Country</label>
                                            <input type="text" name="empcountry" class="form-control form-control-sm "
                                                id="wcountry" placeholder="Enter work country here">
                                        </div>
                                        <div class="form-group">
                                            <label for="wperiod">Period</label>
                                            <input type="text" name="empperiod" class="form-control form-control-sm "
                                                id="wperiod" placeholder="Enter period here">
                                        </div>
                                    </div>
                                </div>
                                <div class="card card-outline card-primary">
                                    <div class="card-header text-center">
                                        <h4>Work Experiance</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="delala">Delala</label>
                                            <input type="text" name="delala" class="form-control form-control-sm "
                                                id="delala" placeholder="Enter delala here">
                                        </div>
                                        <div class="row">
                                            <!-- checkbox -->
                                            <div class="col-12">
                                                <label for="arabic">EXPERIANCE</label>
                                            </div>
                                            <div class="form-check col-md-4 col-sm-4 col-lg-4 col-4">
                                                <input id="arabic" name="driving" class="form-check-input"
                                                    type="checkbox">
                                                <label class="form-check-label">DRIVING</label>
                                            </div>
                                            <div class="form-check col-md-4 col-sm-4 col-lg-4 col-4">
                                                <input id="arabic" name="cooking" class="form-check-input"
                                                    type="checkbox">
                                                <label class="form-check-label">COOKING</label>
                                            </div>
                                            <div class="form-check col-md-4 col-sm-4 col-lg-4 col-4">
                                                <input id="arabic" name="cleaning" class="form-check-input"
                                                    type="checkbox">
                                                <label class="form-check-label">CLEANING</label>
                                            </div>
                                            <div class="form-check col-md-4 col-sm-4 col-lg-4 col-4">
                                                <input id="arabic" name="washing" class="form-check-input"
                                                    type="checkbox">
                                                <label class="form-check-label">WASHING</label>
                                            </div>
                                            <div class="form-check col-md-4 col-sm-4 col-lg-4 col-4">
                                                <input id="arabic" name="babyseat" class="form-check-input"
                                                    type="checkbox">
                                                <label class="form-check-label">BABY SITING</label>
                                            </div>
                                            <div class="form-check col-md-4 col-sm-4 col-lg-4 col-4">
                                                <input id="arabic" name="sewing" class="form-check-input"
                                                    type="checkbox">
                                                <label class="form-check-label">SEWING</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card card-outline card-primary">
                                    <div class="card-header text-center">
                                        <h4>Application</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="applied">Applied for</label>
                                            <input type="text" name="appliedfor" class="form-control form-control-sm "
                                                id="applied" placeholder="Enter applied for here">
                                        </div>
                                        <div class="form-group">
                                            <label for="applied">Salary</label>
                                            <input type="text" name="salary" class="form-control form-control-sm "
                                                id="applied" placeholder="Enter applied for here">
                                        </div>
                                        <div class="form-group">
                                            <label for="contact">contact Period (in years)</label>
                                            <input type="number" name="contactperiod"
                                                class="form-control form-control-sm " id="contact"
                                                placeholder="Enter contact period for here">
                                        </div>
                                    </div>
                                </div>
                                <div class="card card-outline card-primary">
                                    <div class="card-header text-center">
                                        <h4>Passport Details</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="pnumber">Passport Number</label>
                                            <input type="text" name="passportnumber"
                                                class="form-control form-control-sm " id="pnumber"
                                                placeholder="Enter passport number here">
                                        </div>
                                        <div class="form-group">
                                            <label for="pdate">Date of Issue</label>
                                            <input type="date" name="pdate" class="form-control form-control-sm "
                                                id="pdate">
                                        </div>
                                        <div class="form-group">
                                            <label for="pplace">Place of Issue</label>
                                            <input type="text" name="pplace" class="form-control form-control-sm "
                                                id="pplace" placeholder="Enter place of issue for here">
                                        </div>
                                        <div class="form-group">
                                            <label for="edate">Date of Exp.</label>
                                            <input type="date" name="pexpiry" class="form-control form-control-sm "
                                                id="edate">
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer text-center">
                            <button class="btn btn-primary">Register</button>
                        </div>
                    </div>
                </form>
            </div>
            @else
            <div class="card-body">
                <p class="login-box-msg">Fill in the form and click generate PDF</p>
                <form action="{{route('customer.update', $customer->id)}}" enctype="multipart/form-data" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <!-- left column -->
                            <div class="col-md-6">
                                <!-- general form elements -->
                                <div class="card card-outline card-primary">
                                    <div class="card-header text-center">
                                        <h4>Customer Data</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="fullname">Full Name</label>
                                            <input type="text" value="{{$customer->fullname}}" name="fullname"
                                                class="form-control form-control-sm" id="fullname"
                                                placeholder="Enter full name here">
                                        </div>
                                        <div class="form-group">
                                            <label for="phone">Phone</label>
                                            <input type="number" value="{{$customer->phone}}" name="phone"
                                                class=" form-control form-control-sm" id="phone"
                                                placeholder="Enter phone number here">
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12 col-xs-12 col-md-6 col-lg-6">
                                                <div class="form-group">
                                                    <label for="editeditPortraitImage" class="text-sm">Portrait
                                                        Image</label>
                                                    <input type="file" id="editPortraitImage" name="portraitimage"
                                                        class="form-control-sm">
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-xs-12 col-md-6 col-lg-6">
                                                <div class="text-center form-group">
                                                    <img id="showEditPortraitImage"
                                                        src="{{url('uploads/pdfimages/portraitimage/'.$customer->portraitimage)}}"
                                                        width="100px" height="100px">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12 col-xs-12 col-md-6 col-lg-6">
                                                <div class="form-group">
                                                    <label for="editFullImage" class="text-sm">Full Image</label>
                                                    <input type="file" id="editFullImage" name="fullimage"
                                                        class="form-control-sm">
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-xs-12 col-md-6 col-lg-6">
                                                <div class="text-center form-group">
                                                    <img id="showEditFullImage"
                                                        src="{{url('uploads/pdfimages/fullimage/'.$customer->fullimage)}}"
                                                        width="100px" height="100px">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12 col-xs-12 col-md-6 col-lg-6">
                                                <div class="form-group">
                                                    <label for="editPassportImage" class="text-sm">Passport
                                                        Image</label>
                                                    <input type="file" id="editPassportImage" name="passportimage"
                                                        class="form-control-sm">
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-xs-12 col-md-6 col-lg-6">
                                                <div class="text-center form-group">
                                                    <img id="showEditPassportImage"
                                                        src="{{url('uploads/pdfimages/passportimage/'.$customer->passportimage)}}"
                                                        width="100px" height="100px">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card card-outline card-primary">
                                    <div class="card-header text-center">
                                        <h4>Details Of Application</h4>
                                    </div>
                                    <div class="card-body">
                                        <!-- <div class="form-group">
                                                            <label for="nationality">Nationality</label>
                                                            <select name="nationality" class="form-control form-control-sm"
                                                                id="nationality">
                                                                <option selected>Ethiopia</option>
                                                                <option>Other</option>
                                                            </select>
                                                        </div> -->
                                        <div class="form-group">
                                            <label for="dob">Religion</label>
                                            <select name="relegion" class="form-control form-control-sm" id="relegion">
                                                <option value="ORTHODOX" value="Male" {{$customer->relegion ==
                                                    'ORTHODOX'?"selected":""}}>ORTHODOX</option>
                                                <option value="MUSLIM" {{$customer->relegion ==
                                                    'MUSLIM'?"selected":""}}>MUSLIM</option>
                                                <option value="CHRISTIAN" {{$customer->relegion ==
                                                    'CHRISTIAN'?"selected":""}}>CHRISTIAN</option>
                                                <option value="OTHER" {{$customer->relegion ==
                                                    'OTHER'?"selected":""}}>OTHER</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="dob">Date of Birth</label>
                                            <input type="date" value="{{$customer->dateofbirth}}" name="dateofbirth"
                                                id="dob" class="form-control form-control-sm">
                                        </div>
                                        <div class="form-group">
                                            <label for="birthplace">Place of birth</label>
                                            <input type="text" value="{{$customer->placeofbirth}}" name="placeofbirth"
                                                class="form-control form-control-sm" id="birthplace"
                                                placeholder="Enter birth place here">
                                        </div>
                                        <div class="form-group">
                                            <label for="town">Living Town</label>
                                            <input type="text" value="{{$customer->town}}" name="town"
                                                class="form-control form-control-sm " id="town"
                                                placeholder="Enter living town here">
                                        </div>
                                        <div class="form-group">
                                            <label for="maritalstatus">Marital Status</label>
                                            <select name="maritalstatus" name="maritalstatus"
                                                class="form-control form-control-sm" id="maritalstatus">
                                                <option value="SINGLE" {{$customer->maritalstatus ==
                                                    'SINGLE'?"selected":""}}>SINGLE</option>
                                                <option value="MARRIED" {{$customer->maritalstatus ==
                                                    'MARRIED'?"selected":""}}>MARRIED</option>
                                                <option value="WIDOWED" {{$customer->maritalstatus ==
                                                    'WIDOWED'?"selected":""}}>WIDOWED</option>
                                                <option value="DIVORCED" {{$customer->maritalstatus ==
                                                    'DIVORCED'?"selected":""}}>DIVORCED</option>
                                                <option value="SEPARATED" {{$customer->maritalstatus ==
                                                    'SEPARATED'?"selected":""}}>SEPARATED</option>
                                                <option value="OTHER" {{$customer->maritalstatus ==
                                                    'OTHER'?"selected":""}}>OTHER</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="children">No of children</label>
                                            <input type="number" name="children" class="form-control form-control-sm "
                                                id="children" value="{{$customer->children}}" min="0"
                                                placeholder="Enter number of children here">
                                        </div>
                                        <div class="form-group">
                                            <label for="weight">Weight(in kgs)</label>
                                            <input type="number" name="weight" class="form-control form-control-sm "
                                                id="weight" value="{{$customer->weight}}" min="0"
                                                placeholder="Enter weight here">
                                        </div>
                                        <div class="form-group">
                                            <label for="height">Height (in cm)</label>
                                            <input type="number" value="{{$customer->height}}" name="height"
                                                class="form-control form-control-sm " id="height" min="0"
                                                placeholder="Enter height here">
                                        </div>
                                        <div class="form-group">
                                            <label for="complexion">Complexion</label>
                                            <select name="complexion" name="complexion"
                                                class="form-control form-control-sm" id="complexion">
                                                <option value="BLACK" {{$customer->complexion ==
                                                    'BLACK'?"selected":""}}>BLACK</option>
                                                <option value="BROWN" {{$customer->complexion ==
                                                    'BROWN'?"selected":""}}>BROWN</option>
                                                <option value="OTHER" {{$customer->complexion ==
                                                    'OTHER'?"selected":""}}>OTHER</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="education">Education</label>
                                            <input type="number" value="{{$customer->education}}" name="education"
                                                class="form-control form-control-sm " id="education"
                                                placeholder="Enter education here">
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <!--/.col (left) -->
                            <!-- right column -->
                            <div class="col-md-6">
                                <!-- Form Element sizes -->
                                <div class="card card-outline card-primary">
                                    <div class="card-header text-center">
                                        <h4>Knowledge of language</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <!-- checkbox -->
                                            <div class="col-12">
                                                <label for="arabic">ARABIC</label>
                                            </div>
                                            <div class="form-check col-md-4 col-sm-4 col-lg-4 col-4">
                                                <input id="arabic" name="arabics" class="form-check-input"
                                                    type="checkbox" {{$customer->arabics ==
                                                1?"checked":""}}>
                                                <label class="form-check-label">SPEAK</label>
                                            </div>
                                            <div class="form-check col-md-4 col-sm-4 col-lg-4 col-4">
                                                <input id="arabic" name="arabicw" class="form-check-input"
                                                    type="checkbox" {{$customer->arabicw ==
                                                1?"checked":""}}>
                                                <label class="form-check-label">WRITE</label>
                                            </div>
                                            <div class="form-check col-md-4 col-sm-4 col-lg-4 col-4">
                                                <input id="arabic" name="arabicr" class="form-check-input"
                                                    type="checkbox" {{$customer->arabicr ==
                                                1?"checked":""}}>
                                                <label class="form-check-label">READ</label>
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <!-- checkbox -->
                                            <div class="col-12">
                                                <label for="english">ENGLISH</label>
                                            </div>
                                            <div class="form-check col-md-4 col-sm-4 col-lg-4 col-4">
                                                <input id="english" name="englishs" class="form-check-input"
                                                    type="checkbox" {{$customer->englishs ==
                                                1?"checked":""}}>
                                                <label class="form-check-label">SPEAK</label>
                                            </div>
                                            <div class="form-check col-md-4 col-sm-4 col-lg-4 col-4">
                                                <input id="english" name="englishw" class="form-check-input"
                                                    type="checkbox" {{$customer->englishw ==
                                                1?"checked":""}}>
                                                <label class="form-check-label">WRITE</label>
                                            </div>
                                            <div class="form-check col-md-4 col-sm-4 col-lg-4 col-4">
                                                <input id="english" name="englishr" class="form-check-input"
                                                    type="checkbox" {{$customer->englishr ==
                                                1?"checked":""}}>
                                                <label class="form-check-label">READ</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card card-outline card-primary">
                                    <div class="card-header text-center">
                                        <h4>Previous Employement Board</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="wcountry">Country</label>
                                            <input type="text" value="{{$customer->empcountry}}" name="empcountry"
                                                class="form-control form-control-sm " id="wcountry"
                                                placeholder="Enter work country here">
                                        </div>
                                        <div class="form-group">
                                            <label for="empperiod">Period</label>
                                            <input type="text" value="{{$customer->empperiod}}" name="empperiod"
                                                class="form-control form-control-sm " id="empperiod"
                                                placeholder="Enter period here">
                                        </div>
                                    </div>
                                </div>
                                <div class="card card-outline card-primary">
                                    <div class="card-header text-center">
                                        <h4>Work Experiance</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="delala">Delala</label>
                                            <input type="text" value="{{$customer->delala}}" name="delala"
                                                class="form-control form-control-sm " id="delala"
                                                placeholder="Enter delala here">
                                        </div>
                                        <div class="row">
                                            <!-- checkbox -->
                                            <div class="col-12">
                                                <label for="arabic">EXPERIANCE</label>
                                            </div>
                                            <div class="form-check col-md-4 col-sm-4 col-lg-4 col-4">
                                                <input id="arabic" name="driving" class="form-check-input"
                                                    type="checkbox" {{$customer->driving ==
                                                1?"checked":""}}>
                                                <label class="form-check-label">DRIVING</label>
                                            </div>
                                            <div class="form-check col-md-4 col-sm-4 col-lg-4 col-4">
                                                <input id="arabic" name="cooking" class="form-check-input"
                                                    type="checkbox" {{$customer->cooking ==
                                                1?"checked":""}}>
                                                <label class="form-check-label">COOKING</label>
                                            </div>
                                            <div class="form-check col-md-4 col-sm-4 col-lg-4 col-4">
                                                <input id="arabic" name="cleaning" class="form-check-input"
                                                    type="checkbox" {{$customer->cleaning ==
                                                1?"checked":""}}>
                                                <label class="form-check-label">CLEANING</label>
                                            </div>
                                            <div class="form-check col-md-4 col-sm-4 col-lg-4 col-4">
                                                <input id="arabic" name="washing" class="form-check-input"
                                                    type="checkbox" {{$customer->washing ==
                                                1?"checked":""}}>
                                                <label class="form-check-label">WASHING</label>
                                            </div>
                                            <div class="form-check col-md-4 col-sm-4 col-lg-4 col-4">
                                                <input id="arabic" name="babyseat" class="form-check-input"
                                                    type="checkbox" {{$customer->babyseat ==
                                                1?"checked":""}}>
                                                <label class="form-check-label">BABY SITING</label>
                                            </div>
                                            <div class="form-check col-md-4 col-sm-4 col-lg-4 col-4">
                                                <input id="arabic" name="sewing" class="form-check-input"
                                                    type="checkbox" {{$customer->sewing ==
                                                1?"checked":""}}>
                                                <label class="form-check-label">SEWING</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card card-outline card-primary">
                                    <div class="card-header text-center">
                                        <h4>Application</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="applied">Applied for</label>
                                            <input type="text" value="{{$customer->appliedfor}}" name="appliedfor"
                                                class="form-control form-control-sm " id="applied"
                                                placeholder="Enter applied for here">
                                        </div>
                                        <div class="form-group">
                                            <label for="applied">Salary</label>
                                            <input type="text" value="{{$customer->salary}}" name="salary"
                                                class="form-control form-control-sm " id="applied"
                                                placeholder="Enter applied for here">
                                        </div>
                                        <div class="form-group">
                                            <label for="contact">contact Period (in years)</label>
                                            <input type="number" value="{{$customer->contactperiod}}"
                                                name="contactperiod" class="form-control form-control-sm " id="contact"
                                                placeholder="Enter contact period for here">
                                        </div>
                                    </div>
                                </div>
                                <div class="card card-outline card-primary">
                                    <div class="card-header text-center">
                                        <h4>Passport Details</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="pnumber">Passport Number</label>
                                            <input type="text" value="{{$customer->passportnumber}}"
                                                name="passportnumber" class="form-control form-control-sm " id="pnumber"
                                                placeholder="Enter passport number here">
                                        </div>
                                        <div class="form-group">
                                            <label for="pdate">Date of Issue</label>
                                            <input type="date" value="{{$customer->pdate}}" name="pdate"
                                                class="form-control form-control-sm " id="pdate">
                                        </div>
                                        <div class="form-group">
                                            <label for="pplace">Place of Issue</label>
                                            <input type="text" value="{{$customer->pplace}}" name="pplace"
                                                class="form-control form-control-sm " id="pplace"
                                                placeholder="Enter place of issue for here">
                                        </div>
                                        <div class="form-group">
                                            <label for="edate">Date of Exp.</label>
                                            <input type="date" value="{{$customer->pexpiry}}" name="pexpiry"
                                                class="form-control form-control-sm " id="edate">
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer text-center">
                            <button class="btn btn-success">Update</button>
                        </div>
                    </div>
                </form>
            </div>
            @endif

        </div>
    </div>
    <!-- /.card -->
    <!-- /.login-box -->
    @include('admin.body.script')
</body>
<script type="text/javascript">
    $(document).ready(function () {
        $('#fullImage').change(function (e) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#showFullImage').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
        $('#portraitImage').change(function (e) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#showPortraitImage').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
        $('#passportImage').change(function (e) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#showPassportImage').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
        $('#editFullImage').change(function (e) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#showEditFullImage').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
        $('#editPassportImage').change(function (e) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#showEditPassportImage').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
        $('#editPortraitImage').change(function (e) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#showEditPortraitImage').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });
</script>

</html>