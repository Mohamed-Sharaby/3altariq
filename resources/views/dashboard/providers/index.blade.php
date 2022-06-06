@extends('dashboard.layouts.layout')
@section('title','مقدمي الخدمات ')

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
                        <div class="card-box table-responsive">
                            @include('dashboard.layouts.status')

                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <a href="{{route('admin.providers.create')}}"
                                       class="btn btn-purple btn-rounded w-md waves-effect waves-light m-b-5">اضافة مقدم خدمة
                                        جديد</a>
                                    <br>
                                    <br>
                                </div>
                                <div class="col-12 col-md-6 text-right">
                                    <a href="{{route('admin.providers-notifications.index')}}"
                                       class="btn btn-success btn-rounded w-md waves-effect waves-light m-b-5"> الاشعارات
                                    </a>
                                    <br>
                                </div>
                            </div>
                            <form class="form-horizontal" role="form" method="get" enctype="multipart/form-data"
                                  action="{{route('admin.providers.index')}}">


                                <div class="form-group row">
                                    <div class="col-12 col-md-4">
                                        <label class="col-form-label"> فلتر بالذى تم مراجعته</label>
                                        {!! Form::select('is_reviewed',reviewed(),request('is_reviewed'),['class' =>'form-control '.($errors->has('is_reviewed') ? ' is-invalid' : null)
                                            , 'placeholder'=>  'اختر الحالة' ]) !!}
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <label class="col-form-label"> الدولة</label>
                                        {!! Form::select('country_code',countryCode(),request('country_code'),['class' =>'form-control '.($errors->has('country_code') ? ' is-invalid' : null)
                                            , 'placeholder'=>  'اختر الدولة' ]) !!}
                                    </div>  

                                </div>

                                <div class="text-center form-group row">
                                    <button type="submit"
                                            class="btn btn-success btn-block waves-effect waves-light m-l-10 btn-md">
                                        بحث
                                    </button>
                                </div>

                            </form>
                            {{$dataTable->table()}}

                        </div>
                    </div><!-- end col -->
                </div>

            </div>
        </div><!-- end col -->
    </div>

@endsection
@include('dashboard.layouts.datatables_scripts',['yajra'=>true])
