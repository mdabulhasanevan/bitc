
<div class="col-md-10 panel panel-primary" ng-controller="StudentCtrl" style="background-color: #ffffff;"> 

    <h3 class="panel-heading">Registration Form 
        <span class="pull-right"> <a class="btn btn-success"href="<?php echo base_url(); ?>student/">Go Student Info</a>
            <a class="btn btn-info pull-right"href="<?php echo base_url(); ?>student/registration">New Registration</a></span>
    </h3>
    <form class="form-horizontal" id="frmCommon" ng-submit="GenerateIDAndSave()"  name="formCommonFeilds" >
        <div class="form-body" >
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group" ng-class="{ 'has-error' : submitted1 && formCommonFeilds.Branch.$invalid}">
                        <label class="col-md-5 control-label">
                            Branch :
                            <span class="required">*</span>
                        </label>
                        <div class="col-md-7">
                            <select class="form-control" ng-disabled="studentInfo.StudentInsID != ''"  ng-model="studentInfo.BranchID" required name="Branch" ng-options="studentInfo.BranchId as studentInfo.Branch for studentInfo in CommonFeilds.branch">
                                <option value="" selected="selected">Choose Option</option>
                            </select>
                            <div class="form-control-focus"> </div>
                            <span ng-show="submitted1 && formCommonFeilds.Branch.$error.required" class="help-block">Branch Required</span>
                        </div>

                    </div>
                    <div class="form-group" ng-class="{ 'has-error' : submitted1 && formCommonFeilds.Faculty.$invalid}">
                        <label class="col-md-5 control-label">
                            Faculty :
                            <span class="required">*</span>
                        </label>
                        <div class="col-md-7">
                            <select class="form-control" ng-disabled="studentInfo.StudentInsID != ''"  ng-model="studentInfo.Faculty" required name="Faculty" ng-options="studentInfo.FId as studentInfo.Name for studentInfo in CommonFeilds.faculty">
                                <option value="" selected="selected">Choose Option</option>
                            </select>
                            <div class="form-control-focus"> </div>
                            <span ng-show="submitted1 && formCommonFeilds.Faculty.$error.required" class="help-block">Faculty Required</span>
                        </div>

                    </div>
                    <div class="form-group" ng-class="{ 'has-error' : submitted1 && formCommonFeilds.session.$invalid}">
                        <label class="col-md-5 control-label">
                            Session :
                            <span class="required">*</span>
                        </label>
                        <div class="col-md-7">
                            <select class="form-control" ng-disabled="studentInfo.StudentInsID != ''" ng-model="studentInfo.SessionId" required name="session" ng-options="studentInfo.SessionId as studentInfo.Session for studentInfo in CommonFeilds.session">
                                <option value="" selected="selected">Choose Option</option>
                            </select>
                            <div class="form-control-focus"> </div>
                            <span ng-show="submitted1 && formCommonFeilds.session.$error.required" class="help-block">session Required</span>
                        </div>

                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group" ng-class="{ 'has-error' : submitted1 && formCommonFeilds.section.$invalid}">
                        <label class="col-md-5 control-label">
                            Section :
                            <span class="required">*</span>
                        </label>
                        <div class="col-md-7">
                            <select class="form-control" ng-disabled="studentInfo.StudentInsID != ''" ng-model="studentInfo.SectionId"  name="section" ng-options="studentInfo.SectionId as studentInfo.Section for studentInfo in CommonFeilds.section">
                                <option value="" selected="selected">Choose Option</option>
                            </select>
                            <div class="form-control-focus"> </div>
                            <span ng-show="submitted1 && formCommonFeilds.section.$error.required" class="help-block">section Required</span>
                        </div>
                    </div>
                    <div class="form-group" ng-class="{ 'has-error' : submitted1 && formCommonFeilds.Batch.$invalid}">
                        <label class="col-md-5 control-label">
                            Batch :
                            <span class="required">*</span>
                        </label>
                        <div class="col-md-7">
                            <select class="form-control" ng-disabled="studentInfo.StudentInsID != ''" ng-model="studentInfo.Batch" required name="Batch" ng-options="studentInfo.BId as studentInfo.BatchName for studentInfo in CommonFeilds.batch">
                                <option value="" selected="selected">Choose Option</option>
                            </select>
                            <div class="form-control-focus"> </div>
                            <span ng-show="submitted1 && formCommonFeilds.Batch.$error.required" class="help-block">Batch Required</span>
                        </div>

                    </div>
                    <div class="form-group" ng-class="{ 'has-error' : submitted1 && formCommonFeilds.CollegeRoll.$invalid}">
                        <label class="col-md-5 control-label">
                            College Roll :
                            <span class="required">*</span>
                        </label>
                        <div class="col-md-7">
                            <input type="text" ng-disabled="studentInfo.StudentInsID != ''" ng-model="studentInfo.CollegeRoll" ng-blur="CheckRoll()" class="form-control" onkeypress='return event.charCode >= 48 && event.charCode <= 57' placeholder="CollegeRoll" name="CollegeRoll" required>
                            <div class="form-control-focus"> </div>
                            <span ng-show="submitted1 && formCommonFeilds.CollegeRoll.$error.required" class="help-block">College Roll Required</span>
                        </div>

                    </div>
                   

                </div>

                <div class="col-md-4">
                    <div class="form-group" ng-class="{ 'has-error' : submitted1 && formCommonFeilds.RegNo.$invalid}">
                        <label class="col-md-5 control-label">
                            Reg No :
                            <span class="required">*</span>
                        </label>
                        <div class="col-md-7">
                            <input type="text" class="form-control" ng-disabled="studentInfo.StudentInsID != ''" ng-model="studentInfo.RegNo"  name="RegNo" placeholder="Registration No">

                            <div class="form-control-focus"> </div>
                            <span ng-show="submitted1 && formCommonFeilds.RegNo.$error.required" class="help-block">RegNo Required</span>
                        </div>
                    </div> 
                    
                     <div class="form-group" ng-class="{ 'has-error' : submitted1 && formCommonFeilds.RollNo.$invalid}">
                        <label class="col-md-5 control-label">
                            Roll :
                            <span class="required">*</span>
                        </label>
                        <div class="col-md-7">
                            <input type="text" class="form-control" ng-disabled="studentInfo.StudentInsID != ''" ng-model="studentInfo.RollNo"  name="RollNo" placeholder="Roll No"/>

                            <div class="form-control-focus"> </div>
                            <span ng-show="submitted1 && formCommonFeilds.RollNo.$error.required" class="help-block">Roll Required</span>
                        </div>

                    </div>
                    
                    
                    
                    
                    <div class="form-group" ng-class="{ 'has-error' : submitted1 && formCommonFeilds.StudentInsID.$invalid}">
                        <label class="col-md-5 control-label">
                            StudentInsID :
                            <span class="required">*</span>
                        </label>
                        <div class="col-md-7">
                            <input type="text" value="00" ng-disabled="studentInfo.StudentInsID != ''" ng-model="studentInfo.StudentInsID" class="form-control" placeholder="Student ID" name="studentInsID" readonly>

                        </div>

                    </div>
                    <div class="col-md-2 pull-right">
                        <button type="submit" ng-click="submitted1 = true;" ng-disabled="studentInfo.StudentInsID != ''" class="btn green pull-right">Generate Student ID</button>
                    </div>
                </div>


            </div>

        </div>
    </form>

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
                    <li ng-hide="studentInfo.StudentID == 0">
                        <a href="#guarInfo" data-toggle="tab">Guardian Info </a>
                    </li>
                    <li ng-hide="studentInfo.StudentID == 0">
                        <a href="#acaInfo" data-toggle="tab"> Academic Info </a>
                    </li>
                    <li ng-hide="studentInfo.StudentID == 0">
                        <a href="#contInfo" data-toggle="tab"> Contact Info  </a>
                    </li>
                    <li ng-hide="studentInfo.StudentID == 0">
                        <a href="#PhotoUpload" data-toggle="tab"> Photo Upload </a>
                    </li>


                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="studentInfo">

                        <form name="addBasic" ng-submit="UpdateStudent()" enctype="multipart/form-data" class="form-horizontal" novalidate>
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
                                                    <div class="col-md-4 ">                                                      
                                                        <!--Photo-->


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
                                                                <input class="form-control" required id="datepicker"  ng-model="studentInfo.DateOfBirth"  placeholder="Date of Birth" name="DOB" autocomplete="off" />
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
                                                                    <option value="0" ng-selected="true">No</option>
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
                        <div class="panel panel-info">
                            <div class="panel-heading">Guardian Info</div>
                            <div class="panel-body">
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

                    <!--Photo upload-->
                    <div class="tab-pane" id="PhotoUpload">
                        <div class="panel panel-info">
                            <div class="panel-heading">Guardian Info</div>
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
                                                            <span class="fileinput-exists"> Change </span>
                                                            <input type="file" id="imgs" name="Img"  required>
                                                        </span>
                                                        <a href="javascript:;" style="margin-top:10px !important"  class="btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
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
                    <!-- End: life time stats -->

                    <!-- Academic -->
                    <div class="tab-pane" id="acaInfo">
                        <div class="panel panel-info">
                            <div class="panel-heading">Academic Info</div>
                            <div class="panel-body">     <form name="ContactAddform" ng-submit="UpdateStudent()" class="form-horizontal" id="form_sample_1" novalidate>

                                    <div class="col-md-6">
                                        <h5>SSC</h5>
                                        <hr />

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

                    <!--//Contact-->
                    <div class="tab-pane " id="contInfo">
                        <div class="panel panel-info">
                            <div class="panel-heading">Address info</div>
                            <div class="panel-body">

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
                                                <select class="form-control" ng-model="studentInfo.PreZila" ng-options="studentInfo.DistrictId as studentInfo.DistrictName for studentInfo in preDistrict" ng-change="getPStations1()"></select>
                                                <div class="form-control-focus"> </div>

                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-3 control-label">
                                                Police Station :

                                            </label>


                                            <div class="col-md-9">
                                                <select class="form-control" ng-model="studentInfo.PreThana" ng-options="studentInfo.PsId as studentInfo.PsName for studentInfo in preThana | filter: { DistrictId: studentInfo.PreZila }"></select>
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
                                                <select class="form-control" ng-model="studentInfo.ParThana" ng-options="studentInfo.PsId as studentInfo.PsName for studentInfo in parThana | filter: { DistrictId: studentInfo.ParZila }"></select>
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
    </div>      
