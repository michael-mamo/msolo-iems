@include('admin.body.header')
@include('admin.body.script')
<!-- <body class="hold-transition login-page dark-mode"> -->

<body class="hold-transition">
    <div>
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="#" class="h1"><b>PDF Generator</b></a>
            </div>
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
                                        <div class="form-group">
                                            <label for="portrait">Portrait Image</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" name="protraitimage" class="custom-file-input"
                                                        id="portrait">
                                                    <label class="custom-file-label" for="portrait">Choose
                                                        file</label>
                                                </div>
                                                <div class="input-group-append">
                                                    <span class="input-group-text">Upload</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="fullimage">Full Image</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" name="fullimage" class="custom-file-input"
                                                        id="fullimage">
                                                    <label class="custom-file-label" for="fullimage">Choose
                                                        file</label>
                                                </div>
                                                <div class="input-group-append">
                                                    <span class="input-group-text">Upload</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="passportimage">Passport Image</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input name="passportimage" type="file" class="custom-file-input"
                                                        id="passportimage">
                                                    <label class="custom-file-label" for="passportimage">Choose
                                                        file</label>
                                                </div>
                                                <div class="input-group-append">
                                                    <span class="input-group-text">Upload</span>
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
                            <button class="btn btn-primary">Generate PDF</button>
                        </div>
                    </div>
                    <!-- /.card -->
                    <!-- /.login-box -->
                    @include('admin.body.script')
</body>
<script type="text/javascript">
    $(document).ready(function () {
        $('#image').change(function (e) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#showImage').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });
</script>

</html>