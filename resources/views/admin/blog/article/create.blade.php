@extends('admin.include.main')
@section('title', 'Create Article')
@section('content')
<div class="pcoded-content">
    <!-- [ breadcrumb ] start -->
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Article</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html"><i class="feather icon-home"></i></a></li>
                        <li class="breadcrumb-item"><a href="#">Article</a></li>
                        <li class="breadcrumb-item"><a href="#">Create An Article</a></li>
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
                    <h5>Create an Article</h5>
                </div>
                <div class="card-body">
                    <form action="{{route('getStoreArticles')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="floating-label" for="category">Category</label>
                                    <select class="form-control" id="category" name="category" value="{{old('category')}}" placeholder="Select a category">
                                        <option value="">Select a category</option>
                                        @foreach ($category as $item)    
                                            <option value="{{$item->id}}">{{$item->title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="floating-label" for="Title">Title</label>
                                    <input type="text" class="form-control" id="title" name="title" value="{{old('title')}}" placeholder="Enter a title">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <label class="floating-label" for="image">Image</label>
                                <div class="input-group cust-file-button mb-3">
                                    <div class="input-group-prepend">
                                        <button class="btn btn-primary" type="button">Button</button>
                                    </div>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="image" value="{{old('image')}}" id="inputGroupFile03" accept="image/*">
                                        <label class="custom-file-label" for="inputGroupFile03">Choose image file</label>
                                    </div>
                                </div>                                
                            </div>
                            <div class="col-xl-12">
                                <div class="form-group">
                                    <label class="floating-label" for="content">Content</label>
                                    <textarea class="form-control ckeditor" id="description" name="description" placeholder="Enter Description" rows="3" required>{{old('description')}}    </textarea>
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