<?php
    if(isset($_GET['bid']) && $_GET['bid'])
    {
        $node = node_load($_GET['bid']);
        //echo "<pre>"; print_r($node); exit;

    if($node)
    {     

?>
<div class="gap"></div>
<div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <i class="fa fa-check round box-icon-large box-icon-center box-icon-success mb30"></i>  
                    <h2 class="text-center"><?php echo ucwords($node->name) ?>, your Booking was successful!</h2>
                    <h2 class="text-center">If you have any query Call - 929-292-2122</h2>
                    <h5 class="text-center mb30">Booking details will been sent to <?php echo $node->field_email['und'][0]['value']; ?></h5>
                    
                    <ul class="order-payment-list list mb30">
                        <li>
                            <div class="row">
                                <div class="col-xs-9">
                                    <?php $allflightdata = json_decode($node->field_flightdata['und'][0]['value']); ?>
                                    <?php 

                                        //echo "<pre>"; 
                                        //print_r($allflightdata); die;
                                        
                                        $to = reset($allflightdata->flightarray); 
                                        $from = end($allflightdata->flightarray);
                                        

                                        
                                     ?>
                                    <h5><i class="fa fa-plane"></i> Flight from <?php echo $to->originairport; ?> to <?php echo $from->destinationairport ?>.</h5>
                                    <p><small><?php echo date('Y-m-d h:i:s',strtotime($to->depart)); ?></small>
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