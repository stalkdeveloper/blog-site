
@extends('admin.include.main')
@section('title', 'All Role User')
@section('content')
<?php 
    $data = userInfo();                    
?>
<div class="pcoded-content">
    <!-- [ breadcrumb ] start -->
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h5 class="m-b-10">User Role</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/dashboard')}}"><i class="feather icon-home"></i></a></li>
                        <li class="breadcrumb-item"><a href="{{route('getAllUserRole')}}">Role</a></li>
                        <li class="breadcrumb-item"><a href="{{route('getAllUserRole')}}">All Role User</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- [ breadcrumb ] end -->
    <!-- [ Main Content ] start -->
    <div class="row">
        <!-- [ Hover-table ] start -->
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    <h5>Role</h5>
                    <span class="d-block m-t-5">Here, your user <code>role</code> will be available</span>
                    @if($data->can_create == '1' || Auth::user()->usertype == 'admin')
                        <a href="{{route('getCreateUserRole')}}" class="btn  btn-outline-primary float-right">Create User Role</a>
                    @endif
                </div>
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    {{-- <th>Module</th> --}}
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(!empty($roles))
                                    @if(is_array($roles) || is_object($roles))
                                        @forelse ($roles->chunk(20) as $role)
                                            @forelse ($role as $count=>$item)
                                                <tr>
                                                    <td>{{$count+1}}</td> 
                                                    <td>{{$item->users->name}}</td>
                                                    <td>{{$item->users->email}}</td>
                                                    <td>
                                                        @if($item->can_create == '1' && $item->can_read == '1' && $item->can_update == '1' && $item->can_delete == '1')
                                                            Admin
                                                        @else
                                                            User Access    
                                                            @if($item->can_create == '1')
                                                                Create
                                                            @endif
                                                            @if($item->can_read == '1')
                                                                Read
                                                            @endif
                                                            @if($item->can_update == '1')
                                                                Update
                                                            @endif
                                                            @if($item->can_delete == '1')
                                                                Delete
                                                            @endif
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if($data->can_update == '1' || Auth::user()->usertype == 'admin')
                                                            <a href="{{route('getViewUserRole', $item->id)}}" class="btn btn-success btn-sm" role="button" aria-pressed="true">Edit</a>
                                                        @endif
                                                        @if($data->can_delete == '1' || Auth::user()->usertype == 'admin')
                                                            <a href="{{route('getDeleteUserRole', $item->id)}}" class="btn btn-danger btn-sm" role="button" aria-pressed="true">Delete</a>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td>
                                                        No Data Found!
                                                    </td>
                                                </tr>
                                            @endforelse
                                        @empty
                                            <tr>
                                                <td>
                                                    No Data Found!
                                                </td>
                                            </tr>
                                        @endforelse
                                    @endif
                                @endif
                            </tbody>
                        </table>
                        {{$roles->appends(['filter'=>'role', $roles->currentPage()])->links()}}
                    </div>
                </div>
            </div>
        </div>
        <!-- [ Hover-table ] end -->
        <!-- [ Background-Utilities ] end -->
    </div>
    <!-- [ Main Content ] end -->
</div>
@endsection
