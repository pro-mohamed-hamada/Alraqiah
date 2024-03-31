@extends('layouts.app')


        @section('content')
        <div class="content col-md-9 col-lg-10 offset-md-3 offset-lg-2">
            <div class="mb-3">
                <div class="card">
                    <div class="card-header">{{ __('lang.create_user') }}</div>

                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @if(session()->has('failures'))
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach (session('failures') as $failure)
                                        @foreach ($failure->errors() as $error)
                                            <li>Row {{ $failure->row() }}: {{ $error }}</li>
                                        @endforeach

                                        {{-- @foreach ($failure->values() as $attribute => $value)
                                            <li>In [{{ $attribute }}] with value [{{ $value }}]</li>
                                        @endforeach --}}
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        {{-- start create form --}}
                        <form method="POST" action="{{ route('users.import') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-3 g-3">
                                
                                <div class="col-lg-4">
                                    <label>{{ __('lang.file') }} *</label>
                                    <input type="file" name="file" class="form-control">
                                    @error('file')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <hr>
                            <div class="row mb-3 g-3">
                                    {{-- permissions --}}
                                    @foreach($permissions as $key =>$permission)
    
                                        <div class="col-sm-4 col-xl-4 border-5">
                                            <div class="card card-absolute">
                                                <div class="card-header bg-primary">
                                                    <h5 class="text-white">{{trans('lang.'.$key)}}</h5>
                                                </div>
    
                                                    <div class="card-body">
                                                        @foreach($permission as $item)
                                                            <div class="mb-3 m-t-15">
                                                                <div class="form-check checkbox checkbox-primary mb-0">
                                                                    <input class="form-check-input" name="permissions[]" value="{{$item->name}}" id="checkbox-primary-{{$item->id}}" type="checkbox" data-bs-original-title="" title="{{ trans('lang.'.$item->name) }}">
                                                                    <label class="form-check-label" for="checkbox-primary-{{$item->id}}">{{ trans('lang.'.$item->name) }}</label>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
    
                                            </div>
                                        </div>
    
                                    @endforeach
                                    {{-- end permissions --}}
                            </div>
                            <div class="row mb-3 g-3">
                                <div class="">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> {{__('lang.import')}}</button>
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
   
