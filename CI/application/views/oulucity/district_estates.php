<?php
//For sorting the multiarray per name
    function sortByName($a, $b)
    {
        if ($a["property_name"] == $b["property_name"]) {
            return 0;
        }
        return ($a["property_name"] < $b["property_name"]) ? -1 : 1;
    }
    
    usort($estates,"sortByName");

$limitestates = array();
foreach ($estates as $estate_item)
{
  if($estate_item['district_name'] == $districtname)
  {
    array_push($limitestates,$estate_item);
  }
}
?>

<section id="all_estates">
    <div class="container">
        <?php
        foreach ($limitestates as $estate_item): ?>
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
                <a href="<?php echo site_url('oulucity/estates/'.$estate_item['property_id']); ?>" class="nappi2">Check details</a>
            </div>
            </div>
            <?php
            endforeach; 
            ?>
         
        </div>
    </div>
</section>