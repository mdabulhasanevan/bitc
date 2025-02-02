
<div ng-controller="DefaultCtrl" class="col-md-10" style="background-color: #ffffff;">

    <div class="col-md-12">
        <h2>Promotion List Info</h2>

        <?php
        if (isset($_SESSION['success'])) {
            echo "<div class='alert alert-success'>" . $_SESSION['success'] . "</div>";
        }
        ?>

        <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>

        <button type="button"  class="btn btn-info pull-left" data-toggle="modal" data-target="#myModal">Add PromotionList</button> 

    </div>
    <!--List of PromotionList-->
    <br>
    <div class="col-md-12">
        <table class="table table-striped">
            <tr>
                <th>SN</th>
                <th>Faculty </th> 
                <th>Session </th>
                <th>Syllabus </th>
                <th>Year </th>
                <th>Semester </th>
                <th>Exam Year </th>
                <th>PassedYear </th>
                <th>ExamCompletedFromTo </th>
                <th>VivaProjectDefence </th>
                <th>ResultPublished </th>
                <th>Action </th>
            </tr>
            <tr ng-repeat="PromotionList in AllPromotionList">
                <td>{{$index + 1}} </td>
                <td>{{PromotionList.Faculty}} </td>
                <td>{{PromotionList.Session}} </td>
                <td>{{PromotionList.Syllabus}} </td>
                <td>{{PromotionList.Year}} </td>
                <td>{{PromotionList.Semester}} </td>
                <td>{{PromotionList.ExamYear}} </td>
                <td>{{PromotionList.PassedYear}} </td>
                <td>{{PromotionList.ExamCompletedFromTo}} </td>
                <td>{{PromotionList.VivaProjectDefence}} </td>
                <td>{{PromotionList.ResultPublished}} </td>
                <td>
                    <button class="btn btn-warning" data-toggle="modal" data-target="#myModal" ng-click="Edit(PromotionList)" >Edit</button>
                    <button class="btn btn-danger" ng-click="DeletePromotionList(PromotionList.ID)" >Delete</button></td>
            </tr>
        </table>

    </div>

    <!-- Add Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" >
        <div class="modal-dialog" role="document" style="width:950px;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" ng-click="reset()" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Add PromotionList</h4>
                </div>
                <div class="modal-body">
                    <form name="SOSForm" ng-submit="AddPromotionList()" />                   
                    <div class="form-group">
                        <label for="Exam" >Faculty</label>
                        <select class="form-control"   ng-model="PromotionList.FacultyID"  name="Faculty" ng-options="studentInfo.FId as studentInfo.Name for studentInfo in CommonFeilds.faculty">
                            <option value="">Choose Option</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="Exam" >Session</label>
                        <select class="form-control"  ng-model="PromotionList.SessionID"  name="session" ng-options="studentInfo.SessionId as studentInfo.Session for studentInfo in CommonFeilds.session">
                            <option value="">Choose Option</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="Exam" >Syllabus</label>
                        <select class="form-control"  ng-model="PromotionList.Syllabus"  name="Syllabus" >
                            <option value="1">1 </option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="Exam" >Year</label>
                        <select class="form-control"  ng-model="PromotionList.YearID"  name="session" ng-options="studentInfo.ID as studentInfo.Year for studentInfo in CommonFeilds.semesterYear">
                            <option value="">Choose Option</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="Exam" >Semester</label>
                        <select class="form-control"  ng-model="PromotionList.SemesterID"  name="session" ng-options="studentInfo.ID as studentInfo.Name for studentInfo in CommonFeilds.semester | filter:{Faculty: PromotionList.FacultyID}">
                            <option value="">Choose Option</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="Exam" >Exam Year</label>
                        <input type="text" class="form-control"  ng-model="PromotionList.ExamYear"  name="ExamYear" >

                    </div>

                    <div class="form-group">
                        <label for="Exam" >Passed Year</label>
                        <input type="text" class="form-control"  ng-model="PromotionList.PassedYear"  name="PassedYear" >
                    </div>


                    <div class="form-group">
                        <label for="Exam" >ExamCompletedFromTo</label>
                        <input type="text" class="form-control"  ng-model="PromotionList.ExamCompletedFromTo"  name="ExamYear" >

                    </div>
                    <div class="form-group">
                        <label for="Exam" >VivaProjectDefence</label>
                        <input type="text" class="form-control"  ng-model="PromotionList.VivaProjectDefence"  name="ExamYear" >

                    </div>

                    <div class="form-group">
                        <label for="Exam" >ResultPublished</label>
                        <input type="text" class="form-control"  ng-model="PromotionList.ResultPublished"  name="PassedYear" >
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
                GetAllPromotionList();
                GetAllCommonField();

            }

            function initialize() {
                $scope.AllPromotionList = [];
                $scope.DeletePromotionList = DeletePromotionList;
                $scope.AddPromotionList = AddPromotionList;
                $scope.PromotionList = {};
                $scope.Edit = Edit;
                $scope.reset = reset;

            }

            function GetAllPromotionList()
            {
                $scope.AllPromotionList = [];
                $http({
                    method: 'GET',
                    url: baseUrl + 'Setting/GetAllPromotionList/'
                }).then(function successCallback(response) {
                    $scope.AllPromotionList = response.data;
                }, function errorCallback(response) {
                });
            }

            function DeletePromotionList(id)
            {
                var SId = id;

                var r = confirm("Do you want to Delete!");
                if (r == true) {
                    $http({
                        method: 'GET',
                        url: baseUrl + 'Setting/DeletePromotionList/' + SId
                    }).then(function successCallback(response) {
                        swal("PromotionList!", "Deleted Successfully!!");
                        GetAllPromotionList();
                    }, function errorCallback(response) {
                        swal("PromotionList!", "Not Deleted!!!!");
                    });

                }
            }

            function AddPromotionList()
            {
                console.log($scope.PromotionList);
                //update
                if ($scope.PromotionList.ID > 0)
                {
                    $http({
                        method: 'POST',
                        url: baseUrl + 'Setting/UpdatePromotionList/',
                        headers: {'Content-Type': 'application/json'},
                        data: JSON.stringify($scope.PromotionList)
                    }).success(function (data) {
                        console.log(data);
                        GetAllPromotionList();
                        $scope.PromotionList = {};
                        $('#myModal').modal('toggle');
                        swal("Successfully Updated", "PromotionList");

                    });
                }
                else {
                    //add
                    $http({
                        method: 'POST',
                        url: baseUrl + 'Setting/AddPromotionList/',
                        headers: {'Content-Type': 'application/json'},
                        data: JSON.stringify($scope.PromotionList)
                    }).success(function (data) {
                        console.log(data);
                        GetAllPromotionList();
                        $('#myModal').modal('toggle');
                        swal("Successfully added", "PromotionList");
                        $scope.PromotionList = {};
                    });
                }
            }

            function Edit(PromotionList)
            {

                $scope.PromotionList = {};
                $scope.PromotionList = PromotionList;
            }

            function reset()
            {
                $scope.PromotionList = {};
            }

            function GetAllCommonField() {
                $scope.CommonFeilds = [];
                $http({
                    method: 'GET',
                    url: baseUrl + 'Student/GetAllCommonField/'
                }).then(function successCallback(response) {
                    $scope.CommonFeilds = response.data;

                }, function errorCallback(response) {

                });
            }

        }]);
</script>