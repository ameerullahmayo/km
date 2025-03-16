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
        transition: .4s;
        border-radius: 34px;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 26px;
        width: 26px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        transition: .4s;
        border-radius: 50%;
    }

    input:checked + .slider {
        background-color: #2196F3;
    }

    input:checked + .slider:before {
        transform: translateX(26px);
    }
</style>

<div class="mb-sm-4 d-flex flex-wrap align-items-center text-head">
    <h2 class="mb-3 me-auto">Add New Audio</h2>
    <div>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('audios.index') }}">Audio</a></li>
            <li class="breadcrumb-item active">Create</li>
        </ol>
    </div>
</div>

<div class="no-gutters">
    <form action="{{ route('audios.store') }}" method="POST" id="audio-form" enctype="multipart/form-data">
        @csrf
        <div class="col-xl-12">
            <div class="card p-4">
                <div class="card-header">
                    <h4>Audio Information</h4>
                </div>

                <div class="auth-form">
                    <div class="mb-3 col-xl-6">
                        <label class="mb-1 ms-1"><strong>Audio File</strong></label>
                        <input type="file" class="form-control" name="audio" accept="audio/*" required>
                        @error('audio')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3 col-xl-12 mt-4">
                        <label class="mb-1"><strong>Status</strong></label>
                        <label class="switch ms-2">
                            <input type="checkbox" name="status" value="1" checked>
                            <span class="slider"></span>
                        </label>
                    </div>

                    <div class="mb-3 col-xl-12 mt-4">
                        <button type="submit" class="btn btn-primary float-end">Save Audio</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

@endsection
