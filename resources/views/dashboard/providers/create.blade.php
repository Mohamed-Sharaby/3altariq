@extends('dashboard.layouts.layout')
@section('title',' اضافة مقدم خدمة جديد')

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">

                <div class="breadcrumb">
                    <a href="{{route('admin.main')}}" class="header-title m-t-0 m-b-30"><i class="icon-home2 mr-2"></i>
                        الرئيسية</a> /
                    <a href="{{route('admin.providers.index')}}" class="header-title m-t-0 m-b-30"><i
                            class="icon-home2 mr-2"></i>
                        مقدمى الخدمات </a> /
                    <span class="breadcrumb-item active">@yield('title')</span>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box table-responsive">
                            {{--                            @include('dashboard.layouts.status')--}}
                            <h4 class="header-title m-t-0 m-b-30"> اضافة مقدم خدمة</h4>
                            {!!Form::open( ['route' => 'admin.providers.store', 'method' => 'Post','role'=>'form','class'=>'form-horizontal','files'=>true]) !!}
                            @include('dashboard.providers.form')
                            {!!Form::close() !!}

                        </div>
                    </div><!-- end col -->
                </div>
            </div>
        </div><!-- end col -->
    </div>

@endsection
{{--@section('my-js')--}}
{{--    <script>--}}
{{--        $(document).ready(function () {--}}
{{--            $('#category_id').on('change', function (e) {--}}
{{--                var category_id = $(this).val();--}}
{{--                if (category_id) {--}}
{{--                    $.ajax({--}}
{{--                        url: '/getServices/' + category_id,--}}
{{--                        method: 'GET',--}}
{{--                        type: 'json',--}}
{{--                        success: function (data) {--}}
{{--                            $('#service_id').empty();--}}
{{--                            $.each(data, function (key, value) {--}}
{{--                                $('#service_id').append('<option value="' + key + '" >' + value + '</option>');--}}
{{--                            });--}}
{{--                        }--}}
{{--                    });--}}
{{--                } else {--}}
{{--                    $('#service_id').empty();--}}
{{--                }--}}
{{--            });--}}
{{--        });--}}
{{--    </script>--}}
{{--@endsection--}}