</body>
</html>

<script type="text/javascript">

    app.controller("StudentCtrl", ["$scope", "$http",
        function ($scope, $http) {
            init();
            function init() {
                initialize();
                GetAllCommonField();
            }
            function initialize() {

                $scope.studentInfo = {};
                $scope.studentInfo.StudentInsID = '';
                // $scope.studentInfo.StudentID = 0;
                $scope.StudentIID = 1;
                $scope.StudentInfos = [];
                $scope.Dropdowns = [];
                $scope.CommonFeilds = [];

                $scope.GetAllCommonField = GetAllCommonField;
                $scope.CommonFeilds = [];
                $scope.isGroup = 0;

                $scope.GenerateIDAndSave = GenerateIDAndSave;

            }

            $scope.uploadedFile = function (element) {

                $scope.$apply(function ($scope) {
                    $scope.files = element.files;
                });

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

            //            $scope.GetGroupbyClass = function GetGroupbyClass(ClassId)
            //            {
            //                $scope.isGroup = $scope.CommonFeilds.class[ClassId - 1]["isGroup"];
            //            }
            $scope.CheckRoll = function CheckRoll()
            {
                console.log($scope.studentInfo.CollegeRoll);
                var CollegeRoll=$scope.studentInfo.CollegeRoll;
                var Faculty=$scope.studentInfo.Faculty;
                var SessionId=$scope.studentInfo.SessionId;
                
                
                  $http({
                    method: 'GET',
                            url: baseUrl + 'Student/CheckRoll/' + CollegeRoll+'/'+Faculty +'/'+SessionId
                    }).then(function successCallback(response) {
                    if(response.data>0)       
                    swal("This Roll is Already Exist. Please try different one!!!");
                    }, function errorCallback(response) {
                    swal("Not !!!!", "OK");
                    });
                
            }

            function GenerateIDAndSave()
            {
                //    this is simple StudentInsId generator but it will define by institute
                $scope.studentInfo.StudentInsID = $scope.studentInfo.Faculty + $scope.studentInfo.SessionId + $scope.studentInfo.CollegeRoll;

                $http({
                    method: 'POST',
                    url: baseUrl + 'Student/SaveStudent',
                    headers: {'Content-Type': 'application/json'},
                    data: JSON.stringify($scope.studentInfo)
                }).success(function (data) {
                    console.log(data);
                    $scope.studentInfo = data;
                    //  swal("Student Info!", "...Successfully New Student added!");

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
                        console.log(data);

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
                        console.log(data);

                        swal("Student Info!", "...Successfully Updated!");

                    });
                }
                else
                {
                    alert("First Fillup Above Data.. You have no StudentInsId")
                }

            }
            
        //Show photo
            $scope.uploadedFile = function (element)
            {
                $scope.currentFile = element.files[0];
                var reader = new FileReader();

                reader.onload = function (event) {
                    var output = document.getElementById('output');
                    output.src = URL.createObjectURL(element.files[0]);

                    $scope.image_source = event.target.result
                    $scope.$apply(function ($scope) {
                        $scope.files = element.files;
                    });
                }
                reader.readAsDataURL(element.files[0]);
            }

        }]);
</script>