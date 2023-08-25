
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

                
                <div class="row mb-2">

                <div class="col-sm-2 mb-3">
                              <input data-column="9" type="date" class="form-control" id="salesreportdate_from" value="{{ date('Y-m-d') }}">
                              </div>

                              <div class="mt-2">
                                -
                                </div>

                              <div class="col-sm-2 mb-3">
                                <input data-column="9" type="date" class="form-control" id="salesreportdate_to" value="{{ date('Y-m-d') }}" >
                                </div>
                                    
                                    <div class="mt-2">
                                </div>

                                <div class="col-sm-2 mb-3">
                            <select class="form-control" style="width:160%;" name="salesreportbranch" id="salesreportbranch">
                                                <option value="All Branches">All Branches</option>
                                                @foreach($users4 as $item)
                                                    <option value="{{$item->id}}">{{$item->branchname}}</option>
                                                @endforeach
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
                                            <th>Product Code</th>
                                            <th>Product Name</th>
                                            <th>Branch Name</th>
                                            <th>Price</th>
                                            <th>Qty</th>
                                            <th>Amount</th>
                                            <th>Date Time</th>
                                  </tr>
                              </thead>

                              </table>
            @endsection

