<div ng-controller="AttendanceCtrl" class="col-md-10" style="background-color: #ffffff;">

    <hr>
    <form name="AttendanceForm" ng-submit="SearchAttendance()" />
    <div class="row">
        <div class="col-md-4">
            <div class="form-group" >
                <label class="col-md-5 control-label">
                    Faculty :
                    <span class="required">*</span>
                </label>
                <div class="col-md-7">
                    <select class="form-control"  ng-model="Attendance2.FacultyID"  name="Faculty" ng-options="Attendance.FId as Attendance.Name for Attendance in AllFields.faculty">
                        <option value="" selected="selected">Choose Option</option>
                    </select>
                    <div class="form-control-focus"> </div>

                </div>
            </div> 
        </div>
        <div class="col-md-4">
            <div class="form-group" >
                <label class="col-md-5 control-label">
                    Session :
                    <span class="required">*</span>
                </label>
                <div class="col-md-7">
                    <select class="form-control"  ng-model="Attendance2.SessionID"  name="Session" ng-options="Attendance.SessionId as Attendance.Session for Attendance in AllFields.session">
                        <option value="" selected="selected">Choose Option</option>
                    </select>
                    <div class="form-control-focus"> </div>

                </div>
            </div> 
        </div>
        <div class="col-md-4">
            <div class="form-group" >
                <label class="col-md-5 control-label">
                    Semester :
                    <span class="required">*</span>
                </label>
                <div class="col-md-7">
                    <select class="form-control"  ng-model="Attendance2.SemesterID"  name="Faculty" ng-options="Attendance.ID as Attendance.Name for Attendance in AllFields.semester |  filter:{Faculty:Attendance2.FacultyID}">
                        <option value="" selected="selected">Choose Option</option>
                    </select>
                    <div class="form-control-focus"> </div>

                </div>

            </div> 
        </div>
    </div>
    <!--second row-->
    <div class="row">
        <div class="col-md-4">
            <div class="form-group" >
                <label class="col-md-5 control-label">
                    Subjects :
                    <span class="required">*</span>
                </label>
                <div class="col-md-7">
                    <select class="form-control" required ng-model="Attendance2.SubjectID"  name="Faculty" ng-options="Attendance.SubID as Attendance.Name for Attendance in AllFields.subjects | filter:{Faculty:Attendance2.FacultyID, Semester: Attendance2.SemesterID}">
                        <option value="" selected="selected">Choose Option</option>
                    </select>
                    <div class="form-control-focus"> </div>

                </div>
            </div> 
        </div>
        <div class="col-md-4">
            <div class="form-group" ng-class="">
                <label class="col-md-5 control-label">
                    From Date :
                    <span class="required">*</span>
                </label>
                <div class="col-md-7">

                    <input type="text" ng-model="Attendance2.Date" id="datepicker" autocomplete="off" size="30" class="form-control" />
                    <div class="form-control-focus"> </div>
                    <span ng-show="submitted1 && AttendanceForm.Date.$error.required" class="help-block">Date Required</span>

                </div>
            </div> 
        </div>
        <div class="col-md-4">
            <div class="form-group" >
                <label class="col-md-5 control-label">
                    To Date :
                    <span class="required">*</span>
                </label>
                <div class="col-md-7">

                    <input type="text" ng-model="Attendance2.Date2" id="datepicker2" autocomplete="off" size="30" class="form-control" />
                    <div class="form-control-focus"> </div>
                    <span ng-show="submitted1 && AttendanceForm.Date.$error.required" class="help-block">Date Required</span>

                </div>
            </div> 
        </div>
    </div>
    <div class="row">
        <div class="col-md-2 pull-right ">
            <div class="form-group">

                <button type="Submit" class="btn btn-info glyphicon glyphicon-filter form-control " name="Create" id="Create">Search</button>

            </div> 
        </div>

    </div>

</form>

<div  style="overflow: scroll; margin-left:  20em;" >
    <table class="table table-striped sticky" >

        <tr>
            <th class="" style="position:absolute; width:20em; left:0; background-color: #9acfea; text-align: center;">Name( StudentInsID  - Subject)</th>
            <th ng-repeat="TT in AllAttendance.OnlyDate"><span class="glyphicon glyphicon-remove" ng-click="DeleteAttendance(TT)"></span> <span class="label label-warning"> {{TT.Date| date : "dd-MMM-yy"}} </span> </th>
        </tr>
        <tr ng-repeat="AT in AllAttendance.GroupData" style="overflow: scroll;">
            <!--{{AT.Faculty}} {{AT.Session}} {{AT.Semester}} --->
            <td   class="" style="position:absolute; width:20em;left:0; height: fit-content;"> <b>{{AT.Name}}</b> ( {{AT.StudentInsID}}   {{AT.Subject}}) </td>
            <td  ng-repeat="XT in AllAttendance.AllData|filter:{StudentID:AT.StudentID }" ><span ng-show="XT.isAttend == 1" class="glyphicon glyphicon-ok"></span> <span ng-show="XT.isAttend == 0" style="color:red" class="glyphicon glyphicon-remove"></span></td>
        </tr>

    </table>
