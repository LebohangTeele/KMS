<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <title>
        <?php echo $tab_title;?>
    </title>
    <link type="text/css" rel="stylesheet" href="<?php echo base_url();?>assets/css/font-awesome.css">
    <link type="text/css" rel="stylesheet" href="<?php echo base_url();?>assets/css/material-design-iconic-font.css">
    <link type="text/css" rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.css">
    <link type="text/css" rel="stylesheet" href="<?php echo base_url();?>assets/css/animate.css">
    <link type="text/css" rel="stylesheet" href="<?php echo base_url();?>assets/css/layout.css">
    <link type="text/css" rel="stylesheet" href="<?php echo base_url();?>assets/css/components.css">
    <link type="text/css" rel="stylesheet" href="<?php echo base_url();?>assets/css/widgets.css">
    <link type="text/css" rel="stylesheet" href="<?php echo base_url();?>assets/css/plugins.css">
    <link type="text/css" rel="stylesheet" href="<?php echo base_url();?>assets/css/pages.css">
    <link type="text/css" rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap-extend.css">
    <link type="text/css" rel="stylesheet" href="<?php echo base_url();?>assets/css/common.css">
    <link type="text/css" rel="stylesheet" href="<?php echo base_url();?>assets/css/responsive.css">
</head>
<body class="leftbar-view">
    <!--Topbar Start Here-->
        <header class="topbar clearfix">
            <!--Top Search Bar Start Here-->
            <div class="top-search-bar">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6 col-md-offset-3">
                            <div class="search-input-addon">
                                <span class="addon-icon"><i class="zmdi zmdi-search"></i></span>
                                <input type="text" class="form-control top-search-input" placeholder="Search">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--Top Search Bar End Here-->
            <!--Topbar Left Branding With Logo Start-->
            <div class="topbar-left pull-left">
                <div class="clearfix">
                    <ul class="left-branding pull-left clickablemenu ttmenu dark-style menu-color-gradient">
                        <li><span class="left-toggle-switch"><i class="zmdi zmdi-menu"></i></span></li>
                        <li>
                            <div class="logo">
                                <a href="index.html" title="Admin Template">logo</a>
                            </div>
                        </li>
                    </ul>
                    <!--Mobile Search and Rightbar Toggle-->
                    <ul class="branding-right pull-right">
                        <li><a href="#" class="btn-mobile-search btn-top-search"><i class="zmdi zmdi-search"></i></a></li>
                        <li><a href="#" class="btn-mobile-bar"><i class="zmdi zmdi-menu"></i></a></li>
                    </ul>
                </div>
            </div>
            <!--Topbar Left Branding With Logo End-->
            <!--Topbar Right Start-->
            <div class="topbar-right pull-right">
                <div class="clearfix">
                    <!--Mobile View Leftbar Toggle-->
                    <ul class="left-bar-switch pull-left">
                        <li><span class="left-toggle-switch"><i class="zmdi zmdi-menu"></i></span></li>
                    </ul>
                    <ul class="pull-right top-right-icons">
                        <li><a href="#" class="btn-top-search"><i class="zmdi zmdi-search"></i></a></li>
                        <li class="dropdown apps-dropdown">
                            <a href="#" class="btn-apps dropdown-toggle" data-toggle="dropdown"><i class="zmdi zmdi-apps"></i></a>
                            <div class="dropdown-menu">
                                <ul class="apps-shortcut clearfix">
                                    <li>
                                        <a href="#"><i class="zmdi zmdi-email"></i>
                                            <span class="apps-noty">23</span>
                                            <span class="apps-label">Email</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#"><i class="zmdi zmdi-accounts-alt"></i>
                                            <span class="apps-noty">15</span>
                                            <span class="apps-label">Forum</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#"><i class="zmdi zmdi-file-text"></i>
                                            <span class="apps-label">Note</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#"><i class="zmdi zmdi-chart"></i>
                                            <span class="apps-label">Analytics</span>
                                        </a>
                                    </li>
                                </ul>
                                <ul class="more-apps">
                                    <li><a href="#"><i class="zmdi zmdi-camera"></i> Gallery</a></li>
                                    <li><a href="#"><i class="zmdi zmdi-comments"></i> Chat</a></li>
                                </ul>
                            </div>
                        </li>
                        <li class="dropdown notifications-dropdown">
                            <a href="#" class="btn-notification dropdown-toggle" data-toggle="dropdown"><span class="noty-bubble">10</span><i class="zmdi zmdi-globe"></i></a>
                            <div class="dropdown-menu notifications-tabs">
                                <div>
                                    <ul class="nav material-tabs nav-tabs" role="tablist">
                                        <li class="active"><a href="#message" aria-controls="message" role="tab" data-toggle="tab">Message</a></li>
                                        <li><a href="#notifications" aria-controls="notifications" role="tab" data-toggle="tab">Notifications</a></li>
                                    </ul>
                                    <div class="tab-content">
                                        <div role="tabpanel" class="tab-pane active" id="message">
                                            <div class="message-list-container">
                                                <h4>You have 15 new messages</h4>
                                                <ul class="clearfix">
                                                    <li class="clearfix">
                                                        <a href="#" class="message-thumb"><img src="<?php echo base_url();?>assets/images/avatar/robertoortiz.jpg" alt="image">
                                                        </a><a href="#" class="message-intro"><span class="message-meta">Robertoortiz </span>Nunc aliquam dolor... <span class="message-time">today at 10:20 pm</span></a>
                                                    </li>
                                                    <li class="clearfix">
                                                        <a href="#" class="message-thumb"><span class="message-letter w_bg_purple">A</span>
                                                        </a><a href="#" class="message-intro"><span class="message-meta">Allisongrayce </span>In hac habitasse ... <span class="message-time">today at 8:29 pm</span></a>
                                                    </li>
                                                    <li class="clearfix">
                                                        <a href="#" class="message-thumb"><img src="<?php echo base_url();?>assets/images/avatar/michael-owens.jpg" alt="image">
                                                        </a><a href="#" class="message-intro"><span class="message-meta">Michael </span>Suspendisse ac mauris ... <span class="message-time">yesterday at 12:29 pm</span></a>
                                                    </li>
                                                    <li class="clearfix">
                                                        <a href="#" class="message-thumb"><span class="message-letter w_bg_blue">B</span>
                                                        </a><a href="#" class="message-intro"><span class="message-meta">Bobbyjkane </span>Vivamus lacinia facilisis... <span class="message-time">yesterday at 11:48 pm</span></a>
                                                    </li>
                                                    <li class="clearfix">
                                                        <a href="#" class="message-thumb"><img src="<?php echo base_url();?>assets/images/avatar/bobbyjkane.jpg" alt="image">
                                                        </a><a href="#" class="message-intro"><span class="message-meta">Bobbyjkane </span>Donec vel iaculis ... <span class="message-time">1 month ago</span></a>
                                                    </li>
                                                    <li class="clearfix">
                                                        <a href="#" class="message-thumb"><span class="message-letter w_bg_teal">C</span>
                                                        </a><a href="#" class="message-intro"><span class="message-meta">Chexee </span> Curabitur eget blandit...<span class="message-time">3 months ago</span></a>
                                                    </li>
                                                    <li class="clearfix">
                                                        <a href="#" class="message-thumb"><img src="<?php echo base_url();?>assets/images/avatar/coreyweb.jpg" alt="image">
                                                        </a><a href="#" class="message-intro"><span class="message-meta">Coreyweb </span>Etiam molestie nulla... <span class="message-time">1 year ago</span></a>
                                                    </li>
                                                </ul>
                                                <a class="btn btn-link btn-block btn-view-all" href="#"><span>View All</span></a>
                                            </div>
                                        </div>
                                        <div role="tabpanel" class="tab-pane" id="notifications">
                                            <div class="notification-wrap">
                                                <h4>You have 10 new notifications</h4>
                                                <ul>
                                                    <li><a href="#" class="clearfix"><span class="ni w_bg_purple"><i class="fa fa-bullhorn"></i></span><span class="notification-message">Pellentesque semper posuere. <span class="notification-time clearfix">3 Min Ago</span></span></a>
                                                    </li>
                                                    <li><a href="#" class="clearfix"><span class="ni w_bg_orange"><i class="fa fa-life-ring"></i></span><span class="notification-message">Nulla commodo sem at purus. <span class="notification-time clearfix">1 Hours Ago</span></span></a>
                                                    </li>
                                                    <li><a href="#" class="clearfix"><span class="ni w_bg_red"><i class="fa fa-star-o"></i></span><span class="notification-message">Fusce condimentum turpis. <span class="notification-time clearfix">3 Hours Ago</span></span></a>
                                                    </li>
                                                    <li><a href="#" class="clearfix"><span class="ni w_bg_light_blue"><i class="fa fa-trophy"></i></span><span class="notification-message">Pellentesque habitant morbi. <span class="notification-time clearfix">Yesterday</span></span></a>
                                                    </li>
                                                    <li><a href="#" class="clearfix"><span class="ni w_bg_cyan"><i class="fa fa-bolt"></i></span><span class="notification-message">Fusce bibendum lacus mauris.<span class="notification-time clearfix">1 Month Ago</span></span></a>
                                                    </li>
                                                    <li><a href="#" class="clearfix"><span class="ni w_bg_yellow"><i class="fa fa-bookmark-o"></i></span><span class="notification-message">Donec id mi placerat, scelerisque.<span class="notification-time clearfix">3 Months Ago</span></span></a>
                                                    </li>
                                                </ul>
                                                <a class="btn btn-link btn-block btn-view-all clearfix" href="#"><span>View All</span></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li><a href="#" class="right-toggle-switch"><i class="zmdi zmdi-format-align-left"></i><span class="more-noty"></span></a></li>
                    </ul>
                </div>
            </div>
            <!--Topbar Right End-->
            <div class="page-header filled full-block">
                <div class="row">
                    <div class="col-md-2">
                        <ul class="list-page-breadcrumb">
                            <li>
                                <a href="#"><?php echo $privilege_group; ?> 
                                    <i class="zmdi zmdi-chevron-right"></i>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo base_url($this->router->class);?>">
                                    <?php echo $this->router->class;?> 
                                    <i class="zmdi zmdi-chevron-right"></i>
                                </a>
                            </li>
                            <li class="active-page"> 

                                <?php echo $this->router->method; ?>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

        </header>
    <!--Topbar End Here-->
    <!--Leftbar-->
        <aside class="leftbar material-leftbar">
            <div class="left-aside-container">
                <div class="user-profile-container">
                    <div class="user-profile clearfix">
                        <div class="admin-user-thumb">
                            <img src="<?php echo base_url();?>assets/images/upload/kms_logo.gif" alt="admin">
                        </div>
                        <div class="admin-user-info">
                            <ul>
                                <li>
                                    <a href="#">
                                        <?php echo $user_name ." ".$user_sname;?>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <?php echo $user_email;?>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="admin-bar">
                        <ul>
                            <li>
                                <a href="<?php echo base_url('auth/logout');?>">
                                    <i class="zmdi zmdi-power"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="zmdi zmdi-account"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="zmdi zmdi-key"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="zmdi zmdi-settings"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!--Tile Leftbar Start Here -->
                <div class="tile-leftbar">
                    <div class="tile-row clearfix">
                        <div class="tile-col-1 w_bg_cyan">
                            <a href="<?php echo base_url('sales_dashboard');?>">
                                <span class="tile-nav-icon">
                                    <i class="zmdi zmdi-desktop-mac"></i>
                                </span>
                                <span class="tile-nav-title">
                                    C.O.D
                                </span>
                            </a>
                        </div>
                        <div class="tile-col-2 w_bg_amber">
                            <a href="<?php echo base_url('sales/accounts');?>">
                                <span class="tile-nav-icon"><i class="zmdi zmdi-accounts-list"></i></span>
                                <span class="tile-nav-title">Accounts</span>
                            </a>
                        </div>
                        <div class="tile-col-2 w_bg_red">
                            <a href="<?php echo base_url('sales_dashboard/process_refunds');?>">
                                <span class="tile-nav-icon"><i class="zmdi zmdi-swap"></i></span>
                                <span class="tile-nav-title">Refunds</span>
                            </a>
                        </div>
                        <div class="tile-col-2 w_bg_green">
                            <a href="<?php echo base_url('sales_dashboard/process_invoices');?>">
                                <span class="tile-nav-icon"><i class="zmdi zmdi-money-box"></i></span>
                                <span class="tile-nav-title">Payments</span>
                            </a>
                        </div>
                        <div class="tile-col-2 w_bg_brown">
                            <a href="<?php echo base_url('sales/view_invoices');?>">
                                <span class="tile-nav-icon"><i class="zmdi zmdi-file-text"></i></span>
                                <span class="tile-nav-title">Invoices</span>
                            </a>
                        </div>
                    </div>
                </div>
                <footer class="footer-container">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6 col-sm-4">
                                <div class="footer-left">
                                    <span>Â© 2015 <a href="http://themeforest.net/user/westilian">westilian</a></span>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-8">
                                <div class="footer-right">
                                    <span class="footer-meta">Developed by<a href="http://themeforest.net/user/westilian">KMS Dev Team</a></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </footer>
                <!--Tile Leftbar End Here -->
            </div>
        </aside>
    <!-- End left bar here -->

    <!--Page Container Start Here-->
    <section class="main-container">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class = "widget-wrap">
                        <form action="#" class="j-forms" >     
                            <div class="form-content">
                                <div class="j-row">
                                    <div class="span6 unit">
                                        <div class="input">
                                            <label class="icon-right" for="date-icon">
                                                <i class="fa fa-calendar"></i>
                                            </label>
                                            <input  class="form-control" type="text" id="date-icon" placeholder="datepicker with an icon" readonly="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-2">
                                            <div class="input-group date addon-datepicker">
                                                <input type="text" class="form-control"><span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="widget-wrap block-header margin-bottom-0 clearfix">
                        <table class="table table-striped data-tbl">
                            <thead>
                                <tr>
                                    <td>
                                        State
                                    </td>
                                    <td>
                                        Ticket #
                                    </td>
                                    <td>
                                        Date
                                    </td>
                                    <td>
                                        Total Cost
                                    </td>
                                    <th>
                                       <!-- place holder -->
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $row = 1;
                                    foreach($quotations as $quotes):
                                ?>
                                        <tr>
                                            <td>
                                                <sub>
                                                    <code>
                                                        <?php
                                                            echo $quotes['state'];
                                                        ?>
                                                    </code>    
                                                </sub> 
                                                <?php
                                                   // echo $row;
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                    echo $quotes['quote_number'];
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                    echo $quotes['created'];
                                                ?>
                                            </td>

                                            <td>
                                                <?php
                                                    echo $quotes['quote_value'];
                                                ?>
                                            </td>
                                            <td>
                                                <form action = "">
                                                    <input type="hidden" id="<?php echo $quotes['quote_name'];?>" value ="<?php echo $quotes['quote_name'];?>">
                                                    <input type="submit" value="details" onclick ="return <?php echo $quotes['quote_name'].'chk()'; ?> ">
                                                </form>
                                            </td>
                                        </tr>
                                <?php
                                        $row++;
                                    endforeach;
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="widget-wrap " id="quotationDetails">
                            <!-- view quotation details -->
                        </div>
                    </div>
                    <div class="row">
                        <div class="widget-wrap block-header margin-bottom-0 clearfix" id="processedInvoices">
                            <h4>
                                Invoices Processed Today
                            </h4>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>
                                            Ticket Date
                                        </th>
                                        <th>
                                            Invoice Name
                                        </th>
                                        <th>
                                            Total Cost
                                        </th>
                                        <th>
                                            State
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        foreach($invoices_today as $invoices):
                                    ?>
                                    <tr>
                                        <td>
                                            <?php 
                                                echo $invoices['created'];
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                                echo $invoices['quote_number'];
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                                echo $invoices['quote_value'];
                                            ?>
                                        </td>
                                        <td>
                                            <sub>
                                                <code>
                                                    <?php
                                                        echo $invoices['state'];
                                                    ?>
                                                </code>    
                                            </sub>
                                            <a id = "printLink" href="javascript: window.open('?sale_id=1843538&invoice_id=AK1492&finalSubtotal=45.22&finalTotal=52', '', 'toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=0,width=320,height=500,left = 312,top = 284'); return false;">view</a>
                                        </td>
                                    </tr>
                                    <?php 
                                        endforeach;
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!--Page Container End Here-->
    <script src="<?php echo base_url();?>assets/js/lib/jquery.js"></script>
    <script src="<?php echo base_url();?>assets/js/lib/jquery-migrate.js"></script>
    <script src="<?php echo base_url();?>assets/js/lib/bootstrap.js"></script>
    <script src="<?php echo base_url();?>assets/js/lib/jquery.ui.js"></script>
    <script src="<?php echo base_url();?>assets/js/lib/jRespond.js"></script>
    <script src="<?php echo base_url();?>assets/js/lib/nav.accordion.js"></script>
    <script src="<?php echo base_url();?>assets/js/lib/hover.intent.js"></script>
    <script src="<?php echo base_url();?>assets/js/lib/hammerjs.js"></script>
    <script src="<?php echo base_url();?>assets/js/lib/jquery.hammer.js"></script>
    <script src="<?php echo base_url();?>assets/js/lib/jquery.fitvids.js"></script>
    <script src="<?php echo base_url();?>assets/js/lib/scrollup.js"></script>
    <script src="<?php echo base_url();?>assets/js/lib/smoothscroll.js"></script>
    <script src="<?php echo base_url();?>assets/js/lib/jquery.slimscroll.js"></script>
    <script src="<?php echo base_url();?>assets/js/lib/jquery.syntaxhighlighter.js"></script>
    <script src="<?php echo base_url();?>assets/js/lib/velocity.js"></script>
    <script src="<?php echo base_url();?>assets/js/lib/jquery-jvectormap.js"></script>
    <script src="<?php echo base_url();?>assets/js/lib/jquery-jvectormap-world-mill.js"></script>
    <script src="<?php echo base_url();?>assets/js/lib/jquery-jvectormap-us-aea.js"></script>
    <script src="<?php echo base_url();?>assets/js/lib/smart-resize.js"></script>
    <!--iCheck-->
    <script src="<?php echo base_url();?>assets/js/lib/icheck.js"></script>
    <!--CHARTS-->
    <script src="<?php echo base_url();?>assets/js/lib/chart/sparkline/jquery.sparkline.js"></script>
    <script src="<?php echo base_url();?>assets/js/lib/chart/easypie/jquery.easypiechart.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/lib/chart/flot/excanvas.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/lib/chart/flot/jquery.flot.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/lib/chart/flot/curvedLines.js"></script>
    <script src="<?php echo base_url();?>assets/js/lib/chart/flot/jquery.flot.time.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/lib/chart/flot/jquery.flot.stack.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/lib/chart/flot/jquery.flot.axislabels.js"></script>
    <script src="<?php echo base_url();?>assets/js/lib/chart/flot/jquery.flot.resize.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/lib/chart/flot/jquery.flot.tooltip.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/lib/chart/flot/jquery.flot.spline.js"></script>
    <script src="<?php echo base_url();?>assets/js/lib/chart/flot/jquery.flot.pie.min.js"></script>

    <!--Widgets-->
    <script src="<?php echo base_url();?>assets/js/lib/jquery.simpleWeather.js"></script>

    <!--Forms-->
    <script src="<?php echo base_url();?>assets/js/lib/jquery.maskedinput.js"></script>
    <script src="<?php echo base_url();?>assets/js/lib/jquery.validate.js"></script>
    <script src="<?php echo base_url();?>assets/js/lib/jquery.form.js"></script>
    <script src="<?php echo base_url();?>assets/js/lib/j-forms.js"></script>
    <script src="<?php echo base_url();?>assets/js/lib/jquery.loadmask.js"></script>
    <script src="<?php echo base_url();?>assets/js/apps.js"></script>
    <script src="<?php echo base_url('/assets/js/lib/jquery.tabledit.min.js');?>"></script>


    <!-- tables -->
    <script src="<?php echo base_url('/assets/js/lib/jquery.tabledit.min.js');?>"></script>
    <script src="<?php echo base_url();?>assets/js/lib/jquery.dataTables.js"></script>
    <script src="<?php echo base_url();?>assets/js/lib/dataTables.responsive.js"></script>
    <script src="<?php echo base_url();?>assets/js/lib/dataTables.tableTools.js"></script>
    <script src="<?php echo base_url();?>assets/js/lib/dataTables.bootstrap.js"></script>
    <script src="<?php echo base_url();?>assets/js/lib/select2.full.js"></script>
    <!--Rightbar End Here-->
