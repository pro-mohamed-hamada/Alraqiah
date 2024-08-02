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
                                    <label>{{ __('lang.type') }} *</label>
                                    <select type="text" name="type" class="form-control">
                                        <option value="">{{ __('lang.choose') }}</option>
                                        <option value="video" {{ $video->type == 'video' ? "selected":"" }}>{{ __('lang.video') }}</option>
                                        <option value="image" {{ $video->type == 'image' ? "selected":"" }}>{{ __('lang.image') }}</option>
                                    </select>
                                    @error('type')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-lg-4">
                                    <label>{{ __('lang.title') }} *</label>
                                    <input type="text" name="title" value="{{ $video->title }}" class="form-control">
                                    @error('title')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-lg-4">
                                    <label>{{ __('lang.media') }} *</label>
                                    <input type="file" name="media_file" class="form-control">
                                    @error('media_file')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-12">
                                    <div class="form-check form-switch">
                                        <input name="is_active" class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" {{ $video->getRawOriginal('is_active') ? "checked":"" }}>
                                        <label class="form-check-label" for="flexSwitchCheckChecked">{{ __('lang.is_active') }}</label>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <h2>{{ __('lang.current_media') }}</h2>
                                    @if($video->type == 'video')
                                    <video width="320" height="240" controls>
                                        <source src="{{ $video->getFirstMediaUrl('media') }}" type="video/mp4">
                                        <source src="{{ $video->getFirstMediaUrl('media') }}" type="video/ogg">
                                        Your browser does not support the video tag.
                                    </video>
                                    @else
                                    <img width="320" height="240" src="{{ $video->getFirstMediaUrl('media') }}">
                                    @endif
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

