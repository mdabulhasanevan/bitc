
<div ng-controller="DefaultCtrl" class="col-md-10" style="background-color: #ffffff;">

    <div class="col-md-12">
        <h2>ClassRoom Info</h2>

        <?php
        if (isset($_SESSION['success'])) {
            echo "<div class='alert alert-success'>" . $_SESSION['success'] . "</div>";
        }
        ?>

        <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>

        <button type="button"  class="btn btn-info pull-left" data-toggle="modal" data-target="#myModal">Add ClassRoom</button> 

    </div>
    <!--List of ClassRoom-->
    <br>
    <div class="col-md-12">
        <table class="table table-striped">
            <tr>
                <th>SN</th>
                <th> Number </th>          
                 <th>Description </th>         
                <th>Action </th>
            </tr>
            <tr ng-repeat="ClassRoom in AllClassRoom">
                <td>{{$index + 1}} </td>
                <td>{{ClassRoom.Number}} </td>
                <td>{{ClassRoom.Name}} </td>
                <td>
                    <button class="btn btn-warning" data-toggle="modal" data-target="#myModal" ng-click="Edit(ClassRoom)" >Edit</button>
                    <button class="btn btn-danger" ng-click="DeleteClassRoom(ClassRoom.ID)" >Delete</button></td>
            </tr>
        </table>

    </div>

    <!-- Add Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" >
        <div class="modal-dialog" role="document" style="width:950px;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" ng-click="reset()" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Add ClassRoom</h4>
                </div>
                <div class="modal-body">
                    <form name="SOSForm" ng-submit="AddClassRoom()" />                   
                    <div class="form-group">
                        <label for="Exam" >ClassRoom Name</label>
                        <input class="form-control" ng-model="ClassRoom.Name"  name="Exam"/>
                    </div>
                     <div class="form-group">
                        <label for="Exam" >Number</label>
                        <input class="form-control" ng-model="ClassRoom.Number"  name="Exam"/>
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
                GetAllClassRoom();

            }
            function initialize() {
                $scope.AllClassRoom = [];
                $scope.DeleteClassRoom = DeleteClassRoom;
                $scope.AddClassRoom = AddClassRoom;
                $scope.ClassRoom = {};
                $scope.Edit = Edit;
                $scope.reset=reset;

            }

            function GetAllClassRoom()
            {
                $scope.AllClassRoom = [];
                $http({
                    method: 'GET',
                    url: baseUrl + 'Setting/GetAllClassRoom/'
                }).then(function successCallback(response) {
                    $scope.AllClassRoom = response.data;
                    console.log($scope.AllClassRoom);
                }, function errorCallback(response) {
                });
            }

            function DeleteClassRoom(id)
            {
                var Id = id;
                console.log(Id);
                var r = confirm("Do you want to Delete!");
                if (r == true) {
                    $http({
                        method: 'GET',
                        url: baseUrl + 'Setting/DeleteClassRoom/' + Id
                    }).then(function successCallback(response) {
                        swal("Class Room !", "Deleted Successfully!!");
                        GetAllClassRoom();
                    }, function errorCallback(response) {
                        swal("Class Room!", "Not Deleted!!!!");
                    });

                }
            }

            function AddClassRoom()
            {
                console.log($scope.ClassRoom);
                //update
                if ($scope.ClassRoom.ID > 0)
                {
                    $http({
                        method: 'POST',
                        url: baseUrl + 'Setting/UpdateClassRoom/',
                        headers: {'Content-Type': 'application/json'},
                        data: JSON.stringify($scope.ClassRoom)
                    }).success(function (data) {   
                        console.log(data);
                        GetAllClassRoom();
                        $scope.ClassRoom={};
                         $('#myModal').modal('toggle');
                        swal("Successfully Updated", "ClassRoom");
                        
                    });
                }
                else {   
                    //add
                    $http({
                        method: 'POST',
                        url: baseUrl + 'Setting/AddClassRoom/',
                        headers: {'Content-Type': 'application/json'},
                        data: JSON.stringify($scope.ClassRoom)
                    }).success(function (data) {
                        console.log(data);
                        GetAllClassRoom();
                         $('#myModal').modal('toggle');
                        swal("Successfully added", "ClassRoom");
                        $scope.ClassRoom = {};
                    });
                }
            }

            function Edit(ClassRoom)
            {
                $scope.ClassRoom = {};
                $scope.ClassRoom = ClassRoom;
            }
            
            function reset()
            {
                $scope.ClassRoom = {};
            }

        }]);
</script>