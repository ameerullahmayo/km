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
    <h2 class="mb-3 me-auto">Edit Audio</h2>
    <div>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('audios.index') }}">Audio</a></li>
            <li class="breadcrumb-item active">Edit</li>
        </ol>
    </div>
</div>

<div class="no-gutters">
    <form action="{{ route('audios.update', $audio->id) }}" method="POST" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div class="col-xl-12">
            <div class="card p-4">
                <div class="card-header">
                    <h4>Audio Edit</h4>
                </div>

                <div class="auth-form">
                    <div class="mb-3 col-xl-6">
                        <label class="mb-1"><strong>Current Audio</strong></label>
                        @if($audio->audio)
                            <audio id="audio-player" controls>
                                <source src="{{ asset('storage/' . $audio->audio) }}" type="audio/mpeg">
                                Your browser does not support the audio element.
                            </audio>
                        @endif
                    </div>

                    <div class="mb-3 col-xl-6">
                        <label class="mb-1 ms-1"><strong>Replace Audio</strong></label>
                        <input type="file" class="form-control" name="audio" accept="audio/*">
                        @error('audio')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3 col-xl-12 mt-4">
                        <label class="mb-1"><strong>Status</strong></label>
                        <label class="switch ms-2">
                            <input type="checkbox" name="status" value="1" @if($audio->status == 1) checked @endif>
                            <span class="slider"></span>
                        </label>
                    </div>

                    <div class="mb-3 col-xl-12 mt-4">
                        <button type="submit" class="btn btn-primary float-end">Update Audio</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

@endsection
