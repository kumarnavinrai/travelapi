<?php

$roles=$user->roles;
if(in_array('subadmin',$roles) || in_array('cce',$roles))
	{
		header('Location: allflights');
		exit();
	}

?>