<h1>Opendata from Ouka</h1>
<?php 
    
    foreach ($estates as $city_item): ?>
    <h2><?php echo $city_item['property_name'];?></h2>
    <h3><?php echo $city_item['property_id']; ?></h3>
    <p><?php echo 'Address: ' . $city_item['property_address']; ?><br>
    <?php echo 'Postal code: ' . $city_item['postal_area']; ?><br>
    <?php echo 'Intented use: ' . $city_item['intended_use'] . 'mins'; ?></p>
    <?php endforeach; 
    
    ?>
    <p><?php 