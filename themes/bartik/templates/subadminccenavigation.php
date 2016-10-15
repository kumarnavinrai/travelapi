<div id="subadminpanel">
<ul>
<?php
if(!isset($base_url))
{
global $base_url;
}
global $user;

$roles=$user->roles;
if(in_array('subadmin',$roles))
{ 
?>
  <li><a href="<?php echo $base_url;?>/cce">Create CCE</a></li>
  <li><a href="<?php echo $base_url;?>/mycce">All CCE Details</a></li>
<?php
}
?>
  <li><a href="<?php echo $base_url;?>/allflights">All Booking Details</a></li>
  <!-- <li><a href="<?php //echo $base_url;?>/#">My bookings</a></li> -->
</ul>
</div>

