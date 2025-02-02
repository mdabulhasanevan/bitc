
<style>

    .circle-tile {
        margin-bottom: 15px;
        text-align: center;
    }
    .circle-tile-heading {
        border: 3px solid rgba(255, 255, 255, 0.3);
        border-radius: 100%;
        color: #FFFFFF;
        height: 40px;
        margin: 0 auto -20px;
        position: relative;
        transition: all 0.3s ease-in-out 0s;
        width: 40px;
    }
    .circle-tile-heading .fa {
        line-height: 40px;
    }
    .circle-tile-content {
        padding-top: 30px;
    }
    .circle-tile-number {
        font-size: 26px;
        font-weight: 700;
        line-height: 1;
        padding: 5px 0 15px;
    }
    .circle-tile-description {
        text-transform: uppercase;
    }
    .circle-tile-footer {
        background-color: rgba(0, 0, 0, 0.1);
        color: rgba(255, 255, 255, 0.5);
        display: block;
        padding: 5px;
        transition: all 0.3s ease-in-out 0s;
    }
    .circle-tile-footer:hover {
        background-color: rgba(0, 0, 0, 0.2);
        color: rgba(255, 255, 255, 0.5);
        text-decoration: none;
    }
    .circle-tile-heading.dark-blue:hover {
        background-color: #2E4154;
    }
    .circle-tile-heading.green:hover {
        background-color: #138F77;
    }
    .circle-tile-heading.orange:hover {
        background-color: #DA8C10;
    }
    .circle-tile-heading.blue:hover {
        background-color: #2473A6;
    }
    .circle-tile-heading.red:hover {
        background-color: #CF4435;
    }
    .circle-tile-heading.purple:hover {
        background-color: #7F3D9B;
    }
    .tile-img {
        text-shadow: 2px 2px 3px rgba(0, 0, 0, 0.9);
    }

    .dark-blue {
        background-color: #34495E;
    }
    .green {
        background-color: #16A085;
    }
    .blue {
        background-color: #2980B9;
    }
    .orange {
        background-color: #F39C12;
    }
    .red {
        background-color: #E74C3C;
    }
    .purple {
        background-color: #8E44AD;
    }
    .dark-gray {
        background-color: #7F8C8D;
    }
    .gray {
        background-color: #95A5A6;
    }
    .light-gray {
        background-color: #BDC3C7;
    }
    .yellow {
        background-color: #F1C40F;
    }
    .text-dark-blue {
        color: #34495E;
    }
    .text-green {
        color: #16A085;
    }
    .text-blue {
        color: #2980B9;
    }
    .text-orange {
        color: #F39C12;
    }
    .text-red {
        color: #E74C3C;
    }
    .text-purple {
        color: #8E44AD;
    }
    .text-faded {
        color: rgba(255, 255, 255, 0.7);
    }

    //
   

</style>

