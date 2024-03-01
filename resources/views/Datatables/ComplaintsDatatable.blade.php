<div class="mb-3">
    <div class="card">
        <div class="card-header">{{ __('lang.complaints') }}</div>

        <div class="card-body">
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
                
                <table class="complaintsTable has-data table text-center table-bordered  table-hover">
                    <thead>
                        <th>{{ __('lang.id') }}</th>
                        <th>{{ __('lang.complaint') }}</th>
                        <th>{{ __('lang.client') }}</th>
                        <th>{{ __('lang.phone') }}</th>
                        <th>{{ __('lang.actions') }}</th>
                        
                    </thead>
                    <tbody>
                        @foreach ($complaints as $complaint)
                        <tr>
                            <td>{{ $complaint->id }}</td>
                            <td>{{ $complaint->complaint }}</td>
                            <td>{{ $complaint->user->name }}</td>
                            <td>{{ $complaint->user->phone }}</td>
                            <td>
                                
                                <ul class="list-group list-group-horizontal">
                                    <li class="list-group-item">
                                        <form method="post" action="{{route('complaints.destroy', $complaint->id)}}">
                                            @csrf
                                            @method('delete')
                                            <button name="delete" type="submit" class=" btn btn-danger"><i class="fa fa-trash"></i></button>
                                        </form>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="col-md-12">
                                            <div class="form-check form-switch">
                                                <input id="is_active" name="is_active" data-href="{{ route('complaints.status', $complaint->id) }}" class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" {{ $complaint->getRawOriginal('is_active') ? "checked":"" }}>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </td>
                        </tr>
                        <tr class=" displayView">
                            <td colspan="10">
                                <div class="displayViewContent">
                                    @include('Datatables.ComplaintRepliesDatatable')
                                </div>
                                <button class="close btn btn-danger">X</button>     
                            </td>
                        </tr>
                        @endforeach 
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="10">
                                {{-- {{ $complaints->links() }}                  --}}
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            
        </div>
    </div>
</div>
