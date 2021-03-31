@extends('main')

@section('content')
<!-- BEGIN PAGE CONTENT BODY -->
<div class="page-content">
    <div class="container">
        <!-- BEGIN PAGE CONTENT INNER -->
        <div class="page-content-inner">
            <div class="row">
                <div class="col-md-12">
                    <!-- BEGIN PROFILE SIDEBAR -->
					@include('usuarios.partials.sidebar')
                    <!-- END BEGIN PROFILE SIDEBAR -->
                    <!-- BEGIN PROFILE CONTENT -->
                    <div class="profile-content">
                        <div class="row">
                            <div class="col-md-6">
                                <!-- BEGIN PORTLET -->
                                <div class="portlet light ">
                                    <div class="portlet-title">
                                        <div class="caption caption-md">
                                            <i class="icon-bar-chart theme-font hide"></i>
                                            <span class="caption-subject font-blue-madison bold uppercase">Tu actividad</span>
                                            <span class="caption-helper hide">weekly stats...</span>
                                        </div>
                                        <div class="actions">
                                            <div class="btn-group btn-group-devided" data-toggle="buttons">
                                                <label class="btn btn-transparent grey-salsa btn-circle btn-sm active">
                                                    <input type="radio" name="options" class="toggle" id="option1">Today</label>
                                                <label class="btn btn-transparent grey-salsa btn-circle btn-sm">
                                                    <input type="radio" name="options" class="toggle" id="option2">Week</label>
                                                <label class="btn btn-transparent grey-salsa btn-circle btn-sm">
                                                    <input type="radio" name="options" class="toggle" id="option2">Month</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="portlet-body">
                                        <div class="row number-stats margin-bottom-30">
                                            <div class="col-md-6 col-sm-6 col-xs-6">
                                                <div class="stat-left">
                                                    <div class="stat-chart">
                                                        <!-- do not line break "sparkline_bar" div. sparkline chart has an issue when the container div has line break -->
                                                        <div id="sparkline_bar"></div>
                                                    </div>
                                                    <div class="stat-number">
                                                        <div class="title"> Total </div>
                                                        <div class="number"> 2460 </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-6 col-xs-6">
                                                <div class="stat-right">
                                                    <div class="stat-chart">
                                                        <!-- do not line break "sparkline_bar" div. sparkline chart has an issue when the container div has line break -->
                                                        <div id="sparkline_bar2"></div>
                                                    </div>
                                                    <div class="stat-number">
                                                        <div class="title"> New </div>
                                                        <div class="number"> 719 </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="table-scrollable table-scrollable-borderless">
                                            <table class="table table-hover table-light">
                                                <thead>
                                                    <tr class="uppercase">
                                                        <th colspan="2"> MEMBER </th>
                                                        <th> Earnings </th>
                                                        <th> CASES </th>
                                                        <th> CLOSED </th>
                                                        <th> RATE </th>
                                                    </tr>
                                                </thead>
                                                <tr>
                                                    <td class="fit">
                                                        <img class="user-pic" src="../assets/pages/media/users/avatar4.jpg"> </td>
                                                    <td>
                                                        <a href="javascript:;" class="primary-link">Brain</a>
                                                    </td>
                                                    <td> $345 </td>
                                                    <td> 45 </td>
                                                    <td> 124 </td>
                                                    <td>
                                                        <span class="bold theme-font">80%</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="fit">
                                                        <img class="user-pic" src="../assets/pages/media/users/avatar5.jpg"> </td>
                                                    <td>
                                                        <a href="javascript:;" class="primary-link">Nick</a>
                                                    </td>
                                                    <td> $560 </td>
                                                    <td> 12 </td>
                                                    <td> 24 </td>
                                                    <td>
                                                        <span class="bold theme-font">67%</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="fit">
                                                        <img class="user-pic" src="../assets/pages/media/users/avatar6.jpg"> </td>
                                                    <td>
                                                        <a href="javascript:;" class="primary-link">Tim</a>
                                                    </td>
                                                    <td> $1,345 </td>
                                                    <td> 450 </td>
                                                    <td> 46 </td>
                                                    <td>
                                                        <span class="bold theme-font">98%</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="fit">
                                                        <img class="user-pic" src="../assets/pages/media/users/avatar7.jpg"> </td>
                                                    <td>
                                                        <a href="javascript:;" class="primary-link">Tom</a>
                                                    </td>
                                                    <td> $645 </td>
                                                    <td> 50 </td>
                                                    <td> 89 </td>
                                                    <td>
                                                        <span class="bold theme-font">58%</span>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <!-- END PORTLET -->
                            </div>
                            <div class="col-md-6">
                                <!-- BEGIN PORTLET -->
                                <div class="portlet light ">
                                    <div class="portlet-title tabbable-line">
                                        <div class="caption caption-md">
                                            <i class="icon-globe theme-font hide"></i>
                                            <span class="caption-subject font-blue-madison bold uppercase">Notificaciones</span>
                                        </div>
                                    </div>
                                    <div class="portlet-body">
                                        <!--BEGIN TABS-->
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="tab_1_1">
                                                <div class="scroller" style="height: 320px;" data-always-visible="1" data-rail-visible1="0" data-handle-color="#D7DCE2">
                                                    <ul class="feeds">
                                                        <li>
                                                            <a href="javascript:;">
                                                                <div class="col1">
                                                                    <div class="cont">
                                                                        <div class="cont-col1">
                                                                            <div class="label label-sm label-success">
                                                                                <i class="fa fa-bell-o"></i>
                                                                            </div>
                                                                        </div>
                                                                        <div class="cont-col2">
                                                                            <div class="desc"> New user registered </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col2">
                                                                    <div class="date"> Just now </div>
                                                                </div>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="javascript:;">
                                                                <div class="col1">
                                                                    <div class="cont">
                                                                        <div class="cont-col1">
                                                                            <div class="label label-sm label-success">
                                                                                <i class="fa fa-bell-o"></i>
                                                                            </div>
                                                                        </div>
                                                                        <div class="cont-col2">
                                                                            <div class="desc"> New order received </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col2">
                                                                    <div class="date"> 10 mins </div>
                                                                </div>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <div class="col1">
                                                                <div class="cont">
                                                                    <div class="cont-col1">
                                                                        <div class="label label-sm label-danger">
                                                                            <i class="fa fa-bolt"></i>
                                                                        </div>
                                                                    </div>
                                                                    <div class="cont-col2">
                                                                        <div class="desc"> Order #24DOP4 has been rejected.
                                                                            <span class="label label-sm label-danger "> Take action
                                                                                <i class="fa fa-share"></i>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col2">
                                                                <div class="date"> 24 mins </div>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <a href="javascript:;">
                                                                <div class="col1">
                                                                    <div class="cont">
                                                                        <div class="cont-col1">
                                                                            <div class="label label-sm label-success">
                                                                                <i class="fa fa-bell-o"></i>
                                                                            </div>
                                                                        </div>
                                                                        <div class="cont-col2">
                                                                            <div class="desc"> New user registered </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col2">
                                                                    <div class="date"> Just now </div>
                                                                </div>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="javascript:;">
                                                                <div class="col1">
                                                                    <div class="cont">
                                                                        <div class="cont-col1">
                                                                            <div class="label label-sm label-success">
                                                                                <i class="fa fa-bell-o"></i>
                                                                            </div>
                                                                        </div>
                                                                        <div class="cont-col2">
                                                                            <div class="desc"> New user registered </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col2">
                                                                    <div class="date"> Just now </div>
                                                                </div>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="javascript:;">
                                                                <div class="col1">
                                                                    <div class="cont">
                                                                        <div class="cont-col1">
                                                                            <div class="label label-sm label-success">
                                                                                <i class="fa fa-bell-o"></i>
                                                                            </div>
                                                                        </div>
                                                                        <div class="cont-col2">
                                                                            <div class="desc"> New user registered </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col2">
                                                                    <div class="date"> Just now </div>
                                                                </div>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="javascript:;">
                                                                <div class="col1">
                                                                    <div class="cont">
                                                                        <div class="cont-col1">
                                                                            <div class="label label-sm label-success">
                                                                                <i class="fa fa-bell-o"></i>
                                                                            </div>
                                                                        </div>
                                                                        <div class="cont-col2">
                                                                            <div class="desc"> New user registered </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col2">
                                                                    <div class="date"> Just now </div>
                                                                </div>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="javascript:;">
                                                                <div class="col1">
                                                                    <div class="cont">
                                                                        <div class="cont-col1">
                                                                            <div class="label label-sm label-success">
                                                                                <i class="fa fa-bell-o"></i>
                                                                            </div>
                                                                        </div>
                                                                        <div class="cont-col2">
                                                                            <div class="desc"> New user registered </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col2">
                                                                    <div class="date"> Just now </div>
                                                                </div>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="javascript:;">
                                                                <div class="col1">
                                                                    <div class="cont">
                                                                        <div class="cont-col1">
                                                                            <div class="label label-sm label-success">
                                                                                <i class="fa fa-bell-o"></i>
                                                                            </div>
                                                                        </div>
                                                                        <div class="cont-col2">
                                                                            <div class="desc"> New user registered </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col2">
                                                                    <div class="date"> Just now </div>
                                                                </div>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="javascript:;">
                                                                <div class="col1">
                                                                    <div class="cont">
                                                                        <div class="cont-col1">
                                                                            <div class="label label-sm label-success">
                                                                                <i class="fa fa-bell-o"></i>
                                                                            </div>
                                                                        </div>
                                                                        <div class="cont-col2">
                                                                            <div class="desc"> New user registered </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col2">
                                                                    <div class="date"> Just now </div>
                                                                </div>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <!--END TABS-->
                                    </div>
                                </div>
                                <!-- END PORTLET -->
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <!-- BEGIN PORTLET -->
                                <div class="portlet light ">
                                    <div class="portlet-title">
                                        <div class="caption caption-md">
                                            <i class="icon-bar-chart theme-font hide"></i>

                                            <span class="caption-subject font-blue-madison bold uppercase">Tickets</span>
                                            <span class="caption-helper">{{ $open_tickets_count }} pendientes</span>
                                        </div>
                                    </div>
                                    <div class="portlet-body">
                                        <div class="scroller" style="height: 305px;" data-always-visible="1" data-rail-visible1="0" data-handle-color="#D7DCE2">
                                            <div class="general-item-list">
                                            	@if($open_tickets_count > 0)
                                                    @foreach($open_tickets as $ticket_item )
                                                        <div class="item">
                                                            <div class="item-head">
                                                                <div class="item-details">
                                                                    <img class="item-pic" src="{{ $ticket_item->user->avatar() }}">
                                                                    <a href="" class="item-name primary-link">{{ $ticket_item->user->name }}</a>
                                                                    <span class="item-label">3 hrs ago</span>
                                                                </div>
                                                                <span class="item-status">
                                                                    <span class="badge badge-empty badge-success"></span> Open</span>
                                                            </div>
                                                            <div class="item-body"> {{ $ticket_item->subject }} </div>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- END PORTLET -->
                            </div>
                            <div class="col-md-6">
                                <!-- BEGIN PORTLET -->
                                <div class="portlet light  tasks-widget">
                                    <div class="portlet-title">
                                        <div class="caption caption-md">
                                            <i class="icon-bar-chart theme-font hide"></i>
                                            <span class="caption-subject font-blue-madison bold uppercase">Tareas</span>
                                            <span class="caption-helper">16 pendientes</span>
                                        </div>
                                    </div>
                                    <div class="portlet-body">
                                        <div class="task-content">
                                            <div class="scroller" style="height: 282px;" data-always-visible="1" data-rail-visible1="0" data-handle-color="#D7DCE2">
                                                <!-- START TASK LIST -->
                                                <ul class="task-list">
                                                    <li>
                                                        <div class="task-checkbox">
                                                            <input type="checkbox" class="liChild" value="" /> </div>
                                                        <div class="task-title">
                                                            <span class="task-title-sp"> Company Staff Meeting </span>
                                                            <span class="label label-sm label-success">Cruise</span>
                                                            <span class="task-bell">
                                                                <i class="fa fa-bell-o"></i>
                                                            </span>
                                                        </div>
                                                        <div class="task-config">
                                                            <div class="task-config-btn btn-group">
                                                                <a class="btn btn-sm default" href="javascript:;" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                                                    <i class="fa fa-cog"></i>
                                                                    <i class="fa fa-angle-down"></i>
                                                                </a>
                                                                <ul class="dropdown-menu pull-right">
                                                                    <li>
                                                                        <a href="javascript:;">
                                                                            <i class="fa fa-check"></i> Complete </a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="javascript:;">
                                                                            <i class="fa fa-pencil"></i> Edit </a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="javascript:;">
                                                                            <i class="fa fa-trash-o"></i> Cancel </a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="last-line">
                                                        <div class="task-checkbox">
                                                            <input type="checkbox" class="liChild" value="" /> </div>
                                                        <div class="task-title">
                                                            <span class="task-title-sp"> KeenThemes Investment Discussion </span>
                                                            <span class="label label-sm label-warning">KeenThemes </span>
                                                        </div>
                                                        <div class="task-config">
                                                            <div class="task-config-btn btn-group">
                                                                <a class="btn btn-sm default" href="javascript:;" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                                                    <i class="fa fa-cog"></i>
                                                                    <i class="fa fa-angle-down"></i>
                                                                </a>
                                                                <ul class="dropdown-menu pull-right">
                                                                    <li>
                                                                        <a href="javascript:;">
                                                                            <i class="fa fa-check"></i> Complete </a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="javascript:;">
                                                                            <i class="fa fa-pencil"></i> Edit </a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="javascript:;">
                                                                            <i class="fa fa-trash-o"></i> Cancel </a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                                <!-- END START TASK LIST -->
                                            </div>
                                        </div>
                                        <div class="task-footer">
                                            <div class="btn-arrow-link pull-right">
                                                <a href="javascript:;">Ver todas las tareas</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- END PORTLET -->
                            </div>
                        </div>
                    </div>
                    <!-- END PROFILE CONTENT -->
                </div>
            </div>
        </div>
        <!-- END PAGE CONTENT INNER -->
    </div>
</div><!-- END PAGE CONTENT BODY -->
@endsection