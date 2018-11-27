<h1>Opendata from Ouka</h1>
<?php 
    
    foreach ($city as $city_item): ?>
    <h3><?php echo $city_item['property_id']; ?></h3>
    <p><?php echo 'Address: ' . $city_item['property_address']; ?><br>
    <?php echo 'Postal code: ' . $city_item['postal_area']; ?><br>
    <?php echo 'Intented use: ' . $city_item['intended_use'] . 'mins'; ?></p>
    <?php endforeach; 
    
    ?>
    <p><?php 
    //print_r($city); 
    
    /*
    foreach ($jsonIterator as $key => $val) {
    if(is_array($val)) {
        echo "$key:\n";
    } else {
        echo "$key => $val\n";
    }
    }   
    */
    ?></p>
    