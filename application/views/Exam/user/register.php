
           
           <div class="col-md-9" style="background-color: #ffffff;">
               
                    <h1>Registration Form</h1>
                 
                    <?php
                    if(isset($_SESSION['success']))
                    {
                        echo "<div class='alert alert-success'>".$_SESSION['success']."</div>";       
                    }
                    ?>
                    
                    <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>
                    
                    <form action="" method="POST" enctype="multipart/form-data" >
               <div class="form-group">
                   <label for="Name" >Name</label>
                   <input class="form-control" name="Name" id="Name"/>
               </div>
              <div class="form-group">
                   <label for="Post">Post</label>
                   <select class="form-control" name="Post" id="Post">
                       <?php
                          foreach ($Posts as $post)
                          {
                             echo "<option value='".$post->PId."'>".$post->PostName."</option>";
                          }
                       ?>
                   </select>
                   
               </div>
                <div class="form-group">
                   <label for="AcademicQualification">AcademicQualification</label>
                   <textarea class="form-control" name="AcademicQualification" id="AcademicQualification">
                    
                   </textarea>
               </div> 
               <div class="form-group">
                   <label for="Email">Email</label>
                   <input class="form-control"  type="email" name="Email" id="Email"/>
               </div>
               <div class="form-group">
                   <label for="Mobile">Mobile</label>
                   <input class="form-control" name="Mobile" id="Mobile"/>
               </div>
               <div class="form-group">
                   <label for="Address">Address</label>
                   <textarea class="form-control" name="Address" id="Address"/>
               </textarea>
               </div>
               <div class="form-group">
                   <label for="DOB">Date of Birth</label>
                   <input class="form-control" type="date" name="DOB" id="DOB"/>
               </div>
               <div class="form-group">
                   <label for="Role">Role</label>
                   <select class="form-control" name="Role" id="Role">
                       <?php
                          foreach ($Roles as $role)
                          {
                             echo "<option value='".$role->Id."'>".$role->Role."</option>";
                          }
                       ?>
                   </select>
                   
               </div>
               <div class="form-group">
                   <label for="Photo">Photo</label>
                   <input type="file" class="form-control" name="Photo" id="Photo"/>
               </div>         
               <div class="form-group">
                   <label for="Password">Password</label>
                   <input class="form-control" type="password" name="Password" id="Password"/>
               </div>
               <div class="form-group">
                   <label for="ConPassword" >ConPassword</label>
                   <input class="form-control" type="password" name="ConPassword" id="ConPassword"/>
               </div>
                 <div class="form-group">
                  
                     <button class="btn-info" name="Signup" id="Signup">Signup</button>
               </div>
               </form>
               
           </div>
    </body>
</html>
