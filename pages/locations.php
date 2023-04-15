<?php 
  $trails_file = file_get_contents('./js/locations.json');
  $trails = json_decode($trails_file, true);
  $backgroundImageOverlay = "linear-gradient(0deg, rgb(35 61 29 / 60%), rgb(0 0 0 / 52%)), "
?>

<h1 id="trails-header">Featured Trails</h1>
<div id="trails-vh">
  <div id="trails-container">
    <?php
      foreach($trails as $key => $trail){
    ?>
      
      <a href="<?php echo $trail['url'] ?>">
        <div class='trail-section' style='background-image: <?php echo $backgroundImageOverlay ?>url("<?php echo $trail['image'] ?>");'>
          <h1 class='trail-header'>
              <?php echo $key ?>
          </h1>
        </div>
      </a>
    <?php
      }
    ?>
  </div>
</div>
