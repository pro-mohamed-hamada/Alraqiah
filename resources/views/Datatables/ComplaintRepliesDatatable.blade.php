<div class="mb-3">
    <div class="card">
        <div class="card-header">{{ __('lang.replies') }}</div>

        <div class="card-body">
            
           

            <div class="datatable table-responsive">
                <table class="table text-center table-bordered table-hover">
                    <thead>
                        <th>{{ __('lang.id') }}</th>
                        <th>{{ __('lang.replay') }}</th>
                        <th>{{ __('lang.sender') }}</th>
                        <th>{{ __('lang.created_at') }}</th>
                        
                    </thead>
                    <tbody>
                        @foreach ($complaint->replies as $replay)
                        <tr>
                            <td>{{ $replay->id }}</td>
                            <td>{{ $replay->replay }}</td>
                            <td>{{ $replay->sender->name }}</td>
                            <td>{{ $replay->created_at }}</td>
                        </tr>
                        @endforeach 
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="10">
                                <form method="post" action="{{ route('complaint-replies.store') }}">
                                    @csrf
                                    <input type="hidden" name="complaint_id" value="{{ $complaint->id }}">
                                    <div class="row mb-3 g-3">
                                        <div class="col-lg-12">
                                            <textarea name="replay" class="form-control" placeholder="{{ __('lang.replay') }}"></textarea>
                                            @error('replay')
                                                <span class="error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-3 g-3">
                                        <div class="">
                                            <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> {{__('lang.replay')}}</button>
                                        </div>
                                    </div>
                                </form>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>