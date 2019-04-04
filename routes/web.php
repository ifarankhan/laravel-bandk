<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/testing', function () {
    $html = '
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="/admin/images/favicon.ico" type="image/ico" />

    <title>B&k! | </title>

    <!-- Bootstrap -->
    <link href="https://insurance.bk-as.dk/admin/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Font Awesome -->
    <link href="https://insurance.bk-as.dk/admin/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="https://insurance.bk-as.dk/admin/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="https://insurance.bk-as.dk/admin/vendors/iCheck/skins/flat/green.css" rel="stylesheet">

    <!-- bootstrap-progressbar -->
    <link href="https://insurance.bk-as.dk/admin/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- JQVMap -->
    <link href="https://insurance.bk-as.dk/admin/vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet" />
    <!-- bootstrap-daterangepicker -->
    

    <!-- Custom Theme Style -->
    <link href="https://insurance.bk-as.dk/admin/build/css/custom.min.css" rel="stylesheet">
    <link href="https://insurance.bk-as.dk/admin/vendors/html-editor/bootstrap-wysihtml5.css" rel="stylesheet">
    <style>
        /* Style the list */
        ul.breadcrumb {
            margin-top: 50px;
            padding: 10px 16px;
            list-style: none;
            background-color: #eee;
        }

        /* Display list items side by side */
        ul.breadcrumb li {
            display: inline;
            font-size: 18px;
        }

        /* Add a slash symbol (/) before/behind each list item */
        ul.breadcrumb li+li:before {
            padding: 8px;
            color: black;
            content: "/\00a0";
        }

        /* Add a color to all links inside the list */
        ul.breadcrumb li a {
            color: #0275d8;
            text-decoration: none;
        }

        /* Add a color on mouse-over */
        ul.breadcrumb li a:hover {
            color: #01447e;
            text-decoration: underline;
        }
    </style>
    <script>
        var _token = "HcqBuNGIj7Sbh7d3eBzW1TURibHQLuBw5SQuciRM";
    </script>

        <link href="https://insurance.bk-as.dk/admin/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css " rel="stylesheet">
    <link href="https://insurance.bk-as.dk/admin/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css " rel="stylesheet">
    <link href="https://insurance.bk-as.dk/admin/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css " rel="stylesheet">
    <link href="https://insurance.bk-as.dk/admin/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css " rel="stylesheet">
    <link href="https://insurance.bk-as.dk/admin/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css " rel="stylesheet">
    <style>
        .show {
            display: block;
        }

        .hide {
            display: none;
        }
    </style>
</head>

