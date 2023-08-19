@include('modals.archive_modals')
@extends('layouts.admin')

@section('content')


                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Archive</h1>

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
                 
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="table-responsive">

                              <ul class="nav nav-tabs" id="myTab" role="tablist">

                                <li class="nav-item">
                                  <a class="nav-link active" id="validation-tab" data-toggle="tab" href="#validationtab" role="tab" aria-controls="contact" aria-selected="true">Admin

                                  </a>
                                 </li>
                                 <li class="nav-item">
                                      <a class="nav-link" id="doctor-tab" data-toggle="tab" href="#doctortab" role="tab" aria-controls="home" aria-selected="false">Employee

                                      </a>
                                  </li>
                                  <li class="nav-item">
                                      <a class="nav-link" id="secretary-tab2" data-toggle="tab" href="#secretarytab2" role="tab" aria-controls="home" aria-selected="false">Tenant

                                      </a>
                                  </li>
                                  <li class="nav-item">
                                      <a class="nav-link" id="staff-tab" data-toggle="tab" href="#stafftab" role="tab" aria-controls="home" aria-selected="false">Room

                                      </a>
                                  </li>

                              </ul>
                              <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade active show" id="validationtab" role="tabpanel" aria-labelledby="validation-tab">

                                  <table class="table responsive table-bordered table-hover" id="archiveadmin-table" width="100%" cellspacing="0">
                                    <thead>
                                      <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>mname</th>
                                        <th>lname</th>
                                        <th>Email</th>
                                        <th>Contact Number</th>
                                        <th>Date archived</th>
                                        <th>Action</th>
                                      </tr>
                                  </thead>

                                  </table>
                                 <!-- <img src="('assets/arrow_ltr.png')}}" alt="">
                                  <button class="btn btn-sm btn-success mt-3" id="btn-bulk-verified">Mark as verified</button>
                                  <div class="update-success-validation mr-auto ml-3" style="display: none">
                                    <label class="label text-success">Customer is successfully added validate</label>
                                  </div>
                                  <img src="../../assets/loader.gif" class="loader" alt="loader" style="display: none">-->


                                </div>
                                <!-- doctor -->
                                <div class="tab-pane fade" id="doctortab" role="tabpanel" aria-labelledby="doctor-tab">

                                  <table class="table responsive table-bordered table-hover" id="archiveemployee-table" width="100%" cellspacing="0">
                                    <thead>
                                      <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>mname</th>
                                        <th>lname</th>
                                        <th>Email</th>
                                        <th>Contact Number</th>
                                        <th>Date archived</th>
                                        <th>Action</th>
                                      </tr>
                                  </thead>

                                  </table>
                                  </div>
                                  <!-- secretary2 -->
                                <div class="tab-pane fade" id="secretarytab2" role="tabpanel" aria-labelledby="secretary-tab2">

                                <table class="table responsive table-bordered table-hover" id="archivetenant-table" width="100%" cellspacing="0">
                                  <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>mname</th>
                                        <th>lname</th>
                                        <th>Email</th>
                                        <th>Contact Number</th>
                                        <th>Date archived</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                </table>
                                </div>
                                 <!-- staff -->
                                 <div class="tab-pane fade" id="stafftab" role="tabpanel" aria-labelledby="staff-tab">

                                  <table class="table responsive table-bordered table-hover" id="archiveroom-table" width="100%" cellspacing="0">
                                    <thead>
                                      <tr>
                                          <th>ID</th>
                                          <th>Room Number</th>
                                          <th>Room Capacity</th>
                                          <th>No. of Vacant</th>
                                          <th>Date archived</th>
                                          <th>Action</th>
                                      </tr>
                                  </thead>

                                  </table>
                                  </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            <!-- End of Main Content -->
            @endsection
