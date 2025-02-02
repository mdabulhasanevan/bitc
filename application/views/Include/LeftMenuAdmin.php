<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">

        <title><?php echo $Title; ?></title>

        <link rel="icon" href="<?php echo base_url('dist/img/favicon.jpg') ?>" type="image/gif" sizes="16x16">
        <meta name="viewport" content="width=device-width, initial-scale=1">


        <script src="<?php echo base_url('dist/jquery.min.js') ?>"type="text/javascript"></script>

        <!--angular-->
        <script src="<?php echo base_url('dist/angular/angular.js') ?>" type="text/javascript"></script>
        <script src="<?php echo base_url('dist/angular/angular-route.js') ?>" type="text/javascript"></script>



        <!--//for print-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery.print/1.6.0/jQuery.print.js"type="text/javascript"></script>
        <link href="<?php echo base_url('dist/css/css/bootstrap.css') ?>" rel="stylesheet" type="text/css"/>
        <script src="<?php echo base_url('dist/css/js/bootstrap.min.js') ?>"type="text/javascript"></script>

        <!--jquery ui-->
        <script src="<?php echo base_url('dist/css/js/jquery-ui.js') ?>"type="text/javascript"></script>
        <link href="<?php echo base_url('dist/css/js/jquery-ui.min.css') ?>" rel="stylesheet" type="text/css"/>


        <!--Data Table-->
   <!--<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.15/angular.min.js"></script>-->
        <script src="<?php echo base_url('dist/Table/angular-datatables.min.js') ?>"></script>
        <script src="<?php echo base_url('dist/Table/jquery.dataTables.min.js') ?>"></script>
        <link rel="stylesheet" href="<?php echo base_url('dist/Table/datatables.bootstrap.css') ?>">

        <!--sweet Alert-->
        <script src="<?php echo base_url('dist/sweetalert/sweetalert.min.js') ?>"type="text/javascript"></script>

        <!--chart-->
        <script src="<?php echo base_url() ?>dist/chart/Chart.min.js" type="text/javascript"></script>

        <!--toastr-->
        <script type="text/javascript" src="<?php echo base_url('dist/angular/angular-growl-notifications.min.js') ?>"></script>
        <script src="<?php echo base_url('dist/App.js') ?>" type="text/javascript"></script>

        <!--//try to download this file-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/angular-ui-bootstrap/0.10.0/ui-bootstrap-tpls.min.js"></script>



        <link href="<?php echo base_url('dist/css/MyStyle.css') ?>" rel="stylesheet" type="text/css"/>

        <!--//try to download this file-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

        <!--Menu-->
        <link href="<?php echo base_url('dist/menu/AdminMenustyles.css') ?>" rel="stylesheet" type="text/css"/>
        <script src="<?php echo base_url('dist/menu/AdminMenuscript.js') ?>"type="text/javascript"></script>




    </head>

    <body ng-app="myApp" style="width: 98%"  onload="loadImage()">

        <div class="row" style="background-color: #ffffff;">
            <div class="col-md-12">
                <div class="row headertop" style="background-color: slateblue">
                    <div class="col-md-3">
                        <img src="<?php echo base_url("dist/img/Logo.jpg"); ?>" style="width: 35px;height: 35px;"/>
                        <!--<a href="https://www.expresstechbd.com"> <img src="<?php echo base_url("dist/img/logoExp.JPG"); ?>" style="width: 120px;height: 35px;"/></a>-->
                    </div>
                    <div class="col-md-6">

                    </div>
                    <div class="col-md-3">
                         <span style="cursor: pointer; color: white;" class="glyphicon glyphicon-option-vertical"  data-toggle="modal" data-target="#myPasswordModal" title="Change Password"></span> &nbsp; &nbsp;               
                        <img class="img-rounded" src="<?php echo base_url("uploads/users/") . $_SESSION["Photo"]; ?>" style="width: 35px;height: 35px;"/>
                        <span class="" style="color:white;"> <?php echo substr($_SESSION['Name'], 0, 10) ?></span> &nbsp;&nbsp;&nbsp;
                        <span ><a href="<?php echo base_url(); ?>Auth/logout" class="btn btn-danger glyphicon glyphicon-off"></a></span>
                    </div>
                </div>
            </div>

            <div class="col-md-2"  style="background-color: #ffffff;" ng-controller="DashBoardAllModalCtrl" >

                <a href="javascript:void(0);" class="icon2" id="icon2" onclick="myFunction()">
                    <i class="fa fa-bars"></i>
                </a>

                <div id='cssmenu'>
                    <ul>   
                        <li> <a class="btn" href="<?php echo base_url(); ?>"><span class="glyphicon glyphicon-home"> </span> Goto Web Site</a>  </li>
                        <?php
                        foreach ($_SESSION["Menu1"] as $x) {
                            $count = 0;
                            $hasSub = '';
                            foreach ($_SESSION["Menu2"] as $y) {
                                if ($y->MainMenuID == $x->ID) {
                                    $count++;
                                }
                            }
                            if ($count > 0) {
                                $hasSub = 'has-sub';
                            }
                            ?>
                            <li class='<?php echo $hasSub; ?>'><a class="btn" href="<?php echo base_url() . $x->Url; ?>"><span class="<?php echo $x->Icon; ?>"> </span> <?php echo $x->MenuName; ?></a>
                                <?php
                                foreach ($_SESSION["Menu2"] as $y) {
                                    if ($y->MainMenuID == $x->ID) {
                                        ?>
                                        <ul>
                                            <li class=""> <a class="btn" href="<?php echo base_url() . $y->Url; ?>"><span class="<?php echo $y->Icon; ?>"> </span> <?php echo $y->MenuName; ?></a></li>
                                        </ul>
                                        <?php
                                    }
                                }
                                ?>
                            </li>  
                            <?php
                        }
                        ?>
                    </ul>

                </div>

                <div class="fixed" style=" position: fixed;  bottom: 0;  right: 0; z-index: 500;">
                    <a href="https://www.expresstechbd.com"> <img src="<?php echo base_url("dist/img/logoExp.JPG"); ?>" style="width: 120px;height: 30px;"/></a>
                </div>


                <!-- Change Password Modal -->
                <div id="myPasswordModal" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                        <!--  Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">

                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Change Password</h4>
                            </div>
                            <div class="modal-body">
                                <form name="PasForm" ng-submit="Changepassword()" />
                                <div class="form-group">
                                    <label for="Attendance">Password</label>
                                    <input type="password" class="form-control" ng-model="Pas.Password" name="Password" required/>

                                </div>
                                <div class="form-group">
                                    <label for="Exam" >Re Password</label>
                                    <input type="password" class="form-control" ng-model="Pas.RePassword" required name="RePassword"/>
                                </div>



                                <div class="form-group">

                                    <button type="Submit" class="btn btn-info" name="Create" id="Create">Save</button>
                                </div>
                                </form>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!--Menu resonsive-->
            <script>
                var x = 1;
                function myFunction() {
                    var cssmenu = document.getElementById("cssmenu");

                    if (x == 1)
                    {
                        document.getElementById("cssmenu").style.display = "block";
                        x = 0;
                    }
                    else
                    {
                        cssmenu.style.display = "none";
                        x = 1;
                    }


                }


                $(function () {
                    $("#datepicker").datepicker({
                        dateFormat: 'yy/mm/dd',
                        changeMonth: true,
                        changeYear: true,
                        yearRange: '-100y:c+nn',
                        maxDate: '+1d'
                    });
                });
                $(function () {
                    $("#datepicker2").datepicker({
                        dateFormat: 'yy/mm/dd',
                        changeMonth: true,
                        changeYear: true,
                        yearRange: '-100y:c+nn',
                        maxDate: '+1d'
                    });
                });
                $(function () {
                    $("#datepicker3").datepicker({
                        dateFormat: 'yy/mm/dd',
                        changeMonth: false,
                        changeYear: false,
                        yearRange: '-100y:c+nn',
                        maxDate: '+1d'
                    });
                });

            </script>

            <script type="text/javascript">

                app.controller("DashBoardAllModalCtrl", ["$scope", "$http",
                    function ($scope, $http) {
                        init();
                        function init() {
                            initialize();

                        }
                        function initialize() {

                            $scope.Changepassword = Changepassword;
                            $scope.Pas = {};

                        }


                        function Changepassword()
                        {

                            var r = confirm("Are you want to Change Password");

                            if (r == true)
                            {
                                if ($scope.Pas.Password == $scope.Pas.RePassword && $scope.Pas.Password.length>=6 )
                                {
                                    $http({
                                        method: 'POST',
                                        url: baseUrl + 'User/Changepassword/',
                                        headers: {'Content-Type': 'application/json'},
                                        data: JSON.stringify($scope.Pas)

                                    }).then(function successCallback(response) {
                                        $scope.Result = response.data;
                                        //  console.log($scope.Result);
                                        if ($scope.Result)
                                        {
                                            $('#myPasswordModal').modal('toggle');
                                            swal("Successfully Updated", "Password");
                                        }
                                    }, function errorCallback(response) {
                                    });

                                    $scope.Pas = {};
                                }
                                else {
                                    alert("Password Not Match or Password less than 6");
                                }

                            }
                        }

                    }]);

            </script>
