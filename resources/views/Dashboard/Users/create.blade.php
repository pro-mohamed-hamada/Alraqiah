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
                        {{-- start create form --}}
                        <form method="POST" action="{{ route('users.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-3 g-3">
                                
                                <div class="col-lg-4">
                                    <label>{{ __('lang.name') }} *</label>
                                    <input type="text" name="name" class="form-control">
                                    @error('name')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-lg-4">
                                    <label>{{ __('lang.email') }} *</label>
                                    <input type="email" name="email" class="form-control">
                                    @error('email')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-lg-4">
                                    <label>{{ __('lang.password') }} *</label>
                                    <input type="password" name="password" class="form-control">
                                    @error('password')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-lg-4">
                                    <label>{{ __('lang.password_confirmation') }} *</label>
                                    <input type="password" name="password_confirmation" class="form-control">
                                    @error('password')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-lg-4">
                                    <label>{{ __('lang.phone') }} *</label>
                                    <input type="tel" name="phone" class="form-control">
                                    @error('phone')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-lg-4">
                                    <label>{{ __('lang.logo') }} *</label>
                                    <input type="file" name="logo" class="form-control">
                                    @error('logo')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-12">
                                    <div class="form-check form-switch">
                                        <input name="is_active" class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked>
                                        <label class="form-check-label" for="flexSwitchCheckChecked">{{ __('lang.is_active') }}</label>
                                    </div>
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
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> {{__('lang.create')}}</button>
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
   
