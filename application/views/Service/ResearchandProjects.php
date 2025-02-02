
<div ng-controller="ResearchCtrl" class="col-md-10" style="background-color: #ffffff;">

    <div class="col-md-12">
        <h2>Research and Projects</h2>

        <?php
        if (isset($_SESSION['success'])) {
            echo "<div class='alert alert-success'>" . $_SESSION['success'] . "</div>";
        }
        ?>

        <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>

        <button type="button"  class="btn btn-info pull-left" data-toggle="modal" data-target="#myModal">Add Item</button> 

    </div>
    <!--List of Project and Research -->
    <div class="row">
        <div class="col-sm-2 pull-left">
            <label></label>
            <select ng-model="data_limit" class="form-control">
                <option>10</option>
                <option>20</option>
                <option>50</option>
                <option>100</option>
            </select>
        </div>
        <div class="col-sm-6 pull-right">
            <label>Search:</label>
            <input type="text" ng-model="search" ng-change="filter()" placeholder="Search" class="form-control" />
        </div>
    </div>
    <div class="col-md-12">

        <table  class="table table-striped table-bordered" >
            <thead>
                <tr>
                    <th>SN </th>
                    <th>Headline &nbsp;<a ng-click="sort_with('Headline');"><i class="glyphicon glyphicon-sort"></i></a> </th>
                    <th>Detail &nbsp;<a ng-click="sort_with('Detail');"><i class="glyphicon glyphicon-sort"></i></a></th>
                    <th>Link </th>
                    <th>Type &nbsp;<a ng-click="sort_with('Type');"><i class="glyphicon glyphicon-sort"></i></a></th>
                    <th>Name </th>
                    <th>StudentId &nbsp;<a ng-click="sort_with('StudentId');"><i class="glyphicon glyphicon-sort"></i></a></th>
                    <th>Action </th>
                </tr>
            </thead>
            <tbody>
                <tr ng-repeat="News in searched = (AllNews| filter:search | orderBy : base :reverse) | beginning_data:(current_grid - 1) * data_limit | limitTo:data_limit">
                    <td>{{$index + 1}} </td>
                    <td>{{News.Headline}} </td>

                    <td>{{News.Detail}} </td>
                    <td><a href="{{News.Link}}">Link</a> </td>
                    <td>{{News.Type}} </td>
                    <td>{{News.Name}} </td>
                    <td>{{News.StudentId}} </td>
                    <td><button class="btn btn-danger" ng-click="DeleteNews(News.RId)" >Delete</button></td>
                </tr>
            </tbody>

        </table>

    </div>

    <!-- Add Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" >
        <div class="modal-dialog" role="document" style="width:950px;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Research and Projects Info</h4>
                </div>
                <div class="modal-body">

                    <form name="SOSSearchForm" ng-submit="SearchStudent()" />
                    <div class="row">               
                        <div class="col-md-6 form-group">

                            <div class="input-group">
                                <input type="text" class="form-control" ng-model="Research.StudentId"  name="StudentID"  id="StudentID" required placeholder="Search">
                                <div class="input-group-btn">
                                    <button class="btn btn-default" type="submit">
                                        <i class="glyphicon glyphicon-search"></i>
                                    </button>
                                </div>
                            </div> 

                        </div>
                    </div>
                    </form>
                    <div class="row">
                        <div class="col-md-4 form-group">
                            <label for="StudentId" >Name</label>
                            <input class="form-control" ng-model="SOS2.FullName"  name="FullName"  id="FullName" readonly/>
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="StudentId" >Faculty</label>
                            <input class="form-control" ng-model="SOS2.FacultyName"  name="Faculty"  id="Faculty" readonly/>
                        </div>
                        <div class=" col-md-4 form-group">
                            <label for="StudentId" >Session</label>
                            <input class="form-control" ng-model="SOS2.SessionName"  name="Session"  id="Session" readonly/>
                        </div>
                    </div>

                    <form name="ResearchForm" ng-submit="AddResearch()" />
                    <div class="form-group">
                        <label for="Headline" >Headline</label>
                        <input class="form-control" ng-model="Research.Headline"  name="Headline"  id="Headline" required/>
                    </div>
                    <div class="form-group">
                        <label for="Detail">Detail</label>
                        <textarea class="form-control" ng-model="Research.Detail" name="Detail" id="Detail required">

                        </textarea>
                    </div>
                    <div class="form-group">
                        <label for="Link" >Link</label>
                        <input class="form-control" ng-model="Research.Link"  name="Link"/>
                    </div>
           
                    <div class="form-group">
                        <label for="Detail">Type</label>
                        <select name="Type" ng-model="Research.Type" class="form-control" required>
                            <option selected="selected" value="Project"> Project</option>
                            <option value="Research"> Research </option>

                        </select>
                    </div>      
                    <div class="form-group">

                        <button type="Submit" class="btn-info" name="Create" id="Create">Create</button>
                    </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                </div>
            </div>
        </div>
    </div>
    <!--modal end-->

