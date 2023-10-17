@extends('admin.include.main')
@section('title', 'View Article')
@section('content')
<div class="pcoded-content">
    <div class="pcoded-inner-content">
        <div class="main-body">
            <div class="page-wrapper">
                <div class="page-header">
                    <div class="page-block">
                        <div class="row align-items-center">
                            <div class="col-md-12">
                                <div class="page-header-title">
                                    <h5 class="m-b-10">Article Id #{{$data->id}}</h5>
                                </div>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{url('/dashboard')}}"><i class="feather icon-home"></i></a></li>
                                    <li class="breadcrumb-item"><a href="{{route('getAllArticles')}}">Articles</a></li>
                                    <li class="breadcrumb-item"><a href="{{route('getAllArticles')}}">Your Article</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- [ breadcrumb ] end -->
                <!-- [ Main Content ] start -->
                <div class="row">
                    <!-- [ static-layout ] start -->
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <h5>Read Article</h5>
                            </div>
                            <div class="card-body">
                                <div class="col-md-12 col-xl-12">
                                    <h5>{{$data->title}}</h5>
                                    <hr>
                                    <div class="card mb-3">
                                        <img class="img-fluid card-img-top" src="{{ asset('storage/' . $data->image) }}" alt="Uploaded Image">
                                        <div class="card-body">
                                            <h5 class="card-title">{{$data->categories->title}}</h5>
                                            <div class="card-text">{!! $data->content !!}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- [ static-layout ] end -->
                </div>
                <!-- [ Main Content ] end -->
            </div>
        </div>
    </div>
</div>
@endsection