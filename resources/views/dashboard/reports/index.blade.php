@extends('dashboard.layouts.layout')
@section('title','البلاغات ')

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

                            <table id="datatable-buttons" class="table table-striped table-bordered text-center">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>الاسم</th>
                                    <th>رقم التيلفون</th>
                                    <th>عنوان البلاغ</th>
                                    <th>محتوى البلاغ </th>
                                    <th>تم الحل</th>
                                    <th>التاريخ  </th>
                                    <th>العمليات</th>
                                </tr>
                                </thead>

                                <tbody>
                                @foreach($reports as $index => $report)
                                    <tr>
                                        <td>{{$index +1}}</td>
                                        <td>{{$report->name}}</td>
                                        <td>{{$report->phone}}</td>
                                        <td>{{$report->title}}</td>
                                        <td>
                                            <button class="btn btn-primary waves-effect waves-light" data-toggle="modal"
                                                    data-target="#item{{$report->id}}">عرض محتوى البلاغ
                                            </button>
                                            <!--  Modal content for the above example -->
                                            <div class="modal fade bs-example-modal-lg" id="item{{$report->id}}"
                                                 tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
                                                 aria-hidden="true" style="display: none;">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                    aria-hidden="true">×
                                                            </button>
                                                            <h4 class="modal-title" id="myLargeModalLabel"> {{$report->title}}
                                                                </h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <p style="white-space: pre-line;overflow-wrap: break-word;text-overflow: ellipsis;">{{$report->body}}</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div><!-- /.modal-content -->
                                                </div><!-- /.modal-dialog -->
                                            </div><!-- /.modal -->
                                        </td>
                                        <td>
                                            <form action="{{ route('admin.reports.solve', ['id' => $report->id]) }}"
                                                  style="display: inline;"
                                                  method="post">@csrf
                                                <button type="submit"
                                                        class="btn btn-sm btn-icon waves-effect {{ $report->is_resolved ? 'btn btn-success' : 'btn btn-warning' }}">{{ $report->is_resolved ? 'نعم' : 'لا' }}</button>
                                            </form>
                                        </td>
                                        <td>
                                            {{$report->created_at->format('Y-m-d')}}
                                        </td>

                                        <td class="text-center">
                                            <button data-url="{{route('admin.reports.destroy',$report->id)}}"
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
