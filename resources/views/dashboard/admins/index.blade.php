@extends('dashboard.layouts.layout')
@section('title','الادارة ')

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

                            <a href="{{route('admin.admins.create')}}"
                               class="btn btn-purple btn-rounded w-md waves-effect waves-light m-b-5">اضافة مدير
                                جديد</a>
                            <br>
                            <br>

                            <table id="datatable-buttons" class="table table-striped table-bordered text-center">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>الاسم</th>
                                    <th>البريد الالكترونى</th>
                                    <th>الجوال</th>
                                    <th>المنصب</th>
                                    <th>العمليات</th>
                                </tr>
                                </thead>

                                <tbody>
                                @foreach($admins as $index => $admin)
                                    <tr>
                                        <td>{{$index +1}}</td>
                                        <td>{{$admin->name}}</td>
                                        <td>{{$admin->email}}</td>
                                        <td>{{$admin->phone}}</td>
                                        <td>
                                            @if($admin->hasRole(\Spatie\Permission\Models\Role::all()))
                                                @foreach($admin->roles as $role)
                                                    {{$role->name}}
                                                @endforeach
                                            @else لا يوجد @endif
                                        </td>


                                        <td class="text-center">

                                            @if(!$admin->hasRole('Super Admin'))
                                                @if(auth('admin')->id() != $admin->id)

                                                    @if($role->is_active == 0)
                                                        <button disabled="disabled"
                                                                class="btn-icon waves-effect btn btn-sm btn-warning disabled">
                                                            المنصب
                                                            معطل
                                                        </button>
                                                    @else
                                                        <form
                                                            action="{{ route('admin.active', ['id' => $admin->id, 'type' => 'Admin']) }}" style="display: inline;"
                                                            method="post">@csrf
                                                            <button type="submit"
                                                                    class="btn-icon waves-effect {{ $admin->is_active ? 'btn btn-sm btn-success' : 'btn btn-sm btn-warning' }}">{{ $admin->is_active ? 'مفعل ' : ' معطل' }}</button>
                                                        </form>
                                                    @endif
                                                @else
                                                    <button disabled
                                                            class="btn-icon waves-effect btn btn-sm btn-success">مفعل
                                                    </button>
                                                @endif
                                            @else
                                                <button disabled="disabled"
                                                        class="btn-icon waves-effect btn btn-sm btn-success">مفعل
                                                </button>
                                            @endif


                                            @if($admin->hasRole('Super Admin') && auth()->user()->id == 1)

                                                    <a href="{{url(route('admin.admins.edit',$admin->id))}}"
                                                       class="btn-icon waves-effect btn btn-primary btn-sm ml-2 rounded-circle"><i
                                                            class="fa fa-edit"></i></a>

                                            @endif

                                            @if(!$admin->hasRole('Super Admin'))

                                                    <a href="{{url(route('admin.admins.edit',$admin->id))}}"
                                                       class="btn btn-primary btn-sm ml-2 rounded-circle"><i
                                                            class="fa fa-edit"></i></a>

                                            @endif


                                                @if(!$admin->hasRole('Super Admin'))
                                                    @if(auth('admin')->id() != $admin->id)
                                                        <button data-url="{{route('admin.admins.destroy',$admin->id)}}"
                                                                class="btn btn-danger rounded-circle btn-sm ml-2 delete" title="Delete">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    @endif
                                                @else
                                                    <button disabled class="btn btn-danger btn-sm ml-2 rounded-circle"><i
                                                            class="fa fa-trash"></i>
                                                    </button>
                                                @endif


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
