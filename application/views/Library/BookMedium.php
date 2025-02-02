
<div ng-controller="DefaultCtrl" class="col-md-10" style="background-color: #ffffff;">

    <div class="col-md-12">
        <h2>BookMedium Type Info</h2>

        <?php
        if (isset($_SESSION['success'])) {
            echo "<div class='alert alert-success'>" . $_SESSION['success'] . "</div>";
        }
        ?>

        <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>

        <button type="button"  class="btn btn-info pull-left" data-toggle="modal" data-target="#myModal">Add BookMediumType</button> 

    </div>
    <!--List of BookMediumType-->
    <br>
    <div class="col-md-12">
        <table class="table table-striped">
            <tr>
                <th>SN</th>
                <th>BookMedium  </th>            
                <th>Action </th>
            </tr>
            <tr ng-repeat="BookMediumType in AllBookMediumType">
                <td>{{$index + 1}} </td>
                <td>{{BookMediumType.Type}} </td>
                <td>
                    <button class="btn btn-warning" data-toggle="modal" data-target="#myModal" ng-click="Edit(BookMediumType)" >Edit</button>
                    <button class="btn btn-danger" ng-click="DeleteBookMediumType(BookMediumType.Id)" >Delete</button></td>
            </tr>
        </table>

    </div>

    <!-- Add Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" >
        <div class="modal-dialog" role="document" style="width:950px;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" ng-click="reset()" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Add BookMediumType</h4>
                </div>
                <div class="modal-body">
                    <form name="SOSForm" ng-submit="AddBookMediumType()" />                   
                    <div class="form-group">
                        <label for="Exam" >BookMediumType Name</label>
                        <input class="form-control" ng-model="BookMediumType.Type"  name="Exam"/>
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
                GetAllBookMediumType();

            }
            function initialize() {
                $scope.AllBookMediumType = [];
                $scope.DeleteBookMediumType = DeleteBookMediumType;
                $scope.AddBookMediumType = AddBookMediumType;
                $scope.BookMediumType = {};
                $scope.Edit = Edit;
                $scope.reset=reset;

            }

            function GetAllBookMediumType()
            {
                $scope.AllBookMediumType = [];
                $http({
                    method: 'GET',
                    url: baseUrl + 'BookLibrary/GetAllBookMedium/'
                }).then(function successCallback(response) {
                    $scope.AllBookMediumType = response.data;
                }, function errorCallback(response) {
                });
            }

            function DeleteBookMediumType(id)
            {
                var SId = id;

                var r = confirm("Do you want to Delete!");
                if (r == true) {
                    $http({
                        method: 'GET',
                        url: baseUrl + 'BookLibrary/DeleteBookMedium/' + SId
                    }).then(function successCallback(response) {
                        swal("BookMediumType!!", "Deleted Successfully!!");
                        GetAllBookMediumType();
                    }, function errorCallback(response) {
                        swal("BookMediumType!", "Not Deleted!!!!");
                    });

                }
            }

            function AddBookMediumType()
            {
                console.log($scope.BookMediumType);
                //update
                if ($scope.BookMediumType.Id > 0)
                {
                    $http({
                        method: 'POST',
                        url: baseUrl + 'BookLibrary/UpdateBookMedium/',
                        headers: {'Content-Type': 'application/json'},
                        data: JSON.stringify($scope.BookMediumType)
                    }).success(function (data) {   
                        console.log(data);
                        GetAllBookMediumType();
                        $scope.BookMediumType={};
                         $('#myModal').modal('toggle');
                        swal("Successfully Updated", "BookMediumType");
                        
                    });
                }
                else {   
                    //add
                    $http({
                        method: 'POST',
                        url: baseUrl + 'BookLibrary/AddBookMedium/',
                        headers: {'Content-Type': 'application/json'},
                        data: JSON.stringify($scope.BookMediumType)
                    }).success(function (data) {
                        console.log(data);
                        GetAllBookMediumType();
                         $('#myModal').modal('toggle');
                        swal("Successfully added", "BookMediumType");
                        $scope.BookMediumType = {};
                    });
                }
            }

            function Edit(BookMediumType)
            {
                $scope.BookMediumType = {};
                $scope.BookMediumType = BookMediumType;
            }
            
            function reset()
            {
                $scope.BookMediumType = {};
            }

        }]);
</script>