<?php
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
      return "No Value";
    }
    //For looking the usage from MultiaRRAY values
    function searchForArrayValue($id, $array) 
    {
        if ($array['consumption_measure'] == $id)
        {
            return $array['consumption'];
        }
        return "No Value";
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
      return "No Year Value";
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
    
    usort($usage,"sortByYear");
    //Checks how many first level arrays in array
    $arraycount = count(array_keys($usage));
    $id = $estate[0]['property_id'];
    /*
    $water = searchForValue('Vesi',$usage);
    $electricity = searchForValue('Sähkö',$usage);
    $heat = searchForValue('Lämpö',$usage);
    $year = searchForYear($estate[0]['property_id'],$usage);
    */
    

    
    //print($arraycount);
    //print_r($usage);
?>


<!-- Content -->
<section id="Yearly Usage">
    <div class="container">
        <div class="row">
            <div class="col-lg-12" style="border-top:black solid 4px">
                <h2>Yearly consumption</h2>
            </div>
        </div>
<?php   if(empty($usage))
        {    ?>
        <div class="row">
            <div class="col-lg-12">
                <h1>No consumption data!</h1>
            </div>
        </div>
<?php   }
        else
        {
        //echo $floatyear.'<br>';
        $floatyear = $usage[0]['year'];
        for($x = 0; $x <= $arraycount-1;$x+=3)
        {
            echo $usage[$x]['year'];
            if($usage[$x]['consumption_measure'] == 'Vesi')
            {
            $water = searchForArrayValue('Vesi',$usage[$x]);
            echo 'vesi'.$water.' <br>';
            }
            elseif($usage[$x]['consumption_measure'] == 'Sähkö')
            {
            $electricity = searchForArrayValue('Sähkö',$usage[$x]);
            echo 'sähkö'.$electricity.' <br>';
            }
            elseif($usage[$x]['consumption_measure'] == 'Lämpö')
            {
            $heat = searchForArrayValue('Lämpö',$usage[$x]);
            echo 'lämpö'.$heat.' <br>';
            }
            
            $y = $x+1;
            echo $usage[$y]['year'];
            if($usage[$y]['consumption_measure'] == 'Vesi')
            {
            $water = searchForArrayValue('Vesi',$usage[$y]);
            echo 'vesi'.$water.' <br>';
            }
            elseif($usage[$y]['consumption_measure'] == 'Sähkö')
            {
            $electricity = searchForArrayValue('Sähkö',$usage[$y]);
            echo 'sähkö'.$electricity.' <br>';
            }
            elseif($usage[$y]['consumption_measure'] == 'Lämpö')
            {
            $heat = searchForArrayValue('Lämpö',$usage[$y]);
            echo 'lämpö'.$heat.' <br>';
            }
            
            $z = $y+1;
            
            echo $usage[$z]['year'];
            if($usage[$z]['consumption_measure'] == 'Vesi')
            {
            $water = searchForArrayValue('Vesi',$usage[$z]);
            echo 'vesi'.$water.' <br>';
            }
            elseif($usage[$z]['consumption_measure'] == 'Sähkö')
            {
            $electricity = searchForArrayValue('Sähkö',$usage[$z]);
            echo 'sähkö'.$electricity.' <br>';
            }
            elseif($usage[$z]['consumption_measure'] == 'Lämpö')
            {
            $heat = searchForArrayValue('Lämpö',$usage[$z]);
            echo 'lämpö'.$heat.' <br>';
            }
            //CHARTS BEGIN HERE
            ?>
            <div class="row">
            <div id="piechart<?php echo $x; ?>" class="col-lg-6 mx-auto" style="">>
                <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script> 
                <script type="text/javascript">
                    // Load google charts
                    google.charts.load('current', {'packages':['corechart']});
                    google.charts.setOnLoadCallback(drawChart);
                    
                    
                    function drawChart() {
                      var data = google.visualization.arrayToDataTable([
                        ['Measure', 'Usage'],
                        ['<?php echo 'Heat kWh';?>', <?php echo $heat;?>],
                        ['<?php echo 'Electricity kWh';?>', <?php echo $electricity;?>]
                        ]);
                    
                      // Optional; add a title and set the width and height of the chart
                      var options = {'title':'Energy consumption year: <?php echo $usage[$x]['year'];?>','width':450, 'height':400, chartArea:{left:0,top:40,width:'50%',height:'40%'},legend:{position: 'bottom'},sliceVisibilityThreshold: .0,is3D: true};
                        //Original'width':550, 'height':400
                      // Display the chart inside the <div> element with id="piechart"
                      var chart = new google.visualization.PieChart(document.getElementById('piechart<?php echo $x; ?>'));
                      chart.draw(data, options);
                    }
                </script> 
            </div>
                
            <div id="watercolumn<?php echo $x; ?>" class="col-lg-6 mx-auto" style="">
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
                    title: "Water consumption year:<?php echo $usage[$x]['year']?>",
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
            
        </div>
        <?php    
        }
        ?>
        <?php
        }
        ?> 
        <div class="row">
            <div id="piechart" class="col-lg-6 mx-auto" style="">>
                <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script> 
                <script type="text/javascript">
                    // Load google charts
                    google.charts.load('current', {'packages':['corechart']});
                    google.charts.setOnLoadCallback(drawChart);
                    
                    
                    function drawChart() {
                      var data = google.visualization.arrayToDataTable([
                        ['Measure', 'Usage'],
                        ['<?php echo 'Heat kWh';?>', <?php echo $heat;?>],
                        ['<?php echo 'Electricity kWh';?>', <?php echo $electricity;?>]
                        ]);
                    
                      // Optional; add a title and set the width and height of the chart
                      var options = {'title':'Energy consumption year: <?php echo $year;?>','width':450, 'height':400, chartArea:{left:0,top:40,width:'50%',height:'40%'},legend:{position: 'bottom'},sliceVisibilityThreshold: .0,is3D: true};
                        //Original'width':550, 'height':400
                      // Display the chart inside the <div> element with id="piechart"
                      var chart = new google.visualization.PieChart(document.getElementById('piechart'));
                      chart.draw(data, options);
                    }
                </script> 
            </div>
                
            <div id="watercolumn" class="col-lg-6 mx-auto" style="">
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
                    title: "Water consumption year:<?php echo $year?>",
                    width: 200,
                    height: 350,
                    bar: {groupWidth: "50%"},
                    legend: { position: "bottom" },
                    chartArea:{left:60,top:45,width:'60%',height:'60%'}
                  };
                  var chart = new google.visualization.ColumnChart(document.getElementById("watercolumn"));
                  chart.draw(view, options);
                }
                </script>
            </div>
            
        </div>
        <!-- Here the php closing --> 
        
    </div>
</section>