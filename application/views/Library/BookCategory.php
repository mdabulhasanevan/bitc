
<div ng-controller="DefaultCtrl" class="col-md-10" style="background-color: #ffffff;">

    <div class="col-md-12">
        <h2>Qusetion Subject Info</h2>

        <?php
        if (isset($_SESSION['success'])) {
            echo "<div class='alert alert-success'>" . $_SESSION['success'] . "</div>";
        }
        ?>

        <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>

        <button type="button"  class="btn btn-info pull-left" data-toggle="modal" data-target="#myModal">Add BookCategory</button> 

    </div>
    <!--List of BookCategory-->
    <br>
    <div class="col-md-12">
        <table class="table table-striped">
            <tr>
                <th>SN</th>
                <th>Qusetion Type Name </th>            
                <th>Action </th>
            </tr>
            <tr ng-repeat="BookCategory in AllBookCategory">
                <td>{{$index + 1}} </td>
                <td>{{BookCategory.Name}} </td>
                <td>
                    <button class="btn btn-warning" data-toggle="modal" data-target="#myModal" ng-click="Edit(BookCategory)" >Edit</button>
                    <button class="btn btn-danger" ng-click="DeleteBookCategory(BookCategory.Id)" >Delete</button></td>
            </tr>
        </table>

    </div>

    <!-- Add Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" >
        <div class="modal-dialog" role="document" style="width:950px;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" ng-click="reset()" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Add BookCategory</h4>
                </div>
                <div class="modal-body">
                    <form name="SOSForm" ng-submit="AddBookCategory()" />                   
                    <div class="form-group">
                        <label for="Exam" >BookCategory Name</label>
                        <input class="form-control" ng-model="BookCategory.Name"  name="Exam"/>
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
                GetAllBookCategory();

            }
            function initialize() {
                $scope.AllBookCategory = [];
                $scope.DeleteBookCategory = DeleteBookCategory;
                $scope.AddBookCategory = AddBookCategory;
                $scope.BookCategory = {};
                $scope.Edit = Edit;
                $scope.reset=reset;

            }

            function GetAllBookCategory()
            {
                $scope.AllBookCategory = [];
                $http({
                    method: 'GET',
                    url: baseUrl + 'BookLibrary/GetAllBookCategory/'
                }).then(function successCallback(response) {
                    $scope.AllBookCategory = response.data;
                }, function errorCallback(response) {
                });
            }

            function DeleteBookCategory(id)
            {
                var SId = id;

                var r = confirm("Do you want to Delete!");
                if (r == true) {
                    $http({
                        method: 'GET',
                        url: baseUrl + 'BookLibrary/DeleteBookCategory/' + SId
                    }).then(function successCallback(response) {
                        swal("BookCategory!!", "Deleted Successfully!!");
                        GetAllBookCategory();
                    }, function errorCallback(response) {
                        swal("BookCategory!", "Not Deleted!!!!");
                    });

                }
            }

            function AddBookCategory()
            {
                console.log($scope.BookCategory);
                //update
                if ($scope.BookCategory.Id > 0)
                {
                    $http({
                        method: 'POST',
                        url: baseUrl + 'BookLibrary/UpdateBookCategory/',
                        headers: {'Content-Type': 'application/json'},
                        data: JSON.stringify($scope.BookCategory)
                    }).success(function (data) {   
                        console.log(data);
                        GetAllBookCategory();
                        $scope.BookCategory={};
                         $('#myModal').modal('toggle');
                        swal("Successfully Updated", "BookCategory");
                        
                    });
                }
                else {   
                    //add
                    $http({
                        method: 'POST',
                        url: baseUrl + 'BookLibrary/AddBookCategory/',
                        headers: {'Content-Type': 'application/json'},
                        data: JSON.stringify($scope.BookCategory)
                    }).success(function (data) {
                        console.log(data);
                        GetAllBookCategory();
                         $('#myModal').modal('toggle');
                        swal("Successfully added", "BookCategory");
                        $scope.BookCategory = {};
                    });
                }
            }

            function Edit(BookCategory)
            {
                $scope.BookCategory = {};
                $scope.BookCategory = BookCategory;
            }
            
            function reset()
            {
                $scope.BookCategory = {};
            }

        }]);
</script>