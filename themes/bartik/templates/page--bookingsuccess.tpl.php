<?php
$themeurl = file_create_url(path_to_theme());
    if(isset($_GET['bid']) && $_GET['bid'])
    {
        $node = node_load($_GET['bid']);
        //echo "<pre>"; print_r($node); exit;

    if($node)
    {     

?>
 <script src='<?php echo $themeurl; ?>/jsPDF/dist/jspdf.debug.js'></script>
  <script src='<?php echo $themeurl; ?>/jsPDF/libs/html2pdf.js'></script>
  <script>
  function generatepdf(){
        var pdf = new jsPDF('p', 'pt', 'letter');
        var canvas = pdf.canvas;
        canvas.height = 72 * 25;
        canvas.width= 72 * 8.5;;

        // can also be document.body
        var html = '<html><body style="font-size:11px;">';

        html = html + '<table align="center" width="590px" id="templateColumns" style=" font-family: Roboto, arial, helvetica, sans-serif;font-weight: 50;color: #565656;line-height: 0.4em; border:#999999">';
            html = html + '<tr style="background: #18b292; ">';
                html = html + '<td  style="border:#ccc solid;line-height: 0.8em !important;" colspan="2">';
                    html = html + '<p style="font-family: Roboto, arial, helvetica, sans-serif;color: #000;">Thank you for booking flight at Travelpainters. Please check your mail for login credentials. Please also check your junk or spam folder some times custom setting of inbox redirect good emails to spam or junk folder. </p>';
                html = html + '</td>';
            html = html + '</tr>';

            html = html + '<tr>';
                html = html + '<td  colspan="2">';
                html = html + '<h4 align="center" style="font-family: Roboto, arial, helvetica, sans-serif;margin-top: 0;font-weight: 40;line-height: 0.7em;">Flight Detail</h4>';
                html = html + '</td>';
            html = html + '</tr>';

            html = html + '<tr>';
                html = html + '<td align="center" valign="top" width="100%" class="templateColumnContainer">';

                    html = html + '<table style="border:#CCCCCC; border:#999999 solid thin" cellpadding="10" cellspacing="0" width="70%" >';

                        <?php $allflightdata = json_decode($node->field_flightdata['und'][0]['value']); ?>
                       
                        <?php 
                        if(isset($allflightdata) && $allflightdata)
                        {   

                         $allflightdata = $allflightdata->flightarray;   
                         foreach ($allflightdata as $key => $value) 
                         {
                      
                                    
                     

                        //row one
                        echo  'html = html + '."'".'<tr style="background: #18b292;">'."';";
                                echo  'html = html + '."'".'<td class="leftColumnContent" >'."';";
                                    echo  'html = html + '."'".'<strong>Airline</strong>'."';";
                                echo  'html = html + '."'".'</td>'."';";

                                echo  'html = html + '."'".'<td>'."';";
                                    echo  'html = html + '."'".$value->nameofairline."';";
                                echo  'html = html + '."'".'</td>'."';";
                        echo  'html = html + '."'".'</tr>'."';";

                        //row two
                        echo  'html = html + '."'".'<tr>'."';";
                            echo  'html = html + '."'".'<td class="leftColumnContent">'."';";
                                echo  'html = html + '."'".'<strong> Flight Number </strong>'."';";   
                            echo  'html = html + '."'".'</td>'."';";
                            echo  'html = html + '."'".'<td>'."';";
                                echo  'html = html + '."'".$value->flightno."';";
                            echo  'html = html + '."'".'</td>'."';";
                        echo  'html = html + '."'".'</tr>'."';";


                          //row one
                        echo  'html = html + '."'".'<tr style="background: #18b292;">'."';";
                                echo  'html = html + '."'".'<td class="leftColumnContent" >'."';";
                                    echo  'html = html + '."'".'<strong>Depart</strong>'."';";
                                echo  'html = html + '."'".'</td>'."';";

                                echo  'html = html + '."'".'<td>'."';";
                                    echo  'html = html + '."'".$value->originairport."';";
                                echo  'html = html + '."'".'</td>'."';";
                        echo  'html = html + '."'".'</tr>'."';";

                        //row two
                        echo  'html = html + '."'".'<tr>'."';";
                            echo  'html = html + '."'".'<td class="leftColumnContent">'."';";
                                echo  'html = html + '."'".'<strong> Arrive </strong>'."';";   
                            echo  'html = html + '."'".'</td>'."';";
                            echo  'html = html + '."'".'<td>'."';";
                                echo  'html = html + '."'".$value->destinationairport."';";
                            echo  'html = html + '."'".'</td>'."';";
                        echo  'html = html + '."'".'</tr>'."';";

                                  //row one
                        echo  'html = html + '."'".'<tr style="background: #18b292;">'."';";
                                echo  'html = html + '."'".'<td class="leftColumnContent" >'."';";
                                    echo  'html = html + '."'".'<strong>Departure</strong>'."';";
                                echo  'html = html + '."'".'</td>'."';";

                                echo  'html = html + '."'".'<td>'."';";
                                    echo  'html = html + '."'".date('Y-m-d h:i:s',strtotime($value->depart))."';";
                                echo  'html = html + '."'".'</td>'."';";
                        echo  'html = html + '."'".'</tr>'."';";

                        //row two
                        echo  'html = html + '."'".'<tr>'."';";
                            echo  'html = html + '."'".'<td class="leftColumnContent">'."';";
                                echo  'html = html + '."'".'<strong> Arrival </strong>'."';";   
                            echo  'html = html + '."'".'</td>'."';";
                            echo  'html = html + '."'".'<td>'."';";
                                echo  'html = html + '."'".date('Y-m-d h:i:s',strtotime($value->arrives))."';";
                            echo  'html = html + '."'".'</td>'."';";
                        echo  'html = html + '."'".'</tr>'."';";
                        
                     
                         } 
                      } ?>
                                                 
                            html = html + '<tr style="background: #18b292;">';
                                html = html + '<td class="leftColumnContent" style="font-size:15px"><strong>Total</strong></td>';
                            html = html + '<td style="font-size:15px"><?php echo "$".$node->field_total_price['und'][0]['value']; ?></td>';
                        html = html + '</tr>';
                    html = html + '</table>';
                html = html + '</td>';
            html = html + '</tr>';
        html = html + '</table>';
        html = html + '</body></html>';

        html2pdf(html, pdf, function(pdf) {
                pdf.output('dataurlnewwindow');
        });
   }     
</script>
<style type="text/css">
    .print_btn {
      background: #418241;
      background-image: -webkit-linear-gradient(top, #418241, #90B590);
      background-image: -moz-linear-gradient(top, #418241, #90B590);
      background-image: -ms-linear-gradient(top, #418241, #90B590);
      background-image: -o-linear-gradient(top, #418241, #90B590);
      background-image: linear-gradient(to bottom, #418241, #90B590);
      -webkit-border-radius: 28;
      -moz-border-radius: 28;
      border-radius: 28px;
      font-family: Arial;
      color: #ffffff;
      font-size: 20px;
      padding: 10px 20px 10px 20px;
      text-decoration: none;
      border:none;
    }

    .print_btn:hover {
      background: #90B590;
      background-image: -webkit-linear-gradient(top, #90B590, #51A351);
      background-image: -moz-linear-gradient(top, #90B590, #51A351);
      background-image: -ms-linear-gradient(top, #90B590, #51A351);
      background-image: -o-linear-gradient(top, #90B590, #51A351);
      background-image: linear-gradient(to bottom, #90B590, #51A351);
      text-decoration: none;
    }
</style>
<div class="gap"></div>
<div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <button class="print_btn" onclick="generatepdf()">Print Reciept</button>
                    <i class="fa fa-check round box-icon-large box-icon-center box-icon-success mb30"></i>  
                    <h2 class="text-center"><?php echo ucwords($node->name) ?>, your Booking was successful!</h2>
                    <h2 class="text-center">If you have any query Call - 929-292-2122</h2>
                    <h5 class="text-center mb30">Booking details will been sent to <?php echo $node->field_email['und'][0]['value']; ?></h5>
                    
                    <ul class="order-payment-list list mb30">
                        <?php $allflightdata = json_decode($node->field_flightdata['und'][0]['value']); ?>
                       
                        <?php 
                        if(isset($allflightdata) && $allflightdata)
                        {   

                         $allflightdata = $allflightdata->flightarray;   
                         foreach ($allflightdata as $key => $value) 
                         {
                                      // echo "<pre>"; print_r($value); die;
                        ?>             
                        <li>
                            <div class="row">
                                <div class="col-xs-9">
                                    
                                    
                                    <h5><i class="fa fa-plane"></i> Flight from <?php echo $value->originairport; ?> to <?php echo $value->destinationairport; ?>.</h5>
                                    <p><small><?php echo date('Y-m-d h:i:s',strtotime($value->depart)); ?></small><small><?php echo $value->nameofairline; ?></small><small>Flight No. <?php echo $value->flightno; ?></small>
                                    </p>
                                     <p><small>Class <?php echo $value->travelclass; ?></small>
                                    </p>
                                </div>
                                <div class="col-xs-3">
                                    <p class="text-right"><span class="text-lg">
                                        <?php if(isset($allflightdata->flightarrayoutbound) && !$allflightdata->flightarrayoutbound)    
                                {   echo "$".$node->field_total_price['und'][0]['value']; } ?>
                                    </span>
                                    </p>
                                </div>
                            </div>
                        </li>
                        <?php
                         } 
                         } ?>
                        <li>
                            <div class="row">
                                <div class="col-xs-9">
                                <?php 
                                if(isset($allflightdata->flightarrayoutbound) && $allflightdata->flightarrayoutbound)    
                                {    
                                    $rto = reset($allflightdata->flightarrayoutbound);
                                    $rfrom = end($allflightdata->flightarrayoutbound);    

                                ?>
                                     <h5><i class="fa fa-plane"></i> Flight from <?php echo $rto->originairport; ?> to <?php echo $rfrom->destinationairport ?>.</h5>
                                    <p><small><?php echo date('Y-m-d h:i:s',strtotime($rto->depart)); ?></small>
                                    </p>
                                    
                                </div>
                                <div class="col-xs-3">
                                    <p class="text-right"><span class="text-lg">$<?php echo $node->field_total_price['und'][0]['value']; ?></span>
                                    </p>
                                </div>
                                <?php } ?>
                            </div>
                        </li>
                    </ul>
                    
                </div>
            </div>
            <div class="gap"></div>
        </div>
     <?php } ?>
<?php }else{ ?>
<h1>Something went wrong Please Reebook flight or Call 929-292-1201</h1>

<?php } ?>        