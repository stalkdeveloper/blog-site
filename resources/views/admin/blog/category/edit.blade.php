@extends('admin.include.main')
@section('title', 'Edit Category')
@section('content')
<div class="pcoded-content">
    <!-- [ breadcrumb ] start -->
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Article Category</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/dashboard')}}"><i class="feather icon-home"></i></a></li>
                        <li class="breadcrumb-item"><a href="{{route('getAllCategory')}}">Category</a></li>
                        <li class="breadcrumb-item"><a href="{{route('getAllCategory')}}">Edit Category</a></li>
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
                    <h5>Edit a Category</h5>
                </div>
                <div class="card-body">
                    <form action="{{route('getUpdateCategory')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{$data->id}}" />
                        <div class="row">
                            <div class="col-sm-3"></div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="floating-label" for="Title">Title</label>
                                    <input type="text" class="form-control" id="title" name="title" value="{{$data->title}}" placeholder="Enter a title">
                                </div>
                            </div>
                            <div class="col-sm-3"></div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3"></div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="floating-label" for="content">Description</label>
                                    <textarea class="form-control ckeditor" id="description" name="description" placeholder="Enter Description" rows="2" required>{{$data->description}}</textarea>
                                </div>
                            </div>
                            <div class="col-sm-3"></div>
                        </div>
                        <div class="row">       
                            <div class="col-sm-3"></div>                     
                            <div class="col-lg-6">
                                <input type="submit" value="submit" class="btn  btn-primary btn-sm float-right">
                            </div>
                            <div class="col-sm-3"></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- [ Main Content ] end -->

</div>
@endsection