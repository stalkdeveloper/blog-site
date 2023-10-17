@extends('admin.include.main')
@section('title', 'Edit Article')
@section('content')
{{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"/> --}}
<div class="pcoded-content">
    <!-- [ breadcrumb ] start -->
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
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
    </div>
    <!-- [ breadcrumb ] end -->
    <!-- [ Main Content ] start -->
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>Here, Edit your Article</h5>
                </div>
                <div class="card-body">
                    <form action="{{route('getUpdateArticles')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" id="" value="{{$data->id}}"/>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="floating-label" for="category">Category</label>
                                    <select class="form-control" id="category" name="category" value="{{old('category')}}" placeholder="Select a category">
                                        <option value="{{$data->category_id}}">{{$data->categories->title}}</option>
                                        @foreach ($category as $item)
                                            @if($item->id != $data->category_id)
                                                <option value="{{$item->id}}">{{$item->title}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="floating-label" for="Title">Title</label>
                                    <input type="text" class="form-control" id="title" name="title" value="{{$data->title}}" placeholder="Enter a title">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <label class="floating-label" for="image">Image</label>
                                <div class="input-group cust-file-button mb-3">
                                    @if(!empty($data->image))
                                        <img src="{{ asset('storage/' . $data->image) }}" alt="Uploaded Image" style="width:100px; height:45px;">
                                    @endif
                                    <div class="input-group-prepend">
                                        <button class="btn btn-primary" type="button">Button</button>
                                    </div>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="image" value="" id="inputGroupFile03" accept="image/*">
                                        <label class="custom-file-label" for="inputGroupFile03">Choose image file</label>
                                    </div>
                                </div>                                
                            </div>
                            <div class="col-xl-12">
                                <div class="form-group">
                                    <label class="floating-label" for="content">content</label>
                                    <textarea class="form-control ckeditor" id="description" name="description" placeholder="Enter Description" rows="3" required>{{$data->content}}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">                            
                            <div class="col-lg-12">
                                <input type="submit" value="submit" class="btn  btn-primary btn-sm float-float">
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
<script>
    $(document).ready(function () {
        CKEDITOR.replace('description', {
            toolbar: [
                ['FontSize'],
                ['Bold', 'Italic', 'Link', 'BulletedList', 'NumberedList', 'BlockQuote', 'Undo', 'Redo'],
            ],
            fontSize_sizes: '12/12px;14/14px;16/16px;18/18px;24/24px;36/36px',
        });
    });
</script>