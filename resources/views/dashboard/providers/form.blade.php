<div class="form-group row">
    <label class="col-md-2 control-label">الاسم</label>
    <div class="col-md-4">
        {!! Form::text('name',null,[
                       'class' =>'form-control '.($errors->has('name') ? ' is-invalid' : null),
                       'placeholder'=> 'الاسم'
                       ]) !!}
        @error('name')
        <div class="invalid-feedback" style="color: #ef1010">
            {{ $message }}
        </div>
        @enderror
    </div>

    <label class="col-md-2 control-label" for="example-email">رقم الجوال
    </label>
    <div class="col-md-4">
        {!! Form::text('phone',null,[
                       'class' =>'form-control '.($errors->has('phone') ? ' is-invalid' : null),
                       'placeholder'=> 'الجوال' ,
                       ]) !!}
        @error('phone')
        <div class="invalid-feedback" style="color: #ef1010">
            {{ $message }}
        </div>
        @enderror
    </div>
</div>

<div class="form-group row">
    <label class="col-md-2 control-label">كلمة المرور</label>
    <div class="col-md-4">
        {!! Form::password('password',[
                  'class' =>'form-control '.($errors->has('password') ? ' is-invalid' : null),
                  'placeholder'=> 'كلمة المرور' ,
                  ]) !!}
        @error('password')
        <div class="invalid-feedback" style="color: #ef1010">
            {{ $message }}
        </div>
        @enderror </div>

    <label class="col-md-2 control-label">تأكيد كلمة المرور</label>
    <div class="col-md-4">
        {!! Form::password('password_confirmation',[
                      'class' =>'form-control '.($errors->has('password_confirmation') ? ' is-invalid' : null),
                      'placeholder'=>  'تأكيد كلمة المرور' ,
                      ]) !!}
    </div>
</div>
<div class="form-group row">
    <label class="col-md-2 control-label">المدينة</label>
    <div class="col-md-4">
        {!! Form::select('country_id',$countries,null,['class' =>'form-control '.($errors->has('service_id') ? ' is-invalid' : null)
 , 'placeholder'=>  'اختر المدينة' ]) !!}
        @error('country_id')
        <div class="invalid-feedback" style="color: #ef1010">
            {{ $message }}
        </div>
        @enderror
    </div>

    <label class="col-md-2 control-label">الخدمات</label>
    <div class="col-md-4">

        {!! Form::select('service_id',$services,null,['class' =>'form-control '.($errors->has('service_id') ? ' is-invalid' : null)
, 'placeholder'=>  'اختر الخدمة' ]) !!}
        @error('service_id')
        <div class="invalid-feedback" style="color: #ef1010">
            {{ $message }}
        </div>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label class="col-md-2 control-label">العنوان </label>
    <div class="col-md-4">
        {!! Form::text('address',null,[
                      'class' =>'form-control '.($errors->has('address') ? ' is-invalid' : null),
                      'placeholder'=>  'العنوان' ,
                      ]) !!}
        @error('address')
        <div class="invalid-feedback" style="color: #ef1010">
            {{ $message }}
        </div>
        @enderror
    </div>

    <label class="col-md-2 control-label">الموقع</label>
    <div class="col-md-4">
        {!! Form::select('location',location(),null,['class' =>'form-control '.($errors->has('location') ? ' is-invalid' : null)
, 'placeholder'=>  'الموقع' ]) !!}
        @error('location')
        <div class="invalid-feedback" style="color: #ef1010">
            {{ $message }}
        </div>
        @enderror
    </div>

</div>


<div class="form-group row">
    <label class="col-sm-2 control-label">تاريخ الانتهاء </label>
    <div class="col-sm-4">
        {!! Form::date('expire_at',$provider->expire_at ?? null,[
                'class' =>'form-control '.($errors->has('expire_at') ? ' is-invalid' : null)]) !!}
        @error('expire_at')
        <div class="invalid-feedback" style="color: #ef1010">
            {{ $message }}
        </div>
        @enderror
    </div>

</div>

<div class="form-group row">
    <label class="col-sm-2 control-label">الصورة </label>
    <div class="col-sm-4">
        {!! Form::file('image',['class' =>'form-control '.($errors->has('image') ? ' is-invalid' : null) ]) !!}
        @error('image')
        <div class="invalid-feedback" style="color: #ef1010">
            {{ $message }}
        </div>
        @enderror
    </div>
    @isset($provider)
        @if($provider->image)
            <a data-fancybox="gallery" href="{{$provider->image}}">
                <img src="{{$provider->image}}" width="100" height="100"
                     class="img-thumbnail">
            </a>
        @else لا يوجد صورة @endif
    @endisset
</div>

<div class="form-group row">
    <label class="col-sm-2 control-label">صور اضافية </label>
    <div class="col-sm-4">
        {!! Form::file('photos[]',['class' =>'form-control '.($errors->has('photos') ? ' is-invalid' : null),'multiple'=>true ]) !!}
        @error('photos')
        <div class="invalid-feedback" style="color: #ef1010">
            {{ $message }}
        </div>
        @enderror
    </div>
</div>
<div class="form-group row">
    <p class="msg alert alert-success  text-center" style="display: none;margin-bottom: 10px;">
        تم حذف الصورة بنجاح
    </p>
        @isset($provider)
            @if(count($provider->getMedia('photos')) > 0)
                @foreach($provider->getMedia('photos') as $photo)
                <div class="row photo{{$photo->id}}">
                    <div class="col-md-6 text-right">
                        <a data-fancybox="gallery" href="{{$photo->getUrl()}}">
                            <img src="{{$photo->getUrl()}}" width="100" height="100"
                                 class="img-thumbnail">
                        </a>
                    </div>
                    <div class="col-md-6 text-left">
                        <a class="btn btn-icon btn-danger del_photo btn-sm"
                           data-id="{{$photo->id}}">
                            <i class="fa fa-trash text-white"></i></a>
                    </div>
                </div>
                @endforeach
            @else لا يوجد صور @endif
        @endisset


</div>

<div class="text-center form-group row">
    <button type="submit"
            class="btn btn-success btn-block waves-effect waves-light m-l-10 btn-md">
        حفظ
    </button>
</div>

