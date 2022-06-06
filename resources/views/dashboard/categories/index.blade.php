@extends('dashboard.layouts.layout')
@section('title','الاقسام ')

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

                            <a href="{{route('admin.categories.create')}}"
                               class="btn btn-purple btn-rounded w-md waves-effect waves-light m-b-5">اضافة قسم
                                جديد</a>
                            <br>
                            <br>

                            <table id="datatable-buttons" class="table table-striped table-bordered text-center">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>الاسم</th>
                                    <th>التفاصيل</th>
                                    <th>الصورة </th>
                                    <th>عرض الخدمات </th>
                                    <th class="text-center">العمليات</th>
                                </tr>
                                </thead>

                                <tbody>
                                @foreach($categories as $index => $category)
                                    <tr>
                                        <td>{{$index +1}}</td>
                                        <td>{{$category->name}}</td>
                                        <td>
                                            @include('dashboard.categories.category-details')
                                        </td>
                                        <td>
                                            @if($category->image)
                                                <a data-fancybox="gallery" href="{{$category->image}}">
                                                    <img src="{{$category->image}}" width="70" height="70"
                                                         class="img-thumbnail" alt="user_img">
                                                </a>
                                            @else {{__('No Image')}} @endif
                                        </td>


                                        <td>
                                            <a href="{{url(route('admin.services.index',['category'=>$category->id]))}}"
                                               class="btn-icon waves-effect btn btn-purple btn-sm ml-3 rounded-circle">
                                                الخدمات </a>

                                        </td>
                                        <td class="text-center">

                                            <form
                                                action="{{ route('admin.active', ['id' => $category->id, 'type' => 'Category']) }}"
                                                style="display: inline;"
                                                method="post">@csrf
                                                <button type="submit"
                                                        class="btn-icon waves-effect {{ $category->is_active ? 'btn btn-sm btn-success' : 'btn btn-sm btn-warning' }}">{{ $category->is_active ? 'مفعل ' : ' معطل' }}</button>
                                            </form>

                                            <a href="{{url(route('admin.categories.edit',$category->id))}}"
                                               class="btn-icon waves-effect btn btn-primary btn-sm ml-2 rounded-circle"><i
                                                    class="fa fa-edit"></i></a>

                                            <button data-url="{{route('admin.categories.destroy',$category->id)}}"
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
