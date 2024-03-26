<div class="mb-3">
    <div class="card">
        <div class="card-header">{{ __('lang.relatives') }}</div>

        <div class="card-body">
            
           

            <div class="datatable table-responsive">
                <table class="table text-center table-bordered table-hover">
                    <thead>
                        <th>{{ __('lang.id') }}</th>
                        <th>{{ __('lang.name') }}</th>
                        <th>{{ __('lang.gender') }}</th>
                        <th>{{ __('lang.identity_number') }}</th>
                        <th>{{ __('lang.seat_number') }}</th>
                        <th>{{ __('lang.country') }}</th>
                        <th>{{ __('lang.city') }}</th>
                        <th>{{ __('lang.created_at') }}</th>
                        
                    </thead>
                    <tbody>
                        @foreach ($client->relatives as $relative)
                        <tr>
                            <td>{{ $relative->id }}</td>
                            <td>{{ $relative->name }}</td>
                            <td>{{ $relative->gender }}</td>
                            <td>{{ $relative->identity_number }}</td>
                            <td>{{ $relative->seat_number }}</td>
                            <td>{{ $relative->country }}</td>
                            <td>{{ $relative->city }}</td>
                            <td>{{ $relative->created_at }}</td>
                            <td>
                                <ul class="list-group list-group-horizontal">
                                    <li class="list-group-item">
                                        <form method="post" action="{{route('relatives.destroy', $relative->id)}}">
                                            @method('delete')
                                            @csrf
                                            <button type="submit" class=" btn btn-danger"><i class="fa fa-trash"></i></button>
                                        </form>
                                    </li>
                                    <li class="list-group-item"><a href="{{ route('clients.edit', $client->id) }}" class="btn btn-primary"><i class="fa fa-edit"></i></a></li>
                                </ul>
                            </td>
                        </tr>
                        @endforeach 
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="10">
                                {{-- {{ $relatives->links() }}                  --}}
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>