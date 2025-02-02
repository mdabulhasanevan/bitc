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
                                <select class="form-control" id="FacultyOpt"   ng-model="studentInfo2.Faculty"  name="Faculty" ng-options="studentInfo.FId as studentInfo.Name for studentInfo in CommonFeilds.faculty">
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
                                <select class="form-control" id="SessionOpt"  ng-model="studentInfo2.SessionId"  name="session" ng-options="studentInfo.SessionId as studentInfo.Session for studentInfo in CommonFeilds.session">
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
    <!--    <div class="row">
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
    
    
        </div>-->
    <center><button id='print' style='margin-top: 0px; padding: 0px; border: none; text-align: center; background: black; border-radius: 4px; color: #fff; font-weight: bold; cursor: pointer;'>PRINT </button></center>
    <div class="row print_History_div">
        <h1 style="text-align: center;" id="CollecgName"></h1>
        <h3 style="text-align: center;">Student Individual Due Report <br> <?php echo date("d-m-Y"); ?></h3> 
        &nbsp; &nbsp;&nbsp; &nbsp;<label>Faculty: </label>{{FacultyOpt}} &nbsp; &nbsp;<label>Session:</label> {{SessionOpt}} &nbsp; &nbsp;
        <table class="table table-bordered" id="usersTable" class="" border="1" width="100%" style="text-align: center;" >
            <tr >
                <th>SN</th>
                <th style="text-align: center;">Name &nbsp;<a ng-click="sort_with('FullName');"><i class="glyphicon glyphicon-sort"></i></a> </th>
                <th style="text-align: center;">Reg No &nbsp;<a ng-click="sort_with('StudentRegNo');"><i class="glyphicon glyphicon-sort"></i></a></th>
                <th style="text-align: center;">Ins.ID &nbsp;<a ng-click="sort_with('StudentInsID');"><i class="glyphicon glyphicon-sort"></i></a></th>

                <!--<th style="text-align: center;"> Faculty &nbsp;<a ng-click="sort_with('FacultyName');"><i class="glyphicon glyphicon-sort"></i></a> </th>-->
                <!--<th style="text-align: center;"> Session &nbsp;<a ng-click="sort_with('SessionName');"><i class="glyphicon glyphicon-sort"></i></a> </th>-->
                <th style="text-align: center;">Monthly Pay </th>
                <th style="text-align: center;"> Due Month</th>
                <th style="text-align: center;"> Due </th>
                <th style="text-align: center;"> Deposit</th>
<!--                <th> Off( %)</th>
                <th> Payable</th>-->
                <th> Remark</th>
                <th> Action</th>


            </tr>
            <tr ng-repeat="User in searched = (Students| filter:search | orderBy : base :reverse) | beginning_data:(current_grid - 1) * data_limit | limitTo:data_limit">

                <td> {{$index + 1}}  </td>
                <td style="text-align: left; padding-left: 5px;">{{User.FullName}} </td>

                <td>{{User.StudentRegNo}} </td>
                <td>{{User.StudentInsID}} </td>

                <!--<td> {{User.FacultyName}} </td>-->
                <!--<td> {{User.SessionName}} </td>-->
                <td>  {{User.MonthlyPay}}</td>
                <td>   {{User.DueMonth}} </td>
                <td> {{User.DueMoney}} </td>
                <td> {{User.Deposit}}</td>
<!--                <td> {{User.Off}}   </td>
                <td> {{User.MonthlyPay - (User.MonthlyPay * (User.Off / 100))}}</td>-->

                <td>  {{ User.Others}} </td>
                <td>   <button class="glyphicon glyphicon-shopping-cart" data-toggle="modal" data-target="#myPayModal" ng-click="Paymentbtn(User)" >Pay</button> </td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
