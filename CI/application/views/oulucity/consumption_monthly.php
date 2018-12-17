<?php
    //Sorts the multiarray by year
    usort($estate,"sortByMonth");
    //Checks how many first level arrays in array
    //$arraycount = count(array_keys($usage));

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
    function sortByMonth($a, $b)
    {
        if ($a["month"] == $b["month"]) {
            return 0;
        }
        return ($a["month"] < $b["month"]) ? -1 : 1;
    }
    
    //Checks number of years in multiarray
    function checkNumberOfTypes($multiarray)
    {
        $typesnum = array();
        foreach ($multiarray as $usage_item)
        {
          if(in_array($usage_item['consumption_measure'],$typesnum,TRUE) == FALSE)
          {
            array_push($typesnum,$usage_item['consumption_measure']);
          }
        }
        return $typesnum;
    }
    
    function orderItemsPerType($types,$usage)
    {
        $newArray = array();
        foreach ($types as $type):
            //$index=0;
            $newArray[$type]=array();
            //$newArray[$index]=array();
            foreach ($usage as $usage_item):
                if($usage_item['consumption_measure'] == $type)
                {
                    //array_push($newArray,[$year][$usage_item]);
                    $newArray[$type][]=$usage_item;
                    //$newArray[$index][]=$usage_item;
                }
            endforeach;
            //$index++;
        endforeach;
        return $newArray;
    }
    $types = checkNumberOfTypes($estate);
    
    $pertype = orderItemsPerType($types,$estate);

    
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
    
    function getBarValues($type,$multiarray)
    {
        foreach($multiarray as $singlearray):
            foreach($singlearray as $array_item):
                if($array_item['consumption_measure']==$type)
                {
                    switch ($type){
                        case 'Vesi':
                            echo '['.$array_item['month'].', '.$array_item['consumption'].', "#color: blue; stroke-width: 1"],';
                            
                            break;
                        case 'Sähkö':
                            echo '['.$array_item['month'].', '.$array_item['consumption'].', "#color: yellow; stroke-width: 1"],';
                            break;
                        case 'Lämpö':
                            echo '['.$array_item['month'].', '.$array_item['consumption'].', "#color: red; stroke-width: 1"],';
                            break;
                    }
                }
                endforeach;
        endforeach;
    }
    /*
    foreach($pertype as $type_item):
        print_r($type_item);
        echo '<br><br>';
        endforeach;
    */
    ?>
            <div class="container">
                <div class="row">
                    <div id="columnchart_water" class="col-lg-12 mx-auto" style="">
                         <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                              <script type="text/javascript">
                                google.charts.load("current", {packages:['corechart']});
                                google.charts.setOnLoadCallback(drawChart);
                                function drawChart() {
                                  var data = google.visualization.arrayToDataTable([
                                    ["Month", "m3", { role: "style" } ],
                                    <?php getBarValues('Vesi',$pertype); ?>
                                    /*["Copper", 8.94, "#b87333"],
                                    ["Silver", 10.49, "silver"],
                                    ["Gold", 19.30, "gold"],
                                    ["Platinum", 21.45, "color: #e5e4e2"],
                                    ["Platinum", 344, "color: #e5e4e2"],*/
                                  ]);
                            
                                  var view = new google.visualization.DataView(data);
                                  view.setColumns([0, 1,
                                                   { calc: "stringify",
                                                     sourceColumn: 1,
                                                     type: "string",
                                                     role: "annotation" },
                                                   2]);
                            
                                  var options = {
                                    title: "Water usage per month",
                                    width: 1400,
                                    height: 400,
                                    bar: {groupWidth: "60%"},
                                    legend: { position: "none" },
                                  };
                                  var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_water"));
                                  chart.draw(view, options);
                              }
                              </script>
                    </div>
                </div>
                <div class="row">
                    <div id="columnchart_heat" class="col-lg-12 mx-auto" style="">
                         <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                              <script type="text/javascript">
                                google.charts.load("current", {packages:['corechart']});
                                google.charts.setOnLoadCallback(drawChart);
                                function drawChart() {
                                  var data = google.visualization.arrayToDataTable([
                                    ["Month", "kWh", { role: "style" } ],
                                    <?php getBarValues('Lämpö',$pertype); ?>
                                    /*["Copper", 8.94, "#b87333"],
                                    ["Silver", 10.49, "silver"],
                                    ["Gold", 19.30, "gold"],
                                    ["Platinum", 21.45, "color: #e5e4e2"],
                                    ["Platinum", 344, "color: #e5e4e2"],*/
                                  ]);
                            
                                  var view = new google.visualization.DataView(data);
                                  view.setColumns([0, 1,
                                                   { calc: "stringify",
                                                     sourceColumn: 1,
                                                     type: "string",
                                                     role: "annotation" },
                                                   2]);
                            
                                  var options = {
                                    title: "Heat usage per month",
                                    width: 1400,
                                    height: 400,
                                    bar: {groupWidth: "60%"},
                                    legend: { position: "none" },
                                  };
                                  var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_heat"));
                                  chart.draw(view, options);
                              }
                              </script>
                    </div>
                </div>
                
                <div class="row">
                    <div id="columnchart_electricity" class="col-lg-12 mx-auto" style="">
                         <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                              <script type="text/javascript">
                                google.charts.load("current", {packages:['corechart']});
                                google.charts.setOnLoadCallback(drawChart);
                                function drawChart() {
                                  var data = google.visualization.arrayToDataTable([
                                    ["Month", "kWh", { role: "style" } ],
                                    <?php getBarValues('Sähkö',$pertype); ?>
                                  ]);
                            
                                  var view = new google.visualization.DataView(data);
                                  view.setColumns([0, 1,
                                                   { calc: "stringify",
                                                     sourceColumn: 1,
                                                     type: "string",
                                                     role: "annotation" },
                                                   2]);
                            
                                  var options = {
                                    title: "Electricity usage per month",
                                    width: 1400,
                                    height: 400,
                                    bar: {groupWidth: "60%"},
                                    legend: { position: "none" },
                                  };
                                  var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_electricity"));
                                  chart.draw(view, options);
                              }
                              </script>
                    </div>
                </div>
            </div>