
@extends('layouts.tenant')
@section('content')

<div class="content-header"></div>

<div class="page-header">
  <h3 class="mt-2" id="page-title">Payment Result</h3>
  <hr>
</div>


                    <div class="alert alert-danger">
                      <h5><i class="icon fas fa-exclamation-triangle"></i> <b>Payment Transaction Failed</b></h5>
                      Your Payment for GCash is Failed, Please click this <a href="tenant-payment" class="alert-link">link</a>. to go back in the payment form
                    </div>

<style>
    thead{
        position: sticky;
        top: 0;
        background-color: #FFF;
        border-color: #C4BFC2;
        z-index: 999;
    }
</style>
                  
<!-- /.content -->
@endsection
