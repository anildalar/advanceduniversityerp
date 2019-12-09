<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>UMS</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="theme-color" content="#424242" />
    <link href="<?php echo base_url('assets/backend/'); ?>images/s-favican.png" rel="shortcut icon" type="image/x-icon">
    <link rel="stylesheet" href="<?php echo base_url('assets/backend/'); ?>bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/backend/'); ?>dist/css/style-main.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/backend/'); ?>dist/css/jquery.mCustomScrollbar.min.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/backend/'); ?>dist/themes/default/skins/_all-skins.min.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/backend/'); ?>dist/themes/default/ss-main.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/backend/'); ?>dist/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/backend/'); ?>dist/css/ionicons.min.css">

    <link rel="stylesheet" href="<?php echo base_url('assets/backend/'); ?>plugins/iCheck/flat/blue.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/backend/'); ?>plugins/morris/morris.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/backend/'); ?>plugins/jvectormap/jquery-jvectormap-1.2.2.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/backend/'); ?>plugins/datepicker/datepicker3.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/backend/'); ?>plugins/colorpicker/bootstrap-colorpicker.css">

    <link rel="stylesheet" href="<?php echo base_url('assets/backend/'); ?>plugins/daterangepicker/daterangepicker-bs3.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/backend/'); ?>plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

    <link rel="stylesheet" href="<?php echo base_url('assets/backend/'); ?>dist/css/custom_style.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/backend/'); ?>datepicker/css/bootstrap-datetimepicker.css">
    <!--file dropify-->
    <link rel="stylesheet" href="<?php echo base_url('assets/backend/'); ?>dist/css/dropify.min.css">
    <!--file nprogress-->
    <link href="<?php echo base_url('assets/backend/'); ?>dist/css/nprogress.css" rel="stylesheet">

    <!--print table-->
    <link href="<?php echo base_url('assets/backend/'); ?>dist/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="<?php echo base_url('assets/backend/'); ?>dist/datatables/css/buttons.dataTables.min.css" rel="stylesheet">
    <link href="<?php echo base_url('assets/backend/'); ?>dist/datatables/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <!--print table mobile support-->
    <link href="<?php echo base_url('assets/backend/'); ?>dist/datatables/css/responsive.dataTables.min.css" rel="stylesheet">
    <link href="<?php echo base_url('assets/backend/'); ?>dist/datatables/css/rowReorder.dataTables.min.css" rel="stylesheet">
    <script src="<?php echo base_url('assets/backend/'); ?>custom/jquery.min.js"></script>
    <script src="<?php echo base_url('assets/backend/'); ?>dist/js/moment.min.js"></script>
    <script src="<?php echo base_url('assets/backend/'); ?>datepicker/js/bootstrap-datetimepicker.js"></script>
    <script src="<?php echo base_url('assets/backend/'); ?>plugins/colorpicker/bootstrap-colorpicker.js"></script>
    <script src="<?php echo base_url('assets/backend/'); ?>datepicker/date.js"></script>
    <script src="<?php echo base_url('assets/backend/'); ?>dist/js/jquery-ui.min.js"></script>
    <script src="<?php echo base_url('assets/backend/'); ?>js/school-custom.js"></script>
    <!-- fullCalendar -->
    <link rel="stylesheet" href="<?php echo base_url('assets/backend/'); ?>fullcalendar/dist/fullcalendar.min.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/backend/'); ?>fullcalendar/dist/fullcalendar.print.min.css" media="print">

    <script type="text/javascript">
        var baseurl = "#";
    </script>
	
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and me/
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]
	-->
	
</head>

<body class="hold-transition skin-blue fixed sidebar-mini">
    <div class="wrapper">
        <header class="main-header" id="alert">
            <a href="https://demo1.smart-school.in/admin/admin/dashboard" class="logo">
                <span class="logo-mini">S S</span>
                <span class="logo-lg"><img src="<?php echo base_url('assets/backend/'); ?>images/s_logo.png" alt="UMS" /></span>
            </a>
            <nav class="navbar navbar-static-top" role="navigation">
                <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="col-md-5 col-sm-3 col-xs-5">
                    <span href="#" class="sidebar-session">
                            UMS                        </span>
                </div>
                <div class="col-md-7 col-sm-9 col-xs-7">
                    <div class="pull-right">
                        <form class="navbar-form navbar-left search-form" role="search" action="https://demo1.smart-school.in/admin/admin/search" method="POST">
                            <input type='hidden' name='ci_csrf_token' value='' />
                            <div class="input-group" style="padding-top:3px;">
                                <input type="text" name="search_text" class="form-control search-form search-form3" placeholder="Search By Student Name, Roll Number, Enroll Number, National Id, Local Id Etc.">
                                <span class="input-group-btn">
                                            <button type="submit" name="search" id="search-btn" style="padding: 3px 12px !important;border-radius: 0px 30px 30px 0px; background: #fff;" class="btn btn-flat"><i class="fa fa-search"></i></button>
                                        </span>
                            </div>
                        </form>
                        <div class="navbar-custom-menu">
                            <ul class="nav navbar-nav headertopmenu">
                                <li class="cal15"><a href="https://demo1.smart-school.in/admin/calendar/events" title="Calendar"><i class="fa fa fa-calendar"></i></a></li>
                                <li class="dropdown">
                                    <a href="#" title="Task" class="dropdown-toggle todoicon" data-toggle="dropdown">
                                        <i class="fa fa-check-square-o"></i>
                                    </a>
                                    <ul class="dropdown-menu menuboxshadow">

                                        <li class="todoview plr10 ssnoti">Today you have 0 pending task.<a href="https://demo1.smart-school.in/admin/calendar/events" class="pull-right pt0">View All</a></li>
                                        <li>
                                            <ul class="todolist">

                                            </ul>
                                        </li>
                                    </ul>
                                </li>

                                <li class="dropdown user-menu">
                                    <a class="dropdown-toggle" style="padding: 15px 13px;" data-toggle="dropdown" href="#" aria-expanded="false">
                                        <img src="https://demo1.smart-school.in/uploads/staff_images/1.jpg" class="topuser-image" alt="User Image">
                                    </a>
                                    <ul class="dropdown-menu dropdown-user menuboxshadow">
                                        <li>
                                            <div class="sstopuser">
                                                <div class="ssuserleft">
                                                    <a href="https://demo1.smart-school.in/admin/staff/profile/1"><img src="https://demo1.smart-school.in/uploads/staff_images/1.jpg" alt="User Image"></a>
                                                </div>

                                                <div class="sstopuser-test">
                                                    <h4 style="text-transform: capitalize;">Joe</h4>
                                                    <h5>Super Admin</h5>
                                                    <!-- <div class="sspass pt15"><a class="pull-right" href=""><i class="fa fa-user"></i> My Profile</a></div>   -->
                                                </div>

                                                <div class="divider"></div>
                                                <div class="sspass">
                                                    <a href="https://demo1.smart-school.in/admin/staff/profile/1" data-toggle="tooltip" title="" data-original-title="My Profile"><i class="fa fa-user"></i>Profile</a>
                                                    <a class="pl25" href="https://demo1.smart-school.in/admin/admin/changepass" data-toggle="tooltip" title="" data-original-title="Change Password"><i class="fa fa-key"></i>Password</a> <a class="pull-right" href="https://demo1.smart-school.in/site/logout"><i class="fa fa-sign-out fa-fw"></i>Logout</a>
                                                </div>
                                            </div>
                                            <!--./sstopuser-->
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>
        </header>