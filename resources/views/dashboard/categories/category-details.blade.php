<button class="btn btn-primary waves-effect waves-light" data-toggle="modal"
        data-target="#item{{$category->id}}">التفاصيل
</button>
<!--  Modal content for the above example -->
<div class="modal fade bs-example-modal-lg" id="item{{$category->id}}"
     tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
     aria-hidden="true" style="display: none;">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"
                        aria-hidden="true">×
                </button>
                <h4 class="modal-title" id="myLargeModalLabel">
                    تفاصيل {{$category->name}}</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12 ">
                        <table class="table table-bordered table-responsive table-striped">

                            <tr>
                                <th> الاسم بالعربية </th>
                                <td>  {{$category->ar_name}} </td>
                            </tr>
                            <tr>
                                <th> الاسم بالانجليزية </th>
                                <td>  {{$category->en_name}} </td>
                            </tr>
                            <tr>
                                <th> الوصف بالعربية  </th>
                                <td>  {{$category->ar_description}} </td>
                            </tr>

                            <tr>
                                <th> الوصف بالانجليزية  </th>
                                <td>  {{$category->en_description}} </td>
                            </tr>

                            <tr>
                                <th>   ترتيب الظهور  </th>
                                <td> {{$category->sort_number}}</td>
                            </tr>
                            <tr>
                                <th>   عدد الخدمات   </th>
                                <td> {{count($category->services)}}</td>
                            </tr>

                        </table>
                    </div>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
