
<!DOCTYPE html>
<html>
<head>
	<title>FB Building Register</title>
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
	<img class="bg img-fluid" src="../img/login-bg.jpg">
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

                        <div class="col-md-3 mb-3">
                            <label class="label-small">Last Name</label>
                            <span class="fs-6" style="color:red">*</span>
                            <input type="text" class="form-control"  oninput="this.value = this.value.toUpperCase()" id="lastname" placeholder="Last Name">
                        </div>

                        <div class="col-md-3 mb-3">
                            <label class="label-small ">First Name</label>
                            <span style="color:red"> *</span>
                            <input type="text" class="form-control"  oninput="this.value = this.value.toUpperCase()" id="firstname" placeholder="First Name">
                        </div>

                        <div class="col-md-3 mb-3">
                            <label class="label-small">Middle Name</label>
                            <span style="color:white" > a</span>
                            <input type="text" class="form-control"  oninput="this.value = this.value.toUpperCase()" id="middlename" placeholder="Middle Name">
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
                        <div class="col-md-6 mb-3">
                            <label class="label-small">Address</label>
                            <input type="text" class="form-control" id="address" placeholder="address">
                        </div>

                        <div class="col-md-3 mb-3">
                            <label class="label-small">Room Number</label>
                            <span style="color:red"> *</span>
                            <select class="form-control" name="roomnumber" id="roomnumber">
                            @foreach($users4 as $item)
                                <option value="{{$item->id}}">{{$item->roomnumber}}</option>
                            @endforeach
                             </select>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label class="label-small">Date of Occupancy</label>
                            <span style="color:red" > *</span>
                            <input type="date" class="form-control" id="dateofoccupancy" placeholder="dateofoccupancy">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="label-small">Email</label>
                            <span style="color:red"> *</span>
                            <input type="text" class="form-control" id="email" placeholder="Email Address">
                        </div>

                        <div class="col-md-6">
                            <label class="label-small">Contact Number</label>
                            <span style="color:red"> *</span>
                            <input type="number" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==11) return false;" class="form-control" id="phone_no">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="label-small">Contract Start</label>
                            <span style="color:red" > *</span>
                            <input type="date" class="form-control" id="contractstart" placeholder="contractstart">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="label-small">Contract End</label>
                            <span style="color:red" > *</span>
                            <input type="date" class="form-control" id="contractend" placeholder="contractend">
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
                            <input type="button" class="btn" id="btn-signup" name="btn-signup" value="SIGN UP">
                        </div>

                        <div class="col-md-12"><hr></div>

                        <div class="col-md-6">
                            <span class="label-small m-0"> Already have an account?
                                <a href="https://fbapp.online/"> Login </a>  here.
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