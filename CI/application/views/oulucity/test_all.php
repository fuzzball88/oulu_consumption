<?php
    //Sorts the multiarray by year
    usort($usage,"sortByYear");
    //Checks how many first level arrays in array
    $arraycount = count(array_keys($usage));

    //For looking the usage from MultiaRRAY values
    function searchForValue($id, $array) 
    {
      foreach ($array as $key) 
      {
        if ($key['consumption_measure'] == $id)
        {
            return $key['consumption'];
        }
      }
      return NULL;
      //return 'No Value';
    }
    //For looking the usage from array values
    function searchForArrayValue($id, $array) 
    {
        if ($array['consumption_measure'] == $id)
        {
            return $array['consumption'];
        }
        return NULL;
        //return "No Value";
    }
    
    //For looking the year
    function searchForYear($id, $array) 
    {
      foreach ($array as $key) 
      {
        if ($key['property_id'] == $id) 
        {
            return $key['year'];
        }
      }
      //return "No Year Value";
      return NULL;
    }
    //Check the number of all arrays in multiarray
    function numberOfArrays($array)
    {
        $count = 0;
        foreach ($array as $type) 
        {
            $count+= count($type);
        }
        return $count;
    }
    
    //For sorting the multiarray per year
    function sortByYear($a, $b)
    {
        if ($a["year"] == $b["year"]) {
            return 0;
        }
        return ($a["year"] < $b["year"]) ? -1 : 1;
    }
    
    //Checks number of years in multiarray
    function checkNumberOfYears($multiarray)
    {
        $yearsnum = array();
        foreach ($multiarray as $usage_item)
        {
          if(in_array($usage_item['year'],$yearsnum,TRUE) == FALSE)
          {
            array_push($yearsnum,$usage_item['year']);
          }
        }
        return $yearsnum;
    }
    
    function orderItemsPerYear($years,$usage)
    {
        $newArray = array();
        foreach ($years as $year):
            //$index=0;
            $newArray[$year]=array();
            //$newArray[$index]=array();
            foreach ($usage as $usage_item):
                if($usage_item['year'] == $year)
                {
                    //array_push($newArray,[$year][$usage_item]);
                    $newArray[$year][]=$usage_item;
                    //$newArray[$index][]=$usage_item;
                }
            endforeach;
            //$index++;
        endforeach;
        return $newArray;
    }
    
    function printValues($year,$water,$electricity,$heat)
    {
        echo '<p>Year: '.$year.'</p>';
        if($water != NULL)
        {
            echo '<p>Water: '.$water.' m3</p>';
        }
        if($electricity != NULL)
        {
            echo '<p>Electricity: '.$electricity.' kWh</p>';
        }
        if($heat != NULL)
        {
            echo '<p>Heat: '.$heat.' kWh</p>';
        }
    }
    
    
    
    
    //Find out what years are included
    $years = checkNumberOfYears($usage);
    //Create new multiarray for each year. !!Index is now the year!!
    $byYear = orderItemsPerYear($years,$usage);

    /*
    $water = searchForValue('Vesi',$usage);
    $electricity = searchForValue('Sähkö',$usage);
    $heat = searchForValue('Lämpö',$usage);
    $year = searchForYear($estate[0]['property_id'],$usage);
    */
    
    //Find what values are included and use reports to show them per year.
    ?>
    <section id="Yearly Usage">
    <div class="container">
        <div class="row">
            <div class="col-lg-12" style="border-top:black solid 1px">
                <h2>Yearly consumption</h2>
            </div>
        </div>
