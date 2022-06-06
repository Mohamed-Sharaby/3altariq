<button class="btn btn-primary waves-effect waves-light" data-toggle="modal"
        data-target="#{{$provider->id}}"> عرض الصور
</button>


<div id="{{$provider->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">صور اضافية لمقدم الخدمة : {{$provider->name}}</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                        @foreach($provider->getMedia('photos') as $photo)
                        <div class="col-md-4">
                            <a data-fancybox="gallery" href="{{$photo->getUrl()}}">
                                <img src="{{$photo->getUrl()}}" width="100" height="100"
                                     class="img-thumbnail">
                            </a>
                        </div>
                        @endforeach
                </div>
            </div>
            <div class="modal-footer text-right">
                <button type="button" class="btn btn-block text-danger font-bold waves-effect" data-dismiss="modal">اغلاق</button>
            </div>
        </div>
    </div>
</div><!-- /.modal -->
