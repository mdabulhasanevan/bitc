<div ng-controller="ClassRoutine" class="col-md-10" style="background-color: #ffffff;">
    <!--    <button class="btn btn-primary" data-toggle="modal" data-target="#myModal" >ADD Class</button>-->
    <script>
                // here we will write our custom code for printing our div
                $(function () {
                    $('#print').on('click', function () {
                        //Print ele2 with default options
                        $.print(".print_Routine_div");
                    });
                });</script>
    <div class="row">
        <center><button id='print' style=' border: none; text-align: center; background: black; border-radius: 4px; color: #fff; font-weight: bold; cursor: pointer;'>PRINT </button></center>
        <div class="col-md-9 " style=" text-align: center; vertical-align: central;">
            <h2>Class Routine</h2>
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#Sunday">Sunday</a></li>
                <li><a data-toggle="tab" href="#Monday">Monday</a></li>
                <li><a data-toggle="tab" href="#Tuesday">Tuesday</a></li>
                <li><a data-toggle="tab" href="#Wednesday">Wednesday</a></li>
                <li><a data-toggle="tab" href="#Thursday">Thursday</a></li>
                <li><a data-toggle="tab" href="#Friday">Friday</a></li>
                <li><a data-toggle="tab" href="#Saturday">Saturday</a></li>
                <li><a data-toggle="tab" href="#All">All</a></li>

            </ul>

            <div class="tab-content">
                <!--1st tab-->
                <div id="Sunday" class="tab-pane fade in active">

                    <table class="" border="1" width="100%" >              

                        <tbody ng-repeat="D in ClassRoutines.day| filter:{Name:'Sunday'}">
                            <tr>
                                <td style="background-color: #e2e2e2; font-weight: bold"><span>{{D.Name}}</span></td>
                                <th  ng-repeat="y in ClassRoutines.time"><span class="label label-primary">{{y.Time}}-{{y.EndTime}}</span></th>
                            </tr>

                            <tr ng-repeat="Rom in ClassRoutines.room">

                                <td><span class="label label-danger">{{Rom.Number}}</span></td>
                        <span ng-repeat="y in ClassRoutines.time">
                            <td ng-repeat="R in ClassRoutines.Routine| filter:{Day:D.Name,Room:Rom.Number}">                

                                <span ng-show="R.Subject == NULL || R.Subject == 0" >   
                                    <span class="" style="cursor: pointer" ng-click="ForAddRoutineID(R.ID, R.StartTime, R.DayID)" data-toggle="modal" data-target="#myModal" >+</span>                              
                                </span>
                                <span ng-hide="R.Subject == NULL || R.Subject == 0" > 

                                    <span class="label label-success">{{R.Faculty}}-{{R.Semester}}</span><br>
                                    <span class="glyphicon glyphicon-book"> </span > {{R.Subject}}<br>
                                    <span class="glyphicon glyphicon-user"> </span><span> {{R.Teacher}}</span>
                                    <span class="hover-btn">
                                        <button type="button" ng-click="DeleteRoutine(R.ID)" class="close" data-dismiss="alert">
                                            <span aria-hidden="true">×</span>
                                            <span class="sr-only">Close</span>
                                        </button>
                                    </span>
                                </span>


                            </td>
                        </span>
                        </tr>

                        </tbody>
                    </table>

                </div>
                <!--2nd tab start-->
                <div id="Monday" class="tab-pane fade">

                    <table class="" border="1" width="100%" >              

                        <tbody ng-repeat="D in ClassRoutines.day| filter:{Name:'Monday'}">
                            <tr>
                                <td style="background-color: #e2e2e2; font-weight: bold"><span>{{D.Name}}</span></td>
                                <th  ng-repeat="y in ClassRoutines.time"><span class="label label-primary">{{y.Time}}-{{y.EndTime}}</span></th>
                            </tr>

                            <tr ng-repeat="Rom in ClassRoutines.room">

                                <td><span class="label label-danger">{{Rom.Number}}</span></td>
                        <span ng-repeat="y in ClassRoutines.time">
                            <td ng-repeat="R in ClassRoutines.Routine| filter:{Day:D.Name,Room:Rom.Number}">                

                                <span ng-show="R.Subject == NULL || R.Subject == 0" >   
                                    <span class="" style="cursor: pointer" ng-click="ForAddRoutineID(R.ID, R.StartTime, R.DayID)" data-toggle="modal" data-target="#myModal" >+</span>                              
                                </span>
                                <span ng-hide="R.Subject == NULL || R.Subject == 0" > 

                                    <span class="label label-success">{{R.Faculty}}-{{R.Semester}}</span><br>
                                    <span class="glyphicon glyphicon-book"> </span > {{R.Subject}}<br>
                                    <span class="glyphicon glyphicon-user"> </span><span> {{R.Teacher}}</span>
                                    <span class="hover-btn">
                                        <button type="button" ng-click="DeleteRoutine(R.ID)" class="close" data-dismiss="alert">
                                            <span aria-hidden="true">×</span>
                                            <span class="sr-only">Close</span>
                                        </button>
                                    </span>
                                </span>


                            </td>
                        </span>
                        </tr>

                        </tbody>
                    </table>

                </div>

                <!--3rd tab start-->
                <div id="Tuesday" class="tab-pane fade">

                    <table class="" border="1" width="100%" >              

                        <tbody ng-repeat="D in ClassRoutines.day| filter:{Name:'Tuesday'}">
                            <tr>
                                <td style="background-color: #e2e2e2; font-weight: bold"><span>{{D.Name}}</span></td>
                                <th  ng-repeat="y in ClassRoutines.time"><span class="label label-primary">{{y.Time}}-{{y.EndTime}}</span></th>
                            </tr>

                            <tr ng-repeat="Rom in ClassRoutines.room">

                                <td><span class="label label-danger">{{Rom.Number}}</span></td>
                        <span ng-repeat="y in ClassRoutines.time">
                            <td ng-repeat="R in ClassRoutines.Routine| filter:{Day:D.Name,Room:Rom.Number}">                

                                <span ng-show="R.Subject == NULL || R.Subject == 0" >   
                                    <span class="" style="cursor: pointer" ng-click="ForAddRoutineID(R.ID, R.StartTime, R.DayID)" data-toggle="modal" data-target="#myModal" >+</span>                              
                                </span>
                                <span ng-hide="R.Subject == NULL || R.Subject == 0" > 

                                    <span class="label label-success">{{R.Faculty}}-{{R.Semester}}</span><br>
                                    <span class="glyphicon glyphicon-book"> </span > {{R.Subject}}<br>
                                    <span class="glyphicon glyphicon-user"> </span><span> {{R.Teacher}}</span>
                                    <span class="hover-btn">
                                        <button type="button" ng-click="DeleteRoutine(R.ID)" class="close" data-dismiss="alert">
                                            <span aria-hidden="true">×</span>
                                            <span class="sr-only">Close</span>
                                        </button>
                                    </span>
                                </span>


                            </td>
                        </span>
                        </tr>

                        </tbody>
                    </table>

                </div>

                <!--4th tab start-->
                <div id="Wednesday" class="tab-pane fade">

                    <table class="" border="1" width="100%" >              

                        <tbody ng-repeat="D in ClassRoutines.day| filter:{Name:'Wednesday'}">
                            <tr>
                                <td style="background-color: #e2e2e2; font-weight: bold"><span>{{D.Name}}</span></td>
                                <th  ng-repeat="y in ClassRoutines.time"><span class="label label-primary">{{y.Time}}-{{y.EndTime}}</span></th>
                            </tr>

                            <tr ng-repeat="Rom in ClassRoutines.room">

                                <td><span class="label label-danger">{{Rom.Number}}</span></td>
                        <span ng-repeat="y in ClassRoutines.time">
                            <td ng-repeat="R in ClassRoutines.Routine| filter:{Day:D.Name,Room:Rom.Number}">                

                                <span ng-show="R.Subject == NULL || R.Subject == 0" >   
                                    <span class="" style="cursor: pointer" ng-click="ForAddRoutineID(R.ID, R.StartTime, R.DayID)" data-toggle="modal" data-target="#myModal" >+</span>                              
                                </span>
                                <span ng-hide="R.Subject == NULL || R.Subject == 0" > 

                                    <span class="label label-success">{{R.Faculty}}-{{R.Semester}}</span><br>
                                    <span class="glyphicon glyphicon-book"> </span > {{R.Subject}}<br>
                                    <span class="glyphicon glyphicon-user"> </span><span> {{R.Teacher}}</span>
                                    <span class="hover-btn">
                                        <button type="button" ng-click="DeleteRoutine(R.ID)" class="close" data-dismiss="alert">
                                            <span aria-hidden="true">×</span>
                                            <span class="sr-only">Close</span>
                                        </button>
                                    </span>
                                </span>


                            </td>
                        </span>
                        </tr>

                        </tbody>
                    </table>

                </div>

                <!--5th tab start-->
                <div id="Thursday" class="tab-pane fade">

                    <table class="" border="1" width="100%" >              

                        <tbody ng-repeat="D in ClassRoutines.day| filter:{Name:'Thursday'}">
                            <tr>
                                <td style="background-color: #e2e2e2; font-weight: bold"><span>{{D.Name}}</span></td>
                                <th  ng-repeat="y in ClassRoutines.time"><span class="label label-primary">{{y.Time}}-{{y.EndTime}}</span></th>
                            </tr>

                            <tr ng-repeat="Rom in ClassRoutines.room">

                                <td><span class="label label-danger">{{Rom.Number}}</span></td>
                        <span ng-repeat="y in ClassRoutines.time">
                            <td ng-repeat="R in ClassRoutines.Routine| filter:{Day:D.Name,Room:Rom.Number}">                

                                <span ng-show="R.Subject == NULL || R.Subject == 0" >   
                                    <span class="" style="cursor: pointer" ng-click="ForAddRoutineID(R.ID, R.StartTime, R.DayID)" data-toggle="modal" data-target="#myModal" >+</span>                              
                                </span>
                                <span ng-hide="R.Subject == NULL || R.Subject == 0" > 

                                    <span class="label label-success">{{R.Faculty}}-{{R.Semester}}</span><br>
                                    <span class="glyphicon glyphicon-book"> </span > {{R.Subject}}<br>
                                    <span class="glyphicon glyphicon-user"> </span><span> {{R.Teacher}}</span>
                                    <span class="hover-btn">
                                        <button type="button" ng-click="DeleteRoutine(R.ID)" class="close" data-dismiss="alert">
                                            <span aria-hidden="true">×</span>
                                            <span class="sr-only">Close</span>
                                        </button>
                                    </span>
                                </span>


                            </td>
                        </span>
                        </tr>

                        </tbody>
                    </table>

                </div>

                <!--6th tab start-->
                <div id="Friday" class="tab-pane fade">

                    <table class="" border="1" width="100%" >              

                        <tbody ng-repeat="D in ClassRoutines.day| filter:{Name:'Friday'}">
                            <tr>
                                <td style="background-color: #e2e2e2; font-weight: bold"><span>{{D.Name}}</span></td>
                                <th  ng-repeat="y in ClassRoutines.time"><span class="label label-primary">{{y.Time}}-{{y.EndTime}}</span></th>
                            </tr>

                            <tr ng-repeat="Rom in ClassRoutines.room">

                                <td><span class="label label-danger">{{Rom.Number}}</span></td>
                        <span ng-repeat="y in ClassRoutines.time">
                            <td ng-repeat="R in ClassRoutines.Routine| filter:{Day:D.Name,Room:Rom.Number}">                

                                <span ng-show="R.Subject == NULL || R.Subject == 0" >   
                                    <span class="" style="cursor: pointer" ng-click="ForAddRoutineID(R.ID, R.StartTime, R.DayID)" data-toggle="modal" data-target="#myModal" >+</span>                              
                                </span>
                                <span ng-hide="R.Subject == NULL || R.Subject == 0" > 

                                    <span class="label label-success">{{R.Faculty}}-{{R.Semester}}</span><br>
                                    <span class="glyphicon glyphicon-book"> </span > {{R.Subject}}<br>
                                    <span class="glyphicon glyphicon-user"> </span><span> {{R.Teacher}}</span>
                                    <span class="hover-btn">
                                        <button type="button" ng-click="DeleteRoutine(R.ID)" class="close" data-dismiss="alert">
                                            <span aria-hidden="true">×</span>
                                            <span class="sr-only">Close</span>
                                        </button>
                                    </span>
                                </span>


                            </td>
                        </span>
                        </tr>

                        </tbody>
                    </table>

                </div>

                <!--7th tab start-->
                <div id="Saturday" class="tab-pane fade">

                    <table class="" border="1" width="100%" >              

                        <tbody ng-repeat="D in ClassRoutines.day| filter:{Name:'Saturday'}">
                            <tr>
                                <td style="background-color: #e2e2e2; font-weight: bold"><span>{{D.Name}}</span></td>
                                <th  ng-repeat="y in ClassRoutines.time"><span class="label label-primary">{{y.Time}}-{{y.EndTime}}</span></th>
                            </tr>

                            <tr ng-repeat="Rom in ClassRoutines.room">

                                <td><span class="label label-danger">{{Rom.Number}}</span></td>
                        <span ng-repeat="y in ClassRoutines.time">
                            <td ng-repeat="R in ClassRoutines.Routine| filter:{Day:D.Name,Room:Rom.Number}">                

                                <span ng-show="R.Subject == NULL || R.Subject == 0" >   
                                    <span class="" style="cursor: pointer" ng-click="ForAddRoutineID(R.ID, R.StartTime, R.DayID)" data-toggle="modal" data-target="#myModal" >+</span>                              
                                </span>
                                <span ng-hide="R.Subject == NULL || R.Subject == 0" > 

                                    <span class="label label-success">{{R.Faculty}}-{{R.Semester}}</span><br>
                                    <span class="glyphicon glyphicon-book"> </span > {{R.Subject}}<br>
                                    <span class="glyphicon glyphicon-user"> </span><span> {{R.Teacher}}</span>
                                    <span class="hover-btn">
                                        <button type="button" ng-click="DeleteRoutine(R.ID)" class="close" data-dismiss="alert">
                                            <span aria-hidden="true">×</span>
                                            <span class="sr-only">Close</span>
                                        </button>
                                    </span>
                                </span>


                            </td>
                        </span>
                        </tr>

                        </tbody>
                    </table>

                </div>
                <!--8th tab start-->
                <div id="All" class="tab-pane fade ">
                    
                    <table class="print_Routine_div" border="1" width="100%"  >              
                        <h2>Class Routine</h2>
                        <tbody ng-repeat="D in ClassRoutines.day">
                            <tr>
                                <td style="background-color: #e2e2e2; font-weight: bold"><span>{{D.Name}}</span></td>
                                <th  ng-repeat="y in ClassRoutines.time"><span class="label label-primary">{{y.Time}}-{{y.EndTime}}</span></th>
                            </tr>

                            <tr ng-repeat="Rom in ClassRoutines.room">

                                <td><span class="label label-danger">{{Rom.Number}}</span></td>
                        <span ng-repeat="y in ClassRoutines.time">
                            <td ng-repeat="R in ClassRoutines.Routine| filter:{Day:D.Name,Room:Rom.Number}">                

                                <span ng-show="R.Subject == NULL || R.Subject == 0" >   
                                    <span class="" style="cursor: pointer" ng-click="ForAddRoutineID(R.ID, R.StartTime, R.DayID)" data-toggle="modal" data-target="#myModal" >+</span>                              
                                </span>
                                <span ng-hide="R.Subject == NULL || R.Subject == 0" > 

                                    <span class="label label-success">{{R.Faculty}}-{{R.Semester}}</span><br>
                                    <span class="glyphicon glyphicon-book"> </span > {{R.Subject}}<br>
                                    <span class="glyphicon glyphicon-user"> </span><span> {{R.Teacher}}</span>
                                    <span class="hover-btn">
                                        <button type="button" ng-click="DeleteRoutine(R.ID)" class="close" data-dismiss="alert">
                                            <span aria-hidden="true">×</span>
                                            <span class="sr-only">Close</span>
                                        </button>
                                    </span>
                                </span>


                            </td>
                        </span>
                        </tr>

                        </tbody>
                    </table>

                </div>

            </div>






        </div>

        <!--//right side div-->
        <div class="col-md-3" style="height: 500px; overflow: scroll;">
            <!--Faculty wise class-->
            <!--<h5>Faculty Wise Class</h5>-->
            <table class="table table-striped">
                <tr style="background-color: #e2e2e2; font-weight: bold">
                    <th> Faculty</th>
                    <th> Assign</th>
                    <!--<th> Subjects</th>-->

                </tr>
                <tr ng-repeat="FWC in ClassRoutines.FacultyAndSemester" >
                    <td><span class="label label-info"ng-click="OpenFacultyWiseClass(FWC.FacultyID, FWC.SemesterID, 0)" data-toggle="modal" data-target="#FacultyWiseClassModal" style="cursor: pointer;">
                            {{FWC.Faculty}}-{{FWC.Semester}} </span>
                    </td>
                    <td> 
                        <span  ng-repeat="FWC2 in ClassRoutines.FacultyWiseClassCount| filter:{FacultyID:FWC.FacultyID,SemesterID:FWC.SemesterID}" class="label label-danger" ng-click="OpenFacultyWiseClass(FWC2.FacultyID, FWC2.SemesterID, FWC2.SubjectID)" data-toggle="modal" data-target="#FacultyWiseClassModal" style="cursor: pointer; margin: 1px;">
                            {{FWC2.Subject}}-{{FWC2.ClassNumber}} <br> </span>
                    </td>
