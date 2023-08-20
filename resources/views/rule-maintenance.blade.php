
@extends('layouts.admin')
@section('content')
<h1 class="h3 mb-2 text-gray-800">Rules and Regulation Maintenance</h1>
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
                        <form action="EditRule" method="POST" enctype="multipart/form-data">
                        <div class="row">
                        {{ csrf_field() }}
 
                        <input type="hidden" name= "editid" id="editid">

                        <div class="col-md-12 mb-1">
                            <div class="form-group">
                            <textarea  name="rule" id="rule"></textarea>
                        </div>
                        </div>
 
                        <div class="col-12">
                            <button type="submit" class="btn btn-sm btn-primary mr-2" id="btn-edit-rule">Save changes</button>
                        </div>
                              
        
                        </div>
                        <form>
                </div>
            </div>
        </div>
   @endsection
