@include('modals.forumedit_modals')
@include('modals.forumdelete_modals')
@include('modals.addcomment_modals')
@include('modals.commentedit_modals')
@include('modals.commentdelete_modals')
@extends('layouts.employee')

@section('content')
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

<div class="container-fluid mb-4">
<a href="/employee-forum"><i class="fa fa-arrow-left"></i></a>
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

            @if(\Session::get('LoggedUser') == $forums->id)
            <div class="small d-flex justify-content-start mb-4">
                            <a href="#!" class="d-flex align-items-center me-3">
                                <i class="far fa-comment-dots me-5 "></i>
                                    <p class="mb-0 mr-2" data-toggle="modal" data-target="#AddCommentModal">Add Comment</p>
                            </a>
                            <a href="#!" class="d-flex align-items-center me-3 ">
                                <i class="far fa-comment-dots me-5 "></i>
                                <p class="mb-0 mr-2" data-toggle="modal" data-target="#EditForumModal">Edit</p>
                            </a>
                            <a href="#!" class="d-flex align-items-center me-3">
                                <i class="fas fa-archive me-5"></i>
                                <p class="mb-0" data-toggle="modal" data-target="#ForumDeleteModal" >Delete</p>
                            </a>
                        </div>
            @else
            <div class="small d-flex justify-content-start mb-4">
                            <a href="#!" class="d-flex align-items-center me-3">
                            <i class="far fa-comment-dots me-5 "></i>
                                <p class="mb-0 mr-2" data-toggle="modal" data-target="#AddCommentModal">Add Comment</p>
                            </a>
            </div>                    
            @endif
            
            <hr>
            @if(count($comments) > 0)
            <h4>Comments</h4>
            @endif

            @if(count($comments) < 0)
            <h4>Comments</h4>
            @endif
                    @foreach($comments as $comments)
                        <div class="display-comment">
                            <hr>
                        @if( $comments->role == 'System Admin' )
                        <img class="rounded-circle shadow-1-strong me-3 mr-2 mb-2"
                            src="../../images/{{ $comments->profile_pic}}" alt="avatar" width="45"
                            height="45" />
                            <strong>{{ $comments->fname }} {{ $comments->mname }} {{ $comments->lname }} <span class="badge badge-danger">System Admin</span></strong>
                        @endif

                        @if( $comments->role == 'Employee' )
                        <img class="rounded-circle shadow-1-strong me-3 mr-2 mb-2"
                            src="../../images/{{ $comments->emp_profile_pic}}" alt="avatar" width="45"
                            height="45" />
                            <strong>{{ $comments->emp_fname }} {{ $comments->emp_mname }} {{ $comments->emp_lname }} <span class="badge badge-primary">Employee</span></strong>
                        @endif

                        @if( $comments->role == 'Tenant' )
                        <img class="rounded-circle shadow-1-strong me-3 mr-2 mb-2"
                            src="../../images/{{ $comments->tenant_profile_pic}}" alt="avatar" width="45"
                            height="45" />
                            <strong>{{ $comments->tenant_fname }} {{ $comments->tenant_mname }} {{ $comments->tenant_lname }} <span class="badge badge-success">Tenant</span></strong>
                        @endif
                            
                        <p class="mb-2" id="commentbody" comment-body="{{ $comments->comment_body }}">{{ $comments->comment_body }}</p>

                        @if(\Session::get('LoggedUser') == $comments->id)
                        <div class="small d-flex justify-content-start mb-4">
                            <a href="#!" class="d-flex align-items-center me-3 ">
                                <i class="far fa-comment-dots me-5 "></i>
                                <p class="mb-0 mr-2" data-toggle="modal" id="editcomment" comment-id="{{ $comments->comment_id }}" data-target="#EditCommentModal">Edit</p>
                            </a>
                            <a href="#!" class="d-flex align-items-center me-3">
                                <i class="fas fa-archive me-5"></i>
                                <p class="mb-0" data-toggle="modal" id="deletecomment" comment-id="{{ $comments->comment_id }}" data-target="#DeleteCommentModal">Delete</p>
                            </a>
                        </div>
                        @endif
                        </div>
                    @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection