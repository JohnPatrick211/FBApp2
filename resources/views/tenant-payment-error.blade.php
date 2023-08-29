
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
  <h3 class="mt-2" id="page-title">Payment Error</h3>
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
                  
<!-- /.content -->
@endsection
