<div class="col-md-10 panel panel-primary"> 
    <h4 class="panel-heading"><?php echo $Title; ?></h3>


        <?php
//        All Student
        if ($StudentId == 0) {
            foreach ($SOS as $X) {
                ?>
                <div class="media">
                    <div class="media-left">
                        <img src="<?php echo base_url(); ?>uploads/students/<?php echo $X->Photo; ?>" class="media-object" style="width:60px">
                    </div>
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $X->FullName; ?></h4>
                        <p><?php echo $X->Facult; ?>, <?php echo $X->Session; ?> <br>
                            This student's Total Average Attendance is up to  <strong><?php echo $X->Attendance; ?></strong> 
                            , Result is <strong><?php echo $X->Exam; ?></strong>, Total Evaluation is <strong><?php echo $X->Behave; ?></strong>
                        </p>
                        <iframe src="https://www.facebook.com/plugins/share_button.php?href=<?php echo base_url(); ?>Home/studentofthesemester/<?php echo $X->Id; ?>&layout=button&size=small&mobile_iframe=true&appId=2072543979628136&width=59&height=20" width="59" height="20" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe> 
                    </div>
                </div>
                <?php
            }
        } else {
//            to find out single student to fb share
            foreach ($SOS as $X) {
                if ($X->Id == $StudentId) {
                    
                 
                    ?>
                    <div class="media">
                        <div class="media-left">
                            <img src="<?php echo base_url(); ?>uploads/students/<?php echo $X->Photo; ?>" class="media-object" style="width:60px">
                        </div>
                        <div class="media-body">
                            <h4 class="media-heading"><?php echo $X->FullName; ?></h4>
                            <p><?php echo $X->Facult; ?>, <?php echo $X->Session; ?> Roll: <?php echo $X->RollNo; ?><br>
                                This student's Total Average Attendance is up to  <strong><?php echo $X->Attendance; ?></strong> 
                                , Result is <strong><?php echo $X->Exam; ?></strong>, Total Evaluation is <strong><?php echo $X->Behave; ?></strong>
                            </p>
                            <iframe src="https://www.facebook.com/plugins/share_button.php?href=<?php echo base_url(); ?>Home/studentofthesemester/<?php echo $X->Id; ?>&layout=button&size=small&mobile_iframe=true&appId=2072543979628136&width=59&height=20" width="59" height="20" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe> 
                        </div>
                    </div>
                    <?php
                }
            }
        }
        ?>


</div>
</div>