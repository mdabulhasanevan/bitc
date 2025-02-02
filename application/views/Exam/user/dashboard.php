<div ng-controller="ClassRoutine" class="col-md-10" style="background-color: #ffffff;">            
    <!--    <h5 class="well">Wellcome to BITC Admin Panel</h5>-->

    <div class="col-md-6">
        <br/>
       <a class="btn btn-info" href="<?php echo base_url("student/"); ?>">Total Students <br><?php echo $student ?></a>
        <a class="btn btn-danger" href="<?php echo base_url("Service/UserList"); ?>">Total Teachers <br><?php echo $user ?></a>
        <a class="btn btn-success" href="<?php echo base_url("Service/studentofthesemester"); ?>">Student of the Semester <br><?php echo $SOS ?></a>
        <a class="btn btn-primary" href="<?php echo base_url("Service/ResearchandProjects"); ?>">Projects and Thesis <br><?php echo $PT ?></a>
        <a class="btn btn-warning" href="<?php echo base_url("Service/NewsCreate"); ?>">Total Notice<br><?php echo $Notice ?></a>

    </div>
    <div class="col-md-6" style="height: 500px;overflow: scroll; text-align: center; vertical-align: central;">
        <br>
        <a href="<?php echo base_url("Routine/");?>">See All</a>
        <table class="table table-striped table-bordered" >              

            <tbody ng-repeat="D in ClassRoutines.day| filter:{Name:ToDay}">
                <tr>
                    <td style="background-color: #e2e2e2; font-weight: bold"><span>{{D.Name}}</span></td>
                    <th  ng-repeat="y in ClassRoutines.time"><span class="label label-primary">{{y.Time}}-{{y.EndTime}}</span></th>
                </tr>
                <tr ng-repeat="Rom in ClassRoutines.room">

                    <td><span class="label label-danger">{{Rom.Number}}</span></td>
            <span ng-repeat="y in ClassRoutines.time">
                <td ng-repeat="R in ClassRoutines.Routine| filter:{Day:D.Name,Room:Rom.Number}">                

                    <span ng-hide="R.Subject == NULL || R.Subject == 0" > 
                        <span class="label label-success">{{R.Faculty}}-{{R.Semester}}-{{R.Room}}</span><br>
                        <span class="glyphicon glyphicon-book"> </span> {{R.Subject}}<br>
                        <span class="glyphicon glyphicon-user"> </span><span> {{R.Teacher}}</span>                         
                    </span>
                </td>
            </span>
            </tr>

            </tbody>
        </table>
    </div>






</div>
</body>
</html>
<script type="text/javascript">

    app.controller("ClassRoutine", ["$scope", "$http",
        function ($scope, $http) {
            init();
            function init() {
                initialize();
                GetAllClassRoutine();

            }
            function initialize() {
                $scope.ClassRoutines = [];
                $scope.ClassRoutine = {};

                var d=new Date()
    var weekday=new Array("Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday")
                $scope.ToDay =  weekday[d.getDay()];
            }

            function GetAllClassRoutine() {
                $scope.ClassRoutines = [];
                $http({
                    method: 'GET',
                    url: baseUrl + 'Routine/GetAllClassRoutine/'
                }).then(function successCallback(response) {
                    $scope.ClassRoutines = response.data;
                }, function errorCallback(response) {
                });
            }






        }]);
</script>    
