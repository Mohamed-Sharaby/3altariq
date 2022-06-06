@extends('dashboard.layouts.layout')
@section('title','الصلاحيات والمناصب')

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

                            <a href="{{route('admin.roles.create')}}"
                               class="btn btn-purple btn-rounded w-md waves-effect waves-light m-b-5">اضافة منصب
                                جديد</a>
                            <br>
                            <br>

                            <table id="datatable-buttons" class="table table-striped table-bordered text-center">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>الاسم</th>
                                    <th>الصلاحيات</th>
                                    <th>العمليات</th>
                                </tr>
                                </thead>

                                <tbody>
                                @foreach($roles as $index => $role)
                                    <tr>
                                        <td>{{$index +1}}</td>
                                        <td>{{$role->name}}</td>
                                        <td>

                                            <button class="btn btn-primary waves-effect waves-light" data-toggle="modal"
                                                    data-target="#item{{$role->id}}">عرض الصلاحيات
                                            </button>
                                            <!--  Modal content for the above example -->
                                            <div class="modal fade bs-example-modal-lg" id="item{{$role->id}}"
                                                 tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
                                                 aria-hidden="true" style="display: none;">
                                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                    aria-hidden="true">×
                                                            </button>
                                                            <h4 class="modal-title" id="myLargeModalLabel">
                                                                قائمة صلاحيات   <span class="badge badge-success">{{$role->name}}</span> </h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                @if(count($role->permissions))
                                                                    @foreach($role->permissions as $permission)
                                                                        <div class="col-sm-4">
                                                                            <ul>
                                                                                <li class="text-left">{{$permission->ar_name}}</li>
                                                                            </ul>
                                                                        </div>
                                                                    @endforeach
                                                                @else
                                                                    لا يوجد صلاحيات
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div><!-- /.modal-content -->
                                                </div><!-- /.modal-dialog -->
                                            </div><!-- /.modal -->
                                        </td>

                                        <td class="text-center">
                                            @if($role->hasAllPermissions(\Spatie\Permission\Models\Permission::all()) && $role->name =='Super Admin')
                                                <button disabled
                                                        class="btn btn-icon waves-effect waves-light btn-success btn-sm"> مفعل
                                                </button>

                                            @else
                                                @if( !auth()->user()->hasRole($role))
                                                    <form action="{{ route('admin.active.role', ['id' => $role->id]) }}"
                                                          style="display: inline;"
                                                          method="post">@csrf
                                                        <button type="submit"
                                                                class="btn btn-sm btn-icon waves-effect {{ $role->is_active ? 'btn btn-success' : 'btn btn-warning' }}">{{ $role->is_active ? 'مفعل' : 'غير مفعل' }}</button>
                                                    </form>
                                                @else
                                                    <button disabled
                                                            class="btn btn-icon waves-effect btn-sm {{ $role->is_active ? 'btn btn-success' : 'btn btn-warning' }}">{{ $role->is_active ? 'مفعل' : 'غير مفعل' }}</button>
                                                @endif
                                            @endif
                                            {{--/////////////////////////////////////////////////////////////////////////////////--}}

                                            @if($role->hasAllPermissions(\Spatie\Permission\Models\Permission::all()) && $role->name =='Super Admin')
                                                <a disabled
                                                   class="btn-icon waves-effect btn btn-primary btn-sm ml-2 rounded-circle">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                            @else
                                                <a href="{{route('admin.roles.edit',$role->id)}}"
                                                   class="btn-icon waves-effect btn btn-primary btn-sm ml-2 rounded-circle">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                            @endif

                                            {{--/////////////////////////////////////////////////////////////////////////////////--}}

                                            @if($role->hasAllPermissions(\Spatie\Permission\Models\Permission::all()) && $role->name =='Super Admin')
                                                <button
                                                    class="btn-icon waves-effect btn btn-danger btn-sm ml-2 rounded-circle btn-sm"
                                                    disabled><i class="fa fa-trash"></i>
                                                </button>
                                            @else

                                                <button data-url="{{route('admin.roles.destroy',$role->id)}}"
                                                        class="btn-icon waves-effect btn btn-danger rounded-circle btn-sm ml-2 delete"
                                                        title="Delete">
                                                    <i class="fa fa-trash"></i>
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
