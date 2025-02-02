
<div ng-controller="DefaultCtrl" class="col-md-10" style="background-color: #ffffff;">

    <div class="col-md-12">
        <h2>My Classes Info</h2>

        <?php
        if (isset($_SESSION['success'])) {
            echo "<div class='alert alert-success'>" . $_SESSION['success'] . "</div>";
        }
        ?>

        <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>

    </div>
    <!--List of Faculty-->
    <br>
    <div class="col-md-12">
           <table class="table table-striped">
                        <tr>
                             <th> Day</th>
                            <th> Room</th>
                            <th> Start Time</th>
                            <th> End Time</th>
                            <th> Teacher</th>
                            <th> Faculty</th>
                            <th> Semester</th>
                            <th> Subject</th>
                           
                        </tr>
                        <tr ng-repeat="Teacher in SingleTeacherDetail">
                             <td> {{Teacher.Day}}</td>
                            <td> {{Teacher.Room}}</td>
                            <td> {{Teacher.StartTime}}</td>
                            <td> {{Teacher.EndTime}}</td>
                            <td> {{Teacher.Teacher}} </td>                          
                            <td> {{Teacher.Faculty}}</td>
                            <td> {{Teacher.Semester}}</td>
                            <td> {{Teacher.Subject}}</td>
                           
                        </tr>
                    </table>

    </div>

  

</div>
</body>
</html>

<script type="text/javascript">

    app.controller("DefaultCtrl", ["$scope", "$http",
        function ($scope, $http) {
            init();
            function init() {
                initialize();
               OpenTeacherAssignClass();

            }
            function initialize() {
                $scope.OpenTeacherAssignClass=OpenTeacherAssignClass;
              $scope.SingleTeacherDetail=[];
            }

           function OpenTeacherAssignClass()
            {
                //var ID = $_SESSION["id"];

                $http({
                    method: 'GET',
                    url: baseUrl + 'Routine/OpenTeacherAssignClass/' + <?php echo $_SESSION["id"];?>
                }).then(function successCallback(response) {
                    $scope.SingleTeacherDetail = response.data;
                }, function errorCallback(response) {
                });
            }


        }]);
</script>