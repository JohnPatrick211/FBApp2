@include('modals.user_maintenance_modal')
@extends('layouts.admin')

@section('content')


                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">User Maintenance</h1>

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
                    <div class="row mb-2">

                    <div class="col-sm-2 col-md-2 col-lg-10 mb-3">

                        <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addUserModal" id="btn-user-book"><span class='fa fa-plus'></span> Add user</a>

                        </div>
                    </div>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="table-responsive">

                              <ul class="nav nav-tabs" id="myTab" role="tablist">

                                <li class="nav-item">
                                  <a class="nav-link active" id="validation-tab" data-toggle="tab" href="#validationtab" role="tab" aria-controls="contact" aria-selected="true">Employee

                                  </a>
                                 </li>
                                 <li class="nav-item">
                                      <a class="nav-link" id="secretary-tab" data-toggle="tab" href="#secretarytab" role="tab" aria-controls="home" aria-selected="false">Tenant

                                      </a>
                                  </li>
                                  <li class="nav-item">
                                      <a class="nav-link" id="verified-tab" data-toggle="tab" href="#verifiedtab" role="tab" aria-controls="home" aria-selected="false">Admin

                                      </a>
                                  </li>

                              </ul>
                              <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade active show" id="validationtab" role="tabpanel" aria-labelledby="validation-tab">

                                  <table class="table responsive table-bordered table-hover" id="employee-table" width="100%" cellspacing="0">
                                    <thead>
                                      <tr>
                                      <th>ID</th>
                                        <th>Name</th>
                                        <th>Middle Name</th>
                                        <th>Last Name</th>
                                        <th>Email</th>
                                        <th>Contact Number</th>
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
                                <!-- secretary -->
                                <div class="tab-pane fade" id="secretarytab" role="tabpanel" aria-labelledby="secretary-tab">

                                  <table class="table responsive table-bordered table-hover" id="tenant-table" width="100%" cellspacing="0">
                                    <thead>
                                      <tr>
                                      <th>ID</th>
                                        <th>Name</th>
                                        <th>Middle Name</th>
                                        <th>Last Name</th>
                                        <th>Email</th>
                                        <th>Contact Number</th>
                                        <th>Action</th>
                                      </tr>
                                  </thead>

                                  </table>
                                  </div>
                                <div class="tab-pane fade" id="verifiedtab" role="tabpanel" aria-labelledby="verified-tab">

                                  <table class="table responsive table-bordered table-hover" id="admin-table" width="100%">
                                    <thead>
                                      <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Middle Name</th>
                                        <th>Last Name</th>
                                        <th>Email</th>
                                        <th>Contact Number</th>
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
