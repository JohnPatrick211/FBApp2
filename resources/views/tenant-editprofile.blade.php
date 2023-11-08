
@extends('layouts.tenant')

@section('content')
                 <!-- Page Heading -->
                 <h1 class="h3 mb-2 text-gray-800">Edit Profile Information</h1>
                     @if(count($errors)>0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)

                            <li>{{$error}}</li>

                            @endforeach
                        </ul>
                    </div>
                    @endif

                    @if(\Session::has('success'))
                    <div class="alert alert-success alert-dismissible">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                      <h5><i class="icon fas fa-check"></i> </h5>
                      {{ \Session::get('success') }}
                    </div>
                    @endif

                    @if(\Session::has('danger'))
                    <div class="alert alert-danger alert-dismissible">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                      <h5><i class="icon fas fa-exclamation-triangle"></i> </h5>
                      {{ \Session::get('danger') }}
                    </div>
                    @endif
                    <div class="row">

          <div class="col-sm-12 col-md-12">
          <a href="tenant-dashboard"><i class="fa fa-arrow-left"></i></a>
          <br/>
            <div class="card">
                <div class="card-body">
                        <form action="saveeditprofile" method="POST" enctype="multipart/form-data">
                        <div class="row">
                        {{ csrf_field() }}

                        <input type="hidden" name= "editid" id="editid" value="{{$TenantInfo -> tenant_id}}">

                        <div class="col-md-4 mb-3">
                            <label class="label-small">First Name</label>
                            <input type="text" class="form-control"  name= "editfname" id="editfname" placeholder="First Name" value="{{$TenantInfo -> fname}}" required>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="label-small">Middle Name</label>
                            <input type="text" class="form-control"  name= "editmname" id="editmname" placeholder="Middle Name" value="{{$TenantInfo -> mname}}">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="label-small">Last Name</label>
                            <input type="text" class="form-control" name= "editlname" id="editlname" placeholder="Last Name" value="{{$TenantInfo -> lname}}" required>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="label-small">Email</label>
                            <input type="text" class="form-control" name="editemail" id="editemail" placeholder="Email Address" value="{{$TenantInfo -> email}}" required>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="label-small">Age</label>
                            <input type="number" class="form-control" name="editage" id="editage" placeholder="Age" value="{{$TenantInfo -> age}}" readonly>
                        </div> 

                        <div class="col-md-4 mb-3">
                            <label class="label-small">Gender</label>
                            <select class="form-control" name="editgender" id="editgender">
                            <option value="Male"  {{ ( $TenantInfo-> gender == "Male") ? 'selected' : '' }}>Male</option>
                            <option value="Female" {{ ( $TenantInfo-> gender == "Female") ? 'selected' : '' }}>Female</option>
                             </select>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="label-small">Civil Status</label>
                            <select class="form-control" name="editcivilstatus" id="editcivilstatus" value="{{$LoggedUserInfo -> civilstatus}}">
                            <option value="Single" {{ ( $TenantInfo -> civilstatus == "Single") ? 'selected' : '' }}>Single</option>
                            <option value="Married" {{ ( $TenantInfo -> civilstatus == "Married") ? 'selected' : '' }}>Married</option>
                            <option value="Widowed" {{ ( $TenantInfo -> civilstatus == "Widowed") ? 'selected' : '' }}>Widowed</option>
                            <option value="Separated" {{ ( $TenantInfo -> civilstatus == "Separated") ? 'selected' : '' }}>Separated</option>
                            <option value="Divorced" {{ ( $TenantInfo -> civilstatus == "Divorced") ? 'selected' : '' }}>Divorced</option>
                             </select>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="label-small">Birth Date</label>
                            <input type="date" class="form-control" name="editbirthdate" id="editbirthdate" placeholder="birthdate" value="{{$TenantInfo -> birthdate}}" required>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="label-small">Phone Number</label>
                            <input type="number" maxlength="11" class="form-control" name="editphone_no" id="editphone_no" value="{{$TenantInfo -> phone}}" required>
                        </div> 

                        <div class="col-md-12 mb-3">
                            <label class="label-small">Address</label>
                            <input type="text" class="form-control" name= "editaddress" id="editaddress" placeholder="Address" value="{{$TenantInfo -> address}}" required>
                        </div>

                        <div class="col-12">
                        <label class="label-small">Profile Picture</label>
                        <input type="file"  name="editprofilepic" id="editprofilepic" enctype="multipart/form-data" required="true">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="label-small">New Password</label>
                            <input type="password" class="form-control" name="editpassword" id="editpassword" placeholder="Minimum of 8 characters">
                        </div> 

                        <div class="col-12 mt-4">
                                <button type="submit" class="btn btn-sm btn-primary mr-2" id="btn-edit-user">Save changes</button>
                              </div>
                    </div>
                </div>
            </div>
        </div>

   @endsection
