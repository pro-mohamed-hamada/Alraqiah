<div class="mb-3">
    <div class="card">
        <div class="card-header">{{ __('lang.clients') }}</div>

        <div class="card-body">

            <div class="datatable table-responsive">
                
                <table class="clientsTable  table text-center table-bordered  table-hover">
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
                        <th>{{ __('lang.identity_number') }}</th>
                        <th>{{ __('lang.location') }}</th>
                        <th>{{ __('lang.city') }}</th>
                        <th>{{ __('lang.actions') }}</th>
                        
                    </thead>
                    <tbody>
                        @foreach ($user->supervisorClients as $client)
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
                            <td>{{ $client->identity_number }}</td>
                            <td><a target="_blank" href="https://www.google.com/maps/search/?api=1&query={{$client->lat}},{{$client->lng}}"><i class="fa fa-map-o"></i></a></td>
                            <td>{{ $client->city }}</td>
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
                                </ul>
                            </td>
                        </tr>
                        @endforeach 
                    </tbody>
                </table>
            </div>
            
        </div>
    </div>
</div>
