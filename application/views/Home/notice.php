
<div  class="col-md-10 panel panel-primary"> 
    <h3 class="panel-heading"><?php echo $Title; ?></h3>

    <table class="table table-bordered">
        <tr style="background-color: #66afe9;">
            <th>Headline</th>
            <!--<th>Detail </th>-->
            <th>Date</th>
            <th>Type </th>
            <th>Action </th>

        </tr>

        <?php
        foreach ($rowAll as $News) {
            echo "<tr>";

            echo "<td><a href='" . base_url() . 'Home/NoticeOpen/' . $News->BrId . "' title='' ><b>" . $News->Headline . " </b></a></td>";
//      echo "<td>".$News->Detail."</td>";
            echo "<td>" . $News->Date . "</td>";
            echo "<td>" . $News->NewsType . " </td>";
            echo "<td>";
            if($News->Other!=''){
              echo  "<a class='glyphicon glyphicon-download-alt' href='" . base_url() . "uploads/" . $News->Other . "' target='_New'></a>";
                
            };
            ?>
           <?php   
            echo "<a href='" . base_url() . 'Home/NoticeOpen/' . $News->BrId . "' title='' class='glyphicon glyphicon-eye-open' ></a>";
           ?>
            <iframe src="https://www.facebook.com/plugins/share_button.php?href=<?php echo base_url(); ?>Home/NoticeOpen/<?php echo $News->BrId; ?>&layout=button&size=small&mobile_iframe=true&appId=2072543979628136&width=59&height=20" width="59" height="20" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe> 
            <?php
            echo "</td>";

            echo "</tr>";
        }
        ?>
    </table>
</div>
</div>