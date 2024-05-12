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
        <h2 class="mb-3 me-auto">Product</h2>
        <div>
            <ol class="breadcrumb">

                <li class="breadcrumb-item"><a href="{{route('products.index')}}">Product</a></li>
            </ol>
        </div>
    </div>

    <div class="no-gutters">
        <form action="{{ route('products.update',$product->id) }}" method="POST" id="blog-form"  enctype="multipart/form-data" >
            @method('PUT')
            @csrf
        <div class="col-xl-12">
            <div class="card" style=" padding: 30px">
                <div class="card-header">
                    <h4>Edit Product information </h4>
                </div>

                <div class="auth-form">

                        <div class="row">
                            <div class="mb-3 col-xl-6">
                                <label class="mb-1 ms-1"><strong>English Title</strong></label>
                                <input type="text" class="form-control" name="english_title" placeholder="English Title" value="{{$product->english_title}}" required>
                                <span style="color: red;">@error('english_title'){{$message}}@enderror</span>

                            </div>
                            <div class="mb-3 col-xl-6">
                                <label class="mb-1 ms-1"><strong>Urdu Title</strong></label>
                                <input type="text" class="form-control" name="urdu_title" placeholder="Urdu Title" value="{{$product->urdu_title}}" required>
                                <span style="color: red;">@error('urdu_title'){{$message}}@enderror</span>

                            </div>
                            <div class="mb-3 col-xl-6">
                                <label class="mb-1 ms-1"><strong>Price</strong></label>
                                <input type="text" class="form-control digitInput" name="price" placeholder="Price" value="{{$product->price}}" required>
                                <span style="color: red;">@error('price'){{$message}}@enderror</span>

                            </div>
                            <div class="mb-3 col-xl-6">
                                <label class="mb-1 ms-1"><strong>Sale Price</strong></label>
                                <input type="text" class="form-control digitInput" name="sale_price" placeholder="Sale Price" value="{{$product->sale_price}}" required>
                                <span style="color: red;">@error('sale_price'){{$message}}@enderror</span>

                            </div>
                            <div class="mb-3 col-xl-6">
                                <label class="mb-1 ms-1"><strong>Qauantity</strong></label>
                                <input type="text" class="form-control digitInput" name="quantity" placeholder="Qauantity" value="{{$product->quantity}}" required>
                                <span style="color: red;">@error('quantity'){{$message}}@enderror</span>

                            </div>
                            <div class="mb-3 col-xl-6">
                                <label class="mb-1 ms-1"><strong>Weight</strong></label>
                                <input type="text" class="form-control" name="weight" placeholder="Weight"  value="{{$product->weight}}" required>
                                <span style="color: red;">@error('weight'){{$message}}@enderror</span>

                            </div>
                            <div class="mb-3 col-xl-6">
                                <label class="mb-1 ms-1"><strong>Enlish Type</strong></label>
                                <input type="text" class="form-control" name="english_type" placeholder="English" value="{{$product->english_type}}" required>
                                <span style="color: red;">@error('type'){{$message}}@enderror</span>

                            </div>
                            <div class="mb-3 col-xl-6">
                                <label class="mb-1 ms-1"><strong>Urdu Type</strong></label>
                                <input type="text" class="form-control" name="urdu_type" placeholder="Urdu" value="{{$product->urdu_type}}" required>
                                <span style="color: red;">@error('type'){{$message}}@enderror</span>

                            </div>
                            <div class="mb-3 col-xl-6">
                                <label class="mb-1 ms-1"><strong>Please Select Category </strong></label>
                            
                                <select  class="form-control" name="category_id" required="">
                                    <option value="">Select</option>
                                    @foreach($categories as $category)
                                    <option value="{{$category->id}}" @if($product->category_id== $category->id) selected @endif>{{$category->english_title}}
                                    </option>
                                    @endforeach
                                </select>
                                <span style="color: red;">@error('weight'){{$message}}@enderror</span>

                            </div>
                            <div class="mb-3 col-xl-6">
                                <label class="mb-1 ms-1"><strong>Images</strong></label>
                                <input type="file" class="form-control" name="images[]"  multiple>
                                <span style="color: red;">@error('images'){{$message}}@enderror</span>

                            </div>
            
                                <div class="mb-3 col-xl-6">
                                <label class="mb-1 ms-1"><strong>Urdu Description</strong></label>
                                <input type="text" class="form-control" name="urdu_description" placeholder="Urdu Description" value="{{$product->urdu_description}}" required>
                                <span style="color: red;">@error('urdu_title'){{$message}}@enderror</span>

                            </div>
                            <div class="mb-3 col-xl-6">
                                <label class="mb-1 ms-1"><strong>Enlish Description</strong></label>
                                <input type="text" class="form-control" name="english_description" value="{{$product->english_description}}" placeholder="Enlish Description" required>
                                <span style="color: red;">@error('urdu_title'){{$message}}@enderror</span>

                            </div>
                             <div class="mb-3 col-xl-12 mt-4">
                                <label class="switch">
                                    <input type="checkbox"name="status" value="1"  @if($product->status==1) checked @endif >
                                    <span class="slider round"></span>
                                </label>


                            </div>
                            <div class="mb-3 col-xl-12 mt-4">
                                <button class="btn btn-primary float-end">Update</button>
                            </div>
                        </div>

                    

                           

                        </div>


                </div>



            </div>
       
        </form>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
    $('.digitInput').on('keypress', function(event) {
    var keyCode = event.which;

    // Allow digits (0-9), decimal point (.), and control keys (like backspace, delete, arrow keys)
    if ((keyCode < 48 || keyCode > 57) && keyCode !== 46) {
        event.preventDefault(); // Prevent the default action (typing non-allowed characters)
    } else {
        // Allow only one decimal point (.)
        var currentValue = $(this).val();
        if (keyCode === 46 && currentValue.includes('.')) {
            event.preventDefault(); // Prevent typing another decimal point
        }
    }
});

});
</script>
@endsection

