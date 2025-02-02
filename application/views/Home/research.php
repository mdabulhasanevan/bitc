 <div class="col-md-10 panel panel-primary"  ng-app="myApp" ng-controller="ResearchCtrl"> 
        <h3 class="panel-heading"><?php echo $Title; ?></h3>

       <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#Research">Research</a></li>
        <li><a data-toggle="tab" href="#Projects">Projects</a></li>
    </ul>

    <div class="tab-content">
        <div id="Research" class="tab-pane fade in active">
            <hr>
            <!--sub tab list--> 
            <duv class="col-md-3">
                    <ul class="list-group tab">
                <li class="list-group-item"><a data-toggle="tab" href="#MyResearch">Our Research</a></li>
                <li class="list-group-item"><a data-toggle="tab" href="#Optimization">Optimization</a></li>
                <li class="list-group-item"><a data-toggle="tab" href="#CloudComputing">Cloud Computing</a></li>
                <li class="list-group-item"><a data-toggle="tab" href="#ImageProcessingandPatternRecognition">Image Processing and Pattern Recognition</a></li>
                <li class="list-group-item"><a data-toggle="tab" href="#InformationRetrieval">Information Retrieval</a></li>
                <li class="list-group-item"><a data-toggle="tab" href="#WirelessNetworkandSecurity">Wireless Network and Security</a></li>
                <li class="list-group-item"><a data-toggle="tab" href="#SoftwareEngineering">Software Engineering</a></li>
            </ul>
            </duv>

            <div class="col-md-9 tab-content">
                 <div id="MyResearch" class="tab-pane fade in active">
                    <h3>Our Research</h3>
                                <table class="table table-bordered">
            <tr>
                <th>SN</th>
                <th>Headline </th>
                <th>Detail </th>
                <th>Link </th>
                <th>Name </th>
                <th>StudentId </th>
                
            </tr>
            <?php
            $sl=1;
            foreach ($Research as $re)
            {
                if($re->Type=='Research')
                {
                    echo "<tr>
                <td> ".$sl."</td>
                <td>".$re->Headline." </td>
                <td>".$re->Detail." </td>
                <td>".$re->Link." </td>
                <td>".$re->Name." </td>
                <td>".$re->StudentId." </td>   
            </tr>";
               $sl++;
                }
            }
            
            ?>
        
        </table>
                 
                 </div>  
                <div id="Optimization" class="tab-pane fade ">
                    <h3>Optimization</h3>
                    <p>BITC faculty and students want to ensure a tremendous learning environment here within the Institute. One of the areas of interest is computationally hard optimization problems that exist almost everywhere in natural world. We intend to develop approximation and heuristics for hard problems in software design, reusability and modularity in software, reverse engineering, requirements engineering, i.e. software engineering in general. Mathematical programming, simple computational geometry and graph theory techniques are the main focuses of our methodology.</p>
                </div>  
                <!--2nd tab start-->
                <div id="CloudComputing" class="tab-pane fade">
                    <h3>Cloud Computing</h3>
                    <p>Cloud computing is one of the emergent domains in which remote resources are used on the basis of demand, even without the physical infrastructure at the client end. In cloud computing, the actual resources are installed and deployed at remote locations. This article focuses on the guidelines for research scholars and practitioners in the domain of cloud computing and related technologies.</p>
                </div>
                <!--3rd tab start-->
                <div id="ImageProcessingandPatternRecognition" class="tab-pane fade">
                    <h3>Image Processing and Pattern Recognition</h3>
                </div>
                <!--4th tab start-->
                <div id="InformationRetrieval" class="tab-pane fade">
                    <h3>Information Retrieval</h3>
                </div>
                <!--5th tab start-->
                <div id="WirelessNetworkandSecurity" class="tab-pane fade">
                    <h3>Wireless Network and Security</h3>
                </div>
                 <!--6th tab start-->
                <div id="SoftwareEngineering" class="tab-pane fade">
                    <h3>Software Engineering</h3>
                </div>
            </div>




        </div>  


        <!--2nd tab start -->
        <div id="Projects" class="tab-pane fade">
            <h3>Projects</h3>
              <table class="table table-bordered">
            <tr>
                <th>SN</th>
                <th>Headline </th>
                <th>Detail </th>
                <th>Link </th>
                <th>Name </th>
                <th>StudentId </th>
                
            </tr>
            <?php
            $sl=1;
            foreach ($Research as $re)
            {
                if($re->Type=='Project')
                {
                    echo "<tr>
                <td> ".$sl."</td>
                <td>".$re->Headline." </td>
                <td>".$re->Detail." </td>
                <td>".$re->Link." </td>
                <td>".$re->Name." </td>
                <td>".$re->StudentId." </td>   
            </tr>";
               $sl++;
                }
               
            }
            
            ?>
         
            

        </table>
            
        </div>
    </div>

</div>
</div>


