<button class="btn btn-primary waves-effect waves-light" data-toggle="modal"
        data-target="#{{$verify->id}}"> عرض الصور
</button>


<div id="{{$verify->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">صور       : {{$verify->provider->name}}</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12 ">
                        <table class="table table-bordered table-responsive table-striped">
                            <tr>
                                <th> الصورة  </th>
                                <td>
                                    @if($verify->image)
                                        <a data-fancybox="gallery" href="{{$verify->image}}">
                                            <img src="{{$verify->image}}" width="70" height="70"
                                                 class="img-thumbnail" alt="provider_img">
                                        </a>
                                    @else {{__('No Image')}} @endif
                                </td>
                            </tr>
                            <tr>
                                <th>بطاقة الضمان الاجتماعى</th>
                                <td>
                                    @if($verify->ssn_image)
                                        <a data-fancybox="gallery" href="{{$verify->ssn_image}}">
                                            <img src="{{$verify->ssn_image}}" width="70" height="70"
                                                 class="img-thumbnail" alt="provider_img">
                                        </a>
                                    @else {{__('No Image')}} @endif
                                </td>
                            </tr>

                            <tr>
                                <th>صورة الرخصة </th>
                                <td>
                                    @if($verify->licence_image)
                                        <a data-fancybox="gallery" href="{{$verify->licence_image}}">
                                            <img src="{{$verify->licence_image}}" width="70" height="70"
                                                 class="img-thumbnail" alt="provider_img">
                                        </a>
                                    @else {{__('No Image')}} @endif
                                </td>
                            </tr>

                            <tr>
                                <th>صورة السيارة</th>
                                <td>
                                    @if($verify->car_image)
                                        <a data-fancybox="gallery" href="{{$verify->car_image}}">
                                            <img src="{{$verify->car_image}}" width="70" height="70"
                                                 class="img-thumbnail" alt="provider_img">
                                        </a>
                                    @else {{__('No Image')}} @endif
                                </td>
                            </tr>

                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer text-right">
                <button type="button" class="btn btn-block text-danger font-bold waves-effect" data-dismiss="modal">اغلاق</button>
            </div>
        </div>
    </div>
</div><!-- /.modal -->
