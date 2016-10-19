<script>
	.cceform
	{
	position: relative;
	width: 300px;
	z-index: 15;
	left: 40%;
	margin: 100px 0 0 -75px;
	}
</script>
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
   <li><a href="<?php echo $base_url;?>/cceflightdetails">My bookings</a></li> 
</ul>
</div>