<!--                    <td> 
                        <span  ng-repeat="Sub in ClassRoutines.AllSubjects| filter:{Faculty:FWC.FacultyID,Semester:FWC.SemesterID}" class="label label-info"  style="cursor: pointer; margin: 1px;">
                            {{Sub.Name}} <br> </span>
                    </td>-->

                </tr>
            </table>

            <!--Teacher Classes-->
            <table class="table table-striped">
                <tr style="background-color: #e2e2e2; font-weight: bold">
                    <th> Teacher</th>                  
                </tr>
                <tr>
                    <td>
                        <span ng-repeat="TT in ClassRoutines.TeacherClass" class="label label-primary" ng-click="OpenTeacherAssignClass(TT.TeacherID)" data-toggle="modal" data-target="#TeacherModal" style="cursor: pointer; margin: 1px;">
                            {{TT.Name}} -{{TT.numberofclass}} <br></span>
                    </td>

                </tr>
            </table>

        </div>


        <button class="btn btn-danger" ng-click="SETDefaultRoutine()" >Remove & Set Routine Default</button>
    </div>

    <!-- Add Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" >
        <div class="modal-dialog" role="document" style="">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Add Class in the Routine</h4>
                </div>
                <div class="modal-body">

                    <form name="RoutineForm" ng-submit="AddRoutine()" />
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group" ng-class="{'has-error' :submitted1 && RoutineForm.Faculty.$invalid}">
                                <label class="col-md-5 control-label">
                                    Faculty 
                                </label>
                                <div class="col-md-7">
                                    <select class="form-control"  ng-model="ClassRoutine.FacultyID" required name="Faculty" ng-options="ClassRoutine.FId as ClassRoutine.Name for ClassRoutine in AllFields.faculty">
                                        <option value="" selected="selected">Choose Option</option>
                                    </select>
                                    <div class="form-control-focus"> </div>
                                    <span ng-show="submitted1 && RoutineForm.Faculty.$error.required" class="help-block">Faculty Required</span>
                                </div>

                            </div> 
                        </div>
                        <div class="col-md-4">
                            <div class="form-group" ng-class="{'has-error' :submitted1 && RoutineForm.Semester.$invalid}">
                                <label class="col-md-5 control-label">
                                    Semester 
                                </label>
                                <div class="col-md-7">
                                    <select class="form-control"  ng-model="ClassRoutine.SemesterID" required name="Faculty" ng-options="ClassRoutine.ID as ClassRoutine.Name for ClassRoutine in AllFields.semester |  filter:{Faculty:ClassRoutine.FacultyID}">
                                        <option value="" selected="selected">Choose Option</option>
                                    </select>
                                    <div class="form-control-focus"> </div>
                                    <span ng-show="submitted1 && RoutineForm.Faculty.$error.required" class="help-block">Faculty Required</span>
                                </div>

                            </div> 
                        </div>
                        <div class="col-md-4">
                            <div class="form-group" ng-class="{'has-error' :submitted1 && RoutineForm.Faculty.$invalid}">
                                <label class="col-md-5 control-label">
                                    Subjects 
                                </label>
                                <div class="col-md-7">
                                    <select class="form-control"  ng-model="ClassRoutine.SubjectID" required name="Faculty" ng-options="ClassRoutine.SubID as ClassRoutine.Name +' - '+ ClassRoutine.Code for ClassRoutine in AllFields.subjects | filter:{Faculty:ClassRoutine.FacultyID, Semester: ClassRoutine.SemesterID}">
                                        <option value="" selected="selected">Choose Option</option>
                                    </select>
                                    <div class="form-control-focus"> </div>
                                    <span ng-show="submitted1 && RoutineForm.Faculty.$error.required" class="help-block">Faculty Required</span>
                                </div>
                            </div> 
                        </div>
                    </div>
                    <!--second row-->
                    <!--                    <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group" ng-class="{'has-error' :submitted1 && RoutineForm.Day.$invalid}">
                                                    <label class="col-md-5 control-label">
                                                        Day :
                                                        <span class="required">*</span>
                                                    </label>
                                                    <div class="col-md-7">
                                                        <select class="form-control"  ng-model="ClassRoutine.DayID" required name="Day" ng-options="ClassRoutine.ID as ClassRoutine.Name for ClassRoutine in AllFields.day">
                                                            <option value="" selected="selected">Choose Option</option>
                                                        </select>
                                                        <div class="form-control-focus"> </div>
                                                        <span ng-show="submitted1 && RoutineForm.Room.$error.required" class="help-block">Room Required</span>
                                                    </div>
                                                </div> 
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group" ng-class="{'has-error' :submitted1 && RoutineForm.Room.$invalid}">
                                                    <label class="col-md-5 control-label">
                                                        Room :
                                                        <span class="required">*</span>
                                                    </label>
                                                    <div class="col-md-7">
                                                        <select class="form-control"  ng-model="ClassRoutine.RoomID" required name="Room" ng-options="ClassRoutine.ID as ClassRoutine.Number for ClassRoutine in AllFields.room">
                                                            <option value="" selected="selected">Choose Option</option>
                                                        </select>
                                                        <div class="form-control-focus"> </div>
                                                        <span ng-show="submitted1 && RoutineForm.Room.$error.required" class="help-block">Room Required</span>
                                                    </div>
                                                </div> 
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group" ng-class="">
                                                    <label class="col-md-5 control-label">
                                                        Time :
                                                        <span class="required">*</span>
                                                    </label>
                                                    <div class="col-md-7">
                                                        <input type="text" name="StartTime" ng-model="ClassRoutine.StartTime" class="form-control"/>
                                                        <input type="text" name="EndTime" ng-model="ClassRoutine.EndTime" class="form-control"/>
                                                    </div>
                                                </div> 
                                            </div>-->
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group" ng-class="">
                                <label class="col-md-5 control-label">
                                    Teacher 
                                </label>
                                <div class="col-md-7">
                                    <select class="form-control"  ng-model="ClassRoutine.TeacherID" required name="Teacher" ng-options="ClassRoutine.Id as ClassRoutine.Name for ClassRoutine in AllFields.teacher">
                                        <option value="" selected="selected">Choose Option</option>
                                    </select>
                                    <div class="form-control-focus"> </div>
                                    <span ng-show="submitted1 && RoutineForm.Teache.$error.required" class="help-block">Room Required</span>

                                </div>
                            </div> 
                        </div>
                        <div class="col-md-4">
                            <div class="form-group" ng-class="">

                                <button type="Submit" class="btn btn-info" name="ADD" id="Create">ADD</button>
                            </div> 
                        </div>
                    </div>


                    </form>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-default" data-dismiss="modal">Close</button>

                </div>
            </div>
        </div>
    </div>
    <!--modal end-->

    <!-- Teacher Class Show  Modal -->
    <div class="modal fade" id="TeacherModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" >
        <div class="modal-dialog" role="document" style="overflow: scroll;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Classes that's assign for The Teacher</h4>
                </div>
                <div class="modal-body">

                    <table class="table table-striped">
                        <tr>
                            <th> Teacher</th>
                            <th> Faculty</th>
                            <th> Semester</th>
                            <th> Subject</th>
                            <th> Day</th>
                            <th> Room</th>
                            <th> Start Time</th>
                            <th> End Time</th>
                        </tr>
                        <tr ng-repeat="Teacher in SingleTeacherDetail">
                            <td> {{Teacher.Teacher}} </td>                          
                            <td> {{Teacher.Faculty}}</td>
                            <td> {{Teacher.Semester}}</td>
                            <td> {{Teacher.Subject}}</td>
                            <td> {{Teacher.Day}}</td>
                            <td> {{Teacher.Room}}</td>
                            <td> {{Teacher.StartTime}}</td>
                            <td> {{Teacher.EndTime}}</td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-default" data-dismiss="modal">Close</button>

                </div>
            </div>
        </div>
    </div>
    <!--modal end-->

    <!-- Faculty Wise Class Show  Modal -->
    <div class="modal fade" id="FacultyWiseClassModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" >
        <div class="modal-dialog" role="document" style="overflow: scroll;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Faculty Wise Classes</h4>
                </div>
                <div class="modal-body">

                    <table class="table table-striped table-responsive">
                        <tr>
                            <th> Faculty</th>
                            <th> Semester</th>
                            <th> Subject</th>
                            <th> Day</th>
                            <th> Room</th>
                            <th> Start Time</th>
                            <th> End Time</th>
                            <th> Teacher</th>
                            <th>Action</th>
                        </tr>


                        <tr ng-show="SubjectIDForFilter == 0" ng-repeat="FWC in FacultyWiseClass">
                            <td> {{FWC.Faculty}} </td>                          
                            <td> {{FWC.Semester}}</td>
                            <td> {{FWC.Subject}}</td>
                            <td> {{FWC.Day}}</td>
                            <td> {{FWC.Room}}</td>
                            <td> {{FWC.StartTime}}</td>
                            <td> {{FWC.EndTime}}</td>
                            <td> {{FWC.Teacher}}</td>
                            <td>   <button type="button" ng-click="DeleteRoutine(FWC.ID)" class="btn btn-danger glyphicon glyphicon-remove" ></button></td>

                        </tr>
                        <tr ng-show="SubjectIDForFilter > 0" ng-repeat="FWC in FacultyWiseClass|filter:{SubjectID:SubjectIDForFilter}">
                            <td> {{FWC.Faculty}} </td>                          
                            <td> {{FWC.Semester}}</td>
                            <td> {{FWC.Subject}}</td>
                            <td> {{FWC.Day}}</td>
                            <td> {{FWC.Room}}</td>
                            <td> {{FWC.StartTime}}</td>
                            <td> {{FWC.EndTime}}</td>
                            <td> {{FWC.Teacher}}</td>
                            <td>   <button type="button" ng-click="DeleteRoutine(FWC.ID)" class="btn btn-danger glyphicon glyphicon-remove" ></td>

                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-default" data-dismiss="modal">Close</button>

                </div>
            </div>
        </div>
    </div>
    <!--modal end-->

