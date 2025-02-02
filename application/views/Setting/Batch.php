
<div ng-controller="DefaultCtrl" class="col-md-10" style="background-color: #ffffff;">

    <div class="col-md-12">
        <h2>Batch Info</h2>

        <?php
        if (isset($_SESSION['success'])) {
            echo "<div class='alert alert-success'>" . $_SESSION['success'] . "</div>";
        }
        ?>

        <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>

        <button type="button"  class="btn btn-info pull-left" data-toggle="modal" data-target="#myModal">Add Batch</button> 

    </div>
    <!--List of Batch-->
    <br>
    <div class="col-md-12">
        <table class="table table-striped">
            <tr>
                <th>SN</th>
                <th>Batch Name </th>            
                <th>Action </th>
            </tr>
            <tr ng-repeat="Batch in AllBatch">
                <td>{{$index + 1}} </td>
                <td>{{Batch.BatchName}} </td>
                <td>
                    <button class="btn btn-warning" data-toggle="modal" data-target="#myModal" ng-click="Edit(Batch)" >Edit</button>
                    <button class="btn btn-danger" ng-click="DeleteBatch(Batch.BId)" >Delete</button></td>
            </tr>
        </table>

    </div>

    <!-- Add Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" >
        <div class="modal-dialog" role="document" style="width:950px;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" ng-click="reset()" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Add Batch</h4>
                </div>
                <div class="modal-body">
                    <form name="SOSForm" ng-submit="AddBatch()" />                   
                    <div class="form-group">
                        <label for="Exam" >Batch Name</label>
                        <input class="form-control" ng-model="Batch.BatchName"  name="Exam"/>
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
                GetAllBatch();

            }
            function initialize() {
                $scope.AllBatch = [];
                $scope.DeleteBatch = DeleteBatch;
                $scope.AddBatch = AddBatch;
                $scope.Batch = {};
                $scope.Edit = Edit;
                $scope.reset=reset;

            }

            function GetAllBatch()
            {
                $scope.AllBatch = [];
                $http({
                    method: 'GET',
                    url: baseUrl + 'Setting/GetAllBatch/'
                }).then(function successCallback(response) {
                    $scope.AllBatch = response.data;
                }, function errorCallback(response) {
                });
            }

            function DeleteBatch(id)
            {
                var SId = id;

                var r = confirm("Do you want to Delete!");
                if (r == true) {
                    $http({
                        method: 'GET',
                        url: baseUrl + 'Setting/DeleteBatch/' + SId
                    }).then(function successCallback(response) {
                        swal("Batch!", "Deleted Successfully!!");
                        GetAllBatch();
                    }, function errorCallback(response) {
                        swal("Batch!", "Not Deleted!!!!");
                    });

                }
            }

            function AddBatch()
            {
                console.log($scope.Batch);
                //update
                if ($scope.Batch.BId > 0)
                {
                    $http({
                        method: 'POST',
                        url: baseUrl + 'Setting/UpdateBatch/',
                        headers: {'Content-Type': 'application/json'},
                        data: JSON.stringify($scope.Batch)
                    }).success(function (data) {   
                        console.log(data);
                        GetAllBatch();
                        $scope.Batch={};
                         $('#myModal').modal('toggle');
                        swal("Successfully Updated", "Batch");
                        
                    });
                }
                else {   
                    //add
                    $http({
                        method: 'POST',
                        url: baseUrl + 'Setting/AddBatch/',
                        headers: {'Content-Type': 'application/json'},
                        data: JSON.stringify($scope.Batch)
                    }).success(function (data) {
                        console.log(data);
                        GetAllBatch();
                         $('#myModal').modal('toggle');
                        swal("Successfully added", "Batch");
                        $scope.Batch = {};
                    });
                }
            }

            function Edit(Batch)
            {
                $scope.Batch = {};
                $scope.Batch = Batch;
            }
            
            function reset()
            {
                $scope.Batch = {};
            }

        }]);
</script>