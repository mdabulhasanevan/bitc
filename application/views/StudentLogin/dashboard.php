<div  class="col-md-8" style="background-color: #ffffff;">            

    <div class="row" >

        <div class="col-md-12" style="min-height: 300px; max-height: 600px; margin: 0px; background-color: #e9ebee; padding: 0px; overflow-y: scroll;   ">
            <!--menu-->
            <div class="col-md-12" style="position: sticky; top: 0;background-color: #ffffff; text-align: center; padding: 10px; border: 0px solid #000; margin: 0px;">
                <!--Attendance-->

                <a class="glyphicon glyphicon-home" href="<?php echo base_url("StudentApp/index"); ?>"></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <!--Attendance-->
                <span style="cursor: pointer;" ng-click="AttendanceSingle();" data-toggle="modal" data-target="#myAttendanceModal"> <span class="glyphicon glyphicon-list"></span> Attendance</span> &nbsp;&nbsp;
                <!--Routine-->  
                <span style="cursor: pointer;"  ng-click="GetAllClassRoutine();" data-toggle="modal" data-target="#myRoutineModal"><span class="glyphicon glyphicon-calendar"></span>  Routine</span>&nbsp;&nbsp;
                <!--Payment-->  
                <span style="cursor: pointer;" ng-click="GetPayHistory();" data-toggle="modal" data-target="#myHistoryModal"> <span class="glyphicon glyphicon-barcode"></span>  Payment History</span>&nbsp;&nbsp;           
                <!--Classmates-->  
                <span style="cursor: pointer;"  ng-click="GetAllClassMates();" data-toggle="modal" data-target="#myClassmatesModal"> <span class="glyphicon glyphicon-user"></span>  Classmates</span>&nbsp;&nbsp;
                <!--library-->  
                <span style="cursor: pointer;"   data-toggle="modal" data-target="#myBookLibraryModal"> <span class="glyphicon glyphicon-book"></span>  Book Library</span>&nbsp;&nbsp;
                 <!--result-->  
                <span style="cursor: pointer;" ng-click="GetAllResultPdf();"  data-toggle="modal" data-target="#myResultModal"> <span class="glyphicon glyphicon-download"></span>  Result File</span>&nbsp;&nbsp;
                
                 <!--Sylabus-->  
                <span style="cursor: pointer;" ng-click="GetAllSylabus();"  data-toggle="modal" data-target="#mySyllabusModal"> <span class="glyphicon glyphicon-download"></span>  Syllabus </span>&nbsp;&nbsp;

                
                <!--Exam-->  
                <!--<button class="btn btn-success" ng-click="GetAllClassMates();" data-toggle="modal" data-target="#myResultModal"> Result</button>-->
            </div>
          
            <!--Quote-->
            <div class="col-md-12" style="margin: 0px; padding: 2px; background-color: darkred; color: white;  text-align: center;" >

                <h5 >{{AllCommon.EducationalQuote.Quote}} - <span style="font-size: 10px;">{{AllCommon.EducationalQuote.Writer}}</span></h5> 
            </div>   

            <!--posts-->
            <div class="media" ng-repeat="Post in AllPost" style="margin-bottom: 1px; background-color: #ffffff; padding: 10px;  border-radius: 10px;">
                <div class="media-left">
                    <img class="img-circle" src="<?php echo base_url(); ?>uploads/users/{{Post.UserPhoto}}" height="60" width="60" /> 
                </div>
                <div class="media-body">
                    <span style="color: #003399; font-weight: bolder; font-size: 14px;">{{Post.TeacherName}}- ({{Post.PostName}})</span> 
                    <br> <span class="" style="font-size: 10px; padding: 0px; margin: 0px;"> {{Post.Date}} </span>
                    <h4 style="padding: 0px; margin: 0px; color: #000; text-align: left; ">{{Post.Heading}} </h4>
                    <span> 
                        <span style="white-space:pre-wrap;">{{Post.Description| limitTo: 200 }}   <span style="cursor: pointer; color: blue; font-weight: bolder;" ng-show="Post.Description.length > 200" data-toggle="modal" data-target="#ShowPostMore" ng-click="ShowPostMore(Post);">see more</span> </span>
                        <br>
                        <a ng-show="Post.Attachment" href="<?php echo base_url(); ?>uploads/userpost/{{Post.Attachment}}" target="_new" ><span class="glyphicon glyphicon-download"></span>Attachment</a>             

                    </span>
                    <hr>
                    <span style="margin: 0px; padding: 0px; cursor: pointer; color: #3c3c3c; font-weight: bolder;"  data-toggle="modal" data-target="#ShowPostMore" ng-click="ShowPostMore(Post);">Comment</span>

                </div>

            </div>

        </div>

    </div>



    <!-- Show Post More Modal -->
    <div id="ShowPostMore" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!--  Modal content-->
            <div class="modal-content">
                <div class="modal-header">

                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                    <div class="media"  style="margin-bottom: 4px; background-color: #ffffff; padding: 10px;  border-radius: 10px;">
                        <div class="media-left">
                            <img class="img-circle" src="<?php echo base_url(); ?>uploads/users/{{PostMore.UserPhoto}}" height="60" width="60" /> 
                        </div>
                        <div class="media-body">
                            <span style="color: #003399; font-weight: bolder; font-size: 14px;">{{PostMore.TeacherName}}- ({{PostMore.PostName}})</span> 
                            <br> <span class="" style="font-size: 10px; padding: 0px; margin: 0px;"> {{PostMore.Date}} </span>
                        </div>
                    </div>
                </div>
                <div class="modal-body">
                    <!--posts-->
                    <div class=""  style="margin-bottom: 4px; background-color: #ffffff; padding: 10px;  border-radius: 10px;">
                        <h4 style="padding: 0px; margin: 0px; color: #000; text-align: left; ">{{PostMore.Heading}} </h4>
                        <span > 
                            <span style="white-space:pre-wrap;">{{PostMore.Description}}</span>
                            <br>
                            <a ng-show="PostMore.Attachment" href="<?php echo base_url(); ?>uploads/userpost/{{PostMore.Attachment}}" target="_new" ><span class="glyphicon glyphicon-download"></span>Attachment</a>             
                        </span>
                    </div>
                    <hr>

                    <!--Comment List-->
                    <div>
                        <div class="media" ng-repeat="Cmnt in CommentList| filter :{PostID:PostMore.PId}"  style="margin-bottom: 0px; background-color: #e9ebee; padding: 5px;  border-radius: 10px;">
                            <div class="media-left">
                                <img class="img-circle" src="<?php echo base_url(); ?>uploads/students/{{Cmnt.Photo}}" height="25" width="25" /> 
                            </div>
                            <div class="media-body">
                                <span class="" style="font-size: 13px; font-weight: bolder; color: blue; padding: 0px; margin: 0px;"> {{Cmnt.FullName}} </span>
                                <span class="" style="font-size: 10px; padding: 0px; margin: 0px;"> {{Cmnt.Date}} </span>
                                <br> <span class="" style="font-size: 13px; padding: 0px; margin: 0px;"> {{Cmnt.Comment}} </span>
                                <span ng-show="Cmnt.StudentID ==<?php echo $_SESSION["StudentID"]; ?>" class="pull-right glyphicon glyphicon-remove-sign" ng-click="DeleteComment(Cmnt.CID, Cmnt.PostID)"></span>
                            </div>
                        </div>
                    </div>
                    <!--Comment Box-->
                    <div >
                        <div class="input-group">
                            <textarea class="form-control" style="width: 100%" ng-model="PostMore.Comment" ></textarea>
                            <span class="input-group-addon"><button  ng-click="SubmitComment(PostMore.Comment, PostMore.PId)">&Lsh;</button></span>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Student view Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" >
        <div class="modal-dialog" role="document" style="width:950px;">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="col-md-8">
                        <h4 class="modal-title btn btn-success" id="myModalLabel"><span style=""><?php echo $Info->FullName; ?> </span> (Student ID: <?php echo $Info->StudentInsID; ?>[Running Semester: <?php echo $Info->SemesterName; ?> ]</h4>
                    </div>
                    <div class="col-md-4">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>


                    </div>
                </div>
                <div class="modal-body">

                    <div class="row">

                        <div class="col-md-10">
                            <h4 class="adminheading">Academic Info </h4>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="Detail">Batch: </label>
                                    <?php echo $Info->BatchName; ?>
                                </div> 
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="Detail">Faculty: </label>
                                    <?php echo $Info->FacultyName; ?> 
                                </div> 
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="Detail">Session: </label>
                                    <?php echo $Info->SessionName; ?>
                                </div> 
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="Detail">Reg No: </label>
                                    <?php echo $Info->RegNo; ?>
                                </div> 
                            </div>




                        </div>
                        <div class="col-md-2">

                            <img ng-src="<?php echo base_url() . "uploads/students/" . $Info->Photo; ?>" style="width: 80px; height: 80px;"/>

                        </div> 
                    </div>

                    <div class="row panel">

                        <div class="col-md-6" style="overflow: scroll;">
                            <h4 class="adminheading"> Student Attendance info</h4>

                            <div class="row">
                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="form_control_1">
                                        Last CGPA :

                                    </label>
                                    <div class="col-md-9" style="color: red;">
                                        <?php echo $Info->LastCGPA; ?> 
                                        <div class="form-control-focus"> </div>

                                    </div>
                                </div>
                            </div>

                        </div>


                    </div> 

                    <div class="row">
                        <h4 class="adminheading">Basic Info</h4>
                        <div class="col-md-3">
                            <table class="table">

                                <tr>
                                    <td> <label for="Detail">SMS Number </label>  </td>
                                    <td>   <?php echo $Info->SMSNotificationNo; ?>  </td>
                                </tr>
                                <tr>
                                    <td> <label for="Detail">Gender </label>   </td>
                                    <td>   <?php echo $Info->GenderName; ?>  </td>
                                </tr>

                                <tr>
                                    <td> <label for="Detail">Date Of Birth </label>   </td>
                                    <td>   <?php echo $Info->DateOfBirth; ?>   </td>
                                </tr>
                                <tr>
                                    <td>   <label for="Detail">Blood Group </label> </td>
                                    <td>   <?php echo $Info->BloodGroupName; ?> </td>
                                </tr>
                                <tr>
                                    <td> <label for="Detail">Religion </label></td>
                                    <td>   <?php echo $Info->ReligionName; ?>  </td>
                                </tr>
                                <tr>
                                    <td>    <label for="Detail">Nationality </label> </td>
                                    <td>  <?php echo $Info->Nationality; ?>  </td>
                                </tr>
                            </table>

                        </div>
                        <div class="col-md-3">
                            <table class="table">
                                <tr>
                                    <td>  <label for="Detail">Father Name </label></td>
                                    <td> <?php echo $Info->FatherName; ?>  </td>
                                </tr>
                                <tr>
                                    <td>  <label for="Detail"> Mobile: </label></td>
                                    <td> <?php echo $Info->FatherMobile; ?>  </td>
                                </tr>

                                <tr>
                                    <td>  <label for="Detail">Mother Name </label></td>
                                    <td> <?php echo $Info->MotherName; ?>  </td>
                                </tr>
                                <tr>
                                    <td>  <label for="Detail"> Mobile: </label></td>
                                    <td> <?php echo $Info->MotherMobile; ?>  </td>
                                </tr>
                            </table>

                            <table class="table">
                                <tr>
                                    <td> <label>Address </label></td>
                                </tr>
                                <tr>
                                    <td>   

                                        <b>Present</b> : <?php echo $Info->PreAddress . ',' . $Info->PreThana . ',' . $Info->PreZilaName; ?>   

                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <b>Permanent</b> :  <?php echo $Info->ParAddress . ',' . $Info->ParThana . ',' . $Info->parZilaName; ?>     
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
                                        <td><?php echo $Info->ssc_year; ?>  </td>
                                    </tr>
                                    <tr>
                                        <td>   <label for="Detail">Board </label></td>
                                        <td> <?php echo $Info->SSCBoardName; ?>  </td>
                                    </tr>
                                    <tr>
                                        <td>   <label for="Detail">Roll </label>          </td>
                                        <td> <?php echo $Info->ssc_roll; ?>  </td>
                                    </tr>
                                    <tr>
                                        <td>   <label for="Detail">GPA </label>      </td>
                                        <td> <?php echo $Info->ssc_gpa; ?> </td>
                                    </tr>
                                </table>

                            </div>

                            <div class="col-md-6">
                                <h4 class="adminheading">HSC</h4>
                                <table class="table table-hover">
                                    <tr>
                                        <td>  <label for="Detail">Year </label></td>
                                        <td> <?php echo $Info->hsc_year; ?>  </td>
                                    </tr>
                                    <tr>
                                        <td>   <label for="Detail">Board </label></td>
                                        <td><?php echo $Info->HSCBoardName; ?>   </td>
                                    </tr>
                                    <tr>
                                        <td>   <label for="Detail">Roll </label>          </td>
                                        <td> <?php echo $Info->hsc_roll; ?>  </td>
                                    </tr>
                                    <tr>
                                        <td>   <label for="Detail">GPA </label>      </td>
                                        <td> <?php echo $Info->hsc_gpa; ?> </td>
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

    <!-- Classmates view Modal -->
    <div id="myClassmatesModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!--  Modal content-->
            <div class="modal-content">
                <div class="modal-header">

                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Classmates</h4>
                </div>
                <div class="modal-body">


                    <table class="table">
                        <tr>
                            <th>Photo  </td>
                            <th>Name  </td>
                            <!--//<th> RegNo </td>-->
                            <th> Blood </td>
                            <th>DOB</th>

                        </tr>
                        <tr ng-repeat="CM in ClassMates">
                            <td><img ng-src="<?php echo base_url() . "uploads/students/"; ?>{{CM.Photo}}" style="width: 40px; height: 40px;"/></td>
                            <td>{{CM.FullName}}  </td>
                           <!--// <td> {{CM.RegNo}}  </td>-->
                            <td> {{CM.BloodGroup}}  </td>
                            <td><span ng-hide="CM.DateOfBirth == '0000-00-00'">{{CM.DateOfBirth| date:'MMM/dd'}}</span></td>

                        </tr>
                    </table>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

     <!-- Result view Modal -->
    <div id="myResultModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!--  Modal content-->
            <div class="modal-content">
                <div class="modal-header">

                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Result Pdf Files</h4>
                </div>
                <div class="modal-body">

                        <table class="table table-striped">
            <tr>
                <!--<th>SN</th>-->
                <th>Faculty </th>       
                <th>Semester </th>  
                <!--<th>Description </th>-->      
                <th>Year </th>  
                <th>Publish Date </th>
                <th>Comment</th>
                <th>Attachment </th> 
               
            </tr>
            <tr ng-repeat="r in AllResult">             
                <td>{{r.FacultyName}} </td>
                <td>{{r.SemesterID}} </td>
                <td>{{r.Year}} </td>
                <td>{{r.PublishDate}} </td>
                <td>{{r.Comment}}</td>
               <!--<td><span style="white-space:pre-wrap;">{{Post.Description| limitTo: 200}}</span> </td>-->
                <td> <a href="<?php echo base_url(); ?>uploads/ResultPdf/{{r.File}}" target="_new" >Attachment</a> </td>              

            </tr>
        </table>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Library view Modal -->
    <div id="myBookLibraryModal" class="modal fade" role="dialog">
        <div class="modal-dialog" >

            <!--  Modal content-->
            <div class="modal-content" >
                <div class="modal-header">

                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Book Library</h4>
                </div>
                <div class="modal-body" >

                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#home"  >Book List</a></li>
                        <li><a data-toggle="tab" href="#Request" ng-click="GetRequestedAllBook();">Request List</a></li>
                        <li><a data-toggle="tab" href="#Received" ng-click="GetDeliveredAllBookForStudent();">Received Book</a></li>
                        <li><a data-toggle="tab" href="#Cancel" ng-click="GetReturnedAllBook();">Returned Books</a></li>
                    </ul>

                    <div class="tab-content">
                        <div id="home" class="tab-pane fade in active">
                            <div class="form-group col-md-5">
                                <label for="Exam" >Category</label>
                                <select class="form-control"  ng-model="BookSearch.Subject"  ng-options="Medium.Id as Medium.Name for Medium in AllField.BookCategory">
                                    <option value="">Choose Option</option>
                                </select>
                            </div>
                            <div class="form-group col-md-5">
                                <label for="Exam" >Book Name</label>
                                <input class="form-control" type="text"  ng-model="BookSearch.BookName"  />
                                 
                            </div>
                            <div class="form-group col-md-2">
                                <label for="Exam" >&nbsp;</label>
                                <button type="Submit" ng-click="GetAllBook();" class="btn btn-info" name="Create" id="Create">Search</button>
                            </div>
                            <table class="table table-striped">
                                <tr>
                                    <!--<th>SN</th>-->
                                    <th>Book Name  </th> 
                                    <th>Addition </th> 
                                    <!--<th>Quantity </th>--> 

                                    <th> Medium </th> 
                                    <th>Category </th> 
                                    <th>Available </th> 
                                    <th>Action </th>
                                </tr>
                                <tr ng-repeat="Book2 in AllBook">
                                    <!--<td>{{$index + 1}} </td>-->
                                    <td><span>{{Book2.BookName}} </span> - <span style="font-size: 12px; color: #419641;">  {{Book2.Description}}</span> <br>(<span style="color: crimson; font-size: 11px;"> {{Book2.Writer}}</span>) </td>
                                    <td>{{Book2.Addition}} </td>
                                    <!--<td>{{Book2.Quantity}} </td>-->

                                    <td>{{Book2.BookMedium}} </td>
                                    <td>{{Book2.BookCategory}} </td>
                                    <td>{{Book2.Available}} </td>

                                    <td>
                                        <button class="btn-small" ng-show="Book2.Available > 0"  ng-click="RequestForBook(Book2)" >Request</button>
                                        <span ng-show="Book2.Available <= 0">Not Available</span>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div id="Request" class="tab-pane fade">
                            <h3>Requested Book</h3>
                            <table class="table table-striped">
                                <tr>
                                    <!--<th>SN</th>-->
                                    <th>Book Name  </th> 
                                    <th>Addition </th> 
                                    <!--<th>Quantity </th>--> 

                                    <th> Medium </th> 
                                    <th>Category </th> 
                                    <th>Date </th> 
                                    <th>Action </th>
                                </tr>
                                <tr ng-repeat="Book3 in AllRequestedBook">
                                    <!--<td>{{$index + 1}} </td>-->
                                    <td><span>{{Book3.BookName}} </span> - <span style="font-size: 12px; color: #419641;">  {{Book3.Description}}</span> <br>(<span style="color: crimson; font-size: 11px;"> {{Book3.Writer}}</span>) </td>
                                    <td>{{Book3.Addition}} </td>
                                    <!--<td>{{Book2.Quantity}} </td>-->

                                    <td>{{Book3.BookMedium}} </td>
                                    <td>{{Book3.BookCategory}} </td>
                                    <td>{{Book3.RequestDate}} </td>

                                    <td>
                                        <button class="btn-small"   ng-click="CalcelRequestForBook(Book3.RId)" >Cancel</button>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div id="Received" class="tab-pane fade">
                            <h3>Received Book</h3>
                            <table class="table table-striped">
                                <tr>
<!--                                    <th>Name-Reg  </th> 
                                    <th>Mobile  </th> -->
                                    <th>Book Name  </th> 
                                    <th>Addition </th>   
                                    <th> Medium </th> 
                                    <th>Category </th> 
                                    <th>Date </th> 
                                    <th>Return Date </th> 

                                </tr>
                                <tr ng-repeat="Book1 in DeliveredBookList">                        
<!--                                    <td>{{Book1.FullName}}-{{Book1.RegNo}} </td>
                                    <td>{{Book1.SMSNotificationNo}}</td>-->
                                    <td><span>{{Book1.BookName}} </span> - 
                                        <span style="font-size: 12px; color: #419641;">  {{Book1.Description}}</span>
                                        <br>(<span style="color: crimson; font-size: 11px;"> {{Book1.Writer}}</span>) 
                                    </td>
                                    <td>{{Book1.Addition}} </td>

                                    <td>{{Book1.BookMedium}} </td>
                                    <td>{{Book1.BookCategory}} </td>
                                    <td>{{Book1.DeliveredDate}} </td>
                                    <td> 
                                        <span ng-show="Book1.IsOver == 1" style="color: red; font-weight: bolder;">{{Book1.ReturnDate}}</span> 
                                        <span ng-show="Book1.IsOver == 0" >{{Book1.ReturnDate}}</span> 

                                    </td>


                                </tr>
                            </table>
                        </div>
                        <div id="Cancel" class="tab-pane fade">
                            <h3>Return List</h3>
                            <table class="table table-striped">
                                <tr>
<!--                                    <th>Name-Reg  </th> -->
                                    <th>Book Name  </th> 
                                    <th>Addition </th>   
                                    <th> Medium </th> 
                                    <th>Category </th> 
                                    <th>Delivered Date </th> 
                                    <th>Return Date </th> 
                                    <!--<th>Action </th>-->
                                </tr>
                                <tr ng-repeat="Book2 in AllReturnedBook">                        
<!--                                    <td>{{Book2.FullName}}-{{Book2.RegNo}} </td>-->
                                    <td><span>{{Book2.BookName}} </span> - 
                                        <span style="font-size: 12px; color: #419641;">  {{Book2.Description}}</span>
                                        <br>(<span style="color: crimson; font-size: 11px;"> {{Book2.Writer}}</span>) 
                                    </td>
                                    <td>{{Book2.Addition}} </td>
                                    <td>{{Book2.BookMedium}} </td>
                                    <td>{{Book2.BookCategory}} </td>                      
                                    <td>{{Book2.DeliveredDate}} </td>
                                    <td>{{Book2.ReturnDate}} </td>

<!--                        <td>
                            <button class="btn-small"   ng-click="CalcelRequestForBook(Book3.RId)" >Cancel</button>
                            <button class="btn-small"   ng-click="ReturnBook(Book1.RId)" >Return Book</button>
                        </td>-->
                                </tr>
                            </table>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Routine view Modal -->
    <div id="myRoutineModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!--  Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Full Routine - {{ClassRoutines.Routine[0].Faculty}}-{{ClassRoutines.Routine[0].Semester}}</h4>
                </div>
                <div class="modal-body" style="overflow: scroll;">

                    <table class="table table-striped table-responsive">
                        <tr>

                            <th> Subject</th>
                            <th> Day</th>
                            <th> Room</th>
                            <th> Start  to End </th>
                            <th> Teacher</th>

                        </tr>
                        <tr ng-repeat="FWC in ClassRoutines.Routine">

                            <td> {{FWC.Subject}}</td>
                            <td> {{FWC.Day}}</td>
                            <td> {{FWC.Room}}</td>
                            <td><span class="label label-danger"> {{FWC.StartTime}} - {{FWC.EndTime}}</span></td>
                            <td><span class="label label-primary"> {{FWC.Teacher}} </span></td>


                        </tr>

                    </table>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Attendance view Modal -->
    <div id="myAttendanceModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!--  Modal content-->
            <div class="modal-content">
                <div class="modal-header">

                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Full Attendance</h4>
                </div>
                <div class="modal-body" style="overflow: scroll">

                    <h5>Percentage</h5>
                    <table class="table">
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
                            <th>Percent  </td>
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
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Request  view Modal -->
    <div id="RequestForBookModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!--  Modal content-->
            <div class="modal-content">
                <div class="modal-header">

                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Request For Book</h4>
                </div>
                <div class="modal-body" style="overflow: scroll">

                    This Service will come soon
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Change Password Modal -->
    <div id="myPasswordModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!--  Modal content-->
            <div class="modal-content">
                <div class="modal-header">

                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Change Password</h4>
                </div>
                <div class="modal-body">
                    <form name="PasForm" ng-submit="Changepassword()" />
                    <div class="form-group">
                        <label for="Attendance">Password</label>
                        <input type="password" class="form-control" ng-model="Pas.Password" name="Password" required/>

                    </div>
                    <div class="form-group">
                        <label for="Exam" >Re Password</label>
                        <input type="password" class="form-control" ng-model="Pas.RePassword" required name="RePassword"/>
                    </div>



                    <div class="form-group">

                        <button type="Submit" class="btn btn-info" name="Create" id="Create">Save</button>
                    </div>
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Pay History Modal -->
    <div id="myHistoryModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!--  Modal content-->
            <div class="modal-content">
                <div class="modal-header">

                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Payment History</h4>
                </div>
                <div class="modal-body">


                    <div class="col-md-12" style="text-align: center; background-color: #3c3c3c; color: #ffffff; padding: 5px;"><label>Monthly Pay:</label>  {{History.DueHistory.MonthlyPay}} &nbsp;&nbsp; <label>Due Month:</label> {{History.DueHistory.DueMonth}} &nbsp;&nbsp;&nbsp; <label>Due Money:</label> {{History.DueHistory.DueMoney}}Tk. &nbsp;&nbsp;&nbsp; <label>Deposit Money:</label>  {{History.Deposit.Deposit}}</div>      
                    <span class="col-md-12" style="text-align: center; background-color: #F1C40F; padding: 3px;"> <label>Total Paid:</label> {{History.TotalPaidAmountHistory.TotalPaidAmount}} Tk. &nbsp;&nbsp;&nbsp; <label>Total Month Paid:</label>    {{History.DueHistory.TotalMonthPaid}}&nbsp;&nbsp;&nbsp;&nbsp;<label>Total Month:</label> 
                        {{History.DueHistory.TotalMonth}}</span>
                    <table class="table table-striped">
                        <tr>
                            <th>SN</th>
                            <th>Date </th> 
                            <th>PayType </th>  
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
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

 <!--  Syllabus Modal -->
    <div id="mySyllabusModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!--  Modal content-->
            <div class="modal-content">
                <div class="modal-header">

                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Syllabus</h4>
                </div>
                <div class="modal-body">
                  <a class="btn btn-default" target="_New" href="<?php echo base_url(); ?>uploads/syllabus/CSE Full  New.pdf">CSE New</a>
        <a class="btn btn-default" target="_New" href="<?php echo base_url(); ?>uploads/syllabus/CSE FULL Old.pdf">CSE Old</a>
        <hr>
        <a class="btn btn-default" target="_New" href="<?php echo base_url(); ?>uploads/syllabus/BBA Full New.pdf">BBA New</a>
        <a class="btn btn-default" target="_New" href="<?php echo base_url(); ?>uploads/syllabus/Full Old BBA.pdf">BBA Old</a>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>



</div>

