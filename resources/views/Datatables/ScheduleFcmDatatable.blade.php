<div class="mb-3">
    <div class="card">
        <div class="card-header">{{ __('lang.schedule_fcm') }}</div>

        <div class="card-body">
            <div class="">
                @can('create_schedule_fcm')
                <h5><a role="button" class="btn btn-primary " href="{{route('schedule-fcm.create')}}"><i class="fa fa-plus"></i> {{__('lang.create_schedule_fcm')}}</a></h5>
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
                
                <table class="fcmMessagesTable  table text-center table-bordered  table-hover">
                    <thead>
                        <th>{{ __('lang.id') }}</th>
                        <th>{{ __('lang.title') }}</th>
                        <th>{{ __('lang.content') }}</th>
                        <th>{{ __('lang.trigger') }}</th>
                        <th>{{ __('lang.notification_via') }}</th>
                        <th>{{ __('lang.is_active') }}</th>
                        <th>{{ __('lang.actions') }}</th>
                        
                    </thead>
                    <tbody>
                        @foreach ($allScheduleFcm as $scheduleFcm)
                        <tr>
                            <td>{{ $scheduleFcm->id }}</td>
                            <td>{{ $scheduleFcm->title }}</td>
                            <td>{{ $scheduleFcm->content }}</td>
                            <td>{{ $scheduleFcm->trigger }}</td>
                            <td>{{ $scheduleFcm->notification_via }}</td>
                            <td>{{ $scheduleFcm->is_active }}</td>
                            <td>
                                
                                <ul class="list-group list-group-horizontal">
                                    <li class="list-group-item">
                                        <form method="post" action="{{route('schedule-fcm.destroy', $scheduleFcm->id)}}">
                                            @csrf
                                            @method('delete')
                                            <button name="delete" type="submit" class=" btn btn-danger"><i class="fa fa-trash"></i></button>
                                        </form>
                                    </li>
                                    <li class="list-group-item"><a href="{{ route('schedule-fcm.edit', $scheduleFcm->id) }}" class="btn btn-primary"><i class="fa fa-edit"></i></a></li>
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
                                {{-- {{ $allScheduleFcm->links() }}                  --}}
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            
        </div>
    </div>
</div>
