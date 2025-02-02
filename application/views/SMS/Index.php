<div ng-controller="SMSCtrl" class="col-md-10" style="background-color: #ffffff;">

    <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#home">Academic</a></li>
        <li><a data-toggle="tab" href="#menu1">Student</a></li>
        <li><a data-toggle="tab" href="#menu2">Other</a></li>
        <li><a data-toggle="tab" href="#menu3">Other2</a></li>
        <li class="pull-right"> <h4 class="pull-right btn btn-danger">Balance: {{Balance}} .tk</h4></li>
    </ul>

    <div class="tab-content">
        <div id="home" class="tab-pane fade in active">

            <div class="col-md-4">
                <button type="button" ng-click="GetSendList();" class="btn btn-info pull-left" data-toggle="modal" data-target="#myModal">Send List</button> 
            </div>
            <div class="col-md-4">
                <div class="alert alert-dismissable"><?php echo $smsNoti; ?></div> 
            </div>
            <div class="col-md-4">

            </div>

            <form>

                <div class="col-md-6">
                    <select class="form-control" ng-change="GetAllUser(PostSelected)" ng-options="Post.PId as Post.PostName for Post in Posts" name="AllPost" ng-model="PostSelected" >
                        <option value="">Select..</option>  

                    </select>
                    <textarea class="form-control" ng-model="MessageUser" required="required">

                    </textarea>

                    <button class="btn btn-primary" ng-click="SendSMS(1)">Send SMS</button>  
                </div>
            </form>
            <!--list of user-->
            <div class="col-md-6" style="color: black;">
                <table class="table table-bordered">
                    <tr>
                        <th><input type="checkbox" ng-model="selectedAll" ng-click="checkAll(1)" /></th>
                        <th>Name </th>
                        <th>Post </th>
                        <th>Mobile </th>

                        <th>Action </th>
                    </tr>
                    <tr ng-repeat="User in AllUser">
                        <td>  <input type="checkbox" ng-model="User.Selected"  ng-true-value="true" ng-false-value="false"/> </td>
                        <td>{{User.Name}} </td>                
                        <td>{{User.Post}} </td>
                        <td>{{User.Mobile}} </td>

                        <td></td>
                    </tr>

                </table>
            </div>



        </div>
        <!--2nd tab start-->
        <div id="menu1" class="tab-pane fade">
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
         <textarea class="form-control" ng-model="MessageStudent" required="required">

                    </textarea>

                    <button class="btn btn-primary" ng-click="SendSMS(2)">Send SMS</button>
                </div>
            </div>
            <br/>
            <div class="row">
                <table id="usersTable" class="table table-striped">
                    <tr>
                        <th><input type="checkbox" ng-model="selectedAll" ng-click="checkAll(2)" /></th>
                        <th>Name &nbsp;<a ng-click="sort_with('FullName');"><i class="glyphicon glyphicon-sort"></i></a> </th>
                        <th>StudentID &nbsp;<a ng-click="sort_with('StudentInsID');"><i class="glyphicon glyphicon-sort"></i></a> </th>
                        <th>Mobile &nbsp;<a ng-click="sort_with('SMSNotificationNo');"><i class="glyphicon glyphicon-sort"></i></a></th>

                        <th> Faculty &nbsp;<a ng-click="sort_with('FacultyName');"><i class="glyphicon glyphicon-sort"></i></a> </th>
                        <th> Session &nbsp;<a ng-click="sort_with('SessionName');"><i class="glyphicon glyphicon-sort"></i></a> </th>
                        <th> Roll &nbsp;<a ng-click="sort_with('RollNo');"><i class="glyphicon glyphicon-sort"></i></a> </th>


                    </tr>
                    <tr ng-repeat="User in searched = (Students| filter:search | orderBy : base :reverse) | beginning_data:(current_grid - 1) * data_limit | limitTo:data_limit">
                        <td>  <input type="checkbox" ng-model="User.Selected"  ng-true-value="true" ng-false-value="false"/>
                        <td>{{User.FullName}} </td>
                        <td>{{User.StudentInsID}} </td>
                        <td>{{User.SMSNotificationNo}} </td>

                        <td> {{User.FacultyName}} </td>
                        <td> {{User.SessionName}} </td>
                        <td>{{User.RollNo}} </td>


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
        <div id="Others" class="tab-pane fade">
            <h3>Menu 2</h3>
            <p>This feature will come soon.</p>
        </div>
        <div id="menu3" class="tab-pane fade">
            <h3>Other2</h3>
            <p>This feature will come soon.</p>
        </div>
    </div>



    <!-- Modal for Send List -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document" style="overflow: scroll;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Sending list</h4>
                </div>
                <div class="modal-body">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <tr>
                            <td>Date</td>
                            <td>Numbers</td>
                            <td>SMS</td>
                            <td>Status</td>
                        </tr>
                        <tr ng-repeat="List in sendList">
                            <td>{{List.Date}} </td>
                            <td>{{List.Numbers}} </td>
                            <td>{{List.SMS}} </td>
                            <td>{{List.Status}}</td>

                        </tr>
                    </table>

                   
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                </div>
            </div>
        </div>
    </div>






