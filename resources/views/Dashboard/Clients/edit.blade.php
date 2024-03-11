@extends('layouts.app')


        @section('content')
        <div class="content col-md-9 col-lg-10 offset-md-3 offset-lg-2">
            <div class="mb-3">
                <div class="card">
                    <div class="card-header">{{ __('lang.edit_client') }}</div>

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
                        {{-- start update form --}}
                        <form method="POST" action="{{ route('clients.update', $client->id) }}">
                            @method('put')
                            @csrf
                            <div class="row mb-3 g-3">
                                
                                <div class="col-lg-4">
                                    <label>{{ __('lang.name') }} *</label>
                                    <input type="text" name="name" value="{{ $client->user->name }}" class="form-control">
                                    @error('name')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-lg-4">
                                    <label>{{ __('lang.phone') }} *</label>
                                    <input type="tel" name="phone" value="{{ $client->user->phone }}" class="form-control">
                                    @error('phone')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-lg-4">
                                    <label>{{ __('lang.reservation_number') }} *</label>
                                    <input type="text" name="reservation_number" value="{{ $client->reservation_number }}" class="form-control">
                                    @error('reservation_number')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-lg-4">
                                    <label>{{ __('lang.reservation_status') }} *</label>
                                    <input type="text" name="reservation_status" value="{{ $client->reservation_status }}" class="form-control">
                                    @error('reservation_status')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-lg-4">
                                    <label>{{ __('lang.package') }} *</label>
                                    <input type="text" name="package" value="{{ $client->package }}" class="form-control">
                                    @error('package')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-lg-4">
                                    <label>{{ __('lang.launch_date') }} *</label>
                                    <input type="date" name="launch_date" value="{{ $client->launch_date }}" class="form-control">
                                    @error('launch_date')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-lg-4">
                                    <label>{{ __('lang.seat_number') }} *</label>
                                    <input type="text" name="seat_number" value="{{ $client->seat_number }}" class="form-control">
                                    @error('seat_number')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-lg-4">
                                    <label>{{ __('lang.gender') }} *</label>
                                    <select name="gender" class="form-control">
                                        <option value="">{{ __('lang.choose') }}</option>
                                        <option value="male" {{ $client->gender == "male" ? "selected":""}}>{{ __('lang.male') }}</option>
                                        <option value="female" {{ $client->gender == "female" ? "selected":"" }}>{{ __('lang.female') }}</option>
                                    </select>
                                    @error('gender')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-lg-4">
                                    <label>{{ __('lang.national_number') }} *</label>
                                    <input type="number" name="national_number" value="{{ $client->national_number }}" class="form-control">
                                    @error('national_number')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-lg-4">
                                    <label>{{ __('lang.city') }} *</label>
                                    <input type="text" name="city" value="{{ $client->city }}" class="form-control">
                                    @error('city')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-lg-4">
                                    <label>{{ __('lang.supervisor') }} *</label>
                                    <select name="supervisor_id" class="form-control selectpicker" data-live-search="true">
                                        <option disabled selected>{{ __('choose') }}</option>
                                        @foreach ($supervisors as $supervisor)
                                        <option value="{{ $supervisor->id }}" {{ $supervisor->id == $client->supervisor->id ? "selected":"" }}>{{ $supervisor->name }}</option>
                                        @endforeach
                                    </select>
                                    @error("supervisor_id")
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
                                    {{-- start client relatives --}}

                                    @foreach ($client->relatives as $relative)
                                    <div class="mb-3 relative">
                                        <div class="card">
                                            <div class="card-body">
                                                {{-- start update form --}}
                                                <div class="row mb-3 g-3">
                                                    <div class="col-lg-4">
                                                        <label>{{ __('lang.name') }} *</label>
                                                        <input type="text" name="relatives_name[]" value="{{ $relative->name }}" class="form-control">
                                                        @error("relatives[0].name")
                                                            <span class="error">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <label>{{ __('lang.gender') }} *</label>
                                                        <select name="relatives_gender[]" class="form-control">
                                                            <option value="male" {{ $relative->gender == "male"? "selected": ""}}>{{ __('lang.male') }}</option>
                                                            <option value="female" {{ $relative->gender == "male"? "selected": ""}}>{{ __('lang.female') }}</option>
                                                        </select>
                                                        @error("relatives_gender[]")
                                                            <span class="error">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <label>{{ __('lang.national_number') }} *</label>
                                                        <input type="text" name="relatives_national_number[]" value="{{ $relative->national_number }}" class="form-control">
                                                        @error("relatives_national_number[]")
                                                            <span class="error">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <label>{{ __('lang.seat_number') }} *</label>
                                                        <input type="text" name="relatives_seat_number[]" value="{{ $relative->seat_number }}" class="form-control">
                                                        @error("relatives_seat_number[]")
                                                            <span class="error">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <label>{{ __('lang.city') }} *</label>
                                                        <input type="text" name="relatives_city[]" value="{{ $relative->city }}" class="form-control">
                                                        @error("relatives_city[]")
                                                            <span class="error">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="row mb-3 g-3">
                                                    <div class="relative-buttons">
                                                        <button type="button" data-url="{{ route('relatives.destroy', $relative->id) }}" class="btn btn-danger remove-relative"><i class="fa fa-trash"></i></button>
                                                    </div>
                                                </div>
                                                {{-- end update form --}}
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach

                                    {{-- end the client relatives --}}
                                </div>
                                {{-- end the client relatives --}}
                            </div>
                            <div class="row mb-3 g-3">
                                <div class="">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> {{__('lang.update')}}</button>
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
            
            var element = $(this).parents('.relative');
            var url = $(this).data('url');
            if(url)
            {
                var status = confirm("{{ __('lang.are_you_sure') }}");
            
                if(status==true){
                    $.ajax({
                        url: url,
                        type: 'post',
                        data:{"_token": "{{ csrf_token() }}", "_method": "delete"},
                        beforeSend: function(){
                            $('.load_content').show();
                        },
                        success: function (res) {
                            element.remove();
                            $('.load_content').hide();
                        }
                        
                    });
                }
                
            }else{
                element.remove();
            }
            
            
        });
        
    });
</script>

@endsection
   
