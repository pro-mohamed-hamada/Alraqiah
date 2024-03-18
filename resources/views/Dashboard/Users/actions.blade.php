<ul class="list-group list-group-horizontal">
    <li class="list-group-item">
        <form method="post" action="{{route('users.destroy', $model->id)}}">
            @csrf
            @method('delete')
            <button name="delete" type="submit" class=" btn btn-danger"><i class="fa fa-trash"></i></button>
        </form>
    </li>
    <li class="list-group-item"><a href="{{ route('users.edit', $model->id) }}" class="btn btn-primary"><i class="fa fa-edit"></i></a></li>
    <li class="list-group-item"><a href="{{ route('supervisor.clients', $model->id) }}" class="has-data btn btn-primary"><i class="fa fa-users"></i></a></li>
</ul>