<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->

<div class="col-md-2">

    <div class="row" style="margin-left: 1px; background-color: white; min-height: 300px;">
        <div class="col-md-12" style="min-height: 200px; ">
            <h5 style="text-align: center;  background-color: #222; color: white; padding: 2px; margin: 0px;">Official Notice</h5>

            <!--            <marquee behavior="scroll" direction="up" scrolldelay="250" onmouseover="this.stop();" onmouseout="this.start();" style="text-align:center; height:250px; line-height:normal;">-->

            <ul style="margin-left:-20px; font-size: 12px; padding-top: 3px;" ng-repeat="News in rowAll">
                <li style='margin-left:-0px; text-align:left;'><a href='<?php echo base_url('Home/NoticeOpen/'); ?>{{ News.BrId}}' target="_new" title='' ><b>{{News.Headline}} </b></a></li>

            </ul>
            <!--</marquee>-->
        </div>

    </div>
</div>
<div class="fixed" style=" position: fixed;  bottom: 0;  right: 0;">
    <a href="https://www.expresstechbd.com"> <img src="<?php echo base_url("dist/img/logoExp.JPG"); ?>" style="width: 120px;height: 30px;"/></a>
</div>
</div>

</div>

</body>
</html>
<script type="text/javascript">

    app.controller("StudentLoginCtrl", ["$scope", "$http",
        function ($scope, $http) {
            init();
            function init() {
                initialize();

                GetAllNotice();
                GetAllPost();
                GetAllClassRoutine();
                GetAllCommon();
               // GetAllCommonField();
                GetAllCommonField();

            }
            function initialize() {
                $scope.ClassRoutines = [];
                $scope.ClassRoutine = {};
                $scope.rowAll = [];
                $scope.GetAllClassMates = GetAllClassMates;
                $scope.ClassMates = [];
                $scope.Changepassword = Changepassword;
                $scope.Pas = {};
                $scope.AllCommon = [];

                $scope.AllPost = [];

                //$scope.GetAllClassRoutine = GetAllClassRoutine;
                $scope.AttendanceSingle = AttendanceSingle;

                var d = new Date();
                var weekday = new Array("Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday")
                $scope.ToDay = weekday[d.getDay()];


                $scope.GetPayHistory = GetPayHistory;
                $scope.History = [];

                $scope.ShowPostMore = ShowPostMore;
                $scope.PostMore = {};

                $scope.SubmitComment = SubmitComment;
                $scope.CommentList = [];
                $scope.DeleteComment = DeleteComment;
                $scope.AllBook = [];

                $scope.RequestForBook = RequestForBook;
                $scope.GetRequestedAllBook = GetRequestedAllBook;
                $scope.CalcelRequestForBook = CalcelRequestForBook;
                $scope.GetDeliveredAllBookForStudent = GetDeliveredAllBookForStudent;
                $scope.GetReturnedAllBook = GetReturnedAllBook;
                $scope.AllReturnedBook = [];

                $scope.GetAllBook = GetAllBook;
                $scope.DeliveredBookList = [];

                $scope.CurrentDate = new Date();

                $scope.GetAllCommonField = GetAllCommonField;
                $scope.AllField = [];

                $scope.BookSearch = {};
                $scope.BookSearch.Subject = 0;
                $scope.BookSearch.BookName = null;

                $scope.GetAllResultPdf = GetAllResultPdf;
                $scope.AllResult = [];
            }


            function GetAllBook()
            {
                $scope.AllBook = [];
                $http({
                    method: 'POST',
                    url: baseUrl + 'StudentApp/GetAllBookList/',
                    headers: {'Content-Type': 'application/json'},
                    data: JSON.stringify($scope.BookSearch)

                }).then(function successCallback(response) {
                    $scope.AllBook = response.data;
                }, function errorCallback(response) {
                });
            }

            function GetAllResultPdf()
            {
                $scope.AllResult = [];
                $http({
                    method: 'GET',
                    url: baseUrl + 'StudentApp/GetAllResultPdf/'
                }).then(function successCallback(response) {
                    $scope.AllResult = response.data;
                    console.log($scope.AllResult);
                }, function errorCallback(response) {
                });
            }
            function GetDeliveredAllBookForStudent()
            {
                $scope.DeliveredBookList = [];
                $http({
                    method: 'GET',
                    url: baseUrl + 'StudentApp/GetDeliveredAllBookForStudent/'
                }).then(function successCallback(response) {
                    $scope.DeliveredBookList = response.data;
                }, function errorCallback(response) {
                });
            }

            function GetReturnedAllBook()
            {
                $scope.AllReturnedBook = [];
                $http({
                    method: 'GET',
                    url: baseUrl + 'StudentApp/GetReturnedAllBook/'
                }).then(function successCallback(response) {
                    $scope.AllReturnedBook = response.data;

                }, function errorCallback(response) {
                });
            }

            function GetRequestedAllBook()
            {
                $scope.AllRequestedBook = [];
                $http({
                    method: 'GET',
                    url: baseUrl + 'StudentApp/GetRequestedAllBook/'
                }).then(function successCallback(response) {
                    $scope.AllRequestedBook = response.data;
                }, function errorCallback(response) {
                });
            }

            function CalcelRequestForBook(RId)
            {
                var r = confirm("Are you sure want to cancel??");
                if (r)
                {
                    $http({
                        method: 'GET',
                        url: baseUrl + 'StudentApp/CalcelRequestForBook/' + RId
                    }).then(function successCallback(response) {
                        GetRequestedAllBook();
                        swal("Request Deleted", "Book");
                    }, function errorCallback(response) {
                    });
                }

            }
            function RequestForBook(Book)
            {
                var BId = Book.BId;
                $http({
                    method: 'GET',
                    url: baseUrl + 'StudentApp/RequestForBook/' + BId
                }).then(function successCallback(response) {
                    $scope.Result = response.data;
                    console.log($scope.Result);
                    if ($scope.Result.status == 1)
                    {
                        GetAllBook();
                        swal("Request Successfull", "Book");
                    }
                    else
                    {
                        swal("May be you Already Cross the Limit (2 Books) or Requested for same Book", "Book");
                    }

                }, function errorCallback(response) {
                });
            }

            function SubmitComment(Comment, PId)
            {
                if (Comment.length >= 1)
                {
                    $scope.CommentVariable = {};
                    $scope.CommentVariable.Comment = Comment;
                    $scope.CommentVariable.PId = PId;
                    //console.log($scope.CommentVariable);
                    $http({
                        method: 'POST',
                        url: baseUrl + 'StudentApp/SubmitComment/',
                        headers: {'Content-Type': 'application/json'},
                        data: JSON.stringify($scope.CommentVariable)
                    }).then(function successCallback(response) {
                        $scope.PostMore.Comment = "";

                        $scope.CommentList = response.data;
                        //console.log(response.data);
                    }, function errorCallback(response) {
                    });
                }
//                else
//                {
//                    alert("Null Not Allowed.");
//                }
            }

            function ShowPostMore(Post)
            {
                $scope.PostMore = Post;
                $http({
                    method: 'GET',
                    url: baseUrl + 'StudentApp/GetCommentSinglePost/' + $scope.PostMore.PId
                }).then(function successCallback(response) {
                    $scope.CommentList = response.data;
                }, function errorCallback(response) {
                });

            }

            function DeleteComment(CID, PostID)
            {
                var r = confirm("Do you want to delete seriously???");

                if (r == true)
                {
                    $http({
                        method: 'GET',
                        url: baseUrl + 'StudentApp/DeleteComment/' + CID + '/' + PostID
                    }).then(function successCallback(response) {
                        $scope.CommentList = response.data;
                    }, function errorCallback(response) {
                    });
                }
            }

            function GetAllPost()
            {
                $scope.AllPost = [];
                $http({
                    method: 'GET',
                    url: baseUrl + 'StudentApp/GetAllPost/'
                }).then(function successCallback(response) {
                    $scope.AllPost = response.data;
                }, function errorCallback(response) {
                });
            }
            function GetAllCommon()
            {
                $scope.AllCommon = [];
                $http({
                    method: 'GET',
                    url: baseUrl + 'StudentApp/GetAllCommon/'
                }).then(function successCallback(response) {
                    $scope.AllCommon = response.data;
                    console.log($scope.AllCommon);
                }, function errorCallback(response) {
                });
            }


            function GetAllClassRoutine() {
                $scope.ClassRoutines = [];
                var id = "<?php echo $_SESSION["StudentID"]; ?>";
                $http({
                    method: 'GET',
                    url: baseUrl + 'StudentApp/GetAllClassRoutineFacultyWise/' + id
                }).then(function successCallback(response) {
                    $scope.ClassRoutines = response.data;
                    //console.log($scope.ClassRoutines);
                }, function errorCallback(response) {
                });
            }

            function AttendanceSingle()
            {
                var id = "<?php echo $_SESSION["StudentID"]; ?>";
                $scope.Attendances = [];
                $http({
                    method: 'GET',
                    url: baseUrl + 'StudentApp/GetSingleAttendance/' + id
                }).then(function successCallback(response) {
                    $scope.Attendances = response.data;
                    //  console.log($scope.Attendances);
                }, function errorCallback(response) {
                });
            }

            function GetAllNotice() {

                $http({
                    method: 'GET',
                    url: baseUrl + 'StudentApp/AllNitice/'
                }).then(function successCallback(response) {
                    $scope.rowAll = response.data;
                }, function errorCallback(response) {
                });
            }

            function GetAllClassMates() {
                $scope.ClassMates = [];
                var id = "<?php echo $_SESSION["StudentID"]; ?>";

                $http({
                    method: 'GET',
                    url: baseUrl + 'StudentApp/AllClassMates/' + id
                }).then(function successCallback(response) {
                    $scope.ClassMates = response.data;
                    // console.log($scope.ClassMates);
                }, function errorCallback(response) {
                });
            }

            function Changepassword()
            {
                var r = confirm("Are you want to Change Password");

                if (r == true)
                {
                    if ($scope.Pas.Password == $scope.Pas.RePassword && $scope.Pas.Password.length >= 6)
                    {
                        $http({
                            method: 'POST',
                            url: baseUrl + 'StudentApp/Changepassword/',
                            headers: {'Content-Type': 'application/json'},
                            data: JSON.stringify($scope.Pas)

                        }).then(function successCallback(response) {
                            $scope.Result = response.data;
                            //  console.log($scope.Result);
                            if ($scope.Result)
                            {
                                $('#myPasswordModal').modal('toggle');
                                swal("Successfully Updated", "Password");
                            }
                        }, function errorCallback(response) {
                        });

                        $scope.Pas = {};
                    }
                    else {
                        alert("Password Not Match or Password less than 6");
                    }

                }
            }


            //history
            function GetPayHistory()
            {
                var Id = "<?php echo $_SESSION["StudentID"]; ?>"
                $http({
                    method: 'GET',
                    url: baseUrl + 'StudentApp/GetPayHistory/' + Id
                }).then(function successCallback(response) {
                    // console.log(response.data);
                    $scope.History = response.data;

                }, function errorCallback(response) {
                });
            }

            function GetAllCommonField()
            {
                $http({
                    method: 'GET',
                    url: baseUrl + 'StudentApp/GetAllCommonField/'
                }).then(function successCallback(response) {
                    console.log(response.data);
                    $scope.AllField = response.data;
                }, function errorCallback(response) {

                });
            }
        }]);
</script>    

