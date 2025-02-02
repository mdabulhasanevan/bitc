
<!--content body-->
<div class="col-md-8" style=""> 


    <div class="row" id="LeftRightMenuTab" style="padding: 0px; margin: 0px; ">           
        <div class="row">
            <div class="col-md-12">
                <h5>MISSION OF BITC</h5>
            </div>
            <div class="col-md-12">
                <p style="font-size: 17px; padding: 5px; color: #454545; text-align: justify;"> The primary mission of BITC is to reach the opportunity of getting higher education of international standard to the door-steps of the mass people of this region and provide a high quality professional education at a minimum cost. BITC is also committed to develop students who will achieve the highest academic standards, become analytical and critical thinkers, compassionate and sensitive leaders through coordinated and integrated intellectual and creative efforts and initiatives of faculties, students, educationists and everyone with whom it has contracted as human beings regardless to racial, ethnic, religious or cultural background. Our focus is to achieve unique excellence in academic activities for building a strong foundation for social, cultural,
                    scientific, economic and technological development of our nation. </p>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <!--<h5>BITC at a Glance </h5>-->
            </div>
            <div class="col-md-3">
                <div class="thumbnail" >
                    <a href="#" target="_blank">
                        <img style="margin: 0px; padding: 0px; text-align: center" src="<?php echo base_url('dist/img/website/library.jpg') ?>" alt="bitc Library" style="width:100%">
                        <div class="caption" style="margin: 0px;">
                           <h4  style="margin: 0px; padding: 0px; text-align: center">Library</h4> 
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="thumbnail">
                    <a href="#" target="_blank">
                        <img src="<?php echo base_url('dist/img/website/fastiv 2.jpg') ?>" alt="Nature" style="width:100%">
                        <div class="caption">
                            <h4  style="margin: 0px; padding: 0px; text-align: center">BITC Festivals </h4>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="thumbnail">
                    <a href="#" target="_blank">
                        <img src="<?php echo base_url('dist/img/website/contest.jpg') ?>" alt="Fjords" style="width:100%">
                        <div class="caption">
                          <h4  style="margin: 0px; padding: 0px; text-align: center">Contest </h4>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="thumbnail">
                    <a href="#" target="_blank">
                        <img src="<?php echo base_url('dist/img/blankImage.jpg') ?>" alt="Fjords" style="width:100%">
                        <div class="caption">
                           <h4  style="margin: 0px; padding: 0px; text-align: center">Sports </h4>
                        </div>
                    </a>
                </div>
            </div>
        </div>



    </div>

</div>

<!--right menu-->
<div class="col-md-2 RSide" > 

    <div id="LeftRightMenuTab">
        <h5 style="">Principal Corner</h5>
        <div style="margin: auto;">
            <img class="img-thumbnail"  style="width: 100%;" align="middle" src="<?php echo base_url() ?>dist/img/Principal.jpg"  />
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


