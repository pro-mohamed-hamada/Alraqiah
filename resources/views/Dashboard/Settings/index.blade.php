@extends('layouts.app')


        @section('content')
        <div class="content col-md-9 col-lg-10 offset-md-3 offset-lg-2">
            <div class="mb-3">
                <div class="card">
                    <div class="card-header">{{ __('lang.edit_settings') }}</div>

                    <div class="card-body">
                        {{-- start create form --}}
                        <form method="POST" action="{{ route('settings.update', $setting->id) }}">
                            @method('put')
                            @csrf
                            <div class="row mb-3 g-3">

                                <div class="col-lg-4">
                                    <label>{{ __('lang.primary_phone') }} *</label>
                                    <input type="text" name="primary_phone" value="{{ $setting->primary_phone }}" class="form-control">
                                    @error('primary_phone')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-lg-4">
                                    <label>{{ __('lang.whatsapp_phone') }} *</label>
                                    <input type="text" name="whatsapp_phone" value="{{ $setting->whatsapp_phone }}" class="form-control">
                                    @error('whatsapp_phone')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-lg-4">
                                    <label>{{ __('lang.email') }} *</label>
                                    <input type="email" name="email" value="{{ $setting->email }}" class="form-control">
                                    @error('email')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-lg-4">
                                    <label>{{ __('lang.elhamla_male_doctor_number') }} *</label>
                                    <input type="tel" name="elhamla_male_doctor_number" value="{{ $setting->elhamla_male_doctor_number }}" class="form-control">
                                    @error('elhamla_male_doctor_number')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-lg-4">
                                    <label>{{ __('lang.elhamla_female_doctor_number') }} *</label>
                                    <input type="tel" name="elhamla_female_doctor_number" value="{{ $setting->elhamla_female_doctor_number }}" class="form-control">
                                    @error('elhamla_female_doctor_number')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-lg-4">
                                    <label>{{ __('lang.mufti_number') }} *</label>
                                    <input type="tel" name="mufti_number" value="{{ $setting->mufti_number }}" class="form-control">
                                    @error('mufti_number')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3 g-3">
                                <div class="col-lg-12">
                                    <label>{{ __('lang.about_us') }} *</label>
                                    <textarea name="about_us" class="form-control">{{ $setting->about_us }}</textarea>
                                    @error('about_us')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-lg-12">
                                    <label>{{ __('lang.terms_and_conditions') }} *</label>
                                    <textarea name="terms_and_conditions" class="form-control">{{ $setting->terms_and_conditions }}</textarea>
                                    @error('terms_and_conditions')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <hr>
                            <h1>{{ __('lang.map_limits') }}</h1>
                            <div class="row mb-3 g-3">

                                <div class="col-lg-4">
                                    <img style="height: 300px" src="{{ asset('images/map_limits.jpg') }}" class="form-control">
                                </div>
                            </div>
                            <div class="row mb-3 g-3">
                                <div class="col-lg-6">
                                    <label>{{ __('lang.point_one_lat') }} *</label>
                                    <input type="text" name="point_one_lat" value="{{ $setting->point_one_lat }}" class="form-control">
                                    @error('point_one_lat')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-lg-6">
                                    <label>{{ __('lang.point_one_lng') }} *</label>
                                    <input type="text" name="point_one_lng" value="{{ $setting->point_one_lng }}" class="form-control">
                                    @error('point_one_lng')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-lg-6">
                                    <label>{{ __('lang.point_two_lat') }} *</label>
                                    <input type="text" name="point_two_lat" value="{{ $setting->point_two_lat }}" class="form-control">
                                    @error('point_two_lat')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-lg-6">
                                    <label>{{ __('lang.point_two_lng') }} *</label>
                                    <input type="text" name="point_two_lng" value="{{ $setting->point_two_lng }}" class="form-control">
                                    @error('point_two_lng')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-lg-6">
                                    <label>{{ __('lang.point_three_lat') }} *</label>
                                    <input type="text" name="point_three_lat" value="{{ $setting->point_three_lat }}" class="form-control">
                                    @error('point_three_lat')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-lg-6">
                                    <label>{{ __('lang.point_three_lng') }} *</label>
                                    <input type="text" name="point_three_lng" value="{{ $setting->point_three_lng }}" class="form-control">
                                    @error('point_three_lng')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-lg-6">
                                    <label>{{ __('lang.point_four_lat') }} *</label>
                                    <input type="text" name="point_four_lat" value="{{ $setting->point_four_lat }}" class="form-control">
                                    @error('point_four_lat')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-lg-6">
                                    <label>{{ __('lang.point_four_lng') }} *</label>
                                    <input type="text" name="point_four_lng" value="{{ $setting->point_four_lng }}" class="form-control">
                                    @error('point_four_lng')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
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