<!--                <td></td>-->
                <td>Due</td>
                <th>{{TotalDueMoney}} Tk.</th>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        </table>
        <!--this is showing 4/4 ... number of item-->
        <div class="col-md-12" ng-show="filter_data == 0">
            <div class="col-md-12">
                <h4>No records found..</h4>
            </div>


        </div>
        <!--
                pagination-->
        <div class="col-md-12">
            <div class="col-md-6 pull-left">
                <h5>Showing {{ searched.length}} of {{ entire_user}} entries</h5>
            </div>
            <div class="col-md-6" ng-show="filter_data > 0">
                <div pagination="" page="current_grid" on-select-page="page_position(page)" boundary-links="true" total-items="filter_data" items-per-page="data_limit" class="pagination-small pull-right" previous-text="&laquo;" next-text="&raquo;"></div>
            </div>
        </div>

    </div>


    <!-- Add Modal -->
    <div class="modal fade" id="myPayModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" >
        <div class="modal-dialog" role="document" style="width:950px;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" ng-click="reset(); GetStudent();" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Payment Form</h4>
                </div>
                <div class="modal-body" style="overflow: scroll; padding: 0px;">
                    <div class="col-md-12" >
                        <div class="col-md-6">

                            <div class="col-md-12" style="background-color: #e3e3e3; padding: 5px;">
                                <div class="col-md-9">
                                    <h4 style="text-align: center; background-color: #3c3c3c; color: #ffffff;  padding: 5px;">Student Info</h4>
                                    <label for="Exam" >Name : </label>
                                    {{Payment.FullName}}
                                    <br>
                                    <label for="Exam" >Reg No : </label>
                                    {{Payment.StudentRegNo}}
                                    <br>
                                    <label for="Exam" >Running Semester : </label>
                                    {{Payment.RunningSemester}}
                                    <br>
                                    <label for="Exam" >Monthly Payment : </label>
                                    {{Payment.MonthlyPay}} [Off: {{Payment.Off}}%]<br>

                                    <label>Total Month:</label> 
                                    {{History.DueHistory.TotalMonth}}
                                </div>
                                <div class="col-md-3">
                                    <br>
                                    <img ng-src="<?php echo base_url("uploads/students/"); ?>{{Payment.Photo}}" style="width: 80px; height: 82px;"/>
                                </div>
                                <div class="col-md-12" style="background-color: #F1C40F; padding: 3px;"> <label>Due Month:</label> {{History.DueHistory.DueMonth}} &nbsp;&nbsp;&nbsp; <label>Due Money:</label> {{History.DueHistory.DueMoney}} &nbsp;&nbsp;&nbsp; <label>Deposit Money:</label> <span style="color: red; font-weight: bolder; background-color: white;"> {{History.Deposit.Deposit}}</span></div>
                            </div>

                            <br>

                            <form name="SOSForm" ng-submit="PaySubmitBill()" />
                            <div class="form-group">
                                <label for="Exam" >Pay Type</label>
                                <select class="form-control" autofocus="on"  ng-model="PaymentForm.Type"  required  name="Type" ng-options="studentInfo.ID as studentInfo.Type for studentInfo in CommonFeilds.paytype">
                                    <option value="">Choose Option</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="Exam" >Semester</label>
                                <select class="form-control" required ng-model="PaymentForm.Semester"  name="Type" ng-options="studentInfo.ID as studentInfo.Name for studentInfo in CommonFeilds.semester | filter:{Faculty:Payment.FacultyID}">
                                    <option value="">Choose Option</option>
                                </select>
                            </div>

                            <div class="form-group" ng-show="PaymentForm.Type == 1">
                                <label for="Month" >Month</label>
                                <input class="form-control" type="number" ng-model="PaymentForm.Month"  autocomplete="off" ng-change="PayableAmount()"  name="Exam"/>
                            </div>
                            <div class="form-group">
                                <label for="Comment" >Payable</label>
                                <input class="form-control"  ng-disabled="PaymentForm.Type == 1"  autocomplete="off" required type="number" ng-model="PaymentForm.Paid"  name="Exam"/>
                            </div>

                            <div class="form-group">
                                <label for="Comment" >Slip No/Comment</label>
                                <input class="form-control" autocomplete="off" ng-model="PaymentForm.Comment" required   name="Exam"/>
                            </div>

                            <div class="form-group">
                                <label for="Comment" >Date</label>
                                <input type="text"  ng-model="PaymentForm.Date" id="datepicker" required autocomplete="off" size="15" class="form-control" />
                                 <label for="Comment" >SMS Notify </label>
                                 <input type="checkbox"  ng-model="PaymentForm.SMS"  />
                            </div>
                            
                            <div class="form-group">
                                <button type="Submit" class="btn btn-info" name="Create" id="Create">Pay Amount</button>
                            </div>
                            </form>
                        </div>
                        <div class="col-md-6" style="height: 600px; overflow: scroll;">
                            <h4 style="text-align: center; background-color: #3c3c3c; color: #ffffff; padding: 5px;">History</h4>
                            <span style="background-color: #F1C40F; padding: 3px;"> <label>Total Paid:</label> {{History.TotalPaidAmountHistory.TotalPaidAmount}} Tk. &nbsp;&nbsp;&nbsp; <label>Total Month Paid:</label> {{History.DueHistory.TotalMonthPaid}}</span>
                            <table class="table table-striped" style="overflow: scroll; font-size: 12px;" >
                                <tr>
                                    <th>SN</th>
                                    <th>Date </th> 
                                    <th>Type </th>  
                                    <th>Semester </th>  
                                    <th>Month </th>  
                                    <th>Paid </th>  
                                    <th>Comment </th>
                                    <th> </th>
                                </tr>
                                <tr ng-repeat="H in History.History">
                                    <td>{{$index + 1}} </td>
                                    <td>{{H.Date}} </td>
                                    <td>{{H.PayType}} </td>
                                    <td>{{H.SemesterName}} </td>
                                    <td>{{H.Month}} </td>
                                    <td>{{H.PaymentValue}} </td>
                                    <td>{{H.Comment}} </td>
                                    <td>
                                        <!--<span class="glyphicon glyphicon-remove-sign" style="cursor: pointer" ng-click="DeleteTransaction(H.ID);"></span>--> 
                                    </td>

                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" ng-click="reset(); GetStudent();" class="btn btn-default" data-dismiss="modal">Close</button>

                </div>
            </div>
        </div>
    </div>
    <!--modal end-->

