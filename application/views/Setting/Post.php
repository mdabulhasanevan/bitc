
<div ng-controller="DefaultCtrl" class="col-md-10" style="background-color: #ffffff;">

    <div class="col-md-12">
        <h2>Post Info</h2>

        <?php
        if (isset($_SESSION['success'])) {
            echo "<div class='alert alert-success'>" . $_SESSION['success'] . "</div>";
        }
        ?>

        <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>

        <button type="button"  class="btn btn-info pull-left" data-toggle="modal" data-target="#myModal">Add Post</button> 

    </div>
    <!--List of Post-->
    <br>
    <div class="col-md-12">
        <table class="table table-striped">
            <tr>
                <th>SN</th>
                <th>Post Name </th>            
                <th>Action </th>
            </tr>
            <tr ng-repeat="Post in AllPost">
                <td>{{$index + 1}} </td>
                <td>{{Post.PostName}} </td>
                <td>
                    <button class="btn btn-warning" data-toggle="modal" data-target="#myModal" ng-click="Edit(Post)" >Edit</button>
                    <button class="btn btn-danger" ng-click="DeletePost(Post.PId)" >Delete</button></td>
            </tr>
        </table>

    </div>

    <!-- Add Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" >
        <div class="modal-dialog" role="document" style="width:950px;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" ng-click="reset()" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Add Post</h4>
                </div>
                <div class="modal-body">
                    <form name="SOSForm" ng-submit="AddPost()" />                   
                    <div class="form-group">
                        <label for="Exam" >Post Name</label>
                        <input class="form-control" ng-model="Post.PostName"  name="Exam"/>
                    </div>
                    <div class="form-group">

                        <button type="Submit" class="btn btn-info" name="Create" id="Create">Add</button>
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
                $scope.AllPost = [];
                $scope.DeletePost = DeletePost;
                $scope.AddPost = AddPost;
                $scope.Post = {};
                $scope.Edit = Edit;
                $scope.reset=reset;

            }

            function GetAllPost()
            {
                $scope.AllPost = [];
                $http({
                    method: 'GET',
                    url: baseUrl + 'Setting/GetAllPost/'
                }).then(function successCallback(response) {
                    $scope.AllPost = response.data;
                }, function errorCallback(response) {
                });
            }

            function DeletePost(id)
            {
                var SId = id;

                var r = confirm("Do you want to Delete!");
                if (r == true) {
                    $http({
                        method: 'GET',
                        url: baseUrl + 'Setting/DeletePost/' + SId
                    }).then(function successCallback(response) {
                        swal("Post!", "Deleted Successfully!!");
                        GetAllPost();
                    }, function errorCallback(response) {
                        swal("Post!", "Not Deleted!!!!");
                    });

                }
            }

            function AddPost()
            {
                console.log($scope.Post);
                //update
                if ($scope.Post.PId > 0)
                {
                    $http({
                        method: 'POST',
                        url: baseUrl + 'Setting/UpdatePost/',
                        headers: {'Content-Type': 'application/json'},
                        data: JSON.stringify($scope.Post)
                    }).success(function (data) {   
                        console.log(data);
                        GetAllPost();
                        $scope.Post={};
                         $('#myModal').modal('toggle');
                        swal("Successfully Updated", "Post");
                        
                    });
                }
                else {   
                    //add
                    $http({
                        method: 'POST',
                        url: baseUrl + 'Setting/AddPost/',
                        headers: {'Content-Type': 'application/json'},
                        data: JSON.stringify($scope.Post)
                    }).success(function (data) {
                        console.log(data);
                        GetAllPost();
                         $('#myModal').modal('toggle');
                        swal("Successfully added", "Post");
                        $scope.Post = {};
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