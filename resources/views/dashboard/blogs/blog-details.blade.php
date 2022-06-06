<button class="btn btn-primary waves-effect waves-light" data-toggle="modal"
        data-target="#item{{$blog->id}}">التفاصيل
</button>
<!--  Modal content for the above example -->
<div class="modal fade bs-example-modal-lg" id="item{{$blog->id}}"
     tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
     aria-hidden="true" style="display: none;">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"
                        aria-hidden="true">×
                </button>
                <h4 class="modal-title" id="myLargeModalLabel">
                    تفاصيل الخبر {{$blog->name}}</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <p class="text-white bg-info">الاسم بالعربية</p>
                        <p style="white-space: pre-line;overflow-wrap: break-word;text-overflow: ellipsis;">{{$blog->ar_name}} </p>
                    </div> <div class="col-12">
                        <p class="text-white bg-info">الاسم بالانجليزية</p>
                        <p style="white-space: pre-line;overflow-wrap: break-word;text-overflow: ellipsis;">{{$blog->en_name}} </p>
                    </div> <div class="col-12">
                        <p class="text-white bg-info">التفاصيل بالعربية</p>
                        <p style="white-space: pre-line;overflow-wrap: break-word;text-overflow: ellipsis;">{{$blog->ar_description}} </p>
                    </div> <div class="col-12">
                        <p class="text-white bg-info">التفاصيل بالانجليزية</p>
                        <p style="white-space: pre-line;overflow-wrap: break-word;text-overflow: ellipsis;">{{$blog->en_description}} </p>
                    </div>
                </div>
            </div>


        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
