<div ng-controller="AttendanceCtrl" class="col-md-10" style="background-color: #ffffff;">

    <div  class="row" >
        <center><button id='print' style='margin-top: 10px; padding: 10px; border: none; text-align: center; background: black; border-radius: 4px; color: #fff; font-weight: bold; cursor: pointer;'>PRINT </button></center>

        <div class="col-md-12 print_History_div">
            <h3 style="text-align: center;">Faculty and Session wise Due Report <br> <?php echo date("d-m-Y"); ?></h3> 
            <table class="table table-striped">
                <tr>
                    <th>SN</th>
                    <th>Faculty </th> 
                    <th>Session </th> 
                    <th>Due Money </th> 
                    <th>Due Month </th>  
                    <th>Deposit </th>  

                </tr>
                <tr ng-repeat="H in AllPayHistory.All">
                    <td>{{$index + 1}} </td>
                    <td>{{H.FacultyName}} </td>
                    <td>{{H.SessionName}} </td>
                    <td>{{H.TotalDueMoney}} </td>
                    <td>{{H.TotalDueMonth}} </td>
                    <td>{{H.TotalDeposit}} </td>
                </tr>
                 <tr>
                    <td> </td>
                    <td></td>
                    <th> Total</th>
                    <th>{{AllPayHistory.Total.TotalDueMoney}} </th>
                    <th>{{AllPayHistory.Total.TotalDueMonth}} </th>
                    <th>{{AllPayHistory.Total.TotalDeposit}} </th>
                </tr>

            </table>

        </div>
    </div>



</div>

</body>
</html>



<script>
//    < !--print html-- >
            // here we will write our custom code for printing our div
            $(function () {
                $('#print').on('click', function () {
                    //Print ele2 with default options
                    $.print(".print_History_div");
                });
            });

    app.controller("AttendanceCtrl", ["$scope", "$http",
        function ($scope, $http) {
            init();
            function init() {
                initialize();
                SearchAllPayHistory();
            }
            function initialize() {
                $scope.AllPayHistory = [];
                $scope.PayReport = {};
                $scope.PayReport.Total = 0;
                $scope.SearchAllPayHistory = SearchAllPayHistory;
            }

            function SearchAllPayHistory()
            {
                console.log($scope.PayReport);
                $scope.AllPayHistory = [];
                $http({
                    method: 'GET',
                    url: baseUrl + 'Payment/GetFacultySessionWiseDue/',
                }).success(function (data) {

                    $scope.AllPayHistory = data;
                    //$scope.PayReport.Total = data.Total.TotalAmount;
                });
            }



        }]);
</script>    
