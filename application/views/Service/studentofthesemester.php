
<div ng-controller="ResearchCtrl" class="col-md-10" style="background-color: #ffffff;">

    <div class="col-md-12">
        <h2>Student of the Semester</h2>

        <?php
        if (isset($_SESSION['success'])) {
            echo "<div class='alert alert-success'>" . $_SESSION['success'] . "</div>";
        }
        ?>

        <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>

        <button type="button"  class="btn btn-info pull-left" data-toggle="modal" data-target="#myModal">Add Item</button> 

    </div>
    <!--List of breaking news-->
    <br>
    <div class="col-md-12">
        <!--<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button>-->
        <table class="table table-striped">
            <tr>
                <th>SN</th>
                <th>Name </th>
                <th>Roll </th>
                <th>Attendance </th>
                <th>Exam & Other </th>
                <th>Photo </th>
                <th>Action </th>
            </tr>
            <tr ng-repeat="News in AllNews">
                <td>{{$index + 1}} </td>
                <td>{{News.FullName}} </td>
                <td>{{News.RollNo}} </td>
                <td>{{News.Attendance}} </td>
                <td>{{News.Exam}}-{{News.Behave}}  </td>
                <td><img ng-src="<?php echo base_url("uploads/students/"); ?>{{News.Photo}}" style="width: 50px; height: 50px;"/> </td>
                <td><button class="btn btn-danger" ng-click="DeleteStudent(News.Id)" >Delete</button></td>
            </tr>

        </table>

    </div>

    <!-- Add Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" >
        <div class="modal-dialog" role="document" style="width:950px;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Student of the Semester</h4>
                </div>
                <div class="modal-body">
                    <form name="SOSSearchForm" ng-submit="SearchStudent()" />
                    <div class="row">               
                        <div class="col-md-6 form-group">
                           
                            <div class="input-group">
                                <input type="text" class="form-control" ng-model="SOS.StudentID"  name="StudentID"  id="StudentID" required placeholder="Reg No">
                                <div class="input-group-btn">
                                    <button class="btn btn-default" type="submit">
                                        <i class="glyphicon glyphicon-search"></i>
                                    </button>
                                </div>
                            </div> 

                        </div>
                    </div>

                    </form>

                    <div class="row">
                        <div class="col-md-4 form-group">
                            <label for="FullName" >Name</label>
                            <input class="form-control" ng-model="SOS2.FullName"  name="FullName"  id="FullName" readonly/>
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="FacultyName" >Faculty</label>
                            <input class="form-control" ng-model="SOS2.FacultyName"  name="Faculty"  id="Faculty" readonly/>
                        </div>
                        <div class=" col-md-4 form-group">
                            <label for="SessionName" >Session</label>
                            <input class="form-control" ng-model="SOS2.SessionName"  name="Session"  id="Session" readonly/>
                        </div>
                    </div>

                    <form name="SOSForm" ng-submit="AddStudentoftheSemester()" />
                    <div class="form-group">
                        <label for="Attendance">Attendance</label>
                        <input type="text" class="form-control" ng-model="SOS.Attendance" name="Attendance" id="Attendance " required/>

                    </div>
                    <div class="form-group">
                        <label for="Exam" >Exam Result</label>
                        <input class="form-control" ng-model="SOS.Exam"  name="Exam"/>
                    </div>
                    <div class="form-group">
                        <label for="Behave" >Behave</label>
                        <input class="form-control" ng-model="SOS.Behave"  name="Behave" id="Behave" />
                    </div>


                    <div class="form-group">

                        <button type="Submit" class="btn btn-info" name="Create" id="Create">Add</button>
                    </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                </div>
            </div>
        </div>
    </div>
    <!--modal end-->

</div>
</body>
</html>

<script type="text/javascript">

    app.controller("ResearchCtrl", ["$scope", "$http",
        function ($scope, $http) {
            init();
            function init() {
                initialize();
                GetAllStudentsoftheSemester();

            }
            function initialize() {
                $scope.AllNews = [];
                $scope.News = {};
                $scope.SearchStudent = SearchStudent;
                $scope.DeleteStudent = DeleteStudent;
                $scope.AddStudentoftheSemester = AddStudentoftheSemester;
                $scope.SOS = {};
                $scope.SOS2 = {}; //for temporary data hold by searching ID
            }

            function SearchStudent()
            {
                $scope.SOS2 = {};

                $http({
                    method: 'GET',
                    url: baseUrl + 'Service/SearchStudent/' + $scope.SOS.StudentID
                }).then(function successCallback(response) {
                    $scope.SOS2 = response.data;
                }, function errorCallback(response) {
                });
            }
            function GetAllStudentsoftheSemester() {
                $scope.AllNews = [];

                $http({
                    method: 'GET',
                    url: baseUrl + 'Service/GetAllStudentsoftheSemester/'
                }).then(function successCallback(response) {
                    $scope.AllNews = response.data;
                }, function errorCallback(response) {
                });
            }


            function DeleteStudent(id)
            {
                var SId = id;

                var r = confirm("Do you want to Delete!");
                if (r == true) {
                    $http({
                        method: 'GET',
                        url: baseUrl + 'Service/DeleteStudent/' + SId
                    }).then(function successCallback(response) {
                        GetAllStudentsoftheSemester();

                        swal("Student of the Semester!", "Deleted Successfully!!");
                    }, function errorCallback(response) {

                        swal("Student of the Semester!", "Not Deleted!!!!");
                    });

                }
            }

            function AddStudentoftheSemester()
            {
                $scope.SOS.isShow = 1;
                console.log($scope.SOS);
                $http({
                    method: 'POST',
                    url: baseUrl + 'Service/AddStudentoftheSemester',
                    headers: {'Content-Type': 'application/json'},
                    data: JSON.stringify($scope.SOS)
                }).success(function (data) {
                    console.log(data);
                    GetAllStudentsoftheSemester();
                    swal("Successfully added", "Student of the Semester");
                    $scope.SOS = {};
                });
            }



        }]);
</script>