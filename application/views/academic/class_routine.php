<div class="col-md-10 panel panel-primary" ng-controller="ClassRoutine"> 
    <h3 class="panel-heading"><?php echo $Title; ?></h3>
    <table class="table table-striped table-bordered" >              

        <tbody ng-repeat="D in ClassRoutines.day">
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

            }

            function GetAllClassRoutine() {
                $scope.ClassRoutines = [];
                $http({
                    method: 'GET',
                    url: baseUrl + 'Home/GetAllClassRoutine/'
                }).then(function successCallback(response) {
                    $scope.ClassRoutines = response.data;
                }, function errorCallback(response) {
                });
            }






        }]);
</script> 