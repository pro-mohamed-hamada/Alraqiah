<div class="mb-3">
    <div class="card">
        <div class="card-header">{{ __('lang.sites') }}</div>

        <div class="card-body">
            <div class="">
                @can('create_site')
                <h5><a role="button" class="btn btn-primary " href="{{route('sites.create')}}"><i class="fa fa-plus"></i> {{__('lang.create_site')}}</a></h5>
                @endcan
            </div>

            <div class="datatable table-responsive">
                
                {!! $dataTable->table(['class' => 'table-data table table-bordered text-nowrap border-bottom']) !!}
            </div>
            
        </div>
    </div>
</div>
