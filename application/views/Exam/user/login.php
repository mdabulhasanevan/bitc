<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title><?php echo $Title; ?></title>
        
         <link rel="icon" href="<?php echo base_url('dist/img/favicon.jpg')?>" type="image/gif" sizes="16x16">
         <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="<?php echo base_url('dist/css/css/bootstrap.css')?>" rel="stylesheet" type="text/css"/>
        <script src="<?php echo base_url('dist/css/js/jquery.min.js')?>"></script>
        <script src="<?php echo base_url('dist/css/js/bootstrap.min.js')?>"></script>
        
        <link href="<?php echo base_url('dist/css/MyStyle.css')?>" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    </head>
    <body style="margin: auto; width: 40%;"> 
           <div class="col-md-12" style="background-color: #ffffff;">
               
                    <h1>Sign In</h1>
                 
                    <?php
                    if(isset($_SESSION['success']))
                    {
                        echo "<div class='alert alert-success'>".$_SESSION['success']."</div>";       
                    }
                    ?>
                     <?php
                    if(isset($_SESSION['successErr']))
                    {
                        echo "<div class='alert alert-danger'>".$_SESSION['successErr']."</div>";       
                    }
                    ?>
                    
                    <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>
                    
                    <form action="" method="POST">
               
               <div class="form-group">
                   <label for="Email">Email</label>
                   <input class="form-control"  type="email" name="Email" id="Email"/>
               </div>
               
                <div class="form-group">
                   <label for="Password">Password</label>
                   <input class="form-control" type="password" name="Password" id="Password"/>
               </div>
              
                 <div class="form-group">
                  
                     <button class="btn-info" name="Signin" id="Signin">Sign in</button>
               </div>
               </form>
              
           </div>
    </body>
</html>
