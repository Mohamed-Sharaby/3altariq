<div class="row">
    <div class="col-md-6">
        <div class="form-group ">
            <label class="col-md-2 control-label">الاسم بالعربية</label>
            <div class="col-md-10">
                {!! Form::text('ar_name',null,[ 'class' =>'form-control '.($errors->has('ar_name') ? ' is-invalid' : null),
                    'placeholder'=> 'الاسم بالعربية']) !!}
                @error('ar_name')
                <div class="invalid-feedback" style="color: #ef1010">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group ">
            <label class="col-md-2 control-label">الاسم بالانجليزية</label>
            <div class="col-md-10">
                {!! Form::text('en_name',null,['class' =>'form-control '.($errors->has('en_name') ? ' is-invalid' : null),
                    'placeholder'=> 'الاسم بالانجليزية' ]) !!}
                @error('en_name')
                <div class="invalid-feedback" style="color: #ef1010">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>
    </div>
    <div class="col-md-6">

        <div class="form-group ">
            <label class="col-md-2 control-label">تنتمي إلي</label>
            <div class="col-md-10">
                {!! Form::select('parent_id',$parents,null,['id'=>'parent_id','placeholder'=>'اختار','class'=>'form-control']) !!}
                <small class="text-primary font-bold">حقل اختيارى</small>
                @error('parent_id')
                <div class="invalid-feedback" style="color: #ef1010">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>
    </div>

{{--    @if($country->parent==null)--}}
        <div class="col-md-6">
            <div class="form-group ">
                <label class="col-md-2 control-label">كود الدولة</label>
                <div class="col-md-10">
                    {!! Form::text('country_code',null,['class' =>'form-control '.($errors->has('country_code') ? ' is-invalid' : null),
                    'placeholder'=> 'كود الدولة' ]) !!}
{{--                    <small class="text-primary font-bold">حقل اختيارى</small>--}}
                    @error('country_code')
                    <div class="invalid-feedback" style="color: #ef1010">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
        </div>
{{--    @endif--}}

</div>
<div class="text-center form-group row">
    <button type="submit"
            class="btn btn-success btn-block waves-effect waves-light m-l-10 btn-md">
        حفظ
    </button>
</div>
