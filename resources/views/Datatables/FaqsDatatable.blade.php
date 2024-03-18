<div class="mb-3">
    <div class="card">
        <div class="card-header">{{ __('lang.faqs') }}</div>

        <div class="card-body">
            <div class="">
                @can('create_faq')
                <h5><a role="button" class="btn btn-primary " href="{{route('faqs.create')}}"><i class="fa fa-plus"></i> {{__('lang.create_faq')}}</a></h5>
                @endcan
            </div>

            <div class="datatable table-responsive">
                
                {!! $dataTable->table(['class' => 'table-data table table-bordered text-nowrap border-bottom']) !!}
            </div>
            
        </div>
    </div>
</div>
{{-- @push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush --}}