</div>

<!-- Add Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" >
    <div class="modal-dialog" role="document" style="">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Set Attendance </h4>
            </div>
            <div class="modal-body">

                <form name="AttendanceForm" ng-submit="SearchStudent()" />
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group" ng-class="">
                            <label class="col-md-5 control-label">
                                Faculty  
                                <!--<span class="required">*</span>-->
                            </label>
                            <div class="col-md-7">
                                <select class="form-control"  ng-model="Attendance.FacultyID" required name="Faculty" ng-options="Attendance.FId as Attendance.Name for Attendance in AllFields.faculty">
                                    <option value="" selected="selected">Choose Option</option>
                                </select>
                                <div class="form-control-focus"> </div>

                            </div>
                        </div> 
                    </div>
                    <div class="col-md-4">
                        <div class="form-group" >
                            <label class="col-md-5 control-label">
                                Session  
                                <!--<span class="required">*</span>-->
                            </label>
                            <div class="col-md-7">
                                <select class="form-control"  ng-model="Attendance.SessionID" required name="Session" ng-options="Attendance.SessionId as Attendance.Session for Attendance in AllFields.session">
                                    <option value="" selected="selected">Choose Option</option>
                                </select>
                                <div class="form-control-focus"> </div>

                            </div>
                        </div> 
                    </div>
                    <div class="col-md-4">
                        <div class="form-group" >
                            <label class="col-md-5 control-label">
                                Semester  
                                <!--<span class="required">*</span>-->
                            </label>
                            <div class="col-md-7">
                                <select class="form-control"  ng-model="Attendance.SemesterID" required name="Faculty" ng-options="Attendance.ID as Attendance.Name for Attendance in AllFields.semester |  filter:{Faculty:Attendance.FacultyID}  ">
                                    <option value="" selected="selected">Choose Option</option>
                                </select>
                                <div class="form-control-focus"> </div>

                            </div>

                        </div> 
                    </div>

                </div>
                <!--second row-->
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group" >
                            <label class="col-md-5 control-label">
                                Subjects  
                                <!--<span class="required">*</span>-->
                            </label>
                            <div class="col-md-7">
                                <select class="form-control"  ng-model="Attendance.SubjectID" required name="Faculty" ng-options="Attendance.SubID as Attendance.Name for Attendance in AllFields.subjects | filter:{Faculty:Attendance.FacultyID, Semester: Attendance.SemesterID}">
                                    <option value="" selected="selected">Choose Option</option>
                                </select>
                                <div class="form-control-focus"> </div>

                            </div>
                        </div> 
                    </div>
                    <div class="col-md-4">
                        <div class="form-group" ng-class="">
                            <label class="col-md-5 control-label">
                                Teacher  
                                <!--<span class="required">*</span>-->
                            </label>
                            <div class="col-md-7">
                                <select class="form-control"  ng-model="Attendance.TeacherID" required name="Teacher" ng-options="Attendance.Id as Attendance.Name for Attendance in AllFields.teacher">
                                    <option value="" selected="selected">Choose Option</option>
                                </select>
                                <div class="form-control-focus"> </div>

                            </div>
                        </div> 
                    </div>
                    <div class="col-md-4">
                        <div class="form-group" ng-class="">
                            <label class="col-md-5 control-label">
                                Date  
                                <!--<span class="required">*</span>-->
                            </label>
                            <div class="col-md-7">
                                <input type="text" id="datepicker3" autocomplete="off"   ng-model="Attendance.Date" class="form-control" required/>

                                <div class="form-control-focus"> </div>

                            </div>
                        </div> 
                    </div>
                    <div class="form-group pull-right">

                        <button type="Submit" class="btn btn-info" name="Create" id="Create">Search</button>
                    </div>
                </div>

                </form>
                <div class="row">

                    <table class="table table-striped">
                        <tr>
                            <th>Name</th>
                            <th>StudentID</th>
                            <th>Roll</th>
                            <th><input type="checkbox" ng-model="selectedAll" ng-click="checkAll()" /> Is Attend </th>
                        </tr>
                        <tbody>
                            <tr ng-repeat="Y in AllStudents.Student2">
                                <td> {{Y.FullName}} </td>
                                <td> {{Y.StudentInsID}} </td>
                                <td> {{Y.RollNO}} </td>                                                
                                <td> <input type="checkbox"ng-model="Y.isAttend" ng-true-value="true" ng-false-value="false"/> </td>
                            </tr>
                        </tbody>
                    </table>


                </div>
                <button type="button" ng-click="AddAttendance()" class="btn btn-info pull-right" name="Create" id="Create">Add</button>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!--modal end-->

