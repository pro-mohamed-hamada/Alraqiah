@extends('layouts.app')


        @section('content')
        <div class="content col-md-9 col-lg-10 offset-md-3 offset-lg-2">
            <div class="mb-3">
                <div class="card">
                    <div class="card-header">{{ __('lang.fcm_messages_filters') }}</div>

                    <div class="card-body">
                        <form method="post" action="{{ route('fcm-messages.index') }}">
                            @method('get')
                            <div class="filters">
                                <div class="row mb-3 g-3">
                                    <div class="col-lg-4">
                                        <label>fdfd</label>
                                        <input type="text" name="is_active" value="{{ Request('is_active') }}" class="form-control" placeholder="First name" aria-label="First name">
                                    </div>
                                    <div class="col-lg-4">
                                        <label>fdfd</label>
                                        <input type="text" class="form-control" placeholder="Last name" aria-label="Last name">
                                    </div>
                                </div>
                            </div>
                            <div  class="filters-buttons">
                                <div class="">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> {{__('lang.search')}}</button>
                                    <button type="reset" class="btn btn-primary"><i class="fa fa-plus"></i> {{__('lang.reset')}}</button>
                                </div>
                            </div>
                        </form>
                        

                    </div>
                </div>
            </div>
            
            {{-- start Datatable --}}
            @include('Datatables.FcmMessagesDatatable');
            {{-- end Datatable --}}
        </div>
        @endsection
        @section("script")
        @include('layouts.datatables-scripts')
        @endsection