</div>
 </div>
</body>
</html>

<script type="text/javascript">

    app.controller("ResearchCtrl", ["$scope", "$http",
        function ($scope, $http) {
            init();
            function init() {
                initialize();
                GetAllRearchProjects();

            }
            function initialize() {
                $scope.AllNews = [];
                $scope.News = {};
                $scope.DeleteNews = DeleteNews;
                $scope.AddResearch = AddResearch;
                $scope.Research = {};
                $scope.SearchStudent = SearchStudent;
                $scope.SOS2 = {};
            }

            function SearchStudent()
            {
                $scope.SOS2 = {};

                $http({
                    method: 'GET',
                    url: baseUrl + 'Service/SearchStudent/' + $scope.Research.StudentId
                }).then(function successCallback(response) {
                    $scope.SOS2 = response.data;
                }, function errorCallback(response) {
                });
            }
            function GetAllRearchProjects() {
                $scope.AllNews = [];

                $http({
                    method: 'GET',
                    url: baseUrl + 'Service/GetAllRearchProjects/'
                }).then(function successCallback(response) {
                    $scope.AllNews = response.data;
                    $scope.current_grid = 1;
                    $scope.data_limit = 10;
                    $scope.filter_data = $scope.Students.length;
                    $scope.entire_user = $scope.Students.length;

                }, function errorCallback(response) {
                });
            }


            //this is for datatable
            $scope.page_position = function (page_number) {
                $scope.current_grid = page_number;
            };
            $scope.filter = function () {
                $timeout(function () {
                    $scope.filter_data = $scope.searched.length;
                }, 20);
            };
            $scope.sort_with = function (base) {
                $scope.base = base;
                $scope.reverse = !$scope.reverse;
            };
            function GetSingleStudentFromList(x)
            {
                angular.forEach($scope.Students, function (User) {
                    if (User.StudentID == x)
                    {
                        $scope.Student = User;
//                        $scope.studentInfo = User;
                    }
                });
            }


            function DeleteNews(id)
            {
                var BrId = id;

                var r = confirm("Do you want to Delete!");
                if (r == true) {
                    $http({
                        method: 'GET',
                        url: baseUrl + 'Service/DeleteResearch/' + BrId
                    }).then(function successCallback(response) {
                        GetAllRearchProjects();
                        alert("Deleted Successfully!!");
                    }, function errorCallback(response) {
                        alert("Not Deleted!!!!");
                    });

                }
            }

            function AddResearch()
            {
                $scope.Research.Name=$scope.SOS2.FullName
                $http({
                    method: 'POST',
                    url: baseUrl + 'Service/AddResearch',
                    headers: {'Content-Type': 'application/json'},
                    data: JSON.stringify($scope.Research)
                }).success(function (data) {
                    console.log(data);
                    GetAllRearchProjects();
                    alert("Successfully added");
                    $scope.Research = {};
                });
            }


        }]);
</script>