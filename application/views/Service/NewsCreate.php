<div ng-controller="SchoolCtrl" class="col-md-10" style="background-color: #ffffff;">
               
        <div class="col-md-6">
              <h2>Create  News</h2>
                 
                    <?php
                    if(isset($_SESSION['success']))
                    {
                        echo "<div class='alert alert-success'>".$_SESSION['success']."</div>";       
                    }
                    ?>
                    
                    <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>
                    
                    <form action="" method="POST" enctype="multipart/form-data" />
               <div class="form-group">
                   <label for="Headline" >Headline</label>
                   <input class="form-control" value='<?php echo $Headline; ?>' name="Headline" id="Headline"/>
               </div>
               <div class="form-group">
                   <label for="Detail">Detail</label>
                   <textarea class="form-control" name="Detail" id="Detail">
<?php echo $Detail; ?>
                   </textarea>
               </div>
               <div class="form-group">
                   <label for="Attachment">Attachment</label>
                   <input type="file" class="form-control" name="Attachment" id="Attachment"/>
               </div>
               
                  <div class="form-group">
                   <label for="Detail">Type</label>
                   <select name="Type" class="form-control">
                       <option value="General"> General</option>
                        <option value="Principal"> Principal </option>
                       <option value="Admission"> Admission</option>
                       <option value="Breaking"> Breaking</option>
                       <option value="Other"> Other</option>
                   </select>
               </div>      
                 <div class="form-group">
                  
                     <button class="btn-info" name="Create" id="Create">Create</button>
               </div>
               </form>
               
        </div>
        <!--List of breaking news-->
        <br>
        <div class="col-md-6" style="overflow: scroll; height: 500px;">
           <!--<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button>-->
           <table class="table table-bordered" >
                <tr>
                    <th>SN</th>
                    <th>Headline </th>
                     <th>Date </th>
                    <th>Type </th>
                     <th>File </th>
                     <th>Action </th>
                </tr>
                <tr ng-repeat="News in AllNews">
                    <td>{{$index+1}} </td>
                    <td>{{News.Headline}} </td>
                  
                    <td>{{News.Date}} </td>
                    <td>{{News.NewsType}} </td>
                    <td><a ng-show="News.Other" href='<?php echo base_url(); ?>uploads/{{News.Other}}' target='_New'>file</a>  </td>
                    <td><button class="btn btn-sm btn-danger" ng-click="DeleteNews(News.BrId,News.Other)" >Delete</button>
                        <button ng-show="News.IsHide==0" class="btn btn-sm btn-info" ng-click="HideNews(News.BrId, News.IsHide)" >Hide</button>
                        <button ng-show="News.IsHide==1" class="btn btn-sm btn-default" ng-click="HideNews(News.BrId, News.IsHide)" >Show</button>
                    </td>
                </tr>

            </table>
            
        </div>
        
        <!-- Add Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Modal Header</h4>
      </div>
      <div class="modal-body">
        <p>Some text in the modal.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
        <!--modal end-->
        
     </div>
    </body>
</html>

<script type="text/javascript">
 
            app.controller("SchoolCtrl", ["$scope", "$http", 
              function ($scope, $http) {
                  init();
                  function init() {
                      initialize();
                       GetAllNews();

                  }
                  function initialize() {
                    $scope.AllNews=[];
                    $scope.News={};
                    $scope.DeleteNews=DeleteNews;
                    $scope.HideNews=HideNews;
                  }
                  
//                   function GetAllNews(){
//                       $scope.AllNews=[];
//			$http.get("<?= base_url('Service/GetAllNews'); ?>")
//			.success(function(data){
//		       $scope.AllNews = data;
//                       
//			})
//                    };
                    
                    function GetAllNews() {
                      $scope.AllNews=[];

                      $http({
                          method: 'GET',
                          url: baseUrl+'Service/GetAllNews/'
                      }).then(function successCallback(response) {
                          $scope.AllNews = response.data;
                      }, function errorCallback(response) {
                      });
                  };
                    
                    function DeleteNews(id,file)
                    {
                        var BrId=id;
                       var File=file;
                          var r = confirm("Do you want to Delete!");
                            if (r == true) {
                              $http({
                                  method: 'GET',
                                  url: baseUrl + 'Service/DeleteNews/' + BrId+'/'+File
                              }).then(function successCallback(response) {
                                  GetAllNews();
                                 
                              }, function errorCallback(response) {
                                 
                              });

                          }
                      }

                      function HideNews(BrId,IsHide)
                      {
                           $http({
                                  method: 'GET',
                                  url: baseUrl + 'Service/HideNews/' + BrId+'/'+IsHide
                              }).then(function successCallback(response) {
                                  GetAllNews();
                                 
                              }, function errorCallback(response) {
                                 
                              });
                      }
                    
                  }]);
 </script>
