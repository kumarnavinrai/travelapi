<?php

/**
 * @file
 * Bartik's theme implementation to display a node.
 *
 * Available variables:
 * - $title: the (sanitized) title of the node.
 * - $content: An array of node items. Use render($content) to print them all,
 *   or print a subset such as render($content['field_example']). Use
 *   hide($content['field_example']) to temporarily suppress the printing of a
 *   given element.
 * - $user_picture: The node author's picture from user-picture.tpl.php.
 * - $date: Formatted creation date. Preprocess functions can reformat it by
 *   calling format_date() with the desired parameters on the $created variable.
 * - $name: Themed username of node author output from theme_username().
 * - $node_url: Direct URL of the current node.
 * - $display_submitted: Whether submission information should be displayed.
 * - $submitted: Submission information created from $name and $date during
 *   template_preprocess_node().
 * - $classes: String of classes that can be used to style contextually through
 *   CSS. It can be manipulated through the variable $classes_array from
 *   preprocess functions. The default values can be one or more of the
 *   following:
 *   - node: The current template type; for example, "theming hook".
 *   - node-[type]: The current node type. For example, if the node is a
 *     "Blog entry" it would result in "node-blog". Note that the machine
 *     name will often be in a short form of the human readable label.
 *   - node-teaser: Nodes in teaser form.
 *   - node-preview: Nodes in preview mode.
 *   The following are controlled through the node publishing options.
 *   - node-promoted: Nodes promoted to the front page.
 *   - node-sticky: Nodes ordered above other non-sticky nodes in teaser
 *     listings.
 *   - node-unpublished: Unpublished nodes visible only to administrators.
 * - $title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that
 *   appears in the template.
 * - $title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in
 *   the template.
 *
 * Other variables:
 * - $node: Full node object. Contains data that may not be safe.
 * - $type: Node type; for example, story, page, blog, etc.
 * - $comment_count: Number of comments attached to the node.
 * - $uid: User ID of the node author.
 * - $created: Time the node was published formatted in Unix timestamp.
 * - $classes_array: Array of html class attribute values. It is flattened
 *   into a string within the variable $classes.
 * - $zebra: Outputs either "even" or "odd". Useful for zebra striping in
 *   teaser listings.
 * - $id: Position of the node. Increments each time it's output.
 *
 * Node status variables:
 * - $view_mode: View mode; for example, "full", "teaser".
 * - $teaser: Flag for the teaser state (shortcut for $view_mode == 'teaser').
 * - $page: Flag for the full page state.
 * - $promote: Flag for front page promotion state.
 * - $sticky: Flags for sticky post setting.
 * - $status: Flag for published status.
 * - $comment: State of comment settings for the node.
 * - $readmore: Flags true if the teaser content of the node cannot hold the
 *   main body content.
 * - $is_front: Flags true when presented in the front page.
 * - $logged_in: Flags true when the current user is a logged-in member.
 * - $is_admin: Flags true when the current user is an administrator.
 *
 * Field variables: for each field instance attached to the node a corresponding
 * variable is defined; for example, $node->body becomes $body. When needing to
 * access a field's raw values, developers/themers are strongly encouraged to
 * use these variables. Otherwise they will have to explicitly specify the
 * desired field language; for example, $node->body['en'], thus overriding any
 * language negotiation rule that was previously applied.
 *
 * @see template_preprocess()
 * @see template_preprocess_node()
 * @see template_process()
 */
global $base_url;

$requesturi = $_SERVER['REQUEST_URI'];

$passengerarray = array(1=>"one",2=>"two",3=>"three",4=>"four",5=>"five");

?>

