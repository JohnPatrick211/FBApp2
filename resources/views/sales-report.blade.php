
@extends('layouts.admin')

@section('content')



                    <!-- Page Heading -->
                     <h1 class="h3 mb-2 text-gray-800">Sales Report</h1>
                    {{-- <div class="update-success-validation mr-auto ml-3" style="display: none">
                        <label class="label text-success">Employer is successfully Approved</label>
                      </div>
                      <img src="../../assets/loader.gif" class="loader" alt="loader" style="display: none"> --}}
                <!-- Debug Table Content -->
                <div class="row">

                </div>

                
                <div class="row">

                <div class="col-sm-2 ">
                              <input data-column="9" type="date" class="form-control" id="salesreportdate_from" value="{{ date('Y-m-d') }}">
                              </div>

                              <div class="mt-2">
                                -
                                </div>

                              <div class="col-sm-2">
                                <input data-column="9" type="date" class="form-control" id="salesreportdate_to" value="{{ date('Y-m-d') }}" >
                                </div>
                                    
                                    <div class="mt-2">
                                </div>

                                <div class="col-sm-2 ">
                            <select class="form-control" style="width:160%;" name="salespayment_method" id="salespayment_method">
                                                <option value="All Payment Method">All Payment Method</option>
                                                <option value="Cash">Cash</option>
                                                <option value="GCash">GCash</option>
                                                </select>
                              </div>

                              <div class="mt-2">
                              &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                                </div>

                              <div class="col-sm-4 mb-3">
                              <p>Total sales: <span style="font-size: 21px;">&#8369; <b id="txt-total-sales"></b></span></p>
                          </div>

                              

                              </div>
                              <div class="row mb-2">

                    <div class="col-sm-2 col-md-2 col-lg-10 mb-3">
                        <button class="btn btn-danger btn-sm"id="btn-salesreport-print"><span class='fa fa-print'></span> Print</button>
                        </div>

                    </div>
                <div class="card shadow mb-4">
                    <div class="card-body">
                              <table class="table responsive table-bordered table-hover" id="sales-report-table" width="100%" cellspacing="0">
                                <thead>
                                  <tr>
                                            <th>Invoice No.</th>
                                            <th>Tenant Name</th>
                                            <th>Middle Name</th>
                                            <th>Last Name</th>
                                            <th>Product/Description</th>
                                            <th>Payment Method</th>
                                            <th>Amount</th>
                                            <th>Date Time</th>
                                  </tr>
                              </thead>

                              </table>
            @endsection

