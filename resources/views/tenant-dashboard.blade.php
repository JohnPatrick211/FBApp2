
@extends('layouts.tenant')

@section('content')
                 <!-- Page Heading -->
                 <h1 class="h3 mb-2 text-gray-800">My Profile Information</h1>
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
            <div class="card">
                <div class="card-body">
                        <div class="row">

                        <div class="col-md-4 mb-3">
                            <label class="label-small font-weight-bold">Tenant ID</label>
                            <br/>
                            <label class="label-small" id="displayid">2023-TEN-{{$TenantInfo -> tenant_id}}</label>
                        </div>
    
                        <div class="col-md-4 mb-3">
                            <label class="label-small font-weight-bold">Fullname</label>
                            <br/>
                            <label class="label-small" id="displayfullname">{{$TenantInfo -> fname}} {{$TenantInfo -> mname}} {{$TenantInfo -> lname}}</label>
                        </div>
                        
                        <div class="col-md-4 mb-3">
                            <label class="label-small font-weight-bold">Room Number</label>
                            <br/>
                            <label class="label-small" id="displayroomnumber">{{$TenantRoom -> roomnumber}}</label>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="label-small font-weight-bold">Email</label>
                            <br/>
                            <label class="label-small" id="displayemail">{{$TenantInfo -> email}}</label>
                        </div>
                        
                        <div class="col-md-4 mb-3">
                            <label class="label-small font-weight-bold">Age</label>
                            <br/>
                            <label class="label-small" id="displayage">{{$TenantInfo -> age}}</label>
                        </div> 

                        <div class="col-md-4 mb-3">
                            <label class="label-small font-weight-bold">Gender</label>
                            <br/>
                            <label class="label-small" id="displaygender">{{$TenantInfo-> gender}}</label>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="label-small font-weight-bold">Civil Status</label>
                            <br/>
                            <label class="label-small" id="displaycivilstatus">{{$TenantInfo -> civilstatus}}</label>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="label-small font-weight-bold">Birth Date</label>
                            <br/>
                            <label class="label-small" id="displaybirthdate">{{$TenantInfo -> birthdate}}</label>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="label-small font-weight-bold">Phone Number</label>
                            <br/>
                            <label class="label-small" id="displayphone_no">{{$TenantInfo -> phone}}</label>
                        </div>
                        
                        <div class="col-md-4 mb-3">
                            <label class="label-small font-weight-bold">Date of Occupancy</label>
                            <br/>
                            <label class="label-small" id="displayroomnumber">{{$TenantInfo -> date_of_occupancy}}</label>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="label-small font-weight-bold">Contract Start</label>
                            <br/>
                            <label class="label-small" id="displayroomnumber">{{$TenantInfo -> contract_start}}</label>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="label-small font-weight-bold">Contract End</label>
                            <br/>
                            <label class="label-small" id="displayroomnumber">{{$TenantInfo -> contract_end}}</label>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="label-small font-weight-bold">Address</label>
                            <br/>
                            <label class="label-small" id="displayaddress">{{$TenantInfo -> address}}</label>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="label-small font-weight-bold">Next Payment Date</label>
                            <br/>
                            <label class="label-small" id="displayaddress">{{$TenantInfo -> nextpayment}}</label>
                        </div>

                        <div class="col-12 mt-2">
                              <a href="editprofile" class="btn btn-sm btn-primary">Edit</a>
                              </div>
                    </div>
                </div>
            </div>
        </div>
   @endsection
