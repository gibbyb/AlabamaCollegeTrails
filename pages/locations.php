<?php 
  $trails_file = file_get_contents('./js/locations.json');
  $trails = json_decode($trails_file, true);
  //see https://getbootstrap.com/docs/5.0/layout/grid/ for bootstrap grid breakdown. It's easy once you know it...
?>
<section class="mt-5 mb-5"><!-- margin-top: 5 margin-bottom: 5 -->
    <div class="container"><!-- bootstrap style -->
        <div class="row"><!-- bootstrap style -->
            <h1 class="col-12 mx-auto mb-5 centered h1">Featured Trails</h1><!--margin-left/right: auto margin-bottom: 3rem (bootstrap)-->
            <div class="col-12 mt-1"><!-- columns 12 (full width) margin-top: 1%-->
                <div id="trails-vh">
                    <div id="trails-container">
                        <div class="container">
                            <div class="row">
                        <?php
                          foreach($trails as $key => $trail){
                        ?>
                                <div class="col-6">
                                    <a class="location d-block" target="_default" href="<?php echo $trail['url'] ?>"><!-- open in new tab -->
                                      <div class='trail-img' style='background-image: url("<?php echo $trail['image'] ?>");'>
                                        <h1 class='trail-header'><?php echo $key ?></h1>
                                      </div>
                                    </a>
                                </div>
                        <?php
                          }
                        ?>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>