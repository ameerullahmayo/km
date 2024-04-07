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
        <h2 class="mb-3 me-auto">Retailers</h2>
        <div>
            <ol class="breadcrumb">

                <li class="breadcrumb-item"><a href="{{route('users.index')}}">Retailers</a></li>
            </ol>
        </div>
    </div>

    <div class="no-gutters">
        <form action="{{ route('users.store') }}" method="POST" id="blog-form"  enctype="multipart/form-data" onsubmit="submitForm(event)">
            @csrf

            <div class="row">
                <div class=" mb-4">


                    <button type="submit" class="btn btn-primary float-end btn-block">Save</button>
                </div>
            </div>
        <div class="col-xl-12">
            <div class="card" style=" padding: 30px">
                <div class="card-header">
                    <h4>Retailer information </h4>
                </div>

                <div class="auth-form">


                        <div class="row">
                            <div class="mb-3 col-xl-6">
                                <label class="mb-1 ms-1"><strong>Full Name</strong></label>
                                <input type="text" class="form-control" name="name" placeholder="name" required>
                                <span style="color: red;">@error('name'){{$message}}@enderror</span>

                            </div>

                            <div class="mb-3 col-xl-6">
                                <label class="mb-1 ms-1"><strong>Email Address</strong></label>
                                <input type="text" class="form-control" id="tags-input" placeholder="email" onkeydown="handleKeyDown(event)" name="email">
                                @error('email'){{$message}}@enderror</span>
                                <div id="tags-container" class="tag_vals"></div>
                            </div>

                            <div class="mb-3 col-xl-6">
                                <label class="mb-1 ms-1"><strong>Phone Number</strong></label>
                                <input type="text" class="form-control" id="tags-input" placeholder="Phone Number" onkeydown="handleKeyDown(event)" name="phonenumber">
                                @error('Phonenumber'){{$message}}@enderror</span>
                                <div id="tags-container" class="tag_vals"></div>
                            </div>
                            <br>
                            <div class="mb-3 col-xl-6">
                                <label class="mb-1 ms-1"><strong>Business Name</strong></label>
                                <input type="text" class="form-control" id="tags-input" placeholder="Business Name" onkeydown="handleKeyDown(event)" name="businessname">
                                @error('Businessname'){{$message}}@enderror</span>
                                <div id="tags-container" class="tag_vals"></div>
                            </div>

                            <div class="mb-3 col-xl-6">
                                <label class="mb-1 ms-1"><strong>Store URL</strong></label>
                                <input type="text" class="form-control" id="tags-input" placeholder="Store URL" onkeydown="handleKeyDown(event)" name="storeurl">
                                @error('Storeurl'){{$message}}@enderror</span>
                                <div id="tags-container" class="tag_vals"></div>
                            </div>
                            <br>
                            <div class="mb-3 col-xl-6">
                                <label class="mb-1 ms-1"><strong>User Name</strong></label>
                                <input type="text" class="form-control" id="tags-input" placeholder="Username" onkeydown="handleKeyDown(event)" name="username">
                                @error('Username'){{$message}}@enderror</span>
                                <div id="tags-container" class="tag_vals"></div>
                            </div>


                        </div>

                        <div class="row">


                            <div class="mb-3 col-xl-6">
                                <label class="mb-1 ms-1"><strong>Password</strong></label>
                                <input type="password" class="form-control" name="password" placeholder="password" required>
                                @error('password'){{$message}}@enderror</span>
                            </div>

                            <div class="mb-3 col-xl-6 mt-4">
                                <label class="switch">
                                    <input type="checkbox"name="status" value="1" checked >
                                    <span class="slider round"></span>
                                </label>


                            </div>


                            <!--<div class="mb-3 col-xl-6">-->
                            <!--    <label class="mb-1 ms-1"><strong>Code</strong></label>-->
                            <!--    <input type="text" class="form-control" name="code" placeholder="code" required>-->
                            <!--    @error('code'){{$message}}@enderror</span>-->
                            <!--</div>-->

                        </div>


                </div>



            </div>
        </div>
            <div class="col-xl-12">
                <div class="card" style=" padding: 30px">
                    <div class="card-header">
                        <h4>Physical Store Location</h4>
                    </div>

                    <div class="auth-form">


                        <div class="row">
                            <div class="mb-3 col-xl-6">
                                <label class="mb-1 ms-1"><strong>Address</strong></label>
                                <input type="text" class="form-control" name="address" placeholder="Address" required>
                                <span style="color: red;">@error('Address'){{$message}}@enderror</span>

                            </div>

                            <div class="mb-3 col-xl-6">
                                <label class="mb-1 ms-1"><strong>City</strong></label>
                                <input type="text" class="form-control" id="tags-input" placeholder="City" onkeydown="handleKeyDown(event)" name="city">
                                @error('City'){{$message}}@enderror</span>
                                <div id="tags-container" class="tag_vals"></div>
                            </div>
                        </div>

                        <div class="row">


                            <div class="mb-3 col-xl-6">
                                <label class="mb-1 ms-1"><strong>Zip Code</strong></label>
                                <input type="Zip" class="form-control" name="zip" placeholder="Zipcode" required>
                                @error('Zip'){{$message}}@enderror</span>
                            </div>

                            <div class="mb-3 col-xl-6">
                                <label class="mb-1 ms-1"><strong>State</strong></label>
                                <input type="text" class="form-control" id="tags-input" placeholder="State" onkeydown="handleKeyDown(event)" name="state">
                                @error('State'){{$message}}@enderror</span>
                                <div id="tags-container" class="tag_vals"></div>
                            </div>


