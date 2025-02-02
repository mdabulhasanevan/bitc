
<div class="col-md-10 panel panel-primary" ng-controller="StudentCtrl" style="background-color: #ffffff;"> 
    <h3 class="panel-heading">Student Search 
        <a class="btn btn-danger pull-right"href="<?php echo base_url(); ?>student/registration">Student Registration</a>
    </h3>

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

    <br/>
    <div class="row">
       <table datatable="ng" dt-options="vm.dtOptions" class="table table-striped table-bordered"
            <tr>
                <th>SN </th>
                <th>Name  </th>
                <th>StudentID  </th>

                <th> Batch </th>
                <th> Faculty  </th>
                <th> Session  </th>

                <th> Reg No  </th>  </th>
                <th>Status </th>
                <th>Action </th>
            </tr>
            <tr ng-repeat="x in Students ">
                <td>{{$index + 1}}</td>
                <td>{{x.FullName}} </td>
                <td>{{x.StudentInsID}} </td>

                <td> {{x.BatchName}} </td>
                <td> {{x.FacultyName}} </td>
                <td> {{x.SessionName}} </td>

                <td>{{x.RegNo}} </td>
                <td><span class="label label-success" ng-show="x.IsNotActive == 0">Active</span><span class="label label-danger" ng-show="x.IsNotActive == 1">Not Active</span></td>
                <td>    
                    <span type="button"  class="btn btn-info glyphicon glyphicon-eye-open" ng-click="ViewStudent(x.StudentID);" data-toggle="modal" data-target="#myModal"></span> | 
                    <span type="button"  class="btn btn-success glyphicon glyphicon-edit " ng-click="EditStudent(x.StudentID)" data-toggle="modal" data-target="#myEditModal"></span> |
                    <span type="button"  class="btn btn-danger  glyphicon glyphicon-trash " ng-click="DeleteStudent(x.StudentID)" ></span> 
                </td>
            </tr>
        </table>



    </div>

    <!-- view Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" >
        <div class="modal-dialog" role="document" style="width:950px;overflow-x: scroll;">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="col-md-8">
                        <h4 class="modal-title btn btn-success" id="myModalLabel"><span style="">{{Student.FullName}}</span> (Student ID:  {{Student.StudentInsID}} )[Running Semester: {{Student.SemesterName}}] </h4>
                    </div>
                    <div class="col-md-4">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <span class="pull-left"><a target="_new" class="btn glyphicon glyphicon-print" href="<?php echo base_url(); ?>Student/PrintStudentInfoSingle/{{Student.StudentID}}">  Print</a> </span>
                        <span type="button"  class="btn btn-success glyphicon glyphicon-edit " ng-click="EditStudent(Student.StudentID)" data-toggle="modal" data-target="#myEditModal"></span> |


                    </div>
                </div>
                <div class="modal-body">

                    <div class="row">


                        <div class="col-md-10">
                            <h4 class="adminheading">Academic Info </h4>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="Detail">Batch: </label>
                                    {{Student.BatchName}}
                                </div> 
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="Detail">Faculty: </label>
                                    {{Student.FacultyName}}
                                </div> 
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="Detail">Session: </label>
                                    {{Student.SessionName}}
                                </div> 
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="Detail">Reg No: </label>
                                    {{Student.RegNo}}
                                </div> 
                            </div>

                        </div>
                        <div class="col-md-2">
                            <img ng-src="<?php echo base_url("uploads/students/"); ?>{{Student.Photo}}" style="width: 80px; height: 82px;"/>
                        </div> 
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                                <div class="form-group">
                                    <label class="col-md-5 control-label" for="form_control_1">
                                        Last CGPA :

                                    </label>
                                    <div class="col-md-7" style="color: red;">
                                        {{Student.LastCGPA}}
                                        <div class="form-control-focus"> </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="form_control_1">
                                        Comments :

                                    </label>
                                    <div class="col-md-9" style="color: red;">
                                        {{Student.Comment}}
                                        <div class="form-control-focus"> </div>

                                    </div>
                                </div>
                            </div>
                    </div>
                    <div class="row panel">

                        <div class="col-md-6" style="overflow: scroll; height: 300px;">
                            <h4 class="adminheading"> Student Attendance info</h4>

                            <table class="table table-striped">
                                <tr>
                                    <td ng-repeat="AT in Attendances.SingleAttendanceOnlySemester">
                                        [<b>{{AT.Name}}</b>- {{AT.Persent}}%]
                                    </td>
                                </tr>
                            </table>

                            <table class="table">
                                <tr>
                                    <th>Subject  </td>
                                    <th> Semester </td>
                                    <th> Total  </td>
                                    <th>Attend  </td>
                                    <th> Absent  </td>
                                    <th>Percent   </td>
                                </tr>
                                <tr ng-repeat="AT in Attendances.SingleAttendance">
                                    <td>{{AT.Subject}}  </td>
                                    <td> {{AT.Semester}}  </td>
                                    <td> <span class="label label-primary">{{AT.total}}</span>  </td>
                                    <td><span class="label label-success">{{AT.Attend}} </span> </td>
                                    <td> <span class="label label-danger">{{AT.Absent}} </span> </td>
                                    <td>{{AT.Percent}}%  </td>
                                </tr>
                            </table>

                        </div>

                        <div class="col-md-6" style="overflow: scroll; height: 300px;">


                            <h4 class="adminheading"> Student Payment info</h4>
                            <div class="col-md-12" style="text-align: center; background-color: #3c3c3c; color: #ffffff; padding: 5px;"><label>Monthly Pay:</label>  {{History.DueHistory.MonthlyPay}} &nbsp;&nbsp; <label>Due Month:</label> {{History.DueHistory.DueMonth}} &nbsp;&nbsp;&nbsp; <label>Due Money:</label> {{History.DueHistory.DueMoney}}Tk. &nbsp;&nbsp;&nbsp; <label>Deposit Money:</label>  {{History.Deposit.Deposit}}</div>      
                            <span class="col-md-12" style="text-align: center; background-color: #F1C40F; padding: 3px;"> <label>Total Paid:</label> {{History.TotalPaidAmountHistory.TotalPaidAmount}} Tk. &nbsp;&nbsp;&nbsp; <label>Total Month Paid:</label>    {{History.DueHistory.TotalMonthPaid}}&nbsp;&nbsp;&nbsp;&nbsp;<label>Total Month:</label> 
                                {{History.DueHistory.TotalMonth}}</span>
                            <table class="table table-striped">
                                <tr>
                                    <th>SN</th>
                                    <th>Date </th> 
                                    <th>Type </th>  
                                    <th>Semester </th>  
                                    <th>Month </th>  
                                    <th>Paid </th>  
                                    <th>Comment </th>
                                </tr>
                                <tr ng-repeat="H in History.History">
                                    <td>{{$index + 1}} </td>
                                    <td>{{H.Date}} </td>
                                    <td>{{H.PayType}} </td>
                                    <td>{{H.SemesterName}} </td>
                                    <td>{{H.Month}} </td>
                                    <td>{{H.PaymentValue}} </td>
                                    <td>{{H.Comment}} </td>

                                </tr>
                            </table>
                        </div>
                    </div> 

                    <div class="row">
                        <h4 class="adminheading">Basic Info</h4>
                        <div class="col-md-3">
                            <table class="table">

                                <tr>
                                    <td> <label for="Detail">SMS Number </label>  </td>
                                    <td>  {{Student.SMSNotificationNo}}</td>
                                </tr>
                                <tr>
                                    <td> <label for="Detail">Gender </label>   </td>
                                    <td>  {{Student.GenderName}} </td>
                                </tr>

                                <tr>
                                    <td> <label for="Detail">Date Of Birth </label>   </td>
                                    <td>  {{Student.DateOfBirth}} </td>
                                </tr>
                                <tr>
                                    <td>   <label for="Detail">Blood Group </label> </td>
                                    <td> {{Student.BloodGroupName}}</td>
                                </tr>
                                <tr>
                                    <td> <label for="Detail">Religion </label></td>
                                    <td>{{Student.ReligionName}} </td>
                                </tr>
                                <tr>
                                    <td>    <label for="Detail">Nationality </label> </td>
                                    <td> {{Student.Nationality}}</td>
                                </tr>
                            </table>

                        </div>
                        <div class="col-md-3">
                            <table class="table">
                                <tr>
                                    <td>  <label for="Detail">Father Name </label></td>
                                    <td> {{Student.FatherName}} </td>
                                </tr>
                                <tr>
                                    <td>  <label for="Detail"> Mobile: </label></td>
                                    <td>  {{Student.FatherMobile}}</td>
                                </tr>

                                <tr>
                                    <td>  <label for="Detail">Mother Name </label></td>
                                    <td> {{Student.MotherName}} </td>
                                </tr>
                                <tr>
                                    <td>  <label for="Detail"> Mobile: </label></td>
                                    <td>  {{Student.MotherMobile}}</td>
                                </tr>
                            </table>

                            <table class="table">
                                <tr>
                                    <td> <label>Address </label></td>
                                </tr>
                                <tr>
                                    <td>   

                                        <b>Present</b> :   {{Student.PreAddress}},{{Student.PreThana}}, {{Student.PreZilaName}}

                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <b>Permanent</b> :   {{Student.ParAddress}}, {{Student.ParThana}}, {{Student.parZilaName}}
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <h4 class="adminheading">Past Academic Info</h4>
                            <div class="col-md-6">
                                <h4 class="adminheading">SSC</h4>
                                <table class="table table-hover">
                                    <tr>
                                        <td>  <label for="Detail">Year </label></td>
                                        <td>  {{Student.ssc_year}}</td>
                                    </tr>
                                    <tr>
                                        <td>   <label for="Detail">Board </label></td>
                                        <td> {{Student.SSCBoardName}} </td>
                                    </tr>
                                    <tr>
                                        <td>   <label for="Detail">Roll </label>          </td>
                                        <td>  {{Student.ssc_roll}}</td>
                                    </tr>
                                    <tr>
                                        <td>   <label for="Detail">GPA </label>      </td>
                                        <td> {{Student.ssc_gpa}}</td>
                                    </tr>
                                </table>

                            </div>

                            <div class="col-md-6">
                                <h4 class="adminheading">HSC</h4>
                                <table class="table table-hover">
                                    <tr>
                                        <td>  <label for="Detail">Year </label></td>
                                        <td>  {{Student.hsc_year}}</td>
                                    </tr>
                                    <tr>
                                        <td>   <label for="Detail">Board </label></td>
                                        <td> {{Student.HSCBoardName}} </td>
                                    </tr>
                                    <tr>
                                        <td>   <label for="Detail">Roll </label>          </td>
                                        <td>  {{Student.hsc_roll}}</td>
                                    </tr>
                                    <tr>
                                        <td>   <label for="Detail">GPA </label>      </td>
                                        <td> {{Student.hsc_gpa}}</td>
                                    </tr>

                                </table>
                            </div> 
                        </div>

                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                </div>
            </div>

        </div>

    </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="myEditModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" >
        <div class="modal-dialog" role="document" style="width:950px;overflow-x: scroll;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Edit Student Info</h4>
                </div>
                <div class="modal-body">
                    <div class="portlet box">
                        <div class="tools">
                            <a href="javascript:;" class="collapse"> </a>
                        </div>
                        <div class="portlet-body">
                            <div class="tabbable-custom nav-justified">
                                <ul class="nav nav-tabs nav-justified">
                                    <li class="active">
                                        <a href="#studentInfo" data-toggle="tab"> Student Info </a>
                                    </li>
                                    <li ng-hide="StudentIID == 0">
                                        <a href="#guarInfo" data-toggle="tab">Guardian Info </a>
                                    </li>
                                    <li ng-hide="StudentIID == 0">
                                        <a href="#acaInfo" data-toggle="tab"> Academic Info </a>
                                    </li>
                                    <li ng-hide="StudentIID == 0">
                                        <a href="#contInfo" data-toggle="tab"> Contact Info  </a>
                                    </li>
                                    <li ng-hide="studentInfo.StudentID == 0">
                                        <a href="#PhotoUpload" data-toggle="tab"> Photo Upload </a>
                                    </li>
                                    <li ng-hide="studentInfo.StudentID == 0">
                                        <a href="#Password" data-toggle="tab"> Reset Password </a>
                                    </li>

                                </ul>
                                <div class="tab-content">
                                    <!--basic-->
                                    <div class="tab-pane active" id="studentInfo">
                                        <form name="addBasic" ng-submit="UpdateStudent()" class="form-horizontal" novalidate>
                                            <div class="portlet-body">
                                                <div class="panel-group accordion" id="accordion3">
                                                    <div class="panel panel-info">
                                                        <div class="panel-heading">
                                                            <h4 class="panel-title">
                                                                <a class="accordion-toggle accordion-toggle-styled" data-toggle="collapse" data-parent="#accordion3" href="#collapse_3_1"> Basic Info </a>
                                                            </h4>
                                                        </div>
                                                        <div id="collapse_3_1" class="panel-collapse in">
                                                            <div class="panel-body">
                                                                <br />

                                                                <div class="row">

                                                                    <div class="col-md-12">

                                                                        <div class="form-group col-md-6" ng-class="{ 'has-error' : submitted && addBasic.RegNo.$invalid}">
                                                                            <label class="col-md-4 control-label">
                                                                                Reg No:
                                                                            </label>
                                                                            <div class="col-md-8">
                                                                                <input type="text" ng-model="studentInfo.RegNo" class="form-control" placeholder="Student RegNo" name="RegNo" >
                                                                                <div class="form-control-focus"> </div>
                                                                                <span ng-show="submitted && addBasic.RegNo.$error.required" class="help-block">RegNo Required</span>
                                                                            </div>
                                                                        </div>

                                                                        <div class="form-group col-md-6" ng-class="{ 'has-error' : submitted && addBasic.Name.$invalid}">
                                                                            <label class="col-md-4 control-label">
                                                                                RollNo :

                                                                            </label>
                                                                            <div class="col-md-8">
                                                                                <input type="text" ng-model="studentInfo.RollNo" class="form-control" placeholder="Student RollNo" name="RollNo" >
                                                                                <div class="form-control-focus"> </div>
                                                                                <span ng-show="submitted && addBasic.RollNo.$error.required" class="help-block">RollNo Required</span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-8">

                                                                        <div class="form-group" ng-class="{ 'has-error' : submitted && addBasic.Name.$invalid}">
                                                                            <label class="col-md-3 control-label">
                                                                                Name :
                                                                                <span class="required">*</span>
                                                                            </label>
                                                                            <div class="col-md-9">
                                                                                <input type="text" ng-model="studentInfo.FullName" class="form-control" placeholder="Student Name" name="Name" required>
                                                                                <div class="form-control-focus"> </div>
                                                                                <span ng-show="submitted && addBasic.Name.$error.required" class="help-block">Full Name Required</span>
                                                                            </div>
                                                                        </div>


                                                                        <div class="form-group" ng-class="{ 'has-error' : submitted && addBasic.SMSNotificationNo.$invalid}">
                                                                            <label class="col-md-3 control-label">
                                                                                SMS Notify Number :
                <!--                                                                <span class="required">*</span>-->
                                                                            </label>
                                                                            <div class="col-md-9">
                                                                                <input type="text" ng-model="studentInfo.SMSNotificationNo" required class="form-control" placeholder="SMSNotificationNo" name="SMSNotificationNo" >
                                                                                <div class="form-control-focus"> </div>
                                                                                <span ng-show="submitted && addBasic.SMSNotificationNo.$error.required" class="help-block">Name Bangla Required</span>
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                    <div class="col-md-4">

                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group" ng-class="{ 'has-error' : submitted && addBasic.Gender.$invalid}">
                                                                            <label class="col-md-4 control-label">
                                                                                Gender :
                                                                                <span class="required">*</span>
                                                                            </label>
                                                                            <div class="col-md-8">
                                                                                <select class="form-control" ng-model="studentInfo.Gender" required name="Gender" ng-options="studentInfo.Id as studentInfo.Name for studentInfo in CommonFeilds.Other | filter:Type='Gender'">
                                                                                    <option value="" selected="selected">Choose Option</option>
                                                                                </select>
                                                                                <div class="form-control-focus"> </div>
                                                                                <span ng-show="submitted && addBasic.Gender.$error.required" class="help-block">Gender Required</span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group" ng-class="{ 'has-error' : submitted && addBasic.Religion.$invalid}">
                                                                            <label class="col-md-4 control-label">
                                                                                Religion :
                                                                                <span class="required">*</span>
                                                                            </label>
                                                                            <div class="col-md-8">
                                                                                <select class="form-control" ng-model="studentInfo.Religion" required name="Religion" ng-options="studentInfo.Id as studentInfo.Name for studentInfo in CommonFeilds.Other | filter:Type='Religion'">
                                                                                    <option value="" selected="selected">Choose Option</option>
                                                                                </select>
                                                                                <div class="form-control-focus"> </div>
                                                                                <span ng-show="submitted && addBasic.Religion.$error.required" class="help-block">Religion Required</span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group" ng-class="{ 'has-error' : submitted && addBasic.Blood.$invalid}">
                                                                            <label class="col-md-4 control-label">
                                                                                Blood Group :
                <!--                                                                <span class="required">*</span>-->
                                                                            </label>
                                                                            <div class="col-md-8">
                                                                                <select class="form-control" ng-model="studentInfo.BloodGroup"  name="Blood" ng-options="studentInfo.Id as studentInfo.Name for studentInfo in CommonFeilds.Other | filter:Type='BloodGroup'">
                                                                                    <option value="" selected="selected">Choose Option</option>
                                                                                </select>
                                                                                <div class="form-control-focus"> </div>
                                                                                <span ng-show="submitted && addBasic.Blood.$error.required" class="help-block">Blood Group Required</span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label class="col-md-4 control-label">
                                                                                Nationality:
                                                                            </label>
                                                                            <div class="col-md-8">
                                                                                <input type="text" ng-model="studentInfo.Nationality" value="Bangladeshi" class="form-control" placeholder="Nationality" name="Nationality">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group" ng-class="{ 'has-error' : submitted && addBasic.DOB.$invalid}">
                                                                            <label class="col-md-4 control-label">
                                                                                Date of Birth:
                                                                                <span class="required">*</span>
                                                                            </label>
                                                                            <div class="col-md-8">
                                                                                <input class="form-control" required type="text"  ng-model="studentInfo.DateOfBirth" id="datepicker"  autocomplete="off" name="DOB" />
                                                                                <div class="form-control-focus"> </div>
                                                                                <span ng-show="submitted && addBasic.DOB.$error.required" class="help-block">Date of Birth Required</span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label class="col-md-4 control-label">
                                                                                Age:
                                                                            </label>
                                                                            <div class="col-md-8">
                                                                                <input type="text" ng-model="studentInfo.Age" class="form-control" onkeypress='return event.charCode >= 48 && event.charCode <= 57' maxlength="2" placeholder="Age">
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                </div>

                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label class="col-md-4 control-label" style="padding-left: 1px;">
                                                                                Physical Drawback :
                                                                            </label>
                                                                            <div class="col-md-8">
                                                                                <select class="form-control" ng-model="studentInfo.IsPhysicalDrawback">

                                                                                    <option value="1">Yes</option>
                                                                                    <option value="0"ng-selected="true">No</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group" ng-show="studentInfo.IsPhysicalDrawback == 1">
                                                                            <label class="col-md-4 control-label">
                                                                                Description:
                                                                            </label>
                                                                            <div class="col-md-8">
                                                                                <input type="text"  ng-model="studentInfo.PhyDrawbackDescription" name="PhyDrawbackDescription" class="form-control" placeholder="Physical Drawback Description">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label class="col-md-2 control-label" style="padding-left: 1px;">
                                                                                Comment :
                                                                            </label>
                                                                            <div class="col-md-8">
                                                                                <textarea ng-model="studentInfo.Comment" cols="100">
                                                                        
                                                                                </textarea>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label class="col-md-4 control-label" style="padding-left: 1px;">
                                                                                Status :
                                                                            </label>
                                                                            <div class="col-md-8">
                                                                                <select class="form-control" ng-model="studentInfo.IsNotActive">
                                                                                    <option value="0"> Active</option>
                                                                                    <option value="1">Not Active</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="form-actions top">
                                                    <div class="row">
                                                        <div class="col-md-offset-3 col-md-9">
                                                            <button type="button" data-dismiss="modal" class="btn dark btn-outline" ng-click="resetForm();
                                                                                submitted = false">Cancel</button>
                                                            <button type="submit" ng-click="submitted = true" class="btn green-haze">Save</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>

                                    </div>

                                    <!--guarInfo-->
                                    <div class="tab-pane" id="guarInfo">
                                        <!-- Begin: life time stats -->
                                        <div class="portlet light bordered">
                                            <div class="portlet-title">
                                                <a class="accordion-toggle accordion-toggle-styled" data-toggle="collapse" data-parent="#accordion3" href="#collapse_3_1"> Guardian Info </a>
                                            </div>
                                            <div class="portlet-body">
                                                <div class="table-container">
                                                    <div id="sample_3_wrapper" class="dataTables_wrapper no-footer">

                                                        <form name="ContactAddform" ng-submit="UpdateStudent()" class="form-horizontal" id="form_sample_1" novalidate>

                                                            <div class="col-md-6">
                                                                <h5>Father Info</h5>
                                                                <hr />
                                                                <div class="form-group">
                                                                    <label class="col-md-3 control-label" for="form_control_1">
                                                                        Father's Name :

                                                                    </label>
                                                                    <div class="col-md-9">
                                                                        <input type="text" class="form-control" ng-model="studentInfo.FatherName">
                                                                        <div class="form-control-focus"> </div>

                                                                    </div>
                                                                </div>


                                                                <div class="form-group">
                                                                    <label class="col-md-3 control-label" for="form_control_1">
                                                                        Father Mobile :

                                                                    </label>
                                                                    <div class="col-md-9">
                                                                        <input type="text" class="form-control" ng-model="studentInfo.FatherMobile">
                                                                        <div class="form-control-focus"> </div>

                                                                    </div>
                                                                </div>

                                                            </div>
                                                            <div class="col-md-6">
                                                                <h5>Mother Info</h5>
                                                                <hr />
                                                                <div class="form-group">
                                                                    <label class="col-md-3 control-label">
                                                                        Mother Name :

                                                                    </label>


                                                                    <div class="col-md-9">
                                                                        <input type="text" class="form-control" ng-model="studentInfo.MotherName">
                                                                        <div class="form-control-focus"> </div>

                                                                    </div>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label class="col-md-3 control-label" for="form_control_1">
                                                                        Mother's Mobile :

                                                                    </label>
                                                                    <div class="col-md-9">
                                                                        <input type="text" class="form-control" ng-model="studentInfo.MotherMobile">
                                                                        <div class="form-control-focus"> </div>

                                                                    </div>
                                                                </div>

                                                                <div class="form-group col-md-3 pull-right">
                                                                    <button type="submit" ng-click="submitted = true" class="btn green">Save</button>

                                                                </div>
                                                            </div>
                                                        </form>


                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End: life time stats -->


                                    </div>

                                    <!-- Academic -->
                                    <div class="tab-pane" id="acaInfo">

                                        <div>

                                            <div class="portlet light bordered">
                                                <div class="portlet-title">
                                                    <a class="accordion-toggle accordion-toggle-styled" data-toggle="collapse" data-parent="#accordion3" href="#collapse_3_1"> Academic Info </a>

                                                </div>
                                                <div class="portlet-body">
                                                    <div class="table-container">
                                                        <div id="sample_3_wrapper" class="dataTables_wrapper no-footer">

                                                            <form name="ContactAddform" ng-submit="UpdateStudent()" class="form-horizontal" id="form_sample_1" novalidate>
                                                                <div class="row">
                                                                    <div class="form-group">
                                                                        <label class="col-md-3 control-label" for="form_control_1">
                                                                            Institute Last CGPA :

                                                                        </label>
                                                                        <div class="col-md-9">
                                                                            <input type="text" class="form-control" ng-model="studentInfo.LastCGPA">

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <h5>SSC</h5>


                                                                    <div class="form-group">
                                                                        <label class="col-md-3 control-label" for="form_control_1">
                                                                            Year :

                                                                        </label>
                                                                        <div class="col-md-9">
                                                                            <input type="text" class="form-control" ng-model="studentInfo.ssc_year">
                                                                            <div class="form-control-focus"> </div>

                                                                        </div>
                                                                    </div>


                                                                    <div class="form-group">
                                                                        <label class="col-md-3 control-label" for="form_control_1">
                                                                            Board :

                                                                        </label>
                                                                        <div class="col-md-9">
                                                                            <select class="form-control"  ng-model="studentInfo.ssc_board" required name="section" ng-options="studentInfo.ID as studentInfo.BoardName for studentInfo in CommonFeilds.board">
                                                                                <option value="" selected="selected">Choose Option</option>
                                                                            </select>

                                                                            <div class="form-control-focus"> </div>

                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label class="col-md-3 control-label" for="form_control_1">
                                                                            Roll :

                                                                        </label>
                                                                        <div class="col-md-9">
                                                                            <input type="text" class="form-control" ng-model="studentInfo.ssc_roll">
                                                                            <div class="form-control-focus"> </div>

                                                                        </div>
                                                                    </div>


                                                                    <div class="form-group">
                                                                        <label class="col-md-3 control-label" for="form_control_1">
                                                                            GPA :

                                                                        </label>
                                                                        <div class="col-md-9">
                                                                            <input type="text" class="form-control" ng-model="studentInfo.ssc_gpa">
                                                                            <div class="form-control-focus"> </div>

                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <h5>HSC</h5>
                                                                    <hr />

                                                                    <div class="form-group">
                                                                        <label class="col-md-3 control-label" for="form_control_1">
                                                                            Year :

                                                                        </label>
                                                                        <div class="col-md-9">
                                                                            <input type="text" class="form-control" ng-model="studentInfo.hsc_year">
                                                                            <div class="form-control-focus"> </div>

                                                                        </div>
                                                                    </div>


                                                                    <div class="form-group">
                                                                        <label class="col-md-3 control-label" for="form_control_1">
                                                                            Board :

                                                                        </label>
                                                                        <div class="col-md-9">
                                                                            <select class="form-control"  ng-model="studentInfo.hsc_board" required name="section" ng-options="studentInfo.ID as studentInfo.BoardName for studentInfo in CommonFeilds.board">
                                                                                <option value="" selected="selected">Choose Option</option>
                                                                            </select>

                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label class="col-md-3 control-label" for="form_control_1">
                                                                            Roll :

                                                                        </label>
                                                                        <div class="col-md-9">
                                                                            <input type="text" class="form-control" ng-model="studentInfo.hsc_roll">
                                                                            <div class="form-control-focus"> </div>

                                                                        </div>
                                                                    </div>


                                                                    <div class="form-group">
                                                                        <label class="col-md-3 control-label" for="form_control_1">
                                                                            GPA :

                                                                        </label>
                                                                        <div class="col-md-9">
                                                                            <input type="text" class="form-control" ng-model="studentInfo.hsc_gpa">
                                                                            <div class="form-control-focus"> </div>

                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group col-md-3 pull-right">
                                                                        <button type="submit" ng-click="submitted = true" class="btn green">Save</button>

                                                                    </div>
                                                                </div>
                                                            </form>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                        </div>

                                    </div>

                                    <!--//Contact-->
                                    <div class="tab-pane" id="contInfo">

                                        <div class="portlet light bordered">
                                            <div class="portlet-title">
                                                <a class="accordion-toggle accordion-toggle-styled" data-toggle="collapse" data-parent="#accordion3" href="#collapse_3_1"> Contact Info </a>
                                            </div>
                                            <div class="portlet-body">
                                                <div class="table-container">
                                                    <div id="sample_3_wrapper" class="dataTables_wrapper no-footer">
                                                        <div class="row">
                                                            <form name="ContactAddform" ng-submit="UpdateStudent()" class="form-horizontal" id="form_sample_1" novalidate>

                                                                <div class="col-md-6">
                                                                    <h5>Present Address</h5>
                                                                    <hr />
                                                                    <div class="form-group">
                                                                        <label class="col-md-3 control-label" for="form_control_1">
                                                                            Address :

                                                                        </label>
                                                                        <div class="col-md-9">
                                                                            <textarea class="form-control" ng-model="studentInfo.PreAddress"></textarea>

                                                                            <div class="form-control-focus"> </div>

                                                                        </div>
                                                                    </div>


                                                                    <div class="form-group">
                                                                        <label class="col-md-3 control-label">
                                                                            District :

                                                                        </label>


                                                                        <div class="col-md-9">
                                                                            <select class="form-control" ng-model="studentInfo.PreZila" ng-options="studentInfo.DistrictId as studentInfo.DistrictName for studentInfo in preDistrict" ></select>
                                                                            <div class="form-control-focus"> </div>

                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label class="col-md-3 control-label">
                                                                            Police Station :

                                                                        </label>


                                                                        <div class="col-md-9">
                                                                            <select class="form-control" ng-model="studentInfo.PreThana" ng-options="studentInfo.PsId as studentInfo.PsName for studentInfo in preThana "></select>
                                                                            <div class="form-control-focus"> </div>

                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label class="col-md-3 control-label" for="form_control_1">
                                                                            Post Office :

                                                                        </label>
                                                                        <div class="col-md-9">
                                                                            <input type="text" class="form-control" ng-model="studentInfo.PrePostOffice">
                                                                            <div class="form-control-focus"> </div>

                                                                        </div>
                                                                    </div>


                                                                    <div class="form-group">
                                                                        <label class="col-md-3 control-label" for="form_control_1">
                                                                            Post Code :

                                                                        </label>
                                                                        <div class="col-md-9">
                                                                            <input type="text" class="form-control" ng-model="studentInfo.PrePostCode">
                                                                            <div class="form-control-focus"> </div>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <h5>Permanent Address</h5>
                                                                    <hr />
                                                                    <div class="form-group">
                                                                        <label class="col-md-3 control-label" for="form_control_1">
                                                                            Address :

                                                                        </label>
                                                                        <div class="col-md-9">
                                                                            <textarea class="form-control" ng-model="studentInfo.ParAddress"></textarea>

                                                                            <div class="form-control-focus"> </div>

                                                                        </div>
                                                                    </div>


                                                                    <div class="form-group">
                                                                        <label class="col-md-3 control-label">
                                                                            District :

                                                                        </label>


                                                                        <div class="col-md-9">
                                                                            <select class="form-control" ng-model="studentInfo.ParZila" ng-options="studentInfo.DistrictId as studentInfo.DistrictName for studentInfo in parDistrict" ></select>
                                                                            <div class="form-control-focus"> </div>

                                                                        </div>
                                                                    </div>




                                                                    <div class="form-group">
                                                                        <label class="col-md-3 control-label">
                                                                            Police Station :

                                                                        </label>


                                                                        <div class="col-md-9">
                                                                            <select class="form-control" ng-model="studentInfo.ParThana" ng-options="studentInfo.PsId as studentInfo.PsName for studentInfo in parThana "></select>
                                                                            <div class="form-control-focus"> </div>

                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label class="col-md-3 control-label" for="form_control_1">
                                                                            Post Office :

                                                                        </label>
                                                                        <div class="col-md-9">
                                                                            <input type="text" class="form-control" ng-model="studentInfo.ParPostOffice">
                                                                            <div class="form-control-focus"> </div>

                                                                        </div>
                                                                    </div>


                                                                    <div class="form-group">
                                                                        <label class="col-md-3 control-label" for="form_control_1">
                                                                            Post Code :

                                                                        </label>
                                                                        <div class="col-md-9">
                                                                            <input type="text" class="form-control" ng-model="studentInfo.ParPostCode">
                                                                            <div class="form-control-focus"> </div>

                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group col-md-3 pull-right">
                                                                        <button type="submit" ng-click="submitted = true" class="btn green">Save</button>

                                                                    </div>
                                                                </div>
                                                            </form>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <!--Photo upload-->
                                    <div class="tab-pane" id="PhotoUpload">
                                        <div class="panel panel-info">
                                            <div class="panel-heading">Photo Info</div>
                                            <div class="panel-body">
                                                <form name="PhotoForm" ng-submit="UpdateStudentPhoto()" class="form-horizontal" id="form_sample_1" novalidate>
                                                    <div class="form-group" ng-class="{ 'has-error' : submitted && addBasic.stuimage.$invalid}">
                                                        <div class="col-md-8">
                                                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                                                <div class="row">
                                                                    <div class="col-md-4">
                                                                        <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 80px; height: 82px;"> 
                                                                            <img ng-src="<?php echo base_url("uploads/students/"); ?>{{studentInfo.Photo}}" style="width: 80px; height: 82px;"/>
                                                                        </div>
                                                                    </div>
                                                                    <div style="float:right !important" class="col-md-4">
                                                                        <span class="btn red btn-outline btn-file">
                                                                            <span class="fileinput-new"> Select image </span>
                                                                            <!--<span class="fileinput-exists"> Change </span>-->
                                                                            <input type="file" id="imgs" name="Img"  required>
                                                                        </span>

                                                                        <!--<a href="javascript:;" style="margin-top:10px !important"  class="btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>-->



                                                                        <button type="submit" class="btn btn-info" >upload</button>
                                                                        <input type="hidden" ng-model="studentInfo.StudentID" name="StudentID"/>
                                                                        <div class="form-control-focus"> </div>
                                                                        <span ng-show="submitted && addBasic.stuimage.$error.required" class="help-block">Photo Required</span>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>

                                                    </div>

                                                </form>

                                            </div>
                                        </div>
                                    </div>

                                    <!--Password-->
                                    <div class="tab-pane" id="Password">
                                        <div class="panel panel-info">
                                            <div class="panel-heading">Password</div>
                                            <div class="panel-body">
                                                <button type="button" class="btn btn-danger" ng-click="PasswordSetDefault()">Reset Password</button>

                                            </div>
                                        </div>
                                    </div>
                                    <!-- End: life time stats -->

                                </div>
                            </div>
                        </div>

                    </div>  
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                </div>
            </div>

        </div>

    </div>
