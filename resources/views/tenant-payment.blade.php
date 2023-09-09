
@extends('layouts.tenant')
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
  <h3 class="mt-2" id="page-title">Online Payment Via GCash</h3>
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
                    <div class="col-sm-12 col-md-5 border p-3">
                        <div class="row">
                        <div class="col-12">
                            <form action="gcash-payment" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                                    <div class="ml-0 mb-12">
                                    <div class="input-group mb-3 mt-3">
                                            </div>
                                            @if($TenantInfo -> mname === null)
                                            <input class="form-control form-control-navbar" id="input-tenantname" type="text" placeholder="Name of Tenant" aria-label="Search" value="{{ $TenantInfo -> fname}} {{ $TenantInfo -> lname}}" readonly>
                                            @else
                                            <input class="form-control form-control-navbar" id="input-tenantname" type="text" placeholder="Name of Tenant" aria-label="Search" value="{{ $TenantInfo -> fname}} {{ $TenantInfo -> mname}} {{ $TenantInfo -> lname}}" readonly>
                                            @endif
                                            <input class="form-control form-control-navbar mt-3" id="input-roomnumber" type="text" placeholder="Room Number" aria-label="Search" value="{{ $TenantRoom -> roomnumber}}" readonly>
                                            <div class="input-group mb-3">
                                                <input class="form-control form-control-navbar mt-3" id="payment-description" name="payment-description" type="text" placeholder="Name of Room / Description">
                                            </div>
                                        </div>
                                        <div class="input-group mb-3 mt-3">
                                            <div class="input-group-prepend">
                                                  <span class="input-group-text">&#8369</span>
                                                </div>
                                                <input  type="number" id="payment-amount" name="payment-amount" step=".01" class="form-control" placeholder="Amount">
                                            </div>
                                            <button type="submit" class="btn btn-sm btn-primary">Pay Via GCash</button>
                                        </div>
                                    </div>
                            </div>
                            </form>
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
