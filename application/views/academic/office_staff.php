 <div class="col-md-10 panel panel-primary"> 
        <h3 class="panel-heading"><?php echo $Title; ?></h3>
<table class="table table-responsive  table-hover">
   <thead>
    <tr  class="bg-info">
        <th>Name</th>
        <th>Post</th>
        <th>Email</th>
        <th>Mobile</th>
        <th>Photo</th>
    </tr>
    </thead>
    <?php
    foreach ($staff as $row)
    {
        ?>
    <tr>
    <td><?php echo $row->Name;  ?> </td>
    <td> <?php echo $row->PostName;  ?> </td>
    <td><?php echo $row->Email;  ?> </td>
    <td><?php echo $row->Mobile;  ?> </td>
    <td> <img src="<?php echo base_url('uploads/users/'). $row->Photo;  ?>" width="50" height="50" </td>
    </tr>
    <?php
    }
    
    ?>
</table>
    </div>
</div>