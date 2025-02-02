
<div ng-controller="DefaultCtrl" class="col-md-10" style="background-color: #ffffff;">

    <div class="col-md-12">
        <h2>AdminSubMenu Info</h2>

        <?php
        if (isset($_SESSION['success'])) {
            echo "<div class='alert alert-success'>" . $_SESSION['success'] . "</div>";
        }
        ?>

        <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>

        <button type="button"  class="btn btn-info pull-left" data-toggle="modal" data-target="#myModal">Add AdminSubMenu</button> 

    </div>
    <!--List of AdminSubMenu-->
    <br>
    <div class="col-md-12">
        <table class="table table-striped">
            <tr>
                <th>SN</th>
                <th> MainMenu </th>
                <th> Sub Menu </th>          
                <th>Url </th>        
                <th> Sort </th>          
                <th>Icon </th>   
                <th>Role </th>  
                <th>isHide </th>
                <th>isForSuper </th>    
                <th>Action </th>
            </tr>
            <tr ng-repeat="AdminSubMenu in AllAdminSubMenu">
                <td>{{$index + 1}} </td>
                <td>{{AdminSubMenu.MainMenu}} </td>
                <td>{{AdminSubMenu.MenuName}} </td>
                <td>{{AdminSubMenu.Url}} </td>
                <td>{{AdminSubMenu.Sort}} </td>
                <td>{{AdminSubMenu.Icon}} </td>
                <td>{{AdminSubMenu.RollName}} </td>
                <td>{{AdminSubMenu.isHideStatus}} </td>
                <td>{{AdminSubMenu.isForSuperStatus }} </td>
                <td>
                    <button class="btn btn-warning" data-toggle="modal" data-target="#myModal" ng-click="Edit(AdminSubMenu)" >Edit</button>
                    <button class="btn btn-danger" ng-click="DeleteAdminSubMenu(AdminSubMenu.ID)" >Delete</button></td>
            </tr>
        </table>

    </div>

    <!-- Add Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" >
        <div class="modal-dialog" role="document" style="width:950px;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" ng-click="reset()" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Add AdminSubMenu</h4>
                </div>
                <div class="modal-body">
                    <form name="SOSForm" ng-submit="AddAdminSubMenu()" /> 
                    <div class="form-group">
                        <label for="Exam" >Main Menu</label>
                        <select class="form-control" required="required"  ng-model="AdminSubMenu.MainMenuID"  name="" ng-options="item.ID as item.MenuName for item in AllMainMenu">
                            <option value="">Choose Option</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="Exam" >AdminSubMenu Name</label>
                        <input class="form-control" required="required" ng-model="AdminSubMenu.MenuName"  name="Exam" />
                    </div>
                    <div class="form-group">
                        <label for="Exam" >Url</label>
                        <input class="form-control" required="required" ng-model="AdminSubMenu.Url"  name="Exam"/>
                    </div>
                    <div class="form-group">
                        <label for="Exam" >Sort</label>
                        <input class="form-control" required="required" ng-model="AdminSubMenu.Sort"  name="Exam"/>
                    </div>
                    <div class="form-group">
                        <label for="Exam" >Icon</label>
                        <input class="form-control"  ng-model="AdminSubMenu.Icon"  name="Exam"/>
                    </div>
                    <div class="form-group">
                        <label for="Exam" >isHide</label>
                        <select class="form-control" required="required" ng-model="AdminSubMenu.isHide" >
                            <option value="0">NO</option>
                            <option value="1">Yes</option>
                        </select>
                        
                    </div>
                    <div class="form-group">
                        <label for="Exam" >Role</label>
                        <select class="form-control" required="required" ng-model="AdminSubMenu.Role"  name="" ng-options="item.Id as item.Role for item in AllRole">
                            <option value="">Choose Option</option>
                        </select>                       
                    </div>
                    <div class="form-group">
                        <label for="Exam" >isForSuper</label>
                        <select class="form-control" required="required" ng-model="AdminSubMenu.isForSuper" >
                            <option value="0">NO</option>
                            <option value="1">Yes</option>
                        </select>

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
    $('input').attr('autocomplete', 'off');
    app.controller("DefaultCtrl", ["$scope", "$http",
        function ($scope, $http) {
            init();
            function init() {
                initialize();
                GetAllAdminSubMenu();
                GetAllMainMenu();
                GetAllRole();
            }
            function initialize() {
                $scope.AllAdminSubMenu = [];
                $scope.DeleteAdminSubMenu = DeleteAdminSubMenu;
                $scope.AddAdminSubMenu = AddAdminSubMenu;
                $scope.AdminSubMenu = {};
                $scope.Edit = Edit;
                $scope.reset = reset;

                $scope.GetAllMainMenu = GetAllMainMenu;
                $scope.AllMainMenu = [];
                $scope.GetAllRole = GetAllRole;
                $scope.AllRole = [];

            }
            function GetAllMainMenu()
            {
                $scope.AllMainMenu = [];
                $http({
                    method: 'GET',
                    url: baseUrl + 'MenuController/GetAllMainMenu/'
                }).then(function successCallback(response) {
                    $scope.AllMainMenu = response.data;
                    console.log($scope.AllMainMenu);
                }, function errorCallback(response) {
                });
            }

            function GetAllRole()
            {
                $scope.AllRole = [];
                $http({
                    method: 'GET',
                    url: baseUrl + 'CommonCtrl/GetAllRole/'
                }).then(function successCallback(response) {
                    $scope.AllRole = response.data;
                    console.log($scope.AllRole);
                }, function errorCallback(response) {
                });
            }
            function GetAllAdminSubMenu()
            {
                $scope.AllAdminSubMenu = [];
                $http({
                    method: 'GET',
                    url: baseUrl + 'MenuController/GetAllAdminSubMenu/'
                }).then(function successCallback(response) {
                    $scope.AllAdminSubMenu = response.data;
                    console.log($scope.AllAdminSubMenu);
                }, function errorCallback(response) {
                });
            }

            function DeleteAdminSubMenu(id)
            {
                var Id = id;
                console.log(Id);
                var r = confirm("Do you want to Delete!");
                if (r == true) {
                    $http({
                        method: 'GET',
                        url: baseUrl + 'MenuController/DeleteAdminSubMenu/' + Id
                    }).then(function successCallback(response) {
                        swal("Student of the Admin Menu !", "Deleted Successfully!!");
                        GetAllAdminSubMenu();
                    }, function errorCallback(response) {
                        swal("Student of the Admin Menu!", "Not Deleted!!!!");
                    });

                }
            }

            function AddAdminSubMenu()
            {
                console.log($scope.AdminSubMenu);
                //update
                if ($scope.AdminSubMenu.ID > 0)
                {
                    $http({
                        method: 'POST',
                        url: baseUrl + 'MenuController/UpdateAdminSubMenu/',
                        headers: {'Content-Type': 'application/json'},
                        data: JSON.stringify($scope.AdminSubMenu)
                    }).success(function (data) {
                        console.log(data);
                        GetAllAdminSubMenu();
                        $scope.AdminSubMenu = {};
                        $('#myModal').modal('toggle');
                        swal("Successfully Updated", "AdminSubMenu");

                    });
                }
                else {
                    //add
                    $http({
                        method: 'POST',
                        url: baseUrl + 'MenuController/AddAdminSubMenu/',
                        headers: {'Content-Type': 'application/json'},
                        data: JSON.stringify($scope.AdminSubMenu)
                    }).success(function (data) {
                        console.log(data);
                        GetAllAdminSubMenu();
                        $('#myModal').modal('toggle');
                        swal("Successfully added", "AdminSubMenu");
                        $scope.AdminSubMenu = {};
                    });
                }
            }

            function Edit(AdminSubMenu)
            {
                $scope.AdminSubMenu = {};
                $scope.AdminSubMenu = AdminSubMenu;
            }

            function reset()
            {
                $scope.AdminSubMenu = {};
            }

        }]);
</script>