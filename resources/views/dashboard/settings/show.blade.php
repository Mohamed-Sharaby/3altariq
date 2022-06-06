@extends('dashboard.layouts.layout')
@section('title')
    {{$page}}
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">

                <div class="breadcrumb">
                    <a href="{{route('admin.main')}}" class="header-title m-t-0 m-b-30"><i class="icon-home2 mr-2"></i>
                        الرئيسية</a> /
                    <a href="{{route('admin.settings.index')}}" class="header-title m-t-0 m-b-30"><i
                            class="icon-home2 mr-2"></i>
                        الاعدادات </a> /
                    <span class="breadcrumb-item active">@yield('title')</span>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box table-responsive">
                            @include('dashboard.layouts.status')

                            <form action="{{route('admin.settings.store')}}" method="post"
                                  enctype="multipart/form-data">
                                @csrf

                                <div class="row">
                                    @foreach($settings as $setting)
                                        <div class="row  col-12 form-group">

                                            <label for="{{$setting->title}}"
                                                   class="col-form-label font-weight-bold col-lg-2">{{__($setting->title)}}
                                            </label>

                                            @if($setting->type == 'email')
                                                <div class="col-12 col-lg-10">
                                                    <input type="email" name="{{$setting->name}}"
                                                           value="{{$setting->value}}"
                                                           placeholder="البريد الالكترونى" class="form-control">
                                                    @error($setting->name)
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            @endif

                                            @if($setting->type == 'url')
                                                <div class="col-12 col-lg-10">
                                                    <input type="url" name="{{$setting->name}}"
                                                           value="{{$setting->value}}"
                                                           placeholder="الرابط" class="form-control">
                                                    @error($setting->name)
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            @endif

                                            @if($setting->type == 'long_text')

                                                <div class="col-12 col-lg-10">
                                                    <label for="{{$setting->ar_title}}"
                                                           class="col-form-label">{{$setting->ar_title}} بالعربي </label>
                                                    {!! Form::textarea($setting->name.'[]',$setting->ar_value,['class'=>'form-control ck-editor','rows'=>4]) !!}

                                                    <label for="{{$setting->ar_title}}"
                                                           class="col-form-label">{{$setting->ar_title}}  بالانجليزي</label>
                                                    {!! Form::textarea($setting->name.'[]',$setting->en_value,['class'=>'form-control ck-editor','rows'=>4]) !!}

                                                </div>
                                            @endif

                                            @if($setting->type == 'small_text')
                                                <div class="col-12 col-lg-10">
                                                    <label for="{{$setting->ar_title}}"
                                                           class="col-form-label">العنوان </label>
                                                    {!! Form::text($setting->name.'[]',$setting->ar_title,['class'=>'form-control']) !!}

                                                    <label for="{{$setting->ar_value}}"
                                                           class="col-form-label">المحتوى </label>
                                                    {!! Form::textarea($setting->name.'[]',$setting->ar_value,['class'=>'form-control ck-editor','rows'=>4]) !!}

                                                </div>
                                            @endif


                                            @if($setting->type == 'file' && $setting->name == 'splash_image')
                                                <div class="col-12 col-lg-4">
                                                    {!! Form::file($setting->name,['class' =>'form-control '.($errors->has('image') ? ' is-invalid' : null) ]) !!}
                                                    @error($setting->name)
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                                <div class="col-12 col-lg-4">
                                                    <a data-fancybox="gallery" href="{{getImgPath($setting->value)}}">
                                                        <img src="{{getImgPath($setting->value)}}" width="70"
                                                             height="70"
                                                             class="img-thumbnail">
                                                    </a>
                                                </div>
                                            @endif
                                        </div>
                                    @endforeach
                                    <div class="form-group row col-12">
                                        <button type="submit" class="btn btn-primary btn-block">حفظ</button>
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
{{--    <script src="{{asset('ckeditor/ckeditor.js')}}"></script>
    <script>
        CKEDITOR.replaceClass = 'ck-editor';
    </script>--}}
@endpush
