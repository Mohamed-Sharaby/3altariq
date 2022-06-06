<button class="btn btn-primary waves-effect waves-light" data-toggle="modal"
        data-target="#item{{$banner->id}}">التفاصيل
</button>
<!--  Modal content for the above example -->
<div class="modal fade bs-example-modal-lg" id="item{{$banner->id}}"
     tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
     aria-hidden="true" style="display: none;">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"
                        aria-hidden="true">×
                </button>
                <h4 class="modal-title" id="myLargeModalLabel">
                    تفاصيل {{$banner->name}}</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12 ">
                        <table class="table table-bordered table-responsive table-striped">

                            <tr>
                                <th> الاسم بالعربية </th>
                                <td>  {{$banner->ar_name}} </td>
                            </tr>
                            <tr>
                                <th> الاسم بالانجليزية </th>
                                <td>  {{$banner->en_name}} </td>
                            </tr>

                            <tr>
                                <th> نوع البانر  </th>
                                <td>  {{$banner->type == 'normal'?'عادية':'اسبلاش'}} </td>
                            </tr>

                            <tr>
                                <th> نوع الجهاز  </th>
                                <td>  {{$banner->device_type}} </td>
                            </tr>

                            <tr>
                                <th> المدينة   </th>
                                <td>  {{$banner->country->name ?? ''}} </td>
                            </tr>

                            <tr>
                                <th> الرابط   </th>
                                <td>
                                    <a href="{{$banner->url}}">{{$banner->url}}</a>
                                </td>
                            </tr>

                        </table>
                    </div>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