<div ng-controller="ClassRoutine" class="col-md-10" style="background-color: #ffffff;">            
    <!--    <h5 class="well">Wellcome to BITC Admin Panel</h5>-->
    <h5 style="color: #d58512; border: 1px solid #003eff; padding: 5px;"><?php echo $EducationalQuote->Quote; ?> - <span style="font-size: 8px;"><?php echo $EducationalQuote->Writer; ?></span></h5> 

    <!--Counter-->
    <link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css">
    <div class="container bootstrap snippet">
        <div class="row">

            <div class="col-lg-2" style="margin-left: -15px;" >
                <div class="circle-tile ">
                    <a href="#"><div class="circle-tile-heading dark-blue"><i class="fa fa-users fa-fw fa-2x"></i></div></a>
                    <div class="circle-tile-content dark-blue">
                        <div class="circle-tile-description text-faded"> Students</div>
                        <div class="circle-tile-number text-faded "><?php echo $student ?></div>
                        <!--<a class="circle-tile-footer" href="<?php echo base_url("student/"); ?>">More Info<i class="fa fa-chevron-circle-right"></i></a>-->
                    </div>
                </div>
            </div>

            <div class="col-lg-2" style="margin-left: -15px;">
                <div class="circle-tile ">
                    <a href="#"><div class="circle-tile-heading red"><i class="fa fa-users fa-fw fa-2x"></i></div></a>
                    <div class="circle-tile-content red">
                        <div class="circle-tile-description text-faded"> Users  </div>
                        <div class="circle-tile-number text-faded "><?php echo $user ?></div>
                        <!--<a class="circle-tile-footer" href="<?php echo base_url("Service/UserList"); ?>">More Info<i class="fa fa-chevron-circle-right"></i></a>-->
                    </div>
                </div>
            </div> 

            <div class="col-lg-2" style="margin-left: -15px;">
                <div class="circle-tile ">
                    <a href="#"><div class="circle-tile-heading yellow"><i class="fa fa-puzzle-piece fa-fw fa-2x"></i></div></a>
                    <div class="circle-tile-content yellow">
                        <div class="circle-tile-description text-faded"> Research & Projects  </div>
                        <div class="circle-tile-number text-faded "><?php echo $PT ?></div>
                        <!--<a class="circle-tile-footer" href="<?php echo base_url("Service/ResearchandProjects"); ?>">More Info<i class="fa fa-chevron-circle-right"></i></a>-->
                    </div>
                </div>
            </div> 
            <div class="col-lg-2" style="margin-left: -15px;">
                <div class="circle-tile ">
                    <a href="#"><div class="circle-tile-heading dark-gray"><i class="fa fa-list fa-fw fa-2x"></i></div></a>
                    <div class="circle-tile-content dark-gray">
                        <div class="circle-tile-description text-faded"> Notice  </div>
                        <div class="circle-tile-number text-faded "><?php echo $Notice ?></div>
                        <!--<a class="circle-tile-footer" href="<?php echo base_url("Service/NewsCreate"); ?>">More Info<i class="fa fa-chevron-circle-right"></i></a>-->
                    </div>
                </div>
            </div> 
            <div class="col-lg-2" style="margin-left: -15px;">
                <div class="circle-tile ">
                    <a href="#"><div class="circle-tile-heading blue"><i class="fa fa-user fa-fw fa-2x"></i></div></a>
                    <div class="circle-tile-content blue">
                        <div class="circle-tile-description text-faded"> SOS </div>
                        <div class="circle-tile-number text-faded "><?php echo $SOS ?></div>
                        <!--<a class="circle-tile-footer" href="<?php echo base_url("Service/studentofthesemester"); ?>">More Info<i class="fa fa-chevron-circle-right"></i></a>-->
                    </div>
                </div>
            </div> 
            <div class="col-lg-2" style="margin-left: -15px;" >
                <div class="circle-tile ">
                    <a data-toggle="modal" data-target="#toDaysClasses"><div class="circle-tile-heading green"><i class="fa fa-users fa-fw fa-2x"></i></div></a>
                    <div class="circle-tile-content green">

                        <div class="circle-tile-description text-faded"> {{ToDay}} Classes</div>
                        <div class="circle-tile-number text-faded ">{{ClassRoutines.length}}</div>
                        <!--<a class="circle-tile-footer" href="<?php echo base_url("student/"); ?>">More Info<i class="fa fa-chevron-circle-right"></i></a>-->
                    </div>
                </div>
            </div>
        </div> 
    </div>  

    <div style="height: auto;" class="col-md-12">

