
<div ng-controller="DefaultCtrl" class="col-md-10" style="background-color: #ffffff;">

    <div class="col-md-12">
        <h2>Deleted Payment Info</h2>

        <?php
        if (isset($_SESSION['success'])) {
            echo "<div class='alert alert-success'>" . $_SESSION['success'] . "</div>";
        }
        ?>

        <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>

     
    </div>
    <!--List of Deleted-->
    <br>
    <div class="col-md-12">
        <table class="table table-striped">
            <tr>
                <th>SN</th>
                <th>Transaction ID </th>  
                <th>Name </th>   
                <th>Faculty Session </th> 
                <th>Type </th>  
                <th>Month </th>   
                <th>Paid </th>  
                <th>Received by </th>
                <th> Date </th>
                <th>Deleted by </th>
                <th> Date </th>  
                <th>Comment </th>   
<!--
                <th>Action </th>-->
            </tr>
            <tr ng-repeat="Deleted in AllDeleted">
                <td>{{Deleted.DeletedID}} </td>
                  <td>{{Deleted.TransactionID}} </td>
                <td>{{Deleted.FullName}} </td>
                <td>{{Deleted.Faculty}}-{{Deleted.Session}} </td>
                <td>{{Deleted.TypeName}} </td>
                <td>{{Deleted.MonthName}} </td>
                <td>{{Deleted.PaidAmount}} </td>
                <td>{{Deleted.ReceivedBy}} </td>
                <td>{{Deleted.Date}} </td>
                <td>{{Deleted.DeletedBy}} </td>
                
                <td>{{Deleted.DeletedDate}} </td>
                 <td>{{Deleted.Comment}} </td>
<!--                <td>
                    <button class="btn btn-danger" ng-click="DeleteDeleted(Deleted.BId)" >Delete</button></td>-->
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
                DeletedPaymentList();

            }
            function initialize() {
                $scope.AllDeleted = [];
                $scope.DeletedPaymentList = DeletedPaymentList;
              
            
            }

            function DeletedPaymentList()
            {
                $scope.AllDeleted = [];
                $http({
                    method: 'GET',
                    url: baseUrl + 'Payment/DeletedPaymentList/'
                }).then(function successCallback(response) {
                    $scope.AllDeleted = response.data;
                }, function errorCallback(response) {
                });
            }

           

        

        }]);
</script>