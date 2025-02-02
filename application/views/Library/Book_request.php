
<div ng-controller="DefaultCtrl" class="col-md-10" style="background-color: #ffffff;">

    <div class="col-md-12">
        <h2>Requested Book Info</h2>

        <?php
        if (isset($_SESSION['success'])) {
            echo "<div class='alert alert-success'>" . $_SESSION['success'] . "</div>";
        }
        ?>

        <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>


    </div>
    <!--List of Book-->
    <br>
    <div class="col-md-12">

        <ul class="nav nav-tabs">                  
            <li class="active"><a data-toggle="tab" href="#Request" ng-click="GetRequestedAllBook();" >Request List</a></li>
            <li><a data-toggle="tab" href="#Received" ng-click="GetDeliveredAllBook();">Delivered Book</a></li>
            <li><a data-toggle="tab" href="#Cancel" ng-click="GetReturnedAllBook();">Return List</a></li>
        </ul>

        <div class="tab-content">

            <div id="Request" class="tab-pane fade in active">
                <h3>Requested Book</h3>
                <table class="table table-striped">
                    <tr>
                        <th>Name-Reg  </th> 

                        <th>Book Name  </th> 
                        <th>Addition </th>   
                        <th> Medium </th> 
                        <th>Category </th> 
                        <th>Date </th> 
                        <th>Available </th> 
                        <th>Action </th>
                    </tr>
                    <tr ng-repeat="Book3 in AllRequestedBook">                        
                        <td>{{Book3.FullName}}-{{Book3.RegNo}} </td>
                        <td><span>{{Book3.BookName}} </span> - 
                            <span style="font-size: 12px; color: #419641;">  {{Book3.Description}}</span>
                            <br>(<span style="color: crimson; font-size: 11px;"> {{Book3.Writer}}</span>) 
                        </td>
                        <td>{{Book3.Addition}} </td>

                        <td>{{Book3.BookMedium}} </td>
                        <td>{{Book3.BookCategory}} </td>
                        <td>{{Book3.RequestDate}} </td>
                        <td>{{Book3.Available}} </td>

                        <td>
                            <button class="btn-small"   ng-click="CalcelRequestForBook(Book3.RId)" >Cancel</button>
                            <button class="btn-small"   ng-click="AcceptRequestForBook(Book3.RId)" >Accept and Deliver</button>
                        </td>
                    </tr>
                </table>
            </div>
            <div id="Received" class="tab-pane fade">
                <h3>Delivered Book</h3>
                <table class="table table-striped">
                    <tr>
                        <th>Name-Reg  </th> 
                        <th>Mobile  </th> 
                        <th>Book Name  </th> 
                        <th>Addition </th>   
                        <th> Medium </th> 
                        <th>Category </th> 
                        <th>Date </th> 
                        <th>Return Date </th> 
                        <th>Action </th>
                    </tr>
                    <tr ng-repeat="Book1 in AllDelivereddBook">                        
                        <td>{{Book1.FullName}}-{{Book1.RegNo}} </td>
                        <td>{{Book1.SMSNotificationNo}}</td>
                        <td><span>{{Book1.BookName}} </span> - 
                            <span style="font-size: 12px; color: #419641;">  {{Book1.Description}}</span>
                            <br>(<span style="color: crimson; font-size: 11px;"> {{Book1.Writer}}</span>) 
                        </td>
                        <td>{{Book1.Addition}} </td>

                        <td>{{Book1.BookMedium}} </td>
                        <td>{{Book1.BookCategory}} </td>
                        <td>{{Book1.DeliveredDate}} </td>
                    <span ng-show="Book1.IsOver == 1" style="color: red; font-weight: bolder;">{{Book1.ReturnDate}}</span> 
                    <span ng-show="Book1.IsOver == 0" >{{Book1.ReturnDate}}</span> 

                    <td>
                        <!--<button class="btn-small"   ng-click="CalcelRequestForBook(Book3.RId)" >Cancel</button>-->
                        <button class="btn-small"   ng-click="ReturnBook(Book1.RId)" >Return Book</button>
                    </td>
                    </tr>
                </table>
            </div>
            <div id="Cancel" class="tab-pane fade">
                <h3>Return List</h3>
                <table class="table table-striped">
                    <tr>
                        <th>Name-Reg  </th> 
                        <th>Book Name  </th> 
                        <th>Addition </th>   
                        <th> Medium </th> 
                        <th>Category </th> 
                        <th>Delivered Date </th> 
                        <th>Return Date </th> 
                        <!--<th>Action </th>-->
                    </tr>
                    <tr ng-repeat="Book2 in AllReturnedBook">                        
                        <td>{{Book2.FullName}}-{{Book2.RegNo}} </td>
                        <td><span>{{Book2.BookName}} </span> - 
                            <span style="font-size: 12px; color: #419641;">  {{Book2.Description}}</span>
                            <br>(<span style="color: crimson; font-size: 11px;"> {{Book2.Writer}}</span>) 
                        </td>
                        <td>{{Book2.Addition}} </td>
                        <td>{{Book2.BookMedium}} </td>
                        <td>{{Book2.BookCategory}} </td>                      
                        <td>{{Book2.DeliveredDate}} </td>
                        <td>{{Book2.ReturnDate}} </td>