</div>


</body>
</html>

<script type="text/javascript">
// $("#checkAll").change(function () {
//    $("input[name*='Check']").prop('checked', $(this).prop("checked"));
//});


            app.controller("SMSCtrl", ["$scope", "$http",
                    function ($scope, $http) {
                    init();
                            function init() {
                            initialize();
                                    GetAllPosts();
                                    CheckBalance();
                                    GetAllCommonField();
                            }
                    function initialize() {
                    $scope.AllUser = [];
                            $scope.User = {};
                            $scope.Posts = [];
                            $scope.GetAllUser = GetAllUser;
                            $scope.SendSMS = SendSMS;
                            $scope.GetSendList = GetSendList;
                            $scope.sendList = [];
                            $scope.CheckBalance = CheckBalance;
                            $scope.CheckedUser = [];
                            $scope.MessageUser = '';
                            $scope.MessageStudent = '';
                            $scope.Message = '';
                            $scope.Balance = '';
                            $scope.Check = [];
//                            For Student
                            $scope.studentInfo2 = {};
                            //                    this is for searching paramiter null
                            $scope.studentInfo2.Faculty = null;
                            //                          $scope.studentInfo.BranchID= 0;
                            $scope.studentInfo2.SessionId = null;
                            $scope.studentInfo2.Batch = null;
                            $scope.studentInfo2.StudentInsID = null;
                            $scope.GetAllCommonField = GetAllCommonField;
                            $scope.GetStudent = GetStudent;
                            $scope.Students = [];
                    }

                    $scope.checkAll = function checkAll(type) {
                    var type = type; //1 for teacher 2 for student

                    if ($scope.selectedAll) {
                    $scope.selectedAll = true;
                    } else {
                    $scope.selectedAll = false;
                    }

                    if (type == 1)
                    {
                    angular.forEach($scope.AllUser, function (User) {
                    User.Selected = $scope.selectedAll;
                    });
                    }
                    else if (type == 2)
                    {
                    angular.forEach($scope.Students, function (User) {
                    User.Selected = $scope.selectedAll;
                    });
                    }

                    };
                            function GetAllPosts() {
                            $scope.Posts = [];
                                    $http({
                                    method: 'GET',
                                            url: baseUrl + 'CommonCtrl/GetPost/'
                                    }).then(function successCallback(response) {
                            $scope.Posts = response.data;
                            }, function errorCallback(response) {
                            });
                            };
                            function GetAllUser(PostSelected) {

                            $scope.AllUser = [];
                                    $scope.PId = PostSelected;
                                    $http({
                                    method: 'GET',
                                            url: baseUrl + 'CommonCtrl/GetAllUsers/' + $scope.PId
                                    }).then(function successCallback(response) {
                            $scope.AllUser = response.data;
                            }, function errorCallback(response) {
                            });
                            };
                            function CheckBalance() {
                            $scope.Balance = '';
                                    $http({
                                    method: 'GET',
                                            url: baseUrl + 'SMS/CheckBalance/'
                                    }).then(function successCallback(response) {
                            $scope.Balance = response.data;
                            }, function errorCallback(response) {
                            });
                            };
//Sending Message from here
                            function SendSMS(type)
                            {
                                var type=type;
                            $scope.mobiles = '';
                            if(type==1)
                            {
                               $scope.Get=$scope.AllUser; 
                               $scope.Message =$scope.MessageUser;
                            }
                            else if(type==2)
                            {
                                $scope.Message =$scope.MessageStudent;
                                $scope.Get=$scope.Students;
                            }
                                    angular.forEach($scope.Get, function (User) {
                                    if (User.Selected == true)
                                    {
										if(type==2){											
                                    $scope.mobiles = $scope.mobiles + User.SMSNotificationNo + ',';
										}
										if(type==1){											
                                    $scope.mobiles = $scope.mobiles + User.Mobile + ',';
										}
										
                                    }  });
                                    var mobiles = $scope.mobiles;
                                    mobiles = mobiles.replace(/,\s*$/, "");
                                    $scope.mobiles = mobiles;
                                    console.log($scope.mobiles);
                                    console.log($scope.Message);
                                    var r = confirm("Do you want to send message!");
                                    if (r == true) {
                            $http.post(
                                    baseUrl + 'SMS/SendSmsOneToMany',
                            {'mobiles':$scope.mobiles, 'message':$scope.Message}
                            ).success(function(data) {
                            alert(data);
                            }).error (function(data){
                            alert(data);
                            });
//         
                            }

                            CheckBalance();
                            }

//already send list
                    function GetSendList() {
                    $scope.sendList = [];
                            $http({
                            method: 'GET',
                                    url: baseUrl + 'SMS/GetSendList/'
                            }).then(function successCallback(response) {
                    $scope.sendList = response.data;
                    }, function errorCallback(response) {
                    });
                    };
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

                    }]);
</script>