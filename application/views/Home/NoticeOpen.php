 <div  class="col-md-8 panel panel-primary"> 
    <h3 class="panel-heading"><?php echo $Title; ?></h3>
        <h3><?php echo $MyNews->Headline; ?></h3>
        <h5>Date: <?php echo $MyNews->Date; ?></h5>

<p><?php echo$MyNews->Detail;?> </p>
<?php 
if($MyNews!=null && $MyNews->Other !=""){
    ?>
    <embed src="<?php echo base_url().'uploads/'.$MyNews->Other ?>" type="application/pdf" width="100%" height="600px" />
<a class="btn btn-primary" href="<?php echo base_url().'uploads/'.$MyNews->Other ?>" target="_New" style="text-decoration: none;">
  Down Load File
     </a>
<?php
}
?>
<hr>
 
  <iframe src="https://www.facebook.com/plugins/share_button.php?href=<?php  echo current_url();   ?>&layout=button&size=small&mobile_iframe=true&appId=2072543979628136&width=59&height=20" width="59" height="20" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe> 
    </div>
<!--Right side-->
 <div class="col-md-2 RSide"> 
        
     <div id="LeftRightMenuTab">
   <h5 style="">Official Notice</h5>
   <marquee behavior="scroll" direction="up" scrolldelay="250" onmouseover="this.stop();" onmouseout="this.start();" style="text-align:center; height:350px; line-height:normal;">

  <ul style="margin-left:-20px;">
      
      <?php 
      foreach($rowAll as $News)
      {
          echo "<li style='margin-left:-0px; text-align:left;'><a href='".base_url().'Home/NoticeOpen/'.$News->BrId ."' title='' ><b>".$News->Headline." </b></a></li>";
        
      }
      
      ?>
  
  
   
   </ul>
   </marquee>
     </div>
    </div>


</div>