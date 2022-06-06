@extends('dashboard.layouts.layout')
@section('title','خدمات القسم'.' '. $category->name )

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">

                <div class="breadcrumb">
                    <a href="{{route('admin.main')}}" class="header-title m-t-0 m-b-30"><i class="icon-home2 mr-2"></i>
                        الرئيسية</a> /
                    <a href="{{route('admin.categories.index')}}" class="header-title m-t-0 m-b-30"><i
                            class="icon-home2 mr-2"></i>
                        الاقسام </a> /
                    <span class="breadcrumb-item active">خدمات القسم
                    <span class="badge badge-success">{{$category->name}}</span>
                    </span>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box table-responsive">
                            @include('dashboard.layouts.status')

                            <a href="{{route('admin.services.create',['category'=>$category->id])}}"
                               class="btn btn-purple btn-rounded w-md waves-effect waves-light m-b-5">اضافة خدمة
                                جديدة</a>
                            <br>
                            <br>

                            <table id="datatable-buttons" class="table table-striped table-bordered text-center">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>الاسم بالعربية</th>
                                    <th>الاسم بالانجليزية</th>
{{--                                    <th>القسم </th>--}}
                                    <th>ترتيب الظهور </th>
                                    <th>الصورة</th>
                                    <th>العمليات</th>
                                </tr>
                                </thead>

                                <tbody>
                                @foreach($services as $index => $service)
                                    <tr>
                                        <td>{{$index +1}}</td>
                                        <td>{{$service->ar_name}}</td>
                                        <td>{{$service->en_name}}</td>
{{--                                        <td>{{$service->category->name}}</td>--}}
                                        <td>{{$service->sort_number}}</td>
                                        <td>
                                            @if($service->image)
                                                <a data-fancybox="gallery" href="{{$service->image}}">
                                                    <img src="{{$service->image}}" width="70" height="70"
                                                         class="img-thumbnail" alt="user_img">
                                                </a>
                                            @else {{__('No Image')}} @endif
                                        </td>
                                        <td class="text-center">

                                                <form
                                                    action="{{ route('admin.active', ['id' => $service->id, 'type' => 'Service']) }}"
                                                    style="display: inline;"
                                                    method="post">@csrf
                                                    <button type="submit"
                                                            class="btn-icon waves-effect {{ $service->is_active ? 'btn btn-sm btn-success' : 'btn btn-sm btn-warning' }}">{{ $service->is_active ? 'مفعل ' : ' معطل' }}</button>
                                                </form>

                                            <a href="{{url(route('admin.services.edit',['service'=>$service->id]))}}"
                                               class="btn-icon waves-effect btn btn-primary btn-sm ml-2 rounded-circle"><i
                                                    class="fa fa-edit"></i></a>
                                            <a href="{{url(route('admin.services.show',$service))}}"
                                               class="btn-icon waves-effect btn btn-primary btn-sm ml-2 rounded-circle"><i
                                                    class="fa fa-eye"></i></a>

                                            <button data-url="{{route('admin.services.destroy',$service->id)}}"
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
