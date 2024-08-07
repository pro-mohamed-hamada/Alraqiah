@extends('layouts.app')


        @section('content')
        <div class="content col-md-9 col-lg-10 offset-md-3 offset-lg-2">
            <div class="mb-3">
                <div class="card">
                    <div class="card-header">{{ __('lang.create_client') }}</div>

                    <div class="card-body">
                        <div class="errors alert alert-danger">
                            <ul>

                            </ul>
                        </div>
                        {{-- start update form --}}
                        <form id="client_form" method="POST" action="{{ route('clients.store') }}">
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
                                    <input type="text" name="seat_number" value="{{ old('seat_number') }}" class="form-control">
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
                                    <label>{{ __('lang.identity_number') }} *</label>
                                    <input type="number" name="identity_number" value="{{ old('identity_number') }}" class="form-control">
                                    @error('identity_number')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-lg-4">
                                    <label>{{ __('lang.country') }} *</label>
                                    <input type="text" name="country" value="{{ old('country') }}" class="form-control">
                                    @error('country')
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

                                <div class="col-lg-4">
                                    <label>{{ __('lang.arrival_location_url') }} *</label>
                                    <input type="url" name="arrival_location_url" class="form-control">
                                    @error('arrival_location_url')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-lg-4">
                                    <label>{{ __('lang.supervisor') }} *</label>
                                    <select name="supervisor_id" class="form-control selectpicker" data-live-search="true">
                                        <option disabled selected>{{ __('choose') }}</option>
                                        @foreach ($supervisors as $supervisor)
                                        <option value="{{ $supervisor->id }}">{{ $supervisor->name }}</option>
                                        @endforeach
                                    </select>
                                    @error("supervisor_id")
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
                                        <input name="chronic_disease" class="form-check-input" type="checkbox" id="flexSwitchCheckChecked">
                                        <label class="form-check-label" for="flexSwitchCheckChecked">{{ __('lang.chronic_disease') }}</label>
                                    </div>
                                </div>
                                <div style="display: none" id="chronic_disease_description_parent" class="col-lg-12">
                                    <label>{{ __('lang.chronic_disease_description') }} *</label>
                                    <textarea name="chronic_disease_description" class="form-control"></textarea>
                                    @error('chronic_disease_description')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>

                            </div>
                            <hr>
                            <div class="row mb-3 g-3">
                                {{-- sites --}}
                                <h3>{{ __('lang.sites') }}</h3>
                                @foreach($sites as $site)
                                    <div class="col-lg-4">
                                        <div class="form-check checkbox checkbox-primary mb-0">
                                            <input class="form-check-input" name="sites[]" value="{{$site->id}}" id="checkbox-primary-{{$site->id}}" type="checkbox" data-bs-original-title="" title="{{ $site->title }}">
                                            <label class="form-check-label" for="checkbox-primary-{{$site->id}}">{{ $site->title }}</label>
                                        </div>
                                    </div>
                                @endforeach
                                {{-- end sites --}}
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
                                    <button id="client_submit_button" type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> {{__('lang.create')}}</button>
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
                        <label>{{ __('lang.identity_number') }} *</label>
                        <input type="text" name="relatives_identity_number[]" class="form-control">
                        @error("relatives_identity_number[]")
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-lg-4">
                        <label>{{ __('lang.seat_number') }} *</label>
                        <input type="text" name="relatives_seat_number[]" class="form-control">
                        @error("relatives_seat_number[]")
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-lg-4">
                        <label>{{ __('lang.country') }} *</label>
                        <input type="text" name="relatives_country[]" class="form-control">
                        @error("relatives_country[]")
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
                    <div class="col-lg-4">
                        <label>{{ __('lang.logo') }} *</label>
                        <input type="file" name="relatives_logo[]" class="form-control">
                        @error('relatives_logo[]')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-12">
                        <div class="form-check form-switch">
                            <input name="relatives_chronic_disease[]" class="form-check-input" type="checkbox">
                            <label class="form-check-label">{{ __('lang.chronic_disease') }}</label>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <label>{{ __('lang.chronic_disease_description') }} *</label>
                        <textarea name="relatives_chronic_disease_description[]" class="form-control"></textarea>
                        @error('relatives_chronic_disease_description[]')
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
        $('#client_submit_button').click(function(e){
            e.preventDefault();
            var url = $('#client_form').attr("action");
            var data = $('#client_form').serialize();
            $.ajax({
                url:url,
                method:"post",
                data:data,
                beforeSend:function(){
                    $(".load_content").show();
                },
                success:function(responsetext){
                    $(".load_content").hide();
                    $(".alert_message").text('{{ __("lang.success_operation") }}');
                    $(".alert_message").fadeIn().delay(2000).fadeOut();
                    $(location).attr('href', "{{ route('clients.index') }}");
                },
                error: function(data_error, exception){
                    $(".load_content").hide();
                    if(exception == "error"){
                        $(".errors ul").text("");
                        $.each(data_error.responseJSON.errors, function(key, value) {
                            $(".errors ul").append("<li>" + key + ": " + value + "</li>");
                        });
                    }
                }
            });
        });
        $('input[name="chronic_disease"]').click(function(){
            if($(this).is(':checked'))
            {
                $('#chronic_disease_description_parent').show();
            }else{
                $('#chronic_disease_description_parent').hide();
            }
        });
    });
</script>

@endsection

