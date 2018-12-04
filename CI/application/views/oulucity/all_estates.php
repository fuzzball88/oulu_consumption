<section id="all_estates">
    <div class="container">
        <?php
        foreach ($estate as $estate_item): ?>
        <div class="row mx-auto">
            <div class="col-lg-4 mx-auto">

                <h2><?php echo $estate_item['property_name'];?></h2>
                <p><?php echo $estate_item['property_id']; ?></p>
                <p><?php echo 'Intended use: ' . $estate_item['intended_use']; ?><br>
                <?php echo 'District name: ' . $estate_item['district_name']; ?><br>
                <?php echo 'Street address: ' . $estate_item['property_address']; ?><br>
                <?php echo 'Postal code: ' . $estate_item['postal_code']; ?><br>
                <?php echo 'Postal area: ' . $estate_item['postal_area']; ?><br>
                <?php echo 'Size(m2): ' . $estate_item['grossarea']; ?><br>
                <?php echo 'Building year: ' . $estate_item['year_built']; ?><br>
                <?php echo 'year_renovated: ' . $estate_item['year_renovated']; ?></p>
            
            </div>
            <div class="col-lg-4 mx-auto">
                
            </div>
            <?php
            endforeach; 
            ?>
         
        </div>
    </div>
</section>