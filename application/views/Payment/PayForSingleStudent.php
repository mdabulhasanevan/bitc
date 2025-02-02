<div ng-controller="MajorCtrl" class="col-md-10" style="background-color: #ffffff;">

    <br>
    <div class="row">
        <form class="form-horizontal" id="frmCommon" ng-submit="GetStudent()"  name="formCommonFeilds" >
            <div class="form-body" >
                <div class="row">

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-md-5 control-label">
                                StudentID / Reg. No / Bar code

                            </label>
                            <div class="col-md-7">
                                <input type="text" value="00" autocomplete="off"  ng-model="studentInfo2.StudentInsID" class="form-control" placeholder="StudentID/Reg.No/Barcode" name="studentInsID" >
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




    <!-- Add Modal -->
    <div class="modal fade" id="myPayModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" >
        <div class="modal-dialog" role="document" style="width:950px;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" ng-click="reset();
                            " class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
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
                                <select class="form-control"  ng-model="PaymentForm.Type" required  name="Type" ng-options="studentInfo.ID as studentInfo.Type for studentInfo in CommonFeilds.paytype">
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
                                <input class="form-control" ng-model="PaymentForm.Comment" required   name="Exam"/>
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
                    <button type="button" ng-click="reset();" class="btn btn-default" data-dismiss="modal">Close</button>

                </div>
            </div>
        </div>
    </div>
    <!--modal end-->

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

                $scope.TotalDueMoney = 0;
                $scope.CollegeName = "";
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
                $scope.PaymentForm.SMS = false;
                // $scope.PaymentForm.MonthlyPay = $scope.Payment.MonthlyPay;


                $scope.GetPayHistory = GetPayHistory;
                $scope.History = [];
//                $scope.DeleteTransaction = DeleteTransaction;



                $scope.Paymentbtn = Paymentbtn;
            }


//            function DeleteTransaction(ID)
//            {
//                console.log(ID);
//                var r = confirm("Do you want to Delete!");
//                if (r == true) {
//                    $http({
//                        method: 'GET',
//                        url: baseUrl + 'Payment/DeleteTransaction/' + ID
//                    }).then(function successCallback(response) {
//                        console.log(response.data);
//                        swal("Payment!", "Deleted Successfully!!");
//                        GetPayHistory($scope.Payment.StudentID);
//                    }, function errorCallback(response) {
//                        swal("Payment!", "Not Deleted!!!!");
//                    });
//                }
//
//            }


            $scope.PayableAmount = function PayableAmount()
            {
                $scope.PaymentForm.Paid = $scope.PaymentForm.Month * $scope.Payment.MonthlyPay;
            }

            //after click payment button from list    
            function Paymentbtn(Student)
            {
                $('#myPayModal').modal('toggle');
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
                if ($scope.studentInfo2.StudentInsID == "" || $scope.studentInfo2.StudentInsID == null || $scope.studentInfo2.StudentInsID <= 0)
                {
                    alert("Field Null");
                }
                else
                {
                    $scope.Students = [];
                    $http({
                        method: 'POST',
                        url: baseUrl + 'Payment/GetStudentforPay',
                        headers: {'Content-Type': 'application/json'},
                        data: JSON.stringify($scope.studentInfo2)
                    }).success(function (data) {
                        $scope.result = data
                        $scope.Students = $scope.result.Student;
                        if ($scope.Students.length > 0)
                        {
                            Paymentbtn($scope.Students[0]);
                            $scope.studentInfo2.StudentInsID = "";
                        }


                    })
                }
            }



        }]);
</script>