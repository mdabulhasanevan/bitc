
<div ng-controller="DefaultCtrl" class="col-md-10" style="background-color: #ffffff;">

    <div class="col-md-12">
        <h2>Role Info</h2>

        <?php
        if (isset($_SESSION['success'])) {
            echo "<div class='alert alert-success'>" . $_SESSION['success'] . "</div>";
        }
        ?>

        <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>

        <button type="button"  class="btn btn-info pull-left" data-toggle="modal" data-target="#myModal">Add Role</button> 

    </div>
    <!--List of Role-->
    <br>
    <div class="col-md-12">
        <table class="table table-striped">
            <tr>
                <th>SN</th>
                <th>Role Name </th>            
                <th>Action </th>
            </tr>
            <tr ng-repeat="Role in AllRole">
                <td>{{$index + 1}} </td>
                <td>{{Role.Role}} </td>
                <td>
                    <button class="btn btn-warning" data-toggle="modal" data-target="#myModal" ng-click="Edit(Role)" >Edit</button>
                    <button class="btn btn-danger" ng-click="DeleteRole(Role.Id)" >Delete</button></td>
            </tr>
        </table>

    </div>

    <!-- Add Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" >
        <div class="modal-dialog" role="document" style="width:950px;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" ng-click="reset()" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Add Role</h4>
                </div>
                <div class="modal-body">
                    <form name="SOSForm" ng-submit="AddRole()" />                   
                    <div class="form-group">
                        <label for="Exam" >Role Name</label>
                        <input class="form-control" ng-model="Role.Role"  name="Exam"/>
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
                GetAllRole();

            }
            function initialize() {
                $scope.AllRole = [];
                $scope.DeleteRole = DeleteRole;
                $scope.AddRole = AddRole;
                $scope.Role = {};
                $scope.Edit = Edit;
                $scope.reset=reset;

            }

            function GetAllRole()
            {
                $scope.AllRole = [];
                $http({
                    method: 'GET',
                    url: baseUrl + 'Setting/GetAllRole/'
                }).then(function successCallback(response) {
                    $scope.AllRole = response.data;
                }, function errorCallback(response) {
                });
            }

            function DeleteRole(id)
            {
                var SId = id;

                var r = confirm("Do you want to Delete!");
                if (r == true) {
                    $http({
                        method: 'GET',
                        url: baseUrl + 'Setting/DeleteRole/' + SId
                    }).then(function successCallback(response) {
                        swal("Role!!", "Deleted Successfully!!");
                        GetAllRole();
                    }, function errorCallback(response) {
                        swal("Role!", "Not Deleted!!!!");
                    });

                }
            }

            function AddRole()
            {
                console.log($scope.Role);
                //update
                if ($scope.Role.Id > 0)
                {
                    $http({
                        method: 'POST',
                        url: baseUrl + 'Setting/UpdateRole/',
                        headers: {'Content-Type': 'application/json'},
                        data: JSON.stringify($scope.Role)
                    }).success(function (data) {   
                        console.log(data);
                        GetAllRole();
                        $scope.Role={};
                         $('#myModal').modal('toggle');
                        swal("Successfully Updated", "Role");
                        
                    });
                }
                else {   
                    //add
                    $http({
                        method: 'POST',
                        url: baseUrl + 'Setting/AddRole/',
                        headers: {'Content-Type': 'application/json'},
                        data: JSON.stringify($scope.Role)
                    }).success(function (data) {
                        console.log(data);
                        GetAllRole();
                         $('#myModal').modal('toggle');
                        swal("Successfully added", "Role");
                        $scope.Role = {};
                    });
                }
            }

            function Edit(Role)
            {
                $scope.Role = {};
                $scope.Role = Role;
            }
            
            function reset()
            {
                $scope.Role = {};
            }

        }]);
</script>