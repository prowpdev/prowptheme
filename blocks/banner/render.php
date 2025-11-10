<?php
// ACF fields for this block can be used like:
$bg_image = get_field('bg_image');
$heading = get_field('heading');
$description = get_field('description');
$btn_label = get_field('btn_label');
$btn_url = get_field('btn_url');
?>

<section class="block-banner" style="background-image:url(<?=$bg_image;?>);">
  <div class="overlay"></div>
  <div class="container mx-auto">
    <h1><?=$heading;?></h1>
    <?=$description;?> 
    <div class="cta">
      <a href="<?=$btn_url;?>"><button><?=$btn_label;?></button></a>
    </div>
  </div>
</section>
