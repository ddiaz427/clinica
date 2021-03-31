<div class="profile-sidebar">
    <!-- PORTLET MAIN -->
    <div class="portlet light profile-sidebar-portlet ">
        <!-- SIDEBAR USERPIC -->
        <div class="profile-userpic">
            <img src="{{ asset($user->avatar()) }}" class="img-responsive" alt="{{ $user->rol->nombre }}"> </div>
        <!-- END SIDEBAR USERPIC -->
        <!-- SIDEBAR USER TITLE -->
        <div class="profile-usertitle">
            <div class="profile-usertitle-name"> {{ $user->name }} </div>
            <div class="profile-usertitle-job"> {{ $user->rol->nombre }} </div>
        </div>
        <!-- END SIDEBAR USER TITLE -->
        <div class="profile-usermenu">
            <ul class="nav">
                <li>
                    <a href="{{ route('ver-perfil') }}">
                        <i class="icon-home"></i> Información </a>
                </li>
                <li class="active">
                    <a href="{{ route('editar-perfil') }}">
                        <i class="icon-settings"></i> Editar perfil </a>
                </li>
            </ul>
        </div>
        <!-- END MENU -->
    </div>
    <!-- END PORTLET MAIN -->
    <!-- PORTLET MAIN -->
    <div class="portlet light ">
        <!-- STAT -->
        <div class="row list-separated profile-stat">
            <div class="col-md-4 col-sm-4 col-xs-6">
                <div class="uppercase profile-stat-title"> {{ $tickets_count }} </div>
                <div class="uppercase profile-stat-text"> Tickets </div>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-6">
                <div class="uppercase profile-stat-title"> {{ $open_tickets_count }} </div>
                <div class="uppercase profile-stat-text"> Tickets abiertos </div>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-6">
                <div class="uppercase profile-stat-title"> {{ $closed_tickets_count }} </div>
                <div class="uppercase profile-stat-text"> Tickets cerrados </div>
            </div>
        </div>
        <!-- END STAT -->
        <div>
            <h4 class="profile-desc-title">Acerca de {{ $user->name }}</h4>
            <div class="margin-top-20 profile-desc-link">
                <i class="fa fa-phone"></i>
                <span>{{ $user->phone }}</span>
            </div>
            <div class="margin-top-20 profile-desc-link">
                <i class="fa fa-mobile"></i>
                <span>{{ $user->mobile }}</span>
            </div>
            <div class="margin-top-20 profile-desc-link">
                <i class="fa fa-fax"></i>
                <span>{{ $user->fax }}</span>
            </div>
        </div>
    </div>
    <!-- END PORTLET MAIN -->
</div>
