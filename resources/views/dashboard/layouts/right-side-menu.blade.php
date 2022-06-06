<!-- ========== Left Sidebar Start ========== -->
<div class="left side-menu">
    <div class="sidebar-inner slimscrollleft">

        <!-- User -->
        <div class="user-box">
            <div class="user-img">
                <img src="{{asset('admin/assets/images/user.jpg')}}" alt="user-img" title="{{auth('admin')->user()->name}}"
                     class="img-circle img-thumbnail img-responsive">
                <div class="user-status offline"><i class="zmdi zmdi-dot-circle"></i></div>
            </div>
            <h5><a href="javascript:void(0)">{{auth('admin')->user()->name}}</a></h5>
            <ul class="list-inline">
                <li>
                    <a href="{{route('admin.admins.edit',auth()->id())}}" title="اعدادات الحساب">
                        <i class="zmdi zmdi-settings zmdi-hc-2x text-primary"></i>
                    </a>
                </li>

                <li>
                    <a href="{{ route('logout') }}" class="text-custom" title="تسجيل الخروج"
                       onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                        <i class="zmdi zmdi-power zmdi-hc-2x text-danger"></i>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
        </div>
        <!-- End User -->

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <ul>
                <li>
                    <a href="{{route('admin.main')}}" class="waves-effect"><i class="zmdi zmdi-view-dashboard"></i>
                        <span> الرئيسية </span> </a>
                </li>

                @can('Roles')
                    <li>
                        <a href="{{route('admin.roles.index')}}" class="waves-effect"><i
                                class="fa fa-balance-scale"></i> <span> الصلاحيات والمناصب </span> </a>
                    </li>
                @endcan

                @can('Admins')
                    <li>
                        <a href="{{route('admin.admins.index')}}" class="waves-effect"><i
                                class="fa fa-life-ring"></i> <span> الادارة  </span> </a>
                    </li>
                @endcan

                @can('Countries')
                    <li>
                        <a href="{{route('admin.countries.index')}}" class="waves-effect"><i
                                class="fa fa-life-ring"></i> <span> المدن  </span> </a>
                    </li>
                @endcan

                @can('Users')
                    <li class="has_sub">
                        <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-users"></i> <span> العملاء </span> <span class="menu-arrow"></span></a>
                        <ul class="list-unstyled">
                            <li><a href="{{route('admin.users.index')}}"> العملاء</a></li>
                            <li><a href="{{route('admin.notifications.create')}}"> اشعارات العملاء</a></li>

                        </ul>
                    </li>
                @endcan

                @can('Banners')
                    <li>
                        <a href="{{route('admin.banners.index')}}" class="waves-effect"><i
                                class="zmdi zmdi-collection-folder-image"></i> <span> البانرات  </span> </a>
                    </li>
                @endcan

                @can('Categories')
                    <li>
                        <a href="{{route('admin.categories.index')}}" class="waves-effect"><i
                                class="zmdi zmdi-input-composite"></i> <span> الاقسام  </span> </a>
                    </li>
                @endcan

                @can('Blogs')
                    <li>
                        <a href="{{route('admin.blogs.index')}}" class="waves-effect"><i
                                class="zmdi zmdi-blogger"></i> <span> الاخبار  </span> </a>
                    </li>
                @endcan

{{--                @can('Services')--}}
{{--                    <li>--}}
{{--                        <a href="{{route('admin.services.index')}}" class="waves-effect"><i--}}
{{--                                class="zmdi zmdi-apps"></i> <span> الخدمات  </span> </a>--}}
{{--                    </li>--}}
{{--                @endcan--}}

                @can('Providers')
                    <li class="has_sub">
                        <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-recycle"></i> <span> مقدمى الخدمات </span> <span class="menu-arrow"></span></a>
                        <ul class="list-unstyled">
                            <li><a href="{{route('admin.providers.index')}}"> مقدمى الخدمات</a></li>
                            <li><a href="{{route('admin.verifications.index')}}">التحقق</a></li>
                            <li><a href="{{route('admin.providers-notifications.index')}}"> اشعارات مقدمى الخدمات</a></li>

                        </ul>
                    </li>
                @endcan

                @can('Carts')
                    <li>
                        <a href="{{route('admin.orders.index')}}" class="waves-effect"><i
                                class="zmdi zmdi-shopping-cart-plus"></i> <span> الطلبات </span> </a>
                    </li>
                @endcan

                @can('Reports')
                    <li>
                        <a href="{{route('admin.reports.index')}}" class="waves-effect"><i
                                class="zmdi zmdi-block-alt"></i> <span> البلاغات </span> </a>
                    </li>
                @endcan

                @can('Settings')
                    <li>
                        <a href="{{route('admin.settings.index')}}" class="waves-effect"><i
                                class="zmdi zmdi-settings"></i> <span> الاعدادات </span> </a>
                    </li>
                @endcan


            </ul>
            <div class="clearfix"></div>
        </div>
        <!-- Sidebar -->
        <div class="clearfix"></div>

    </div>

</div>
<!-- Left Sidebar End -->
