@extends('layouts.app')


        @section('content')
        <div class="content col-md-9 col-lg-10 offset-md-3 offset-lg-2">
            <div class="mb-3">
                <div class="card">
                    <div class="card-header">{{ __('lang.create_website') }}</div>

                    <div class="card-body">
                        {{-- start create form --}}
                        <form method="POST" action="{{ route('websites.store') }}">
                            @csrf
                            <div class="row mb-3 g-3">
                                
                                <div class="col-lg-4">
                                    <label>{{ __('lang.title') }} *</label>
                                    <input type="text" name="title" class="form-control">
                                    @error('title')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-lg-4">
                                    <label>{{ __('lang.url') }} *</label>
                                    <input type="text" name="url" class="form-control">
                                    @error('url')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3 g-3">
                                <div class="">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-plus-circle"></i> {{__('lang.create')}}</button>
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
   
