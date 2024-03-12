<div class="mb-3">
    <div class="card">
        <div class="card-header">{{ __('lang.clients') }}</div>

        <div class="card-body">
            <div class="">
                @can('create_client')
                <h5><a role="button" class="btn btn-primary " href="{{route('clients.create')}}"><i class="fa fa-plus"></i> {{__('lang.create_client')}}</a></h5>
                @endif
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
                
                <table class="clientsTable has-data  table text-center table-bordered  table-hover">
                    <thead>
                        <th>{{ __('lang.id') }}</th>
                        <th>{{ __('lang.name') }}</th>
                        <th>{{ __('lang.phone') }}</th>
                        <th>{{ __('lang.reservation_number') }}</th>
                        <th>{{ __('lang.reservation_status') }}</th>
                        <th>{{ __('lang.package') }}</th>
                        <th>{{ __('lang.launch_date') }}</th>
                        <th>{{ __('lang.seat_number') }}</th>
                        <th>{{ __('lang.gender') }}</th>
                        <th>{{ __('lang.national_number') }}</th>
                        <th>{{ __('lang.location') }}</th>
                        <th>{{ __('lang.city') }}</th>
                        <th>{{ __('lang.supervisor') }}</th>
                        <th>{{ __('lang.actions') }}</th>
                        
                    </thead>
                    <tbody>
                        @foreach ($clients as $client)
                        <tr>
                            <td>{{ $client->id }}</td>
                            <td>{{ $client->user->name }}</td>
                            <td>{{ $client->user->phone }}</td>
                            <td>{{ $client->reservation_number }}</td>
                            <td>{{ $client->reservation_status }}</td>
                            <td>{{ $client->package }}</td>
                            <td>{{ $client->launch_date }}</td>
                            <td>{{ $client->seat_number }}</td>
                            <td>{{ $client->gender }}</td>
                            <td>{{ $client->national_number }}</td>
                            <td><a target="_blank" href="https://www.google.com/maps/search/?api=1&query={{$client->user->lat}},{{$client->user->lng}}"><i class="fa fa-map-o"></i></a></td>
                            <td>{{ $client->city }}</td>
                            <td>{{ $client->supervisor->name }}</td>
                            <td>
                                <ul class="list-group list-group-horizontal">
                                    <li class="list-group-item">
                                        <form method="post" action="{{route('clients.destroy', $client->id)}}">
                                            @csrf
                                            @method('delete')
                                            <button name="delete" type="submit" class=" btn btn-danger"><i class="fa fa-trash"></i></button>
                                        </form>
                                    </li>
                                    <li class="list-group-item"><a href="{{ route('clients.edit', $client->id) }}" class="btn btn-primary"><i class="fa fa-edit"></i></a></li>
                                    <li class="list-group-item"><a href="{{ route('clients.show', $client->id) }}" class="btn btn-primary"><i class="fa fa-eye"></i></a></li>
                                </ul>
                            </td>
                        </tr>
                        <tr class=" displayView">
                            <td colspan="10">
                                <div class="displayViewContent">
                                    @include('Datatables.ClientRelativesDatatable')
                                </div>
                                <button class="close btn btn-danger">X</button>     
                            </td>
                        </tr>
                        @endforeach 
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="10">
                                {{ $clients->links() }}                 
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            
        </div>
    </div>
</div>
