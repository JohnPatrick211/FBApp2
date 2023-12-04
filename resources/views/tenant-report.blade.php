
@extends('layouts.admin')

@section('content')



                    <!-- Page Heading -->
                     <h1 class="h3 mb-2 text-gray-800">Tenant Report</h1>
                    {{-- <div class="update-success-validation mr-auto ml-3" style="display: none">
                        <label class="label text-success">Employer is successfully Approved</label>
                      </div>
                      <img src="../../assets/loader.gif" class="loader" alt="loader" style="display: none"> --}}
                <!-- Debug Table Content -->
                <div class="row">

                </div>

                
                <div class="row">

                <div class="col-sm-2 ">
                              <input data-column="9" type="date" class="form-control" id="tenantreportdate_from" value="{{ date('Y-m-d') }}">
                              </div>

                              <div class="mt-2">
                                -
                                </div>

                              <div class="col-sm-2">
                                <input data-column="9" type="date" class="form-control" id="tenantreportdate_to" value="{{ date('Y-m-d') }}" >
                                </div>
                                    
                                    <div class="mt-2">
                                </div>

                                <div class="col-sm-2 ">
                            <select class="form-control" style="width:160%;" name="tenantpayment_method" id="tenantpayment_method">
                                                <option value="All">All Payment Status</option>
                                                <option value="0">Unpaid</option>
                                                <option value="1">Paid</option>
                                                </select>
                              </div>

                              <div class="mt-2">
                              &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                                </div>

                              

                              </div>
                              <div class="row mb-2">

                    </div>
                <div class="card shadow mb-4">
                    <div class="card-body">
                              <table class="table responsive table-bordered table-hover" id="tenant-report-table" width="100%" cellspacing="0">
                                <thead>
                                  <tr>
                                            <th>ID</th>
                                            <th>Tenant Name</th>
                                            <th>Middle Name</th>
                                            <th>Last Name</th>
                                            <th>Status</th>
                                            <th>Next Payment Date</th>
                                  </tr>
                              </thead>

                              </table>
            @endsection

