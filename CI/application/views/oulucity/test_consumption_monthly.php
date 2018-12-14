<h1>Opendata from Ouka</h1>
<?php 
    
    foreach ($estate as $estate_item): ?>
    <p><?php echo 'property_id: ' . $estate_item['property_id']; ?><br>
    <?php echo 'property_internal_id: ' . $estate_item['property_internal_id']; ?><br>
    <?php echo 'property_name: ' . $estate_item['property_name']; ?><br>
    <?php echo 'consumption_measure: ' . $estate_item['consumption_measure']; ?><br>
    <?php echo 'year: ' . $estate_item['year']; ?><br>
    <?php echo 'month: ' . $estate_item['month']; ?><br>
    <?php echo 'consumption: ' . $estate_item['consumption']; ?><br></p>
    <?php endforeach; 
    
?>
    
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