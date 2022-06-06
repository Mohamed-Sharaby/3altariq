@extends('dashboard.layouts.layout')
@section('title',' اضافة منصب جديد')

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">

                <div class="breadcrumb">
                    <a href="{{route('admin.main')}}" class="header-title m-t-0 m-b-30"><i class="icon-home2 mr-2"></i>
                        الرئيسية</a> /
                    <a href="{{route('admin.roles.index')}}" class="header-title m-t-0 m-b-30"><i
                            class="icon-home2 mr-2"></i>
                        الصلاحيات والمناصب</a> /
                    <span class="breadcrumb-item active">@yield('title')</span>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box table-responsive">
                            @include('dashboard.layouts.status')
                            <h4 class="header-title m-t-0 m-b-30"> اضافة منصب</h4>

                            <div class="row">
                                <div class="col-lg-12">
                                    {!!Form::open( ['route' => 'admin.roles.store', 'method' => 'Post','role'=>'form','class'=>'form-horizontal','files'=>true]) !!}

                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label col-lg-2">اسم المنصب</label>
                                        <div class="col-12 col-lg-8">
                                            {!! Form::text('name',null,[
                                              'class' =>'form-control '.($errors->has('name') ? ' is-invalid' : null),
                                              'placeholder'=> 'اسم المنصب' ,
                                              ]) !!}
                                            @error('name')
                                            <div class="invalid-feedback" style="color: #ef1010">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label col-lg-2"> قائمة الصلاحيات</label>

                                        <div class="col-12 col-lg-8">
                                            @foreach($permissions as $permission)
                                                <div class="col-sm-6">
                                                    <div class="checkbox checkbox-pink">
                                                        <input id="{{$permission->id}}" type="checkbox"
                                                               name="permission[]" value="{{$permission->id}}"
                                                               data-parsley-multiple="groups" data-parsley-mincheck="2">
                                                        <label
                                                            for="{{$permission->id}}"> {{$permission->ar_name}} </label>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>

                                    <div class="text-center">
                                        <button type="submit"
                                                class="btn btn-success btn-block waves-effect waves-light m-l-10 btn-md">
                                            حفظ
                                        </button>
                                    </div>

                                    {!!Form::close() !!}
                                </div><!-- end col -->

                            </div><!-- end row -->


                        </div>
                    </div><!-- end col -->
                </div>

            </div>
        </div><!-- end col -->
    </div>

@endsection
