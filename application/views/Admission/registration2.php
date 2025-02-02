
<div class="col-md-10 panel panel-primary" ng-controller="StudentCtrl" style="background-color: #ffffff;"> 

    <h3 class="panel-heading">Admission Registration Form </h3>
    <?php
    if (isset($_SESSION['success'])) {
        echo "<div class='alert alert-success'>" . $_SESSION['success'] . "</div>";
    }
    ?>
    <?php
    if (isset($_SESSION['successErr'])) {
        echo "<div class='alert alert-danger'>" . $_SESSION['successErr'] . "</div>";
    }
    ?>

    <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>

    <form class="form-horizontal" id="frmCommon"  name="formCommonFeilds" action="" method="POST" enctype="multipart/form-data" >
        <div class="form-body" >
            <div class="row">
                <div class="col-md-12">
                    <h4>In Which Subject and Session you are interested to Apply???</h4>
                    <div class="form-group col-md-4 ">
                        <label class="col-md-5 control-label">
                            Subject :
                            <span class="required">*</span>
                        </label>
                        <div class="col-md-7">
                            <select class="form-control" required name="Faculty" id="Role">
                                <option value='' selected='selected'>Choose Option</option>
                                <?php
                                foreach ($field['faculty'] as $role) {

                                    echo "<option value='" . $role->FId . "'>" . $role->Name . "</option>";
                                }
                                ?>
                            </select>


                        </div>

                    </div>
                    <div class="form-group col-md-4">
                        <label class="col-md-5 control-label">
                            Session :
                            <span class="required">*</span>
                        </label>
                        <div class="col-md-7">
                            <select class="form-control" required name="SessionId" >
                                <option value='' selected='selected'>Choose Option</option>
                                <?php
                                $count = count($field['session']);
                                $i = 1;
                                foreach ($field['session'] as $role) {

                                    if ($i == $count || $i == ($count-1)) {
                                        echo "<option value='" . $role->SessionId . "'>" . $role->Session . "</option>";
                                    }
                                    $i++;
                                }
                                ?>
                            </select>

                        </div>

                    </div>
                </div>

            </div>
            <!--basic-->
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
                                        <div class="form-group" >
                                            <label class="col-md-3 control-label">
                                                Name :
                                                <span class="required">*</span>
                                            </label>
                                            <div class="col-md-9">
                                                <input type="text" ng-model="studentInfo.FullName" name="FullName" class="form-control" placeholder="Student Name"  required>
                                            </div>
                                        </div>


                                        <div class="form-group" >
                                            <label class="col-md-3 control-label">
                                                Mobile :
