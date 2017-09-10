<div class="main_container">
    <div class="col-md-3 left_col">
        <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
                <a  class="site_title"><img src="<?php echo asset('public/images/manajemen.png') ?>" width="32px;"></i> <span>Manajemen Toko</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile" >
                <div class="profile_pic">
                    <a href="{{ url('profil/') }}"><img src="<?php echo asset('storage/app/images/').'/'?>{{Auth::user()->foto}}" alt="..." class="img-circle profile_img"></a>
                </div>
                <div class="profile_info">
                    <span>Selamat Datang,</span>
                    <h2>{{Auth::user()->name}}</h2>
                </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu" style="margin-top: 70px;">
                <div class="menu_section">
                    <ul class="nav side-menu">
                    

                    @if(Auth::user()->level_id == 1 || Auth::user()->level_id == 2 || Auth::user()->level_id == 3)

                    <?php if($halaman == "home"){ ?>
                        <li class="active"><a href="<?php echo url('home') ?>"><i class="fa fa-home"></i> Home</span></a></li>
                    <?php } else { ?> 
                        <li><a href="<?php echo url('home') ?>"><i class="fa fa-home"></i> Home</span></a></li>
                    <?php } ?>

                    <?php if($halaman == "user"){ ?>
                        <li class="active"><a><i class="fa fa-users"></i> User <span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                                <li><a href="<?php echo url('/user/create') ?>">Create</a></li>
                                <li><a href="<?php echo url('/user/show') ?>">View</a></li>
                            </ul>
                        </li>
                    <?php } else { ?>
                        <li><a><i class="fa fa-users"></i> User <span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                                <li><a href="<?php echo url('/user/create') ?>">Create</a></li>
                                <li><a href="<?php echo url('/user/show') ?>">View</a></li>
                            </ul>
                        </li>
                    <?php } ?>

                    <?php if($halaman == "lisensi"){ ?>
                        <li class="active"><a><i class="fa fa-users"></i> Lisensi <span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                                <li><a href="<?php echo url('/lisensi/create') ?>">Create</a></li>
                                <li><a href="<?php echo url('/lisensi/show') ?>">View</a></li>
                            </ul>
                        </li>
                    <?php } else { ?>
                        <li><a><i class="fa fa-users"></i> Lisensi <span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                                <li><a href="<?php echo url('/lisensi/create') ?>">Create</a></li>
                                <li><a href="<?php echo url('/lisensi/show') ?>">View</a></li>
                            </ul>
                        </li>
                    <?php } ?>

                    <?php if($halaman == "toko"){ ?>
                        <li class="active"><a><i class="fa fa-users"></i> Toko <span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                                <li><a href="<?php echo url('/toko/create') ?>">Create</a></li>
                                <li><a href="<?php echo url('/toko/show') ?>">View</a></li>
                            </ul>
                        </li>
                    <?php } else { ?>
                        <li><a><i class="fa fa-users"></i> Toko <span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                                <li><a href="<?php echo url('/toko/create') ?>">Create</a></li>
                                <li><a href="<?php echo url('/toko/show') ?>">View</a></li>
                            </ul>
                        </li>
                    <?php } ?>

                    @elseif(Auth::user()->level_id == 2)
                        <?php if($halaman == "home"){ ?>
                        <li class="active"><a href="<?php echo url('home') ?>"><i class="fa fa-home"></i> Home</span></a></li>
                        <?php } else { ?> 
                            <li><a href="<?php echo url('home') ?>"><i class="fa fa-home"></i> Home</span></a></li>
                        <?php } ?>
                    @endif
                    </ul>
                </div>
                

            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
                <a data-toggle="tooltip" data-placement="top" title="Settings">
                    <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                </a>
                <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                    <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
                </a>
                <a data-toggle="tooltip" data-placement="top" title="Lock">
                    <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
                </a>
                <a data-toggle="tooltip" data-placement="top" title="Logout">
                    <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                </a>
            </div>
            <!-- /menu footer buttons -->
        </div>
    </div>

    <!-- top navigation -->
    <div class="top_nav">
        <div class="nav_menu">
            <nav>
                <div class="nav toggle">
                    <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                </div>

                <ul class="nav navbar-nav navbar-right">
                    @if (Auth::guest())
                            <li><a href="{{ url('/login') }}">Login</a></li>
                            <li><a href="{{ url('/register') }}">Register</a></li>
                        @else
                    <li class="">
                        <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            <img src="<?php echo asset('storage/app/images/').'/'?>{{Auth::user()->foto}}" alt="">{{ Auth::user()->name }}
                            <span class=" fa fa-angle-down"></span>
                        </a>
                        
                        <ul class="dropdown-menu dropdown-usermenu pull-right">
                            
                            <li><a href="<?php echo url('profil/') ?>"> Profile</a></li>
                            <li>
                            <a href="{{ url('/logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                            </li>
                        </ul>    
                    </li>
                        @endif
                    
                </ul>
            </nav>
        </div>
    </div>
    <!-- /top navigation -->
