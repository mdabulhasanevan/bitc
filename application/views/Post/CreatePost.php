<div class="col-md-9" style="background-color: #ffffff;">

    <h1>Create Post  </h1>
 <div> <span class="pull-right"><a class="btn btn-info" href="<?php echo base_url("Post/MyPost"); ?>">Post List</a></span></div>
 
    <?php
    if (isset($_SESSION['success'])) {
        echo "<div class='alert alert-success'>" . $_SESSION['success'] . "</div>";
    }
    ?>

    <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>

    <form action="" method="POST" enctype="multipart/form-data" >
        <div class="form-group">
            <label for="Name" >Heading</label>
            <input class="form-control" name="Heading" id="Heading"/>
        </div>

        <div class="form-group">
            <label for="Description">Description</label>
            <textarea class="form-control" name="Description" id="Description">
                    
            </textarea>
        </div> 

        <div class="form-group">
            <label for="Post">Faculty</label>
            <select class="form-control" name="Faculty" id="Faculty">
                 <option value="0">Select </option>
                <?php
                foreach ($Faculty as $Fac) {
                    echo "<option value='" . $Fac->FId . "'>" . $Fac->Name . "</option>";
                }
                ?>
            </select>

        </div>

        <div class="form-group">
            <label for="Post">Session</label>
            <select class="form-control" name="Session" id="Session">
                  <option value="0">Select </option>
                <?php
                foreach ($Session as $ses) {
                    echo "<option value='" . $ses->SessionId . "'>" . $ses->Session . "</option>";
                }
                ?>
            </select>
            
            <div class="form-group">
            <label for="DOB">Post Type</label>
            <select class="form-control" name="isPublic" id="MyOrder">
                
             
                 <option value="0">Not Public </option>
                    <option value="1">Public</option>
                
            </select>
        </div>
        </div>
        <div class="form-group">
            <label for="Attachment">Attachment</label>
            <input type="file" class="form-control" name="Attachment" id="Attachment"/>
        </div>


        <div class="form-group">
            <button class="btn-info" name="Signup" id="Signup">Signup</button>
        </div>
    </form>

</div>
</body>
</html>