<!--                                                                <span class="required">*</span>-->
                                            </label>
                                            <div class="col-md-9">
                                                <input type="text" ng-model="studentInfo.SMSNotificationNo" name="Mobile" required class="form-control" placeholder="SMSNotificationNo"  >
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-md-4 ">                                                      

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group" >
                                            <label class="col-md-4 control-label">
                                                Gender :
                                                <span class="required">*</span>
                                            </label>
                                            <div class="col-md-8">

                                                <select class="form-control" required name="Gender" id="Role">
                                                    <option value='' selected='selected'>Choose Option</option>
                                                    <?php
                                                    foreach ($field['Other'] as $role) {
                                                        if ($role->Type == "Gender") {
                                                            echo "<option value='" . $role->Id . "'>" . $role->Name . "</option>";
                                                        }
                                                    }
                                                    ?>
                                                </select>


                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group" >
                                            <label class="col-md-4 control-label">
                                                Religion :
                                                <span class="required">*</span>
                                            </label>
                                            <div class="col-md-8">
                                                <select class="form-control" required name="Religion" id="Role">
                                                    <option value='' selected='selected'>Choose Option</option>
                                                    <?php
                                                    foreach ($field['Other'] as $role) {
                                                        if ($role->Type == "Religion") {
                                                            echo "<option value='" . $role->Id . "'>" . $role->Name . "</option>";
                                                        }
                                                    }
                                                    ?>
                                                </select>

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
                                                <select class="form-control" ng-model="studentInfo.IsPhysicalDrawback" name="IsPhysicalDrawback">

                                                    <option value="1">Yes</option>
                                                    <option value="0" ng-selected="true">No</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-md-4 control-label">
                                                Nationality:
                                            </label>
                                            <div class="col-md-8">
                                                <input type="text" ng-model="studentInfo.Nationality" name="Nationality" ng-value="Bangladeshi" class="form-control" placeholder="Nationality" >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group" >
                                            <label class="col-md-4 control-label">
                                                Date of Birth:
                                                <span class="required">*</span>
                                            </label>
                                            <div class="col-md-8">
                                                <input class="form-control" required id="datepicker" name="DateOfBirth"  ng-selected="calculateAge(studentInfo.DateOfBirth)" ng-model="studentInfo.DateOfBirth"  placeholder="Date of Birth"  autocomplete="off" />

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-md-4 control-label">
                                                Age:
                                            </label>
                                            <div class="col-md-8">
                                                <input type="text" ng-model="studentInfo.Age" name="Age" class="form-control" readonly="readonly  placeholder="Age">
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="row">

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

            </div>

            <!--academic-->
            <div class="portlet-body">
                <div class="panel-group accordion" id="accordion3">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a class="accordion-toggle accordion-toggle-styled" data-toggle="collapse" data-parent="#accordion3" href="#collapse_3_2"> Academic Info </a>
                            </h4>
                        </div>
                        <div id="collapse_3_2" class="panel-collapse in">
                            <div class="panel-body">
                                <div class="col-md-6">
                                    <h5>SSC</h5>
                                    <hr />

                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="form_control_1">
                                            Year :

                                        </label>
                                        <div class="col-md-9">
                                            <input type="text" name="ssc_year"  required class="form-control" ng-model="studentInfo.ssc_year">
                                            <div class="form-control-focus"> </div>

                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="form_control_1">
                                            Group :
                                        </label>
                                        <div class="col-md-9">
                                            <select class="form-control" required name="ssc_group" id="Role">
                                                <option value='' selected='selected'>Choose Option</option>
                                                <?php
                                                foreach ($field['group'] as $role) {

                                                    echo "<option value='" . $role->GroupId . "'>" . $role->Group . "</option>";
                                                }
                                                ?>
                                            </select>

                                            <div class="form-control-focus"> </div>

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="form_control_1">
                                            Board :
                                        </label>
                                        <div class="col-md-9">
                                            <select class="form-control" required name="ssc_board" id="Role">
                                                <option value='' selected='selected'>Choose Option</option>
                                                <?php
                                                foreach ($field['board'] as $role) {

                                                    echo "<option value='" . $role->ID . "'>" . $role->BoardName . "</option>";
                                                }
                                                ?>
                                            </select>

                                            <div class="form-control-focus"> </div>

                                        </div>
                                    </div>



                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="form_control_1">
                                            Roll :

                                        </label>
                                        <div class="col-md-9">
                                            <input type="text" required name="ssc_roll" class="form-control" ng-model="studentInfo.ssc_roll">
                                            <div class="form-control-focus"> </div>

                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="form_control_1">
                                            SSC Reg :

                                        </label>
                                        <div class="col-md-9">
                                            <input type="text" required name="ssc_reg" class="form-control" ng-model="studentInfo.ssc_reg">
                                            <div class="form-control-focus"> </div>

                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="form_control_1">
                                            GPA :

                                        </label>
                                        <div class="col-md-9">
                                            <input type="text" required name="ssc_gpa" class="form-control" ng-model="studentInfo.ssc_gpa">
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
                                            <input type="text" class="form-control" required name="hsc_year" ng-model="studentInfo.hsc_year">
                                            <div class="form-control-focus"> </div>

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="form_control_1">
                                            Group :
                                        </label>
                                        <div class="col-md-9">
                                            <select class="form-control" required name="hsc_group" id="Role">
                                                <option value='' selected='selected'>Choose Option</option>
                                                <?php
                                                foreach ($field['group'] as $role) {

                                                    echo "<option value='" . $role->GroupId . "'>" . $role->Group . "</option>";
                                                }
                                                ?>
                                            </select>

                                            <div class="form-control-focus"> </div>

                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="form_control_1">
                                            Board :

                                        </label>
                                        <div class="col-md-9">

                                            <select class="form-control" required name="hsc_board" id="Role">
                                                <option value='' selected='selected'>Choose Option</option>
                                                <?php
                                                foreach ($field['board'] as $role) {

                                                    echo "<option value='" . $role->ID . "'>" . $role->BoardName . "</option>";
                                                }
                                                ?>
                                            </select>

                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="form_control_1">
                                            Roll :

                                        </label>
                                        <div class="col-md-9">
                                            <input type="text" required name="hsc_roll" class="form-control" ng-model="studentInfo.hsc_roll">
                                            <div class="form-control-focus"> </div>

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="form_control_1">
                                            HSC Reg :

                                        </label>
                                        <div class="col-md-9">
                                            <input type="text" required name="hsc_reg" class="form-control" ng-model="studentInfo.hsc_reg">
                                            <div class="form-control-focus"> </div>

                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="form_control_1">
                                            GPA :

                                        </label>
                                        <div class="col-md-9">
                                            <input type="text" required name="hsc_gpa" class="form-control" ng-model="studentInfo.hsc_gpa">
                                            <div class="form-control-focus"> </div>

                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

            <!--            //Contact
                        <div class="tab-pane " id="contInfo">
                            <div class="panel panel-info">
                                <div class="panel-heading">Address info</div>
                                <div class="panel-body">
            
                                    <div class="col-md-6">
                                        <h5>Present Address</h5>
                                        <hr />
                                        <div class="form-group">
                                            <label class="col-md-3 control-label" for="form_control_1">
                                                Address :
            
                                            </label>
                                            <div class="col-md-9">
                                                <textarea class="form-control" required name="PreAddress" ng-model="studentInfo.PreAddress"></textarea>
            
                                                <div class="form-control-focus"> </div>
            
                                            </div>
                                        </div>
            
            
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">
                                                District :
            
                                            </label>
            
            
                                            <div class="col-md-9">
                                                <select class="form-control" required name="PreZila"  ng-model="studentInfo.PreZila" ng-options="studentInfo.DistrictId as studentInfo.DistrictName for studentInfo in preDistrict" ng-change="getPStations1()">
                                                    <option value="" selected="selected">Choose Option</option>
                                                </select>
                                                <div class="form-control-focus"> </div>
            
                                            </div>
                                        </div>
            
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">
                                                Upozila :
            
                                            </label>
            
            
                                            <div class="col-md-9">
                                                <select class="form-control" required name="PreThana" ng-model="studentInfo.PreThana" ng-options="studentInfo.PsId as studentInfo.PsName for studentInfo in preThana | filter: { DistrictId: studentInfo.PreZila }">
                                                    
                                                    <option value="" selected="selected">Choose Option</option>
                                                </select>
                                               
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
                                                <textarea class="form-control" required name="ParAddress" ng-model="studentInfo.ParAddress"></textarea>
            
                                                <div class="form-control-focus"> </div>
            
                                            </div>
                                        </div>
            
            
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">
                                                District :
            
                                            </label>
            
            
                                            <div class="col-md-9">
                                                <select class="form-control" required name="ParZila" ng-model="studentInfo.ParZila" ng-options="studentInfo.DistrictId as studentInfo.DistrictName for studentInfo in parDistrict" >
                                                    <option value="" selected="selected">Choose Option</option>
                                                </select>
                                                <div class="form-control-focus"> </div>
            
                                            </div>
                                        </div>
            
            
            
            
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">
                                                Upozila :
            
                                            </label>
            
            
                                            <div class="col-md-9">
                                                <select class="form-control" required name="ParThana" ng-model="studentInfo.ParThana" ng-options="studentInfo.PsId as studentInfo.PsName for studentInfo in parThana | filter: { DistrictId: studentInfo.ParZila }">
                                                    <option value="" selected="selected">Choose Option</option>
                                                </select>
                                                <div class="form-control-focus"> </div>
            
                                            </div>
                                        </div>
            
            
                                    </div>
            
                                </div>
                            </div>
                        </div>-->

            <!--Photo-->
            <div class="portlet-body">
                <div class="panel-group accordion" id="accordion3">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a class="accordion-toggle accordion-toggle-styled" data-toggle="collapse" data-parent="#accordion3" href="#collapse_3_1"> Photo Upload </a>
                            </h4>
                        </div>
                        <div id="collapse_3_1" class="panel-collapse in">
                            <div class="panel-body">
                                <div class="form-group col-md-6">
                                    <label for="Photo">Photo</label>
                                    <input type="file" id="image-file"  accept="image/png, image/jpeg" data-max-size="200" required class="form-control" name="Photo" id="Photo"/>


                                </div>  
                                <div class="form-group col-md-6">
                                    <p>*** Photo height width Must have to be less than 300/300 and Size less than 200 kb. Otherwise Application will be invalid. </p>
                                </div>  

                            </div>
                        </div>
                    </div>

                </div>

            </div>



            <div class="form-group col-md-3 pull-right">
                <button type="submit" name="Signup" class="btn green">Submit</button>

            </div>



        </div>
    </form>










