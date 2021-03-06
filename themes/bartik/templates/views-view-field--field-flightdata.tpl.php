<?php

/**
 * @file
 * This template is used to print a single field in a view.
 *
 * It is not actually used in default Views, as this is registered as a theme
 * function which has better performance. For single overrides, the template is
 * perfectly okay.
 *
 * Variables available:
 * - $view: The view object
 * - $field: The field handler object that can process the input
 * - $row: The raw SQL result that can be used
 * - $output: The processed output that will normally be used.
 *
 * When fetching output from the $row, this construct should be used:
 * $data = $row->{$field->field_alias}
 *
 * The above will guarantee that you'll always get the correct data,
 * regardless of any changes in the aliasing that might happen if
 * the view is modified.
 */
?>

<?php $fielddata = json_decode($field->view->result[0]->_field_data['nid']['entity']->field_flightdata['und'][0]['value']); //echo "<pre>"; print_r($fielddata); ?>
<?php $fielddatafromflight = isset($fielddata->flightarray)?reset($fielddata->flightarray):array(); ?>
<?php $fielddatafromflightend = isset($fielddata->flightarray)?end($fielddata->flightarray):array(); ?>
<?php $fielddatatoflight = isset($fielddata->flightarrayoutbound)?reset($fielddata->flightarrayoutbound):array(); ?>
<?php $fielddatatoflightend = isset($fielddata->flightarrayoutbound)?end($fielddata->flightarrayoutbound):array(); ?>
<?php echo "<b>From</b>: ".$fielddatafromflight->originairport; echo " </br><b>To</b>: ".$fielddatafromflightend->destinationairport." </br><b>Depart On</b>: ".date('Y-m-d h:i:s',strtotime($fielddatafromflight->depart)); ?>
<?php if(isset($fielddatatoflight) && $fielddatatoflight){ 
	echo '<hr class="my_hr" />';echo "</br>"."  <b>Return From</b>: ".$fielddatatoflight->originairport; echo " </br><b>Return To</b>: ".$fielddatatoflightend->destinationairport." </br><b>Depart On</b>: ".date('Y-m-d h:i:s',strtotime($fielddatatoflight->depart));; 
}
?>


