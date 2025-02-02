<div ng-controller="AttendanceCtrl" class="col-md-10" style="background-color: #ffffff;">

    <hr>
    <form name="AttendanceForm" ng-submit="DayWiseAttendanceReport()" />

    <!--second row-->
    <div class="row">

        <div class="col-md-4">
            <div class="form-group" ng-class="">
                <label class="col-md-5 control-label">
                     Date :

                </label>
                <div class="col-md-7">

                    <input type="text" ng-model="Attendance.Date" id="datepicker" autocomplete="off" size="30" class="form-control" />
                    <div class="form-control-focus"> </div>

                </div>
            </div> 
        </div>
        <div class="col-md-4">
            <div class="form-group" ng-class="">
                <button type="Submit" class="btn btn-info glyphicon glyphicon-filter form-control " name="Create" id="Create">Search</button>

            </div>
        </div> 
    </div>

    
    <div class="row">
        Total Class: {{AttendanceReport.length}}
    <table class="table table-bordered">
        <tr>
            <th>SN</th>
            <th>Date</th>
            <th>Faculty</th>
            <th>Session</th>
            <th>Subject</th>
            <th>Semester</th>
             <th>Teacher</th>
            <th>Total Student</th>
            <th>Attend</th>
            <th>Absent</th>
            <th>Present</th>
        </tr>
        <tr ng-repeat="Report in AttendanceReport">
            <td> {{$index + 1}}</td>
            <td> {{Report.Date}}</td>
            <td> {{Report.Faculty}}</td>
            <td> {{Report.Session}}</td>
            <td> {{Report.Subject}}</td>
            <td> {{Report.Semester}}</td>
             <td> {{Report.Teacher}}</td>
            <td> {{Report.Total}}</td>
            <td> {{Report.Attend}}</td>
            <td> {{Report.Absent}}</td>
            <td> {{Report.Percent}}%</td>
        </tr>
    </table> 
</div>
    
</div>


</form>


</body>
</html>


<script>


    app.controller("AttendanceCtrl", ["$scope", "$http",
        function ($scope, $http) {
            init();
            function init() {
                initialize();
                //GetAllAttendance();

            }
            function initialize() {
                $scope.Attendance = {};
                $scope.AttendanceReport = [];
                $scope.DayWiseAttendanceReport = DayWiseAttendanceReport;

            }
            function DayWiseAttendanceReport()
            {
                
                $scope.AttendanceReport = [];
                $http({
                    method: 'POST',
                    url: baseUrl + 'Attendance/DayWiseAttendanceReport/',
                    data: $scope.Attendance
                }).then(function successCallback(response) {
                    $scope.AttendanceReport = response.data;
                    var total=$scope.AttendanceReport;
                    // swal("Attendance ", "");
                }, function errorCallback(response) {
                });
            }

        }]);
</script>    
