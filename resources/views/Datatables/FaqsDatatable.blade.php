<div class="mb-3">
    <div class="card">
        <div class="card-header">{{ __('lang.faqs') }}</div>

        <div class="card-body">
            <div class="">
                @can('create_faq')
                <h5><a role="button" class="btn btn-primary " href="{{route('faqs.create')}}"><i class="fa fa-plus"></i> {{__('lang.create_faq')}}</a></h5>
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
                
                <table class="faqsTable  table text-center table-bordered  table-hover">
                    <thead>
                        <th>{{ __('lang.id') }}</th>
                        <th>{{ __('lang.question') }}</th>
                        <th>{{ __('lang.answer') }}</th>
                        <th>{{ __('lang.is_active') }}</th>
                        <th>{{ __('lang.actions') }}</th>
                        
                    </thead>
                    <tbody>
                        @foreach ($faqs as $faq)
                        <tr>
                            <td>{{ $faq->id }}</td>
                            <td>{{ $faq->question }}</td>
                            <td>{{ $faq->answer }}</td>
                            <td>{{ $faq->is_active }}</td>
                            <td>
                                
                                <ul class="list-group list-group-horizontal">
                                    <li class="list-group-item">
                                        <form method="post" action="{{route('faqs.destroy', $faq->id)}}">
                                            @csrf
                                            @method('delete')
                                            <button name="delete" type="submit" class=" btn btn-danger"><i class="fa fa-trash"></i></button>
                                        </form>
                                    </li>
                                    <li class="list-group-item"><a href="{{ route('faqs.edit', $faq->id) }}" class="btn btn-primary"><i class="fa fa-edit"></i></a></li>
                                    <li class="list-group-item"><a href="{{ route('faqs.show', $faq->id) }}" class="btn btn-primary"><i class="fa fa-eye"></i></a></li>
                                </ul>
                            </td>
                        </tr>
                        <tr class=" displayView">
                            <td colspan="10">
                                <div class="displayViewContent">
                                    {{-- @include('Datatables.ClientVisitsDatatable') --}}
                                </div>
                                <button class="close btn btn-danger">X</button>     
                            </td>
                        </tr>
                        @endforeach 
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="10">
                                {{-- {{ $faqs->links() }}                  --}}
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            
        </div>
    </div>
</div>
