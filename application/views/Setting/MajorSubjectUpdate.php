<div ng-controller="MajorCtrl" class="col-md-10" style="background-color: #ffffff;">

    <br>
    <div class="row">
        <form class="form-horizontal" id="frmCommon" ng-submit="GetStudent()"  name="formCommonFeilds" >
            <div class="form-body" >
                <div class="row">
                    <div class="col-md-3">

                        <div class="form-group" ng-class="">
                            <label class="col-md-5 control-label">
                                Batch
                            </label>
                            <div class="col-md-7">
                                <select class="form-control"  ng-model="studentInfo2.Batch"  name="Batch" ng-options="studentInfo.BId as studentInfo.BatchName for studentInfo in CommonFeilds.batch">
                                    <option value="">Choose Option</option>
                                </select>
                                <div class="form-control-focus"> </div>

                            </div>

                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group" ng-class="{
                                    'has-error'
                                            : submitted1 && formCommonFeilds.Faculty.$invalid}">
                            <label class="col-md-5 control-label">
                                Faculty
                            </label>
                            <div class="col-md-7">
                                <select class="form-control"   ng-model="studentInfo2.Faculty"  name="Faculty" ng-options="studentInfo.FId as studentInfo.Name for studentInfo in CommonFeilds.faculty">
                                    <option value="">Choose Option</option>
                                </select>
                                <div class="form-control-focus"> </div>
                                <span ng-show="submitted1 && formCommonFeilds.Faculty.$error.required" class="help-block">Faculty Required</span>
                            </div>

                        </div>

                    </div>
                    <div class="col-md-2">
                        <div class="form-group" ng-class="{
                                    'has-error'
                                            : submitted1 && formCommonFeilds.session.$invalid}">
                            <label class="col-md-5 control-label">
                                Session
                            </label>
                            <div class="col-md-7">
                                <select class="form-control"  ng-model="studentInfo2.SessionId"  name="session" ng-options="studentInfo.SessionId as studentInfo.Session for studentInfo in CommonFeilds.session">
                                    <option value="">Choose Option</option>
                                </select>
                                <div class="form-control-focus"> </div>
                                <span ng-show="submitted1 && formCommonFeilds.session.$error.required" class="help-block">session Required</span>
                            </div>

                        </div>

                    </div>

                    <div class="col-md-3">

                        <div class="form-group" ng-class="{
                                    'has-error'
                                            : submitted1 && formCommonFeilds.StudentInsID.$invalid}">
                            <label class="col-md-5 control-label">
                                StudentID

                            </label>
                            <div class="col-md-7">
                                <input type="text" value="00"  ng-model="studentInfo2.StudentInsID" class="form-control" placeholder="Student ID" name="studentInsID" >

                            </div>

                        </div>


                    </div>

                    <div class="col-md-2">
                        <div class="col-md-2 pull-right">
                            <button type="submit" ng-click="submitted1 = true;" class="btn btn-info pull-right">Search Student</button>
                        </div>
                    </div>



                </div>

            </div>
        </form>
    </div>
    <hr>
    <div class="row">
        <div class="col-sm-2 pull-left">

            <select ng-model="data_limit" class="form-control">
                <option value="">Page Size</option>
                <option>10</option>
                <option>20</option>
                <option>50</option>
                <option>100</option>
            </select>
        </div>
        <div class="col-sm-4">

            <input type="text" ng-model="search" ng-change="filter()" placeholder="Search" class="form-control" />
        </div>

        <div class="col-md-6">
            <select class="form-control"   ng-model="Major"  name="Major" ng-options="studentInfo.ID as studentInfo.Major for studentInfo in CommonFeilds.major">
                <option value="">Choose Option</option>
            </select>

            <button class="btn btn-primary" ng-click="MajorUpdate()">Update</button>
        </div>
    </div>
    <br/>
    <div class="row">
        <table id="usersTable" class="table table-striped">
            <tr>
                <th><input type="checkbox" ng-model="selectedAll" ng-click="checkAll()" /></th>
                <th>Name &nbsp;<a ng-click="sort_with('FullName');"><i class="glyphicon glyphicon-sort"></i></a> </th>
                  <th>Reg No </th>
                <th>StudentID &nbsp;<a ng-click="sort_with('StudentInsID');"><i class="glyphicon glyphicon-sort"></i></a> </th>
                <th>Mobile &nbsp;<a ng-click="sort_with('SMSNotificationNo');"><i class="glyphicon glyphicon-sort"></i></a></th>

                <th> Faculty &nbsp;<a ng-click="sort_with('FacultyName');"><i class="glyphicon glyphicon-sort"></i></a> </th>
                <th> Session &nbsp;<a ng-click="sort_with('SessionName');"><i class="glyphicon glyphicon-sort"></i></a> </th>
                <th> Major &nbsp;<a ng-click="sort_with('Major');"><i class="glyphicon glyphicon-sort"></i></a> </th>


            </tr>
            <tr ng-repeat="User in searched = (Students| filter:search | orderBy : base :reverse) | beginning_data:(current_grid - 1) * data_limit | limitTo:data_limit">
                <td>  <input type="checkbox" ng-model="User.Selected"  ng-true-value="true" ng-false-value="false"/>
                <td>{{User.FullName}} </td>
                <td>{{User.RegNo}} </td>
                <td>{{User.StudentInsID}} </td>
                <td>{{User.SMSNotificationNo}} </td>

                <td> {{User.FacultyName}} </td>
                <td> {{User.SessionName}} </td>
                <td>{{User.MajorName}} </td>


            </tr>
        </table>
        <!--this is showing 4/4 ... number of item-->
        <div class="col-md-12" ng-show="filter_data == 0">
            <div class="col-md-12">
                <h4>No records found..</h4>
            </div>
        </div>
        <!--pagination-->
        <div class="col-md-12">
            <div class="col-md-6 pull-left">
                <h5>Showing {{ searched.length}} of {{ entire_user}} entries</h5>
            </div>
            <div class="col-md-6" ng-show="filter_data > 0">
                <div pagination="" page="current_grid" on-select-page="page_position(page)" boundary-links="true" total-items="filter_data" items-per-page="data_limit" class="pagination-small pull-right" previous-text="&laquo;" next-text="&raquo;"></div>
            </div>
        </div>

    </div>


