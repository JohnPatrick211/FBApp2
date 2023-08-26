@include('modals.employeeinfo_modals')
@extends('layouts.admin')

@section('content')

                    <!-- Page Heading -->
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
                                    
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="forum-table"width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                        <th>Forum Title</th>
                                        <th>Author Name</th>
                                        <th>User Type</th>
                                        <th style="width: 100px;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($forums as $forum)
                                        <tr>
                                            <td>{{ $forum->title }}</td>
                                            @if( $forum->role == 'System Admin' )
                                                <td>{{ $forum->fname }} {{ $forum->mname }} {{ $forum->lname }}</td>
                                                <td>{{ $forum->role }}</td>
                                            @endif

                                            @if( $forum->role == 'Employee' )
                                                <td>{{ $forum->emp_fname }} {{ $forum->emp_mname }} {{ $forum->emp_lname }}</td>
                                                <td>{{ $forum->role }}</td>
                                            @endif

                                            @if( $forum->role == 'Tenant' )
                                                <td>{{ $forum->tenant_fname }} {{ $forum->tenant_mname }} {{ $forum->tenant_lname }}</td>
                                                <td>{{ $forum->role }}</td>
                                            @endif
                                            <td>
                                                <a href='show-forum-comment/{{$forum->forum_id}}'class="btn btn-primary">Show Forum</a>
                                            </td>
                                        </tr>
                                        @endforeach
                                </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            
            <!-- End of Main Content -->
@endsection
