@extends('layouts.tenant')
@include('modals.forum_modals')
@section('content')
<h1 class="h3 mb-2 text-gray-800">Forum and Comments</h1>
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

                    <div class="col-sm-2 col-md-2 col-lg-10 mb-3">
                    <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#AddForumModal" id="btn-add-product"><span class='fa fa-plus'></span> Add Forum</button>

                    </div>
                    
                    </div>
                    @foreach($forum as $forums)
                        <div class="container-fluid mb-4">
                            <div class="row d-flex justify-content-center mt-3">
                            <div class="col-12">
                                <div class="card">
                                <div class="card-body">
                                    <div class="d-flex flex-start align-items-center">
                                    @if( $forums->role == 'System Admin' )
                                        <img class="rounded-circle shadow-1-strong me-3 mr-2"
                                        src="../../images/{{ $forums->profile_pic}}" alt="avatar" width="45"
                                        height="45" />

                                        <div>
                                        <h6 class="fw-bold mb-1">{{ $forums->fname }} {{ $forums->mname }} {{ $forums->lname }} <span class="badge badge-danger">System Admin</span></h6>
                                    </div>
                                    @endif

                                    @if( $forums->role == 'Employee' )
                                        <img class="rounded-circle shadow-1-strong me-3 mr-2"
                                        src="./../images/{{ $forums->emp_profile_pic}}" alt="avatar" width="45"
                                        height="45" />

                                        <div>
                                        <h6 class="fw-bold mb-1">{{ $forums->emp_fname }} {{ $forums->emp_mname }} {{ $forums->emp_lname }} <span class="badge badge-primary">Employee</span></h6>
                                    </div>
                                    @endif

                                    @if( $forums->role == 'Tenant' )
                                        <img class="rounded-circle shadow-1-strong me-3 mr-2"
                                        src="./../images/{{ $forums->tenant_profile_pic}}" alt="avatar" width="45"
                                        height="45" />

                                        <div>
                                        <h6 class="fw-bold mb-1">{{ $forums->tenant_fname }} {{ $forums->tenant_mname }} {{ $forums->tenant_lname }} <span class="badge badge-success">Tenant</span></h6>
                                    </div>
                                    @endif
                                    
                                    
                                    </div>

                                    <div class="mt-3">
                                        <h5><b>{{ $forums->title }}</b></h5>
                                    </div>

                                    <p class="mt-3 mb-0 pb-2">
                                    {{ $forums->body }}
                                    </p>
                                    <div class="small d-flex justify-content-start mb-4">
                                                    <a href="tenant-show-forum-comment/{{$forums->forum_id}}" class="d-flex align-items-center me-3">
                                                        <i class="far fa-comment-dots me-5 "></i>
                                                            <p class="mb-0 mr-2">See more</p>
                                                    </a>
                                                </div>
                                    </div>
                                    
        </div>
      </div>
    </div>
  </div>
  @endforeach
@endsection 