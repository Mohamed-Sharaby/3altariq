<td>
    <a href="{{url(route('admin.orders.show',$model->id))}}"
       class="btn-icon waves-effect btn btn-primary btn-sm ">التفاصيل</a>
</td>

<td>
    <button data-url="{{route('admin.orders.destroy',$model->id)}}"
            class="btn-icon waves-effect btn btn-danger rounded-circle btn-sm   delete" title="حذف">
        <i class="fa fa-trash"></i>
    </button>
</td>
