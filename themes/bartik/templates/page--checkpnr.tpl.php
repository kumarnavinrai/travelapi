<?php 
      $themeurl = file_create_url(path_to_theme());
      
     
      //echo "<pre>"; print_r($_REQUEST); die;  
   
 ?>
 

  
 <div class="gap"></div>
 <div class="container">
   <div class="row row-wrap">
      <div class="col-md-3">
      </div>
      <div class="col-md-6">
         <h1>CHECK PNR</h1>
          <?php if ($messages): ?>
             <div id="messages"><div class="section clearfix">
               <?php print $messages; ?>
             </div></div> <!-- /.section, /#messages -->
           <?php endif; ?>
         <div id="abhiFlightDetails">
            <?php print render($page['content']); ?>
            <div id="abhiOrigin" class="abhiOriginDestination"><?php  //$top = field_get_items('node', $node, 'field_from'); print $top[0]['value']; ?></div>
            <div id="abhiarrowHtml" class="abhiarrowHtml"><!-- &#8594; --></div>
            <div id="abhiDestination" class="abhiOriginDestination"><?php // $top = field_get_items('node', $node, 'field_to'); print $top[0]['value']; ?></div>
            <div id="abhiFromTxt"></div>
            <div class="abhifarePrice" id="abhifarePrice0A"><!-- <a class="searchURL" href="javascript:showDatePicker('A', '0','ACC','NYC','Accra','New York','$ 918');"></a> --></div>
            <div style="clear: both;"></div>
         </div>
         <div class="abhi_city_detail">
            <?php  //$top = field_get_items('node', $node, 'field_top'); print $top[0]['value']; ?>
         </div>
      </div>
      <div class="col-md-3">
      </div>
   </div>
</div>
<!-- END TOP AREA  -->
<div class="gap"></div>