<body class="nav-md">
<div class="container body">
    <div class="main_container">
        <div class="col-md-3 left_col">
    <div class="left_col scroll-view">
        <div class="navbar nav_title" style="border: 0;">
            <a href="https://insurance.bk-as.dk" class="site_title"><i class="fa fa-paw"></i> <span>B&K!</span></a>
        </div>

        <div class="clearfix"></div>

        <br />
                <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
                <ul class="nav side-menu">
                                            <li><a><i class="fa fa-users"></i> Kundeadministration <span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                                <li><a href="https://insurance.bk-as.dk/dashboard/customers">Alle kunder</a></li>
                                <li><a href="https://insurance.bk-as.dk/dashboard/customer/create">Opret kunde</a></li>
                            </ul>
                        </li>
                        <li><a><i class="fa fa-users"></i> Afdelinger <span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                                <li><a href="https://insurance.bk-as.dk/dashboard/departments">Alle afdelinger</a></li>
                                <li><a href="https://insurance.bk-as.dk/dashboard/department/create">Opret afdeling</a></li>
                            </ul>
                        </li>
                        <li><a><i class="fa fa-users"></i> Brugeradministration <span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                                <li><a href="https://insurance.bk-as.dk/dashboard/users">Alle brugere</a></li>
                                <li><a href="https://insurance.bk-as.dk/dashboard/users/create">Opret bruger</a></li>
                            </ul>
                        </li>
                                                                <li><a><i class="fa fa-briefcase"></i> Skadehåndtering <span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                                <li><a href="https://insurance.bk-as.dk/dashboard/claims">skade liste</a></li>
                            </ul>
                        </li>
                                                                <li><a><i class="fa fa-wrench"></i> Opsætning <span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                                <li><a href="https://insurance.bk-as.dk/dashboard/claim-types">Opsætning</a></li>
                                <li><a href="https://insurance.bk-as.dk/dashboard/claim-mechanics">Håndvækertype</a></li>
                                <li><a href="https://insurance.bk-as.dk/dashboard/teams">Hold</a></li>
                            </ul>
                        </li>
                        <li><a><i class="fa fa-file-archive-o"></i> Beredskabsplan <span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                                <li><a href="https://insurance.bk-as.dk/dashboard/categories">Hændelser</a></li>
                                <li><a href="https://insurance.bk-as.dk/dashboard/content">Indhold</a></li>
                            </ul>
                        </li>

                    
                </ul>
            </div>

        </div>
        <!-- /sidebar menu -->
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
                        <li class="">
                            <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                Admin
                                <span class=" fa fa-angle-down"></span>
                            </a>
                            <ul class="dropdown-menu dropdown-usermenu pull-right">
                               

                                <li><a href="https://insurance.bk-as.dk/logout" onclick="event.preventDefault();
                                                     document.getElementById(\'logout-form\').submit();">
                                        <i class="icon-key"></i> Logout </a>
                                    <form id="logout-form" action="https://insurance.bk-as.dk/logout" method="POST" style="display: none;">
                                        <input type="hidden" name="_token" value="HcqBuNGIj7Sbh7d3eBzW1TURibHQLuBw5SQuciRM">
                                    </form></li>
                            </ul>
                        </li>

                    </ul>
                </nav>
            </div>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
               <ul class="breadcrumb">
        <li><a href="https://insurance.bk-as.dk/dashboard">Admin panel</a></li>
        <li><a href="https://insurance.bk-as.dk/dashboard/departments">Afdeling</a></li>
    </ul>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Departments Lists</h2>
                    <a href="https://insurance.bk-as.dk/dashboard/department/create" class="btn btn-danger pull-right">Opret</a>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="flash-message">
                                                                                                                                                                                                                                                            </div>
                    <form action="https://insurance.bk-as.dk/dashboard/departments" method="GET">
                        <div class="row">
                            <div class="form-group form-group-sm col-md-12 col-lg-12">
                                <div class="row">
                                    <div class="col-md-4 col-lg-4">
                                        <label for="customer_id">
                                            Kunde
                                        </label>
                                        <select id="customer_id" class="form-control" name="search[customer_id]" tabindex="-1" aria-hidden="true">
                                            <option value="">Vælg kunde</option>
                                                                                            <option value="1" >CIKLUM TEST</option>
                                                                                            <option value="2" >Boligforeningen Søbo</option>
                                                                                            <option value="3" selected=&quot;selected&quot;>Bækmark &amp; Kvist</option>
                                                                                            <option value="4" >Ringkøbing-Skjern Boligforening</option>
                                                                                            <option value="5" >Arbejdernes Byggeforening</option>
                                                                                            <option value="8" >Sundby-Hvorup Boligselskab</option>
                                                                                            <option value="9" >BoVendia</option>
                                                                                            <option value="10" >Arbejdernes Boligforening Odense</option>
                                                                                            <option value="11" >Thisted Bolig</option>
                                                                                            <option value="12" >Aars Boligforening</option>
                                                                                            <option value="13" >Sønderborg Andelsboligforening</option>
                                                                                            <option value="14" >Skærbæk Boligforening</option>
                                                                                            <option value="15" >Gråsten Andelsboligforening</option>
                                                                                            <option value="16" >B45</option>
                                            
                                        </select>
                                    </div>
                                    <div class="col-md-4 col-lg-4">
                                        <div class="form-group form-group-sm ">
                                            <label for="customer_id">
                                                &nbsp;
                                            </label>
                                            <div class="">
                                                <button class="btn btn-danger" type="submit">Opdater</button>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </form>
                                        <table id="datatable1" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>Afdeling</th>
                            <td style="width:150px;" class="col-md-3 col-xs-12" >Address</td>
                            <td style="width:150px;" class="col-md-3 col-xs-12" >Post nr.</td>
                            <td style="width:150px;" class="col-md-3 col-xs-12" >By</td>
                            <td style="width:150px;" class="col-md-3 col-xs-12" >Byggeår</td>
                            <td style="width:150px;" class="col-md-3 col-xs-12" >Etageareal</td>
                            <th>Vælg</th>
                        </tr>
                        </thead>
                        <tbody>
                                                                                                                                                                <tr id="content_183"  style="" class="">
                                            <td data-order="1">
                                                1
                                                
                                            </td>
                                            <td style="width: 150px;" class="col-md-3 col-xs-12" >Virkelyst 10-20</td>
                                            <td style="width: 150px;" class="col-md-3 col-xs-12" >9400</td>
                                            <td style="width: 150px;" class="col-md-3 col-xs-12" >Nørresundby</td>
                                            <td style="width: 150px;" class="col-md-3 col-xs-12" >2001</td>
                                            <td style="width: 150px;" class="col-md-3 col-xs-12" >450</td>
                                            <td>
                                                <a href="https://insurance.bk-as.dk/dashboard/department/edit/87" class="btn btn-success">Redigere</a>
                                                <button data-id="87" data-url="https://insurance.bk-as.dk/dashboard/department/delete/87" class="btn btn-danger delete" data-toggle="modal" data-target="#modal-delete">Slet</button>
                                            </td>
                                        </tr>
                                                                                                                                                                                                            <tr id="content_184"  style="" class="">
                                            <td data-order="2">
                                                2
                                                
                                            </td>
                                            <td style="width: 150px;" class="col-md-3 col-xs-12" >Borgmester Jørgensens Vej 14-28</td>
                                            <td style="width: 150px;" class="col-md-3 col-xs-12" >9000</td>
                                            <td style="width: 150px;" class="col-md-3 col-xs-12" >Aalborg</td>
                                            <td style="width: 150px;" class="col-md-3 col-xs-12" >1945</td>
                                            <td style="width: 150px;" class="col-md-3 col-xs-12" >1480</td>
                                            <td>
                                                <a href="https://insurance.bk-as.dk/dashboard/department/edit/88" class="btn btn-success">Redigere</a>
                                                <button data-id="88" data-url="https://insurance.bk-as.dk/dashboard/department/delete/88" class="btn btn-danger delete" data-toggle="modal" data-target="#modal-delete">Slet</button>
                                            </td>
                                        </tr>
                                                                                                                                                                                                            <tr id="content_383"  style="" class="">
                                            <td data-order="25">
                                                25
                                                <br /><br /><a style="cursor:pointer;" class="btn btn-success btn-sm show_more" data-what-to-do="show" data-department-id="189">Load more</a>
                                            </td>
                                            <td style="width: 150px;" class="col-md-3 col-xs-12" >Kirkegade 25-47</td>
                                            <td style="width: 150px;" class="col-md-3 col-xs-12" >9400</td>
                                            <td style="width: 150px;" class="col-md-3 col-xs-12" >Aalborg</td>
                                            <td style="width: 150px;" class="col-md-3 col-xs-12" >1950</td>
                                            <td style="width: 150px;" class="col-md-3 col-xs-12" >250</td>
                                            <td>
                                                <a href="https://insurance.bk-as.dk/dashboard/department/edit/189" class="btn btn-success">Redigere</a>
                                                <button data-id="189" data-url="https://insurance.bk-as.dk/dashboard/department/delete/189" class="btn btn-danger delete" data-toggle="modal" data-target="#modal-delete">Slet</button>
                                            </td>
                                        </tr>
                                                                            <tr id="content_384"  style="display:none" class="toggle-class-189">
                                            <td data-order="25">
                                                
                                                
                                            </td>
                                            <td style="width: 150px;" class="col-md-3 col-xs-12" >Jernbanegade 52-76</td>
                                            <td style="width: 150px;" class="col-md-3 col-xs-12" >9460</td>
                                            <td style="width: 150px;" class="col-md-3 col-xs-12" >Brovst</td>
                                            <td style="width: 150px;" class="col-md-3 col-xs-12" >1950</td>
                                            <td style="width: 150px;" class="col-md-3 col-xs-12" >250</td>
                                            <td>
                                                <a href="https://insurance.bk-as.dk/dashboard/department/edit/189" class="btn btn-success">Redigere</a>
                                                <button data-id="189" data-url="https://insurance.bk-as.dk/dashboard/department/delete/189" class="btn btn-danger delete" data-toggle="modal" data-target="#modal-delete">Slet</button>
                                            </td>
                                        </tr>
                                                                                                                                                                                                            <tr id="content_185"  style="" class="">
                                            <td data-order="3">
                                                3
                                                <br /><br /><a style="cursor:pointer;" class="btn btn-success btn-sm show_more" data-what-to-do="show" data-department-id="89">Load more</a>
                                            </td>
                                            <td style="width: 150px;" class="col-md-3 col-xs-12" >Bøgildsmindevej 51-99</td>
                                            <td style="width: 150px;" class="col-md-3 col-xs-12" >9400</td>
                                            <td style="width: 150px;" class="col-md-3 col-xs-12" >Nørresundby</td>
                                            <td style="width: 150px;" class="col-md-3 col-xs-12" >2012</td>
                                            <td style="width: 150px;" class="col-md-3 col-xs-12" >9974</td>
                                            <td>
                                                <a href="https://insurance.bk-as.dk/dashboard/department/edit/89" class="btn btn-success">Redigere</a>
                                                <button data-id="89" data-url="https://insurance.bk-as.dk/dashboard/department/delete/89" class="btn btn-danger delete" data-toggle="modal" data-target="#modal-delete">Slet</button>
                                            </td>
                                        </tr>
                                                                            <tr id="content_186"  style="display:none" class="toggle-class-89">
                                            <td data-order="3">
                                                
                                                
                                            </td>
                                            <td style="width: 150px;" class="col-md-3 col-xs-12" >Vesterbro 91-117</td>
                                            <td style="width: 150px;" class="col-md-3 col-xs-12" >9000</td>
                                            <td style="width: 150px;" class="col-md-3 col-xs-12" >Aalborg</td>
                                            <td style="width: 150px;" class="col-md-3 col-xs-12" >1952</td>
                                            <td style="width: 150px;" class="col-md-3 col-xs-12" >12369</td>
                                            <td>
                                                <a href="https://insurance.bk-as.dk/dashboard/department/edit/89" class="btn btn-success">Redigere</a>
                                                <button data-id="89" data-url="https://insurance.bk-as.dk/dashboard/department/delete/89" class="btn btn-danger delete" data-toggle="modal" data-target="#modal-delete">Slet</button>
                                            </td>
                                        </tr>
                                                                                                                                                </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
            
            <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
    </div>
</div>

<div id="modal-delete" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Are you sure to delete?</h4>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger delete-confirm">Delete</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>

<!-- jQuery -->
<script src="https://insurance.bk-as.dk/admin/vendors/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="https://insurance.bk-as.dk/admin/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="https://insurance.bk-as.dk/admin/vendors/fastclick/lib/fastclick.js"></script>
<!-- NProgress -->
<script src="https://insurance.bk-as.dk/admin/vendors/nprogress/nprogress.js"></script>
<!-- Chart.js -->
<script src="https://insurance.bk-as.dk/admin/vendors/Chart.js/dist/Chart.min.js"></script>
<!-- gauge.js -->
<script src="https://insurance.bk-as.dk/admin/vendors/gauge.js/dist/gauge.min.js"></script>
<!-- bootstrap-progressbar -->
<script src="https://insurance.bk-as.dk/admin/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
<!-- iCheck -->
<script src="https://insurance.bk-as.dk/admin/vendors/iCheck/icheck.min.js"></script>
<!-- Skycons -->
<script src="https://insurance.bk-as.dk/admin/vendors/skycons/skycons.js"></script>
<!-- Flot -->
<script src="https://insurance.bk-as.dk/admin/vendors/Flot/jquery.flot.js"></script>
<script src="https://insurance.bk-as.dk/admin/vendors/Flot/jquery.flot.pie.js"></script>
<script src="https://insurance.bk-as.dk/admin/vendors/Flot/jquery.flot.time.js"></script>
<script src="https://insurance.bk-as.dk/admin/vendors/Flot/jquery.flot.stack.js"></script>
<script src="https://insurance.bk-as.dk/admin/vendors/Flot/jquery.flot.resize.js"></script>
<!-- Flot plugins -->
<script src="https://insurance.bk-as.dk/admin/vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
<script src="https://insurance.bk-as.dk/admin/vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
<script src="https://insurance.bk-as.dk/admin/vendors/flot.curvedlines/curvedLines.js"></script>
<!-- DateJS -->
<script src="https://insurance.bk-as.dk/admin/vendors/DateJS/build/date.js"></script>
<!-- JQVMap -->
<script src="https://insurance.bk-as.dk/admin/vendors/jqvmap/dist/jquery.vmap.js"></script>
<script src="https://insurance.bk-as.dk/admin/vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
<script src="https://insurance.bk-as.dk/admin/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>

<script src="https://insurance.bk-as.dk/admin/vendors/html-editor/wysihtml5-0.3.0.js"></script>
<script src="https://insurance.bk-as.dk/admin/vendors/html-editor/bootstrap-wysihtml5.js"></script>
<!-- bootstrap-daterangepicker -->
<script src="https://insurance.bk-as.dk/admin/vendors/moment/min/moment.min.js"></script>


<!-- Custom Theme Scripts -->
<script src="https://insurance.bk-as.dk/admin/build/js/custom.min.js"></script>
<script src="https://insurance.bk-as.dk/common/js/common.js"></script>

    <script src="https://insurance.bk-as.dk/admin/vendors/datatables.net/js/jquery.dataTables.min.js "></script>
    <script src="https://insurance.bk-as.dk/admin/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js "></script>
    <script src="https://insurance.bk-as.dk/admin/vendors/datatables.net-buttons/js/dataTables.buttons.min.js "></script>
    <script src="https://insurance.bk-as.dk/admin/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js "></script>
    <script src="https://insurance.bk-as.dk/admin/vendors/datatables.net-buttons/js/buttons.flash.min.js "></script>
    <script src="https://insurance.bk-as.dk/admin/vendors/datatables.net-buttons/js/buttons.html5.min.js "></script>
    <script src="https://insurance.bk-as.dk/admin/vendors/datatables.net-buttons/js/buttons.print.min.js "></script>
    <script src="https://insurance.bk-as.dk/admin/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js "></script>
    <script src="https://insurance.bk-as.dk/admin/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js "></script>
    <script src="https://insurance.bk-as.dk/admin/vendors/datatables.net-responsive/js/dataTables.responsive.min.js "></script>
    <script src="https://insurance.bk-as.dk/admin/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js "></script>
    <script src="https://insurance.bk-as.dk/admin/vendors/datatables.net-scroller/js/dataTables.scroller.min.js "></script>
    <script src="https://insurance.bk-as.dk/admin/vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
    <script>
        jQuery(document).ready(function () {
            $(\'.show_more\').on(\'click\', function () {
                var whatToDO = $(this).attr(\'data-what-to-do\');
                var departmentId = $(this).attr(\'data-department-id\');

                if(whatToDO == \'show\') {
                    $(this).attr(\'data-what-to-do\', \'hide\');
                    $(".toggle-class-"+departmentId).show();
                    $(this).html(\'Hide\');
                } else {
                    $(this).attr(\'data-what-to-do\', \'show\');
                    $(".toggle-class-"+departmentId).hide();
                    $(this).html(\'Load more\');
                }


            });
            $(\'#datatable1\').dataTable(
                {
                    searching: false,
                    paging: false
                }
            );
        });
    </script>
</body>
</html>
';
    return \PDF::loadHTML($html)->setPaper('a4')->setOrientation('landscape')->setOption('margin-bottom', 0)->save('myfile.pdf');
});



Route::group(['middleware' => ['auth', 'is_super_admin']], function() {
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard.index')->middleware(['auth']);
    Route::get('/dashboard/users', 'UsersController@index')->name('users.index');
    Route::get('/dashboard/users/create', 'UsersController@create')->name('users.create');
    Route::post('/dashboard/users/create', 'UsersController@store')->name('users.store');
    Route::get('/dashboard/users/edit/{id}', 'UsersController@edit')->name('users.edit');
    Route::post('/dashboard/users/status/{id}', 'UsersController@status')->name('users.status');

    Route::get('/dashboard/content', 'ContentsController@index')->name('content.index');
    Route::get('/dashboard/content/create', 'ContentsController@create')->name('content.create');
    Route::post('/dashboard/content/create', 'ContentsController@store')->name('content.store');
    Route::get('/dashboard/content/edit/{id}', 'ContentsController@edit')->name('content.edit');
    Route::post('/dashboard/content/delete/{id}', 'ContentsController@delete')->name('content.delete');

    Route::get('/dashboard/categories', 'CategoryController@index')->name('category.index');
    Route::get('/dashboard/category/create', 'CategoryController@create')->name('category.create');
    Route::post('/dashboard/category/create', 'CategoryController@store')->name('category.store');
    Route::get('/dashboard/category/edit/{id}', 'CategoryController@edit')->name('category.edit');
    Route::post('/dashboard/category/delete/{id}', 'CategoryController@delete')->name('category.delete');


    Route::get('/dashboard/teams', 'TeamsController@index')->name('team.index');
    Route::get('/dashboard/team/create', 'TeamsController@create')->name('team.create');
    Route::post('/dashboard/team/create', 'TeamsController@store')->name('team.store');
    Route::get('/dashboard/team/edit/{id}', 'TeamsController@edit')->name('team.edit');
    Route::post('/dashboard/team/delete/{id}', 'TeamsController@delete')->name('team.delete');

    Route::get('/dashboard/categories/all', 'CategoryController@allCategories')->name('category.all');
    Route::get('/dashboard/categories/update', 'CategoryController@categoryUpdate')->name('category.update');
    Route::get('/dashboard/categories/create-json', 'CategoryController@categoryCreate')->name('category.create-json');
    Route::get('/dashboard/categories/remove', 'CategoryController@categoryRemove')->name('category.remove');


    Route::get('/dashboard/claim-types', 'ClaimTypeController@index')->name('claim-type.index');
    Route::get('/dashboard/claim-type/create', 'ClaimTypeController@create')->name('claim-type.create');
    Route::post('/dashboard/claim-type/create', 'ClaimTypeController@store')->name('claim-type.store');
    Route::get('/dashboard/claim-type/edit/{id}', 'ClaimTypeController@edit')->name('claim-type.edit');
    Route::post('/dashboard/claim-type/delete/{id}', 'ClaimTypeController@delete')->name('claim-type.delete');

    Route::get('/dashboard/claim-mechanics', 'ClaimMechanicsController@index')->name('claim-mechanic.index');
    Route::get('/dashboard/claim-mechanic/create', 'ClaimMechanicsController@create')->name('claim-mechanic.create');
    Route::post('/dashboard/claim-mechanic/create', 'ClaimMechanicsController@store')->name('claim-mechanic.store');
    Route::get('/dashboard/claim-mechanic/edit/{id}', 'ClaimMechanicsController@edit')->name('claim-mechanic.edit');
    Route::post('/dashboard/claim-mechanic/delete/{id}', 'ClaimMechanicsController@delete')->name('claim-mechanic.delete');

    Route::get('/dashboard/departments', 'DepartmentController@index')->name('department.index');
    Route::get('/dashboard/department/create', 'DepartmentController@create')->name('department.create');
    Route::post('/dashboard/department/create', 'DepartmentController@store')->name('department.store');
    Route::get('/dashboard/department/edit/{id}', 'DepartmentController@edit')->name('department.edit');
    Route::post('/dashboard/department/delete/{id}', 'DepartmentController@delete')->name('department.delete');


    Route::get('/dashboard/customers', 'CustomersController@index')->name('customer.index');
    Route::get('/dashboard/customer/create', 'CustomersController@create')->name('customer.create');
    Route::post('/dashboard/customer/create', 'CustomersController@store')->name('customer.store');
    Route::get('/dashboard/customer/edit/{id}', 'CustomersController@edit')->name('customer.edit');
    Route::post('/dashboard/customer/delete/{id}', 'CustomersController@delete')->name('customer.delete');
    Route::get('/dashboard/customer/details/{id}', 'CustomersController@details')->name('customer.details');



});

Route::group(['middleware' => ['auth', 'can_access']], function() {

    Route::get('/claim/create', 'ClaimsController@create')->name('claim.create');

    Route::get('/', 'HomeController@index')->name('home.index');


});
Route::group(['middleware' => ['auth']], function() {

    Route::get('/dashboard/claims', 'ClaimsController@index')->name('claim.index');
    Route::get('/dashboard/claim/create', 'ClaimsController@create')->name('claim.create');
    Route::post('/dashboard/claim/create', 'ClaimsController@store')->name('claim.store');
    Route::get('/dashboard/claim/details/{id}', 'ClaimsController@details')->name('claim.details');
    Route::get('/dashboard/claim/edit/{id}', 'ClaimsController@edit')->name('claim.edit');
    Route::post('/dashboard/claim/delete/{id}', 'ClaimsController@delete')->name('claim.delete');

    Route::post('/dashboard/claim/image/delete/{id}', 'ClaimsController@deleteImage')->name('image.delete');
    Route::post('/dashboard/claim/other/fields/update', 'ClaimsController@otherFields')->name('claim.detail.form');

    Route::post('/dashboard/claim/conversation/create', 'ClaimsController@addConversation')->name('claim.conversation.store');

    Route::post('/claim/create', 'ClaimsController@store')->name('claim.create.post');
    Route::get('/department/address/{id}', 'ClaimsController@departmentAddress')->name('department.address');
    Route::get('/customer/departments/{id}', 'DepartmentController@customerDepartments')->name('customer.department');
    Route::get('/customer/departments/grouped/{id}', 'DepartmentController@customerGroupedDepartments')->name('customer.department');
    Route::get('/customer/teams/{id}', 'TeamsController@customerTeams')->name('customer.teams');
    Route::get('/content/list/{categoryId}', 'ContentsController@getList')->name('content.list');
    Route::post('/claim/status', 'ClaimsController@updateStatus')->name('claim.status');
});

Auth::routes();
