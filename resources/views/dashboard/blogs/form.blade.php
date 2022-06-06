<div class="form-group row">
    <label class="col-md-2 control-label">الاسم بالعربية</label>
    <div class="col-md-4">
        {!! Form::text('ar_description',null,[
                        'class' =>'form-control '.($errors->has('ar_description') ? ' is-invalid' : null),
                        'placeholder'=> 'الاسم بالعربية' ,
                        ]) !!}
        @error('ar_description')
        <div class="invalid-feedback" style="color: #ef1010">
            {{ $message }}
        </div>
        @enderror
    </div>

    <label class="col-md-2 control-label">الاسم بالانجليزية</label>
    <div class="col-md-4">
        {!! Form::text('en_description',null,[
                         'class' =>'form-control '.($errors->has('en_description') ? ' is-invalid' : null),
                         'placeholder'=> 'الاسم بالانجليزية' ,
                         ]) !!}
        @error('en_description')
        <div class="invalid-feedback" style="color: #ef1010">
            {{ $message }}
        </div>
        @enderror
    </div>

</div>

<div class="form-group row">
    <label class="col-md-2 control-label">الرابط</label>
    <div class="col-md-4">
        {!! Form::url('url',null,[
                        'class' =>'form-control '.($errors->has('url') ? ' is-invalid' : null),
                        'placeholder'=> 'الرابط ' ,
                        ]) !!}
        @error('url')
        <div class="invalid-feedback" style="color: #ef1010">
            {{ $message }}
        </div>
        @enderror
    </div>


</div>
{{--<div class="form-group row">--}}
{{--    <label class="col-md-2 control-label">--}}
{{--        الوصف بالعربية</label>--}}
{{--    <div class="col-md-4">--}}
{{--        {!! Form::textarea('ar_description',null,['cols'=> '30','rows'=>3,--}}
{{--    'class' =>'form-control '.($errors->has('ar_description') ? ' is-invalid' : null),--}}
{{--    'placeholder'=> 'الوصف بالعربية  ' ,--}}
{{--    ]) !!}--}}
{{--        @error('ar_description')--}}
{{--        <div class="invalid-feedback" style="color: #ef1010">--}}
{{--            {{ $message }}--}}
{{--        </div>--}}
{{--        @enderror--}}
{{--    </div>--}}

{{--    <label class="col-md-2 control-label">--}}
{{--        الوصف بالانجليزية</label>--}}
{{--    <div class="col-md-4">--}}
{{--        {!! Form::textarea('en_description',null,['cols'=> '30','rows'=>3,--}}
{{--'class' =>'form-control '.($errors->has('en_description') ? ' is-invalid' : null),--}}
{{--'placeholder'=> 'الوصف بالانجليزية  ' ,--}}
{{--]) !!}--}}
{{--        @error('en_description')--}}
{{--        <div class="invalid-feedback" style="color: #ef1010">--}}
{{--            {{ $message }}--}}
{{--        </div>--}}
{{--        @enderror--}}
{{--    </div>--}}
{{--</div>--}}
{{--<div class="form-group row">--}}
{{--    <label class="col-sm-2 control-label">الصورة </label>--}}
{{--    <div class="col-sm-4">--}}
{{--        {!! Form::file('image',[ 'class' =>'form-control '.($errors->has('image') ? ' is-invalid' : null) ]) !!}--}}
{{--        @error('image')--}}
{{--        <div class="invalid-feedback" style="color: #ef1010">--}}
{{--            {{ $message }}--}}
{{--        </div>--}}
{{--        @enderror--}}
{{--    </div>--}}
{{--    @isset($blog)--}}
{{--        @if($blog->image)--}}
{{--            <a data-fancybox="gallery" href="{{getImgPath($blog->image)}}">--}}
{{--                <img src="{{getImgPath($blog->image)}}" width="100" height="100"--}}
{{--                     class="img-thumbnail">--}}
{{--            </a>--}}
{{--        @else لا يوجد صورة @endif--}}
{{--    @endisset--}}
{{--</div>--}}

<div class="text-center form-group row">
    <button type="submit"
            class="btn btn-success btn-block waves-effect waves-light m-l-10 btn-md">
        حفظ
    </button>
</div>
