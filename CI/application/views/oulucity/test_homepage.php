<!-- video as a header-->
<div>
    <video width="320" height="240" controls> 
    <!--It is a good idea to always include width and height attributes. 
    If height and width are not set, the page might flicker while the video loads.-->
    <source src="movie.mp4" type="video/mp4">
    <source src="movie.ogg" type="video/ogg">
    <!-- default values for src, width and height-->
    Your browser does not support the video tag.
    </video>
</div>



<h1>Oulu's real estates</h1>

<?php echo form_open_multipart('oulucity/homepage');?>
<div class="form-group">
    
    <!-- drop down on the homepage for choosing the real estate (that should be displayed in the next view)-->
    <div class="row">
        <div class="col-md-4">
            <label for="estate">Real estate:</label>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <?php
                print "<select name='property_id'>"; 
                foreach ($estate as $estate_item) { // $estate does not existis so far
                    print "<option value='" . $estate_item['property_id'] . "'>";
                    print $estate_item['property_name']; 
                    print "</option>"; 
                }
                print "</select>";
                ?>
            </div>
        </div>
    </div>
    
    
    <!-- drop down on the homepage for choosing the type of consumption-->
    <div class="row">
        <div class="col-md-4">
            <label for "type">Type of consumption:</label>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <?php
                print "<select name='consumption_type'>"; 
                foreach ($city as $city_item) {
                    print "<option value='" . $city_item['consumption_measure'] . "'>";
                    print $city_item['consumption_measure'];
                    print "</option";
                }
                print "</select";
                ?>
            </div>
        </div>
    </div>
    
    
    




    
    				