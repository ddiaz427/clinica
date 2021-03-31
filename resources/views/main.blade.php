<!DOCTYPE html>

<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->

<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->

<!--[if !IE]><!-->

<html lang="en">

    <!--<![endif]-->

    <!-- BEGIN HEAD -->



    <head>

        <?php header('Content-type: text/html; charset=utf-8'); ?>
        <meta http-equiv="Content-Type" content="text/html" charset="utf-8" />

        <title>{{ isset($titulo_pagina) ? $titulo_pagina : '' }}</title>

        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <meta content="width=device-width, initial-scale=1" name="viewport" />

        <meta content="" name="description" />

        <meta content="" name="author" />

        <!-- BEGIN GLOBAL MANDATORY STYLES -->

        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />

        <link href="{{ asset('assets/glob/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />

        <link href="{{ asset('assets/glob/plugins/simple-line-icons/simple-line-icons.min.css') }}" rel="stylesheet" type="text/css" />

        <link href="{{ asset('assets/glob/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />

        <link href="{{ asset('assets/glob/plugins/uniform/css/uniform.default.css') }}" rel="stylesheet" type="text/css" />

        <link href="{{ asset('assets/glob/plugins/bootstrap-switch/css/bootstrap-switch.min.css') }}" rel="stylesheet" type="text/css" />

        <!-- END GLOBAL MANDATORY STYLES -->

        <!-- BEGIN PAGE LEVEL PLUGINS -->

        <link href="{{ asset('assets/glob/plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />

        <link href="{{ asset('assets/glob/plugins/select2/css/select2-bootstrap.min.css') }}" rel="stylesheet" type="text/css" />

        <link href="{{ asset('assets/glob/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}" rel="stylesheet" type="text/css" />

        <link href="{{ asset('assets/glob/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css') }}" rel="stylesheet" type="text/css" />

        <link href="{{ asset('assets/glob/plugins/bootstrap-markdown/css/bootstrap-markdown.min.css') }}" rel="stylesheet" type="text/css" />

        <link href="{{ asset('assets/glob/plugins/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />

        <link href="{{ asset('assets/apps/css/inbox.min.css') }}" rel="stylesheet" type="text/css" />

        <link href="{{ asset('assets/glob/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') }}" rel="stylesheet" type="text/css" />

        <link href="{{ asset('assets/glob/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css') }}" rel="stylesheet" type="text/css" />

        <link href="{{ asset('assets/glob/plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />

        <link href="{{ asset('assets/glob/plugins/select2/css/select2-bootstrap.min.css') }}" rel="stylesheet" type="text/css" />

        <link href="{{ asset('assets/glob/plugins/bootstrap-fileinput/bootstrap-fileinput.css') }}" rel="stylesheet" type="text/css" />

        <link href="{{ asset('assets/glob/plugins/icheck/skins/all.css') }}" rel="stylesheet" type="text/css" />
        
        <link href="{{ asset('assets/pages/css/profile.min.css') }}" rel="stylesheet" type="text/css" />

       <!-- END PAGE LEVEL PLUGINS -->

        <!-- BEGIN THEME GLOBAL STYLES -->

        <link href="{{ asset('assets/glob/css/components.css') }}" rel="stylesheet" id="style_components" type="text/css" />

        <link href="{{ asset('assets/glob/css/plugins.css') }}" rel="stylesheet" type="text/css" />

        <!-- END THEME GLOBAL STYLES -->

        <!-- BEGIN THEME LAYOUT STYLES -->

        <link href="{{ asset('assets/layouts/layout3/css/layout.min.css') }}" rel="stylesheet" type="text/css" />

        <link href="{{ asset('assets/layouts/layout3/css/themes/default.min.css') }}" rel="stylesheet" type="text/css" id="style_color" />

        <link href="{{ asset('assets/layouts/layout3/css/custom.min.css') }}" rel="stylesheet" type="text/css" />

        <link href="{{ asset('assets/glob/plugins/typeahead/typeahead.css') }}" rel="stylesheet" type="text/css" />

        <link href="{{ asset('assets/glob/plugins/jquery-ui/jquery-ui.min.css') }}" rel="stylesheet" type="text/css" />

        <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/css/stylestree.css') }}" rel="stylesheet" type="text/css" />

        <!-- END THEME LAYOUT STYLES -->

		@yield('css')



        <link rel="shortcut icon" href="favicon.ico" />
    </head>

    <!-- END HEAD -->


    <body class="page-container-bg-solid page-boxed">

        <!-- BEGIN HEADER -->

        <div class="page-header">

            <!-- BEGIN HEADER TOP -->

            <div class="page-header-top" style="">

                <div class="container">

                    <!-- BEGIN LOGO -->

                    <div class="page-logo">

                        <a href="{{ route('home') }}">

                            <img style="width: 70px;" src="{{ asset('images/logo.png') }}" alt="logo" class="logo-default">

                        </a>

                    </div>

                    <!-- END LOGO -->

                    <!-- BEGIN RESPONSIVE MENU TOGGLER -->

                    <a href="javascript:;" class="menu-toggler"></a>

                    <!-- END RESPONSIVE MENU TOGGLER -->

                    <!-- BEGIN TOP NAVIGATION MENU -->

                    <div class="top-menu">

                        <ul class="nav navbar-nav pull-right">

                            <!-- BEGIN NOTIFICATION DROPDOWN -->

                            <li class="dropdown dropdown-extended dropdown-notification dropdown-dark" id="header_notification_bar">

                                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">

                                    <i class="icon-bell"></i>

                                    <span class="badge badge-default">7</span>

                                </a>

                                <ul class="dropdown-menu">

                                    <li class="external">

                                        <h3>You have

                                            <strong>12 pending</strong> tasks</h3>

                                        <a href="app_todo.html">view all</a>

                                    </li>

                                    <li>

                                        <ul class="dropdown-menu-list scroller" style="height: 250px;" data-handle-color="#637283">

                                            <li>

                                                <a href="javascript:;">

                                                    <span class="time">just now</span>

                                                    <span class="details">

                                                        <span class="label label-sm label-icon label-success">

                                                            <i class="fa fa-plus"></i>

                                                        </span> New user registered. </span>

                                                </a>

                                            </li>

                                            <li>

                                                <a href="javascript:;">

                                                    <span class="time">3 mins</span>

                                                    <span class="details">

                                                        <span class="label label-sm label-icon label-danger">

                                                            <i class="fa fa-bolt"></i>

                                                        </span> Server #12 overloaded. </span>

                                                </a>

                                            </li>

                                            <li>

                                                <a href="javascript:;">

                                                    <span class="time">10 mins</span>

                                                    <span class="details">

                                                        <span class="label label-sm label-icon label-warning">

                                                            <i class="fa fa-bell-o"></i>

                                                        </span> Server #2 not responding. </span>

                                                </a>

                                            </li>

                                            <li>

                                                <a href="javascript:;">

                                                    <span class="time">14 hrs</span>

                                                    <span class="details">

                                                        <span class="label label-sm label-icon label-info">

                                                            <i class="fa fa-bullhorn"></i>

                                                        </span> Application error. </span>

                                                </a>

                                            </li>

                                            <li>

                                                <a href="javascript:;">

                                                    <span class="time">2 days</span>

                                                    <span class="details">

                                                        <span class="label label-sm label-icon label-danger">

                                                            <i class="fa fa-bolt"></i>

                                                        </span> Database overloaded 68%. </span>

                                                </a>

                                            </li>

                                            <li>

                                                <a href="javascript:;">

                                                    <span class="time">3 days</span>

                                                    <span class="details">

                                                        <span class="label label-sm label-icon label-danger">

                                                            <i class="fa fa-bolt"></i>

                                                        </span> A user IP blocked. </span>

                                                </a>

                                            </li>

                                            <li>

                                                <a href="javascript:;">

                                                    <span class="time">4 days</span>

                                                    <span class="details">

                                                        <span class="label label-sm label-icon label-warning">

                                                            <i class="fa fa-bell-o"></i>

                                                        </span> Storage Server #4 not responding dfdfdfd. </span>

                                                </a>

                                            </li>

                                            <li>

                                                <a href="javascript:;">

                                                    <span class="time">5 days</span>

                                                    <span class="details">

                                                        <span class="label label-sm label-icon label-info">

                                                            <i class="fa fa-bullhorn"></i>

                                                        </span> System Error. </span>

                                                </a>

                                            </li>

                                            <li>

                                                <a href="javascript:;">

                                                    <span class="time">9 days</span>

                                                    <span class="details">

                                                        <span class="label label-sm label-icon label-danger">

                                                            <i class="fa fa-bolt"></i>

                                                        </span> Storage server failed. </span>

                                                </a>

                                            </li>

                                        </ul>

                                    </li>

                                </ul>

                            </li>

                            <!-- END NOTIFICATION DROPDOWN -->


                            <li class="droddown dropdown-separator">

                                <span class="separator"></span>

                            </li>

                            <!-- BEGIN INBOX DROPDOWN -->

                            <li class="dropdown dropdown-extended dropdown-inbox dropdown-dark" id="header_inbox_bar">

                                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">

                                    <span class="circle">3</span>

                                    <span class="corner"></span>

                                </a>

                                <ul class="dropdown-menu">

                                    <li class="external">

                                        <h3>You have

                                            <strong>7 New</strong> Messages</h3>

                                        <a href="app_inbox.html">view all</a>

                                    </li>

                                    <li>

                                        <ul class="dropdown-menu-list scroller" style="height: 275px;" data-handle-color="#637283">

                                            <li>

                                                <a href="#">

                                                    <span class="photo">

                                                        <img src="{{ asset('assets/layouts/layout3/img/avatar2.jpg') }}" class="img-circle" alt=""> </span>

                                                    <span class="subject">

                                                        <span class="from"> Lisa Wong </span>

                                                        <span class="time">Just Now </span>

                                                    </span>

                                                    <span class="message"> Vivamus sed auctor nibh congue nibh. auctor nibh auctor nibh... </span>

                                                </a>

                                            </li>

                                            <li>

                                                <a href="#">

                                                    <span class="photo">

                                                        <img src="{{ asset('assets/layouts/layout3/img/avatar3.jpg') }}" class="img-circle" alt=""> </span>

                                                    <span class="subject">

                                                        <span class="from"> Richard Doe </span>

                                                        <span class="time">16 mins </span>

                                                    </span>

                                                    <span class="message"> Vivamus sed congue nibh auctor nibh congue nibh. auctor nibh auctor nibh... </span>

                                                </a>

                                            </li>

                                            <li>

                                                <a href="#">

                                                    <span class="photo">

                                                        <img src="{{ asset('assets/layouts/layout3/img/avatar1.jpg') }}" class="img-circle" alt=""> </span>

                                                    <span class="subject">

                                                        <span class="from"> Bob Nilson </span>

                                                        <span class="time">2 hrs </span>

                                                    </span>

                                                    <span class="message"> Vivamus sed nibh auctor nibh congue nibh. auctor nibh auctor nibh... </span>

                                                </a>

                                            </li>

                                            <li>

                                                <a href="#">

                                                    <span class="photo">

                                                        <img src="{{ asset('assets/layouts/layout3/img/avatar2.jpg') }}" class="img-circle" alt=""> </span>

                                                    <span class="subject">

                                                        <span class="from"> Lisa Wong </span>

                                                        <span class="time">40 mins </span>

                                                    </span>

                                                    <span class="message"> Vivamus sed auctor 40% nibh congue nibh... </span>

                                                </a>

                                            </li>

                                            <li>

                                                <a href="#">

                                                    <span class="photo">

                                                        <img src="{{ asset('assets/layouts/layout3/img/avatar3.jpg') }}" class="img-circle" alt=""> </span>

                                                    <span class="subject">

                                                        <span class="from"> Richard Doe </span>

                                                        <span class="time">46 mins </span>

                                                    </span>

                                                    <span class="message"> Vivamus sed congue nibh auctor nibh congue nibh. auctor nibh auctor nibh... </span>

                                                </a>

                                            </li>

                                        </ul>

                                    </li>

                                </ul>

                            </li>

                            <!-- END INBOX DROPDOWN -->

                            <!-- BEGIN USER LOGIN DROPDOWN -->

                            <li class="dropdown dropdown-user dropdown-dark">

                                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">

                                    <img alt="" class="img-circle" src="{{ asset(Auth::user()->avatar()) }}">

                                    <span class="username username-hide-mobile">{{ Auth::user()->name }}</span>

                                </a>

                                <ul class="dropdown-menu dropdown-menu-default">

                                    <li>

                                        <a href="{{ route('ver-perfil') }}">

                                            <i class="icon-user"></i> Mi perfil </a>

                                    </li>
                                    <li>

                                        <a href="{{ route('editar-perfil') }}">

                                            <i class="icon-user"></i> Editar perfil </a>

                                    </li>

                                    <li>

                                        <a href="app_inbox.html">

                                            <i class="icon-envelope-open"></i> Mensajes

                                            <span class="badge badge-danger"> 3 </span>

                                        </a>

                                    </li>

                                    <li class="divider"> </li>

                                    <li>

                                        <a href="{{ route('logout')}}">

                                            <i class="icon-key"></i> Cerrar sesión </a>

                                    </li>

                                </ul>

                            </li>

                            <!-- END USER LOGIN DROPDOWN -->


                        </ul>

                    </div>

                    <!-- END TOP NAVIGATION MENU -->

                </div>

            </div>

            <!-- END HEADER TOP -->

            <!-- BEGIN HEADER MENU -->

            <div class="page-header-menu">

                <div class="container">

                    <!-- BEGIN HEADER SEARCH BOX -->

                    <form class="search-form" action="page_general_search.html" method="GET">

                        <div class="input-group">

                            <input type="text" class="form-control" placeholder="Buscar" name="query">

                            <span class="input-group-btn">

                                <a href="javascript:;" class="btn submit">

                                    <i class="icon-magnifier"></i>

                                </a>

                            </span>

                        </div>

                    </form>

                    <!-- END HEADER SEARCH BOX -->

                    <!-- BEGIN MEGA MENU -->

                    <!-- DOC: Apply "hor-menu-light" class after the "hor-menu" class below to have a horizontal menu with white background -->

                    <!-- DOC: Remove data-hover="dropdown" and data-close-others="true" attributes below to disable the dropdown opening on mouse hover -->

                    <div class="hor-menu  ">

                        <ul class="nav navbar-nav">

								<?php $ult = "";?>

                                <?php if(Auth::user()->rol->modulos):?>

									<?php foreach(Auth::user()->rol->modulos as $mod):?>

                                        <?php if($ult != $mod->grupomodulos->id):?>

                                            <?php if($ult != ""):?>

                                                </ul>

                                            </li>

                                            <?php endif;?>

                                            <li class="menu-dropdown classic-menu-dropdown ">

                                            <a href="javascript:;"><?=($mod->grupomodulos->icono_modulo !=NULL)?'<i class="'.$mod->icono_modulo.'"></i>':''?> {{ $mod->grupomodulos->nombre }}

                                                <span class="arrow"></span> 

                                            </a>

                                            <ul class="dropdown-menu pull-left">

                                            <?php $ult = $mod->grupomodulos->id;?>

                                        <?php endif;?>

                                        <li class=" ">

                                            <a href="{{ route($mod->ruta_index) }}" class="nav-link  "><?=($mod->icono_modulo !=NULL)?'<i style="color:#fff;" class="'.$mod->icono_modulo.'"></i>':''?> <?=$mod->desc_modulo?> </a>

                                        </li>

                                    <?php endforeach;?>

                                <?php endif;?>

								</ul>

                            </li>

                        </ul>

                    </div>

                    <!-- END MEGA MENU -->

                </div>

            </div>

            <!-- END HEADER MENU -->

        </div>

        <!-- END HEADER -->

        <!-- BEGIN CONTAINER -->

        <div class="page-container">

            <!-- BEGIN CONTENT -->

            <div class="page-content-wrapper">

                <!-- BEGIN CONTENT BODY -->

                <!-- BEGIN PAGE HEAD-->

                <div class="page-head">

                    <div class="container">

                        <!-- BEGIN PAGE TITLE -->

                        <div class="page-title">

                            <h1>{{ isset($titulo_pagina) ? $titulo_pagina : '' }}</h1>

                        </div>

                        <!-- END PAGE TITLE -->

                    </div>

                </div>



                @yield('content')

            </div>

            <!-- END PAGE CONTENT BODY -->

            <!-- END CONTENT BODY -->

        </div>

          <!-- BEGIN FOOTER -->

        <!-- BEGIN INNER FOOTER -->

        <div class="page-footer">

            <div class="container"> 

            	<?php echo date('Y');?> &copy; Clinical.

            </div>

        </div>

        <div class="scroll-to-top">

            <i class="icon-arrow-up"></i>

        </div>

        <!-- END INNER FOOTER -->

        <!-- END FOOTER -->

        <!--[if lt IE 9]>

        <script src="{{ asset('assets/glob/plugins/respond.min.js') }}"></script>

        <script src="{{ asset('assets/glob/plugins/excanvas.min.js') }}"></script> 

        <![endif]-->

        <!-- BEGIN CORE PLUGINS -->
        <?php           //$app->make('url')->to('/');
                        //$app['url']->to('/');
                   ?>
        <script type="text/javascript">var base_url = '<?php echo App::make('url')->to('/'); ?>'</script>

        <script src="{{ asset('assets/glob/plugins/jquery.min.js') }}" type="text/javascript"></script>

        <script src="{{ asset('assets/glob/plugins/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>


        <script src="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.2/jquery-ui.js"></script>

        <script src="{{ asset('assets/glob/plugins/js.cookie.min.js') }}" type="text/javascript"></script>

        <script src="{{ asset('assets/glob/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js') }}" type="text/javascript"></script>

        <script src="{{ asset('assets/glob/plugins/jquery-slimscroll/jquery.slimscroll.min.js') }}" type="text/javascript"></script>

        <script src="{{ asset('assets/glob/plugins/jquery.blockui.min.js') }}" type="text/javascript"></script>

        <script src="{{ asset('assets/glob/plugins/uniform/jquery.uniform.min.js') }}" type="text/javascript"></script>

        <script src="{{ asset('assets/glob/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}" type="text/javascript"></script>

        <!-- END CORE PLUGINS -->

        <!-- BEGIN PAGE LEVEL PLUGINS -->

        <script src="{{ asset('assets/glob/scripts/datatable.js') }}" type="text/javascript"></script>

        <script src="{{ asset('assets/glob/plugins/datatables/datatables.min.js') }}" type="text/javascript"></script>

        <script src="{{ asset('assets/glob/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}" type="text/javascript"></script>

        <script src="{{ asset('assets/pages/scripts/table-datatables-responsive.js') }}" type="text/javascript"></script>

        <script src="{{ asset('assets/glob/plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script>

        <script src="{{ asset('assets/glob/plugins/jquery-validation/js/jquery.validate.min.js') }}" type="text/javascript"></script>

        <script src="{{ asset('assets/glob/plugins/jquery-validation/js/additional-methods.min.js') }}" type="text/javascript"></script>

        <script src="{{ asset('assets/glob/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}" type="text/javascript"></script>

        <script src="{{ asset('assets/glob/plugins/bootstrap-wysihtml5/wysihtml5-0.3.0.js') }}" type="text/javascript"></script>

        <script src="{{ asset('assets/glob/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.js') }}" type="text/javascript"></script>

        <script src="{{ asset('assets/glob/plugins/ckeditor/ckeditor.js') }}" type="text/javascript"></script>

        <script src="{{ asset('assets/glob/plugins/bootstrap-markdown/lib/markdown.js') }}" type="text/javascript"></script>

        <script src="{{ asset('assets/glob/plugins/bootstrap-markdown/js/bootstrap-markdown.js') }}" type="text/javascript"></script>

        <script src="{{ asset('assets/glob/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js') }}" type="text/javascript"></script>

        <script src="{{ asset('assets/glob/plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script>

        <script src="{{ asset('assets/glob/plugins/bootstrap-fileinput/bootstrap-fileinput.js') }}" type="text/javascript"></script>

        <script src="{{ asset('assets/glob/plugins/icheck/icheck.min.js') }}" type="text/javascript"></script>

        <script src="{{ asset('assets/glob/plugins/bootstrap-confirmation/bootstrap-confirmation.min.js') }}" type="text/javascript"></script>

        <script src="{{ asset('assets/glob/plugins/typeahead/handlebars.min.js') }}" type="text/javascript"></script>

        <script src="{{ asset('assets/glob/plugins/typeahead/typeahead.bundle.min.js') }}" type="text/javascript"></script>

        <script src="{{ asset('assets/glob/plugins/jquery-ui/jquery-ui.min.js') }}" type="text/javascript"></script>

        <!-- END PAGE LEVEL PLUGINS -->

        <!-- BEGIN THEME GLOBAL SCRIPTS -->

        <script src="{{ asset('assets/glob/scripts/app.min.js') }}" type="text/javascript"></script>

        <!-- END THEME GLOBAL SCRIPTS -->

        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src="{{ asset('assets/pages/scripts/components-select2.min.js') }}" type="text/javascript"></script>

        <script src="{{ asset('assets/pages/scripts/form-validation.js') }}" type="text/javascript"></script>

        <script src="{{ asset('assets/pages/scripts/form-icheck.min.js') }}" type="text/javascript"></script>

        <script src="{{ asset('assets/pages/scripts/components-typeahead.js') }}" type="text/javascript"></script>

        <script src="{{ asset('assets/pages/scripts/components-bootstrap-tagsinput.min.js') }}" type="text/javascript"></script>
       
        <!-- END PAGE LEVEL SCRIPTS -->

        <!-- BEGIN THEME LAYOUT SCRIPTS -->

        <script src="{{ asset('assets/layouts/layout3/scripts/layout.min.js') }}" type="text/javascript"></script>

        <script src="{{ asset('assets/layouts/layout3/scripts/demo.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/js/ajaxload.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/js/funciones.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/js/treeview.js') }}" type="text/javascript"></script>

        <!-- END THEME LAYOUT SCRIPTS -->

		@yield('scripts')

    </body>

</html>