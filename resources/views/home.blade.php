@extends('layouts.app')


        @section('content')
        <div class="content col-md-9 col-lg-10 offset-md-3 offset-lg-2">
            <div class="row mb-3 g-3">
                        <div class="col-lg-4">
                                
                                <div class="card">

                                        <div class="card-body">
                                                <label>{{ __('lang.total_users') }}</label>
                                                <h2>{{ $total_users }}</h2>
                                        </div>
                                </div>
                        </div>
                        <div class="col-lg-4">
                                
                                <div class="card">

                                        <div class="card-body">
                                                <label>{{ __('lang.total_clients') }}</label>
                                                <h2>{{ $total_clients }}</h2>
                                        </div>
                                </div>
                        </div>
                        <div class="col-lg-4">
                                
                                <div class="card">

                                        <div class="card-body">
                                                <label>{{ __('lang.total_complaints') }}</label>
                                                <h2>{{ $total_complaints }}</h2>
                                        </div>
                                </div>
                        </div>
                        <div class="col-lg-4">
                                
                                <div class="card">

                                        <div class="card-body">
                                                <label>{{ __('lang.active_complaints') }}</label>
                                                <h2>{{ $active_complaints }}</h2>
                                        </div>
                                </div>
                        </div>
                        <div class="col-lg-4">
                                
                                <div class="card">

                                        <div class="card-body">
                                                <label>{{ __('lang.not_active_complaints') }}</label>
                                                <h2>{{ $not_active_complaints }}</h2>
                                        </div>
                                </div>
                        </div>
                        <div class="col-lg-4">
                                
                                <div class="card">

                                        <div class="card-body">
                                                <label>{{ __('lang.total_videos') }}</label>
                                                <h2>{{ $total_videos }}</h2>
                                        </div>
                                </div>
                        </div>
                        <div class="col-lg-4">
                                
                                <div class="card">

                                        <div class="card-body">
                                                <label>{{ __('lang.total_faqs') }}</label>
                                                <h2>{{ $total_faqs }}</h2>
                                        </div>
                                </div>
                        </div>
                        <div class="col-lg-4">
                                
                                <div class="card">

                                        <div class="card-body">
                                                <label>{{ __('lang.total_sites') }}</label>
                                                <h2>{{ $total_sites }}</h2>
                                        </div>
                                </div>
                        </div>
                        <div class="col-lg-4">
                                
                                <div class="card">

                                        <div class="card-body">
                                                <label>{{ __('lang.rate') }}</label>
                                                <h2>{{ $rate }}</h2>
                                        </div>
                                </div>
                        </div>
            </div>            
        </div>
        @endsection
   
