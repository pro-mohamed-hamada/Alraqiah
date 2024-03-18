<div class="mb-3">
    <div class="card">
        <div class="card-header">{{ __('lang.schedule_fcm') }}</div>

        <div class="card-body">
            <div class="">
                @can('create_schedule_fcm')
                <h5><a role="button" class="btn btn-primary " href="{{route('schedule-fcm.create')}}"><i class="fa fa-plus"></i> {{__('lang.create_schedule_fcm')}}</a></h5>
                @endcan
            </div>

            <div class="datatable table-responsive">
                {!! $dataTable->table(['class' => 'table-data table table-bordered text-nowrap border-bottom']) !!}
            </div>
            
        </div>
    </div>
</div>
