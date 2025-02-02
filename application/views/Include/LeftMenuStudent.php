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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery.print/1.6.0/jQuery.print.js"type="text/javascript"></script>

        <link href="<?php echo base_url('dist/css/css/bootstrap.css') ?>" rel="stylesheet" type="text/css"/>
        <script src="<?php echo base_url('dist/css/js/bootstrap.min.js') ?>"type="text/javascript"></script>

        <!--jquery ui-->
        <script src="<?php echo base_url('dist/css/js/jquery-ui.js') ?>"type="text/javascript"></script>
        <link href="<?php echo base_url('dist/css/js/jquery-ui.min.css') ?>" rel="stylesheet" type="text/css"/>

        <!--sweet Alert-->
        <script src="<?php echo base_url('dist/sweetalert/sweetalert.min.js') ?>"type="text/javascript"></script>

        <!--chart-->
        <script src="<?php echo base_url() ?>dist/chart/Chart.min.js" type="text/javascript"></script>
        <!--angular-->
        <script src="<?php echo base_url('dist/angular/angular.js') ?>" type="text/javascript"></script>
        <script src="<?php echo base_url('dist/angular/angular-route.js') ?>" type="text/javascript"></script>

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

    <body ng-app="myApp" ng-controller="StudentLoginCtrl" style="overflow: visible; background-color: #e9ebee" >

        <div class="row" >
            <div class="col-md-12" style="background-color: #003399;">
                <div class="row headertop"  style="">
                    <div class="col-md-3">
                        <img src="<?php echo base_url("dist/img/Logo.jpg"); ?>" style="width: 35px;height: 35px;"/>
<!--                        <a href="https://www.expresstechbd.com"> <img src="<?php echo base_url("dist/img/logoExp.JPG"); ?>" style="width: 120px;height: 25px;"/></a>-->
                    </div>
                    <div class="col-md-7">

                    </div>
                    <div class="col-md-2">
                        <div class="" style="padding-top: 5px;">
                            <span style="cursor: pointer; color: white;" class="glyphicon glyphicon-option-vertical"  data-toggle="modal" data-target="#myPasswordModal" title="Change Password"></span> &nbsp; &nbsp;                          
                            <span class="" style="cursor: pointer;color:white;" data-toggle="modal" data-target="#myModal">  <?php echo $_SESSION['FullName'] ?></span> &nbsp;&nbsp;&nbsp;
                            <span style="cursor: pointer;" ><a style="text-decoration-style: none; color: white;" href="<?php echo base_url(); ?>StudentAuth/logout" title="Logout" class="glyphicon glyphicon-off"></a></span>
                        </div>
                    </div>
                </div>

            </div>

            <div  class="col-md-2"   >
                <div class="row" style="margin-right: 1px; background-color: white; min-height: 300px;">
                    <div class="col-md-12" style="text-align: center;">
                        <img ng-src="<?php echo base_url() . "uploads/students/" . $Info->Photo; ?>" class="img-circle"  style="width: 100px; height: 100px; "/>
                        <br><b> <?php echo $Info->FullName; ?>  </b>

                    </div>

                    <div class="col-md-12" style="min-height: 200px;">
                        <table class="table table-bordered table-hover" style="font-size: 12px; margin: 0px; width: 100%">

                            <tr>
                                <th><?php echo $Info->FacultyName; ?> </th>
                                <td> <?php echo $Info->SessionName; ?>(<?php echo $Info->SemesterName; ?>) </td>
                            </tr>
                            <tr>
                                <th>Reg.</th>
                                <td> <?php echo $Info->RegNo; ?> </td>
                            </tr>



                        </table>
                        <h5 style="text-align: center;  background-color: #222; color: white; padding: 2px; margin: 0px;">Todays Classes</h5>
                        <table class="table table-bordered" style="font-size: 12px; margin: 0px; width: 100%" >
                            <tr>
                                <th> Sub</th>
                                <th> Room</th>
                                <th> Time </th>
                            </tr>
                            <tr ng-repeat="FWC in ClassRoutines.Routine| filter:{Day:ToDay}">                        
                                <td> {{FWC.Subject}}</td>
                                <td> {{FWC.Room}}</td>
                                <td><span class=""> {{FWC.StartTime}} - {{FWC.EndTime}}</span></td>
                            </tr>
                        </table>
                    </div>
                </div>

            </div>


