<section id="estate">
    <div class="container">
        <?php
        foreach ($estate as $estate_item): ?>
        <div class="row">
            <div class="col-lg-4">

                <h2><?php echo $estate_item['property_name'];?></h2>
                <p><?php echo $estate_item['property_id']; ?></p>
                <p><?php echo 'Intended use: ' . $estate_item['intended_use']; ?><br>
                <?php echo 'District name: ' . $estate_item['district_name']; ?><br>
                <?php echo 'Street address: ' . $estate_item['property_address']; ?><br>
                <?php echo 'Postal code: ' . $estate_item['postal_code']; ?><br>
                <?php echo 'Postal area: ' . $estate_item['postal_area']; ?><br>
                <?php echo 'Size(m2): ' . $estate_item['grossarea']; ?><br>
                <?php echo 'Building year: ' . $estate_item['year_built']; ?><br>
                <?php echo 'Year renovated: ' . $estate_item['year_renovated']; ?></p>
                <?php
                
            print('</div>');
                str_replace(" ","+",$estate_item['property_address']);
                print('<div class="col-lg-8 mx-auto">');
                    print('<div style="width: 100%"><iframe width="100%" height="400px" src="https://maps.google.com/maps?width=100%&amp;height=600&amp;hl=en&amp;coord=65.0118734,25.4716809&amp;q='.$estate_item['property_address'].'+'.$estate_item['postal_area'].'+'.$estate_item['postal_code'].'&amp;ie=UTF8&amp;t=&amp;z=14&amp;iwloc=B&amp;output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"><a href="https://www.maps.ie/create-google-map/">Google map generator</a></iframe></div>');
                print('</div>');
                
                
                endforeach; 
                ?>
        </div>
    </div>

</section>