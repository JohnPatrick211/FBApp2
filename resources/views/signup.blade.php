@include('modals.termsandcondition_modals')
<!DOCTYPE html>
<html>
<head>
	<title>Optical Clinic</title>
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <!-- <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"> -->
     <link href="/css/bootstrap.min.css" rel="stylesheet"> 
     <link href="/css/signup.css" rel="stylesheet">
     <link rel="preconnect" href="https://fonts.gstatic.com">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
     <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@700;900&display=swap" rel="stylesheet">
    
	 <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body style="overflow:scroll;">
	<img class="bg img-fluid" src="../images/header-bg.jpg">
	<div class="container-fluid">

        <div class="row mt-2 p-4">

            <div class="card col-md-9 m-auto">
                
                <div class="card-body">

                    <div class="alert alert-success" role="alert" id="alert-acc-success" style="display: none;">
                    </div> 
                    
                    <div class="row">

                        <div class="col-md-12 mb-3">
                            <h4 style="color: #555555">Create your account</h4>
                        </div>

                        <div class="col-md-2 mb-3">
                            <label class="label-small">Last Name</label>
                            <span class="fs-6" style="color:red">*</span>
                            <input type="text" class="form-control"  oninput="this.value = this.value.toUpperCase()" id="lastname" placeholder="Last Name">
                        </div>

                        <div class="col-md-3 mb-3">
                            <label class="label-small ">First Name</label>
                            <span style="color:red"> *</span>
                            <input type="text" class="form-control"  oninput="this.value = this.value.toUpperCase()" id="firstname" placeholder="First Name">
                        </div>

                        <div class="col-md-2 mb-3">
                            <label class="label-small">Middle Name</label>
                            <span style="color:white" > a</span>
                            <input type="text" class="form-control"  oninput="this.value = this.value.toUpperCase()" id="middlename" placeholder="Middle Name">
                        </div>

                        <div class="col-md-2 mb-3">
                            <label class="label-small">Suffix Name</label>
                            <input type="text" class="form-control"  oninput="this.value = this.value.toUpperCase()" id="suffixname" placeholder="Suffix Name">
                        </div>
                        
                        <div class="col-md-3 mb-6">
                            <label class="label-small">Username</label>
                            <span style="color:red"> *</span>
                            <input type="text" class="form-control" id="username" placeholder=" ">
                        </div> 

                        <div class="col-md-4 mb-3">
                            <label class="label-small">Birth Date</label>
                            <span style="color:red" > *</span>
                            <input type="date" class="form-control" id="birthdate" placeholder="birthdate">
                        </div>
                        
                        <div class="col-md-2 mb-3">
                            <label class="label-small">Age</label>
                            <input type="text" class="form-control" id="age" placeholder="Age" disabled>
                        </div> 

                        <div class="col-md-3 mb-3">
                            <label class="label-small">Gender</label>
                            <span style="color:red"> *</span>
                            <select class="form-control" name="gender" id="gender">
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                             </select>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label class="label-small">Civil Status</label>
                            <span style="color:red"> *</span>
                            <select class="form-control" name="civilstatus" id="civilstatus">
                            <option value="Single">Single</option>
                            <option value="Married">Married</option>
                            <option value="Widowed">Widowed</option>
                            <option value="Separated">Separated</option>
                            <option value="Divorced">Divorced</option>
                             </select>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label class="label-small">Province</label>
                            <span style="color:red"> *</span>
                            <!-- <input type="text" class="form-control" id="province" placeholder="Province"> -->
                            <select class="form-control" name="province" id="province">
                                                <option value="0">Province</option>
                                                @foreach($LoggedUserInfo as $item)
                                                    <option value="{{$item->provCode}}">{{$item->provDesc}}</option>
                                                @endforeach
                                                </select>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label class="label-small">City/Municipality</label>
                            <span style="color:red"> *</span>
                            <!-- <input type="text" class="form-control" id="city" placeholder="City/Municipality"> -->
                            <select class="form-control" name="city" id="city" disabled>
                                                <option value="0">City/Municipality</option>
                                                </select>
                        </div>

                        <div class="col-md-2 mb-3">
                            <label class="label-small">Barangay</label>
                            <span style="color:red"> *</span>
                            <!-- <input type="text" class="form-control" id="barangay" placeholder="Barangay"> -->
                            <select class="form-control" name="barangay" id="barangay" disabled>
                                                <option value="0">Barangay</option>
                                                </select>
                        </div>
                        
                        
                        <div class="col-md-2 mb-3">
                            <label class="label-small">Street</label>
                            <input type="text" class="form-control" id="street" placeholder="Street">
                        </div>

                        <div class="col-md-2 mb-3">
                            <label class="label-small">House No.</label>
                            <input type="number" class="form-control" id="houseno" placeholder="House No.">
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="label-small">Email</label>
                            <span style="color:red"> *</span>
                            <input type="text" class="form-control" id="email" placeholder="Email Address">
                        </div>
            
                        <div class="col-md-6">
                            <label class="label-small">Phone Number</label>
                            <span style="color:red"> *</span>
                            <input type="number" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==11) return false;" class="form-control" id="phone_no">
                            <a id="send-OTP" style="cursor: pointer; color:#32638D;" class="label-medium"><u>Send OTP</u></a>
                            <span class="countdown label-medium"></span>
                        </div>
                        
                        <div class="col-md-6">
                            <label class="label-small">Enter your OTP</label>
                            <span style="color:red"> *</span>
                            <input type="text" class="form-control" id="otp" placeholder="Enter your 4 digit OTP">
                        </div> 
    
                        <div class="col-md-6 mb-3">
                            <label class="label-small">Password</label>
                            <span style="color:red"> *</span>
                            <input type="password" onkeyup='check3();' class="form-control" id="password" placeholder="Minimum of 8 characters">
                            <input type="checkbox" onclick="showPassword()">Show Password
                            
                        </div> 

                        <div class="col-md-6">
                            <label class="label-small">Confirm Password</label>
                            <span style="color:red"> *</span>
                            <input type="password" onkeyup='check3();' class="form-control" id="confirm_password">
                            <div class="signupprofile-fail" style="display: none;">
                            <span class="text-danger">Password Does Not Match</span>
                            </div>
                            <div class="signupprofile-char" style="display: none;">
                            <span class="text-danger">Password Need 8 Characters</span>
                            </div>
                            <div class="signupprofile-success" style="display: none;">
                            <span class="text-success">Password Match</span>
                            </div>
                        </div>
                        
                        <div class="col-md-12">
                        <label class="label-small">Valid ID</label>
                        <input type="file"  name="validid" id="validid" enctype="multipart/form-data">
                        </div>
                       
                        <div class="col-md-12">
                            <input type="button" class="btn" id="btn-signup" name="btn-signup" value="SIGN UP">
                            <span class="label-small m-0">By clicking "SIGN UP"; I agree to Optical Clinic 
                                <a href="" data-toggle="modal" data-target="#TermsandConditionsModal" id="btn-add-categoryproduct">Terms of Use</a> and <a href="" data-toggle="modal" data-target="#PrivacyPolicyModal" id="btn-add-categoryproduct">Privacy Policy</a>
                                <!-- <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#CategoryProductModal" id="btn-add-categoryproduct"><span class='fa fa-plus'></span> Add Category</a> -->

                            </span>	
                        </div>

                        <div class="col-md-12"><hr></div>

                        <div class="col-md-6">
                            <span class="label-small m-0"> Already have an account?
                                <a href="login"> Login </a>  here.
                            </span>	
                        </div>

                </div>
                </div>	
            </div>
    
        </div>

        </div>
        @section('modals')
        @endsection
    </div>

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
	<!-- <script src="{{asset('js/admin-login.js')}}"></script> -->
    <script src="js/signup.js"></script>
    <script src="js/login.js"></script>

</body>
</html>