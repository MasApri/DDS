<div class="main_container">
    <div class="col-md-3 left_col">
        <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
                <a  class="site_title"><img src="<?php echo asset('public/images/bps.png') ?>" width="32px;"></i> <span>BPS Pacitan</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile" >
                <div class="profile_pic">
                    <a href="{{ url('profil/') }}"><img src="<?php echo asset('storage/app/images/') . '/' ?>{{Auth::user()->foto}}" alt="..." class="img-circle profile_img"></a>
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


                        @if(Auth::user()->role == 1)

                        <?php if ($halaman == "home") { ?>
                            <li class="active"><a href="<?php echo url('home') ?>"><i class="fa fa-home"></i> Home</span></a></li>
                        <?php } else { ?> 
                            <li><a href="<?php echo url('home') ?>"><i class="fa fa-home"></i> Home</span></a></li>
                        <?php } ?>

                        <?php if ($halaman == "pegawai") { ?>
                            <li class="active"><a><i class="fa fa-users"></i> Pegawai <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="<?php echo url('/pegawai/create') ?>">Create</a></li>
                                    <li><a href="<?php echo url('/pegawai/show') ?>">View</a></li>
                                </ul>
                            </li>
                        <?php } else { ?>
                            <li><a><i class="fa fa-users"></i> Pegawai <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="<?php echo url('/pegawai/create') ?>">Create</a></li>
                                    <li><a href="<?php echo url('/pegawai/show') ?>">View</a></li>
                                </ul>
                            </li>
                        <?php } ?>

                        <?php if ($halaman == "survei") { ?>
                            <li class="active"><a><i class="fa fa-table"></i> Survei <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="<?php echo url('/survei/create') ?>">Create</a></li>
                                    <li><a href="<?php echo url('/survei/show') ?>">View</a></li>
                                </ul>
                            </li>
                        <?php } else { ?>
                            <li><a><i class="fa fa-clipboard"></i> Survei <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="<?php echo url('/survei/create') ?>">Create</a></li>
                                    <li><a href="<?php echo url('/survei/show') ?>">View</a></li>
                                </ul>
                            </li>
                        <?php } ?>

                        <?php if ($halaman == "ckpr") { ?>
                            <li class="active"><a><i class="fa fa-line-chart"></i> CKPR <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="<?php echo url('/ckpr/import') ?>">Create</a></li>
                                    <li><a href="<?php echo url('/ckpr/show') ?>">View</a></li>
                                </ul>
                            </li>
                        <?php } else { ?>
                            <li><a><i class="fa fa-line-chart"></i> CKPR <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="<?php echo url('/ckpr/import') ?>">Create</a></li>
                                    <li><a href="<?php echo url('/ckpr/show') ?>">View</a></li>
                                </ul>
                            </li>
                        <?php } ?>

                        <?php if ($halaman == "produktifitas") { ?>
                            <li class="active"><a><i class="fa fa-child"></i> Produktifitas <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="<?php echo url('/produktifitas/import') ?>">Create</a></li>
                                    <li><a href="<?php echo url('/produktifitas/show') ?>">View</a></li>
                                </ul>
                            </li>
                        <?php } else { ?>
                            <li><a><i class="fa fa-child"></i> Produktifitas <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="<?php echo url('/produktifitas/import') ?>">Create</a></li>
                                    <li><a href="<?php echo url('/produktifitas/show') ?>">View</a></li>
                                </ul>
                            </li>
                        <?php } ?>

                        <?php if ($halaman == "beban") { ?>
                            <li class="active"><a><i class="fa fa-book"></i> Beban Kerja <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="<?php echo url('/beban') ?>">Hitung Beban</a></li>
                                    <li><a href="<?php echo url('/beban/import') ?>">Input Hasil</a></li>
                                </ul>
                            </li>
                        <?php } else { ?>
                            <li><a><i class="fa fa-book"></i> Beban Kerja <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="<?php echo url('/beban') ?>">Hitung Beban</a></li>
                                    <li><a href="<?php echo url('/beban/import') ?>">Input Hasil</a></li>
                                </ul>
                            </li>
                        <?php } ?>

                        <?php if ($halaman == "jadwal") { ?>
                            <li class="active"><a><i class="fa fa-table"></i> Jadwal<span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="<?php echo url('/jadwal') ?>">Dateline</a></li>
                                    <li><a href="<?php echo url('/jadwal/jadwal') ?>">Jadwal</a></li>
                                </ul>
                            </li>
                        <?php } else { ?> 
                            <li><a><i class="fa fa-table"></i> Jadwal<span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="<?php echo url('/jadwal') ?>">Dateline</a></li>
                                    <li><a href="<?php echo url('/jadwal/jadwal') ?>">Jadwal</a></li>
                                </ul>
                            </li>
                        <?php } ?>

                        <?php if ($halaman == "monitoring") { ?>
                            <li class="active"><a><i class="fa fa-bar-chart"></i> Monitoring<span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="<?php echo url('/monitoring') ?>">Monitoring</a></li>
                                    <li><a href="<?php echo url('/dateline') ?>">Dateline</a></li>
                                </ul>
                            </li>
                        <?php } else { ?> 
                            <li><a><i class="fa fa-bar-chart"></i> Monitoring<span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="<?php echo url('/monitoring') ?>">Monitoring</a></li>
                                    <li><a href="<?php echo url('/dateline') ?>">Dateline</a></li>
                                </ul>
                            </li>
                        <?php } ?>

                        <?php if ($halaman == "laporan") { ?>
                            <li class="active"><a href="<?php echo url('/laporan') ?>"><i class="fa fa-bar-chart"></i> Laporan</a>
                            </li>
                        <?php } else { ?> 
                            <li><a href="<?php echo url('/laporan') ?>"><i class="fa fa-bar-chart"></i> Laporan</a>
                            </li>
                        <?php } ?>




                        @elseif(Auth::user()->role == 2)
                        <?php if ($halaman == "laporan") { ?>
                            <li class="active"><a><i class="fa fa-bar-chart"></i> Monitoring<span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="<?php echo url('/monitoring') ?>">Monitoring</a></li>
                                    <li><a href="<?php echo url('/dateline') ?>">Dateline</a></li>
                                </ul>
                            </li>
                        <?php } else { ?> 
                            <li><a><i class="fa fa-bar-chart"></i> Monitoring<span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="<?php echo url('/monitoring') ?>">Monitoring</a></li>
                                    <li><a href="<?php echo url('/dateline') ?>">Dateline</a></li>
                                </ul>
                            </li>
                        <?php } ?>

                        <?php if ($halaman == "pegawai") { ?>
                            <li class="active"><a><i class="fa fa-users"></i> Pegawai <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="<?php echo url('/pegawai/show') ?>">View</a></li>
                                </ul>
                            </li>
                        <?php } else { ?>
                            <li><a><i class="fa fa-users"></i> Pegawai <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="<?php echo url('/pegawai/show') ?>">View</a></li>
                                </ul>
                            </li>
                        <?php } ?>

                        <?php if ($halaman == "survei") { ?>
                            <li class="active"><a><i class="fa fa-table"></i> Survei <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="<?php echo url('/survei/show') ?>">View</a></li>
                                </ul>
                            </li>
                        <?php } else { ?>
                            <li><a><i class="fa fa-clipboard"></i> Survei <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="<?php echo url('/survei/show') ?>">View</a></li>
                                </ul>
                            </li>
                        <?php } ?>

                        <?php if ($halaman == "ckpr") { ?>
                            <li class="active"><a><i class="fa fa-line-chart"></i> CKPR <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="<?php echo url('/ckpr/import') ?>">Create</a></li>
                                    <li><a href="<?php echo url('/ckpr/show') ?>">View</a></li>
                                </ul>
                            </li>
                        <?php } else { ?>
                            <li><a><i class="fa fa-line-chart"></i> CKPR <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="<?php echo url('/ckpr/import') ?>">Create</a></li>
                                    <li><a href="<?php echo url('/ckpr/show') ?>">View</a></li>
                                </ul>
                            </li>
                        <?php } ?>

                        <?php if ($halaman == "produktifitas") { ?>
                            <li class="active"><a><i class="fa fa-child"></i> Produktifitas <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="<?php echo url('/produktifitas/import') ?>">Create</a></li>
                                    <li><a href="<?php echo url('/produktifitas/show') ?>">View</a></li>
                                </ul>
                            </li>
                        <?php } else { ?>
                            <li><a><i class="fa fa-child"></i> Produktifitas <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="<?php echo url('/produktifitas/import') ?>">Create</a></li>
                                    <li><a href="<?php echo url('/produktifitas/show') ?>">View</a></li>
                                </ul>
                            </li>
                        <?php } ?>

                        <?php if ($halaman == "jadwal") { ?>
                            <li class="active"><a><i class="fa fa-table"></i> Jadwal<span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="<?php echo url('/jadwal') ?>">Dateline</a></li>
                                    <li><a href="<?php echo url('/jadwal/jadwal') ?>">Jadwal</a></li>
                                </ul>
                            </li>
                        <?php } else { ?> 
                            <li><a><i class="fa fa-table"></i> Jadwal<span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="<?php echo url('/jadwal') ?>">Dateline</a></li>
                                    <li><a href="<?php echo url('/jadwal/jadwal') ?>">Jadwal</a></li>
                                </ul>
                            </li>
                        <?php } ?>

                        <?php if ($halaman == "laporan") { ?>
                            <li class="active"><a href="<?php echo url('/laporan') ?>"><i class="fa fa-bar-chart"></i> Laporan</a>
                            </li>
                        <?php } else { ?> 
                            <li><a href="<?php echo url('/laporan') ?>"><i class="fa fa-bar-chart"></i> Laporan</a>
                            </li>
                        <?php } ?>


                        @elseif(Auth::user()->role == 3)
                        <?php if ($halaman == "laporan") { ?>
                            <li class="active"><a><i class="fa fa-bar-chart"></i> Monitoring<span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="<?php echo url('/monitoring') ?>">Monitoring</a></li>
                                    <li><a href="<?php echo url('/dateline') ?>">Dateline</a></li>
                                </ul>
                            </li>
                        <?php } else { ?> 
                            <li><a><i class="fa fa-bar-chart"></i> Monitoring<span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="<?php echo url('/monitoring') ?>">Monitoring</a></li>
                                    <li><a href="<?php echo url('/dateline') ?>">Dateline</a></li>
                                </ul>
                            </li>
                        <?php } ?>

                        <?php if ($halaman == "pegawai") { ?>
                            <li class="active"><a><i class="fa fa-users"></i> Pegawai <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="<?php echo url('/pegawai/show') ?>">View</a></li>
                                </ul>
                            </li>
                        <?php } else { ?>
                            <li><a><i class="fa fa-users"></i> Pegawai <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="<?php echo url('/pegawai/show') ?>">View</a></li>
                                </ul>
                            </li>
                        <?php } ?>

                        <?php if ($halaman == "survei") { ?>
                            <li class="active"><a><i class="fa fa-table"></i> Survei <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="<?php echo url('/survei/show') ?>">View</a></li>
                                </ul>
                            </li>
                        <?php } else { ?>
                            <li><a><i class="fa fa-clipboard"></i> Survei <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="<?php echo url('/survei/show') ?>">View</a></li>
                                </ul>
                            </li>
                        <?php } ?>

                        <?php if ($halaman == "jadwal") { ?>
                            <li class="active"><a><i class="fa fa-table"></i> Jadwal<span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="<?php echo url('/jadwal') ?>">Dateline</a></li>
                                    <li><a href="<?php echo url('/jadwal/jadwal') ?>">Jadwal</a></li>
                                </ul>
                            </li>
                        <?php } else { ?> 
                            <li><a><i class="fa fa-table"></i> Jadwal<span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="<?php echo url('/jadwal') ?>">Dateline</a></li>
                                    <li><a href="<?php echo url('/jadwal/jadwal') ?>">Jadwal</a></li>
                                </ul>
                            </li>
                        <?php } ?>

                        <?php if ($halaman == "laporan") { ?>
                            <li class="active"><a href="<?php echo url('/laporan') ?>"><i class="fa fa-bar-chart"></i> Laporan</a>
                            </li>
                        <?php } else { ?> 
                            <li><a href="<?php echo url('/laporan') ?>"><i class="fa fa-bar-chart"></i> Laporan</a>
                            </li>
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
                            <img src="<?php echo asset('storage/app/images/') . '/' ?>{{Auth::user()->foto}}" alt="">{{ Auth::user()->name }}
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
