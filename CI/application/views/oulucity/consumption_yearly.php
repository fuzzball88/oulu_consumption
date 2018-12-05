<h1>Opendata from Ouka</h1>
<?php 
    echo $year;
    echo $id;

    $usage = array();
    foreach ($estate as $estate_item): ?>
    <p><?php echo 'property_id: ' . $estate_item['property_id']; ?><br>
    <?php echo 'property_name: ' . $estate_item['property_name']; ?><br>
    <?php echo 'consumption_measure: ' . $estate_item['consumption_measure']; ?><br>
    <?php echo 'year: ' . $estate_item['year']; ?><br>
    <?php echo 'consumption: ' . $estate_item['consumption']; ?><br></p>
    <?php array_push($usage,array($estate_item['consumption_measure'],$estate_item['consumption'])); ?>
    <?php endforeach;?>
    
    <?php
    print_r($estate);;?><br><br>
    

    <?php
    //For looking the usage values
    function searchForValue($id, $array) {
      foreach ($array as $key) {
        if ($key['consumption_measure'] == $id) {
            return $key['consumption'];
        }
      }
      return "No Value";
    }

    $water = searchForValue('Vesi',$estate);
    $electricity = searchForValue('Sähkö',$estate);
    $heat = searchForValue('Lämpö',$estate);
    ?>
    <p><?php echo 'water usage:';?> <?php echo $water;?>m3</p><br>
    <p><?php echo 'heat usage:';?> <?php echo $heat;?>kWh</p><br>
    <p><?php echo 'electricity usage:';?> <?php echo $electricity;?>kWh</p><br>
    
    ?>
    
    
    <div id="piechart">
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script> 
         
        <script type="text/javascript">
            
            // Load google charts
            google.charts.load('current', {'packages':['corechart']});
            google.charts.setOnLoadCallback(drawChart);
            
            // Draw the chart and set the chart values
            /*
            function drawChart() {
              var data = google.visualization.arrayToDataTable([
                ['Type', 'Usage'],
                ['<?php// echo $usage[0][0];?>', <?php// echo $usage[0][1];?>],
                ['<?php// echo $usage[1][0];?>', <?php// echo $usage[1][1];?>],
                ['<?php// echo $usage[2][0];?>', <?php// echo $usage[2][1];?>], 
            ]);*/
            function drawChart() {
              var data = google.visualization.arrayToDataTable([
                ['Measure', 'Usage'],
                ['<?php echo 'Heat';?>', <?php echo $heat;?>],
                ['<?php echo 'Electricity';?>', <?php echo $electricity;?>]
                ]);
            
              // Optional; add a title and set the width and height of the chart
              var options = {'title':'Energy consumption year: <?php echo $estate[0]['year'];?>', 'width':550, 'height':400,sliceVisibilityThreshold: .0,is3D: true};
            
              // Display the chart inside the <div> element with id="piechart"
              var chart = new google.visualization.PieChart(document.getElementById('piechart'));
              chart.draw(data, options);
            }
            </script> 
    
    </div>
    
    <div id="waterchart">
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script> 
         
        <script type="text/javascript">
            
            // Load google charts
            google.charts.load('current', {'packages':['bar']});
            google.charts.setOnLoadCallback(drawChart);
            
            // Draw the chart and set the chart values
            function drawChart() {
              var data = google.visualization.arrayToDataTable([
                 ['Element', 'm3', { role: 'style' }, { role: 'annotation' } ],
                 ['Water', <?php echo $water; ?>, '#color: blue; stroke-width: 4', 'm3' ]
              ]);
            
              // Optional; add a title and set the width and height of the chart
              var options = {
                chart: {
                  title: 'Water usage',
                  //subtitle: 'Sales, Expenses, and Profit: 2014-2017',
                },
                bars: 'horizontal' // Required for Material Bar Charts.
              };

              // Display the chart inside the <div> element with id="piechart"
              var chart = new google.charts.Bar(document.getElementById('waterchart'));
              chart.draw(data, google.charts.Bar.convertOptions(options));

            }
            </script> 
    
    </div>
    