</div>
</div>
<!--modal end-->
</div>
</body>

</html>

<script type="text/javascript">

                    app.controller("StudentCtrl", ["$scope", "$http",
                            function ($scope, $http, $filter, $timeout) {
                            init();
                                    function init() {
                                    initialize();
                                            GetAllCommonField();
                                    }
                            function initialize() {

                            $scope.studentInfo2 = {};
                                    // this is for searching paramiter null
                                    $scope.studentInfo2.Faculty = null;
                                    // $scope.studentInfo.BranchID= 0;
                                    $scope.studentInfo2.SessionId = null;
                                    $scope.studentInfo2.Batch = null;
                                    $scope.studentInfo2.StudentInsID = null;
                                    $scope.Dropdowns = [];
                                    $scope.CommonFeilds = [];
                                    $scope.GetAllCommonField = GetAllCommonField;
                                    $scope.CommonFeilds = [];
                                    $scope.GetStudent = GetStudent;
                                    $scope.Students = [];
                                    $scope.Student = {};
                                    $scope.ViewStudent = ViewStudent;
                                    $scope.EditStudent = EditStudent;
                                    $scope.GetSingleStudentFromList = GetSingleStudentFromList;
                                    $scope.DeleteStudent = DeleteStudent;
                                    $scope.AttendanceSingle = AttendanceSingle;
                                    $scope.Attendances = [];
                                    $scope.DeletePhoto = DeletePhoto;
                                    $scope.StudentID = null;
                                    //pdf
                                    $scope.convertNulltoZeroformakeParamitterPdf = convertNulltoZeroformakeParamitterPdf

                                    $scope.PasswordSetDefault = PasswordSetDefault;
                                    //Pay History
                                    $scope.GetPayHistory = GetPayHistory;
                                    $scope.History = [];
                            }

                            //history
                            function GetPayHistory(Id)
                            {
                            $scope.History = [];
                                    $http({
                                    method: 'GET',
                                            url: baseUrl + 'Payment/GetPayHistory/' + Id
                                    }).then(function successCallback(response) {
                            // console.log(response.data);
                            $scope.History = response.data;
                            }, function errorCallback(response) {
                            });
                            }


                            function convertNulltoZeroformakeParamitterPdf()
                            {
                            $scope.Faculty = $scope.studentInfo2.Faculty;
                                    $scope.SessionId = $scope.studentInfo2.SessionId;
                                    $scope.Batch = $scope.studentInfo2.Batch;
                                    $scope.StudentInsID = $scope.studentInfo2.StudentInsID;
                                    if ($scope.Faculty == null)
                            {
                            $scope.Faculty = 0;
                            }
                            if ($scope.SessionId == null)
                            {
                            $scope.SessionId = 0;
                            }
                            if ($scope.Batch == null)
                            {
                            $scope.Batch = 0;
                            }
                            if ($scope.StudentInsID == null)
                            {
                            $scope.StudentInsID = 0;
                            }


                            }
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
                                    //console.log($scope.studentInfo2);
                                    $http({
                                    method: 'POST',
                                            url: baseUrl + 'Student/GetStudent',
                                            headers: {'Content-Type': 'application/json'},
                                            data: JSON.stringify($scope.studentInfo2)
                                    }).success(function (data) {
                            //  console.log(data);
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

                            function ViewStudent(x)
                            {
                            GetSingleStudentFromList(x);
                                    AttendanceSingle(x);
                                    GetPayHistory(x);
                            }

                            function AttendanceSingle(x)
                            {
                            var id = x;
                                    $scope.Attendances = [];
                                    $http({
                                    method: 'GET',
                                            url: baseUrl + 'Attendance/GetSingleAttendance/' + id
                                    }).then(function successCallback(response) {
                            $scope.Attendances = response.data;
                            }, function errorCallback(response) {
                            });
                            }

                            function EditStudent(x)
                            {
                            //GetSingleStudentFromList(x);
//                            set student ID Globaly
                            $scope.StudentID = x;
                                    $scope.studentInfo = {};
                                    // console.log($scope.studentInfo2);
                                    $http({
                                    method: 'GET',
                                            url: baseUrl + 'Student/GetSingleStudent/' + x

                                    }).success(function (data) {
                            //console.log(data);
                            $scope.studentInfo = data;
                            });
                            }

                            $scope.UpdateStudentPhoto = function UpdateStudentPhoto()
                            {
                            $scope.studentInfo.Photo = "";
                                    var files = $("#imgs").get(0).files;
                                    var StudentID = $scope.studentInfo.StudentID;
                                    if ($scope.studentInfo.StudentID > 0) {
                            $http({
                            method: 'POST',
                                    url: baseUrl + '/Student/UpdateStudentPhoto/',
                                    headers: {'Content-Type': undefined},
                                    transformRequest: function (data) {
                                    var formData = new FormData();
                                            formData.append('StudentID', StudentID);
                                            if (files.length > 0)
                                            formData.append("Img", files[0]);
                                            return formData;
                                    }

                            }).success(function (data) {

                            $scope.studentInfo.Photo = data.Photo;
                                    //  console.log(data);
                                    swal("Student Info!", "...Successfully Updated!");
                            });
                            }
                            else
                            {
                            alert("First Fillup Above Data.. You have no StudentInsId")
                            }
                            }

                            $scope.UpdateStudent = function UpdateStudent()
                            {
                            if ($scope.studentInfo.StudentID > 0) {

                            $http({
                            method: 'POST',
                                    url: baseUrl + 'Student/UpdateStudent',
                                    headers: {'Content-Type': 'application/json'},
                                    data: JSON.stringify($scope.studentInfo)
                            }).success(function (data) {
                            $scope.studentInfo = data;
                                    // console.log(data);
                                    GetStudent();
                                    swal("Student Info!", "...Successfully Updated!");
                            });
                            }
                            else
                            {
                            alert(" You have no StudentInsId")
                            }

                            }

                            function DeleteStudent(id)
                            {
                            var BrId = id;
                                    var r = confirm("Do you want to Delete!");
                                    if (r == true) {
                            $http({
                            method: 'GET',
                                    url: baseUrl + 'Student/DeleteStudent/' + BrId
                            }).then(function successCallback(response) {
                            GetStudent();
                                    swal("Deleted Successfully!!", "OK");
                            }, function errorCallback(response) {
                            swal("Not Deleted!!!!", "OK");
                            });
                            }
                            }

                            function DeletePhoto(ID)
                            {
                            // console.log(ID);
//                            $http({
//                            method: 'GET',
//                            url: baseUrl + 'Student/DeletePhoto'+ID,                                  
//                            }).success(function (data) {                   
//                            $scope.Students = data;                          
//                            
//                            })
                            }

                            function PasswordSetDefault()
                            {
                            $http({
                            method: 'GET',
                                    url: baseUrl + 'Student/PasswordSetDefault/' + $scope.StudentID
                            }).then(function successCallback(response) {
                            $scope.Result = response.data;
                                    // console.log($scope.Result);
                            }, function errorCallback(response) {
                            });
                            }






                            }]);
</script>