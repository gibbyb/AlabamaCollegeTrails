<?php 
  $trails_file = file_get_contents('./js/locations.json');
  $trails = json_decode($trails_file, true);
  $backgroundImageOverlay = "linear-gradient(0deg, rgb(35 61 29 / 60%), rgb(0 0 0 / 52%)), "
?>

<h1 class="h1 centered mt-5" id="trails-header">Featured Trails</h1>
<div id="trails-vh">
    <div class="container" id="trails-container">
        <div class="row">
    <?php
      foreach($trails as $key => $trail){
    ?>
            <div class="col-sm-2 col-md-4 mb-3">
                <a target="_blank" href="<?php echo $trail['url'] ?>">
                  <div class='trail-section trail-img' style='background-image: <?php echo $backgroundImageOverlay ?>url("<?php echo $trail['image'] ?>");'>
                    <h1 class='trail-header text-white centered'>
                        <?php echo $key ?>
                    </h1>
                  </div>
                </a>
            </div>
    <?php
      }
    ?>
  </div>
  </div>
</div>