<!--                        <td>
                            <button class="btn-small"   ng-click="CalcelRequestForBook(Book3.RId)" >Cancel</button>
                            <button class="btn-small"   ng-click="ReturnBook(Book1.RId)" >Return Book</button>
                        </td>-->
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
                GetRequestedAllBook();

            }
            function initialize() {
                $scope.GetRequestedAllBook = GetRequestedAllBook;
                $scope.CalcelRequestForBook = CalcelRequestForBook;
                $scope.AcceptRequestForBook = AcceptRequestForBook;
                $scope.GetDeliveredAllBook = GetDeliveredAllBook;
                $scope.GetReturnedAllBook = GetReturnedAllBook;
                $scope.ReturnBook = ReturnBook;
                $scope.AllRequestedBook = [];
                $scope.AllDelivereddBook = [];
                $scope.AllReturnedBook = [];
            }

            function GetRequestedAllBook()
            {
                $scope.AllRequestedBook = [];
                $http({
                    method: 'GET',
                    url: baseUrl + 'BookLibrary/GetRequestedAllBook/'
                }).then(function successCallback(response) {
                    $scope.AllRequestedBook = response.data;

                }, function errorCallback(response) {
                });
            }

            function GetDeliveredAllBook()
            {
                $scope.AllDelivereddBook = [];
                $http({
                    method: 'GET',
                    url: baseUrl + 'BookLibrary/GetDeliveredAllBook/'
                }).then(function successCallback(response) {
                    $scope.AllDelivereddBook = response.data;

                }, function errorCallback(response) {
                });
            }

            function GetReturnedAllBook()
            {
                $scope.AllDelivereddBook = [];
                $http({
                    method: 'GET',
                    url: baseUrl + 'BookLibrary/GetReturnedAllBook/'
                }).then(function successCallback(response) {
                    $scope.AllReturnedBook = response.data;

                }, function errorCallback(response) {
                });
            }

            function ReturnBook(RId)
            {
                var r = confirm("want to Return this Book??");
                if (r)
                {
                    $http({
                        method: 'GET',
                        url: baseUrl + 'BookLibrary/ReturnBook/' + RId
                    }).then(function successCallback(response) {
                        if (response.data == 1)
                        {
                            GetDeliveredAllBook();
                            swal("Book Returned Successfully", "Book");
                        }
                        else {
                            swal("Not returned Successful ", "Book");
                        }
                    }, function errorCallback(response) {
                    });
                }
            }
            function AcceptRequestForBook(RId)
            {
                var r = confirm("Are you sure want to Deliver this Book??");
                if (r)
                {
                    $http({
                        method: 'GET',
                        url: baseUrl + 'BookLibrary/AcceptRequestForBook/' + RId
                    }).then(function successCallback(response) {
                        if (response.data == 1)
                        {
                            GetRequestedAllBook();
                            swal("Book Delivered Successfully", "Book");
                        }
                        else {
                            swal("Not Successful May be Book Not Available", "Book");
                        }
                    }, function errorCallback(response) {
                    });
                }

            }

            function CalcelRequestForBook(RId)
            {
                var r = confirm("Are you sure want to cancel??");
                if (r)
                {
                    $http({
                        method: 'GET',
                        url: baseUrl + 'BookLibrary/CalcelRequestForBook/' + RId
                    }).then(function successCallback(response) {
                        GetRequestedAllBook();
                        swal("Request Deleted", "Book");
                    }, function errorCallback(response) {
                    });
                }

            }

        }
    ]);
</script>