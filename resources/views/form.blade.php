@extends('layout')

@section('content')
<div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
                    <div class="grid grid-cols-1 md:grid-cols-2">
                        <div class="p-12">
                            <div>
                                @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
                                @if (session()->has('message'))
                                    <div class="alert alert-success">
                                        {{ session('message') }}
                                    </div>
                                @endif
                            </div>

                            <div class="col-sm-6" style="margin: auto;">
                                <form method="POST" action="{{ route('videos.upload') }}" enctype="multipart/form-data" >
                                @csrf
                                    <div class="form-group {{ $errors->has('title') ? ' has-error' : '' }}">
                                      <label for="title">Title</label>
                                      <input type="text" name="title" placeholder="Enter Title" class="form-control" required>
                                    </div>
                                    <div class="form-group {{ $errors->has('file') ? ' has-error' : '' }}" >
                                      <label for="file">Video</label>
                                      <input type="file" name="file" class="form-control" required>
                                    </div>
                                    
                                    <button type="submit" class="btn btn-primary">Upload</button>
                                  </form>
                            </div>
                        </div>
                    </div>
                </div>
@endsection()