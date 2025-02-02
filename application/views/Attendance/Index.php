<div ng-controller="AttendanceCtrl" class="col-md-10" style="background-color: #ffffff;">
    <button class="btn btn-primary " data-toggle="modal" data-target="#myModal" ><span class="glyphicon glyphicon-plus"></span> ADD Attend</button>
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
                    <select class="form-control"  ng-model="Attendance2.FacultyID" id="Faculty" name="Faculty" ng-options="Attendance.FId as Attendance.Name for Attendance in AllFields.faculty">
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
                    <select class="form-control"  ng-model="Attendance2.SessionID" id="Session"  name="Session" ng-options="Attendance.SessionId as Attendance.Session for Attendance in AllFields.session">
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
                    <select class="form-control"  ng-model="Attendance2.SemesterID" id="Semester"  name="Semester" ng-options="Attendance.ID as Attendance.Name for Attendance in AllFields.semester |  filter:{Faculty:Attendance2.FacultyID}">
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
                    <select class="form-control" required ng-model="Attendance2.SubjectID" id="Subject"  name="Subject" ng-options="Attendance.SubID as Attendance.Name for Attendance in AllFields.subjects | filter:{Faculty:Attendance2.FacultyID, Semester: Attendance2.SemesterID}">
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
<center><button id='print' style='margin-top: 10px; padding: 10px; border: none; text-align: center; background: black; border-radius: 4px; color: #fff; font-weight: bold; cursor: pointer;'>PRINT </button></center>

<div class="print_div" style=" margin-left:  20em;" >
    <div><h2 style="text-align: center;"> Attendance Sheet</h2></div>
    <p><b>Faculty:</b> {{Faculty}} <b>Session:</b> {{Session}} <b>Semester:</b> {{Semester}}  <b>Subject:</b> {{Subject}} </p>
    
    <table class="table table-striped sticky" >
        <tr>
            <th class="" style="position:absolute; width:20em; left:0; background-color: #9acfea; text-align: center;">Name( Reg. No )</th>
            <th ng-repeat="TT in AllAttendance.OnlyDate"> 
                <span class="" style="font-size: 10px;"> {{TT.Date| date : "dd-MMM-yy"}}<br>{{TT.Teacher}} <br>count as: {{TT.ClassCount}} </span>
                <!--<span class="label label-danger" data-toggle="modal" data-target="#myModal" ng-click="EditAttendance(TT)" > Edit</span>-->   
            </th>
        </tr>
        
        <tr ng-repeat="AT in AllAttendance.GroupData" style="overflow: scroll;">
            <!--{{AT.Faculty}} {{AT.Session}} {{AT.Semester}} --->
            
            <td class="" style="position:absolute; width:20em;left:0; height: fit-content; font-size: 10px;">{{$index+1}}. ]  <b>{{AT.Name}}</b>( {{AT.RegNo}}   ) </td>
            
            <td  ng-repeat="XT in AllAttendance.AllData|filter:{StudentID:AT.StudentID}" >
                <span ng-show="XT.isAttend == 1" class="glyphicon glyphicon-ok"></span> 
                <span ng-show="XT.isAttend == 0" style="color:red" class="glyphicon glyphicon-remove"></span>
            </td>
        </tr>
       
        
        <!--bottom row same as top header-->
