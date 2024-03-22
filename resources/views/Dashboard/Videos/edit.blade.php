@extends('layouts.app')


        @section('content')
        <div class="content col-md-9 col-lg-10 offset-md-3 offset-lg-2">
            <div class="mb-3">
                <div class="card">
                    <div class="card-header">{{ __('lang.edit_video') }}</div>

                    <div class="card-body">
                        {{-- start create form --}}
                        <form method="POST" action="{{ route('videos.update', $video->id) }}" enctype="multipart/form-data">
                            @method('put')
                            @csrf
                            <div class="row mb-3 g-3">
                                
                                <div class="col-lg-4">
                                    <label>{{ __('lang.title') }} *</label>
                                    <input type="text" name="title" value="{{ $video->title }}" class="form-control">
                                    @error('title')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-lg-4">
                                    <label>{{ __('lang.video') }} *</label>
                                    <input type="file" name="video_file" class="form-control">
                                    @error('video_file')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-lg-12">
                                    <h2>{{ __('lang.current_video') }}</h2>
                                    <video width="320" height="240" controls>
                                        <source src="{{ $video->getFirstMediaUrl('media') }}" type="video/mp4">
                                        <source src="{{ $video->getFirstMediaUrl('media') }}" type="video/ogg">
                                        Your browser does not support the video tag.
                                    </video>
                                </div>
                            </div>
                            <div class="row mb-3 g-3">
                                <div class="">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> {{__('lang.update')}}</button>
                                    <a href="{{ url()->previous() }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> {{__('lang.go_back')}}</a>
                                </div>
                            </div>
                        </form>
                        {{-- end create form --}}
                    </div>
                </div>
            </div>
            
        </div>
        @endsection
   