<?php   if(empty($byYear))
            {    ?>
            <div class="row">
                <div class="col-lg-12">
                    <h1>No consumption data!</h1>
                </div>
            </div>
<?php       }
        else
        {
        $x = 0;
            foreach($byYear as $year)
            {
                
                $arraycount = count(array_keys($year));
                $thisyear = $year[0]['year'];
                $water = searchForValue('Vesi',$year);
                $electricity = searchForValue('Sähkö',$year);
                $heat = searchForValue('Lämpö',$year);
                if($heat != NULL and $electricity != NULL){$energyuse = 'both';}
                elseif($heat == NULL and $electricity != NULL){$energyuse = 'electricity';}
                else{$energyuse = 'heat';}
                //echo $energyuse;
                ?>
            <div class="row">   
                <div class="col-lg-4 mx-auto">
                    <?php printValues($thisyear,$water,$electricity,$heat);?>
                    <a href="<?php echo site_url('oulucity/consumption_mothly/'.$thisyear.'/'.$year[0]['property_id']); ?>">Months</a>
                </div>
            <?php if($heat != NULL or $electricity != NULL){?> 
                <!--PIECHART -->    
                <div id="piechart<?php echo $x; ?>" class="col-lg-4 mx-auto" style="">
                    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script> 
                    <script type="text/javascript">
                        // Load google charts
                        google.charts.load('current', {'packages':['corechart']});
                        google.charts.setOnLoadCallback(drawChart);
                        
                        
                        function drawChart() {
                          var data = google.visualization.arrayToDataTable([
                            ['Measure', 'Usage',],<?php
                            switch($energyuse){
                                case 'both':?>      
                                ['<?php echo 'Heat kWh';?>', <?php echo $heat;?>],
                                ['<?php echo 'Electricity kWh';?>', <?php echo $electricity;?>] 
                                ]);<?php
                                break;
                                case 'heat':?>
                                ['<?php echo 'Heat kWh';?>', <?php echo $heat;?>]
                                ]);<?php
                                break;
                                case 'electricity':?>
                                ['<?php echo 'Electricit kWh';?>', <?php echo $electricity;?>]
                                ]);<?php
                                break;
                            }
                            ?>
                            
                          // Optional; add a title and set the width and height of the chart
                          var options = {'title':'Energy consumption year: <?php echo $thisyear;?>','width':450, 'height':400, chartArea:{left:0,top:40,width:'50%',height:'40%'},legend:{position: 'bottom'},sliceVisibilityThreshold: .0,is3D: true};
                            //Original'width':550, 'height':400
                            
                          // Display the chart inside the <div> element with id="piechart"
                          var chart = new google.visualization.PieChart(document.getElementById('piechart<?php echo $x; ?>'));
                          chart.draw(data, options);
                          
                        }
                    </script> 
                    
                </div>
                <?php }//Ends the if statement?! ?>
            
        <?php   //PIE CHART ENDS
        //WATER CHART BEGINS
            if($water != NULL)
                {?>
                    <div id="watercolumn<?php echo $x; ?>" class="col-lg-4 mx-auto" style="">
                                            <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script> 
                                            <script type="text/javascript">
                                            // Load google charts
                                            google.charts.load('current', {'packages':['bar']});
                                            google.charts.setOnLoadCallback(drawChart);
                                            
                                            // Draw the chart and set the chart values
                                            function drawChart() {
                                              var data = google.visualization.arrayToDataTable([
                                                 ['Element', 'm3', { role: 'style' }, { role: 'annotation' } ],
                                                 ['Water', <?php echo $water; ?>, '#color: blue; stroke-width: 2', 'm3' ]
                                              ]);
                                            
                                              // Optional; add a title and set the width and height of the chart
                                              var view = new google.visualization.DataView(data);
                                              view.setColumns([0, 1,
                                                               { calc: "stringify",
                                                                 sourceColumn: 1,
                                                                 type: "string",
                                                                 role: "annotation" },
                                                               2]);
                                        
                                              var options = {
                                                title: "Water consumption year:<?php echo $thisyear?>",
                                                width: 200,
                                                height: 350,
                                                bar: {groupWidth: "50%"},
                                                legend: { position: "bottom" },
                                                chartArea:{left:60,top:45,width:'60%',height:'60%'}
                                              };
                                              var chart = new google.visualization.ColumnChart(document.getElementById("watercolumn<?php echo $x; ?>"));
                                              chart.draw(view, options);
                                            }
                                            </script>
                    </div>
            </div><?php
                }
            $x++;
            }//FOREACH ENDS
            ?></div><?php
        }//ELSE ENDS HERE
?>
</section>