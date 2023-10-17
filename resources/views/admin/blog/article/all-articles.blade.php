
@extends('admin.include.main')
@section('title', 'All Articles')
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
                        <h5 class="m-b-10">Articles</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/dashboard')}}"><i class="feather icon-home"></i></a></li>
                        <li class="breadcrumb-item"><a href="{{route('getAllArticles')}}">Articles</a></li>
                        <li class="breadcrumb-item"><a href="{{route('getAllArticles')}}">All Posts</a></li>
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
                    <h5>Articles</h5>
                    <span class="d-block m-t-5">Here, your <code>articles</code> will be available</span>
                    @if($data->can_create == '1' || Auth::user()->usertype == 'admin')
                        <a href="{{route('getCreateArticles')}}" class="btn  btn-outline-primary float-right">Create Article</a>
                    @endif
                </div>
                <div class="card-body table-border-style">
                    <form action="" id="" method="get">
                        <input type="hidden" name="filter" value="articles" id="filter">
                        <div class="row">
                            <div class="col-md-6"></div>
                            <div class="col-md-3">
                                <select id="inputState" class="form-control" name="category">
                                    <option value="">Select By Category</option>
                                    @foreach($category as $cat)
                                        <option @if ($cat->id == request('category'))
                                            selected
                                        @endif value="{{$cat->id}}">{{$cat->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <div class="input-group mb-3 float-right">
                                    <input type="text" class="form-control" id="search" value="{{$search}}" name="search" placeholder="Search...">
                                    <div class="input-group-append">
                                        <input class="btn  btn-primary" type="submit" value="Submit">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Category</th>
                                    <th>Content</th>
                                    <th>Image</th>
                                    <th>Author</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(!empty($articles))
                                    @if(is_array($articles) || is_object($articles))
                                        @forelse ($articles->chunk(20) as $article)
                                            @forelse ($article as $count=>$item)
                                                <tr>
                                                    <td>{{$count+1}}</td> 
                                                    <td>{{$item->title}}</td>
                                                    <td>{{$item->categories->title ?? 'N/A'}}</td>
                                                    <td style="width:240px;"> {!! substr($item->content, 0, 50) !!}</td>
                                                    <td>
                                                        <img src="{{ asset('storage/' . $item->image) }}" alt="Uploaded Image" style="width:100px; height:100px;">
                                                    </td>  
                                                    <td>
                                                        {{$item->users->name ?? 'N/A'}}
                                                    </td>
                                                    <td>
                                                        @if($data->can_read == '1' || Auth::user()->usertype == 'admin')
                                                            <a href="{{route('getViewArticles', $item->id)}}" class="btn btn-secondary btn-sm" role="button" aria-pressed="true">View</a>
                                                        @endif
                                                        @if($data->can_update == '1' || Auth::user()->usertype == 'admin')
                                                            <a href="{{route('getEditArticles', $item->id)}}" class="btn btn-success btn-sm" role="button" aria- pressed="true">Edit</a>
                                                        @endif
                                                        @if($data->can_delete == '1' || Auth::user()->usertype == 'admin')
                                                            <a href="{{route('getDeleteArticles', $item->id)}}" class="btn btn-danger btn-sm" role="button" aria-pressed="true">Delete</a>
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
                        {{$articles->appends(['filter'=>'articles', $articles->currentPage()])->links()}}
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
