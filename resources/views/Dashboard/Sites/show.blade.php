@extends('layouts.app')


        @section('content')
        <div class="content col-md-9 col-lg-10 offset-md-3 offset-lg-2">
            <div class="mb-3">
                <div class="card">
                    <div class="card-header">{{ __('lang.show_site') }}</div>

                    <div class="card-body">
                        {{-- start show --}}
                            <div class="row mb-3 g-3">
                                
                                <div class="col-lg-4">
                                    <label>{{ __('lang.title') }} *</label>
                                    <label class="form-control">{{ $site->title }}</label>
                                </div>
                                <div class="col-lg-4">
                                    <label>{{ __('lang.url') }} *</label>
                                    <label class="form-control">{{ $site->url }}</label>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-check form-switch">
                                        <input name="is_active" class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" {{ $site->is_active ? "checked":"" }}>
                                        <label class="form-check-label" for="flexSwitchCheckChecked">{{ __('lang.is_active') }}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3 g-3">
                                <div class="">
                                    <a href="{{ url()->previous() }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> {{__('lang.go_back')}}</a>
                                </div>
                            </div>
                        </form>
                        {{-- end show --}}
                    </div>
                </div>
            </div>
            
        </div>
        @endsection
   