<!--        <tr>
            <th class="" style="position:absolute; width:20em; left:0; "></th>
            <th ng-repeat="TT in AllAttendance.OnlyDate"> <span class="" style="font-size: 10px;"> {{TT.Date| date : "dd-MMM-yy"}} </span> </th>
        </tr>-->
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
                                Subjects  <br><br>  Count as
                                <!--<span class="required">*</span>-->
                            </label>
                            <div class="col-md-7">
                                <select class="form-control"  ng-model="Attendance.SubjectID" required name="Faculty" ng-options="Attendance.SubID as Attendance.Name for Attendance in AllFields.subjects | filter:{Faculty:Attendance.FacultyID, Semester: Attendance.SemesterID}">
                                    <option value="" selected="selected">Choose Option</option>
                                </select>
                                <div class="form-control-focus"> </div>


                                <select class="form-control"  ng-model="Attendance.ClassCount"  required name="ClassCount" >
                                    <option value="">Select</option>
                                    <option value="1" >1 Class</option>
                                    <option value="2">2 Class</option>
                                    <option value="3" >3 Class</option>
                                    <option value="4" >4 Class</option>
                                    <option value="5" >5 Class</option>
                                    <option value="6" >6 Class</option>
                                    <option value="7" >7 Class</option>
                                    <option value="8" >8 Class</option>
                                </select>
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
                                <select class="form-control"  ng-model="Attendance.TeacherID" required name="Teacher" ng-options="Attendance.Id as Attendance.Name for Attendance in AllFields.teacher | filter:{Id:'<?php echo $_SESSION["id"]; ?>'}:true">
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
                                <div class="form-group pull-right">

                                    <button type="Submit" class="btn btn-info" name="Create" id="Create">Search</button>
                                </div>
                            </div>

                        </div> 

                    </div>

                </div>

                </form>
                <div class="row">

                    <table class="table table-responsive">
                        <tr>
                            <th>SN</th>
                            <th></th>
                            <th>Name</th>
                            <th>RegNo</th>
                            <th>Roll</th>
                            <!--<th>Roll</th>-->
                            <th><input type="checkbox" ng-model="selectedAll" ng-click="checkAll()" /> All </th>
                        </tr>
                        <tbody>
                            <tr ng-repeat="Y in AllStudents.Student2" style="font-size: 12px;">
                                <td> {{$index+1}} </td>
                                <td><img ng-src="<?php echo base_url("uploads/students/"); ?>{{Y.Photo}}" style="width: 25px; height: 25px;"/></td>
                               
                                <td> {{Y.FullName}} </td>
                                <td> {{Y.RegNo}} </td>
                                <td> {{Y.CollegeRoll}} </td>
                                <!--<td> {{Y.RollNO}} </td>-->                                                
                                <td> <input type="checkbox"ng-model="Y.isAttend"  ng-checked="Y.isAttend==1" /> </td>
                            </tr>
                        </tbody>
                    </table>
                    <button type="button" ng-click="AddAttendance()" class="btn btn-info pull-right" name="Create" id="Create">Add</button>


                </div>
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
                
                $scope.EditAttendance=EditAttendance;
                
                //for initializing search criteria
                $scope.Attendance2.FacultyID = null;
                $scope.Attendance2.SessionID = null;
                $scope.Attendance2.SemesterID = null;
                $scope.Attendance2.SubjectID = null;
                $scope.Attendance2.Date = null;
                $scope.Attendance2.Date2 = null;

            }
            function EditAttendance(data)
            {
                console.log(data);
                
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
                //for show search Detail like semester subject etc
                var semester = $("#Semester option:selected").text();
                $scope.Semester = semester;
                var Faculty = $("#Faculty option:selected").text();
                $scope.Faculty = Faculty;
                var Session = $("#Session option:selected").text();
                $scope.Session = Session;
                var Subject = $("#Subject option:selected").text();
                $scope.Subject = Subject;


                //  console.log($scope.Attendance2);
                $scope.AllAttendance = [];
                $http({
                    method: 'POST',
                    url: baseUrl + 'Attendance/AllAttendance/',
                    data: $scope.Attendance2
                }).then(function successCallback(response) {
                    $scope.AllAttendance = response.data;
                    // console.log($scope.AllAttendance);
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
                //console.log($scope.Attendance);
                $scope.AllStudents = [];
                $http({
                    method: 'POST',
                    url: baseUrl + 'Attendance/GetStudents/',
                    data: $scope.Attendance
                }).then(function successCallback(response) {
                    $scope.AllStudents = [];
                    $scope.AllStudents = response.data;
                    // console.log($scope.AllStudents);

//                    angular.forEach($scope.AllStudents.Student2, function (Students) {
//                        Students.isAttend = 0;
//
//                    });

                    // console.log($scope.AllStudents);
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
                    Students.ClassCount = $scope.Attendance.ClassCount;
                });

              console.log($scope.AllStudents.Student2);

                $http({
                    method: 'POST',
                    url: baseUrl + 'Attendance/AddAttendance/',
                    data: $scope.AllStudents.Student2
                }).then(function successCallback(response) {
                    $scope.Message = response.data;
                    alert($scope.Message);
                    // console.log($scope.Message);
                }, function errorCallback(response) {
                });
            }



        }]);
</script>    


<!--print html--> 
<script>
    // here we will write our custom code for printing our div
    $(function () {
        $('#print').on('click', function () {
            //Print ele2 with default options
            $.print(".print_div");
        });
    });
</script>