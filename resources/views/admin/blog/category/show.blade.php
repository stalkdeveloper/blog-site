@extends('admin.include.main')
@section('title', 'View Category')
@section('content')
<?php 
    $datdGet = userInfo();                    
?>
    <div class="pcoded-content">
        <div class="pcoded-inner-content">
            <div class="main-body">
                <div class="page-wrapper">
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
                                        @if($datdGet->can_read == '1' || Auth::user()->usertype == 'admin')
                                            <li class="breadcrumb-item"><a href="{{route('getAllCategory')}}">Category</a></li>
                                            <li class="breadcrumb-item"><a href="{{route('getAllCategory')}}">Types of category</a></li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- [ static-layout ] start -->
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5>{{$data->title ?? 'N/A'}}</h5>
                                </div>
                                <div class="card-body">
                                    <p>{{$data->description ?? 'N/A'}}</p>
                                    {{-- <div class="alert alert-info mb-0" role="alert">
                                        <p class="mb-0">It is best suited for those applications where you don't need sidebar &amp; header to be fixed while scrolling the page.</p>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                        <!-- [ static-layout ] end -->
                    </div>
                    <div class="row">
                        @foreach($data->articles as $article)
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">{{$article->title}}</h5>
                                        <img class="img-fluid card-img-top" src="{{ asset('storage/' . $article->image) }}" alt="Uploaded Image">
                                    </div>
                                    <div class="card-text ml-2">
                                        {!! $article->content !!}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <!-- [ Main Content ] end -->
                </div>
            </div>
        </div>
    </div>
@endsection