</div>














<script type="text/javascript">

    app.controller("StudentCtrl", ["$scope", "$http",
        function ($scope, $http) {
            init();
            function init() {
                initialize();
                // GetAllCommonField();
            }
            function initialize() {

                $scope.studentInfo = {};
                $scope.studentInfo.StudentInsID = '';
                // $scope.studentInfo.StudentID = 0;
                $scope.StudentIID = 1;
                $scope.StudentInfos = [];
                $scope.Dropdowns = [];
                $scope.CommonFeilds = [];

                //  $scope.GetAllCommonField = GetAllCommonField;
                $scope.CommonFeilds = [];
                $scope.isGroup = 0;

                $scope.GenerateIDAndSave = GenerateIDAndSave;

            }

            //age calculate
            $scope.calculateAge = function calculateAge(birthday) { // birthday is a date
                var birthday = new Date(birthday);
                var today = new Date();
                var age = ((today - birthday) / (31557600000));
                var age = Math.floor(age);
                $scope.studentInfo.Age = age;
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
                    url: baseUrl + 'Home/GetAllCommonField/'
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
                var CollegeRoll = $scope.studentInfo.CollegeRoll;
                var Faculty = $scope.studentInfo.Faculty;
                var SessionId = $scope.studentInfo.SessionId;


                $http({
                    method: 'GET',
                    url: baseUrl + 'Student/CheckRoll/' + CollegeRoll + '/' + Faculty + '/' + SessionId
                }).then(function successCallback(response) {
                    if (response.data > 0)
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