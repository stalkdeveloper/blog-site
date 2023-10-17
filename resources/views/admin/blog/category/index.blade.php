
@extends('admin.include.main')
@section('title', 'All Category')
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
                        <h5 class="m-b-10">Article Category</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/dashboard')}}"><i class="feather icon-home"></i></a></li>
                        <li class="breadcrumb-item"><a href="{{route('getAllCategory')}}">Category</a></li>
                        <li class="breadcrumb-item"><a href="{{route('getAllCategory')}}">Types of category</a></li>
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
                    <h5>Category</h5>
                    <span class="d-block m-t-5">Here, your articles <code>Category</code> will be available</span>
                    @if($data->can_create == '1' || Auth::user()->usertype == 'admin')
                        <a href="{{route('getCreateCategory')}}" class="btn  btn-outline-primary float-right">Create Category</a>
                    @endif
                </div>
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Author</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(!empty($category))
                                    @if(is_array($category) || is_object($category))
                                        @foreach ($category->chunk(20) as $cate)
                                            @forelse ($cate as $count=>$item)
                                                <tr>
                                                    <td>{{$count+1}}</td> 
                                                    <td>{{$item->title}}</td>
                                                    <td style="white-space: inherit;">{{$item->description ?? 'N/A'}}</td>
                                                    <td>
                                                        {{$item->users->name ?? 'N/A'}}
                                                    </td>
                                                    <td>
                                                        @if($data->can_read == '1' || Auth::user()->usertype == 'admin')
                                                            <a href="{{route('getViewCategoryDetails', $item->id)}}" class="btn btn-primary btn-sm" role="button" aria-pressed="true">View</a>
                                                        @endif
                                                        @if($data->can_update == '1' || Auth::user()->usertype == 'admin')
                                                            <a href="{{route('getViewCategory', $item->id)}}" class="btn btn-success btn-sm" role="button" aria-pressed="true">Edit</a>
                                                        @endif
                                                        @if($data->can_delete == '1' || Auth::user()->usertype == 'admin')
                                                            <a href="{{route('getDeleteCategory', $item->id)}}" class="btn btn-danger btn-sm" role="button" aria-pressed="true">Delete</a>
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
                                        @endforeach
                                    @endif
                                @endif
                            </tbody>
                        </table>
                        {{$category->appends(['filter'=>'categorries', $category->currentPage()])->links()}}
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
