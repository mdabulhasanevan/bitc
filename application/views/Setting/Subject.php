
<div ng-controller="DefaultCtrl" class="col-md-10" style="background-color: #ffffff;">

    <div class="col-md-12">
        <h2>Subject Info</h2>

        <?php
        if (isset($_SESSION['success'])) {
            echo "<div class='alert alert-success'>" . $_SESSION['success'] . "</div>";
        }
        ?>

        <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>

        <button type="button"  class="btn btn-info pull-left" data-toggle="modal" data-target="#myModal">Add Subject</button> 

    </div>
    <!--List of Subject-->
    <br>
    <div class="col-md-12">
        <table class="table table-striped">
            <tr>
                <th>SN</th>               
                <th> Faculty</th> 
                <th> Semester</th>                   
                <th> Subject </th>
                <th> Code</th>  
                <th> Credit</th>
                <th> Syllabus</th>
                <th>Action </th>
            </tr>
            <tr ng-repeat="Subject in AllSubject">
                <td>{{$index + 1}} </td>
                <td>{{Subject.FacultyName}} </td>
                <td>{{Subject.SemesterName}} </td>
                <td>{{Subject.Name}} </td>               
                <td>{{Subject.Code}} </td>
                 <td>{{Subject.Credit}} </td>
                  <td>{{Subject.Syllabus}} </td>
               

                <td>
                    <button class="btn btn-warning" data-toggle="modal" data-target="#myModal" ng-click="Edit(Subject)" >Edit</button>
                    <button class="btn btn-danger" ng-click="DeleteSubject(Subject.SubID)" >Delete</button></td>
            </tr>
        </table>

    </div>

    <!-- Add Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" >
        <div class="modal-dialog" role="document" style="width:950px;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" ng-click="reset()" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Add Subject</h4>
                </div>
                <div class="modal-body">
                    <form name="SOSForm" ng-submit="AddSubject()" /> 
                    <div class="form-group">
                        <label for="Exam" >Faculty</label>
                        <select class="form-control" required="required"  ng-model="Subject.Faculty"  name="" ng-options="item.FId as item.Name for item in AllFaculty">
                            <option value="">Choose Option</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="Exam" >Semester</label>
                        <select class="form-control" required="required"  ng-model="Subject.Semester"  name="" ng-options="item.ID as item.Name for item in AllSemester | filter:{Faculty:Subject.Faculty}">
                            <option value="">Choose Option</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="Exam" >Subject Name</label>
                        <input class="form-control" required="required" ng-model="Subject.Name"  name="Exam" />
                    </div>
                     <div class="form-group">
                        <label for="Exam" >Subject Code</label>
                        <input class="form-control" required="required" ng-model="Subject.Code"  name="Exam" />
                    </div>
                     <div class="form-group">
                        <label for="Exam" >Credit</label>
                        <input class="form-control" required="required" ng-model="Subject.Credit"  name="Exam" />
                    </div>
                    
                    <div class="form-group">
                        <label for="Exam" >Syllabus</label>
                        <select class="form-control"  ng-model="Subject.Syllabus"  name="Syllabus" >
                            <option value="1">1 </option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                        </select>
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
                GetAllSubject();
                GetAllFaculty();
                GetAllSemester();
            }
            function initialize() {
                $scope.AllSubject = [];
                $scope.DeleteSubject = DeleteSubject;
                $scope.AddSubject = AddSubject;
                $scope.Subject = {};
                $scope.Edit = Edit;
                $scope.reset = reset;

                $scope.GetAllFaculty = GetAllFaculty;
                $scope.AllFaculty = [];

                $scope.GetAllSemester = GetAllSemester;
                $scope.AllSemester = [];



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
            function GetAllSubject()
            {
                $scope.AllSubject = [];
                $http({
                    method: 'GET',
                    url: baseUrl + 'Setting/GetAllSubject/'
                }).then(function successCallback(response) {
                    $scope.AllSubject = response.data;
                    console.log($scope.AllSubject);
                }, function errorCallback(response) {
                });
            }

            function DeleteSubject(id)
            {
                var Id = id;
                console.log(Id);
                var r = confirm("Do you want to Delete!");
                if (r == true) {
                    $http({
                        method: 'GET',
                        url: baseUrl + 'Setting/DeleteSubject/' + Id
                    }).then(function successCallback(response) {
                        swal("Subject !", "Deleted Successfully!!");
                        GetAllSubject();
                    }, function errorCallback(response) {
                        swal("Subject!", "Not Deleted!!!!");
                    });

                }
            }

            function AddSubject()
            {
                console.log($scope.Subject);
                //update
                if ($scope.Subject.SubID > 0)
                {
                    $http({
                        method: 'POST',
                        url: baseUrl + 'Setting/UpdateSubject/',
                        headers: {'Content-Type': 'application/json'},
                        data: JSON.stringify($scope.Subject)
                    }).success(function (data) {
                        console.log(data);
                        GetAllSubject();
                        $scope.Subject = {};
                        $('#myModal').modal('toggle');
                        swal("Successfully Updated", "Subject");

                    });
                }
                else {
                    //add
                    $http({
                        method: 'POST',
                        url: baseUrl + 'Setting/AddSubject/',
                        headers: {'Content-Type': 'application/json'},
                        data: JSON.stringify($scope.Subject)
                    }).success(function (data) {
                        console.log(data);
                        GetAllSubject();
                        $('#myModal').modal('toggle');
                        swal("Successfully added", "Subject");
                        $scope.Subject = {};
                    });
                }
            }

            function Edit(Subject)
            {
                $scope.Subject = {};
                $scope.Subject = Subject;
            }

            function reset()
            {
                $scope.Subject = {};
            }

        }]);
</script>