<h2>Chart is underprocessing. show latter</h2>
        <div class="col-md-9">
            <div class="row">
                <div class="col-md-7" id="chart-container" style="height: auto;">
                    <canvas id="mycanvas"></canvas>
                </div>
                <div class="col-md-5" id="chart-container" style="height: auto;">
                    <canvas id="Gender"></canvas>
                </div>
            </div>

       


        </div>
        <div class="col-md-3" id="chart-container" style="height: auto;">
            <table class="table table-striped" style="font-size: 11px;">
                <tr>
                    <th>Faculty</th>
                    <th>Male</th>
                    <th>Female</th>
                </tr>
                <tr ng-repeat="Gneder in GetDashBoard.GenderFacultySessionWise">
                    <th>{{Gneder.FacultyName}}-{{Gneder.SessionName| limitTo: 4}}</th>
                    <th>{{Gneder.Male}}</th>
                    <th>{{Gneder.Female}}</th>
                </tr>
            </table>
        </div>




    </div>


    <!-- Add Modal -->
    <div class="modal fade" id="toDaysClasses" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" >
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" ng-click="reset()" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Todays Classes</h4>
                </div>
                <div class="modal-body">
                    <a href="<?php echo base_url("Routine/"); ?>">See All</a><br>
                    <table class="table table-striped table-responsive ">
                        <tr>                         
                            <th> Subject</th>                           
                            <th> Room</th>
                            <th> Time </th>
                            <th> Teacher</th>                          
                        </tr>
                        <tr ng-repeat="FWC in ClassRoutines">                        
                            <td> <span>{{FWC.Subject}}</span></td>                        
                            <td> {{FWC.Room}}</td>
                            <td><span class="label label-danger"> {{FWC.StartTime}} - {{FWC.EndTime}}</span></td>
                            <td><span class="label label-primary"> {{FWC.Teacher}} </span></td>                            
                        </tr>

                    </table>
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

    app.controller("ClassRoutine", ["$scope", "$http",
        function ($scope, $http) {
            init();
            function init() {
                initialize();
               GetAllClassRoutine();
                //GetDashboardFunction();
                //GenderChart();
            }
            function initialize() {
                $scope.ClassRoutines = [];
                $scope.ClassRoutine = {};
                $scope.GetDashBoard = [];
                var d = new Date()
                var weekday = new Array("Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday")
                $scope.ToDay = weekday[d.getDay()];
                
                $scope.StudentNumberChart=StudentNumberChart;
                $scope.GenderChart=GenderChart;

            }

            function GetAllClassRoutine() {
                $scope.ClassRoutines = [];
                $http({
                    method: 'GET',
                    url: baseUrl + 'Routine/AllRoutineForDashBoard/' + $scope.ToDay
                }).then(function successCallback(response) {
                    $scope.ClassRoutines = response.data;
                }, function errorCallback(response) {
                });
            }


            function GetDashboardFunction()
            {
                $scope.GetDashBoard = [];
                $http({
                    method: 'GET',
                    url: baseUrl + 'User/GetDashboard/'
                }).then(function successCallback(response) {
                    $scope.GetDashBoard = response.data;


                   // StudentNumberChart($scope.GetDashBoard);
                  //  GenderChart($scope.GetDashBoard);
                }, function errorCallback(response) {
                });
            }

            //gender chart
            function GenderChart(GetDashBoard)
            {
                var GenderList = GetDashBoard.Gender;

                var Gender = [];
                var GenderTotal = [];

                for (var i in GenderList) {
                    Gender.push(GenderList[i].Gender);
                    GenderTotal.push(GenderList[i].Total);
                }

                var ctx = document.getElementById("Gender").getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels: Gender,
                        datasets: [{
                                backgroundColor: [
                                    "#2ecc71",
                                    "#3498db",
                                    "#95a5a6",
                                    "#9b59b6",
                                    "#f1c40f",
                                    "#e74c3c",
                                    "#34495e"
                                ],
                                data: GenderTotal
                            }]
                    }
                });

            }

            function StudentNumberChart(GetDashBoard)
            {
                var AllFacultyReport = GetDashBoard.AllFacultyReport;
                var Faculty = [];
                var Total = [];

                for (var i in AllFacultyReport) {
                    Faculty.push(AllFacultyReport[i].FacultyName + AllFacultyReport[i].SessionName.substring(2, 4));
                    Total.push(AllFacultyReport[i].Total);
                }
                var chartdata = {
                    labels: Faculty,
                    datasets: [
                        {
                            label: 'Students',
                            backgroundColor: 'rgba(244, 66, 167, 0.8)',
                            borderColor: 'rgba(200, 200, 200, 0.75)',
                            hoverBackgroundColor: 'rgba(200, 200, 200, 1)',
                            hoverBorderColor: 'rgba(200, 200, 200, 1)',
                            data: Total
                        }
                    ]
                };

                var ctx = $("#mycanvas");
                var barGraph = new Chart(ctx, {
                    type: 'bar',
                    data: chartdata
                });
            }

        }]);
</script>    

