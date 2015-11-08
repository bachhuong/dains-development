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


         <?php if($background){ ?>

             <div class="background_cycler bach-background-slide<?php if($id) echo "-".$id ?> ux-section-bg banner-bg <?php echo $parallax_class; ?>" <?php echo $parallax; ?> style="background-image:url(<?php echo $background; ?>);">

                 <?php foreach ($bgs as $bgIndex => $item) :?>
                     <img <?php if ($bgIndex == 0): ?> class="active" <?php endif; ?> src="<?php echo $item ?>" alt=""/>
                 <?php endforeach ?>

             </div>
         <?php } ?>


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
        var cycleImages = function() {};
        jQuery(function($){

            $('.bach-background-slide<?php if($id) echo "-".$id ?>').hide();//hide the background while the images load, ready to fade in later

            $('.bach-background-slide<?php if($id) echo "-".$id ?>').fadeIn(1500);//fade the background back in once all the images are loaded
            // run every 7s
            setInterval(function() {
                var $active = $('.bach-background-slide<?php if($id) echo "-".$id ?> .active');
                var $next = ($('.bach-background-slide<?php if($id) echo "-".$id ?> .active').next().length > 0) ? $('.bach-background-slide<?php if($id) echo "-".$id ?> .active').next() : $('.bach-background-slide<?php if($id) echo "-".$id ?> img:first');
                $next.css('z-index',2);//move the next image up the pile

                // change the background style
                $('.bach-background-slide<?php if($id) echo "-".$id ?>').css('background-image', 'url(' + $next.attr('src') + ')');

                $active.fadeOut(1500,function(){//fade out the top image
                    $active.css('z-index',1).show().removeClass('active');//reset the z-index and unhide the image
                    $next.css('z-index',3).addClass('active');//make the next image the top one
                });
            }, <?php echo !empty($bgs_interval) ? $bgs_interval : 5000 ?>);

        });
    </script>
    <style>
        .background_cycler{padding:0;margin:0;width:100%;position:absolute;top:0;left:0;z-index:-1}
        .background_cycler img{position:absolute;left:0;top:0;width:100%;z-index:1}
        .background_cycler img.active{z-index:3}
    </style>
    <?php endif; ?>

  <?php
  $content = ob_get_contents();
  ob_end_clean();
  return $content;

} 

add_shortcode('background-slide', 'backgroundSlideShortcode');