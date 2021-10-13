@extends('layout')

@section('content')
<div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
            <div class="col-sm-6" style="margin: auto;">
                @if (session()->has('message'))
                                    <div class="alert alert-success">
                                        {{ session('message') }}
                                    </div>
                                @endif
                </div>
            <div class="row">
                
                <div style="clear: both; height: 10px;"></div>
                <div class="col-sm-6" style="margin: auto;">
                    <div class="grid grid-cols-1 md:grid-cols-2">
                        <div class="p-12">
                            <div class="ml-12">
                                <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
                                    <table class="table">
                                      <thead>
                                        <tr>
                                          <th scope="col">#</th>
                                          <th scope="col">Video</th>
                                          <th scope="col">Action</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        @foreach ($videos as $key => $video)
                                        <tr>
                                          <th scope="row">{{ $key +1 }}</th>
                                          <td>{{ $video->title }}</td>
                                          <td>
                                            <a class="btn btn-primary" target="_blank" href="{{ route('videos.play', $video->id) }}">Play</a>

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

            </div>
        </div>
@endsection()