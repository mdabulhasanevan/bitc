
<div ng-controller="DefaultCtrl" class="col-md-10" style="background-color: #ffffff;">

    <div class="col-md-12">
        <h2>Semester Info</h2>

        <?php
        if (isset($_SESSION['success'])) {
            echo "<div class='alert alert-success'>" . $_SESSION['success'] . "</div>";
        }
        ?>

        <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>

        <button type="button"  class="btn btn-info pull-left" data-toggle="modal" data-target="#myModal">Add Semester</button> 

    </div>
    <!--List of Semester-->
    <br>
    <div class="col-md-12">
        <table class="table table-striped">
            <tr>
                <th>SN</th>
                <th> Semester </th>
                <th> Faculty</th>          
               
                <th>Action </th>
            </tr>
            <tr ng-repeat="Semester in AllSemester">
                <td>{{$index + 1}} </td>
                <td>{{Semester.Name}} </td>
                <td>{{Semester.FacultyName}} </td>
                
                <td>
                    <button class="btn btn-warning" data-toggle="modal" data-target="#myModal" ng-click="Edit(Semester)" >Edit</button>
                    <button class="btn btn-danger" ng-click="DeleteSemester(Semester.ID)" >Delete</button></td>
            </tr>
        </table>

    </div>

    <!-- Add Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" >
        <div class="modal-dialog" role="document" style="width:950px;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" ng-click="reset()" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Add Semester</h4>
                </div>
                <div class="modal-body">
                    <form name="SOSForm" ng-submit="AddSemester()" /> 
                    <div class="form-group">
                        <label for="Exam" >Faculty</label>
                        <select class="form-control" required="required"  ng-model="Semester.Faculty"  name="" ng-options="item.FId as item.Name for item in AllFaculty">
                            <option value="">Choose Option</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="Exam" >Semester Name</label>
                        <input class="form-control" required="required" ng-model="Semester.Name"  name="Exam" />
                    </div>
                   

                    </div>
                    <div class="form-group">
                        <button type="Submit" class="btn btn-info" name="Create" id="Create">Add</button>
                    </div>

                    </form>
                
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
                GetAllSemester();
                GetAllFaculty();
                
            }
            function initialize() {
                $scope.AllSemester = [];
                $scope.DeleteSemester = DeleteSemester;
                $scope.AddSemester = AddSemester;
                $scope.Semester = {};
                $scope.Edit = Edit;
                $scope.reset = reset;

                $scope.GetAllFaculty = GetAllFaculty;
                $scope.AllFaculty = [];
                
                

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

          
            function GetAllSemester()
            {
                $scope.AllSemester = [];
                $http({
                    method: 'GET',
                    url: baseUrl + 'Setting/GetAllSemester/'
                }).then(function successCallback(response) {
                    $scope.AllSemester = response.data;
                    console.log($scope.AllSemester);
                }, function errorCallback(response) {
                });
            }

            function DeleteSemester(id)
            {
                var Id = id;
                console.log(Id);
                var r = confirm("Do you want to Delete!");
                if (r == true) {
                    $http({
                        method: 'GET',
                        url: baseUrl + 'Setting/DeleteSemester/' + Id
                    }).then(function successCallback(response) {
                        swal("Semester !", "Deleted Successfully!!");
                        GetAllSemester();
                    }, function errorCallback(response) {
                        swal("Semester!", "Not Deleted!!!!");
                    });

                }
            }

            function AddSemester()
            {
                console.log($scope.Semester);
                //update
                if ($scope.Semester.ID > 0)
                {
                    $http({
                        method: 'POST',
                        url: baseUrl + 'Setting/UpdateSemester/',
                        headers: {'Content-Type': 'application/json'},
                        data: JSON.stringify($scope.Semester)
                    }).success(function (data) {
                        console.log(data);
                        GetAllSemester();
                        $scope.Semester = {};
                        
                        $('#myModal').modal('toggle');
                        swal("Successfully Updated", "Semester");

                    });
                }
                else {
                    //add
                    $http({
                        method: 'POST',
                        url: baseUrl + 'Setting/AddSemester/',
                        headers: {'Content-Type': 'application/json'},
                        data: JSON.stringify($scope.Semester)
                    }).success(function (data) {
                        console.log(data);
                        GetAllSemester();
                        $('#myModal').modal('toggle');
                        swal("Successfully added", "Semester");
                        $scope.Semester = {};
                    });
                }
            }

            function Edit(Semester)
            {
                $scope.Semester = {};
                $scope.Semester = Semester;
            }

            function reset()
            {
                $scope.Semester = {};
            }

        }]);
</script>