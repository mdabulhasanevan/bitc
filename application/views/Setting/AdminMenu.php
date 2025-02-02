
<div ng-controller="DefaultCtrl" class="col-md-10" style="background-color: #ffffff;">

    <div class="col-md-12">
        <h2>AdminMenu Info</h2>

        <?php
        if (isset($_SESSION['success'])) {
            echo "<div class='alert alert-success'>" . $_SESSION['success'] . "</div>";
        }
        ?>

        <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>

        <button type="button"  class="btn btn-info pull-left" data-toggle="modal" data-target="#myModal">Add AdminMenu</button> 

    </div>
    <!--List of AdminMenu-->
    <br>
    <div class="col-md-12">
        <table class="table table-striped">
            <tr>
                <th>SN</th>
                <th> MenuName </th>          
                 <th>Url </th>        
                  <th> Sort </th>          
                 <th>Icon </th>   
                 <th>Role </th>  
                  <th>isHide </th>
                  <th>isForSuper </th>    
                <th>Action </th>
            </tr>
            <tr ng-repeat="AdminMenu in AllAdminMenu">
                <td>{{$index + 1}} </td>
                <td>{{AdminMenu.MenuName}} </td>
                <td>{{AdminMenu.Url}} </td>
                 <td>{{AdminMenu.Sort}} </td>
                <td>{{AdminMenu.Icon}} </td>
                 <td>{{AdminMenu.RollName}} </td>
                <td>{{AdminMenu.isHideStatus}} </td>
                <td>{{AdminMenu.isForSuperStatus }} </td>
                <td>
                    <button class="btn btn-warning" data-toggle="modal" data-target="#myModal" ng-click="Edit(AdminMenu)" >Edit</button>
                    <button class="btn btn-danger" ng-click="DeleteAdminMenu(AdminMenu.ID)" >Delete</button></td>
            </tr>
        </table>

    </div>

    <!-- Add Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" >
        <div class="modal-dialog" role="document" style="width:950px;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" ng-click="reset()" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Add AdminMenu</h4>
                </div>
                <div class="modal-body">
                    <form name="SOSForm" ng-submit="AddAdminMenu()" />                   
                    <div class="form-group">
                        <label for="Exam" >AdminMenu Name</label>
                        <input class="form-control" ng-model="AdminMenu.MenuName"  name="Exam"/>
                    </div>
                     <div class="form-group">
                        <label for="Exam" >Url</label>
                        <input class="form-control" ng-model="AdminMenu.Url"  name="Exam"/>
                    </div>
                                         <div class="form-group">
                        <label for="Exam" >Sort</label>
                        <input class="form-control" ng-model="AdminMenu.Sort"  name="Exam"/>
                    </div>
                     <div class="form-group">
                        <label for="Exam" >Icon</label>
                        <input class="form-control" ng-model="AdminMenu.Icon"  name="Exam"/>
                    </div>
                       <div class="form-group">
                        <label for="Exam" >isHide</label>
                        <select class="form-control" ng-model="AdminMenu.isHide" >
                            <option value="0">NO</option>
                            <option value="1">Yes</option>
                        </select>
                       
                    </div>
                       <div class="form-group">
                        <label for="Exam" >Role</label>
                        <select class="form-control"  ng-model="AdminMenu.Role"  name="" ng-options="item.Id as item.Role for item in AllRole">
                            <option value="">Choose Option</option>
                        </select> 
                        
                    </div>
                       <div class="form-group">
                        <label for="Exam" >isForSuper</label>
                        <select class="form-control" ng-model="AdminMenu.isForSuper" >
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
                GetAllAdminMenu();
                 GetAllRole();
            }
            function initialize() {
                $scope.AllAdminMenu = [];
                $scope.DeleteAdminMenu = DeleteAdminMenu;
                $scope.AddAdminMenu = AddAdminMenu;
                $scope.AdminMenu = {};
                $scope.Edit = Edit;
                $scope.reset=reset;
                
                $scope.GetAllRole = GetAllRole;
                $scope.AllRole = [];

            }

            function GetAllAdminMenu()
            {
                $scope.AllAdminMenu = [];
                $http({
                    method: 'GET',
                    url: baseUrl + 'MenuController/GetAllAdminMenu/'
                }).then(function successCallback(response) {
                    $scope.AllAdminMenu = response.data;
                    console.log($scope.AllAdminMenu);
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
            function DeleteAdminMenu(id)
            {
                var Id = id;
                console.log(Id);
                var r = confirm("Do you want to Delete!");
                if (r == true) {
                    $http({
                        method: 'GET',
                        url: baseUrl + 'MenuController/DeleteAdminMenu/' + Id
                    }).then(function successCallback(response) {
                        swal("Student of the Admin Menu !", "Deleted Successfully!!");
                        GetAllAdminMenu();
                    }, function errorCallback(response) {
                        swal("Student of the Admin Menu!", "Not Deleted!!!!");
                    });

                }
            }

            function AddAdminMenu()
            {
                console.log($scope.AdminMenu);
                //update
                if ($scope.AdminMenu.ID > 0)
                {
                    $http({
                        method: 'POST',
                        url: baseUrl + 'MenuController/UpdateAdminMenu/',
                        headers: {'Content-Type': 'application/json'},
                        data: JSON.stringify($scope.AdminMenu)
                    }).success(function (data) {   
                        console.log(data);
                        GetAllAdminMenu();
                        $scope.AdminMenu={};
                        $('#myModal').modal('toggle');
                        swal("Successfully Updated", "AdminMenu");
                        
                    });
                }
                else {   
                    //add
                    $http({
                        method: 'POST',
                        url: baseUrl + 'MenuController/AddAdminMenu/',
                        headers: {'Content-Type': 'application/json'},
                        data: JSON.stringify($scope.AdminMenu)
                    }).success(function (data) {
                        console.log(data);
                        GetAllAdminMenu();
                        $('#myModal').modal('toggle');
                        swal("Successfully added", "AdminMenu");
                        $scope.AdminMenu = {};
                    });
                }
            }

            function Edit(AdminMenu)
            {
                $scope.AdminMenu = {};
                $scope.AdminMenu = AdminMenu;
            }
            
            function reset()
            {
                $scope.AdminMenu = {};
            }

        }]);
</script>