</div>


</body>
</html>

<script type="text/javascript">

            app.controller("MajorCtrl", ["$scope", "$http",
                    function ($scope, $http) {
                    init();
                            function init() {
                            initialize();
                                    GetAllCommonField();
                            }
                    function initialize() {

                    $scope.MajorUpdate = MajorUpdate;
                            $scope.CheckedUser = [];
                            $scope.MessageUser = '';
                            $scope.MessageStudent = '';
                            $scope.Message = ''; $scope.Balance = '';
                            $scope.Check = [];
//                            For Student
                            $scope.studentInfo2 = {};
                            //                    this is for searching paramiter null
                            $scope.studentInfo2.Faculty = null;
                            //                          $scope.studentInfo.BranchID= 0;
                            $scope.studentInfo2.SessionId = null; $scope.studentInfo2.Batch = null;
                            $scope.studentInfo2.StudentInsID = null;
                            $scope.GetAllCommonField = GetAllCommonField;
                            $scope.GetStudent = GetStudent;
                            $scope.Students = []; }

                    $scope.checkAll = function checkAll(type) {

                    if ($scope.selectedAll) {
                    $scope.selectedAll = true;
                    } else {
                    $scope.selectedAll = false; }

                    angular.forEach($scope.Students, function (User) {
                    User.Selected = $scope.selectedAll;
                    });
                    };
                            //Sending Message from here
                                    function MajorUpdate()
                                    {
                                        $scope.mobiles='';
                                    $scope.Message = $scope.Major;
                                            $scope.Get = $scope.Students;
                                            angular.forEach($scope.Get, function (User) {
                                            if (User.Selected == true)
                                            {
                                            $scope.mobiles = $scope.mobiles + User.StudentID + ',';
                                            }
                                            });
                                            var mobiles = $scope.mobiles;
                                            mobiles = mobiles.replace(/,\s*$/, "");
                                            $scope.mobiles = mobiles;
                                            console.log($scope.mobiles);
                                            console.log($scope.Major);
                                            var r = confirm("Do you want to Update Major Subject!");
                                            if (r == true) {
                                    $http.post(
                                            baseUrl + 'Setting/UpdateMajorList',
                                    {'mobiles':$scope.mobiles, 'message':$scope.Message}
                                    ).success(function(data) {
                                    alert(data);
                                    }).error (function(data){
                                    alert(data);
                                    });
//         
                                    }

                                    }

                            //already send list

                            //                    for student 
                            function GetAllCommonField() {
                            $scope.CommonFeilds = [];
                                    $http({
                                    method: 'GET',
                                            url: baseUrl + 'Student/GetAllCommonField/'
                                    }).then(function successCallback(response) {
                            $scope.CommonFeilds = response.data;
                                    // to geting District and thana different vriable
                                    $scope.preDistrict = $scope.CommonFeilds.district;
                                    $scope.parDistrict = $scope.CommonFeilds.district;
                                    $scope.preThana = $scope.CommonFeilds.thana;
                                    $scope.parThana = $scope.CommonFeilds.thana;
                            }, function errorCallback(response) {

                            });
                            }

                            function GetStudent()
                            {
                            $scope.Students = [];
                                    console.log($scope.studentInfo2);
                                    $http({
                                    method: 'POST',
                                            url: baseUrl + 'Student/GetStudent',
                                            headers: {'Content-Type': 'application/json'},
                                            data: JSON.stringify($scope.studentInfo2)
                                    }).success(function (data) {
                            console.log(data);
                                    $scope.Students = data;
                                    //this is for datatable
                                    $scope.current_grid = 1;
                                    $scope.data_limit = 10;
                                    $scope.filter_data = $scope.Students.length;
                                    $scope.entire_user = $scope.Students.length;
                            })
                            }





                            //this is for datatable
                            $scope.page_position = function(page_number) {
                            $scope.current_grid = page_number;
                            };
                                    $scope.filter = function() {
                                    $timeout(function() {
                                    $scope.filter_data = $scope.searched.length;
                                    }, 20);
                                    };
                                    $scope.sort_with = function(base) {
                                    $scope.base = base;
                                            $scope.reverse = !$scope.reverse;
                                    };
                            }]);
</script>