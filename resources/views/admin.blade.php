<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Управление сайтом</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/admin/plugins/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/admin/plugins/simple-line-icons/simple-line-icons.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/admin/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/admin/plugins/bootstrap-switch/css/bootstrap-switch.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/admin/plugins/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/admin/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css')}}" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <link href="{{asset('assets/admin/plugins/bootstrap-fileinput/bootstrap-fileinput.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/admin/plugins/morris/morris.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/admin/plugins/ion.rangeslider/css/ion.rangeSlider.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/admin/plugins/ion.rangeslider/css/ion.rangeSlider.skinFlat.css')}}" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN THEME GLOBAL STYLES -->
    <link href="{{asset('assets/admin/css/components.min.css')}}" rel="stylesheet" id="style_components" type="text/css" />
    <link href="{{asset('assets/admin/css/plugins.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- END THEME GLOBAL STYLES -->
    <!-- BEGIN THEME LAYOUT STYLES -->
    <link href="{{asset('assets/admin/css/layout.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/admin/css/themes/darkblue.min.css')}}" rel="stylesheet" type="text/css" id="style_color" />
    <link href="{{asset('assets/admin/css/custom.min.css')}}" rel="stylesheet" type="text/css" />
    <script src="{{asset('assets/admin/plugins/jquery.min.js')}}" type="text/javascript"></script>

    <!-- BEGIN CORE PLUGINS -->
    <script src="{{asset('assets/admin/plugins/bootstrap/js/bootstrap.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/admin/plugins/js.cookie.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/admin/plugins/jquery-slimscroll/jquery.slimscroll.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/admin/plugins/jquery.blockui.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/admin/plugins/bootstrap-switch/js/bootstrap-switch.min.js')}}" type="text/javascript"></script>
    <!-- END CORE PLUGINS -->
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script src="{{asset('assets/admin/plugins/bootbox/bootbox.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/admin/plugins/bootstrap-growl/jquery.bootstrap-growl.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/admin/plugins/ion.rangeslider/js/ion.rangeSlider.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/admin/plugins/datatables/datatables.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/admin/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/admin/plugins/morris/morris.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/admin/plugins/morris/raphael-min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/admin/plugins/counterup/jquery.waypoints.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/admin/plugins/counterup/jquery.counterup.min.js')}}" type="text/javascript"></script>


    <link data-require="jqueryui@*" data-semver="1.10.0" rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.10.0/css/smoothness/jquery-ui-1.10.0.custom.min.css" />
    <script data-require="jqueryui@*" data-semver="1.10.0" src="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.10.0/jquery-ui.js"></script>


    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN THEME GLOBAL SCRIPTS -->
    <script src="{{asset('assets/admin/scripts/app.min.js')}}" type="text/javascript"></script>
    <!-- END THEME GLOBAL SCRIPTS -->
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="{{asset('assets/admin/scripts/dashboard.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/admin/plugins/bootstrap-fileinput/bootstrap-fileinput.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/admin/scripts/ui-bootstrap-growl.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/admin/plugins/jquery-repeater/jquery.repeater.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/admin/scripts/form-repeater.min.js')}}" type="text/javascript"></script>
    <!-- END PAGE LEVEL SCRIPTS -->
    <!-- BEGIN THEME LAYOUT SCRIPTS -->
    <script src="{{asset('assets/admin/scripts/layout.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/admin/scripts/demo.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/admin/scripts/quick-sidebar.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/admin/scripts/quick-nav.min.js')}}" type="text/javascript"></script>
    <!-- END THEME LAYOUT SCRIPTS -->
    <!-- END HEAD -->

