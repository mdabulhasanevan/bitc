<div class="col-md-9" style="background-color: #ffffff; overflow: hidden;">

    <h1>Create Result  </h1>
   
    <?php
    if (isset($_SESSION['success'])) {
        echo "<div class='alert alert-success'>" . $_SESSION['success'] . "</div>";
    }
    ?>

    <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>

    <div class="col-md-10" >
     <div> <span class="pull-right"><a class="btn btn-info" href="<?php echo base_url("Results/ResultPdf"); ?>">Result List</a></span></div>

    <form action="" method="POST" enctype="multipart/form-data" >
        <div class="form-group">
            <label for="Post">Faculty</label>
            <select class="form-control" required name="FacultyID" id="Faculty">
                <option value="0">Select </option>
                <?php
                foreach ($Faculty as $Fac) {
                    echo "<option value='" . $Fac->FId . "'>" . $Fac->Name . "</option>";
                }
                ?>
            </select>

        </div>
        <div class="">
            <label for="Post">Semester</label>
            <select class="form-control" required name="SemesterID" id="SemesterID">
               
                <?php
                for($i = 1; $i < 9; $i++) {
                    echo "<option value='" . $i . "'>" . $i . "</option>";
                }
                
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="Name" >Year</label>
            <input class="form-control" required type="number" name="Year" id="Year"/>
        </div>

        <div class="form-group">
            <label for="Description">Comment</label>
            <textarea class="form-control"  name="Comment" id="Comment">
                    
            </textarea>
        </div> 

        <div class="form-group">
            <label for="Name" >Publish Date</label>
            <input class="form-control"  name="PublishDate" id="datepicker" autocomplete="off" />
        </div>

        <div class="form-group">
            <label for="Attachment">File</label>
            <input type="file" required class="form-control" name="File" id="Attachment"/>
        </div>


        <div class="form-group">
            <button class="btn-info" name="Add" id="Signup">Add</button>
        </div>
    </form>
    </div>
</div>
</body>
</html>