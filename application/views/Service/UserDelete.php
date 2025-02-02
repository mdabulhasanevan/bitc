<div ng-controller="UserCtrl" class="col-md-10" style="background-color: #ffffff;">
    
    <div><span style="font-size: 20px">User List </span> <span class="pull-right"><a class="btn btn-info" href="<?php echo base_url("Auth/register"); ?>">Add User</a></span></div>

    <table class="table table-hover table-bordered">
        <tr>
            <th>Name</th>
            <th>Post</th>
            <!--<th>Email</th>-->
            <th>Mobile</th>
            <th>Role</th>
            <th>Order</th>
            <th>Status</th>
            <th>Photo</th>           
            <th>Action</th>
        </tr>

        <tr ng-repeat="User in Users">
            <td>{{User.Name}} </td>
            <td> {{User.PostName}} </td>
            <!--<td>{{User.Email}}</td>-->
            <td>{{User.Mobile}} </td> 
            <td>{{User.RoleName}} </td>
              <td>{{User.MyOrder}} </td>
            <td> 
                <span class="label label-primary" ng-show="User.IsActive == 1">Active</span> 
                <span class="label label-danger" ng-show="User.IsActive == 0">Not Active </span>
            </td>           
           
          
            <td> <img src="<?php echo base_url('uploads/users/') ?>{{User.Photo}}" width="50" height="50" </td>
            <td>
               
                <span type="button"  class="btn btn-danger  glyphicon glyphicon-trash " ng-click="DeleteUser(User)" ></span> 
              
            </td>
        </tr>

    </table>
  
</div>



</div>