</div>

</body>
</html>


<script>


    app.controller("AttendanceCtrl", ["$scope", "$http",
        function ($scope, $http) {
            init();
            function init() {
                initialize();
                //GetAllAttendance();
                LoadAllFields();
            }
            function initialize() {
                $scope.AllAttendance = [];
                $scope.Attendance = {};
                $scope.Attendance2 = {};
                $scope.LoadAllFields = LoadAllFields;
                $scope.AllFields = [];
                $scope.SearchStudent = SearchStudent;
                $scope.AllStudents = [];
                $scope.AddAttendance = AddAttendance;

                $scope.SearchAttendance = SearchAttendance;
                $scope.AllAttendance = {};

                //for initializing search criteria
                $scope.Attendance2.FacultyID = null;
                $scope.Attendance2.SessionID = null;
                $scope.Attendance2.SemesterID = null;
                $scope.Attendance2.SubjectID = null;
                $scope.Attendance2.Date = null;
                $scope.Attendance2.Date2 = null;

                //delete
                $scope.DeleteAttendance = DeleteAttendance;

            }
            function DeleteAttendance(Date)
            {
                $scope.DateInfo=Date;
                
                $scope.Attendance2.Date = $scope.DateInfo.Date;
                var r = confirm("Are you sure ?? you will loss all data")

                if (r)
                {                  
                    console.log($scope.Attendance2);
                    $http({
                        method: 'POST',
                        url: baseUrl + 'Attendance/DeleteAttendanceSingal/',
                        data: $scope.Attendance2
                    }).then(function successCallback(response) {
                        $scope.Message = response.data;
                        SearchAttendance();
                        console.log($scope.Message);
                    }, function errorCallback(response) {
                    });

                }

            }

            $scope.checkAll = function checkAll() {
                if ($scope.selectedAll) {
                    $scope.selectedAll = true;
                } else {
                    $scope.selectedAll = false;
                }
                angular.forEach($scope.AllStudents.Student2, function (User) {
                    User.isAttend = $scope.selectedAll;
                });
            }
            function SearchAttendance()
            {
                console.log($scope.Attendance2);
                $scope.AllAttendance = [];
                $http({
                    method: 'POST',
                    url: baseUrl + 'Attendance/AllAttendance/',
                    data: $scope.Attendance2
                }).then(function successCallback(response) {
                    $scope.AllAttendance = response.data;
                    console.log($scope.AllAttendance);
                }, function errorCallback(response) {
                });
            }


            function GetAllAttendance() {
                $scope.AllAttendance = [];
                $http({
                    method: 'GET',
                    url: baseUrl + 'Attendance/AllAttendance/'
                }).then(function successCallback(response) {
                    $scope.AllAttendance = response.data;
                }, function errorCallback(response) {
                });
            }

            function LoadAllFields()
            {
                $scope.AllFields = [];
                $http({
                    method: 'GET',
                    url: baseUrl + 'Routine/LoadAllFields/'
                }).then(function successCallback(response) {
                    $scope.AllFields = response.data;
                }, function errorCallback(response) {
                });
            }

            function SearchStudent()
            {
                console.log($scope.Attendance);
                $scope.AllStudents = [];
                $http({
                    method: 'POST',
                    url: baseUrl + 'Attendance/GetStudents/',
                    data: $scope.Attendance
                }).then(function successCallback(response) {
                    $scope.AllStudents = response.data;
                    console.log($scope.AllStudents);

                    angular.forEach($scope.AllStudents.Student2, function (Students) {
                        Students.isAttend = 0;

                    });

                    console.log($scope.AllStudents);
                }, function errorCallback(response) {
                });
            }

            function AddAttendance()
            {
                angular.forEach($scope.AllStudents.Student2, function (Students) {
                    Students.FacultyID = $scope.Attendance.FacultyID;
                    Students.SessionID = $scope.Attendance.SessionID;
                    Students.SemesterID = $scope.Attendance.SemesterID;
                    Students.SubjectID = $scope.Attendance.SubjectID;
                    Students.Date = $scope.Attendance.Date;
                    Students.TeacherID = $scope.Attendance.TeacherID;
                });

                console.log($scope.AllStudents.Student2);

                $http({
                    method: 'POST',
                    url: baseUrl + 'Attendance/AddAttendance/',
                    data: $scope.AllStudents.Student2
                }).then(function successCallback(response) {
                    $scope.Message = response.data;
                    alert($scope.Message);
                    console.log($scope.Message);
                }, function errorCallback(response) {
                });
            }



        }]);
</script>    
