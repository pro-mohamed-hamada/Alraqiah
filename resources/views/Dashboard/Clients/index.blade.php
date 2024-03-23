@extends('layouts.app')


        @section('content')
        <div class="content col-md-9 col-lg-10 offset-md-3 offset-lg-2">
            <div class="mb-3">
                <div class="card">
                    <div class="card-header">{{ __('lang.clients_filters') }}</div>

                    <div class="card-body">
                        
                        <div class="filters">
                            <div class="row mb-3 g-3">
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
                                    <label>{{ __('lang.phone') }}</label>
                                    <input type="tel" name="phone" class="form-control" placeholder="{{ __('lang.phone') }}">
                                </div>
                                <div class="col-lg-4">
                                    <label>{{ __('lang.gender') }}</label>
                                    <select name="gender" class="form-control">
                                        <option>{{ __('lang.choose') }}</option>
                                        <option value="male">{{ __('lang.male') }}</option>
                                        <option value="female">{{ __('lang.female') }}</option>
                                    </select>
                                </div>
                                <div class="col-lg-4">
                                    <label>{{ __('lang.launch_date') }}</label>
                                    <input type="date" name="launch_date" class="form-control" placeholder="{{ __('lang.launch_date') }}">
                                </div>
                                
                            </div>
                        </div>
                        <div  class="filters-buttons">
                            <div class="">
                                <button class="btn btn-primary"><i class="fa fa-search"></i> {{__('lang.search')}}</button>
                                <button class="btn btn-primary"><i class="fa fa-plus"></i> {{__('lang.reset')}}</button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            
            {{-- start Datatable --}}
            @include('Datatables.ClientsDatatable');
            {{-- end Datatable --}}
        </div>
        @endsection
        @section("script")
        @include('layouts.datatables-scripts')
        @endsection
