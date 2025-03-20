@extends('backend.layouts.app')

@section('content')
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
    @if(session('success'))
        <div class="alert alert-success">
            {{session('success')}}
        </div>
    @endif
    <div class="mb-sm-4 d-flex flex-wrap align-items-center text-head">
        <h2 class="mb-3 me-auto">Manage Category</h2>
        <div>
            <ol class="breadcrumb">

                <li class="breadcrumb-item"><a href="{{route('categories.index')}}">Categories</a></li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card" style=" padding: 10px">
                <div class="card-header">
                    <h4 class="card-title"> Category List</h4>

                    <a href="{{route('categories.create')}}" class="btn btn-primary btn-sl-sm me-2">Add New Category</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table display shadow-hover card-table text-black">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>English Title</th>
                                <th>Urdu Title</th>
                                 <th>First Image</th>
                                <th>2nd Image</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($categories as $key => $category)
                                <tr>
                                    <th>{{$key+1}}</th>
                                    <td>{{$category->english_title}}</td>
                                    <td>{{$category->urdu_title}}</td>
                                    <td><img src="{{$category->image_1}}"  style="width: 100px"></td>
                                    <td><img src="{{$category->image_2}}"  style="width: 100px"></td>
                                    <td><label class="switch">
                                        <input type="checkbox" {{ $category->status ? 'checked' : '' }}>
                                        <span class="slider round"></span>
                                    </label></td>
                                    <td><a href="{{route('categories.edit',$category->id)}}"
                                           class="btn btn-success" > Edit </a>
                                        <a href="{{route('categories.show',$category->id)}}"
                                           class="btn btn-danger" > Delete </a></td>


                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /# card -->
        </div>
    </div>

@endsection
