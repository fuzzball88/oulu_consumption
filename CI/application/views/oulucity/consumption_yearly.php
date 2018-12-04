<h1>Opendata from Ouka</h1>
<?php 
    
    foreach ($estate as $estate_item): ?>
    <p><?php echo 'property_id: ' . $estate_item['property_id']; ?><br>
    <?php echo 'property_internal_id: ' . $estate_item['property_internal_id']; ?><br>
    <?php echo 'property_name: ' . $estate_item['property_name']; ?><br>
    <?php echo 'consumption_measure: ' . $estate_item['consumption_measure']; ?><br>
    <?php echo 'year: ' . $estate_item['year']; ?><br>
    <?php echo 'consumption: ' . $estate_item['consumption']; ?><br></p>

        <?php endforeach;?>
    