<?php if(isset($node) && $node){ ?>
<div class="container">
  <div class="row">
    <div class="col-md-6">
      <h2>Flight Information</h2>
    </div>
    <div class="col-md-6">
    <div class="sukh_gap"></div>
    <a href="<?php echo $base_url; ?>/<?php echo "mybookingdetails"; ?>"><button class="btn btn-primary right">Back</button></a>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
<table class="table table-bordered table-striped table-booking-history sukh_table">
                      <tbody>
                           <tr>
                                <th class="booking-history-title">Customer Details</th>
                                <td><?php $title = explode("-", $node->title); echo "<b>Name</b>: ".$title[0]." </br><b>Email</b>: ".$title[1]."</br><b>Booking Date</b>: ".date('Y-m-d',strtotime($title[2])); ?></td>
                           </tr>
                           <?php for ($i=1; $i < 6; $i++) 
                                 { 
                                  $keyofpassengerfirstname = 'field_first_name_'.strtolower($passengerarray[$i]); 
                                  $keyofpassengermiddelname = 'field_middel_name_'.strtolower($passengerarray[$i]);
                                  $keyofpassengerlastname = 'field_last_name_'.strtolower($passengerarray[$i]);
                                  $keyofpassengerdob = 'field_date_of_birth_'.strtolower($passengerarray[$i]);
                                  $keyofpassengersex = 'field_sex_'.strtolower($passengerarray[$i]);
                                  
                                  
                                  if(isset($node->$keyofpassengerfirstname))
                                  {  
                                   $firstnamearray = $node->$keyofpassengerfirstname;
                                   $firstname = $firstnamearray['und'][0]['value'];

                                   $middelnamearray = isset($node->$keyofpassengermiddelname)?$node->$keyofpassengermiddelname:"";
                                   $middlename = isset($middelnamearray['und'][0]['value'])?$middelnamearray['und'][0]['value']:"";

                                   $lastnamearray = $node->$keyofpassengerlastname;
                                   $lastname = $lastnamearray['und'][0]['value'];

                                   $dobarray = $node->$keyofpassengerdob;
                                   $dob = $dobarray['und'][0]['value'];

                                   $sexarray = $node->$keyofpassengersex;
                                   $sex = $sexarray['und'][0]['value'];

                                 if($firstname != 'none')
                                 { 
                           ?>
                           
                           <tr>
                                <th class="booking-history-title">Passenger <?php echo ucwords($passengerarray[$i]); ?></th>
                                <td><?php  echo "<b>Name</b> : ".$firstname." ".$middlename." ".$lastname." <b>DOB</b> : ".$dob." <b>Sex</b> :".$sex; ?></td>
                           </tr>

                           <?php }
                                 }   
                                 } ?>

                           <?php
                            if(isset($node->field_passengers))
                            {  
                              $allpassengerdata = json_decode($node->field_passengers['und'][0]['value']);
                              
                                for ($i=1; $i < 51; $i++) 
                                { 
                                   $firstname = reset($allpassengerdata->$i);
                                   $middelname = next($allpassengerdata->$i);
                                   $lastname = next($allpassengerdata->$i);
                                   $dob = date('Y-m-d',strtotime(next($allpassengerdata->$i)));
                                   $sex = next($allpassengerdata->$i);
                                   if($i>5 && $firstname != 'none' )
                                   {
                                    ?>
                            <tr>
                                <th class="booking-history-title">Passenger <?php echo $i; ?></th>
                                <td><?php  echo "<b>Name</b> : ".$firstname." ".$middlename." ".$lastname." <b>DOB</b> : ".$dob." <b>Sex</b> :".$sex; ?></td>
                           </tr> 
                                    <?php
                                   }
                                 }   
                            }  

                           ?>      
                          <tr>
                                <th class="booking-history-title">Flight Information</th>
                                <td>
                                  <?php
                                     $fielddata = json_decode($node->field_flightdata['und'][0]['value']); //echo "<pre>"; print_r($fielddata); ?>
                                    <?php $fielddatafromflight = isset($fielddata->flightarray)?reset($fielddata->flightarray):array(); ?>
                                    <?php $fielddatafromflightend = isset($fielddata->flightarray)?end($fielddata->flightarray):array(); ?>
                                    <?php $fielddatatoflight = isset($fielddata->flightarrayoutbound)?reset($fielddata->flightarrayoutbound):array(); ?>
                                    <?php $fielddatatoflightend = isset($fielddata->flightarrayoutbound)?end($fielddata->flightarrayoutbound):array(); ?>
                                    <?php echo "<b>From</b>: ".$fielddatafromflight->originairport; echo " </br><b>To</b>: ".$fielddatafromflightend->destinationairport." </br><b>Depart On</b>: ".date('Y-m-d h:i:s',strtotime($fielddatafromflight->depart)); ?>
                                    <?php if(isset($fielddatatoflight) && $fielddatatoflight){ 
                                      echo '<hr class="my_hr" />';echo "</br>"."  <b>Return From</b>: ".$fielddatatoflight->originairport; echo " </br><b>Return To</b>: ".$fielddatatoflightend->destinationairport." </br><b>Depart On</b>: ".date('Y-m-d h:i:s',strtotime($fielddatatoflight->depart));; 
                                    }


                                  ?>

                                </td>
                           </tr>
                           <tr>
                                <th class="booking-history-title">Street</th>
                                <td>
                                  <?php 
                                    echo $node->field_street['und'][0]['value'];
                                  ?>
                                </td>
                           </tr>
               <tr>
                                <th class="booking-history-title">City</th>
                                <td>
                                  <?php
                                    echo $node->field_city['und'][0]['value'];
                                  ?>
                                </td>
                           </tr>
                           <tr>
                                <th class="booking-history-title">State</th>
                                <td>
                                  <?php
                                    echo $node->field_state['und'][0]['value'];
                                  ?>
                                </td>
                           </tr>
                           <tr>
                                <th class="booking-history-title">Country</th>
                                <td>
                                  <?php
                                    echo $node->field_country['und'][0]['value'];
                                  ?>
                                </td>
                           </tr>
               <tr>
                                <th class="booking-history-title">Zipcode</th>
                                <td>
                                  <?php
                                    echo $node->field_zipcode['und'][0]['value'];
                                  ?>
                                </td>
                           </tr>
                           <tr>
                                <th class="booking-history-title">Business Phone</th>
                                <td>
                                <?php
                                    echo $node->field_business_phone['und'][0]['value'];
                                  ?>
                                </td>
                           </tr>
                <tr>
                                <th class="booking-history-title">Mobile Phone</th>
                                <td>
                                  <?php
                                    echo $node->field_mobile_phone['und'][0]['value'];
                                  ?>
                                </td>
                           </tr>
               <tr>
                                <th class="booking-history-title">Email</th>
                                <td>
                                  <?php
                                    echo $node->field_email['und'][0]['value'];
                                  ?>
                                </td>
                           </tr>
                <tr>
                                <th class="booking-history-title">Tax</th>
                                <td>$<?php
                                    echo $node->field_tax['und'][0]['value'];
                                  ?></td>
                           </tr>
               <tr>
                               <?php $price = $node->field_total_price['und'][0]['value'] - $node->field_tax['und'][0]['value']; ?>          
                                <th class="booking-history-title">Price</th>
                                <td>
                                  $<?php echo $price; ?>
                                </td>
                           </tr>
                           <tr>
                                <th class="booking-history-title">Total Per Person</th>
                                <td>$<?php echo $node->field_total_price['und'][0]['value']; ?></td>
                           </tr>
                           <tr>
                                <th class="booking-history-title">No of Passengers</th>
                                <td><?php echo $node->field_noofpassenger['und'][0]['value']; ?></td>
                           </tr>
                           <tr>
                                <th class="booking-history-title">Grand Total</th>
                                <td><h5><strong>$<?php echo $node->field_totalpriceofbooking['und'][0]['value']; ?></strong><h5></td>
                           </tr>
                        </tbody>
                </table>
    </div>
  </div>
  <div class="row">
    <div class="col-md-6">
      <a href="<?php echo $base_url; ?>/<?php echo "mybookingdetails"; ?>"><h2>Go back</h2></a>
    </div>
    <div class="col-md-6">
    <div class="sukh_gap"></div>
    <a href="<?php echo $base_url; ?>/<?php echo "mybookingdetails"; ?>"><button class="btn btn-primary right">Back</button></a>
    </div>
  </div>
</div>
<?php } ?>
<?php //echo "<pre>"; print_r($node); ?>

<?php /* ?>
<div id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>>

  <?php print render($title_prefix); ?>
  <?php if (!$page): ?>
    <h2<?php print $title_attributes; ?>>
      <a href="<?php print $node_url; ?>"><?php print $title; ?></a>
    </h2>
  <?php endif; ?>
  <?php print render($title_suffix); ?>

  <?php if ($display_submitted): ?>
    <div class="meta submitted">
      <?php print $user_picture; ?>
      <?php print $submitted; ?>
    </div>
  <?php endif; ?>

  <div class="content clearfix"<?php print $content_attributes; ?>>
    <?php
      // We hide the comments and links now so that we can render them later.
      hide($content['comments']);
      hide($content['links']);
      print render($content);
    ?>
  </div>

  <?php
    // Remove the "Add new comment" link on the teaser page or if the comment
    // form is being displayed on the same page.
    if ($teaser || !empty($content['comments']['comment_form'])) {
      unset($content['links']['comment']['#links']['comment-add']);
    }
    // Only display the wrapper div if there are links.
    $links = render($content['links']);
    if ($links):
  ?>
    <div class="link-wrapper">
      <?php print $links; ?>
    </div>
  <?php endif; ?>

  <?php print render($content['comments']); ?>

</div>
<?php */ ?>
