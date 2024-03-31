<div class="mb-3">
    <div class="card">
        <div class="card-header">{{ __('lang.users') }}</div>

        <div class="card-body">
            <div class="">
                @can('create_user')
                <a role="button" class="btn btn-primary " href="{{route('users.create')}}"><i class="fa fa-plus"></i> {{__('lang.create_user')}}</a>
                @endcan
                @can('import_user')
                <a role="button" class="btn btn-primary " href="{{route('users.import_view')}}"><i class="fa fa-upload"></i> {{__('lang.import')}}</a>
                <a role="button" target="_blanck" class="btn btn-primary " href="{{asset('imports/users.xlsx')}}"><i class="fa fa-download"></i> {{__('lang.download_template')}}</a>
                @endif
            </div>

            <div class="datatable table-responsive">
                {!! $dataTable->table(['class' => 'table-data table table-bordered text-nowrap border-bottom']) !!}
            </div>
            
        </div>
    </div>
</div>