{{--                            <div class="mb-3 col-xl-6">--}}
{{--                                <label class="mb-1 ms-1"><strong>Code</strong></label>--}}
{{--                                <input type="code" class="form-control" name="code" placeholder="code" required>--}}
{{--                                @error('code'){{$message}}@enderror</span>--}}
{{--                            </div>--}}


                            <!--<div class="mb-3 col-xl-6">-->
                            <!--    <label class="mb-1 ms-1"><strong>Code</strong></label>-->
                            <!--    <input type="text" class="form-control" name="code" placeholder="code" required>-->
                            <!--    @error('code'){{$message}}@enderror</span>-->
                            <!--</div>-->

                        </div>


                    </div>



                </div>
            </div>
        </form>
    </div>
    </div>
{{--        <script>--}}
{{--            // Initialize CKEditor--}}
{{--            CKEDITOR.replace('editor');--}}
{{--        </script>--}}
{{--        <script>--}}
{{--            function handleKeyDown(event) {--}}
{{--                if (event.key === "Enter" || event.key === ",") {--}}
{{--                    event.preventDefault();--}}
{{--                    addTag();--}}
{{--                }--}}
{{--            }--}}

{{--            function addTag() {--}}
{{--                const tagsInput = document.getElementById("tags-input");--}}
{{--                const tagsContainer = document.getElementById("tags-container");--}}
{{--                const tagValue = tagsInput.value.trim();--}}

{{--                if (tagValue !== "") {--}}
{{--                    const tagElement = document.createElement("div");--}}
{{--                    tagElement.classList.add("tag");--}}
{{--                    tagElement.textContent = tagValue;--}}
{{--                    tagElement.addEventListener("click", function () {--}}
{{--                        tagsContainer.removeChild(tagElement);--}}
{{--                    });--}}

{{--                    tagsContainer.appendChild(tagElement);--}}
{{--                    tagsInput.value = ""; // Clear the input field--}}
{{--                }--}}
{{--            }--}}
{{--            function submitForm(event) {--}}
{{--                event.preventDefault();--}}
{{--                // You can access the comma-separated tags from the hidden input field--}}
{{--                const tagElements = document.getElementsByClassName("tag");--}}
{{--                console.log(tagElements);--}}
{{--                const tags = Array.from(tagElements).map(tag => tag.textContent);--}}
{{--                document.getElementById("tags-input").value = tags.join(",");--}}
{{--                const myForm = document.getElementById("blog-form");--}}
{{--                myForm.submit();--}}
{{--                // Add your form submission logic here--}}
{{--                // For example: document.getElementById("blog-form").submit();--}}

{{--                // Prevent the form from actually submitting for this example--}}
{{--                // event.preventDefault();--}}
{{--            }--}}
{{--        </script>--}}
@endsection
