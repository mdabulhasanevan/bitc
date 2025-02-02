
<div ng-controller="DefaultCtrl" class="col-md-10" style="background-color: #ffffff;">

    <div class="col-md-12">
        <h2>Faculty Info</h2>

        <?php
        if (isset($_SESSION['success'])) {
            echo "<div class='alert alert-success'>" . $_SESSION['success'] . "</div>";
        }
        ?>

        <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>

        <button type="button"  class="btn btn-info pull-left" data-toggle="modal" data-target="#myModal">Add Faculty</button> 

    </div>
    <!--List of Faculty-->
    <br>
    <div class="col-md-12">
        <table class="table table-striped">
            <tr>
                <th>SN</th>
                <th> Name </th>          
                 <th>Meaning of Name </th>  
                 <th>In course Mark
                <th>Action </th>
            </tr>
            <tr ng-repeat="Faculty in AllFaculty">
                <td>{{$index + 1}} </td>
                <td>{{Faculty.Name}} </td>
                <td>{{Faculty.FullMeaning}} </td>
                 <td>{{Faculty.InCourse}} </td>
                <td>
                    <button class="btn btn-warning" data-toggle="modal" data-target="#myModal" ng-click="Edit(Faculty)" >Edit</button>
                    <button class="btn btn-danger" ng-click="DeleteFaculty(Faculty.FId)" >Delete</button></td>
            </tr>
        </table>

    </div>

    <!-- Add Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" >
        <div class="modal-dialog" role="document" style="width:950px;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" ng-click="reset()" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Add Faculty</h4>
                </div>
                <div class="modal-body">
                    <form name="SOSForm" ng-submit="AddFaculty()" />                   
                    <div class="form-group">
                        <label for="Exam" >Faculty Name</label>
                        <input class="form-control" ng-model="Faculty.Name"  name="Exam"/>
                    </div>
                     <div class="form-group">
                        <label for="Exam" >Meaning</label>
                        <input class="form-control" ng-model="Faculty.FullMeaning"  name="Exam"/>
                    </div>
                      <div class="form-group">
                        <label for="Exam" >In Course Marks</label>
                        <input class="form-control" ng-model="Faculty.InCourse"  name="Exam"/>
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
                GetAllFaculty();

            }
            function initialize() {
                $scope.AllFaculty = [];
                $scope.DeleteFaculty = DeleteFaculty;
                $scope.AddFaculty = AddFaculty;
                $scope.Faculty = {};
                $scope.Edit = Edit;
                $scope.reset=reset;

            }

            function GetAllFaculty()
            {
                $scope.AllFaculty = [];
                $http({
                    method: 'GET',
                    url: baseUrl + 'Setting/GetAllFaculty/'
                }).then(function successCallback(response) {
                    $scope.AllFaculty = response.data;
                    console.log($scope.AllFaculty);
                }, function errorCallback(response) {
                });
            }

            function DeleteFaculty(id)
            {
                var FId = id;
                console.log(FId);
                var r = confirm("Do you want to Delete!");
                if (r == true) {
                    $http({
                        method: 'GET',
                        url: baseUrl + 'Setting/DeleteFaculty/' + FId
                    }).then(function successCallback(response) {
                        swal("Faculty!", "Deleted Successfully!!");
                        GetAllFaculty();
                    }, function errorCallback(response) {
                        swal("Faculty!", "Not Deleted!!!!");
                    });

                }
            }

            function AddFaculty()
            {
                console.log($scope.Faculty);
                //update
                if ($scope.Faculty.FId > 0)
                {
                    $http({
                        method: 'POST',
                        url: baseUrl + 'Setting/UpdateFaculty/',
                        headers: {'Content-Type': 'application/json'},
                        data: JSON.stringify($scope.Faculty)
                    }).success(function (data) {   
                        console.log(data);
                        GetAllFaculty();
                        $scope.Faculty={};
                         $('#myModal').modal('toggle');
                        swal("Successfully Updated", "Faculty");
                        
                    });
                }
                else {   
                    //add
                    $http({
                        method: 'POST',
                        url: baseUrl + 'Setting/AddFaculty/',
                        headers: {'Content-Type': 'application/json'},
                        data: JSON.stringify($scope.Faculty)
                    }).success(function (data) {
                        console.log(data);
                        GetAllFaculty();
                         $('#myModal').modal('toggle');
                        swal("Successfully added", "Faculty");
                        $scope.Faculty = {};
                    });
                }
            }

            function Edit(Faculty)
            {
                $scope.Faculty = {};
                $scope.Faculty = Faculty;
            }
            
            function reset()
            {
                $scope.Faculty = {};
            }

        }]);
</script>