</div>


</body>
</html>

<script type="text/javascript">
//    < !--print html-- >
            // here we will write our custom code for printing our div
            $(function () {
            $('#print').on('click', function () {
            //Print ele2 with default options

            document.getElementById("CollecgName").innerText = CollegeName;
                    $.print(".print_History_div");
            });
            });
            app.controller("MajorCtrl", ["$scope", "$http",
                    function ($scope, $http) {
                    init();
                            function init() {
                            initialize();
                                    GetAllCommonField();
                            }
                    function initialize() {

                    $scope.TotalDueMoney = 0;
                            $scope.CollegeName = "";
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
                            $scope.Students = [];
                            $scope.Payment = {};
                            $scope.Payment.Comment = " ";
                            $scope.Payment.Paid = 0;
                            //for form input
                            $scope.PaymentForm = {};
                            $scope.PaymentForm.Type = "";
                            $scope.PaymentForm.Semester = "";
                            $scope.PaymentForm.Month = 0;
                            //$scope.PaymentForm.Paid = 0;
                            $scope.PaymentForm.Comment = "";
                            $scope.PaymentForm.Date = "";
                            $scope.PaymentForm.SMS=false;
                            // $scope.PaymentForm.MonthlyPay = $scope.Payment.MonthlyPay;


                            $scope.GetPayHistory = GetPayHistory;
                            $scope.History = [];
//                            $scope.DeleteTransaction = DeleteTransaction;
                    }
                    
                    
//                    function DeleteTransaction(ID)
//                    {
//                    console.log(ID);
//                            var r = confirm("Do you want to Delete!");
//                            if (r == true) {
//                    $http({
//                    method: 'GET',
//                            url: baseUrl + 'Payment/DeleteTransaction/' + ID
//                    }).then(function successCallback(response) {
//                    console.log(response.data);
//                            swal("Payment!", "Deleted Successfully!!");
//                            GetPayHistory($scope.Payment.StudentID);
//                    }, function errorCallback(response) {
//                    swal("Payment!", "Not Deleted!!!!");
//                    });
//                    }
//
//                    }


                    $scope.PayableAmount = function PayableAmount()
                    {
                    $scope.PaymentForm.Paid = $scope.PaymentForm.Month * $scope.Payment.MonthlyPay;
                    }

                    //after click payment button from list    
                    $scope.Paymentbtn = function Paymentbtn(Student)
                    {
                    $scope.Payment = {};
                            $scope.Payment = Student;
                            GetPayHistory($scope.Payment.StudentID);
                    }

                    //history
                    function GetPayHistory(Id)
                    {
                    $http({
                    method: 'GET',
                            url: baseUrl + 'Payment/GetPayHistory/' + Id
                    }).then(function successCallback(response) {
                    console.log(response.data);
                            $scope.History = response.data;
                    }, function errorCallback(response) {
                    });
                    }

                    //Submit Payment
                    $scope.PaySubmitBill = function PaySubmitBill()
                    {

                    var r = confirm("Want to Pay seriously???")
                            if (r == true)
                    {
                    $scope.PaymentForm.StudentID = $scope.Payment.StudentID;
                    $scope.PaymentForm.MonthlyPay = $scope.Payment.MonthlyPay;
                           
                    console.log($scope.PaymentForm);
                            $http({
                            method: 'POST',
                                    url: baseUrl + 'Payment/PaySubmitBill/',
                                    headers: {'Content-Type': 'application/json'},
                                    data: JSON.stringify($scope.PaymentForm)

                            }).success(function (data) {
                    $scope.Message = data;
                            console.log(data);
                            $scope.PaymentForm.Type = "";
                            $scope.PaymentForm.Semester = "";
                            $scope.PaymentForm.Month = 0;
                            $scope.PaymentForm.Paid = "";
                            $scope.PaymentForm.Comment = "";
                            $scope.PaymentForm.Date = "";
                            GetPayHistory($scope.Payment.StudentID);
                            // $scope.Payment={};
                            swal("Student Payment!", "...Successfully Updated!");
                    });
                    }
                    else
                    {
                    alert("didn't Pay");
                    }
                    }


                    // for student 
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

                            var FacultyOpt = $("#FacultyOpt option:selected").text();
                            $scope.FacultyOpt = FacultyOpt;
                            var SessionOpt = $("#SessionOpt option:selected").text();
                            $scope.SessionOpt = SessionOpt;
                            
                            $scope.Students = [];
                            // console.log($scope.studentInfo2);
                            $http({
                            method: 'POST',
                                    url: baseUrl + 'Payment/GetStudentforPay',
                                    headers: {'Content-Type': 'application/json'},
                                    data: JSON.stringify($scope.studentInfo2)
                            }).success(function (data) {

                    console.log(data);
                            $scope.result = data
                            $scope.Students = $scope.result.Student;
                            $scope.TotalDueMoney = $scope.result.TotalDue;
//                            angular.forEach($scope.Students, function (H) {
//                                if(H.DueMoney=='')
//                                {
//                                    H.DueMoney=0;
//                                }
//                            $scope.TotalDueMoney = $scope.TotalDueMoney + parseInt(H.DueMoney);
//                            });
                            //this is for datatable
                            $scope.current_grid = 1;
                            $scope.data_limit = $scope.Students.length;
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