<div class="mb-3">
    <div class="card">
        <div class="card-header">{{ __('lang.fcmMessages') }}</div>

        <div class="card-body">
            <div class="">
                <h5><a role="button" class="btn btn-primary " href="{{route('fcm-messages.create')}}"><i class="fa fa-plus-circle"></i> {{__('lang.create_fcm_message')}}</a></h5>
            </div>
            <div class="search-box">
                <div class="row mb-3 g-3">
                    <form class="col-sm-2" name="per_page_form" method="post" action="{{ route('fcm-messages.index') }}">
                        @method('get')
                        <div>
                            <select name="per_page" class="form-control">
                                <option value="25" {{ Request()->get('per_page') == "25"? "selected":"" }}>25</option>
                                <option value="50" {{ Request()->get('per_page') == "50"? "selected":"" }}>50</option>
                                <option value="100" {{ Request()->get('per_page') == "100"? "selected":"" }}>100</option>
                            </select>
                        </div>
                    </form>
                    
                    <div class="col-sm-7 col-lg-10">
                        <input name="searchTxt" type="text" class="form-control" placeholder="{{__('lang.search')}}">
                    </div>
                </div>
            </div>

            <div class="datatable table-responsive">
                
                <table class="fcmMessagesTable  table text-center table-bordered  table-hover">
                    <thead>
                        <th>{{ __('lang.id') }}</th>
                        <th>{{ __('lang.title') }}</th>
                        <th>{{ __('lang.content') }}</th>
                        <th>{{ __('lang.fcm_action') }}</th>
                        <th>{{ __('lang.notification_via') }}</th>
                        <th>{{ __('lang.is_active') }}</th>
                        <th>{{ __('lang.actions') }}</th>
                        
                    </thead>
                    <tbody>
                        @foreach ($fcmMessages as $fcmMessage)
                        <tr>
                            <td>{{ $fcmMessage->id }}</td>
                            <td>{{ $fcmMessage->title }}</td>
                            <td>{{ $fcmMessage->content }}</td>
                            <td>{{ $fcmMessage->fcm_action }}</td>
                            <td>{{ $fcmMessage->notification_via }}</td>
                            <td>{{ $fcmMessage->is_active }}</td>
                            <td>
                                
                                <ul class="list-group list-group-horizontal">
                                    <li class="list-group-item">
                                        <form method="post" action="{{route('fcm-messages.destroy', $fcmMessage->id)}}">
                                            @csrf
                                            @method('delete')
                                            <button name="delete" type="submit" class=" btn btn-danger"><i class="fa fa-trash"></i></button>
                                        </form>
                                    </li>
                                    <li class="list-group-item"><a href="{{ route('fcm-messages.edit', $fcmMessage->id) }}" class="btn btn-primary"><i class="fa fa-edit"></i></a></li>
                                </ul>
                            </td>
                        </tr>
                        <tr class=" displayView">
                            <td colspan="10">
                                <div class="displayViewContent">
                                    {{-- @include('Datatables.FcmMessageVisitsDatatable') --}}
                                </div>
                                <button class="close btn btn-danger">X</button>     
                            </td>
                        </tr>
                        @endforeach 
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="10">
                                {{-- {{ $fcmMessages->links() }}                  --}}
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            
        </div>
    </div>
</div>
