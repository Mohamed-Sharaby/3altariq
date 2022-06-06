<div class="form-group row">
    <label class="col-md-2 control-label">الاسم بالعربية</label>
    <div class="col-md-4">
        {!! Form::text('ar_name',null,[
                             'class' =>'form-control '.($errors->has('ar_name') ? ' is-invalid' : null),
                             'placeholder'=> 'الاسم بالعربية' ,
                             ]) !!}
        @error('ar_name')
        <div class="invalid-feedback" style="color: #ef1010">
            {{ $message }}
        </div>
        @enderror
    </div>


    <label class="col-md-2 control-label">الاسم بالانجليزية</label>
    <div class="col-md-4">
        {!! Form::text('en_name',null,[
                      'class' =>'form-control '.($errors->has('en_name') ? ' is-invalid' : null),
                      'placeholder'=> 'الاسم بالانجليزية' ,
                      ]) !!}
        @error('en_name')
        <div class="invalid-feedback" style="color: #ef1010">
            {{ $message }}
        </div>
        @enderror
    </div>
</div>

<div class="form-group row">
    <label class="col-md-2 control-label">
        نوع البانر</label>
    <div class="col-md-4">
        {!! Form::select('type',banners_type(),null,['class' =>'form-control '.($errors->has('type') ? ' is-invalid' : null)
, 'placeholder'=>  'نوع البانر' ]) !!}
        @error('type')
        <div class="invalid-feedback" style="color: #ef1010">
            {{ $message }}
        </div>
        @enderror
    </div>

    <label class="col-md-2 control-label">
        نوع الجهاز</label>
    <div class="col-md-4">
        {!! Form::select('device_type',device_type(),null,['class' =>'form-control '.($errors->has('device_type') ? ' is-invalid' : null)
, 'placeholder'=>  'نوع الجهاز' ]) !!}
        @error('device_type')
        <div class="invalid-feedback" style="color: #ef1010">
            {{ $message }}
        </div>
        @enderror
    </div>
</div>

<div class="form-group row">
    <label class="col-md-1 control-label">المدينة</label>
    <div class="col-md-3">
        {!! Form::select('country_id',$countries,null,['class' =>'form-control '.($errors->has('country_id') ? ' is-invalid' : null)
, 'placeholder'=>  'المدينة' ]) !!}
        @error('country_id')
        <div class="invalid-feedback" style="color: #ef1010">
            {{ $message }}
        </div>
        @enderror
    </div>

    <label class="col-md-1 control-label">الرابط </label>
    <div class="col-md-3">
        {!! Form::text('url',null,[
                    'class' =>'form-control '.($errors->has('url') ? ' is-invalid' : null),
                    'placeholder'=> 'الرابط'
                    ]) !!}
        @error('url')
        <div class="invalid-feedback" style="color: #ef1010">
            {{ $message }}
        </div>
        @enderror

    </div>
    <label class="col-md-1 control-label">نوع الرابط </label>
    <div class="col-md-3">
        {!! Form::select('url_type',arrayToSelect(['facebook','instagram','twitter','whatsapp','website']),null,['class' =>'form-control '.($errors->has('url_type') ? ' is-invalid' : null)
, 'placeholder'=>  'نوع الرابط' ]) !!}

        @error('url_type')
        <div class="invalid-feedback" style="color: #ef1010">
            {{ $message }}
        </div>
        @enderror

    </div>
</div>

<div class="form-group row">
    <label class="col-sm-2 control-label">الصورة </label>
    <div class="col-sm-4">
        {!! Form::file('image',[ 'class' =>'form-control '.($errors->has('image') ? ' is-invalid' : null) ]) !!}
        @error('image')
        <div class="invalid-feedback" style="color: #ef1010">
            {{ $message }}
        </div>
        @enderror
    </div>
    @isset($banner)
        @if($banner->image)
            <a data-fancybox="gallery" href="{{$banner->image}}">
                <img src="{{$banner->image}}" width="100" height="100"
                     class="img-thumbnail">
            </a>
        @else لا يوجد صورة @endif
    @endisset
</div>

<div class="text-center form-group row">
    <button type="submit"
            class="btn btn-success btn-block waves-effect waves-light m-l-10 btn-md">
        حفظ
    </button>
</div>
