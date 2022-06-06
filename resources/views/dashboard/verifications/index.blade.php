@extends('dashboard.layouts.layout')
@section('title','التحقق')

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

{{--                            <div class="row">--}}
{{--                                <div class="col-12 col-md-6">--}}
{{--                                    <a href="{{route('admin.verifications.create')}}"--}}
{{--                                       class="btn btn-purple btn-rounded w-md waves-effect waves-light m-b-5">اضافة مقدم--}}
{{--                                        خدمة--}}
{{--                                        جديد</a>--}}
{{--                                    <br>--}}
{{--                                    <br>--}}
{{--                                </div>--}}
{{--                            </div>--}}

                            <table id="datatable-buttons" class="table table-striped table-bordered text-center">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>الاسم</th>
                                    <th>البريد الالكترونى</th>
                                    <th>رقم الضمان الاجتماعى</th>
                                    <th>الصور</th>
                                    <th>التاريخ</th>
                                    <th>الحالة</th>
                                    <th>العمليات</th>
                                </tr>
                                </thead>

                                <tbody>
                                @foreach($verifications as $index => $verify)
                                    <tr>
                                        <td>{{$index +1}}</td>
                                        <td>{{$verify->provider->name}}</td>
                                        <td>{{$verify->email}}</td>
                                        <td>{{$verify->ssn}}</td>
                                        <td>@include('dashboard.verifications.images_modal')</td>
                                        <td>{{$verify->created_at->format('Y-m-d')}}</td>
                                        <td>{{__($verify->status)}}</td>
                                        <td class="text-center">
                                            @if( $verify->status == 'pending')
                                            <form
                                                action="{{ route('admin.verifications.update', $verify->id) }}"
                                                style="display: inline;"
                                                method="post">@csrf
                                                {{method_field('put')}}
                                                {!! Form::select('status',verify_status(),null,['class' =>'form-control ', 'placeholder'=>  'تغيير الحالة  ']) !!}
                                                <input type="hidden" name="verify_id" value="{{$verify->id}}">
                                                <input type="hidden" name="provider_id" value="{{$verify->provider_id}}">
                                                <button type="submit"
                                                        class="btn-icon waves-effect btn btn-sm btn-success">حفظ</button>
                                            </form>
                                            @endif


                                            {{--                                            <button data-url="{{route('admin.providers.destroy',$verify->id)}}"--}}
                                            {{--                                                    class="btn-icon waves-effect btn btn-danger rounded-circle btn-sm ml-2 delete"--}}
                                            {{--                                                    title="Delete">--}}
                                            {{--                                                <i class="fa fa-trash"></i>--}}
                                            {{--                                            </button>--}}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div><!-- end col -->
                </div>

            </div>
        </div><!-- end col -->
    </div>

@endsection
@include('dashboard.layouts.datatables_scripts')
