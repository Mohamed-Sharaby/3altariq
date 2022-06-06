@extends('dashboard.layouts.layout')
@section('title','اشعارات العملاء ')

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">

                <div class="breadcrumb">
                    <a href="{{route('admin.main')}}" class="header-title m-t-0 m-b-30"><i class="icon-home2 mr-2"></i>
                        الرئيسية</a> /
                    <a href="{{route('admin.users.index')}}" class="header-title m-t-0 m-b-30"><i
                            class="icon-home2 mr-2"></i>
                        العملاء  </a> /
                    <span class="breadcrumb-item active">@yield('title')</span>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box table-responsive">
                            @include('dashboard.layouts.status')

                            <div class="row">
                                <div class="col-12 col-md-6  text-center">
                                    <a href="{{route('admin.notifications.create')}}"
                                       class="btn btn-success btn-rounded w-md waves-effect waves-light m-b-5">ارسال اشعارات عامة
                                        </a>
                                </div>
                                <div class="col-12 col-md-6 text-center">
                                    <a
{{--                                        href="{{route('admin.users.sendSms')}}"--}}
                                       class="btn btn-dribbble btn-rounded w-md waves-effect waves-light m-b-5">ارسال رسائل Sms
                                    </a>
                                </div>
                            </div>


                            <table id="datatable-buttons" class="table table-striped table-bordered text-center">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>العميل</th>
                                    <th>عنوان الاشعار</th>
                                    <th>محتوى الاشعار</th>
                                    <th>التاريخ </th>
                                    <th>العمليات</th>
                                </tr>
                                </thead>

                                <tbody>
                                @foreach($notifications as $notification)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{ $notification->notifiable->name ?? '' }} </td>
                                        <td> {{ $notification->data['title'] }}</td>
                                        <td>{{ $notification->data['body'] }} </td>
                                        <td>{{ $notification->created_at->format('Y-m-d') }} </td>
                                        <td class="text-center">
                                            <button data-url="{{route('admin.notifications.destroy',$notification->id)}}"
                                                    class="btn btn-danger rounded-circle btn-sm ml-2 delete" title="حذف الاشعار">
                                                <i class="fa fa-trash"></i>
                                            </button>
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
