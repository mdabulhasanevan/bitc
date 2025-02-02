
<div ng-controller="DefaultCtrl" class="col-md-10" style="background-color: #ffffff;">

    <div class="col-md-12">
        <h2>Book Info</h2>

        <?php
        if (isset($_SESSION['success'])) {
            echo "<div class='alert alert-success'>" . $_SESSION['success'] . "</div>";
        }
        ?>

        <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>

        <button type="button"  class="btn btn-info pull-left" data-toggle="modal" data-target="#myModal">Add Book</button> 

    </div>
    <!--List of Book-->
    <br>
    <div class="col-md-12">
        <table class="table table-striped">
            <tr>
                <th>SN</th>
                <th>Book Name </th> 
                <th>Description </th> 
                <th>Writer </th> 
                <th>Addition </th> 
                <th>Quantity </th> 
                <th>Available </th> 
                <th> Medium </th> 
                <th>Category </th> 
                <th>Action </th>
            </tr>
            <tr ng-repeat="Book2 in AllBook">
                <td>{{$index + 1}} </td>
                <td>{{Book2.BookName}} </td>
                <td>{{Book2.Description}} </td>
                <td>{{Book2.Writer}} </td>
                <td>{{Book2.Addition}} </td>
                <td>{{Book2.Quantity}} </td>
                <td>{{Book2.Available}} </td>
                <td>{{Book2.BookMedium}} </td>
                <td>{{Book2.BookCategory}} </td>

                <td>
                    <button class="btn btn-warning" data-toggle="modal" data-target="#myModal" ng-click="Edit(Book2)" >Edit</button>
                    <button class="btn btn-danger" ng-click="DeleteBook(Book2.BId)" >Delete</button></td>
            </tr>
        </table>

    </div>

    <!-- Add Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" >
        <div class="modal-dialog" role="document" style="width:950px;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" ng-click="reset()" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Add Book</h4>
                </div>
                <div class="modal-body">
                    <form name="SOSForm" ng-submit="AddBook()" />                   
                    <div class="form-group">
                        <label for="Exam" >Book Name</label>
                        <input class="form-control" ng-model="Book.BookName"  name="Exam"/>
                    </div>
                    <div class="form-group">
                        <label for="Exam" >Description</label>
                        <input class="form-control" ng-model="Book.Description"  name="Exam"/>
                    </div>
                    <div class="form-group">
                        <label for="Exam" >Writer</label>
                        <input class="form-control" ng-model="Book.Writer"  name="Exam"/>
                    </div>
                    <div class="form-group">
                        <label for="Exam" >Addition</label>
                        <input class="form-control" ng-model="Book.Addition"  name="Exam"/>
                    </div>
                    <div class="form-group">
                        <label for="Exam" >Quantity</label>
                        <input class="form-control" ng-model="Book.Quantity"  name="Exam"/>
                    </div>
                    <div class="form-group">
                        <label for="Exam" >Available</label>
                        <input class="form-control" ng-model="Book.Available"  name="Exam"/>
                    </div>

                    <div class="form-group">
                         <label for="Exam" >Medium</label>
                        <select class="form-control"  ng-model="Book.Medium"  ng-options="Medium.Id as Medium.Type for Medium in AllField.BookMedium">
                            <option value="">Choose Option</option>
                        </select>
                    </div>
                     <div class="form-group">
                         <label for="Exam" >Subject</label>
                        <select class="form-control"  ng-model="Book.Subject"  ng-options="Medium.Id as Medium.Name for Medium in AllField.BookCategory">
                            <option value="">Choose Option</option>
                        </select>
                    </div>

                    <div class="form-group">

                        <button type="Submit" class="btn btn-info" name="Create" id="Create">Add</button>
                    </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" ng-click="reset()" class="btn btn-default" data-dismiss="modal">Close</button>

                </div>
            </div>
        </div>
    </div>
    <!--modal end-->

</div>
</body>
</html>

<script type="text/javascript">

    app.controller("DefaultCtrl", ["$scope", "$http",
        function ($scope, $http) {
            init();
            function init() {
                initialize();
                GetAllBook();
                GetAllCommonField();

            }
            function initialize() {
                $scope.AllBook = [];
                $scope.DeleteBook = DeleteBook;
                $scope.AddBook = AddBook;
                $scope.Book = {};
                $scope.Edit = Edit;
                $scope.reset = reset;
                $scope.AllField = [];

            }

            function GetAllCommonField()
            {
                $http({
                    method: 'GET',
                    url: baseUrl + 'BookLibrary/GetAllCommonField/'
                }).then(function successCallback(response) {
                    console.log(response.data);
                    $scope.AllField = response.data;
                }, function errorCallback(response) {

                });
            }

            function GetAllBook()
            {
                $scope.AllBook = [];
                $http({
                    method: 'GET',
                    url: baseUrl + 'BookLibrary/GetAllBookList/'
                }).then(function successCallback(response) {
                    $scope.AllBook = response.data;
                }, function errorCallback(response) {
                });
            }

            function DeleteBook(id)
            {
                var SId = id;

                var r = confirm("Do you want to Delete!");
                if (r == true) {
                    $http({
                        method: 'GET',
                        url: baseUrl + 'BookLibrary/DeleteBookList/' + SId
                    }).then(function successCallback(response) {
                        swal("Book!", "Deleted Successfully!!");
                        GetAllBook();
                    }, function errorCallback(response) {
                        swal("Book!", "Not Deleted!!!!");
                    });

                }
            }

            function AddBook()
            {
                console.log($scope.Book);
                //update
                if ($scope.Book.BId > 0)
                {
                 
                    $http({
                        method: 'POST',
                        url: baseUrl + 'BookLibrary/UpdateBookList/',
                        headers: {'Content-Type': 'application/json'},
                        data: JSON.stringify($scope.Book)
                    }).success(function (data) {
                        console.log(data);
                        GetAllBook();
                        $scope.Book = {};
                        $('#myModal').modal('toggle');
                        swal("Successfully Updated", "Book");

                    });
                }
                else {
                    //add
                    $http({
                        method: 'POST',
                        url: baseUrl + 'BookLibrary/AddBookList/',
                        headers: {'Content-Type': 'application/json'},
                        data: JSON.stringify($scope.Book)
                    }).success(function (data) {
                        //console.log(data);
                        GetAllBook();
                        $('#myModal').modal('toggle');
                        swal("Successfully added", "Book");
                        $scope.Book = {};
                    });
                }
            }

            function Edit(Book)
            {
                $scope.Book = {};
                $scope.Book = Book;
            }

            function reset()
            {
                $scope.Book = {};
            }

        }]);
</script>