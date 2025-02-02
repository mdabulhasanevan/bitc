<div ng-controller="DefaultCtrl" class="col-md-10" style="background-color: #ffffff;">

    <div class="col-md-12">
        <h2>Session Info</h2>

        <?php
        if (isset($_SESSION['success'])) {
            echo "<div class='alert alert-success'>" . $_SESSION['success'] . "</div>";
        }
        ?>

        <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>

        <button type="button"  class="btn btn-info pull-left" data-toggle="modal" data-target="#myModal">Add Session</button> 

    </div>
    <!--List of Session-->
    <br>
    <div class="col-md-12">
        <table class="table table-striped">
            <tr>
                <th>SN</th>
                <th> Name </th>          
                    
                <th>Action </th>
            </tr>
            <tr ng-repeat="Session in AllSession">
                <td>{{$index + 1}} </td>
                <td>{{Session.Session}} </td>
              
                <td>
                    <button class="btn btn-warning" data-toggle="modal" data-target="#myModal" ng-click="Edit(Session)" >Edit</button>
                    <button class="btn btn-danger" ng-click="DeleteSession(Session.SessionId)" >Delete</button></td>
            </tr>
        </table>

    </div>

    <!-- Add Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" >
        <div class="modal-dialog" role="document" style="width:950px;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" ng-click="reset()" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Add Session</h4>
                </div>
                <div class="modal-body">
                    <form name="SOSForm" ng-submit="AddSession()" />                   
                    <div class="form-group">
                        <label for="Exam" >Session Name</label>
                        <input class="form-control" ng-model="Session.Session"  name="Exam"/>
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
                GetAllSession();

            }
            function initialize() {
                $scope.AllSession = [];
                $scope.DeleteSession = DeleteSession;
                $scope.AddSession = AddSession;
                $scope.Session = {};
                $scope.Edit = Edit;
                $scope.reset=reset;

            }

            function GetAllSession()
            {
                $scope.AllSession = [];
                $http({
                    method: 'GET',
                    url: baseUrl + 'Setting/GetAllSession/'
                }).then(function successCallback(response) {
                    $scope.AllSession = response.data;
                    console.log($scope.AllSession);
                }, function errorCallback(response) {
                });
            }

            function DeleteSession(id)
            {
                var FId = id;
                console.log(FId);
                var r = confirm("Do you want to Delete!");
                if (r == true) {
                    $http({
                        method: 'GET',
                        url: baseUrl + 'Setting/DeleteSession/' + FId
                    }).then(function successCallback(response) {
                        swal("Session!", "Deleted Successfully!!");
                        GetAllSession();
                    }, function errorCallback(response) {
                        swal("Session!", "Not Deleted!!!!");
                    });

                }
            }

            function AddSession()
            {
                console.log($scope.Session);
                //update
                if ($scope.Session.SessionId > 0)
                {
                    $http({
                        method: 'POST',
                        url: baseUrl + 'Setting/UpdateSession/',
                        headers: {'Content-Type': 'application/json'},
                        data: JSON.stringify($scope.Session)
                    }).success(function (data) {   
                        console.log(data);
                        GetAllSession();
                        $scope.Session={};
                         $('#myModal').modal('toggle');
                        swal("Successfully Updated", "Session");
                        
                    });
                }
                else {   
                    //add
                    $http({
                        method: 'POST',
                        url: baseUrl + 'Setting/AddSession/',
                        headers: {'Content-Type': 'application/json'},
                        data: JSON.stringify($scope.Session)
                    }).success(function (data) {
                        console.log(data);
                        GetAllSession();
                         $('#myModal').modal('toggle');
                        swal("Successfully added", "Session");
                        $scope.Session = {};
                    });
                }
            }

            function Edit(Session)
            {
                $scope.Session = {};
                $scope.Session = Session;
            }
            
            function reset()
            {
                $scope.Session = {};
            }

        }]);
</script>