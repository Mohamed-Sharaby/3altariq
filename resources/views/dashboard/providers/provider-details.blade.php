<div class="portlet fadeIn">
    <div class="portlet-heading bg-purple">
        <h3 class="portlet-title">
            تفاصيل مقدم الخدمة / {{$provider->name}}
        </h3>

        <div class="clearfix"></div>
    </div>
    <div id="details" class="panel-collapse collapse in">
        <div class="portlet-body">

            <table class="table table-bordered table-responsive table-striped">

                <tr>
                    <th> الاسم</th>
                    <td>  {{$provider->name}} </td>
                </tr>
                <tr>
                    <th>الجوال</th>
                    <td>  {{$provider->phone}} </td>
                </tr>

                <tr>
                    <th>الخدمة</th>
                    <td>  {{$provider->service->name}} </td>
                </tr>

                <tr>
                    <th>المدينة</th>
                    <td>  {{$provider->country->name}} </td>
                </tr>
                <tr>
                    <th>العنوان</th>
                    <td>  {{$provider->address}} </td>
                </tr>

                <tr>
                    <th>الموقع</th>
                    <td> {{$provider->location == 'fixed'?'ثابت':'متحرك'}}</td>
                </tr>

                <tr>
                    <th>تاريخ الانتهاء</th>
                    <td> {{isset($provider->expire_at) ? $provider->expire_at->format('Y-m-d') : ''}}</td>
                </tr>

                <tr>
                    <th>عدد زيارات الملف الشخصي</th>
                    <td> {{$provider->profile_counter}}</td>
                </tr>
                <tr>
                    <th>عدد طلبات الاتصال بالتيلفون</th>
                    <td> {{$provider->phone_counter}}</td>
                </tr>
                <tr>
                    <th>عدد الطلبات</th>
                    <td> {{$provider->orders()->count()}}</td>
                </tr>
                <tr>
                    <th>صور اضافية</th>
                    <td>
                        @if(count($provider->getMedia('photos')) > 0)
                            @include('dashboard.providers.photos_modal')
                        @else
                            لا يوجد
                        @endif
                    </td>
                </tr>

            </table>
        </div>
    </div>
</div>
<div class="portlet fadeIn">
    <div class="portlet-heading bg-purple">
        <h3 class="portlet-title">
            احصائيات الطلبات
        </h3>
        <div class="clearfix"></div>
    </div>
    <div id="details" class="panel-collapse collapse in">
        <div class="portlet-body">
            <div class="row">
                <div class="col-12 ">
                    <form class="" method="get"
                          action="{{route('admin.providers.show',$provider->id)}}">

                        <div class="col-md-6 ">
                            <label class="control-label" for="example-email">من تاريخ </label>
                            <input type="date" class="form-control"
                                   placeholder="mm/dd/yyyy" name="from" value="{{request('from')}}">
                            @error('from')
                            <div class="invalid-feedback" style="color: #ef1010">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col-md-6 ">
                            <label class="control-label" for="example-email"> الى تاريخ </label>
                            <input type="date" class="form-control"
                                   placeholder="mm/dd/yyyy" name="to" value="{{request('to')}}">
                            @error('to')
                            <div class="invalid-feedback" style="color: #ef1010">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="col-md-12">
                            <div class="  ">
                                <button type="submit"
                                        class="btn btn-success btn-block col-12 waves-effect waves-light ">
                                    بحث
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
            <div id="provider-orders"></div>
        </div>
    </div>
</div>

@push('styles')
    <link rel="stylesheet" href="{{asset('morris.js/dist/morris.css')}}">
@endpush
@push('my-js')
    <script src="{{asset('admin/assets/plugins/raphael/raphael-min.js')}}"></script>
    <script src="{{asset('morris.js/dist/morris.min.js')}}"></script>
    <script>
        Morris.Donut({
            element: 'provider-orders',
            data: @json($statistics)
        });
    </script>
@endpush
