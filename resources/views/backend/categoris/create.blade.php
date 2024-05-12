@extends('backend.layouts.app')

@section('content')
    <style>
        #tags-input {
            width: 100%;
            box-sizing: border-box;
        }

        .tag {
            background-color: #e0e0e0;
            padding: 5px;
            border-radius: 3px;
            cursor: pointer;
            margin-right: 5px;
            margin-bottom: 5px;
            display: inline-block;
        }
    </style>
    <style>
        .switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 34px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: .4s;
            transition: .4s;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 26px;
            width: 26px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
        }

        input:checked + .slider {
            background-color: #2196F3;
        }

        input:focus + .slider {
            box-shadow: 0 0 1px #2196F3;
        }

        input:checked + .slider:before {
            -webkit-transform: translateX(26px);
            -ms-transform: translateX(26px);
            transform: translateX(26px);
        }

        /* Rounded sliders */
        .slider.round {
            border-radius: 34px;
        }

        .slider.round:before {
            border-radius: 50%;
        }
    </style>
    <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
    <div class="mb-sm-4 d-flex flex-wrap align-items-center text-head">
        <h2 class="mb-3 me-auto">Categories</h2>
        <div>
            <ol class="breadcrumb">

                <li class="breadcrumb-item"><a href="{{route('categories.index')}}">Category</a></li>
            </ol>
        </div>
    </div>

    <div class="no-gutters">
        <form action="{{ route('categories.store') }}" method="POST" id="blog-form"  enctype="multipart/form-data" >
            @csrf
        <div class="col-xl-12">
            <div class="card" style=" padding: 30px">
                <div class="card-header">
                    <h4>Category information </h4>
                </div>

                <div class="auth-form">

                        <div class="row">
                            <div class="mb-3 col-xl-6">
                                <label class="mb-1 ms-1"><strong>English Title</strong></label>
                                <input type="text" class="form-control" name="english_title" placeholder="English Title" required>
                                <span style="color: red;">@error('english_title'){{$message}}@enderror</span>

                            </div>
                            <div class="mb-3 col-xl-6">
                                <label class="mb-1 ms-1"><strong>Urdu Title</strong></label>
                                <input type="text" class="form-control" name="urdu_title" placeholder="Urdu Title" required>
                                <span style="color: red;">@error('urdu_title'){{$message}}@enderror</span>

                            </div>
                            <div class="mb-3 col-xl-6">
                                <label class="mb-1 ms-1"><strong>First Image</strong></label>
                                <input type="file" class="form-control" name="image_1" required>
                                <span style="color: red;">@error('image_1'){{$message}}@enderror</span>

                            </div>
                            <div class="mb-3 col-xl-6">
                                <label class="mb-1 ms-1"><strong>2nd Image</strong></label>
                                <input type="file" class="form-control" name="image_2" required>
                                <span style="color: red;">@error('image_2'){{$message}}@enderror</span>

                            </div>
                             <div class="mb-3 col-xl-12 mt-4">
                                <label class="switch">
                                    <input type="checkbox"name="status" value="1" checked >
                                    <span class="slider round"></span>
                                </label>


                            </div>
                            <div class="mb-3 col-xl-12 mt-4">
                                <button class="btn btn-primary float-end">Save</button>
                            </div>
                        </div>

                    

                           

                        </div>


                </div>



            </div>
       
        </form>
    </div>

@endsection
