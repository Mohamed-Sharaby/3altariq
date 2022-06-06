
<script>
    var resizefunc = [];
</script>

<!-- jQuery  -->
<script src="{{asset('admin/assets/js/jquery.min.js')}}"></script>
<script src="{{asset('admin/assets/js/bootstrap-rtl.min.js')}}"></script>
<script src="{{asset('admin/assets/js/detect.js')}}"></script>
<script src="{{asset('admin/assets/js/fastclick.js')}}"></script>
<script src="{{asset('admin/assets/js/jquery.blockUI.js')}}"></script>
<script src="{{asset('admin/assets/js/waves.js')}}"></script>
<script src="{{asset('admin/assets/js/jquery.nicescroll.js')}}"></script>
<script src="{{asset('admin/assets/js/jquery.slimscroll.js')}}"></script>
<script src="{{asset('admin/assets/js/jquery.scrollTo.min.js')}}"></script>

<script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>

<!-- KNOB JS -->
<!--[if IE]>
<script type="text/javascript" src="{{asset('admin/assets/plugins/jquery-knob/excanvas.js')}}"></script>
<![endif]-->
<script src="{{asset('admin/assets/plugins/jquery-knob/jquery.knob.js')}}"></script>
<!--Morris Chart-->
{{--<script src="{{asset('admin')}}/assets/plugins/morris/morris.min.js"></script>--}}
<script src="{{asset('admin/assets/plugins/raphael/raphael-min.js')}}"></script>
<!-- Dashboard init -->
{{--<script src="{{asset('admin')}}/assets/pages/jquery.dashboard.js"></script>--}}
<!-- App js -->
<script src="{{asset('admin/assets/js/jquery.core.js')}}"></script>
<script src="{{asset('admin/assets/js/jquery.app.js')}}"></script>


<!-- Plugins Js -->
<script src="{{asset('admin/assets/plugins/switchery/switchery.min.js')}}"></script>
<script src="{{asset('admin/assets/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js')}}"></script>
<script type="text/javascript" src="{{asset('admin/assets/plugins/multiselect/js/jquery.multi-select.js')}}"></script>
<script type="text/javascript" src="{{asset('admin/assets/plugins/jquery-quicksearch/jquery.quicksearch.js')}}"></script>
<script src="{{asset('admin/assets/plugins/select2/dist/js/select2.min.js')}}" type="text/javascript"></script>
<script src="{{asset('admin/assets/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js')}}" type="text/javascript"></script>
<script src="{{asset('admin/assets/plugins/bootstrap-inputmask/bootstrap-inputmask.min.js')}}" type="text/javascript"></script>
<script src="{{asset('admin/assets/plugins/moment/moment.js')}}"></script>
<script src="{{asset('admin/assets/plugins/timepicker/bootstrap-timepicker.min.js')}}"></script>
<script src="{{asset('admin/assets/plugins/mjolnic-bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js')}}"></script>
<script src="{{asset('admin/assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
<script src="{{asset('admin/assets/plugins/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
<script src="{{asset('admin/assets/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js')}}" type="text/javascript"></script>




<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
<script src="//cdn.ckeditor.com/4.16.0/full/ckeditor.js"></script>


<script>
    $(document).ready(function() {
        CKEDITOR.config.language = "{{app()->getLocale()}}";


        $(document).on('click', '.del_img', function(e) {
            let confirmResult = confirm('{{__('Are you sure you want to delete this Photo ? ')}}');
            if (confirmResult) {

            } else {
                e.preventDefault();
            }
        });


        $("#select-all").click(function() {
            $("input[type=checkbox]").prop('checked', $(this).prop('checked'));
        });
    });
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<script>

    $(document).on('click', ".delete", function (event) {
        let cur = $(this);
        let url = $(this).attr('data-url');

        swal({
            title: "تأكيد الحذف",
            text: "هل أنت متاكد من حذف هذا السجل ؟",
            icon: "warning",
            buttons: ["الغاء", "موافق"],
            dangerMode: true,

        }).then(function (isConfirm) {
            if (isConfirm) {
                $.ajax({
                    url: url,
                    type: "delete",
                    success: function (data) {
                        swal("تم الحذف بنجاح", "تم الحذف بنجاح", 'success', {buttons: "موافق"});
                        cur.parents('tr').fadeOut(700);
                        cur.parents('tr').remove(700);
                    },
                    error: function (error) {
                        swal("لا يمكن الحذف", "خطأ", 'error', {buttons: "موافق"});
                        console.log('there is an error ', error)
                    }
                });
            } else {
                swal("تم الالغاء", "تم إلغاء الحذف", 'error', {buttons: "موافق"});
            }
        });
    });
</script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
