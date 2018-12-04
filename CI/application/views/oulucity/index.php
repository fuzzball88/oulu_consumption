<!-- Content -->
<section id="about">
      <div class="container">
        <div class="row">
          <div class="col-lg-8 mx-auto">
            <h2>Purpose of this page</h2>
            <p class="lead">Our web page provides you the consumption details of all buildings in Oulu that are providing open data.</p>
            <h3>Select a building or show all:</h3>
            <!-- Form OPEN -->
            <?php echo validation_errors();
            echo form_open('oulucity/estates/')
            ?>
            <select class="custom-select custom-select-lg mb-3" name="estate">
                <option selected value='all'>All buildings</option>
                <?php
                foreach ($estates as $estate_item) 
                {
                    print "<option value='".$estate_item['property_id']."'>";
                    print $estate_item['property_name'];
                    print "</option>";
                }
                ?>
            </select>
            
            
            <input type="submit" name="submit" class="btn btn-info" value="Check">
            </form>
            <!--
            <ul>
              <li>Clickable nav links that smooth scroll to page sections</li>
              <li>Responsive behavior when clicking nav links perfect for a one page website</li>
              <li>Bootstrap's scrollspy feature which highlights which section of the page you're on in the navbar</li>
              <li>Minimal custom CSS so you are free to explore your own unique design options</li>
            </ul>
            -->
          </div>
        </div>
      </div>
</section>
