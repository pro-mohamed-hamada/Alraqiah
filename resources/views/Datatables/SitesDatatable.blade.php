<div class="mb-3">
    <div class="card">
        <div class="card-header">{{ __('lang.sites') }}</div>

        <div class="card-body">
            <div class="">
                @can('create_site')
                <h5><a role="button" class="btn btn-primary " href="{{route('sites.create')}}"><i class="fa fa-plus"></i> {{__('lang.create_site')}}</a></h5>
                @endcan
            </div>
            <div class="search-box">
                <div class="row mb-3 g-3">
                    <div class="col-sm-2">
                        <select name="displaySelectBox" class="form-control">
                            <option>25</option>
                            <option>50</option>
                            <option>100</option>
                            <option>{{ __('lang.show_all') }}</option>
                        </select>
                    </div>
                    <div class="col-sm-7 col-lg-10">
                        <input name="searchTxt" type="text" class="form-control" placeholder="{{__('lang.search')}}">
                    </div>
                </div>
            </div>

            <div class="datatable table-responsive">
                
                {!! $dataTable->table(['class' => 'table-data table table-bordered text-nowrap border-bottom']) !!}
            </div>
            
        </div>
    </div>
</div>
