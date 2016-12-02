<?php
$path=realpath(__DIR__);
$filepath=$path."/denyaccesstocceandsubadmin.php";
require_once $filepath;

?>

<ul class="nav navbar-nav">
       
	<!-- Destinations End -->
    <script type="text/javascript">
        $(function(){
    $(".dropdown").hover(            
            function() {
                $('.dropdown-menu', this).stop( true, true ).fadeIn("fast");
                $(this).toggleClass('open');
                $('b', this).toggleClass("caret caret-up");                
            },
            function() {
                $('.dropdown-menu', this).stop( true, true ).fadeOut("fast");
                $(this).toggleClass('open');
                $('b', this).toggleClass("caret caret-up");                
            });
    });
    </script>
                                
                                <li ><a href="<?php echo $urlofwp; ?>">FLIGHTS</a> </li>
                                <li><a href="<?php echo $urlofwp; ?>">HOTELS</a> </li>
                                <!--<li><a href="<?php echo $urlofwp; ?>insurance/">INSURANCE</a></li>-->
                                <!-- <li><a href="<?php echo $urlofwp; ?>">CARS</a></li> -->
                                <!-- diff menu start -->
                                <li class="dropdown mega-dropdown">
                                  <a href="<?php echo $urlofwp; ?>destinations" class="dropdown-toggle" data-toggle="dropdown">TRAVEL INFO &nbsp<i class="fa fa-sort-desc sukh" aria-hidden="true"></i></a>
                                    <ul class="dropdown-menu mega-dropdown-menu row">
                                        <li><a href="<?php echo $urlofwp; ?>content/checkbookinginfo">CHECK BOOKING INFO</a></li>
                                        <li><a href="<?php echo $urlofwp; ?>onlinecheckin/">ONLINE CHECK-IN</a></li>
                                        <!-- <li><a href="<?php echo $urlofwp; ?>popularroutes">POPULAR ROUTES</a></li> -->
                                    </ul>
                                </li>     
                                <!--diff menu ends -->
                               
                                <!-- <li><a href="<?php echo $urlofwp; ?>content/aboutus">ABOUT US</a> </li> -->
                                
                                <li><a href="<?php echo $urlofwp; ?>content/contacts/">CONTACT US</a></li>
    
    </ul>


