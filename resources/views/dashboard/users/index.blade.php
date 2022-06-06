@extends('dashboard.layouts.layout')
@section('title','العملاء ')

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
                                    <a href="{{route('admin.users.create')}}"
                                       class="btn btn-purple btn-rounded w-md waves-effect waves-light m-b-5">اضافة عميل
                                        جديد</a>
                                    <br>
                                    <br>
                                </div>
                                <div class="col-12 col-md-6 text-right">
                                    <a href="{{route('admin.notifications.index')}}"
                                       class="btn btn-success btn-rounded w-md waves-effect waves-light m-b-5"> الاشعارات
                                        </a>
                                    <br>
                                </div>
                            </div>
                            <form class="form-horizontal" role="form" method="get" enctype="multipart/form-data"
                                  action="{{route('admin.providers.index')}}">


                                <div class="form-group row">
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

                            <table id="datatable-buttons" class="table table-striped table-bordered text-center">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>الاسم</th>
                                    <th>الجوال</th>
                                    <th>الصورة  </th>
                                    <th>تاريخ الانشاء  </th>
                                    <th>العمليات</th>
                                </tr>
                                </thead>

                                <tbody>
                                @foreach($users as $index => $user)
                                    <tr>
                                        <td>{{$index +1}}</td>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->phone}}</td>
                                        <td>
                                            @if($user->image)
                                                <a data-fancybox="gallery" href="{{$user->image}}">
                                                    <img src="{{$user->image}}" width="70" height="70"
                                                         class="img-thumbnail" alt="user_img">
                                                </a>
                                            @else {{__('No Image')}} @endif
                                        </td>
                                        <td>{{ $user->created_at->format('Y-m-d') }} </td>
                                        <td class="text-center">
                                                <form
                                                    action="{{ route('admin.active', ['id' => $user->id, 'type' => 'User']) }}"
                                                    style="display: inline;"
                                                    method="post">@csrf
                                                    <button type="submit"
                                                            class="btn-icon waves-effect {{ $user->is_active ? 'btn btn-sm btn-success' : 'btn btn-sm btn-warning' }}">{{ $user->is_active ? 'مفعل ' : ' معطل' }}</button>
                                                </form>

                                            <a href="{{url(route('admin.users.edit',$user->id))}}"
                                               class="btn-icon waves-effect btn btn-primary btn-sm ml-2 rounded-circle"><i
                                                    class="fa fa-edit"></i></a>


                                            <button data-url="{{route('admin.users.destroy',$user->id)}}"
                                                    class="btn-icon waves-effect btn btn-danger rounded-circle btn-sm ml-2 delete" title="Delete">
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
@include('dashboard.layouts.datatables_scripts')
