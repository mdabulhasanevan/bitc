<div ng-controller="AttendanceCtrl" class="col-md-10" style="background-color: #ffffff;">
    <hr>
    <form name="PayReportForm" ng-submit="SearchAllPayHistory()" />
    <div class="row">

        <div class="col-md-4">
            <div class="form-group" ng-class="">
                <label class="col-md-5 control-label">
                    From Date 
                </label>
                <div class="col-md-7">
                    <input type="text" ng-model="PayReport.Date" required id="datepicker" autocomplete="off" size="30" class="form-control" />                 
                </div>
            </div> 
        </div>
        <div class="col-md-4">
            <div class="form-group" >
                <label class="col-md-5 control-label">
                    To Date 
                </label>
                <div class="col-md-7">
                    <input type="text" ng-model="PayReport.Date2" required id="datepicker2" autocomplete="off" size="30" class="form-control" />                 
                </div>
            </div> 
        </div>
        <div class="col-md-4 pull-right ">
            <div class="form-group">

                <button type="Submit" class="btn btn-info glyphicon glyphicon-filter form-control " name="Create" id="Create">Search</button>

            </div> 
        </div>

    </div>


</form>

<div  class="row" >
    <center><button id='print' style='margin-top: 10px; padding: 10px; border: none; text-align: center; background: black; border-radius: 4px; color: #fff; font-weight: bold; cursor: pointer;'>PRINT </button></center>

    <div class="col-md-12 print_History_div">
        <h3 style="text-align: center;"> Payment Received Report <br> <span style="font-size: 12px;">{{PayReport.Date}} To {{PayReport.Date2}}</span> </h3> 
       
        <table class="table table-striped">
            <tr>
                <th>SN</th>
                <th>Date </th> 
                 <th>Name </th> 
                  <th>RegNo </th> 
                <th>PayType </th>  
                <th>SemesterName </th>  
                <th>Month </th>  
                <th>Paid </th>  
                <th>Comment </th>
            </tr>
            <tr ng-repeat="H in AllPayHistory">
                <td>{{$index + 1}} </td>
                <td>{{H.Date}} </td>
                 <td>{{H.FullName}} </td>
                  <td>{{H.RegNo}} </td>
                <td>{{H.PayType}} </td>
                <td>{{H.SemesterName}} </td>
                <td>{{H.Month}} </td>
                <td>{{H.PaymentValue}} </td>
                <td>{{H.Comment}} </td>

            </tr>
            <tr>
                <th></th>
                <th> </th> 
                 <th> </th> 
                  <th> </th> 
                <th> </th>  
                <th> </th>  
                <th> Total Collect:</th>  
                <th> {{PayReport.Total}} </th>  
                <th> </th>
            </tr>
        </table>
        
    </div>
</div>



</div>

</body>
</html>



<script>
 <!--print html--> 
 // here we will write our custom code for printing our div
        $(function(){
            $('#print').on('click', function() {
                //Print ele2 with default options
                $.print(".print_History_div");
            });
        });
        
    app.controller("AttendanceCtrl", ["$scope", "$http",
        function ($scope, $http) {
            init();
            function init() {
                initialize();

                LoadAllFields();
            }
            function initialize() {
                $scope.AllPayHistory = [];
                $scope.PayReport = {};
                $scope.PayReport.Total=0;
            }

            $scope.SearchAllPayHistory = function SearchAllPayHistory()
            {
                console.log($scope.PayReport);
                $scope.AllPayHistory = [];


                $http({
                    method: 'POST',
                    url: baseUrl + 'Payment/SearchAllPayHistory/',
                    headers: {'Content-Type': 'application/json'},
                    data: JSON.stringify($scope.PayReport)
                }).success(function (data) {
                    console.log(data);
                      $scope.AllPayHistory = data.History;
                      $scope.PayReport.Total=data.Total.TotalAmount;
                  
                    console.log($scope.PayReport.Total);
                  

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


        }]);
</script>    
