@extends('dashboard.layouts.layout')
@section('title','ارسال اشعارات لمقدمى الخدمة')

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">

                <div class="breadcrumb">
                    <a href="{{route('admin.main')}}" class="header-title m-t-0 m-b-30"><i class="icon-home2 mr-2"></i>
                        الرئيسية</a> /

                    <span class="breadcrumb-item active">@yield('title')</span>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box  ">
                            @include('dashboard.layouts.status')
                            <h4 class="header-title m-t-0 m-b-30"> ارسال اشعارات لمقدمى الخدمة  الرصيد المتبقي هو : {{$balance}}
                            ||
                                عدد الرسائل المرسلة هو : {{$counter}}
                            </h4>

                            <form class="form-horizontal" role="form" method="post" enctype="multipart/form-data"
                                  action="{{route('admin.providers-notifications.store')}}">
                                @csrf

                                <div class="form-group row">
                                    <div class="col-12 col-md-4">
                                        <label class="col-form-label"> فلتر بالمدينة</label>
                                        {!! Form::select('country',$countries,null,['class' =>'form-control '.($errors->has('country') ? ' is-invalid' : null)
                                            , 'placeholder'=>  'اختر المدينة' ]) !!}
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <label class="col-form-label"> فلتر بالقسم</label>
                                        {!! Form::select('category',$categories,null,['class' =>'form-control '.($errors->has('category') ? ' is-invalid' : null)
                                            , 'placeholder'=>  'اختر القسم' ]) !!}
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <label class="col-form-label"> فلتر بالخدمة</label>
                                        {!! Form::select('service',$services,null,['class' =>'form-control '.($errors->has('service') ? ' is-invalid' : null)
                                            , 'placeholder'=>  'اختر الخدمة' ]) !!}
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label for="providers" class="control-label col-md-2">مقدمين الخدمة </label>
                                    <div class="col-12 col-lg-10">
                                        {!! Form::select('providers[]',$providers,null,['class' =>'form-control js-example-basic-multiple select2'.($errors->has('providers') ? ' is-invalid' : null)
                                           ,'multiple' ]) !!}

                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label class="col-md-2 control-label">عنوان الاشعار</label>
                                    <div class="col-md-10">
                                        {!! Form::text('title',null,[
                                            'class' =>'form-control '.($errors->has('title') ? ' is-invalid' : null),
                                            'placeholder'=> 'عنوان الاشعار'
                                            ]) !!}
                                        @error('title')
                                        <div class="invalid-feedback" style="color: #ef1010">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-2 control-label">محتوى الاشعار </label>
                                    <div class="col-md-10">
                                        {!! Form::textarea('body',null,['cols'=> '30','rows'=>3,
                                           'class' =>'form-control '.($errors->has('body') ? ' is-invalid' : null),
                                           'placeholder'=> 'محتوى الاشعار' ,
                                           ]) !!}
                                        @error('body')
                                        <div class="invalid-feedback" style="color: #ef1010">
                                            {{ $message }}
                                        </div>
                                        @enderror </div>


                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 control-label">ارسال sms </label>
                                    <div class="col-md-10">
                                        {!! Form::checkbox('sms') !!}
                                        @error('sms')
                                        <div class="invalid-feedback" style="color: #ef1010">
                                            {{ $message }}
                                        </div>
                                        @enderror </div>


                                </div>

                                <div class="text-center form-group row">
                                    <button type="submit"
                                            class="btn btn-success btn-block waves-effect waves-light m-l-10 btn-md">
                                        حفظ
                                    </button>
                                </div>

                            </form>
                        </div>
                    </div><!-- end col -->
                </div>
            </div>
        </div><!-- end col -->
    </div>

@endsection
@push('my-js')
    <script>
        $(document).ready(function () {
            $('.select2').select2()
        });

    </script>
@endpush
