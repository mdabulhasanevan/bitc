
<div ng-controller="DefaultCtrl" class="col-md-10" style="background-color: #ffffff;">

    <div class="col-md-12">
        <h3>Result List  </h3>


        <?php
        if (isset($_SESSION['success'])) {
            echo "<div class='alert alert-success'>" . $_SESSION['success'] . "</div>";
        }
        ?>

        <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>

        <div> <span class="pull-right"><a class="btn btn-info" href="<?php echo base_url("Results/CreateResultPdf"); ?>">Create Post</a></span></div>


    </div>
    <!--List of Post-->
    <br>
    <div class="col-md-12">
        
    <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#BBA">BBA</a></li>
    <li><a data-toggle="tab" href="#CSE">CSE</a></li>
    <li><a data-toggle="tab" href="#Others">Others</a></li>
    </ul>
        
     <div class="tab-content">
    <div id="BBA" class="tab-pane fade in active">
      <h3>BBA All Results</h3>
       <table class="table table-striped">
            <tr>
                <!--<th>SN</th>-->
                <th>Faculty </th>       
                <th>Semester </th>  
                <!--<th>Description </th>-->      
                <th>Year </th>  
                <th>Publish Date </th>
                <th>Comment</th>
                <th>Attachment </th> 
                <th>Action </th>
            </tr>
            <tr ng-repeat="Post in AllPost |filter:{ FacultyName: 'BBA' }">             
                <td>{{Post.FacultyName}} </td>
                <td>{{Post.SemesterID}} </td>
                <td>{{Post.Year}} </td>
                <td>{{Post.PublishDate}} </td>
                <td>{{Post.Comment}}</td>
               <!--<td><span style="white-space:pre-wrap;">{{Post.Description| limitTo: 200}}</span> </td>-->
                <td> <a href="<?php echo base_url(); ?>uploads/ResultPdf/{{Post.File}}" target="_new" >Attachment</a> </td>              

                <td>        
                    <button class="btn btn-warning" data-toggle="modal" data-target="#myModal" ng-click="Edit(Post)" >Edit</button>
                    <button class="btn btn-danger" ng-click="DeleteResultPdf(Post.RID)" >Delete</button>
                </td>
            </tr>
        </table>
    </div>
    <div id="CSE" class="tab-pane fade">
      <h3>CSE All Results</h3>
       <table class="table table-striped">
            <tr>
                <!--<th>SN</th>-->
                <th>Faculty </th>       
                <th>Semester </th>  
                <!--<th>Description </th>-->      
                <th>Year </th>  
                <th>Publish Date </th>
                <th>Comment</th>
                <th>Attachment </th> 
                <th>Action </th>
            </tr>
            <tr ng-repeat="Post in AllPost |filter:{ FacultyName: 'CSE' }">             
                <td>{{Post.FacultyName}} </td>
                <td>{{Post.SemesterID}} </td>
                <td>{{Post.Year}} </td>
                <td>{{Post.PublishDate}} </td>
                <td>{{Post.Comment}}</td>
               <!--<td><span style="white-space:pre-wrap;">{{Post.Description| limitTo: 200}}</span> </td>-->
                <td> <a href="<?php echo base_url(); ?>uploads/ResultPdf/{{Post.File}}" target="_new" >Attachment</a> </td>              

                <td>        
                    <button class="btn btn-warning" data-toggle="modal" data-target="#myModal" ng-click="Edit(Post)" >Edit</button>
                    <button class="btn btn-danger" ng-click="DeleteResultPdf(Post.RID)" >Delete</button>
                </td>
            </tr>
        </table>
    </div>
    <div id="Others" class="tab-pane fade">
      <h3>Others</h3>
      <p></p>
    </div>
   
  </div>    
       

    </div>

    <!-- Add Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" >
        <div class="modal-dialog" role="document" style="">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" ng-click="reset()" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Edit Result</h4>
                </div>
                <div class="modal-body">

                    <form name="SOSForm"  ng-submit="UpdateResultPdf()" >
                        <div class="form-group">
                            <label for="Post">Faculty</label>
                            <select class="form-control" ng-model="Post.FacultyID" name="FacultyID" id="FacultyID">
                                <option value="0">Select </option>
                                <?php
                                foreach ($Faculty as $Fac) {
                                    echo "<option value='" . $Fac->FId . "'>" . $Fac->Name . "</option>";
                                }
                                ?>
                            </select>

                        </div>
                        <div class="form-group">
                            <label for="Post">Semester</label>
                            <select class="form-control" ng-model="Post.SemesterID" name="SemesterID" id="SemesterID">

                                <?php
                                for ($i = 1; $i < 9; $i++) {
                                    echo "<option value='" . $i . "'>" . $i . "</option>";
                                }
                                foreach ($Session as $ses) {
                                    
                                }
                                ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="Name" >Year</label>
                            <input class="form-control" ng-model="Post.Year" name="Year" id="Year"/>
                        </div>

                        <div class="form-group">
                            <label for="Description">Comment</label>
                            <textarea class="form-control" ng-model="Post.Comment" name="Comment" id="Comment">
                    
                            </textarea>
                        </div> 

                        <div class="form-group">
                            <label for="Name" >Publish Date</label>
                            <input class="form-control" ng-model="Post.PublishDate"  name="PublishDate" id="datepicker" autocomplete="off" />
                        </div>
               
            

            <div class="form-group">
                <button class="btn-info" type="submit" name="Signup" id="Signup">Update</button>
            </div>
            </form>

        </div>
        <div class="modal-footer">
            <button type="button" ng-click="reset()" class="btn btn-default" data-dismiss="modal">Close</button>

        </div>
    </div>
