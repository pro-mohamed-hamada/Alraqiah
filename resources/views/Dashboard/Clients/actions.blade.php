<ul class="list-group list-group-horizontal">
    <li class="list-group-item">
        <form method="post" action="{{route('clients.destroy', $model->id)}}">
            @csrf
            @method('delete')
            <button name="delete" type="submit" class=" btn btn-danger"><i class="fa fa-trash"></i></button>
        </form>
    </li>
    <li class="list-group-item"><a href="{{ route('clients.edit', $model->id) }}" class="btn btn-primary"><i class="fa fa-edit"></i></a></li>
    <li class="list-group-item"><a href="{{ route('clients.show', $model->id) }}" class="btn btn-primary"><i class="fa fa-eye"></i></a></li>
    <li class="list-group-item"><a href="{{ route('client.relatives', $model->id) }}" class="has-data btn btn-primary"><i class="fa fa-users"></i></a></li>
</ul>

{{-- <div class="btn-group">
    <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
        {{ __('lang.actions') }}
    </button>
    <ul class="dropdown-menu">
        @can('import_client')
        <li><a name="delete" role="button" class="dropdown-item" href="{{route('clients.destroy', $model->id)}}"><i class="text-danger fa fa-trash fa-2x"></i> {{__('lang.delete')}}</a></li>
        <li><a role="button" class="dropdown-item" href="{{ route('clients.edit', $model->id) }}"><i class="fa fa-edit"></i> {{__('lang.edit')}}</a></li>
        <li><a role="button" class="dropdown-item" href="{{ route('clients.show', $model->id) }}"><i class="fa fa-eye"></i> {{__('lang.show')}}</a></li>
        <li><a role="button" class="dropdown-item has-data" href="{{ route('client.relatives', $model->id) }}"><i class="fa fa-users"></i> {{__('lang.relatives')}}</a></li>
        @endif
    </ul>
</div> --}}