</div>
</body>
</html>

<script type="text/javascript">

    app.controller("ClassRoutine", ["$scope", "$http",
        function ($scope, $http) {
            init();
            function init() {
                initialize();
                GetAllClassRoutine();
                LoadAllFields();
            }
            function initialize() {
                $scope.ClassRoutines = [];
                $scope.ClassRoutine = {};
                $scope.LoadAllFields = LoadAllFields;
                $scope.AllFields = [];
                $scope.AddRoutine = AddRoutine;
                $scope.ForAddRoutineID = ForAddRoutineID;
                $scope.DeleteRoutine = DeleteRoutine;
                $scope.Message = "";
                $scope.OpenTeacherAssignClass = OpenTeacherAssignClass;
                $scope.SingleTeacherDetail = [];
                $scope.OpenFacultyWiseClass = OpenFacultyWiseClass;
                $scope.FacultyWiseClass = [];
                $scope.SubjectIDForFilter = 0;
                $scope.SETDefaultRoutine = SETDefaultRoutine;
                //this will be used when faculty wise class will be deleted the geting updateList
                $scope.DeleteSubAndLoadAgainParamitter = {};
            }

            function SETDefaultRoutine()
            {

                var r = confirm("You are going to DELETE All Class Routine!!!!");
                if (r)
                {
                    var r2 = confirm("You will not get any data any more!!!!");
                    if (r2)
                    {

                        $http({
                            method: 'GET',
                            url: baseUrl + 'Routine/SetRoutineDefault/'
                        }).then(function successCallback(response) {
                            GetAllClassRoutine();
                        }, function errorCallback(response) {
                        });
                    }
                }
            }

            function DeleteRoutine(id)
            {
                var id = id;
                var r = confirm("You are going to DELETE this Class Routine!!!!");
                if (r)
                {
                    $http({
                        method: 'GET',
                        url: baseUrl + 'Routine/DeleteRoutine/' + id
                    }).then(function successCallback(response) {
                        GetAllClassRoutine();
                        OpenFacultyWiseClass($scope.DeleteSubAndLoadAgainParamitter.FacultyID, $scope.DeleteSubAndLoadAgainParamitter.SemesterID, $scope.DeleteSubAndLoadAgainParamitter.SubjectID);
                    }, function errorCallback(response) {
                    });
                }

            }

            function ForAddRoutineID(id, StartTime, DayID)
            {
                var ID = id;
                $scope.ClassRoutine = {};
                $scope.ClassRoutine.StartTime = StartTime;
                $scope.ClassRoutine.ID = ID;
                $scope.ClassRoutine.DayID = DayID;
                console.log($scope.ClassRoutine);
            }

            function GetAllClassRoutine()
            {
                $scope.ClassRoutines = [];
                $http({
                    method: 'GET',
                    url: baseUrl + 'Routine/GetAllClassRoutine/'
                }).then(function successCallback(response) {
                    $scope.ClassRoutines = response.data;
                }, function errorCallback(response) {
                });
            }

            function LoadAllFields()
            {
                $scope.AllFields = [];
                $http({
                    method: 'GET',
                    url: baseUrl + 'Routine/LoadAllFields/'
                }).then(function successCallback(response) {
                    $scope.AllFields = response.data;
                }, function errorCallback(response) {
                });
            }

            function AddRoutine()
            {
                console.log($scope.ClassRoutine);
                $http({
                    method: 'POST',
                    url: baseUrl + 'Routine/AddRoutine/',
                    data: $scope.ClassRoutine
                }).then(function successCallback(response) {
                    $scope.Message = response.data;
                    GetAllClassRoutine();
                    $('#myModal').modal('toggle');
                    alert($scope.Message);
                    console.log($scope.Message);
                }, function errorCallback(response) {
                });
            }

            function OpenTeacherAssignClass(TeacherID)
            {
                var ID = TeacherID;
                $http({
                    method: 'GET',
                    url: baseUrl + 'Routine/OpenTeacherAssignClass/' + ID
                }).then(function successCallback(response) {
                    $scope.SingleTeacherDetail = response.data;
                }, function errorCallback(response) {
                });
            }

            function OpenFacultyWiseClass(FacultyID, SemesterID, SubjectID)
            {
                $scope.DeleteSubAndLoadAgainParamitter.FacultyID = FacultyID;
                $scope.DeleteSubAndLoadAgainParamitter.SemesterID = SemesterID;
                $scope.DeleteSubAndLoadAgainParamitter.SubjectID = SubjectID;
                console.log(SubjectID);
                $scope.SubjectIDForFilter = SubjectID;
                $http({
                    method: 'GET',
                    url: baseUrl + 'Routine/OpenFacultyWiseClass/' + FacultyID + '/' + SemesterID + '/' + SubjectID
                }).then(function successCallback(response) {
                    $scope.FacultyWiseClass = response.data;
                    console.log($scope.FacultyWiseClass);
                }, function errorCallback(response) {
                });
            }
        }]);
</script>    
