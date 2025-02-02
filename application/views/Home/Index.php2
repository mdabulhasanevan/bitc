
<!--content body-->
<div class="col-md-8" style=""> 

    <!--slider-->

    <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
            <li data-target="#myCarousel" data-slide-to="3"></li>
            <li data-target="#myCarousel" data-slide-to="4"></li>
            <!--       <li data-target="#myCarousel" data-slide-to="5"></li>-->

        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner">
            <div class="item active">
                <img src="<?php echo base_url('dist/img/slider/slide6.jpg') ?>" alt="Los Angeles" style="width:100%;">
            </div>

            <div class="item">
                <img src="<?php echo base_url('dist/img/slider/slide2.jpg') ?>" alt="Chicago" style="width:100%;">
            </div>

            <div class="item">
                <img src="<?php echo base_url('dist/img/slider/slide3.jpg') ?>" alt="New york" style="width:100%;">
            </div>

            <div class="item">
                <img src="<?php echo base_url('dist/img/slider/slide4.jpg') ?>" alt="New york" style="width:100%;">
            </div>

            <div class="item">
                <img src="<?php echo base_url('dist/img/slider/slide5.jpg') ?>" alt="New york" style="width:100%;">
            </div>

            <!--        <div class="item">
                    <img src="<?php echo base_url('dist/img/slider/slide6.jpg') ?>" alt="New york" style="width:100%;">
                  </div>-->
        </div>

        <!-- Left and right controls -->
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
    <div id="LeftRightMenuTab" style="padding: 5px; height: 250px;">           
        <h5 >MISSION OF BITC</h5>
        <p style="font-size: 17px; color: #454545"> The primary mission of BITC is to reach the opportunity of getting higher education of international standard to the door-steps of the mass people of this region and provide a high quality professional education at a minimum cost. BITC is also committed to develop students who will achieve the highest academic standards, become analytical and critical thinkers, compassionate and sensitive leaders through coordinated and integrated intellectual and creative efforts and initiatives of faculties, students, educationists and everyone with whom it has contracted as human beings regardless to racial, ethnic, religious or cultural background. Our focus is to achieve unique excellence in academic activities for building a strong foundation for social, cultural,
            scientific, economic and technological development of our nation. </p>
    </div>

</div>

<!--right menu-->
<div class="col-md-2 RSide"> 

    <div id="LeftRightMenuTab">
        <h5 style="">Principal Corner</h5>
        <div style="margin: auto;">
            <img class="img-thumbnail center" style="width: inherit;" align="middle" src="<?php echo base_url() ?>dist/img/Principal.jpg"  />
            <a class="btn btn-success"href="<?php echo base_url("Home/principal"); ?>" style="width: 100%;">দুটি কথা</a>
        </div>
    </div>

    <div id="LeftRightMenuTab">

        <h5 style="">Official Notice</h5>
        <marquee behavior="scroll" direction="up" scrolldelay="250" onmouseover="this.stop();" onmouseout="this.start();" style="text-align:center; height:250px; line-height:normal;">

            <ul style="margin-left:-20px;">

                <?php
                foreach ($rowAll as $News) {
                    echo "<li style='margin-left:-0px; text-align:left;'><a href='" . base_url() . 'Home/NoticeOpen/' . $News->BrId . "' title='' ><b>" . $News->Headline . " </b></a></li>";
                }
                ?>
            </ul>
        </marquee>
    </div>
<!--
    <div style=" " id="LeftRightMenuTab"> 
        <h5 style="">Gov. Form Download</h5>
        <div align="center">
            <a href="http://www.forms.gov.bd/" target="_blank" title="All Government Form Download" style="text-align:center;">
                <img  src="<?php echo base_url(); ?>dist/img/govform.jpg" width="160" height="46" alt="All Government Form Download" align="middle"></a></div>
    </div>-->



</div>

</div>


