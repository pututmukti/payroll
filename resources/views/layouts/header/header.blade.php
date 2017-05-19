<div class="page-header">
    <!-- BEGIN HEADER TOP -->
    <div class="page-header-top">
        <div class="container">
            <!-- BEGIN LOGO -->
            <div class="page-logo">
               
              <a href="{{url('')}}" class="navbar-brand">Payroll System</a>
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                <i class="fa fa-bars"></i>
              </button>
            </div>
            <!-- END LOGO -->
            
            <!-- BEGIN TOP NAVIGATION MENU -->
            <div class="top-menu">
                <ul class="nav navbar-nav pull-right">
                    <!-- BEGIN NOTIFICATION DROPDOWN -->
                    <li class="dropdown dropdown-extended dropdown-notification dropdown-dark" id="header_notification_bar">
                        <a  class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                            Hallo
                        </a>
                    </li>
                    <!-- END NOTIFICATION DROPDOWN -->
                    
                    <li class="droddown dropdown-separator">
                        <span class="separator"></span>
                    </li>
                    
                    <!-- BEGIN USER LOGIN DROPDOWN -->
                    <li class="dropdown dropdown-user dropdown-dark">
                        <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                            <span class="username username-hide-mobile">Administrator</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-default">
                            <li>
                                <a href="page_user_profile_1.html">
                                    <i class="icon-user"></i> User Management </a>
                            </li>
                            <li class="divider"> </li>
                            <li>
                                <a href="{{url('')}}/logoutProses">
                                    <i class="icon-key"></i> Log Out </a>
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
            <div class="hor-menu  ">
                <ul class="nav navbar-nav">
                    <li class="menu-dropdown classic-menu-dropdown ">
                        <a href="javascript:;"> File
                            <span class="arrow"></span>
                        </a>
                        <ul class="dropdown-menu pull-left">
                            <li><a href="{{url('')}}/departemen">Departemen</a></li>
                            <li><a href="{{url('')}}/areakerja">Lokasi kerja</a></li>
                            <li><a href="{{url('')}}/areaoperasi">Area Operasi</a></li>
                            <li class="divider"></li>
                            <li><a href="{{url('')}}/datapegawai">Data Pegawai</a></li>
                            <li><a href="{{url('')}}/templatekomponen">Template Komponen Gaji</a></li>

                        </ul>
                    </li>
                    <li class="menu-dropdown classic-menu-dropdown ">
                        <a href="javascript:;"> Transaksi
                            <span class="arrow"></span>
                        </a>
                        <ul class="dropdown-menu pull-left">
                            <li><a href="{{url('')}}/potongantransaksi">Transaksi Payroll</a></li>
                            <li class="divider"></li>
                            <li><a href="{{url('')}}/closingtransaksi">Closing Transaksi</a></li>
                        </ul>
                    </li>
                     <li class="menu-dropdown classic-menu-dropdown ">
                        <a href="javascript:;"> Laporan
                            <span class="arrow"></span>
                        </a>
                        <ul class="dropdown-menu pull-left">
                            <li><a href="{{url('')}}/laporanrekapitulasigaji">Slip Gaji</a></li>
                            <li><a href="{{url('')}}/laporanrekapgaji">Daftar Gaji</a></li>
                            <li><a href="{{url('')}}/generaterekapgajiprojectprint">Rekapitulasi gaji</a></li>
                            <li><a href="{{url('')}}/laporanlistgajipegawai">Rekapitulasi Pembayaraan Gaji</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <!-- END MEGA MENU -->
        </div>
    </div>
    <!-- END HEADER MENU -->
</div>