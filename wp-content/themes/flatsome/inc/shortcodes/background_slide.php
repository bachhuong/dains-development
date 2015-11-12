<?php 
// [section] 
function backgroundSlideShortcode($atts, $content = null) {
extract( shortcode_atts( array(
    'bg' => '',
    'padding' =>'',
    'dark' => 'false',
    'class' => '',
    'video_mp4' => '',
    'video_ogv' => '',
    'video_webm' => '',
    'parallax' => '',
    'parallax_text' => '',
    'margin' => '0px',
    'title' => '',
    'img' => '',
    'img_pos' => 'right',
    'img_width' => '50%',
    'img_margin' => '',
    'id' => '',
    'bgs' => '',
    'bgs_interval' => 5000,
    'mobile' => true,
    ), $atts ) );
    
    ob_start();

   $background = "";
   $background_color = "";
   $padding_row = "";
   $dark_text = "";

   if($dark == 'true') $dark_text = " dark";

    if($padding){ $padding_row = 'padding:'.$padding.' 0;';}

    if (strpos($bg,'http://') !== false || strpos($bg,'https://') !== false) {
      $background = $bg;
    }
    elseif (strpos($bg,'#') !== false) {
      $background_color = 'background-color:'.$bg.'!important;';
    }

    $bgs = explode('|', $bgs);
    if (!empty($bgs) && is_array($bgs)) {
        $background = $bgs[0];
    }

   $has_parallax = '';
   if($parallax || $parallax_text) $has_parallax = ' has-parallax';

   $parallax_class = '';
   if($parallax){$parallax_class = ' ux_parallax'; $parallax=' data-velocity="'.(intval($parallax)/10).'"';} 
 
   $parallax_text = '';
   $text_parallax_class = '';
   if($parallax_text){$text_parallax_class = ' parallax_text'; $parallax_text=' data-velocity="'.(intval($parallax_text)/10).'"';} 

  ?>

    <?php if($title){ ?>
     <h3 class="ux-bg-title"><span><?php echo $title; ?></span></h3>
    <?php } ?> 
     <section <?php if($id) echo 'id="'.$id.'"' ?> class="ux-section<?php echo $dark_text; ?><?php if($img){echo ' has-img has-img-'.$img_pos;}?><?php if($class){echo ' '.$class;}?><?php echo $has_parallax; ?>" style="<?php echo $background_color; ?><?php echo $padding_row; ?><?php if($margin){ echo 'margin-bottom:'.$margin.'!important;';}?>">  
     <?php if($background){ ?> <div class="bach-background-slide<?php if($id) echo "-".$id ?> ux-section-bg banner-bg <?php echo $parallax_class; ?>" <?php echo $parallax; ?> style="background-image:url(<?php echo $background; ?>);"></div><?php } ?>
     <?php if($img && $img_pos != 'bottom'){ ?><div class="ux-section-img <?php echo $img_pos; ?>" style="width:<?php echo $img_width; ?>; background-image: url('<?php echo $img; ?>');<?php if($img_margin) echo 'margin:'.$img_margin.' 0;';?>"><img src="<?php echo $img; ?>"></div><?php } ?> 
     <div class="ux-section-content<?php echo $text_parallax_class; ?><?php echo $text_parallax_class; ?>"<?php echo $parallax_text; ?>><?php echo fixShortcode($content); ?></div>
     <?php if($img && $img_pos == 'bottom'){ ?><div class="ux-section-img <?php echo $img_pos; ?>" style="width:<?php echo $img_width; ?>; background-image: url('<?php echo $img; ?>');"><img src="<?php echo $img; ?>"></div><?php } ?> 
    <?php if($video_mp4 || $video_webm || $video_ogv){ ?>
     <video class="ux-banner-video hide-for-small" poster="<?php echo $background; ?>" preload="auto" autoplay="" loop="loop" muted="muted">
          <source src="<?php echo $video_mp4; ?>" type="video/mp4">
          <source src="<?php echo $video_webm; ?>" type="video/webm">
          <source src="<?php echo $video_ogg; ?>" type="video/ogg">
      </video>
      <?php } ?>
    </section><!-- .ux-section -->

    <?php if (!empty($bgs) && is_array($bgs)) : ?>
    <script type="text/javascript">
        jQuery(function($){
            var listBgs = [];
            <?php foreach ($bgs as $item) :?>
            listBgs.push('<?php echo $item ?>');
            <?php endforeach ?>

            var cnt=0, bg;
            var backgroundItem = $('.bach-background-slide<?php if($id) echo "-".$id ?>');
            var $body = $(backgroundItem);

            var bgrotater = setInterval(function() {
                if (cnt==listBgs.length) cnt=0;
                bg = 'url("' + listBgs[cnt] + '")';
                cnt++;
                $body.css({'background-image': bg, 'background-size':'cover', 'transition': '1.5s'});
            }, <?php echo !empty($bgs_interval) ? $bgs_interval : 5000 ?>);


        });
    </script>
    <?php endif; ?>

  <?php
  $content = ob_get_contents();
  ob_end_clean();
  return $content;

} 

add_shortcode('background-slide', 'backgroundSlideShortcode');