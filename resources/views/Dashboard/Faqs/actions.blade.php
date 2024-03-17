<ul class="list-group list-group-horizontal">
    <li class="list-group-item">
        <form method="post" action="{{route('faqs.destroy', $model->id)}}">
            @csrf
            @method('delete')
            <button name="delete" type="submit" class=" btn btn-danger"><i class="fa fa-trash"></i></button>
        </form>
    </li>
    <li class="list-group-item"><a href="{{ route('faqs.edit', $model->id) }}" class="btn btn-primary"><i class="fa fa-edit"></i></a></li>
    <li class="list-group-item"><a href="{{ route('faqs.show', $model->id) }}" class="btn btn-primary"><i class="fa fa-eye"></i></a></li>
</ul>