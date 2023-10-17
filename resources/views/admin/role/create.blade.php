@extends('admin.include.main')
@section('title', 'Create User Role')
@section('content')
<div class="pcoded-content">
    <!-- [ breadcrumb ] start -->
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Create User Role</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/dashboard')}}"><i class="feather icon-home"></i></a></li>
                        <li class="breadcrumb-item"><a href="{{route('getAllUserRole')}}">Role</a></li>
                        <li class="breadcrumb-item"><a href="{{route('getAllUserRole')}}">Create Role User</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- [ breadcrumb ] end -->
    <!-- [ Main Content ] start -->
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>Create a user role</h5>
                </div>
                <div class="card-body">
                    <form action="{{route('getStoreUserRole')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="floating-label" for="create">Can Create</label>
                                    <select class="form-control" id="can_create" name="can_create" aria-placeholder="Can Create or not">
                                        <option value="0">No</option>
                                        <option value="1">Yes</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="floating-label" for="create">Can Read</label>
                                    <select class="form-control" id="can_read" name="can_read" aria-placeholder="Can read or not">
                                        <option value="0">No</option>
                                        <option value="1">Yes</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="floating-label" for="create">Can Update</label>
                                    <select class="form-control" id="can_update" name="can_update" aria-placeholder="Can update or not">
                                        <option value="0">No</option>
                                        <option value="1">Yes</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="floating-label" for="create">Can Delete</label>
                                    <select class="form-control" id="can_delete" name="can_delete" aria-placeholder="Can delete or not">
                                        <option value="0">No</option>
                                        <option value="1">Yes</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="floating-label" for="Title">User</label>
                                    <select class="form-control" id="user" name="user" value="{{old('user')}}" placeholder="Select a user">
                                        <option value="">Select a user</option>
                                        @foreach ($user as $item)    
                                            <option value="{{$item->id}}">{{$item->name}} | {{$item->email}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="floating-label" for="create">User Type</label>
                                    <select class="form-control" id="usertype" name="usertype" aria-placeholder="Select the user usertype">
                                        <option value="">Select the user usertype</option>
                                        <option value="admin">Admin</option>
                                        <option value="user">User</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                
                            </div>
                        </div>
                        <div class="row">       
                            <div class="col-sm-3"></div>                     
                            <div class="col-lg-6">
                            </div>
                            <div class="col-sm-3">
                                <input type="submit" value="submit" class="btn  btn-outline-primary float-right">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- [ Main Content ] end -->

</div>
@endsection