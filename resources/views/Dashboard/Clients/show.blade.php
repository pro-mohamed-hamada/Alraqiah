@extends('layouts.app')


        @section('content')
        <div class="content col-md-9 col-lg-10 offset-md-3 offset-lg-2">
            <div class="mb-3">
                <div class="card">
                    <div class="card-header">{{ __('lang.show_client') }}</div>

                    <div class="card-body">
                        {{-- start show --}}
                            <div class="row mb-3 g-3">
                                
                                <div class="col-lg-4">
                                    <label>{{ __('lang.name') }} *</label>
                                    <label class="form-control">{{ $client->user->name }}</label>
                                </div>
                                <div class="col-lg-4">
                                    <label>{{ __('lang.phone') }} *</label>
                                    <label class="form-control">{{ $client->user->phone }}</label>
                                </div>
                                <div class="col-lg-4">
                                    <label>{{ __('lang.reservation_number') }} *</label>
                                    <label class="form-control">{{ $client->reservation_number }}</label>
                                </div>
                                <div class="col-lg-4">
                                    <label>{{ __('lang.package') }} *</label>
                                    <label class="form-control">{{ $client->package }}</label>
                                </div>
                                <div class="col-lg-4">
                                    <label>{{ __('lang.launch_date') }} *</label>
                                    <label class="form-control">{{ $client->launch_date }}</label>
                                </div>
                                <div class="col-lg-4">
                                    <label>{{ __('lang.seat_number') }} *</label>
                                    <label class="form-control">{{ $client->seat_number }}</label>
                                </div>
                                <div class="col-lg-4">
                                    <label>{{ __('lang.gender') }} *</label>
                                    <label class="form-control">{{ $client->gender == "male" ? __('lang.male'):__('lang.female')}}</label>
                                </div>
                                <div class="col-lg-4">
                                    <label>{{ __('lang.identity_number') }} *</label>
                                    <label class="form-control">{{ $client->identity_number }}</label>
                                </div>
                                <div class="col-lg-4">
                                    <label>{{ __('lang.country') }} *</label>
                                    <label class="form-control">{{ $client->country }}</label>
                                </div>
                                <div class="col-lg-4">
                                    <label>{{ __('lang.city') }} *</label>
                                    <label class="form-control">{{ $client->city }}</label>
                                </div>
                                <div class="col-lg-4">
                                    <label>{{ __('lang.supervisor') }} *</label>
                                    <label class="form-control">{{ $client->supervisor->name }}</label>
                                </div>

                            </div>
                            <hr>
                            <div class="row mb-3 g-3">
                                {{-- sites --}}
                                <h3>{{ __('lang.sites') }}</h3>
                                @foreach ($sites as $site)
                                        @if($client->sites->contains('id', $site->id))
                                            <div class="col-lg-4">
                                                <div class="form-check checkbox checkbox-primary mb-0">
                                                    <input class="form-check-input" name="sites[]" value="{{$site->id}}" id="checkbox-primary-{{$site->id}}" type="checkbox" data-bs-original-title="" title="{{ $site->title }}" checked disabled>
                                                    <label class="form-check-label" for="checkbox-primary-{{$site->id}}">{{ $site->title }}</label>
                                                </div>
                                            </div>
                                        @else
                                            <div class="col-lg-4">
                                                <div class="form-check checkbox checkbox-primary mb-0">
                                                    <input class="form-check-input" name="sites[]" value="{{$site->id}}" id="checkbox-primary-{{$site->id}}" type="checkbox" data-bs-original-title="" title="{{ $site->title }}" disabled>
                                                    <label class="form-check-label" for="checkbox-primary-{{$site->id}}">{{ $site->title }}</label>
                                                </div>
                                            </div>
                                        @endif
                                                
                                    @endforeach
                                {{-- end sites --}}
                            </div>
                            <hr>
                            <div class="row mb-3 g-3">
                                {{-- start the client relatives --}}
                                <div class="mb-3  client-relatives">
                                    <h3>{{ __('lang.relatives') }}</h3>
                                    {{-- start client relatives --}}

                                    @foreach ($client->relatives as $relative)
                                    <div class="mb-3 relative">
                                        <div class="card">
                                            <div class="card-body">
                                                {{-- start update form --}}
                                                <div class="row mb-3 g-3">
                                                    <div class="col-lg-4">
                                                        <label>{{ __('lang.name') }} *</label>
                                                        <label class="form-control">{{ $relative->name }}</label>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <label>{{ __('lang.gender') }} *</label>
                                                        <label class="form-control">{{ $relative->gender == "male" ? __('lang.male'):__('lang.female')}}</label>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <label>{{ __('lang.identity_number') }} *</label>
                                                        <label class="form-control">{{ $relative->identity_number }}</label>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <label>{{ __('lang.seat_number') }} *</label>
                                                        <label class="form-control">{{ $relative->seat_number }}</label>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <label>{{ __('lang.country') }} *</label>
                                                        <label class="form-control">{{ $relative->country }}</label>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <label>{{ __('lang.city') }} *</label>
                                                        <label class="form-control">{{ $relative->city }}</label>
                                                    </div>
                                                </div>
                                                {{-- end show --}}
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
                                    <a href="{{ url()->previous() }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> {{__('lang.go_back')}}</a>
                                </div>
                            </div>
                        {{-- end show --}}
                    </div>
                </div>
            </div>

            
        </div>
        @endsection
   