<body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white">
    <div class="page-wrapper">
        <div class="page-header navbar navbar-fixed-top">
            <div class="page-header-inner ">
                <div class="page-logo">
                    <a href="/admin">
                        <img src="{{asset('/img/logo-big.svg')}}" alt="logo" class="logo-default" / width="100px"> </a>
                    <div class="menu-toggler sidebar-toggler">
                        <span></span>
                    </div>
                </div>
                <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
                    <span></span>
                </a>
                <div class="top-menu">
                    <ul class="nav navbar-nav pull-right">
                        <li class="dropdown dropdown-user">
                            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                <img alt="" class="img-circle" src="{{ Auth::user()->avatar}}" />
                                <span class="username username-hide-on-mobile"> {{Auth::user()->username}} </span>
                                <i class="fa fa-angle-down"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-default">
                                <li>
                                    <a href="/"><i class="icon-login"></i> Вернуться на сайт </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="clearfix"> </div>
        <div class="page-container">
            <div class="page-sidebar-wrapper">
                <div class="page-sidebar navbar-collapse collapse">
                    <ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="false" data-slide-speed="200" style="padding-top: 20px">
                        <li class="sidebar-toggler-wrapper hide">
                            <div class="sidebar-toggler">
                                <span></span>
                            </div>
                        </li>
                        <li class="nav-item start active open">
                            <a href="/admin" class="nav-link nav-toggle">
                                <i class="icon-home"></i>
                                <span class="title">Панель управления</span>
                                <span class="selected"></span>
                            </a>
                        </li>
                        <li class="heading">
                            <h3 class="uppercase">Управление сайтом</h3>
                        </li>
                        <li class="nav-item  ">
                            <a href="/admin/users" class="nav-link nav-toggle">
                                <i class="icon-users"></i>
                                <span class="title">Пользователи</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="/admin/payments" class="nav-link nav-toggle">
                                <i class="fa fa-database" aria-hidden="true"></i>
                                <span class="title">Последние пополнения</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="/admin/withdraw" class="nav-link nav-toggle">
                                <i class="icon-star"></i>
                                <span class="title">Выводы</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="/admin/settings" class="nav-link nav-toggle">
                                <i class="fa fa-cog" aria-hidden="true"></i>
                                <span class="title">Настройки</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="/admin/opinions" class="nav-link nav-toggle">
                                <i class="fa fa-user-secret" aria-hidden="true"></i>
                                <span class="title">Отзывы</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="icon-equalizer"></i>
                                <span class="title">Тикеты</span>
                                <span class="arrow open"></span>
                            </a>
                            <ul class="sub-menu">
                                <li class="nav-item start ">
                                    <a href="/admin/tickets/new" class="nav-link ">
                                        <i class="icon-note"></i>
                                        <span class="title">Новые</span>
                                    </a>
                                </li>
                                <li class="nav-item start ">
                                    <a href="/admin/tickets/in_process" class="nav-link ">
                                        <i class="icon-grid"></i>
                                        <span class="title">Входящие</span>
                                    </a>
                                </li>
                                <li class="nav-item start ">
                                    <a href="/admin/tickets/sent" class="nav-link ">
                                        <i class="icon-grid"></i>
                                        <span class="title">Отправленные</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item  ">
                            <a href="/admin/clear" class="nav-link nav-toggle">
                                <i class="fa fa-user-secret" aria-hidden="true"></i>
                                <span class="title">Очистить кеш перевода</span>
                            </a>
                        </li>
                        <li class="heading">
                            <h3 class="uppercase">Кейсы</h3>
                        </li>
                        <li class="nav-item  ">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="icon-equalizer"></i>
                                <span class="title">Управление кейсами</span>
                                <span class="arrow open"></span>
                            </a>
                            <ul class="sub-menu">
                                <li class="nav-item start ">
                                    <a href="/admin/new_case" class="nav-link ">
                                        <i class="icon-note"></i>
                                        <span class="title">Добавить</span>
                                    </a>
                                </li>
                                <li class="nav-item start ">
                                    <a href="/admin/cases" class="nav-link ">
                                        <i class="icon-grid"></i>
                                        <span class="title">Список кейсов</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item  ">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="icon-equalizer"></i>
                                <span class="title">Управление тикетами</span>
                                <span class="arrow open"></span>
                            </a>
                            <ul class="sub-menu">
                                <li class="nav-item start ">
                                    <a href="/admin/tickets/categories" class="nav-link ">
                                        <i class="icon-note"></i>
                                        <span class="title">Категории</span>
                                    </a>
                                </li>
                                <li class="nav-item start ">
                                    <a href="/admin/tickets/templates" class="nav-link ">
                                        <i class="icon-grid"></i>
                                        <span class="title">Шаблоны</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="page-content-wrapper">
                <div class="page-content">
                    @yield('content')
                </div>
            </div>
        </div>
        <div class="page-footer">
            <div class="scroll-to-top">
                <i class="icon-arrow-up"></i>
            </div>
        </div>
    </div>

</body>

</html>