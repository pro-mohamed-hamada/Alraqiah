@extends('layouts.app')


        @section('content')
        <div class="content col-md-9 col-lg-10 offset-md-3 offset-lg-2">
            <div class="mb-3">
                <div class="card">
                    <div class="card-header">{{ __('lang.create_client') }}</div>

                    <div class="card-body">
                        {{-- start update form --}}
                        <form method="POST" action="{{ route('clients.store') }}">
                            @csrf
                            <div class="row mb-3 g-3">
                                
                                <div class="col-lg-4">
                                    <label>{{ __('lang.name') }} *</label>
                                    <input type="text" name="name" value="{{ old('name') }}" class="form-control">
                                    @error('name')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-lg-4">
                                    <label>{{ __('lang.phone') }} *</label>
                                    <input type="tel" name="phone" value="{{ old('phone') }}" class="form-control">
                                    @error('phone')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-lg-4">
                                    <label>{{ __('lang.reservation_number') }} *</label>
                                    <input type="text" name="reservation_number" value="{{ old('reservation_number') }}" class="form-control">
                                    @error('reservation_number')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-lg-4">
                                    <label>{{ __('lang.reservation_status') }} *</label>
                                    <input type="text" name="reservation_status" value="{{ old('reservation_status') }}" class="form-control">
                                    @error('reservation_status')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-lg-4">
                                    <label>{{ __('lang.package') }} *</label>
                                    <input type="text" name="package" value="{{ old('package') }}" class="form-control">
                                    @error('package')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-lg-4">
                                    <label>{{ __('lang.launch_date') }} *</label>
                                    <input type="date" name="launch_date" value="{{ old('launch_date') }}" class="form-control">
                                    @error('launch_date')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-lg-4">
                                    <label>{{ __('lang.seat_number') }} *</label>
                                    <input type="number" name="seat_number" value="{{ old('seat_number') }}" class="form-control">
                                    @error('seat_number')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-lg-4">
                                    <label>{{ __('lang.gender') }} *</label>
                                    <select name="gender" class="form-control">
                                        <option value="">{{ __('lang.choose') }}</option>
                                        <option value="male">{{ __('lang.male') }}</option>
                                        <option value="female">{{ __('lang.female') }}</option>
                                    </select>
                                    @error('gender')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-lg-4">
                                    <label>{{ __('lang.national_number') }} *</label>
                                    <input type="number" name="national_number" value="{{ old('national_number') }}" class="form-control">
                                    @error('national_number')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-lg-4">
                                    <label>{{ __('lang.city') }} *</label>
                                    <input type="text" name="city" value="{{ old('city') }}" class="form-control">
                                    @error('city')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <hr>
                            <div class="row mb-3 g-3">
                                {{-- start the client relatives --}}
                                <div class="mb-3  client-relatives">
                                    <div class="mb-3">
                                        <button id="add-relative" type="button" class="btn btn-primary"><i class="fa fa-plus"></i> {{__('lang.add_relative')}}</button>
                                    </div>
                                </div>
                                {{-- end the client relatives --}}
                            </div>
                            <div class="row mb-3 g-3">
                                <div class="">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> {{__('lang.create')}}</button>
                                    <button type="button" class="btn btn-primary"><i class="fa fa-upload"></i> {{__('lang.import')}}</button>
                                    <a href="{{ url()->previous() }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> {{__('lang.go_back')}}</a>
                                </div>
                            </div>
                        </form>
                        {{-- end update form --}}
                    </div>
                </div>
            </div>

            
        </div>
        @endsection
<div id="relative" style="display: none !important">
    <div class="mb-3 relative">
        <div class="card">
            <div class="card-body">
                {{-- start update form --}}
                <div class="row mb-3 g-3">
                    <div class="col-lg-4">
                        <label>{{ __('lang.name') }} *</label>
                        <input type="text" name="relatives_name[]" class="form-control">
                        @error("relatives[0].name")
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-lg-4">
                        <label>{{ __('lang.gender') }} *</label>
                        <select name="relatives_gender[]" class="form-control">
                            <option value="male">{{ __('lang.male') }}</option>
                            <option value="female">{{ __('lang.female') }}</option>
                        </select>
                        @error("relatives_gender[]")
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-lg-4">
                        <label>{{ __('lang.national_number') }} *</label>
                        <input type="text" name="relatives_national_number[]" class="form-control">
                        @error("relatives_national_number[]")
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-lg-4">
                        <label>{{ __('lang.seat_number') }} *</label>
                        <input type="number" name="relatives_seat_number[]" class="form-control">
                        @error("relatives_seat_number[]")
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-lg-4">
                        <label>{{ __('lang.city') }} *</label>
                        <input type="text" name="relatives_city[]" class="form-control">
                        @error("relatives_city[]")
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3 g-3">
                    <div class="relative-buttons">
                        <button type="button" class="btn btn-danger remove-relative"><i class="fa fa-trash"></i></button>
                    </div>
                </div>
                {{-- end update form --}}
            </div>
        </div>
    </div>
</div>
@section('script')
<script>
    $(document).ready(function(){
        $('#add-relative').click(function(){
            var element = $('#relative').html();
            $('.client-relatives').append(element);
        });
        $('.client-relatives').on('click', '.remove-relative', function(){
            var element = $(this).parents('.relative')
            element.remove();
        });
    });
</script>

@endsection
   
