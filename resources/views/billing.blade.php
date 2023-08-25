
@extends('layouts.admin')
@include('modals.void')
@section('content')
<style>
    table,#product-container{
        font-size:19px;
    }
    table td {
        text-align: right !important;
    }
</style>

<div class="content-header"></div>

<div class="page-header">
  <h3 class="mt-2" id="page-title">Cashiering</h3>
  <hr>
</div>

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
<style>
    thead{
        position: sticky;
        top: 0;
        background-color: #FFF;
        border-color: #C4BFC2;
        z-index: 999;
    }
</style>
  <div class="row mt-1">
    <div class="col-md-12 col-lg-12 mt-3">
      <div class="card">
          <div class="card-body">
                <div class="row">
                    <div class="col-sm-12 col-md-7">
                        <div class="row mr-2">
                            <div class="col-12 tray-container" style="overflow-y: auto; height:auto;">
                                <table class="table responsive table-bordered table-hover tbl-tray" style="margin-bottom:20px;">
                                    <thead>
                                        <th width='130px'>Name</th>
                                        <th width='130px'>Amount</th>
                                        <th width="50px">Action</th>
                                    </thead>
                                    <tbody>                
                                    </tbody>    
                                </table>
                                <div class="loader-container">
                                    <div class="lds-default" id="tray-loader"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
                                </div>
                            </div>
                            <div class="col-md-12 mt-2">
                                <table class="table responsive table-bordered" style=" margin-bottom:20px;">
                                    <tr>
                                        <th>Tendered</th>
                                        <th>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                  <span class="input-group-text">&#8369</span>
                                                </div>
                                                <input  type="number" id="tendered" step=".01" class="form-control">
                                            </div>
                                        </th>
                                    </tr> 
                                    <tr>
                                        <th>Change</th>
                                        <th>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                  <span class="input-group-text">&#8369</span>
                                                </div>
                                                <input  type="number" id="change" step=".01" class="form-control" readonly>
                                            </div></th>
                                    </tr>  
                                    <tr>
                                        <th>Invoice #</th>
                                        <th><input type="number" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==7) return false;" id="invoice-no" class="form-control"></th>
                                    </tr>    
                                </table>
                            </div>
                            <div class="col-sm-3">
                                <button class="btn btn-sm btn-success" id="proccess">Process</button>
                            </div>
                        </div>        
                    </div>

                    <div class="col-sm-12 col-md-5 border p-3">
                        <div class="row">
                        <div class="col-12">
                                    <div class="ml-0 mb-12">
                                    <div class="input-group mb-3 mt-3">
                                            <input class="form-control form-control-navbar" id="input-search-userid" type="number" placeholder="Tenant ID" aria-label="Search">   
                                            <div class="input-group-append">
                                                <button class="btn btn-dark btn-search-userid">
                                                    <i class="fas fa-search"></i>
                                                </button>
                                            </div>
                                            </div>
                                            <input class="form-control form-control-navbar" id="input-tenantname" type="text" placeholder="Name of Tenant" aria-label="Search" readonly>
                                            <input class="form-control form-control-navbar mt-3" id="input-roomnumber" type="text" placeholder="Room Number" aria-label="Search" readonly>
                                            <div class="input-group mb-3">
                                                <input class="form-control form-control-navbar mt-3" id="input-description" type="text" placeholder="Name of Room / Description">
                                            </div>
                                        </div>
                                        <div class="input-group mb-3 mt-3">
                                            <div class="input-group-prepend">
                                                  <span class="input-group-text">&#8369</span>
                                                </div>
                                                <input  type="number" id="input-amount" step=".01" class="form-control" placeholder="Amount">
                                            </div>
                                            <button class="btn btn-sm btn-primary" id="btn-add-to-tray">Add to Tray</button>
                                        </div>
                                    </div>
                            </div>
                        </div>
                        <div class="loader-container">
                            <div class="lds-default" id="product-loader"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
                        </div>
        
                    </div>
                    
                </div>
          </div>
      </div>
  </div>

  <!-- /.row (main row) -->
  
</div><!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection
