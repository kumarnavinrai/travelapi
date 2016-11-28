<?php print render($page['content']); ?>
<?php 
/*
      $themeurl = file_create_url(path_to_theme());
      $top = field_get_items('node', $node, 'field_from');
      $top = $top[0]['value'];
      $from = substr($top,strpos($top, "(")+1,3);  
      $top = field_get_items('node', $node, 'field_to');
      $top = $top[0]['value'];
      $to = substr($top,strpos($top, "(")+1,3);
      
      
 ?>
 <div class="gap"></div>
 <div class="container">
   <div class="row row-wrap">
      <div class="col-md-12">
         <div id="abhiFlightDetails">
            <div id="abhiOrigin" class="abhiOriginDestination"><?php  $top = field_get_items('node', $node, 'field_from'); print $top[0]['value']; ?></div>
            <div id="abhiarrowHtml" class="abhiarrowHtml">&#8594;</div>
            <div id="abhiDestination" class="abhiOriginDestination"><?php  $top = field_get_items('node', $node, 'field_to'); print $top[0]['value']; ?></div>
            <div id="abhiFromTxt">From</div>
            <div class="abhifarePrice" id="abhifarePrice0A"><a class="searchURL" href="javascript:showDatePicker('A', '0','ACC','NYC','Accra','New York','$ 918');">$ 1,072*</a></div>
            <div style="clear: both;"></div>
         </div>
         <div class="abhi_city_detail">
            <?php  $top = field_get_items('node', $node, 'field_top'); print $top[0]['value']; ?>
         </div>
      </div>
   </div>
</div>
<!-- END TOP AREA  -->
<div class="gap"></div>
<div class="top-area show-onload">
   <div class="bg-holder full">
      <div class="bg-mask"></div>
      <div class="bg-img" style="background-image:url(<?php echo $themeurl; ?>/img/196_365_2048x1365.jpg);"></div>
      <video class="bg-video hidden-sm hidden-xs" preload="auto" autoplay="true" loop="loop" muted="muted" poster="img/video-bg.jpg">
         <source src="<?php echo $themeurl; ?>/media/travelpainters-header-vid.mp4" type="video/mp4" />
      </video>
      <div class="bg-content">
         <div class="container">
            <div class="row">
               <?php 
                  $pathoffile = realpath(__DIR__);
                  //echo $pathoffile; die;
                  require_once $pathoffile."/"."searchform.php";
                ?>
               
               <div class="col-md-4 ">
                  <div class="abhicity-info text-right hidden-xs hidden-sm">
                     <?php  $top = field_get_items('node', $node, 'field_bd'); print $top[0]['value']; ?>
                     <img src="<?php echo $themeurl; ?>/img/london.png" /><br /><br />
                     <img src="<?php echo $themeurl; ?>/img/travel-painters_logo_lastt-.png" />
                  </div>
               </div>
               
            
            </div>
         </div>
      </div>
   </div>
</div>
<script type="text/javascript">
   $(document).ready(function(){
      $("input[name='from']").val("<?php echo $from; ?>");
      $("input[name='to']").val("<?php echo $to; ?>");
   });
</script>
<?php */ ?>