<script>
<?php
    foreach($quotations as $quotes):
?>
    function <?php echo $quotes['quote_name'].'chk()'; ?>
    {
        var name = document.getElementById('<?php echo $quotes['quote_name'];?>').value;
        var dataString = '<?php echo $quotes['quote_name']."=";?>'+name;
        $.ajax({
            type:"post",
            url: "<?php echo base_url('sales_dashboard/quote_details');?>",
            data:dataString,
            cache:false,
            success:function (html){
                $('#quotationDetails').html(html); 
            }
        });
        return false;
    }
<?php 
    endforeach;
?>
</script>

<script>
    function invoices_processed()
    {
        var name = document.getElementById('<?php echo $quotes['quote_name'];?>').value;
        var dataString = '<?php echo $quotes['quote_name']."=";?>'+name;
        $.ajax({
            type:"post",
            url: "<?php echo base_url('sales_dashboard/quote_details');?>",
            data:dataString,
            cache:false,
            success:function (html){
                $('#quotationDetails').html(html); 
            }
        });
        return false;
    }
</script>
<script>
    document.getElementById("printLink").onclick = function() {myFunction()};
    function myFunction() {
        window.open('<?php echo base_url('sales_dashboard/print_invoice');?>?sale_id=1843538&invoice_id=AK1492&finalSubtotal=45.22&finalTotal=52');
    }
</script>

    </body>
</html>