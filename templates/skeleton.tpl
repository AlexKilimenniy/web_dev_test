<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/x-icon" href="{$smarty.const.BASE_HOST}static/assets/img/favicon.ico"/>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700' rel='stylesheet' type='text/css'>
    <link href="{$smarty.const.BASE_HOST}static/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="{$smarty.const.BASE_HOST}static/assets/css/plugins.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    <link href="{$smarty.const.BASE_HOST}static/assets/css/support-chat.css" rel="stylesheet" type="text/css" />
    <link href="{$smarty.const.BASE_HOST}static/plugins/maps/vector/jvector/jquery-jvectormap-2.0.3.css" rel="stylesheet" type="text/css" />
    <link href="{$smarty.const.BASE_HOST}static/plugins/charts/chartist/chartist.css" rel="stylesheet" type="text/css">
    <link href="{$smarty.const.BASE_HOST}static/assets/css/default-dashboard/style.css" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    {block name="meta-custom"}{/block}
</head>
<body class="default-sidebar">

    {include "header.tpl"}

    <!--  BEGIN MAIN CONTAINER  -->
    <div class="main-container" id="container">

        <div class="overlay"></div>
        <div class="cs-overlay"></div>

        <!--  BEGIN SIDEBAR  -->

        <div class="sidebar-wrapper sidebar-theme">

            <div id="dismiss" class="d-lg-none"><i class="flaticon-cancel-12"></i></div>

            <nav id="sidebar">

                <ul class="navbar-nav theme-brand flex-row  d-none d-lg-flex">
                    <li class="nav-item d-flex">
                        <a href="/" class="navbar-brand">
                            <img src="{$smarty.const.BASE_HOST}static/assets/img/logo-3.png" class="img-fluid" alt="logo">
                        </a>
                        <p class="border-underline"></p>
                    </li>
                    <li class="nav-item theme-text">
                        <a href="/" class="nav-link"> Test Web.dev </a>
                    </li>
                </ul>


                <ul class="list-unstyled menu-categories" id="accordionExample">
                    <li class="menu">
                        <a href="#cookery" data-toggle="collapse" aria-expanded="true" class="dropdown-toggle">
                            <div class="">
                                <i class="flaticon-computer-6 ml-3"></i>
                                <span>Кухни</span>
                            </div>
                        </a>
                        <ul class="collapse submenu list-unstyled show" id="cookery" data-parent="#accordionExample">
                            <li class="active">
                                <a href="/cookery"> <i class="flaticon-layers"></i> Список </a>
                            </li>
                            <li>
                                <a href="/cookery?create"> <i class="flaticon-plus"></i> Создать </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>

        </div>

        <!--  END SIDEBAR  -->
        {block name="content"}{/block}
    </div>
    <!-- END MAIN CONTAINER -->

    <!--  BEGIN FOOTER  -->
    {include "footer.tpl"}
    <!--  END FOOTER  -->


    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="{$smarty.const.BASE_HOST}static/assets/js/libs/jquery-3.1.1.min.js"></script>
    <script src="{$smarty.const.BASE_HOST}static/bootstrap/js/popper.min.js"></script>
    <script src="{$smarty.const.BASE_HOST}static/bootstrap/js/bootstrap.min.js"></script>
    <script src="{$smarty.const.BASE_HOST}static/plugins/scrollbar/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="{$smarty.const.BASE_HOST}static/assets/js/app.js"></script>
    <script>
        $(document).ready(function() {
            App.init();
        });
    </script>
    <script src="{$smarty.const.BASE_HOST}static/assets/js/custom.js"></script>
    <!-- END GLOBAL MANDATORY SCRIPTS -->

    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
    <script src="{$smarty.const.BASE_HOST}static/plugins/charts/chartist/chartist.js"></script>
    <script src="{$smarty.const.BASE_HOST}static/plugins/maps/vector/jvector/jquery-jvectormap-2.0.3.min.js"></script>
    <script src="{$smarty.const.BASE_HOST}static/plugins/maps/vector/jvector/worldmap_script/jquery-jvectormap-world-mill-en.js"></script>
    <script src="{$smarty.const.BASE_HOST}static/plugins/calendar/pignose/moment.latest.min.js"></script>
    <script src="{$smarty.const.BASE_HOST}static/plugins/calendar/pignose/pignose.calendar.js"></script>
    <script src="{$smarty.const.BASE_HOST}static/plugins/progressbar/progressbar.min.js"></script>
    <script src="{$smarty.const.BASE_HOST}static/assets/js/default-dashboard/default-custom.js"></script>
    <script src="{$smarty.const.BASE_HOST}static/assets/js/support-chat.js"></script>
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->

    <script src="{$smarty.const.BASE_HOST}static/plugins/select2/select2.min.js"></script>
    <script src="{$smarty.const.BASE_HOST}static/plugins/select2/custom-select2.js"></script>
</body>
</html>