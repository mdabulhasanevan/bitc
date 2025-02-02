
<div ng-controller="DefaultCtrl" class="col-md-10" style="background-color: #ffffff;">

    <div class="col-md-12">
        <h2>Backup and Restore</h2>
        <a href="Setting/BackupRestore"><span class="glyphicon glyphicon-download"></span> Database Backup</a>
    </div>

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