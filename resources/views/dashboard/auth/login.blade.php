<!DOCTYPE html>
<html lang="en" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
    <meta name="author" content="Coderthemes">

    <!-- App Favicon -->
    <link rel="shortcut icon" href="{{asset('admin/assets/images/logo.png')}}">

    <!-- App title -->
    <title>لوحة التحكم - تسجيل الدخول</title>

    <!-- App CSS -->
    <link href="{{asset('admin/assets/css/bootstrap-rtl.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('admin/assets/css/core.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('admin/assets/css/components.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('admin/assets/css/icons.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('admin/assets/css/pages.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('admin/assets/css/menu.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('admin/assets/css/responsive.css')}}" rel="stylesheet" type="text/css"/>

    <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

    <script src="{{asset('admin/assets/js/modernizr.min.js')}}"></script>
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet"
          type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Cairo:300,400,600,700&display=swap&subset=arabic"
          rel="stylesheet">

    <style>
        body, html {
            font-family: 'Cairo', sans-serif;
            /*font-size: 16px;*/
        }
    </style>
</head>
<body>

<div class="account-pages"></div>
<div class="clearfix"></div>
<div class="wrapper-page">

    <div class="m-t-40 card-box">
        <div class="text-center">
            <a href="#">
                <img alt="logo" width="100" height="100" src="{{asset('admin/assets/images/logo.png')}}"/>
            </a>
        </div>
        <div class="text-center">
            <h4 class="text-uppercase font-bold m-b-0">عالطريق - لوحة التحكم </h4>
        </div>
        <div class="panel-body">
            @include('dashboard.layouts.status')
            <form class="form-horizontal m-t-20" action="{{route('login')}}" method="post">
                @csrf
                <div class="form-group ">
                    <div class="col-xs-12">
                        <input class="form-control" type="email" name="email"
                               oninvalid="this.setCustomValidity('البريد الالكترونى مطلوب')"
                               onchange="this.setCustomValidity('')"
                               required placeholder="البريد الالكترونى">
                        @error('email')
                        <span class="invalid-feedback" style="color: #ef1010" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>

                </div>

                <div class="form-group">
                    <div class="col-xs-12">
                        <input class="form-control" type="password" name="password"
                               oninvalid="this.setCustomValidity('كلمة المرور مطلوبة')"
                               onchange="this.setCustomValidity('')"
                               required placeholder="كلمة المرور">
                        @error('password')
                        <span class="invalid-feedback" style="color: #ef1010" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>

                </div>


                <div class="form-group text-center m-t-30">
                    <div class="col-xs-12">
                        <button class="btn btn-custom btn-bordred btn-block waves-effect waves-light" type="submit">
                            دخول
                        </button>
                    </div>
                </div>

            </form>

        </div>
    </div>
    <!-- end card-box-->


</div>
<!-- end wrapper page -->


<script>
    var resizefunc = [];
</script>

<!-- jQuery  -->
<script src="{{asset('admin/assets/js/jquery.min.js')}}"></script>
<script src="{{asset('admin/assets/js/bootstrap-rtl.min.js')}}"></script>
<script src="{{asset('admin/assets/js/detect.js')}}"></script>
<script src="{{asset('admin/assets/js/fastclick.js')}}"></script>
<script src="{{asset('admin/assets/js/jquery.slimscroll.js')}}"></script>
<script src="{{asset('admin/assets/js/jquery.blockUI.js')}}"></script>
<script src="{{asset('admin/assets/js/waves.js')}}"></script>
<script src="{{asset('admin/assets/js/wow.min.js')}}"></script>
<script src="{{asset('admin/assets/js/jquery.nicescroll.js')}}"></script>
<script src="{{asset('admin/assets/js/jquery.scrollTo.min.js')}}"></script>

<!-- App js -->
<script src="{{asset('admin/assets/js/jquery.core.js')}}"></script>
<script src="{{asset('admin/assets/js/jquery.app.js')}}"></script>

</body>
</html>
