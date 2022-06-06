<div class="row">
    <div class="col-12 ">
        <form class="form-horizontal" method="get"
              action="{{route('admin.orders.index')}}">

            <div class="form-group row ">
                <div class="col-12 col-md-4">
                    <label class="  control-label">حالة الطلب</label>
                    <select name="status" id="status" class="form-control">
                        <option selected disabled>اختر حالة الطلب</option>
                        @foreach(order_status() as $index => $status)
                            <option
                                value="{{$index}}" {{request('status') == $index ? 'selected': ''}}>{{$status}}</option>
                        @endforeach
                    </select>
                    @error('status')
                    <div class="invalid-feedback" style="color: #ef1010">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="col-12 col-md-4">
                    <label class="control-label" for="example-email">من تاريخ </label>
                    <input type="date" class="form-control"
                           placeholder="mm/dd/yyyy" name="from" value="{{request('from')}}">
                    @error('from')
                    <div class="invalid-feedback" style="color: #ef1010">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="col-12 col-md-4">
                    <label class="control-label" for="example-email"> الى تاريخ </label>
                    <input type="date" class="form-control"
                           placeholder="mm/dd/yyyy" name="to" value="{{request('to')}}">
                    @error('to')
                    <div class="invalid-feedback" style="color: #ef1010">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>

            <div class="form-group row text-center">
                <button type="submit"
                        class="btn btn-success btn-block col-12 waves-effect waves-light ">
                    بحث
                </button>
            </div>

        </form>
    </div>
</div>
