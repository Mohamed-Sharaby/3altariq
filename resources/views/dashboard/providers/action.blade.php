    <form
        action="{{ route('admin.active', ['id' => $id, 'type' => 'Provider']) }}"
        style="display: inline;"
        method="post">@csrf
        <button type="submit"
                class="btn-icon waves-effect {{ $is_active ? 'btn btn-sm btn-success' : 'btn btn-sm btn-warning' }}">{{ $is_active ? 'مفعل ' : ' معطل' }}</button>
    </form>

    <a href="{{url(route('admin.providers.edit',$id))}}"
       class="btn-icon waves-effect btn btn-primary btn-sm ml-2 rounded-circle"><i
            class="fa fa-edit"></i></a>
    <a href="{{url(route('admin.providers.show',$id))}}"
       class="btn-icon waves-effect btn btn-default btn-sm ml-2 rounded-circle"><i
            class="fa fa-eye"></i></a>


    <button data-url="{{route('admin.providers.destroy',$id)}}"
            class="btn-icon waves-effect btn btn-danger rounded-circle btn-sm ml-2 delete"
            title="Delete">
        <i class="fa fa-trash"></i>
    </button>


    <form
        action="{{ route('admin.reviewed', ['id' => $id]) }}"
        style="display: inline;"
        method="post">@csrf
        <button type="submit"
                class="btn-icon waves-effect {{ $is_reviewed ? 'btn btn-sm btn-success' : 'btn btn-sm btn-warning' }}">{{ $is_reviewed ? 'تم مراجعته ' : ' لم يتم مراجعته' }}</button>
    </form>


