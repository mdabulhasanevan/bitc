<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="icon" href="<?php echo base_url('dist/img/favicon.jpg') ?>" type="image/gif" sizes="16x16">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="google-site-verification" content="S8-TER0gGwapPqXjhh8JDKI9A3QFlpmgdc6rOlk5x5k" />

        <!-- You can use Open Graph tags to customize link previews.
         Learn more: https://developers.facebook.com/docs/sharing/webmasters -->
        <meta property="og:url"           content="<?php echo current_url(); ?>" />
        <meta property="og:type"          content="website" />
        <meta property="og:title"         content="<?php
        if (isset($MyNews)) {
            echo $MyNews->Headline;
        }
        ?>" />
        <meta property="og:description"   content="<?php
        if (isset($MyNews)) {
            echo $MyNews->Detail;
        }
        if (isset($MyShareDetail)) {
            echo $MyShareDetail;
        }
        ?>" />
        <meta property="og:image"         content="<?php
        if (isset($Image)) {
            echo $Image;
        } else {
            echo base_url('dist/img/LogoforFb.jpg');
        }
        ?>" />

        <link href="<?php echo base_url('dist/css/css/bootstrap.css') ?>" rel="stylesheet" type="text/css"/>
        <script src="<?php echo base_url('dist/css/js/jquery.min.js') ?>"></script>
        <script src="<?php echo base_url('dist/css/js/bootstrap.min.js') ?>"></script>

        <!--jquery ui-->
        <script src="<?php echo base_url('dist/css/js/jquery-ui.js') ?>"type="text/javascript"></script>
        <link href="<?php echo base_url('dist/css/js/jquery-ui.min.css') ?>" rel="stylesheet" type="text/css"/>

        <!--angular-->
        <script src="<?php echo base_url('dist/angular/angular.js') ?>" type="text/javascript"></script>
        <script src="<?php echo base_url('dist/angular/angular-route.js') ?>" type="text/javascript"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/angular-ui-bootstrap/0.10.0/ui-bootstrap-tpls.min.js"></script>

        <script src="<?php echo base_url('dist/App.js') ?>" type="text/javascript"></script>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">       

        <link href="<?php echo base_url('dist/css/MyStyle.css') ?>" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

        <title><?php echo $Title; ?></title>

        <style>
            .h6css{
                padding: 5px;
                width: 150px;
                background-color: #003399;
                color: white;
                text-align: center;
                font-weight: bold
            }
            
            @media screen and (min-width: 601px) {
                .CollegName {
                    font-size: 50px;
                }
                .Affilited {
                    font-size: 15px;
                }
                .moto {
                    font-size: 18px;
                }
            }

            /* If the screen size is 600px wide or less, set the font-size of <div> to 30px */
            @media screen and (max-width: 600px) {
                .CollegName {
                    font-size: 15px;
                }
                .Affilited {
                    font-size: 10px;
                }
                .moto {
                    font-size: 10px;
                }
                .logoMobile{
                    display: none;
                }
                .breakingMobile{
                    font-size: 10px;
                }
              
            </style>


        </head>

        <body ng-app="myApp">  


            <!--menu-->
            <div class="row" style="background-color: #fff;position: -webkit-sticky; position: sticky; top: 0;z-index:99; ">

                <div class="topnav" id="myTopnav" style=" " >
                    <a href="<?php echo base_url(); ?>" class="active">Home</a>

                    <div class="dropdown">
                        <button class="dropbtn">About Us  
                            <i class="fa fa-caret-down"></i>
                        </button>
                        <div class="dropdown-content">
                            <a href="<?php echo base_url(); ?>home/about">About BITC</a>
                            <a href="<?php echo base_url(); ?>academic/teacher">Teacher Info</a>
                            <a href="<?php echo base_url(); ?>academic/student">Student Info</a>
                            <a href="<?php echo base_url(); ?>academic/staff">Office Staff Info</a>
                            <a href="<?php echo base_url(); ?>archive/Ex_Teacher">Ex_Teacher</a>
                            <a href="<?php echo base_url(); ?>archive/Ex_Students">Ex_Students</a>
                        </div>
                    </div> 

                    <div class="dropdown">
                        <button class="dropbtn">Academic  
                            <i class="fa fa-caret-down"></i>
                        </button>
                        <div class="dropdown-content">
                            <a href="<?php echo base_url(); ?>academic/holidays">Holiday Calender</a>
                            <a href="<?php echo base_url(); ?>academic/academic">Academic Calender</a>
                            <a href="<?php echo base_url(); ?>academic/rules_regulation">Rules and Regulation Info</a>
                            <a href="<?php echo base_url(); ?>academic/class_routine">Class Routine</a>
                            <a href="<?php echo base_url(); ?>academic/syllabus">Syllabus</a>

                        </div>
                    </div> 
                    <div class="dropdown">
                        <button class="dropbtn">Department  
                            <i class="fa fa-caret-down"></i>
                        </button>
                        <div class="dropdown-content">
                            <a href="<?php echo base_url(); ?>department/CSE">CSE</a>
                            <a href="<?php echo base_url(); ?>department/BBA">BBA</a>
                            <a href="<?php echo base_url(); ?>department/MBA">MBA</a>
                            <a href="<?php echo base_url(); ?>department/Diploma">Diploma</a>

                        </div>
                    </div> 
                    <a href="<?php echo base_url(); ?>Home/research">Research & Projects</a>
                    <a href="<?php echo base_url(); ?>Home/notice">Notice</a>
                    <a href="<?php echo base_url(); ?>Home/Result">Results </a>   
                    <a href="<?php echo base_url(); ?>Home/Contact">Contact</a>
                    <a href="<?php echo base_url(); ?>Home/gallery">Gallery</a>
                    <a href="<?php echo base_url(); ?>archive/Magazine">Magazine</a>

                    <span class= "pull-right">
                        <a class= "" href="<?php echo base_url(); ?>Auth/login" target="_New"><b>Login</b></a>
                        <a  href="<?php echo base_url(); ?>StudentAuth/login" target="_New"><b>Student Login</b></a>
                    </span>

                    <a href="javascript:void(0);" class="icon" onclick="myFunction()">
                        <i class="fa fa-bars"></i>
                    </a>
                </div>

            </div>

            <!--Header Image and Logo-->
            <div class="row CollegName" style="padding-top: 0px; background-color: #EAF9A0; background-image: linear-gradient(white, white,white);" >   
                <div class="col-md-12 header1" style="text-align: center; padding-top: 0px; background-color: #EAF9A0;  background-image: linear-gradient(white, white,white);" > 

                    <div class="logoMobile col-md-1" style=" margin-bottom: 5px; padding: 5px">
                        <a  href="<?php echo base_url(); ?>"><img class="img-responsive" src="<?php echo base_url('dist/img/Logo.jpg') ?>" width="90" height="90"  alt=""/> </a>

                    </div>
                    <div class="col-md-11" style="padding-top: 0px; background-color: #EAF9A0; background-image: linear-gradient(white, white,white);">
                        <div class="col-md-12 Affilited" style="color: #0f0f0f; font-weight: bolder;font-family: serif; margin-bottom:0px; " class="pull-right">Affiliated with National University</div>
                        <div class="col-md-12 CollegName" style="color:#000099; text-shadow: 2px 2px white; font-family: fantasy;   margin-top:-5px; padding-top:0px;" class="pull-right">Barisal Information Technology College (BITC)</div>
                        <div class="col-md-12 moto" style=" color: #761c19;font-family: serif; margin-top:-5px; padding-top:0px;" class="pull-right">Our Commitment is to provide world class Education at Minimum Cost</div>                
                    </div>
                </div>

            </div>

            <!--slider-->
            <?php
            if (isset($slide)) {
                ?> 

                <!--slider-->

                <div id="myCarousel" class="row carousel slide" data-ride="carousel">
                    <!--Indicators--> 
                    <ol class="carousel-indicators">
                        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                        <li data-target="#myCarousel" data-slide-to="1"></li>
                        <li data-target="#myCarousel" data-slide-to="2"></li>
                        <li data-target="#myCarousel" data-slide-to="3"></li>
                        <li data-target="#myCarousel" data-slide-to="4"></li>
                        <li data-target="#myCarousel" data-slide-to="5"></li>
                        <li data-target="#myCarousel" data-slide-to="6"></li>
                        <!--<li data-target="#myCarousel" data-slide-to="7"></li>-->

                    </ol>

                    <!--Wrapper for slides--> 
                    <div class="carousel-inner">
<!--                        <div class="item active">
                            <img src="<?php echo base_url('dist/img/slider/1.jpg') ?>" alt="Los Angeles" style="width:100%;">
                        </div>-->
                        
                        <div class="item active">
                            <img src="<?php echo base_url('dist/img/slider/5.jpg') ?>" alt=" " style="width:100%;">
                        </div>

                        <div class="item ">
                            <img src="<?php echo base_url('dist/img/slider/2.jpg') ?>" alt="Chicago" style="width:100%;">
                        </div>

                        <div class="item">
                            <img src="<?php echo base_url('dist/img/slider/3.jpg') ?>" alt=" " style="width:100%;">
                        </div>

                        <div class="item">
                            <img src="<?php echo base_url('dist/img/slider/4.jpg') ?>" alt=" " style="width:100%;">
                        </div>


                        <div class="item">
                            <img src="<?php echo base_url('dist/img/slider/6.jpg') ?>" alt=" " style="width:100%;">
                        </div>
                        <div class="item">
                            <img src="<?php echo base_url('dist/img/slider/9.jpg') ?>" alt=" " style="width:100%;">
                        </div>
                        <div class="item">
                            <img src="<?php echo base_url('dist/img/slider/8.jpg') ?>" alt=" " style="width:100%;">
                        </div>
                    </div>

                    <!--Left and right controls--> 
                    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="right carousel-control" href="#myCarousel" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
                <!--slider end-->

    <?php
}
?>

            <!--Breaking News-->
            <div class="row" style="background-color: #0f0f0f; border: 0px solid #419641; text-shadow: calc; margin-bottom: 3px; ">
                <div div class="col-md-12" style="font-size: 15px; padding-left: 0px;">
    <!--                <span class="pull-left btn btn-info"  >
                        Latest News
                    </span>-->

                    <span class=" col-md-12"><b  style="color: red;font-size: 18px;" > 
                            <marquee class="breakingMobile">

                                <?php
                                if ($row != null) {
                                    foreach ($row as $News) {
                                        ?>
                                        *  <a href="<?php echo base_url() . 'Home/NoticeOpen/' . $News->BrId ?>"  style="text-decoration: none; color: white;">
                                        <?php echo $News->Headline; ?> &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                                        </a>
                                            <?php
                                        }
                                    }
                                    ?>


                            </marquee>
                        </b>
                    </span>

                </div>

            </div>


            <!--Left Side-->

            <div class="row contBody">

                <div class="col-md-2 LSide "> 

                    <div style="" id="LeftRightMenuTab"> 
                        <h5 style=""><blink>Admission Corner</blink></h5>
                        <div align="center">
                            <h3>CSE & BBA</h3>
                            <h4><a class="btn btn-small btn-info"  href="<?php echo base_url(); ?>Home/AdmissionDetail"><span class=""> Admission Detail</span></a></h4>
                            <h4><a class="btn btn-small btn-danger"  href="<?php echo base_url(); ?>Home/AdmissionApplyReg"><span class="blink"> Online Registration Open</span></a></h4>

                            <script>
                                function blinker() {
                                    $('.blink').fadeOut(400).fadeIn(400);
                                }
                                setInterval(blinker, 1000);
                            </script>
                        </div>

                    </div>


                    <div style="" id="LeftRightMenuTab"> 
                        <h5 style="">Student of the Semester</h5>

                        <div id="myCarousel" class="carousel slide" data-ride="carousel" data-interval="8000">

                            <!-- Wrapper for slides -->
                            <div class="carousel-inner">
                        <?php
                        $i = 0;
                        foreach ($SOS as $X) {
                            if ($i == 0) {
                                $isActive = "active";
                            } else {
                                $isActive = "";
                            }
                            ?>
                                    <div class = "item <?php echo $isActive; ?>">
                                        <img class="img-thumbnail" src = "<?php echo base_url(); ?>uploads/students/<?php echo $X->Photo; ?>" alt = "<?php echo $X->FullName; ?>" style = "width:100%; height: 80%; ">

                                        <div class = "" style = " background-color: #419641; opacity: .9; padding: 0px; top: 160px; width: 100%; color: white; " >
                                            <a class = "btn btn-primary btn-block" style = "text-decoration-line: none; text-decoration-style: solid #fff; width:100%;" href = "<?php echo base_url(); ?>Home/studentofthesemester/0"><?php echo $X->FullName; ?></a>
                                            <p style = "text-align: center;">
    <?php echo $X->Facult; ?>,
    <?php echo $X->Session; ?>
                                            </p>

                                        </div>
                                    </div>
    <?php
    $i++;
}
?>





                            </div>

                            <!-- Left and right controls -->
                            <!-- <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                                 <span class="glyphicon glyphicon-chevron-left"></span>
                                 <span class="sr-only">Previous</span>
                             </a>
                             <a class="right carousel-control" href="#myCarousel" data-slide="next">
                                 <span class="glyphicon glyphicon-chevron-right"></span>
                                 <span class="sr-only">Next</span>
                             </a> -->
                        </div>



                    </div>
<!--
                    <div style="" id="LeftRightMenuTab"> 
                        <h5 style="">জাতীয় ই তথ্যকোষ</h5>
                        <div align="center"><a href="http://www.infokosh.gov.bd/" target="_blank" title="National E-Information" style="text-align:center;">
                                <img src="<?php echo base_url(); ?>dist/img/bdtothokosh.jpg" width="160" height="59" alt="National E-Information" align="middle"></a></div>
                    </div>-->

                </div>




                <script>
                    function myFunction() {
                        var x = document.getElementById("myTopnav");
                        if (x.className === "topnav") {
                            x.className += " responsive";
                        } else {
                            x.className = "topnav";
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

                </script>