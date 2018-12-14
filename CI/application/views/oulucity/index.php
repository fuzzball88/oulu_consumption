<?php
$district = array();
foreach ($estates as $estate_item)
{
  if(in_array($estate_item['district_name'],$district,TRUE) == FALSE)
  {
    array_push($district,$estate_item['district_name']);
  }
}
//print_r($district);

?>

<script>
  function goToNewPage(dropdownlist)
  {
    var url = dropdownlist.options[dropdownlist.selectedIndex].value;
    if (url != "")
    {
    window.open(url,"_self");
    }
  }
</script>
<!-- Content -->
<section id="about">
      <div class="container">
        <div class="row">
          <div class="col-lg-4 mx-auto">
            <img src="<?php echo base_url() . "/animation/slowAnimation.gif"; ?>" style="width:350px;height:auto;">
          </div>
          <div class="col-lg-8 mx-auto" style="margin-top: auto">
            <h2>Purpose of this page</h2>
            <p class="lead">Our web page provides you the consumption details of all real estates in Oulu that are providing open data.</p>
            <h3>Select a district:</h3>
            <!-- Form OPEN -->
            <?php 
            //echo validation_errors();
            //echo form_open('oulucity/estates/')
            ?>
            
            <form name="dropdown">
               <select name="list" accesskey="E">
               <option selected value="<?php echo site_url('oulucity/index');?>" disabled>Please select district</option>
               <?php
               foreach ($district as $estate_item) 
                {
                    print '<option value="'?><?php echo site_url('oulucity/district/'.$estate_item).'">';
                    print $estate_item;
                    print "</option>";
                }
                ?>
               <select>
               <input class="btn btn-outline-danger" type=button value="Go" onclick="goToNewPage(document.dropdown.list)">
            </form>
            
          </div>
        </div>
      </div>
</section>
