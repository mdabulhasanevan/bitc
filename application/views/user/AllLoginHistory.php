
<div ng-controller="DefaultCtrl" class="col-md-10" style="background-color: #ffffff;">

    <div class="col-md-12">
       

        <?php
        if (isset($_SESSION['success'])) {
            echo "<div class='alert alert-success'>" . $_SESSION['success'] . "</div>";
        }
        ?>

        <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>

    </div>
    <!--List of Batch-->
   
    
    <div class="container">
  <h2>All Login History </h2>
  <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#Employee">Employee</a></li>
    <li><a data-toggle="tab" href="#Student" ng-click="GetStudentHistory();">Student</a></li>
    <!--<li><a data-toggle="tab" href="#menu2">Menu 2</a></li>-->
<!--    <li><a data-toggle="tab" href="#menu3">Menu 3</a></li>-->
  </ul>

  <div class="tab-content">
      <!--tab 1-->
    <div id="Employee" class="tab-pane fade in active">
      <h3>Employee Login History</h3>
       <button class="btn btn-danger" ng-click="DeleteLoginHistory()" >Delete Histories</button></td>
      
    <table class="table table-striped table-responsive" style="width: 80%">
            <tr>
                <th>SN</th>
                <th>Email</th>            
                <th>IP </th>
                <th>Date </th>
            </tr>
            <tr ng-repeat="H in AllHistory">
                <td>{{$index + 1}} </td>
                <td>{{H.Email}} </td>
                <td>{{H.IP}} </td>
                <td>{{H.Date}} </td>
               
                    <!--<button class="btn btn-warning" data-toggle="modal" data-target="#myModal" ng-click="Edit(Batch)" >Edit</button>-->
                    <!--<button class="btn btn-danger" ng-click="DeleteBatch(Batch.BId)" >Delete</button></td>-->
            </tr>
        </table>

   
    </div>
      <!--tab 2-->
    <div id="Student" class="tab-pane fade">
      <h3>Student Login History</h3>
       <button class="btn btn-danger" ng-click="DeleteStudentLoginHistory()" >Delete Student Histories</button></td>
     
        <table class="table table-striped table-responsive" style="width: 80%">
            <tr>
                <th>SN</th>                         
                <th>Name </th>
                <th>Reg No</th>   
                <th>Faculty </th>
                <th>Session </th>
                <th>IP </th>
                <th>Date </th>
            </tr>
            <tr ng-repeat="S in AllStudentHistory">
                <td>{{$index + 1}} </td>
                 <td>{{S.Name}} </td>
                <td>{{S.RegNo}} </td>
                 <td>{{S.Faculty}} </td>
                 <td>{{S.Session}} </td>
                <td>{{S.IP}} </td>
                <td>{{S.Date}} </td>
               
                    <!--<button class="btn btn-warning" data-toggle="modal" data-target="#myModal" ng-click="Edit(Batch)" >Edit</button>-->
                    <!--<button class="btn btn-danger" ng-click="DeleteBatch(Batch.BId)" >Delete</button></td>-->
            </tr>
        </table>

   
    </div>
  
  </div>
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
                GetAllHistory();

            }
            function initialize() {
                $scope.AllHistory = [];
                $scope.AllStudentHistory=[];
              $scope.DeleteLoginHistory=DeleteLoginHistory;
              $scope.GetStudentHistory=GetStudentHistory;
              $scope.DeleteStudentLoginHistory=DeleteStudentLoginHistory;
            }

            function GetAllHistory()
            {
                $scope.AllHistory = [];
                $http({
                    method: 'GET',
                    url: baseUrl + 'User/GetAllLoginHistory/'
                }).then(function successCallback(response) {
                    $scope.AllHistory = response.data;
                }, function errorCallback(response) {
                });
            }
            
            function GetStudentHistory()
            {
                $scope.AllStudentHistory = [];
                $http({
                    method: 'GET',
                    url: baseUrl + 'User/GetStudentLoginHistory/'
                }).then(function successCallback(response) {
                    $scope.AllStudentHistory = response.data;
                }, function errorCallback(response) {
                });
            }
            
            function DeleteLoginHistory()
            {              
                var r = confirm("Do you want to Delete!");
                if (r == true) {
                    $http({
                        method: 'GET',
                        url: baseUrl + 'User/DeleteLoginHistory/' 
                    }).then(function successCallback(response) {
                        swal("History!", "Deleted Successfully!!");
                        GetAllHistory();
                    }, function errorCallback(response) {
                        swal("History!", "Not Deleted!!!!");
                    });

                }
            }
            function DeleteStudentLoginHistory()
            {              
                var r = confirm("Do you want to Delete!");
                if (r == true) {
                    $http({
                        method: 'GET',
                        url: baseUrl + 'User/DeleteStudentLoginHistory/' 
                    }).then(function successCallback(response) {
                        swal("History!", "Deleted Successfully!!");
                        GetAllHistory();
                    }, function errorCallback(response) {
                        swal("History!", "Not Deleted!!!!");
                    });

                }
            }
          
        }]);
</script>