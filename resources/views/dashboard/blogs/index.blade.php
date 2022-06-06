@extends('dashboard.layouts.layout')
@section('title','الاخبار ' )

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">

                <div class="breadcrumb">
                    <a href="{{route('admin.main')}}" class="header-title m-t-0 m-b-30"><i class="icon-home2 mr-2"></i>
                        الرئيسية</a> /
                    <span class="breadcrumb-item active">الاخبار

                    </span>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box table-responsive">
                            @include('dashboard.layouts.status')

                            <a href="{{route('admin.blogs.create')}}"
                               class="btn btn-purple btn-rounded w-md waves-effect waves-light m-b-5">اضافة خبر
                                جديد </a>
                            <br>
                            <br>

                            <table id="datatable-buttons" class="table table-striped table-bordered text-center">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>الاسم  </th>
                                    <th>الرابط  </th>
{{--                                    <th>الصورة  </th>--}}
                                    <th>العمليات</th>
                                </tr>
                                </thead>

                                <tbody>
                                @foreach($blogs as $index => $blog)
                                    <tr>
                                        <td>{{$index +1}}</td>
                                        <td>{{$blog->name}}</td>
                                        <td>
                                            <a href="{{$blog->url}}" target="_blank">{{$blog->url}}</a>
                                        </td>
{{--                                        <td>--}}
{{--                                            @include('dashboard.blogs.blog-details')--}}
{{--                                        </td>--}}
{{--                                        <td>--}}
{{--                                            @if($blog->image)--}}
{{--                                                <a data-fancybox="gallery" href="{{getImgPath($blog->image)}}">--}}
{{--                                                    <img src="{{getImgPath($blog->image)}}" width="70" height="70"--}}
{{--                                                         class="img-thumbnail" alt="blog_img">--}}
{{--                                                </a>--}}
{{--                                            @else {{__('No Image')}} @endif--}}
{{--                                        </td>--}}
                                        <td class="text-center">

                                                <form
                                                    action="{{ route('admin.active', ['id' => $blog->id, 'type' => 'Blog']) }}"
                                                    style="display: inline;"
                                                    method="post">@csrf
                                                    <button type="submit"
                                                            class="btn-icon waves-effect {{ $blog->is_active ? 'btn btn-sm btn-success' : 'btn btn-sm btn-warning' }}">{{ $blog->is_active ? 'مفعل ' : ' معطل' }}</button>
                                                </form>

                                            <a href="{{route('admin.blogs.edit',$blog->id)}}"
                                               class="btn-icon waves-effect btn btn-primary btn-sm ml-2 rounded-circle"><i
                                                    class="fa fa-edit"></i></a>

                                            <button data-url="{{route('admin.blogs.destroy',$blog->id)}}"
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