</div>
</div>
<!--modal end-->

</div>
</body>
</html>

<script type="text/javascript">

    app.controller("DefaultCtrl", ["$scope", "$http",
        function ($scope, $http) {
            init();
            function init() {
                initialize();
                GetAllResult();

            }
            function initialize() {
                $scope.Post = {};
                $scope.AllPost = [];
                $scope.DeleteResultPdf = DeleteResultPdf;

                $scope.Post = {};
                $scope.Edit = Edit;
                $scope.reset = reset;
                $scope.UpdateResultPdf = UpdateResultPdf;

            }

            function GetAllResult()
            {
                $scope.AllPost = [];
                $http({
                    method: 'GET',
                    url: baseUrl + 'Results/GetAllResultPdf/'
                }).then(function successCallback(response) {
                    $scope.AllPost = response.data;
                }, function errorCallback(response) {
                });
            }

            function UpdateResultPdf()
            {
                console.log($scope.Post);
                if ($scope.Post.RID > 0)
                {
                    $http({
                        method: 'POST',
                        url: baseUrl + 'Results/UpdateResultPdf/',
                        headers: {'Content-Type': 'application/json'},
                        data: JSON.stringify($scope.Post)
                    }).success(function (data) {
                        console.log(data);
                        GetAllResult();
                        $scope.Post = {};
                        $('#myModal').modal('toggle');
                        swal("Successfully Updated", "Result");

                    });
                }
            }
            function DeleteResultPdf(id)
            {
                var RID = id;

                var r = confirm("Do you want to Delete!");
                if (r == true) {
                    $http({
                        method: 'GET',
                        url: baseUrl + 'Results/DeleteResultPdf/' + RID
                    }).then(function successCallback(response) {
                        swal("Post!", "Deleted Successfully!!");
                        GetAllResult();
                    }, function errorCallback(response) {
                        swal("Post!", "Not Deleted!!!!");
                    });

                }
            }


            function Edit(Post)
            {
                $scope.Post = {};
                $scope.Post = Post;
            }

            function reset()
            {
                $scope.Post = {};
            }

        }]);
</script>