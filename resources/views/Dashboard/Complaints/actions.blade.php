<ul class="list-group list-group-horizontal">
    <li class="list-group-item">
        <form method="post" action="{{route('complaints.destroy', $model->id)}}">
            @csrf
            @method('delete')
            <button name="delete" type="submit" class=" btn btn-danger"><i class="fa fa-trash"></i></button>
        </form>
    </li>
    <li class="list-group-item"><a href="{{ route('complaint.replies', $model->id) }}" class="has-data btn btn-primary"><i class="fa fa-users"></i></a></li>
    <li class="list-group-item">
        <div class="col-md-12">
            <div class="form-check form-switch">
                <input id="is_active" name="is_active" data-href="{{ route('complaints.status', $model->id) }}" class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" {{ $model->getRawOriginal('is_active') ? "checked":"" }}>
            </div>
        </div>
    </li>
</ul>