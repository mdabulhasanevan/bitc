
<div ng-controller="DefaultCtrl" class="col-md-10" style="background-color: #ffffff;">

    <div class="col-md-12">
        <h1>Your Submitted Posts  </h1>


        <?php
        if (isset($_SESSION['success'])) {
            echo "<div class='alert alert-success'>" . $_SESSION['success'] . "</div>";
        }
        ?>

        <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>

        <div> <span class="pull-right"><a class="btn btn-info" href="<?php echo base_url("Post/CreatePost"); ?>">Create Post</a></span></div>


    </div>
    <!--List of Post-->
    <br>
    <div class="col-md-12">
        <table class="table table-striped">
            <tr>
                <!--<th>SN</th>-->
                <th>Date </th>       
                <th>Heading </th>  
                <!--<th>Description </th>-->  
                <th>Attachment </th>  
                <th>Faculty </th>  
                <th>Session </th>
                <th>Is Public </th> 
                <th>Action </th>
            </tr>
            <tr ng-repeat="Post in AllPost">
                <!--<td>{{$index + 1}} </td>-->
                <td>{{Post.Date}} </td>
                <td>{{Post.Heading}} </td>
                <!--<td><span style="white-space:pre-wrap;">{{Post.Description| limitTo: 200}}</span> </td>-->
                <td> <a href="<?php echo base_url(); ?>uploads/userpost/{{Post.Attachment}}" target="_new" >Attachment</a> </td>
                <td>{{Post.FacultyName}} </td>
                <td>{{Post.SessionName}} </td>
                <td>{{Post.isPublic}} </td>
                <td>
                    <span style="margin: 0px; padding: 0px; cursor: pointer; color: #3c3c3c; font-weight: bolder;"  data-toggle="modal" data-target="#ShowPostMore" ng-click="ShowPostMore(Post);">View</span>
                    <button class="btn btn-warning" data-toggle="modal" data-target="#myModal" ng-click="Edit(Post)" >Edit</button>
                    <button class="btn btn-danger" ng-click="DeletePost(Post.PId)" >Delete</button></td>
            </tr>
        </table>

    </div>

    <!-- Show Post More Modal -->
    <div id="ShowPostMore" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!--  Modal content-->
            <div class="modal-content">
                <div class="modal-header">

                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                    <div class="media"  style="margin-bottom: 4px; background-color: #ffffff; padding: 10px;  border-radius: 10px;">
                        <div class="media-left">
                            <img class="img-circle" src="<?php echo base_url(); ?>uploads/users/{{PostMore.Photo}}" height="60" width="60" /> 
                        </div>
                        <div class="media-body">
                            <span style="color: #003399; font-weight: bolder; font-size: 14px;">{{PostMore.TeacherName}}</span> 
                            <br> <span class="" style="font-size: 10px; padding: 0px; margin: 0px;"> {{PostMore.Date}} </span>
                        </div>
                    </div>
                </div>
                <div class="modal-body">
                    <!--posts-->
                    <div class=""  style="margin-bottom: 4px; background-color: #ffffff; padding: 10px;  border-radius: 10px;">
                        <h4 style="padding: 0px; margin: 0px; color: #000; text-align: left; ">{{PostMore.Heading}} </h4>
                        <span > 
                            <span style="white-space:pre-wrap;">{{PostMore.Description}}</span>
                            <br>
                            <a ng-show="PostMore.Attachment" href="<?php echo base_url(); ?>uploads/userpost/{{PostMore.Attachment}}" target="_new" ><span class="glyphicon glyphicon-download"></span>Attachment</a>             
                        </span>
                    </div>
                    <hr>

                    <!--Comment List-->
                    <div>
                        <div class="media" ng-repeat="Cmnt in CommentList| filter :{PostID:PostMore.PId}"  style="margin-bottom: 0px; background-color: #e9ebee; padding: 5px;  border-radius: 10px;">
                            <div class="media-left">
                                <img class="img-circle" src="<?php echo base_url(); ?>uploads/students/{{Cmnt.Photo}}" height="25" width="25" /> 
                            </div>
                            <div class="media-body">
                                <span class="" style="font-size: 13px; font-weight: bolder; color: blue; padding: 0px; margin: 0px;"> {{Cmnt.FullName}} </span>
                                <span class="" style="font-size: 10px; padding: 0px; margin: 0px;"> {{Cmnt.Date}} </span>
                                <br> <span class="" style="font-size: 13px; padding: 0px; margin: 0px;"> {{Cmnt.Comment}} </span>
                                <span  class="pull-right glyphicon glyphicon-remove-sign" ng-click="DeleteComment(Cmnt.CID, Cmnt.PostID)"></span>
                            </div>
                        </div>
                    </div>
                    <!--Comment Box-->
                    <div >
                        <div class="input-group">
                            <textarea class="form-control" style="width: 100%" ng-model="PostMore.Comment" ></textarea>
                            <span class="input-group-addon"><button  ng-click="SubmitComment(PostMore.Comment, PostMore.PId)">&Lsh;</button></span>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Add Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" >
        <div class="modal-dialog" role="document" style="">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" ng-click="reset()" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Edit Post</h4>
                </div>
                <div class="modal-body">



                    <form name="SOSForm"  ng-submit="UpdatePost()" >
                        <div class="form-group">
                            <label for="Name" >Heading</label>
                            <input class="form-control" ng-model="Post.Heading" name="Heading" id="Heading"/>
                        </div>

                        <div class="form-group">
                            <label for="Description">Description</label>
                            <textarea class="form-control" ng-model="Post.Description" name="Description" id="Description">
                    
                            </textarea>
                        </div> 

                        <div class="form-group">
                            <label for="Post">Faculty</label>
                            <select class="form-control" ng-model="Post.Faculty" name="Faculty" id="Faculty">
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
                            <select class="form-control" ng-model="Post.Session" name="Session" id="Session">
                                <option value="0">Select </option>
                                <?php
                                foreach ($Session as $ses) {
                                    echo "<option value='" . $ses->SessionId . "'>" . $ses->Session . "</option>";
                                }
                                ?>
                            </select>

                            <div class="form-group">
                                <label for="">Post Type</label>
                                <select class="form-control" ng-model="Post.isPublic" name="isPublic" id="MyOrder">


                                    <option value="0">Not Public </option>
                                    <option value="1">Public</option>

                                </select>
                            </div>
                        </div>
                        <h4 class="label label-danger">Can't update your Attachment. if needed delete your this post and repost again.                         </h4>
                        <!--                        <div class="form-group">
                                                    <label for="Attachment">Attachment</label>
                                                    <input type="file" class="form-control" name="Attachment" id="Attachment"/>
                                                </div>-->


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
                GetAllPost();

            }
            function initialize() {
                $scope.Post = {};
                $scope.AllPost = [];
                $scope.DeletePost = DeletePost;

                $scope.Post = {};
                $scope.Edit = Edit;
                $scope.reset = reset;
                $scope.UpdatePost = UpdatePost;

                $scope.ShowPostMore = ShowPostMore;
                $scope.PostMore = {};

                $scope.SubmitComment = SubmitComment;
                $scope.CommentList = [];
                $scope.DeleteComment = DeleteComment;
            }

            function GetAllPost()
            {
                $scope.AllPost = [];
                $http({
                    method: 'GET',
                    url: baseUrl + 'Post/GetAllPost/'
                }).then(function successCallback(response) {
                    $scope.AllPost = response.data;
                }, function errorCallback(response) {
                });
            }

            function UpdatePost()
            {
                console.log($scope.Post);
                if ($scope.Post.PId > 0)
                {
                    $http({
                        method: 'POST',
                        url: baseUrl + 'Post/UpdatePost/',
                        headers: {'Content-Type': 'application/json'},
                        data: JSON.stringify($scope.Post)
                    }).success(function (data) {
                        console.log(data);
                        GetAllPost();
                        $scope.Post = {};
                        $('#myModal').modal('toggle');
                        swal("Successfully Updated", "Post");

                    });
                }
            }
            function DeletePost(id)
            {
                var SId = id;

                var r = confirm("Do you want to Delete!");
                if (r == true) {
                    $http({
                        method: 'GET',
                        url: baseUrl + 'Post/DeletePost/' + SId
                    }).then(function successCallback(response) {
                        swal("Post!", "Deleted Successfully!!");
                        GetAllPost();
                    }, function errorCallback(response) {
                        swal("Post!", "Not Deleted!!!!");
                    });

                }
            }


            function SubmitComment(Comment, PId)
            {
                if (Comment.length >= 1)
                {
                    $scope.CommentVariable = {};
                    $scope.CommentVariable.Comment = Comment;
                    $scope.CommentVariable.PId = PId;
                    //console.log($scope.CommentVariable);
                    $http({
                        method: 'POST',
                        url: baseUrl + 'Post/SubmitComment/',
                        headers: {'Content-Type': 'application/json'},
                        data: JSON.stringify($scope.CommentVariable)
                    }).then(function successCallback(response) {
                        $scope.PostMore.Comment = "";

                        $scope.CommentList = response.data;
                        //console.log(response.data);
                    }, function errorCallback(response) {
                    });
                }
//                else
//                {
//                    alert("Null Not Allowed.");
//                }
            }

            function ShowPostMore(Post)
            {
                $scope.PostMore = Post;
                $http({
                    method: 'GET',
                    url: baseUrl + 'Post/GetCommentSinglePost/' + $scope.PostMore.PId
                }).then(function successCallback(response) {
                    $scope.CommentList = response.data;
                }, function errorCallback(response) {
                });

            }

            function DeleteComment(CID, PostID)
            {
                var r = confirm("Do you want to delete seriously???");

                if (r == true)
                {
                    $http({
                        method: 'GET',
                        url: baseUrl + 'Post/DeleteComment/' + CID + '/' + PostID
                    }).then(function successCallback(response) {
                        $scope.CommentList = response.data;
                    }, function errorCallback(response) {
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