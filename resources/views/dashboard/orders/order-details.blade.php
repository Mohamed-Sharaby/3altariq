<div class="portlet fadeIn">
    <div class="portlet-heading bg-purple">
        <h3 class="portlet-title">
            تفاصيل الطلب رقم / {{$order->id}}
        </h3>
        <div class="portlet-widgets">
            <a href="javascript:;" data-toggle="reload"><i
                    class="zmdi zmdi-refresh"></i></a>
            <a data-toggle="collapse" data-parent="#accordion1" href="#details"><i
                    class="zmdi zmdi-minus"></i></a>
        </div>
        <div class="clearfix"></div>
    </div>
    <div id="details" class="panel-collapse collapse in">
        <div class="portlet-body">

            <table class="table table-bordered table-responsive table-striped">

                <tr>
                    <th> العميل</th>
                    <td>  {{$order->user->name}} </td>
                </tr>
                <tr>
                    <th>مقدم الخدمة</th>
                    <td>  {{$order->provider->name}} </td>
                </tr>

                <tr>
                    <th>الحالة</th>
                    <td>  {{__($order->status)}} </td>
                </tr>

                <tr>
                    <th>التقييم</th>
                    <td>  {{$order->rate}} </td>
                </tr>

                <tr>
                    <th>السعر</th>
                    <td> {{$order->price}}</td>
                </tr>

                <tr>
                    <th>التاريخ</th>
                    <td> {{$order->created_at->format('Y-m-d')}}</td>
                </tr>
                <tr>
                    <th>ملاحظات</th>
                    <td>
                        <p style="white-space: pre-line;overflow-wrap: anywhere;text-overflow: ellipsis;">{{$order->notes}}</p>
                    </td>
                </tr>

            </table>
        </div>
    </div>
</div>

