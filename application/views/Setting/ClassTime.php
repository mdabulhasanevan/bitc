
<div ng-controller="DefaultCtrl" class="col-md-10" style="background-color: #ffffff;">

    <div class="col-md-12">
        <h2>ClassTime Info</h2>

        <?php
        if (isset($_SESSION['success'])) {
            echo "<div class='alert alert-success'>" . $_SESSION['success'] . "</div>";
        }
        ?>

        <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>

        <button type="button"  class="btn btn-info pull-left" data-toggle="modal" data-target="#myModal">Add ClassTime</button> 

    </div>
    <!--List of ClassTime-->
    <br>
    <div class="col-md-12">
        <table class="table table-striped">
            <tr>
                <th>SN</th>
                <th> Time </th>          
                 <th>EndTime </th>         
                <th>Action </th>
            </tr>
            <tr ng-repeat="ClassTime in AllClassTime">
                <td>{{$index + 1}} </td>
                <td>{{ClassTime.Time}} </td>
                <td>{{ClassTime.EndTime}} </td>
                <td>
                    <button class="btn btn-warning" data-toggle="modal" data-target="#myModal" ng-click="Edit(ClassTime)" >Edit</button>
                    <button class="btn btn-danger" ng-click="DeleteClassTime(ClassTime.ID)" >Delete</button></td>
            </tr>
        </table>

    </div>

    <!-- Add Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" >
        <div class="modal-dialog" role="document" style="width:950px;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" ng-click="reset()" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Add ClassTime</h4>
                </div>
                <div class="modal-body">
                    <form name="SOSForm" ng-submit="AddClassTime()" />                   
                    <div class="form-group">
                        <label for="Exam" >ClassTime Time</label>
                        <input class="form-control" ng-model="ClassTime.Time"  name="Exam"/>
                    </div>
                     <div class="form-group">
                        <label for="Exam" >EndTime</label>
                        <input class="form-control" ng-model="ClassTime.EndTime"  name="Exam"/>
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
                GetAllClassTime();

            }
            function initialize() {
                $scope.AllClassTime = [];
                $scope.DeleteClassTime = DeleteClassTime;
                $scope.AddClassTime = AddClassTime;
                $scope.ClassTime = {};
                $scope.Edit = Edit;
                $scope.reset=reset;

            }

            function GetAllClassTime()
            {
                $scope.AllClassTime = [];
                $http({
                    method: 'GET',
                    url: baseUrl + 'Setting/GetAllClassTime/'
                }).then(function successCallback(response) {
                    $scope.AllClassTime = response.data;
                    console.log($scope.AllClassTime);
                }, function errorCallback(response) {
                });
            }

            function DeleteClassTime(id)
            {
                var Id = id;
                console.log(Id);
                var r = confirm("Do you want to Delete!");
                if (r == true) {
                    $http({
                        method: 'GET',
                        url: baseUrl + 'Setting/DeleteClassTime/' + Id
                    }).then(function successCallback(response) {
                        swal("Class Time!", "Deleted Successfully!!");
                        GetAllClassTime();
                    }, function errorCallback(response) {
                        swal("Class Time!", "Not Deleted!!!!");
                    });

                }
            }

            function AddClassTime()
            {
                console.log($scope.ClassTime);
                //update
                if ($scope.ClassTime.ID > 0)
                {
                    $http({
                        method: 'POST',
                        url: baseUrl + 'Setting/UpdateClassTime/',
                        headers: {'Content-Type': 'application/json'},
                        data: JSON.stringify($scope.ClassTime)
                    }).success(function (data) {   
                        console.log(data);
                        GetAllClassTime();
                        $scope.ClassTime={};
                         $('#myModal').modal('toggle');
                        swal("Successfully Updated", "ClassTime");
                        
                    });
                }
                else {   
                    //add
                    $http({
                        method: 'POST',
                        url: baseUrl + 'Setting/AddClassTime/',
                        headers: {'Content-Type': 'application/json'},
                        data: JSON.stringify($scope.ClassTime)
                    }).success(function (data) {
                        console.log(data);
                        GetAllClassTime();
                         $('#myModal').modal('toggle');
                        swal("Successfully added", "ClassTime");
                        $scope.ClassTime = {};
                    });
                }
            }

            function Edit(ClassTime)
            {
                $scope.ClassTime = {};
                $scope.ClassTime = ClassTime;
            }
            
            function reset()
            {
                $scope.ClassTime = {};
            }

        }]);
</script>