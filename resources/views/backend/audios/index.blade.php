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

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="mb-sm-4 d-flex flex-wrap align-items-center text-head">
        <h2 class="mb-3 me-auto">Manage Audio</h2>
        <div>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('audios.index') }}">Audio</a></li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card" style="padding: 10px">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">Audio List</h4>
                    <a href="{{ route('audios.create') }}" class="btn btn-primary">Add New Audio</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table display shadow-hover card-table text-black">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Audio</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($audios as $key => $audio)
                                    <tr>
                                        <th>{{ $key + 1 }}</th>
                                        <td>
                                            <audio controls>
                                                <source src="{{ $audio->audio }}" type="audio/ogg">
                                                Your browser does not support the audio element.
                                            </audio>
                                        </td>
                                        <td>
                                            <label class="switch">
                                                <input type="checkbox" {{ $audio->status ? 'checked' : '' }}>
                                                <span class="slider"></span>
                                            </label>
                                        </td>
                                        <td>
                                            <a href="{{ route('audios.edit', $audio->id) }}" class="btn btn-success"> Edit </a>

                                            <form action="{{ route('audios.destroy', $audio->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this audio?')"> Delete </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