</body>
</html>
<script type="text/javascript">

    app.controller("UserCtrl", ["$scope", "$http",
        function ($scope, $http) {
            init();
            function init() {
                initialize();
                GetUserList();
                GetAllRole();
                GetAllPost();
            }
            function initialize() {
                $scope.Menus = [];
                $scope.ChangeRoleUser = ChangeRoleUser;
                $scope.LoadAllMenu = LoadAllMenu;
                $scope.SaveRoleMenu = SaveRoleMenu;
                $scope.MenuID = '';
                $scope.selectedUser = 0;

                $scope.GetUserList = GetUserList;
                $scope.Users = [];
                $scope.User = {};
                $scope.SaveUser = SaveUser;

                $scope.EditUser = EditUser;
                $scope.DeleteUser = DeleteUser;

                $scope.ViewUser = ViewUser;
                $scope.User2 = {};

                $scope.AllRoles = [];
                $scope.GetAllRole = GetAllRole;
                $scope.AllPost = [];
                $scope.GetAllPost = GetAllPost;

                $scope.UpdateUserPhoto = UpdateUserPhoto;
                $scope.SavePassword = SavePassword;
            }

            function GetUserList()
            {
                $scope.Users = [];
                $http({
                    method: 'GET',
                    url: baseUrl + 'Service/GetUserList/'
                }).then(function successCallback(response) {
                    $scope.Users = response.data;
                }, function errorCallback(response) {
                });
            }
            function GetAllRole()
            {
                $scope.AllRoles = [];
                $http({
                    method: 'GET',
                    url: baseUrl + 'Setting/GetAllRole/'
                }).then(function successCallback(response) {
                    $scope.AllRoles = response.data;
                }, function errorCallback(response) {
                });
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

            function EditUser(user)
            {
                $scope.User = user;

            }

            function ViewUser(User)
            {
                $scope.User2 = User;
            }

            function SaveUser()
            {
                console.log($scope.User);
                if ($scope.User.Id > 0)
                {
                    $http({
                        method: 'POST',
                        url: baseUrl + 'Service/UpdateUser/',
                        headers: {'Content-Type': 'application/json'},
                        data: JSON.stringify($scope.User)
                    }).success(function (data) {
                        console.log(data);
                        GetUserList();
                        $scope.User = {};
                        $('#myModal').modal('toggle');
                        swal("Successfully Updated", "User");

                    });
                }
            }

            function SavePassword()
            {
                console.log($scope.User);
                if ($scope.User.Id > 0 && $scope.User.Password1 == $scope.User.Password2)
                {
                    $http({
                        method: 'POST',
                        url: baseUrl + 'Service/SavePassword/',
                        headers: {'Content-Type': 'application/json'},
                        data: JSON.stringify($scope.User)
                    }).success(function (data) {
                        console.log(data);
                        $scope.User = {};
                        // $('#myModal').modal('toggle');
                        swal("Successfully Updated Password", "User");

                    });
                }
                else
                {
                    alert("Password Not Matched!!! Please try Again");
                }
            }
            function UpdateUserPhoto()
            {
                {
                    $scope.User.Photo = "";
                    var files = $("#imgs").get(0).files;
                    var Id = $scope.User.Id;
                    if ($scope.User.Id > 0) {
                        $http({
                            method: 'POST',
                            url: baseUrl + '/Service/UpdateUserPhoto/',
                            headers: {'Content-Type': undefined},
                            transformRequest: function (data) {
                                var formData = new FormData();
                                formData.append('Id', Id);
                                if (files.length > 0)
                                    formData.append("Img", files[0]);
                                return formData;
                            }

                        }).success(function (data) {

                            $scope.User.Photo = data.Photo;
                            console.log(data);
                            swal("User Info!", "...Successfully Updated!");
                        });
                    }
                    else
                    {
                        alert("First Fillup Above Data.. You have no UserID")
                    }
                }
            }


            function DeleteUser(user)
            {
                console.log(user);
                var r = confirm("Do you want to Delete!");
                if (r == true) {
                    $http({
                        method: 'GET',
                        url: baseUrl + 'Service/DeleteUser/' + user.Id + '/' + user.Photo
                    }).then(function successCallback(response) {
                        swal("User!", "Deleted Successfully!!");
                        GetUserList();
                    }, function errorCallback(response) {
                        swal("User!", "Not Deleted!!!!");
                    });

                }
            }


//All role related part bellow
            function ChangeRoleUser(ID)
            {
                console.log(ID);
                $scope.selectedUser = ID;
                LoadAllMenu(ID);
            }

            function LoadAllMenu(ID)
            {
                $scope.Menus = [];
                $http({
                    method: 'GET',
                    url: baseUrl + 'Service/LoadAllMenuAndUserRole/' + ID
                }).then(function successCallback(response) {
                    $scope.Menus = response.data;
                    console.log($scope.Menus);
                }, function errorCallback(response) {

                });
            }

            $scope.checkAll = function checkAll() {

                if ($scope.selectedAll) {
                    $scope.selectedAll = true;
                } else {
                    $scope.selectedAll = false;
                }
                angular.forEach($scope.Menus.Menu, function (User) {
                    User.Selected = $scope.selectedAll;
                });
                console.log($scope.Menus.Menu);
            };

            $scope.checkAll2 = function checkAll2(x, ID) {
                $scope.ID = ID;

                angular.forEach($scope.Menus.Menu2, function (User2) {
                    if (User2.MainMenuID == ID)
                    {
                        User2.Selected = x;
                    }

                });
                console.log($scope.Menus.Menu2);
            };

            function SaveRoleMenu()
            {
                $scope.MenuID = '';
                $scope.MenuID2 = '';
                angular.forEach($scope.Menus.Menu, function (Mn) {
                    if (Mn.Selected == 1)
                    {
                        $scope.MenuID = $scope.MenuID + Mn.ID + ',';
                    }
                });

                angular.forEach($scope.Menus.Menu2, function (Mn2) {
                    if (Mn2.Selected == 1)
                    {
                        $scope.MenuID2 = $scope.MenuID2 + Mn2.ID + ',';
                    }
                });

                console.log($scope.Menus.Menu);
                var MenuID = $scope.MenuID;
                var MenuID2 = $scope.MenuID2;
                console.log($scope.Menus.Menu, " ", $scope.MenuID2);
                MenuID = MenuID.replace(/,\s*$/, "");
                MenuID2 = MenuID2.replace(/,\s*$/, "");

                console.log(MenuID, $scope.selectedUser, MenuID2);
                $http.post(
                        baseUrl + 'Service/SaveUserRole',
                        {'MenuID': MenuID, 'selectedUser': $scope.selectedUser, 'MenuID2': MenuID2}
                ).success(function (data) {
                    console.log(data);
                    $scope.MenuID = '';
                    $scope.MenuID2 = '';
                    //$scope.selectedUser=0;
                    LoadAllMenu($scope.selectedUser);
                    swl("Update Successfully!!");
                }).error(function (data) {
                    alert(data);
                });
            }
        }]);
</script>